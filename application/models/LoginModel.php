<?php

class LoginModel extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('EncryptNative');
    }
    public function doInsertReg($input) {
        try {

            if($this->doCheckExistingName($input['name_client'])) {
                $inputp['status_client'] = 1;
                $input['password_client'] = md5($input['password_client']);
                $this->db->insert('dk_client', $input);
                return ($this->db->affected_rows() != 1) ? false : true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function doLogin($input) {

        $query = $this->db->get_where('dk_client', array('name_client' => $input['name_client'], 'password_client' => md5($input['password_client'])));
        if ($query->num_rows() >= 1) {
            $data['status']  = true;
            $data['content']  = $query->row();
        } else {
            $data['status']  = false;
            $data['content']  ='';
        }
        return $data;
    }

    public function doCheckExistingName($name_client) {
        $query = $this->db->query("select * from dk_client where name_client = '".$name_client."'");
        if ($query->num_rows() <= 0) {
            return true;
        } else {
            return false;
        }
    }


}
