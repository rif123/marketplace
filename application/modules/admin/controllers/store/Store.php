<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Store extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Store';
        $head['description'] = '!';
        $head['keywords'] = '';
        //DATA BANK

        // CONFIG FOR PAGINATION
        $data['store'] = $this->AdminModel->getStore($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getStore($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/store', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        // if (isset($_POST['save'])) {
        //    $result =$this->AdminModel->saveDataBank($_POST);
        //       if ($result ==1) {
        //         $this->session->set_flashdata('result_add', 'Bank is added!');
        //         $this->saveHistory('Create Bank user - ' . $_POST['name_bank']);
        //
        //       }else{
        //         $this->session->set_flashdata('result_fail', 'Problem with Bank add!');
        //         $this->saveHistory('Cant add admin user');
        //
        //       }
        //
        //       redirect('admin/databank');
        // }

        // ACTION DELETE
        // if (isset($_GET['delete'])) {
        //   $result = $this->AdminModel->deleteBank($_GET['delete']);
        //     if ($result == true) {
        //         $this->saveHistory('Delete user id - ' . $_GET['delete']);
        //         $this->session->set_flashdata('result_delete', 'Bank is deleted!');
        //     } else {
        //         $this->session->set_flashdata('result_delete', 'Problem with Bank delete!');
        //     }
        //   redirect('admin/databank');
        // }


        // ACTION SHOW FOR EDIT
        // if (isset($_GET['edit'])) {
        //     $data['edit']  =$this->AdminModel->getBankedit($_GET['edit']);
        // }

        // ACTION UPDATE
        // if (isset($_POST['update'])) {
        //   $result  =$this->AdminModel->updateBank($_POST);
        //   if ($result ==1) {
        //     $this->session->set_flashdata('result_add', 'Bank is Update!');
        //     $this->saveHistory('Create Bank user - ' . $_POST['name_bank']);
        //
        //   }else{
        //     $this->session->set_flashdata('result_fail', 'Problem with Bank Update!');
        //     $this->saveHistory('Cant add admin user');
        //
        //   }
        //
        //   redirect('admin/databank');
        // }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('store/store', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
