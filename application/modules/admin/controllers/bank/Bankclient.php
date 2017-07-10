<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class bankclient extends ADMIN_Controller
{

    public function index()
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Bank Client';
        $head['description'] = '!';
        $head['keywords'] = '';
      

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        if (isset($_POST['save'])) {
           $result =$this->AdminModel->saveDataBank($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Bank is added!');
                $this->saveHistory('Create Bank user - ' . $_POST['name_bank']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Bank add!');
                $this->saveHistory('Cant add admin user');

              }

              redirect('admin/databank');
         }



        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteBank($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Bank is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Bank delete!');
            }
          redirect('admin/databank');
        }



        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getBankedit($_GET['edit']);
          }

        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateBank($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Bank is Update!');
            $this->saveHistory('Create Bank user - ' . $_POST['name_bank']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Bank Update!');
            $this->saveHistory('Cant add admin user');

          }

          redirect('admin/databank');
        }


        //TAMPIL DATA
        $data['bank'] = $this->AdminModel->getBank();
        $this->load->view('_parts/header', $head);
        $this->load->view('bank/bankclient', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
