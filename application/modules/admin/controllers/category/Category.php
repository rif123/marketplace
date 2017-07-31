<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Category extends ADMIN_Controller
{
    private $num_rows = 10;
    public function index($page = 0)
    {
        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Menu Kota';
        $head['description'] = '!';
        $head['keywords'] = '';
        //TAMPIL PROV
        // CONFIG FOR PAGINATION
        $data['listCategory'] = $this->AdminModel->getCategoryNew($this->num_rows, $page, true);

        $rowscount = $this->AdminModel->getCategoryNew($this->num_rows, $page, false);

        $data['links_pagination'] = pagination('admin/category', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
            $result =$this->AdminModel->saveCategory($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Category is added!');
                $this->saveHistory('Create City  - ' . $_POST['name']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Menu Kota add!');
                $this->saveHistory('Cant add Menu Kota');

              }

              redirect('admin/category');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteCategory($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete Menu Kota id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Category is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Category delete!');
            }
          redirect('admin/category');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getCategoryEdit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateCategory($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Categoryis Update!');
            $this->saveHistory('Create Category - ' . $_POST['name_menu_kota']);
          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Category Update!');
            $this->saveHistory('Cant add Category');
          }

          redirect('admin/category');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('category/index', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

    }
}
