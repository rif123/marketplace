<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Databank extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Data Bank';
        $head['description'] = '!';
        $head['keywords'] = '';

        // CONFIG FOR PAGINATION
        $data['bank'] = $this->AdminModel->getBank($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getBank($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/databank', $rowscount, $this->num_rows, 3);
        // ACTION SAVE
        if (isset($_POST['save'])){
            if (!empty($_FILES['filetransfer']['name'])) {
                $config['upload_path'] = './attachments/shop_images/';
                $config['allowed_types'] = $this->allowed_img_types;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image_bank')) {
                    log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
                }
                $img = $this->upload->data();
                if ($img['file_name'] != null) {
                    $_POST['image'] = $img['file_name'];
                }
            }
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

        // ACTION DELETE
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


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getBankedit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
            if (!empty($_FILES['image_bank']['name'])) {
                $config['upload_path'] = './attachments/shop_images/';
                $config['allowed_types'] = $this->allowed_img_types;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image_bank')) {
                    log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
                }
                $img = $this->upload->data();
                if ($img['file_name'] != null) {
                    $_POST['image'] = $img['file_name'];
                }
            }
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
        $this->load->view('_parts/header', $head);
        $this->load->view('bank/databank', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
