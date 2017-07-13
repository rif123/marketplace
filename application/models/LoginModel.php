<?php

class LoginModel extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
    }
    public function doInsertReg($input) {
        try {

            if($this->doCheckExistingName($input['name_client'])) {
                $input['password_client'] = $this->encrypt->encode($input['password_client']);
                $this->db->insert('dk_client', $input);
                return ($this->db->affected_rows() != 1) ? false : true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
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
