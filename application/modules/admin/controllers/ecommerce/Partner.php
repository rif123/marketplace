<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Partner extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Partner';
        $head['description'] = '!';
        $head['keywords'] = '';

        // CONFIG FOR PAGINATION
        $data['partner'] = $this->AdminModel->getPartner($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getPartner($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/partner', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
          $config['upload_path'] = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'partner' . DIRECTORY_SEPARATOR;
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          if (!$this->upload->do_upload('img_partner')) {
              log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
          }
          $img = $this->upload->data();
          if ($img['file_name'] != null) {
              $_POST['img_partner'] = $img['file_name'];
          } else {
              $this->session->set_flashdata('result_add', 'Image cannot Upload');
          }
           $result =$this->AdminModel->savePartner($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Partner is added!');
                $this->saveHistory('Create Partner - ' . $_POST['name_partner']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Partner add!');
                $this->saveHistory('Cant add admin Partner');

              }

              redirect('admin/partner');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deletePartner($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Partner is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Partner delete!');
            }
          redirect('admin/partner');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getPartneredit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $config['upload_path'] = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'partner' . DIRECTORY_SEPARATOR;
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          if (!$this->upload->do_upload('img_partner')) {
              log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
          }
          $img = $this->upload->data();
          if ($img['file_name'] != null) {
              $_POST['img_partner'] = $img['file_name'];
          } else {
              $this->session->set_flashdata('result_add', 'Image cannot Upload');
          }
          $result  =$this->AdminModel->updatePartner($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Partner is Update!');
            $this->saveHistory('Create Partner  - ' . $_POST['name_partner']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Partner Update!');
            $this->saveHistory('Cant add admin Partner');

          }

          redirect('admin/partner');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/partner', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
