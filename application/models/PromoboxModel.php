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
    public function getPromobox($type) {
        try {
            $query = " select  dpi.id_prod  as idProd,  T.title, T.price, T.old_price, P.image  from dk_promo_items as dpi
                      LEFT JOIN dk_promo as dp on dpi.dk_promotion_id = dp.dk_promotion_id
                      LEFT JOIN translations as T on dpi.id_prod = T.id
                      LEFT JOIN products as P on T.for_id = P.id and T.type = 'product'
                      where dpi.dk_promotion_id = '".$type."'";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

}
