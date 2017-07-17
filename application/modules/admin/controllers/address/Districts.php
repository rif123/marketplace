<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Districts extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Data City';
        $head['description'] = '!';
        $head['keywords'] = '';
        //TAMPIL PROV
        // CONFIG FOR PAGINATION
        $data['city'] = $this->AdminModel->getCitys();
        $data['districts'] = $this->AdminModel->getDistricts($this->num_rows, $page, true);

        $rowscount = $this->AdminModel->getDistricts($this->num_rows, $page, false);

        $data['links_pagination'] = pagination('admin/districts', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
           $result =$this->AdminModel->saveDistricts($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Districts is added!');
                $this->saveHistory('Create Districts  - ' . $_POST['name']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Districts add!');
                $this->saveHistory('Cant add Districts');

              }

              redirect('admin/districts');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteDistricts($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete districts id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Districts is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Districts delete!');
            }
          redirect('admin/districts');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getDistrictsedit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateDistricts($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Districts is Update!');
            $this->saveHistory('Create Districts  - ' . $_POST['name']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Districts Update!');
            $this->saveHistory('Cant add Districts ');

          }

          redirect('admin/districts');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('address/districts', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
