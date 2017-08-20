<?php

class ProductModel extends CI_Model
{
    public function getWarung()
    {
        $result = $this->db->get('dk_warung');
        return $result->result_array();
    }
    public function getPromos(){

        $query =$this->db->query('SELECT dk_promo.dk_promotion_id,dk_promo.dk_head_title, dk_promo.dk_title_promotion FROM dk_promo');

        return $query->result_array();
    }
}
