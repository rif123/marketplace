<?php

class PromoboxModel extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('EncryptNative');
    }
    public function getPromoHorizontal($type) {
        try {
            $query = "select * from dk_promo where dk_promotion_type = '".$type."' ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

}
