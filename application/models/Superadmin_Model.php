<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin_Model extends CI_Model
{
    public function all_admin($limit = null, $offset = null)
    {
        $this->db->select('*');
        $this->db->from('superadmin');
        $this->db->where('is_super', null);
        $this->db->or_where('is_super', '0');

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result_array();
    }

    public function new_admin($data)
    {
        $this->db->insert('superadmin', $data);

        if ($this->General_Model->aff_row() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_superadmin($id = "") # ambil data user (semua atau tertentu)
    {
        $this->db->from('superadmin');

        if (!empty($id)) {
            $this->db->where('email', $id);
            return $this->db->get()->row_array();
        }
        return $this->db->get()->result_array();
    }

    public function get_paket($id = "") # ambil paket (semua atau tertentu) kalau tertentu pakai MD5
    {
        $this->db->select('pengiriman.*, FORMAT(pengiriman.harga_total,0) AS harga_format, customer.NamaLengkap AS NamaLengkap, customer.no_telp AS no_telp');
        $this->db->from('pengiriman');
        $this->db->join('customer', 'pengiriman.sender_ID = customer.ID');

        if (!empty($id)) {
            $this->db->where('MD5(pengiriman.ID)', $id);
            return $this->db->get()->row_array();
        }
        return $this->db->get()->result_array();
    }

    public function kategori($limit = null, $offset = null) # ambil semua kategori paket
    {
        $this->db->select('*, FORMAT(harga,2) as harga_formatted');
        $this->db->from('kategori_paket');
        $this->db->where('is_deactivate', 0);
        $this->db->order_by('Nama', 'asc');

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result_array();
    }

    public function kelompok_harga_kategori($ID = "") # menentukan biaya paket berdasarkan parameter KATEGORI
    {
        $this->db->from('kategori_paket');
        $this->db->where('ID', $ID);
        return $this->db->get()->row_array()['harga'];
    }

    public function kelompok_harga_jarak($jarak = "", $limit = null, $offset = null) # menentukan biaya paket berdasarkan parameter JARAK
    {
        $this->db->select('*, FORMAT(harga, 2) as harga_formatted');
        $this->db->from('golongan_jarak');

        if (!empty($jarak)) {
            $this->db->where('range_low <=', $jarak);
            $this->db->where('range_high >=', $jarak);
            $this->db->where('is_deactive', 0);

            $this->db->order_by('created_at', 'desc');
            $this->db->limit(1);

            return $this->db->get()->row_array()['harga'];
        } else {

            if ($limit !== null && $offset !== null) {
                $this->db->limit($limit, $offset);
            }

            $this->db->order_by('range_low', 'asc');
            return $this->db->get()->result_array();
        }
    }

    public function kelompok_harga_bobot($bobot_input = "", $limit = null, $offset = null) # menentukan biaya paket berdasarkan parameter BOBOT/BEBAN
    {
        $this->db->select('*, FORMAT(harga, 2) as harga_formatted');
        $this->db->from('golongan_bobot');

        if (!empty($bobot_input)) {
            $bobot = $bobot_input / 1000;
            $this->db->where('range_low <=', $bobot);
            $this->db->where('range_high >=', $bobot);
            $this->db->where('is_deactive', 0);

            $this->db->order_by('created_at', 'desc');
            $this->db->limit(1);

            return $this->db->get()->row_array()['harga'];
        } else {

            if ($limit !== null && $offset !== null) {
                $this->db->limit($limit, $offset);
            }

            $this->db->order_by('range_low', 'asc');
            return $this->db->get()->result_array();
        }
    }

    public function kelompok_harga_volume($volume = "", $limit = null, $offset = null)
    {
        $this->db->select('*, FORMAT(harga, 2) as harga_formatted, FORMAT(range_low, 0) as range_low_format, FORMAT(range_high,0) as range_high_format');
        $this->db->from('golongan_volume');

        if (!empty($volume)) {
            $this->db->where('range_low <=', $volume);
            $this->db->where('range_high >=', $volume);
            $this->db->where('is_deactive', 0);

            $this->db->order_by('created_at', 'desc');
            $this->db->limit(1);

            return $this->db->get()->row_array()['harga'];
        } else {

            if ($limit !== null && $offset !== null) {
                $this->db->limit($limit, $offset);
            }

            $this->db->order_by('range_low', 'asc');
            return $this->db->get()->result_array();
        }
    }

    public function armada($plat_nomor = "") # menampilkan data armada dan jenisnya
    {
        $this->db->from('armada');
        $this->db->join('jenis_armada', 'armada.jenis_ID = jenis_armada.id_jenis_armada', 'left');
        $this->db->join('sopir', 'armada.sopir_ID = sopir.ID', 'left');

        if (!empty($plat_nomor)) {
            $this->db->where('armada.plat_nomor', $plat_nomor);

            return $this->db->get()->row_array();
        } else {
            redirect('superadmin/kelola-armada');
        }
    }

    public function armada_md5($id_armada_md5 = "") # menampilkan data armada dan jenisnya
    {
        $this->db->select('*, armada.ID AS armada_ID');
        $this->db->from('armada');
        $this->db->join('jenis_armada', 'armada.jenis_ID = jenis_armada.id_jenis_armada', 'left');
        $this->db->join('sopir', 'armada.sopir_ID = sopir.ID', 'left');

        if (!empty($id_armada_md5)) {
            $this->db->where('md5(armada.ID)', $id_armada_md5);

            return $this->db->get()->row_array();
        } else {
            redirect('superadmin/proses-kirim');
        }
    }

    public function sopir($status = "", $limit = null, $offset = null) # 1 = tidak aktif; 0 = aktif
    {
        $this->db->from('sopir');

        if (!empty($status)) {
            $this->db->where('is_active', $status);
        }

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        $this->db->order_by('NamaLengkap', 'asc');

        return $this->db->get()->result_array();
    }

    public function sopir_by_ID_md5($ID = '')
    {
        $this->db->select('*, sopir.ID AS sopir_ID');
        $this->db->from('sopir');
        $this->db->join('kontrak_sopir', 'sopir.kontrak_sopir = kontrak_sopir.ID', 'left');
        $this->db->where('md5(sopir.ID)', $ID);

        return $this->db->get()->row_array();
    }

    public function all_armada($limit = null, $offset = null)
    {
        $this->db->select('*, armada.ID as armada_ID');
        $this->db->from('armada');
        $this->db->join('sopir', 'armada.sopir_ID = sopir.ID', 'left');
        $this->db->join('jenis_armada', 'armada.jenis_ID = jenis_armada.id_jenis_armada', 'left');
        $this->db->order_by('armada.plat_nomor', 'asc');
        $this->db->order_by('armada.ID', 'asc');

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result_array();
    }

    public function all_jenis()
    {
        $this->db->from('jenis_armada');
        $this->db->order_by('nama_jenis', 'asc');

        return $this->db->get()->result_array();
    }

    public function kontrak_by_ID_md5($ID = '')
    {
        $this->db->from('kontrak_sopir');
        $this->db->where('md5(sopir_ID)', $ID);
        $this->db->order_by('is_valid', 'desc');
        $this->db->order_by('tanggal_akhir', 'desc');

        return $this->db->get()->result_array();
    }

    public function get_customer()
    {
        $this->db->from('customer');
        return $this->db->get()->result_array();
    }

    public function get_kargo($id_armada_md5 = '', $kota_tujuan = '', $limit = null, $offset = null)
    {
        $this->db->select(
            'pengiriman.ID AS no_resi, ' .
                'kategori_paket.Nama AS nama_kategori, ' .
                'pengiriman.bobot AS bobot, ' .
                'pengiriman.harga_total AS biaya_total, ' .
                'pengiriman.sent_date AS tanggal_diserahkan, ' .
                'pengiriman.alamat_tujuan AS alamat_tujuan, ' .
                'pengiriman.kota_tujuan AS kota_tujuan, ' .
                'sopir.NamaLengkap AS nama_sopir, ' .
                'format(pengiriman.volume, 0) AS volume, ' .
                'pengiriman.target_tiba AS target_tiba, ' .
                'tipe_kurir.tipe AS tipe_kurir'
        );
        $this->db->from('pengiriman');
        $this->db->join('kategori_paket', 'kategori_paket.ID = pengiriman.kategori_ID', 'left');
        $this->db->join('armada', 'armada.sopir_ID = pengiriman.armada_ID', 'left');
        $this->db->join('sopir', 'sopir.ID = armada.ID', 'left');
        $this->db->join('tipe_kurir', 'tipe_kurir.ID = pengiriman.tipe_kurir', 'left');

        $this->db->where('pengiriman.received_date', null);

        if (!empty($id_armada_md5)) {
            $this->db->where('md5(pengiriman.armada_ID)', $id_armada_md5);
        } else {
            $this->db->where('pengiriman.armada_ID', null);
        }

        if (!empty($kota_tujuan)) {
            $this->db->where('pengiriman.kota_tujuan', $kota_tujuan);
        }

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        $this->db->order_by('pengiriman.ID', 'asc');

        return $this->db->get()->result_array();
    }

    public function get_kargo_all($blm_bayar = '', $blm_tiba = '')
    {
        $this->db->select(
            'pengiriman.ID AS no_resi, ' .
                'kategori_paket.Nama AS nama_kategori, ' .
                'pengiriman.bobot AS bobot, ' .
                'pengiriman.harga_total AS biaya_total, ' .
                'pengiriman.sent_date AS tanggal_diserahkan, ' .
                'pengiriman.alamat_tujuan AS alamat_tujuan, ' .
                'pengiriman.kota_tujuan AS kota_tujuan, ' .
                'sopir.NamaLengkap AS nama_sopir, ' .
                'FORMAT(pengiriman.volume, 0) AS volume, ' .
                'pengiriman.target_tiba AS target_tiba, ' .
                'tipe_kurir.tipe AS tipe_kurir'
        );

        $this->db->from('pengiriman');
        $this->db->join('kategori_paket', 'kategori_paket.ID = pengiriman.kategori_ID', 'left');
        $this->db->join('armada', 'armada.sopir_ID = pengiriman.armada_ID', 'left');
        $this->db->join('sopir', 'sopir.ID = armada.ID', 'left');
        $this->db->join('tipe_kurir', 'tipe_kurir.ID = pengiriman.tipe_kurir', 'left');
        $this->db->join('(SELECT id_pengiriman, SUM(jumlah_bayar) AS total_bayar FROM pembayaran GROUP BY id_pengiriman) AS bayar', 'bayar.id_pengiriman = pengiriman.ID', 'left');

        if (!empty($blm_bayar)) {
            // hanya tampilkan yang belum lunas
            $this->db->group_start();
            $this->db->where('bayar.total_bayar < pengiriman.harga_total');
            $this->db->or_where('bayar.total_bayar IS NULL'); // belum dibayar sama sekali
            $this->db->group_end();
        } else if (!empty($blm_tiba)) {
            // hanya tampilkan yang belum tiba
            $this->db->where('pengiriman.received_date IS NULL');
        }

        $this->db->order_by('pengiriman.ID', 'asc');

        return $this->db->get()->result_array();
    }

    public function get_kargo_specific_by_id($id)
    {
        $this->db->select(
            'pengiriman.ID AS no_resi, ' .
                'kategori_paket.Nama AS nama_kategori, ' .
                'pengiriman.bobot AS bobot, ' .
                'FORMAT(COALESCE(pengiriman.harga_total - bayar.total_bayar, pengiriman.harga_total), 0) AS biaya_total_view, ' .
                'FORMAT(pengiriman.harga_total, 0) AS biaya_total_formatted, ' .
                'pengiriman.harga_total AS biaya_total, ' .
                'pengiriman.sent_date AS tanggal_diserahkan, ' .
                'pengiriman.alamat_tujuan AS alamat_tujuan, ' .
                'pengiriman.kota_tujuan AS kota_tujuan, ' .
                'sopir.NamaLengkap AS nama_sopir, ' .
                'FORMAT(pengiriman.volume, 0) AS volume, ' .
                'pengiriman.target_tiba AS target_tiba, ' .
                'tipe_kurir.tipe AS tipe_kurir, ' .
                'customer.NamaLengkap AS sender_name, ' .
                'pengiriman.receiver_name AS nama_penerima, ' .
                'pengiriman.armada_ID AS armada_ID'
        );

        $this->db->from('pengiriman');
        $this->db->join('customer', 'customer.ID = pengiriman.sender_ID');
        $this->db->join('kategori_paket', 'kategori_paket.ID = pengiriman.kategori_ID', 'left');
        $this->db->join('armada', 'armada.sopir_ID = pengiriman.armada_ID', 'left');
        $this->db->join('sopir', 'sopir.ID = armada.ID', 'left');
        $this->db->join('tipe_kurir', 'tipe_kurir.ID = pengiriman.tipe_kurir', 'left');
        $this->db->join(
            '(SELECT id_pengiriman, SUM(jumlah_bayar) AS total_bayar FROM pembayaran GROUP BY id_pengiriman) AS bayar',
            'bayar.id_pengiriman = pengiriman.ID',
            'left'
        );

        $this->db->where('pengiriman.ID', $id);
        $this->db->order_by('pengiriman.ID', 'asc');

        return $this->db->get()->row_array();
    }

    public function get_tipekurir($limit = null, $offset = null)
    {
        $this->db->select('*, FORMAT(biaya,2) as biaya_formatted');
        $this->db->from('tipe_kurir');
        $this->db->order_by('biaya', 'asc');

        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result_array();
    }

    public function get_tipekurir_id($id = "")
    {
        $this->db->select('*, FORMAT(biaya,2) as biaya_formatted');
        $this->db->from('tipe_kurir');

        if ($id) {
            $this->db->where('ID', $id);
        }

        return $this->db->get()->row_array();
    }

    public function hitung_paket_belum_proses()
    {
        $this->db->select('COUNT(*) AS hasil');
        $this->db->from('pengiriman');
        $this->db->where('armada_ID', null);

        return $this->db->get()->row_array();
    }

    public function hitung_paket_belum_tiba()
    {
        $this->db->select('COUNT(*) AS hasil');
        $this->db->from('pengiriman');
        $this->db->where('received_date', null);

        return $this->db->get()->row_array();
    }

    public function hitung_paket_selesai()
    {
        $this->db->select('COUNT(*) AS hasil');
        $this->db->from('pengiriman');
        $this->db->where('YEAR(received_date)', date('Y'));

        return $this->db->get()->row_array();
    }

    public function tipe_kurir_terlaris()
    {
        $this->db->select('tipe_kurir.id, tipe_kurir.tipe AS hasil, COUNT(pengiriman.id) AS hitung');
        $this->db->from('pengiriman');
        $this->db->join('tipe_kurir', 'tipe_kurir.id = pengiriman.tipe_kurir');
        $this->db->group_by('tipe_kurir.id');
        $this->db->order_by('hitung', 'DESC');
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function kota_tujuan_terbanyak()
    {
        $this->db->select('kota_tujuan, COUNT(*) AS jumlah');
        $this->db->from('pengiriman');
        $this->db->group_by('kota_tujuan');
        $this->db->order_by('jumlah', 'DESC');
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function distribusi_tipe_kurir()
    {
        $this->db->select('tipe_kurir.tipe, COUNT(pengiriman.id) AS jumlah');
        $this->db->from('pengiriman');
        $this->db->join('tipe_kurir', 'tipe_kurir.id = pengiriman.tipe_kurir', 'right');
        $this->db->group_by('tipe_kurir.id');
        $this->db->order_by('jumlah', 'DESC');

        return $this->db->get()->result();
    }

    public function get_metode_bayar()
    {
        $this->db->from('metode_pembayaran');
        $this->db->order_by('bank', 'asc');
        $this->db->order_by('metode', 'asc');
        return $this->db->get()->result_array();
    }

    public function get_report($bulan = "", $tahun = "")
    {
        $this->db->select(
            '*, ' .
                'FORMAT(ttl_tarif_terbentuk,0) AS ttl_tarif_terbentuk_formatted,' .
                'FORMAT(ttl_tarif_dibayar,0) AS ttl_tarif_dibayar_formatted,' .
                'FORMAT(ttl_tarif_blm_dibayar,0) AS ttl_tarif_blm_dibayar_formatted'
        );
        $this->db->from('monthly_report');

        if (!empty($bulan) && !empty($tahun)) {
            $this->db->where('bulan', $bulan);
            $this->db->where('tahun', $tahun);

            return $this->db->get()->row_array();
        } else {
            $this->db->order_by('bulan', 'desc');
            $this->db->order_by('tahun', 'desc');

            return $this->db->get()->result_array();
        }
    }

    public function update_armada_kirim($id_pengiriman, $id_armada)
    {
        $set = ['armada_ID' => $id_armada];
        $condition = ['ID' => $id_pengiriman];
        $this->db->update('pengiriman', $set, $condition);

        if ($this->General_Model->aff_row() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_status_kirim($id_kirim)
    {
        $set = [
            'received_date' => date('Y-m-d'),
        ];
        $condition = ['ID' => $id_kirim];
        $this->db->update('pengiriman', $set, $condition);

        if ($this->General_Model->aff_row() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
