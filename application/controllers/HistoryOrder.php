<?php

defined('BASEPATH') or exit('No direct script access allowed');

class HistoryOrder extends MY_Controller
{
    private $num_rows = 10;
    private $parser = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('ProductModel');
        $this->load->Model('ConfigModel');
        $this->load->Model('HistoryModel');

        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function order() {
        $parser['partner'] = $this->ProductModel->getPartner();
        $parser['home_categories'] = $this->ProductModel->getSearch();
        $parser['config'] = $this->ConfigModel->getConfig();
        $parser['listHistory'] = $this->HistoryModel->getListOrder();
        $this->load->view('templates/blanja/historyOrder', $parser);
    }

}
