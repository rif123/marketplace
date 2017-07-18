<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class PopulerCategory extends ADMIN_Controller
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

        $data['form'] = $this->AdminModel->getPopuler();

        // CONFIG FOR PAGINATION
        $data['populerCategory'] = $this->AdminModel->getPopulerCategory($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getPopulerCategory($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/populerCategory', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');

        // ACTION SAVE
        if (isset($_POST['save'])) {
           $result =$this->AdminModel->savePopulerCategory($_POST);
              if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Populer Category is added!');
                $this->saveHistory('Create Populer Category user - ' . $_POST['id_category']);

              }else{
                $this->session->set_flashdata('result_fail', 'Problem with Populer Category add!');
                $this->saveHistory('Cant add admin Populer Category');

              }

              redirect('admin/populerCategory');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deletePopulerCategory($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Populer Category is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Populer Categorys delete!');
            }
          redirect('admin/populerCategory');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  =$this->AdminModel->getPopulerCategoryedit($_GET['edit']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
          $result  =$this->AdminModel->updatePopulerCategory($_POST);
          if ($result ==1) {
            $this->session->set_flashdata('result_add', 'Populer category is Update!');
            $this->saveHistory('Create Populer category user - ' . $_POST['id_category']);

          }else{
            $this->session->set_flashdata('result_fail', 'Problem with Populer category Update!');
            $this->saveHistory('Cant add admin Populer category');

          }

          redirect('admin/populerCategory');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/populerCategory', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
