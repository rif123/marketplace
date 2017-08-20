<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Orders extends ADMIN_Controller
{

    private $num_rows = 10;
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('OrderModel');

    }

    public function index($page = 0)
    {
        $this->login_check();
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Orders';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data = $this->input->get(null, true);
        $data['listOrder'] = $this->OrderModel->getListOrder($data);


        $data['links_pagination'] = "";
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/orders', $data);
        $this->load->view('_parts/footer');
        if ($page == 0) {
            $this->saveHistory('Go to orders page');
        }
    }

    public function changeOrdersOrderStatus()
    {
        $this->login_check();
        $all  = $this->input->post(null, true);
        $result = $this->OrderModel->changeOrderStatus($all);
        $respons['status'] = true;
        echo json_encode($respons);die;
    }

}
