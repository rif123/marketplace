<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MenuKota extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Menu Kota';
        $head['description'] = '!';
        $head['keywords'] = '';
        //TAMPIL PROV
        // CONFIG FOR PAGINATION

        $data['menuKota'] = $this->AdminModel->getMenuKota($this->num_rows, $page, true);

        $rowscount = $this->AdminModel->getMenuKota($this->num_rows, $page, false);

        $data['links_pagination'] = pagination('admin/menuKota', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
           $result =$this->AdminModel->saveMenuKota($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Menu Kota is added!');
                $this->saveHistory('Create City  - ' . $_POST['name']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Menu Kota add!');
                $this->saveHistory('Cant add Menu Kota');

              }

              redirect('admin/menuKota');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteMenuKota($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete Menu Kota id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Menu Kota is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Menu Kota delete!');
            }
          redirect('admin/menuKota');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getMenuKotadit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateMenuKota($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Menu Kota is Update!');
            $this->saveHistory('Create Menu Kota  - ' . $_POST['name_menu_kota']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Menu Kota Update!');
            $this->saveHistory('Cant add Menu Kota ');

          }

          redirect('admin/menuKota');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('menu/menuKota', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
