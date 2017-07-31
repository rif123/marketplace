<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Variant extends ADMIN_Controller
{
    private $num_rows = 2;
    private $title = 'Variant';
    public function index($page = 0)
    {
        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -'.$this->title;
        $head['description'] = '!';
        $head['keywords'] = '';
        // CONFIG FOR PAGINATION
        $data['lists'] = $this->AdminModel->getVariant($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getwarung($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/warung', $rowscount, $this->num_rows, 3);
        $data['listCategory'] = $this->AdminModel->getCategoryWarung();
        $data['listClient'] = $this->AdminModel->getClienWarung();
        $data['listkampus'] = $this->AdminModel->getKampusWarung();
        // ACTION SAVE
        if (isset($_POST['save'])) {
            $result =$this->AdminModel->saveWarung($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Warung is added!');
                $this->saveHistory('Create City  - ' . $_POST['name']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Warung add!');
                $this->saveHistory('Cant add Warung');

              }
              redirect('admin/warung');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteWarung($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('DeleteWarung id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Warungis deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Warungdelete!');
            }
          redirect('admin/warung');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getWarungEdit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateWarung($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Nama Kategory is Update!');
            $this->saveHistory('Create Warung  - ' . $_POST['name_menu_kota']);
          }else{
            $this->session->set_flashdata('result_fail', 'Problem with WarungUpdate!');
            $this->saveHistory('Cant add Warung ');
          }

          redirect('admin/warung');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('warung/index', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

    }
}
