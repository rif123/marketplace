<?php

class ConfigModel extends CI_Model
{


    public function getConfig() {
        try {
            $query = "select * from dk_config";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

}
