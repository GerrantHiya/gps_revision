<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{
    public function create_report()
    {
        $data['title'] = 'Report';

        // $input = $this->input->post('month_year');
        $input = '06/2025';

        $data = $this->Report_Model->monthly_report($input);

        var_dump($data);

        $ttl_tarif_terbentuk = $data['data_kargo_cur_period']['ttl_tarif_terbentuk'];
        $ttl_tarif_dibayar = $data['data_kargo_cur_period']['ttl_tarif_dibayar'];
        $ttl_tarif_blm_dibayar = $data['data_kargo_cur_period']['ttl_tarif_blm_dibayar'];
        $jml_paket_terkirim = $data['data_kargo_cur_period']['jml_paket_terkirim'];
        $jml_paket_hilang = $data['data_kargo_cur_period']['jml_paket_hilang'];
        $ttl_customer = $data['data_cust_cur_period']['ttl_customer'];
    }
}
