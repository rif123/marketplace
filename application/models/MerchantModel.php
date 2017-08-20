<?php

class MerchantModel extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('EncryptNative');
    }

    public function doLogin($input) {
        $query = $this->db->get_where('dk_client', array('name_client' => $input['name_client'], 'password_client' => md5($input['password_client']), 'status_client' => '2') );
        if ($query->num_rows() >= 1) {
            $data['status']  = true;
            $data['content']  = $query->result_array()[0];
        } else {
            $data['status']  = false;
            $data['content']  ='';
        }
        return $data;
    }
}
