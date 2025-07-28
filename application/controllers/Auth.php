<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Superadmin_Model $Superadmin_Model
 * @property Customer_Model $Customer_Model
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property Security2 $security2
 */

class Auth extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Login Account';

        $this->form_validation->set_rules('username', 'Username / Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('login', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->_login($username, $password);

            if (!empty($user)) {
                $this->session->set_userdata([
                    'user' => $user['data'],
                    'role' => $user['role'],
                    'is_login' => true,
                ]);
                redirect($user['role']);
            } else {
                $this->session->set_flashdata('message', 'Username atau password salah.');
                redirect('auth');
            }
        }
    }

    private function _login($userid, $pass)
    {
        $superadmin = $this->Superadmin_Model->get_superadmin($userid);
        $customer = $this->Customer_Model->get_customer($userid);

        if (!empty($superadmin) && password_verify($pass, $superadmin['password'])) {
            // superadmin
            return [
                'data' => $superadmin,
                'role' => 'superadmin'
            ];
        } else if (!empty($customer) && password_verify($pass, $customer['password'])) {
            // customer
            if ($customer['active'] == 1) {
                return [
                    'data' => $customer,
                    'role' => 'customer'
                ];
            } else {
                $this->session->set_flashdata('message', 'Akun belum aktif.');
                redirect('auth');
            }
        }
        return null;
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('is_login');
        redirect('auth');
    }

    public function verification($activation_key = '', $email_url = '')
    {
        $email = urldecode($email_url);

        if ($this->security2->verify_activation_key($email, $activation_key) == true) {
            $condition = ['email' => $email];
            $this->db->update('customer', ['active' => 1], $condition);
            $this->session->set_flashdata('message-success', 'Akun Berhasil Aktif');
        } else {
            $this->session->set_flashdata('message', 'Link Registrasi Tidak Valid');
        }

        redirect('auth');
    }
}
