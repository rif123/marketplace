<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class City extends ADMIN_Controller
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
        $data['prov'] = $this->AdminModel->getProvs();
        $data['city'] = $this->AdminModel->getCity($this->num_rows, $page, true);

        $rowscount = $this->AdminModel->getCity($this->num_rows, $page, false);

        $data['links_pagination'] = pagination('admin/city', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
           $result =$this->AdminModel->saveCity($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'City is added!');
                $this->saveHistory('Create City  - ' . $_POST['name']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with City add!');
                $this->saveHistory('Cant add City');

              }

              redirect('admin/city');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteCity($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete City id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'City is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with City delete!');
            }
          redirect('admin/city');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getCityedit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateCity($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'City is Update!');
            $this->saveHistory('Create City  - ' . $_POST['name']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with City Update!');
            $this->saveHistory('Cant add City ');

          }

          redirect('admin/city');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('address/city', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
