<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Prov extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Data Provinces';
        $head['description'] = '!';
        $head['keywords'] = '';

        // CONFIG FOR PAGINATION
        $data['prov'] = $this->AdminModel->getProv($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getProv($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/prov', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
           $result =$this->AdminModel->saveProv($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Provinces is added!');
                $this->saveHistory('Create Provinces  - ' . $_POST['name']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Provinces add!');
                $this->saveHistory('Cant add Provinces');

              }

              redirect('admin/prov');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteProv($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete Provinces id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Provinces is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Provinces delete!');
            }
          redirect('admin/prov');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getProvedit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateProv($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Provinces is Update!');
            $this->saveHistory('Create Provinces user - ' . $_POST['name']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Provinces Update!');
            $this->saveHistory('Cant add Provinces ');

          }

          redirect('admin/prov');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('address/prov', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
