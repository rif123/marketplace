<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Identity extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Identity';
        $head['description'] = '!';
        $head['keywords'] = '';

        // CONFIG FOR PAGINATION
        $data['identity'] = $this->AdminModel->getIdentity($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getIdentity($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/identity', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
           $result =$this->AdminModel->saveIdentity($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Identity is added!');
                $this->saveHistory('Create Identity  - ' . $_POST['name_identity']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Identity add!');
                $this->saveHistory('Cant add admin Identity');

              }

              redirect('admin/identity');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteIdentity($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Identity is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Identity delete!');
            }
          redirect('admin/identity');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getIdentityedit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateIdentity($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Identity is Update!');
            $this->saveHistory('Create Bank user - ' . $_POST['name_identity']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Identity Update!');
            $this->saveHistory('Cant add admin user');

          }

          redirect('admin/identity');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('bank/identity', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
