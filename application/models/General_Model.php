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
}
