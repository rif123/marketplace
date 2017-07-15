<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{

    private $num_rows = 20;
    private $parser = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('LoginModel');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function detail() {
        echo "Detail Product";die;
    }

}
