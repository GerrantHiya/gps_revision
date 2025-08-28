<?php

class Iot_Model extends CI_Model
{
    public function update_loc($armada_id, $data = "")
    {
        $this->db->update('armada');
        $this->db->set('longitude', $data['longitude']);
        $this->db->set('latitude', $data['latitude']);
        $this->db->where('ID', $armada_id);

        if ($this->General_Model->aff_row() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
