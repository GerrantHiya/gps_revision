<?php

/**
 * @property Iot_Model $Iot_Model
 * @property CI_DB_query_builder $db
 */

class Iot extends CI_Controller
{
    public function update_loc($armada_id, $longitude = "", $latitude = "")
    {
        $data = [
            'longitude' => $longitude,
            'latitude'  => $latitude,
        ];

        $this->Iot_Model->update_loc($armada_id, $data);
    }

}
