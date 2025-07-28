<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends MY_Controller
{
    public function create_report()
    {
        $data['title'] = 'Report';

        $input = $this->input->post('month_year');

        $exp = explode('/', $input);
        $month = $exp[0];
        $year = $exp[1];

        $ttl_tarif_terbentuk = 0;
        $ttl_tarif_dibayar = 0;
        $ttl_tarif_blm_dibayar = 0;
        $jml_paket_terkirim = 0;
        $jml_paket_hilang = 0;
        $ttl_customer = 0;

        $this->Superadmin_Model->get_kargo_all();
    }
}
