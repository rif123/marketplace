<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Category extends API_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('CategoryModels');
    }
    public function index()
    {
        $data = array();
        $head = array();
        $result = $this->CategoryModels->getCategory();
        echo json_encode($result);
    }

}
