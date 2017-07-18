<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Subscribed extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Subscribed';
        $head['description'] = '!';
        $head['keywords'] = '';


        // CONFIG FOR PAGINATION
        $data['subscribed'] = $this->AdminModel->getSubscribed($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getSubscribed($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/populerCategory', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');


        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteSubscribed($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', ' Subscribed is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Subscribed delete!');
            }
          redirect('admin/subscribed');
        }



        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/subscribed', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
