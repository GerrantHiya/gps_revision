<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{
    public function create_report()
    {
        $input = $this->input->post('month_year');
        // $input = '06/2025';

        $exp = explode('/', $input);
        $month = $exp[0];
        $year = $exp[1];

        $data = $this->Report_Model->monthly_report($input);

        // var_dump($data);

        $ttl_tarif_terbentuk = $data['data_kargo_cur_period']['ttl_tarif_terbentuk'];
        $ttl_tarif_dibayar = $data['data_kargo_cur_period']['ttl_tarif_dibayar'];
        $ttl_tarif_blm_dibayar = $data['data_kargo_cur_period']['ttl_tarif_blm_dibayar'];
        $jml_paket_terkirim = $data['data_kargo_cur_period']['jml_paket_terkirim'];
        $jml_paket_hilang = $data['data_kargo_cur_period']['jml_paket_hilang'];
        $ttl_customer = $data['data_cust_cur_period']['ttl_customer'];
        $ttl_invoice_bfr = $data['invoice_bfr'];
        $ttl_paket_hilang_bfr = $data['hilang_bfr'];

        $data = [
            'created_at'            => date('Y-m-d'),
            'bulan'                 => $month,
            'tahun'                 => $year,
            'ttl_tarif_terbentuk'   => $ttl_tarif_terbentuk,
            'ttl_tarif_dibayar'     => $ttl_tarif_dibayar,
            'ttl_tarif_blm_dibayar' => $ttl_tarif_blm_dibayar,
            'jml_paket_terkirim'    => $jml_paket_terkirim,
            'jml_paket_hilang'      => $jml_paket_hilang,
            'ttl_customer'          => $ttl_customer,
            'ttl_invoice_bfr'       => $ttl_invoice_bfr,
            'ttl_paket_hilang_bfr'  => $ttl_paket_hilang_bfr,
        ];

        $this->db->insert('monthly_report', $data);

        redirect('superadmin/monthly-report');
    }
}
