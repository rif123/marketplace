<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Client extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Data Client';
        $head['description'] = '!';
        $head['keywords'] = '';

        // CONFIG FOR PAGINATION
        $data['client'] = $this->AdminModel->getClient($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getClient($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/client', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {

           $result =$this->AdminModel->saveClient($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Data Client is added!');
                $this->saveHistory('Create Bank user - ' . $_POST['name_client']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Data Client add!');
                $this->saveHistory('Cant add admin Data Client');

              }

              redirect('admin/client');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteClient($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Data Client is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Data Client delete!');
            }
          redirect('admin/client');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getClientedit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateClient($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Data Client is Update!');
            $this->saveHistory('Create Dat Client user - ' . $_POST['name_client']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Data Client Update!');
            $this->saveHistory('Cant add admin Data Client');

          }

          redirect('admin/client');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('client/client', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
