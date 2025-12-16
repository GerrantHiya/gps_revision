<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_Model extends CI_Model
{
    public function get_customer($id = "")
    {
        $this->db->from('customer');

        if (!empty($id)) {
            $this->db->where('email', $id);
        }

        return $this->db->get()->row_array();
    }

    public function data_pembayaran($id_bayar)
    {
        $this->db->select(
            'pembayaran.id_pengiriman AS ID_pengiriman, ' .
                'FORMAT(pembayaran.jumlah_bayar, 2) AS jumlah_bayar, ' .
                'FORMAT(pembayaran.sisa_tunggakan, 2) AS tunggakan, ' .
                'CONCAT(metode_pembayaran.metode, " ", metode_pembayaran.bank) AS metode_bayar, ' .
                'pembayaran.tanggal_bayar AS tanggal_bayar, ' .
                'pengiriman.receiver_name AS nama_penerima, ' .
                'customer.NamaLengkap AS nama_pengirim, ' .
                'pembayaran.atas_nama_bayar AS atas_nama_bayar, ' .
                'pengiriman.sent_date AS tanggal_kirim, ' .
                'pengiriman.alamat_tujuan AS alamat_tujuan, ' .
                'pengiriman.bobot AS bobot, ' .
                'pengiriman.volume AS volume, ' .
                'kategori_paket.Nama AS nama_kategori, ' .
                'pembayaran.ID AS ID_bayar, ' .
                'tipe_kurir.tipe AS tipe_kurir, ' . 
                'pengiriman.hilang AS hilang'
        );
        $this->db->from('pembayaran');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.ID = pembayaran.metode_bayar', 'left');
        $this->db->join('pengiriman', 'pengiriman.ID = pembayaran.id_pengiriman', 'left');
        $this->db->join('customer', 'customer.ID = pengiriman.sender_ID', 'left');
        $this->db->join('kategori_paket', 'pengiriman.kategori_ID = kategori_paket.ID', 'left');
        $this->db->join('tipe_kurir', 'pengiriman.tipe_kurir = tipe_kurir.ID', 'left');

        $this->db->where('pembayaran.ID', $id_bayar);
        return $this->db->get()->row_array();
    }

    public function hitung_tunggakan($sender_ID = '')
    {
        // Subquery untuk total pembayaran per pengiriman
        $subquery = "(SELECT id_pengiriman, SUM(jumlah_bayar) AS total_bayar FROM pembayaran GROUP BY id_pengiriman) b";

        // Build main query
        $this->db->select('SUM(p.harga_total) AS total_biaya');
        $this->db->select('FORMAT(IFNULL(SUM(b.total_bayar), 0), 0) AS total_bayar');
        $this->db->select('FORMAT(SUM(p.harga_total) - IFNULL(SUM(b.total_bayar), 0), 0) AS total_tunggakan');
        $this->db->from('pengiriman p');
        $this->db->join($subquery, 'b.id_pengiriman = p.id', 'left');

        if (!empty($sender_ID)) {
            $this->db->where('sender_ID', $sender_ID);
        }

        return $this->db->get()->row_array();
    }

    public function get_pengiriman($pengirim_ID = '', $limit = null, $offset = null)
    {
        $this->db->select(
            'pengiriman.ID AS no_resi, ' .
                'kategori_paket.Nama AS nama_kategori, ' .
                'pengiriman.bobot AS bobot, ' .
                'pengiriman.harga_total AS biaya_total, ' .
                'pengiriman.sent_date AS tanggal_diserahkan, ' .
                'pengiriman.received_date AS tanggal_diterima, ' .
                'pengiriman.alamat_tujuan AS alamat_tujuan, ' .
                'pengiriman.kota_tujuan AS kota_tujuan, ' .
                'sopir.NamaLengkap AS nama_sopir, ' .
                'format(pengiriman.volume, 0) AS volume, ' .
                'pengiriman.target_tiba AS target_tiba, ' .
                'tipe_kurir.tipe AS tipe_kurir,' .
                'pengiriman.armada_ID AS armada_ID, ' . 
                'pengiriman.hilang AS hilang'
        );
        $this->db->from('pengiriman');
        $this->db->join('kategori_paket', 'kategori_paket.ID = pengiriman.kategori_ID', 'left');
        $this->db->join('armada', 'armada.sopir_ID = pengiriman.armada_ID', 'left');
        $this->db->join('sopir', 'sopir.ID = armada.ID', 'left');
        $this->db->join('tipe_kurir', 'tipe_kurir.ID = pengiriman.tipe_kurir', 'left');

        $this->db->where('pengiriman.sender_ID', $pengirim_ID);

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        $this->db->order_by('pengiriman.ID', 'asc');

        return $this->db->get()->result_array();
    }

    /**
     * Get invoice data for PDF download
     * Only returns data if the invoice is fully paid (lunas) and belongs to customer
     * 
     * @param int $no_resi Receipt number
     * @param string $customer_id Customer ID for ownership validation
     * @return array|null Invoice data or null if not found/not lunas/not owned
     */
    public function get_invoice_data($no_resi, $customer_id)
    {
        $this->db->select(
            'pengiriman.ID AS no_resi, ' .
            'pengiriman.sender_ID AS sender_id, ' .
            'kategori_paket.Nama AS nama_kategori, ' .
            'pengiriman.bobot AS bobot, ' .
            'pengiriman.harga_total AS biaya_total, ' .
            'pengiriman.sent_date AS tanggal_diserahkan, ' .
            'pengiriman.received_date AS tanggal_diterima, ' .
            'pengiriman.alamat_tujuan AS alamat_tujuan, ' .
            'pengiriman.kota_tujuan AS kota_tujuan, ' .
            'FORMAT(pengiriman.volume, 2) AS volume, ' .
            'tipe_kurir.tipe AS tipe_kurir, ' .
            'customer.NamaLengkap AS sender_name, ' .
            'pengiriman.receiver_name AS nama_penerima, ' .
            'IFNULL(bayar.total_bayar, 0) AS total_dibayar'
        );
        
        $this->db->from('pengiriman');
        $this->db->join('customer', 'customer.ID = pengiriman.sender_ID');
        $this->db->join('kategori_paket', 'kategori_paket.ID = pengiriman.kategori_ID', 'left');
        $this->db->join('tipe_kurir', 'tipe_kurir.ID = pengiriman.tipe_kurir', 'left');
        $this->db->join(
            '(SELECT id_pengiriman, SUM(jumlah_bayar) AS total_bayar FROM pembayaran GROUP BY id_pengiriman) AS bayar',
            'bayar.id_pengiriman = pengiriman.ID',
            'left'
        );
        
        $this->db->where('pengiriman.ID', $no_resi);
        $this->db->where('pengiriman.sender_ID', $customer_id);
        
        $result = $this->db->get()->row_array();
        
        // Check if lunas (total paid >= total cost)
        if ($result && $result['total_dibayar'] >= $result['biaya_total']) {
            return $result;
        }
        
        return null;
    }
}

