<?php

class PartnerModel extends CI_Model
{


    public function getPartner() {
        try {
            $query = "select * from dk_partner";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

}
