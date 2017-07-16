<?php

class ProductModel extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('EncryptNative');
    }
    public function getPopularCategori() {
        try {
            $query = "select * from dk_popular_categories as dpc
                    LEFT JOIN translations as T on dpc.id_category = T.id and T.type = 'shop_categorie'";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getPartner() {
        try {
            $allData = $this->db->get('dk_partner')->result_array();
            return $allData;
        } catch (Exception $e) {
            return [];
        }
    }
    public function doSubscribed($subscribed) {
        try {
            $checkEmail = $this->db->get_where('dk_subscribed', array('email_subscribed' => $subscribed['subscribed']))->num_rows();
            if($checkEmail <= 0 ){
                $datainsert = [
                    'email_subscribed' =>$subscribed['subscribed'],
                    'creator' =>$subscribed['subscribed'],
                    'created' =>date('Y-m-d H:i:s')
                ];
                $allData = $this->db->insert('dk_subscribed',$datainsert);
            }
        } catch (Exception $e) {
            return [];
        }
    }

}
