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

    /**
     * Export Monthly Report to PDF
     * @param int $report_id ID of the report to export
     */
    public function export_pdf($report_id = '')
    {
        if (empty($report_id)) {
            redirect('superadmin/monthly-report');
        }

        // Get report data
        $report = $this->Superadmin_Model->get_report_by_id($report_id);

        if (empty($report)) {
            $this->session->set_flashdata('error', 'Laporan tidak ditemukan');
            redirect('superadmin/monthly-report');
        }

        // Get month name
        $month_names = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $month_name = $month_names[(int)$report['bulan']] ?? '';

        $data = [
            'report' => $report,
            'month_name' => $month_name
        ];

        // Load PDF library and generate
        $this->load->library('pdf');
        $filename = 'Laporan_' . $month_name . '_' . $report['tahun'] . '.pdf';

        $this->pdf->load('pdf/monthly_report_pdf', $data, 'A4', 'portrait')
                  ->stream($filename, true);
    }
}
