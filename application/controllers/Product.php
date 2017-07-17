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
        $this->load->Model('ProductModel');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function category() {
        echo "per category";die;
    }

    public function globalSearch() {
        print_R($_GET);die;
    }

    public function detail() {
        echo "Detail Product";die;
    }
    public function doSend() {
        $input = $this->input->post();
        $this->ProductModel->doSubscribed($input);
        redirect('/');
    }

}
