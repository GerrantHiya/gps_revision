<?php

class Report_Model extends CI_Model
{
    public function monthly_report($period = "")
    {
        if (empty($period)) {
            return false;
        }
        $exp = explode('/', $period);
        $month = $exp[0];
        $year = $exp[1];

        $month_bfr = 0;

        if ($month == 1) {
            $month_bfr = 12;
            $year_bfr = (int) $year - 1;
        } else {
            $month_bfr = (int) $month - 1;
            $year_bfr = (int) $year;
        }

        # 1. a. Laporan Kargo bulan berjalan
        $this->db->select(
            'IFNULL(SUM(pengiriman.harga_total),0) AS ttl_tarif_terbentuk,' .
                'IFNULL(SUM(CASE WHEN pengiriman.received_date IS NOT NULL THEN 1 ELSE 0 END),0) AS jml_paket_terkirim,' .
                'IFNULL(SUM(CASE WHEN pengiriman.hilang = 1 THEN 1 ELSE 0 END),0) AS jml_paket_hilang,' .
                'IFNULL(SUM(pembayaran.jumlah_bayar),0) AS ttl_tarif_dibayar,' .
                '(IFNULL(SUM(pengiriman.harga_total),0) - IFNULL(SUM(pembayaran.jumlah_bayar),0)) AS ttl_tarif_blm_dibayar'
        );
        $this->db->from('pengiriman');
        $this->db->join('pembayaran', 'pengiriman.ID = pembayaran.ID_pengiriman', 'left');
        $this->db->where('MONTH(pengiriman.sent_date)', $month);
        $this->db->where('YEAR(pengiriman.sent_date)', $year);

        $data_kargo_cur_period = $this->db->get()->row_array();

        # 1. b. Laporan Customer bulan berjalan
        $this->db->select(
            'COUNT(customer.ID) AS ttl_customer'
        );
        $this->db->from('customer');
        $this->db->where('customer.active = 1');
        $this->db->where('MONTH(customer.created_at) <= ' . $month);
        $this->db->where('YEAR(customer.created_at) <= ' . $year);

        $data_cust_cur_period = $this->db->get()->row_array();

        # 2. a. Laporan Kargo bulan -1
        $this->db->select(
            'IFNULL(SUM(pengiriman.harga_total),0) AS ttl_invoice_bfr,' .
                'IFNULL(SUM(CASE WHEN pengiriman.hilang = 1 THEN 1 ELSE 0 END),0) AS ttl_paket_hilang_bfr,' .
                'IFNULL(SUM(CASE WHEN pengiriman.received_date IS NOT NULL THEN 1 ELSE 0 END),0) AS ttl_paket_terkirim_bfr'
        );
        $this->db->from('pengiriman');
        $this->db->where('MONTH(pengiriman.sent_date)', $month_bfr);
        $this->db->where('YEAR(pengiriman.sent_date)', $year_bfr);

        $data_kargo_bfr_period = $this->db->get()->row_array();

        # 3 hitung change
        $invoice_bfr = (int) $data_kargo_bfr_period['ttl_invoice_bfr'];
        $invoice_cur = (int) $data_kargo_cur_period['ttl_tarif_terbentuk'];
        $hilang_bfr = (int) $data_kargo_bfr_period['ttl_paket_hilang_bfr'];
        $hilang_cur = (int) $data_kargo_cur_period['jml_paket_hilang'];
        $received_bfr = (int) $data_kargo_bfr_period['ttl_paket_terkirim_bfr'];
        $received_cur = (int) $data_kargo_cur_period['jml_paket_terkirim'];

        /**
         * $percentage_invoice = (($invoice_cur - $invoice_bfr) / $invoice_bfr) * 100;
         * $percentage_hilang = (($hilang_cur - $hilang_bfr) / $hilang_bfr) * 100;
         * $percentage_received = (($received_cur - $received_bfr) / $received_bfr) * 100;
         * $percentage_invoice = 0;
         * $percentage_hilang = 0;
         * $percentage_received = 0;
         */
        if ($invoice_bfr == null && $hilang_bfr == null && $received_bfr == null) {
            $invoice_bfr = 0;
            $hilang_bfr = 0;
            $received_bfr = 0;
        }

        # return var
        $data = [
            'data_kargo_cur_period' => $data_kargo_cur_period,
            'data_cust_cur_period'  => $data_cust_cur_period,
            'data_kargo_bfr_period' => $data_kargo_bfr_period,
            /**
             * 
             * 'percentage_invoice'    => $percentage_invoice,
             * 'percentage_hilang'     => $percentage_hilang,
             * 'percentage_received'   => $percentage_received,
             */
            'invoice_bfr'           => $invoice_bfr,
            'invoice_cur'           => $invoice_cur,
            'hilang_bfr'            => $hilang_bfr,
            'hilang_cur'            => $hilang_cur,
            'received_brf'          => $received_bfr,
            'received_cur'          => $received_cur,
        ];

        return $data;
    }
}
