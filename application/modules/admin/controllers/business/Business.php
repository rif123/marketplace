<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Business extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Type Business';
        $head['description'] = '!';
        $head['keywords'] = '';

        // CONFIG FOR PAGINATION
        $data['business'] = $this->AdminModel->getBusiness($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getBusiness($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/business', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
           $result =$this->AdminModel->saveBusiness($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Business is added!');
                $this->saveHistory('Create Business - ' . $_POST['name_type_business']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Business add!');
                $this->saveHistory('Cant add admin user');

              }

              redirect('admin/business');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteBusiness($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Business is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Business delete!');
            }
          redirect('admin/business');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getBusinessedit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateBusiness($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Business is Update!');
            $this->saveHistory('Create Business user - ' . $_POST['name_type_business']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Business Update!');
            $this->saveHistory('Cant add admin user');

          }

          redirect('admin/business');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('business/business', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
