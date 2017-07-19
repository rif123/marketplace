<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Config extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Config';
        $head['description'] = '!';
        $head['keywords'] = '';

        // CONFIG FOR PAGINATION
        $data['config'] = $this->AdminModel->getConfig($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getConfig($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/config', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
          // upload file
          $config['upload_path'] = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          if (!$this->upload->do_upload('logofile_config')) {
              log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
          }
          $img = $this->upload->data();
          if ($img['file_name'] != null) {
              $_POST['image'] = $img['file_name'];
          } else {
              $this->session->set_flashdata('result_add', 'Image cannot Upload');
          }
          if (!$this->upload->do_upload('cc_config')) {
              log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
          }
          $img = $this->upload->data();
          if ($img['file_name'] != null) {
              $_POST['cc_config'] = $img['file_name'];
          } else {
              $this->session->set_flashdata('result_add', 'Image cannot Upload');
          }
          if (!$this->upload->do_upload('favicon_config')) {
              log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
          }
          $img = $this->upload->data();
          if ($img['file_name'] != null) {
              $_POST['favicon_config'] = $img['file_name'];
          } else {
              $this->session->set_flashdata('result_add', 'Image cannot Upload');
          }

          $_POST['logo_fb_config'] = 'fa fa-facebook';
          $_POST['logo_twit_config'] = 'fa fa-twitter';
          $_POST['logo_gp_config'] = 'fa fa-google-plus';
          $_POST['logo_li_config'] = 'fa fa-linkedin';
          $_POST['logo_skype_config'] = 'fa fa-skype';

           $result =$this->AdminModel->saveConfig($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Config is added!');
                $this->saveHistory('Create Bank user - ' . $_POST['name_bank']);

              }else{
                $this->session->set_flashdata('result_fail', 'Config with Bank add!');
                $this->saveHistory('Cant add admin user');

              }

              redirect('admin/config');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getConfigedit($_GET['edit']);
        }


        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/config', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
