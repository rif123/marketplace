<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Merchant extends ADMIN_Controller
{
    private $num_rows = 7;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('MerchantModel');

        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index($page = 0)
    {
        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Menu Kota';
        $head['description'] = '!';
        $head['keywords'] = '';
        // CONFIG FOR PAGINATION
        $data['lists'] = $this->MerchantModel->listMerchant($this->num_rows, $page, true);
        $rowscount = $this->MerchantModel->listMerchant($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/merchant', $rowscount, $this->num_rows, 3);

        $data['listCategory'] = $this->AdminModel->getCategoryWarung();
        $data['listClient'] = $this->AdminModel->getClienWarung();
        $data['listkampus'] = $this->AdminModel->getKampusWarung();
        // ACTION SAVE
        if (isset($_POST['save'])) {
            $result =$this->AdminModel->saveWarung($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Merchant is added!');
                $this->saveHistory('Create City  - ' . $_POST['name']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Merchant add!');
                $this->saveHistory('Cant add Merchant');

              }
              redirect('admin/merchant');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->MerchantModel->merchantDelete($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('DeleteWarung id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Merchant is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Merchant delete!');
            }
          redirect('admin/merchant');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->MerchantModel->getMerchantEdit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $input = $this->input->post(null, true);
          $result  =$this->MerchantModel->merchantUpdate($input);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Nama Kategory is Update!');
            $this->saveHistory('Create Warung  - ' . $_POST['name_menu_kota']);
          }else{
            $this->session->set_flashdata('result_fail', 'Problem with WarungUpdate!');
            $this->saveHistory('Cant add Warung ');
          }

          redirect('admin/merchant');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('merchant/index', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

    }
}
