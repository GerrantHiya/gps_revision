<?php
defined('BASEPATH') or exit('No direct script access allowed');

class General_Model extends CI_Model
{
    public function aff_row()
    {
        return $this->db->affected_rows();
    }

    public function hitung_row($table_name)
    {
        return $this->db->count_all($table_name);
    }

    public function kota_terdaftar()
    {
        $this->db->select('DISTINCT(kota_tujuan) as kota_tujuan');
        $this->db->from('pengiriman');
        $this->db->order_by('kota_tujuan', 'asc');

        return $this->db->get()->result_array();
    }

    public function get_pin()
    {
        $this->db->select('*');
        $this->db->from('auth_pin');
        $this->db->where('is_used = 0');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function check_pin($pin = '')
    {
        $this->db->select('*');
        $this->db->from('auth_pin');
        $this->db->where('is_used = 0');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        $value = $this->db->get()->row_array();

        if ($value['pin'] == $pin) {
            $set = ['is_used' => 1];
            $condition = ['id' => $value['id']];
            $this->db->update('auth_pin', $set, $condition);
            return true;
        } else {
            return false;
        }
    }
}
