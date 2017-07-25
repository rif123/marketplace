<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MenuKampus extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Menu Kampus';
        $head['description'] = '!';
        $head['keywords'] = '';
        //TAMPIL PROV
        // CONFIG FOR PAGINATION
        $data['menuKota'] = $this->AdminModel->getMenuKotas();
        $data['menuKampus'] = $this->AdminModel->getMenuKampus($this->num_rows, $page, true);

        $rowscount = $this->AdminModel->getMenuKampus($this->num_rows, $page, false);

        $data['links_pagination'] = pagination('admin/MenuKampus', $rowscount, $this->num_rows, 3);


        // ACTION SAVE
        if (isset($_POST['save'])) {
           $result =$this->AdminModel->saveMenuKampus($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Menu Kampus is added!');
                $this->saveHistory('Create Menu Kampus  - ' . $_POST['name_menu_kampus']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Menu Kampus add!');
                $this->saveHistory('Cant add Menu Kampus');

              }

              redirect('admin/menuKampus');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteMenuKampus($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete Menu Kampus id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Menu Kampus is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Menu Kampus delete!');
            }
          redirect('admin/menuKampus');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getMenuKampusedit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updateMenuKampus($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Menu Kampus is Update!');
            $this->saveHistory('Create Menu Kampus  - ' . $_POST['name_menu_kampus']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Menu Kampus Update!');
            $this->saveHistory('Cant add Menu Kampus ');

          }

          redirect('admin/menuKampus');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('menu/menuKampus', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
