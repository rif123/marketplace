<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Promo extends ADMIN_Controller
{
    private $num_rows = 10;
    public function index($page=0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Promo';
        $head['description'] = '!';
        $head['keywords'] = '';

    //     // CONFIG FOR PAGINATION
    // $data['bankclient'] = $this->AdminModel->getBankClient($this->num_rows, $page, true);
    // $rowscount = $this->AdminModel->getBankClient($this->num_rows, $page, false);
    // $data['links_pagination'] = pagination('admin/promo', $rowscount, $this->num_rows, 3);




        //TAMPIL DATA

        $this->load->view('_parts/header', $head);
        $this->load->view('promo/promo', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
