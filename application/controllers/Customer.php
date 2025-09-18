<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Controller
{
    protected $pagination_config;
    public $per_page = 10;

    public function __construct()
    {
        parent::__construct();

        $this->user = $this->session->userdata('user');

        $this->pagination_config = [
            'full_tag_open'    => '<ul class="pagination">',
            'full_tag_close'   => '</ul>',
            'first_link'       => '&laquo;',
            'first_tag_open'   => '<li class="page-item">',
            'first_tag_close'  => '</li>',
            'last_link'        => '&raquo;',
            'last_tag_open'    => '<li class="page-item">',
            'last_tag_close'   => '</li>',
            'next_link'        => '&rsaquo;',
            'next_tag_open'    => '<li class="page-item">',
            'next_tag_close'   => '</li>',
            'prev_link'        => '&lsaquo;',
            'prev_tag_open'    => '<li class="page-item">',
            'prev_tag_close'   => '</li>',
            'cur_tag_open'     => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close'    => '</span></li>',
            'num_tag_open'     => '<li class="page-item">',
            'num_tag_close'    => '</li>',
            'attributes'       => ['class' => 'page-link']
        ];
    }

    public function self_registration()
    {
        $data = [
            'title' => 'Customer - Self Registration',
        ];

        $this->form_validation->set_rules('ID', 'ID Card Number', 'required|trim|is_unique[customer.ID]');
        $this->form_validation->set_rules('NamaLengkap', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[customer.email]|is_unique[superadmin.email]');
        $this->form_validation->set_rules('pass', 'Password', 'required|trim');
        $this->form_validation->set_rules('pass2', 'Confirm Password', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Phone Number', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->load->view('customer/self-register', $data);
        } else {
            $NIK = $this->input->post('ID');
            $NamaLengkap = $this->input->post('NamaLengkap');
            $email = $this->input->post('email');
            $pass = $this->input->post('pass');
            $no_telp = $this->input->post('no_telp');

            $activation_key = $this->security2->generate_activation_key($email);

            $data_insert = [
                'NamaLengkap' => $NamaLengkap,
                'ID' => $NIK,
                'email' => $email,
                'password' => password_hash($pass, PASSWORD_BCRYPT),
                'no_telp' => $no_telp,
                'activation_key' => $activation_key
            ];

            $message =
                'Klik link berikut: <a href="' . base_url('auth/verify/' . $activation_key . '/' . urlencode($email)) . '">Link Aktivasi</a>';

            if (!$this->mailer->sendEmail('Lacak Logistik', $email, 'Customer Account Activation', $message)) {
                $this->session->set_flashdata('error', 'gagal kirim email');
                redirect('customer/registration');
            }

            if ($this->db->insert('customer', $data_insert)) {
                $this->session->set_flashdata('message-success', 'Periksa email Anda');
                redirect('');
            } else {
                $this->session->set_flashdata('error', 'Gagal proses');
                redirect('customer/registration');
            }
        }
    }

    public function registration_by_admin()
    {
        $data = [
            'title' => 'Customer Registration',
        ];

        $this->form_validation->set_rules('ID', 'ID Card Number', 'required|trim|is_unique[customer.ID]');
        $this->form_validation->set_rules('NamaLengkap', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[customer.email]|is_unique[superadmin.email]');
        $this->form_validation->set_rules('no_telp', 'Phone Number', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->load_template('customer/register-by-admin', $data);
        } else {
            $NIK = $this->input->post('ID');
            $NamaLengkap = $this->input->post('NamaLengkap');
            $email = $this->input->post('email');
            $no_telp = $this->input->post('no_telp');

            $data_insert = [
                'NamaLengkap' => $NamaLengkap,
                'ID' => $NIK,
                'email' => $email,
                'no_telp' => $no_telp,
                'password' => password_hash($email, PASSWORD_BCRYPT),
                'active' => '1',
            ];

            if ($this->db->insert('customer', $data_insert)) {
                $this->session->set_flashdata('message-success', 'Berhasil disimpan, Akun Aktif');
                redirect('customer/reg-by-admin');
            } else {
                $this->session->set_flashdata('error', 'Gagal proses');
                redirect('customer/reg-by-admin');
            }
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'user' => $this->user,
            'total_hutang' => $this->Customer_Model->hitung_tunggakan($this->user['ID']),
        ];

        $this->load_template('customer/dashboard', $data);
    }

    public function history_pengiriman($offset = 0)
    {
        $data = [
            'title' => 'Lacak Pengiriman',
            'user' => $this->user,
            'histori' => $this->Customer_Model->get_pengiriman($this->user['ID'], $this->per_page, $offset),
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('customer/lacak-pengiriman');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Customer_Model->get_pengiriman($this->user['ID']));

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->load_template('customer/histori-pengiriman', $data);
    }

    public function lacak_barang($resi = "")
    {
        if (empty($resi)) redirect('customer/lacak-pengiriman');

        $data = [
            'title' => 'Lacak Pengiriman',
            'user' => $this->user,
            'resi_md5' => $resi,
            'is_peta' => true,
        ];

        $data_paket = $this->Superadmin_Model->get_paket($resi);
        $data_armada = $this->Superadmin_Model->armada_md5(md5($data_paket['armada_ID']));

        $data['paket'] = $data_paket;
        $data['armada'] = $data_armada;

        $this->load_template('customer/peta', $data);
    }

    public function list_tagihan($offset = 0)
    {
        $data = [
            'title' => 'Tagihan Pembayaran',
            'user' => $this->user,
            'daftar_pengiriman' => $this->Customer_Model->get_pengiriman($this->user['ID'], $this->per_page, $offset),
        ];

        $config = $this->pagination_config;
        $config['base_url'] = base_url('customer/daftar-tagihan');
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = count($this->Customer_Model->get_pengiriman($this->user['ID']));

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $this->load_template('customer/list-tagihan', $data);
    }

    public function view_pricelist()
    {
        $data = [
            'title' => 'Pricelist',
        ];

        $this->load_template('customer/pricelist', $data);
    }
}
