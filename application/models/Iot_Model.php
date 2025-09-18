<?php

class Iot_Model extends CI_Model
{
    public function update_loc($armada_id, $data = "")
    {
        $condition = ['ID' => $armada_id];
        $this->db->update('armada', $data, $condition);

        $data_2 = [
            'armada_ID' => $armada_id,
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('loc_hist', $data_2);

        if ($this->General_Model->aff_row() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_loc_hist($plat_nomor)
    {
        $this->db->select(
            'armada.longitude AS longitude,' .
                'armada.latitude AS latitude,' .
                'loc_hist.created_at AS created_at'
        );
        $this->db->from('armada');
        $this->db->join('loc_hist', 'armada.ID = loc_hist.armada_ID', 'left');
        $this->db->where('armada.longitude = loc_hist.longitude');
        $this->db->where('armada.latitude = loc_hist.latitude');
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }
}
