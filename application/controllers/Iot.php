<?php

/**
 * @property Iot_Model $Iot_Model
 * @property CI_DB_query_builder $db
 */

class Iot extends CI_Controller
{
    public function update_loc($armada_id, $longitude = "", $latitude = "")
    {
        $created_at = date('Y-m-d H:i:s');
        $data = [
            'longitude' => $longitude,
            'latitude'  => $latitude,
        ];

        $this->Iot_Model->update_loc($armada_id, $data);

        $data_insert = [
            'longitude' => $longitude,
            'latitude'  => $latitude,
            'created_at' => $created_at,
            'armada_ID' => $armada_id,
        ];
        
        // cari apakah timestamp berulang:
        // $this->db->select('*');
        // $this->db->from('loc_hist');
        // $this->db->where('armada_ID', $armada_id);
        // $this->db->where('created_at', $armada_id);
        
        // if (empty($this->db->get()->row_array())) {
        // }
        $this->db->insert('loc_hist', $data_insert);
    }
}
