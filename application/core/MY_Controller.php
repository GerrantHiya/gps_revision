<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Superadmin_Model $Superadmin_Model
 * @property Customer_Model $Customer_Model
 * @property General_Model $General_Model
 * @property rajaongkir $rajaongkir
 * @property zipcodebase $zipcodebase
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property CI_Pagination $pagination
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property Mailer $mailer
 * @property Security2 $security2
 */

class MY_Controller extends CI_Controller
{
    public $user;

    public function __construct()
    {
        parent::__construct();

        // Daftar pola URI yang boleh diakses tanpa login (pakai regex)
        $whitelist_patterns = [
            '^customer/registration$',
            '^customer/reg-by-admin$',
            '^auth/verify(?:/[^/]+){0,2}$',
            '^pricelist$',
        ];

        $current_uri = strtolower($this->uri->uri_string());

        $allowed = false;
        foreach ($whitelist_patterns as $pattern) {
            if (preg_match('#' . $pattern . '#', $current_uri)) {
                $allowed = true;
                break;
            }
        }

        if (!$this->session->userdata('is_login') && !$allowed) {
            redirect('auth/');
        }
    }

    protected function load_template($view, $data = [])
    {
        // Load template standar
        $this->load->view('sb_admin/header', $data);
        $this->load->view($view);
        $this->load->view('sb_admin/footer');
    }

    public function verification($activation_key = '') {}
}
