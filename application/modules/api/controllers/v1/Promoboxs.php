<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Promoboxs extends API_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('PromoModels');
    }
    public function index()
    {
        $data = array();
        $head = array();
        $result = $this->PromoModels->getPromo();
        echo json_encode($result);
    }

}
