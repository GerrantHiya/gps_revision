<?php

class Iot_Model extends CI_Model
{
    public function update_loc($armada_id, $data = "")
    {
        $condition = ['ID' => $armada_id];
        $this->db->update('armada', $data, $condition);

        if ($this->General_Model->aff_row() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
