<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Riview extends ADMIN_Controller
{

    private $num_rows = 10;

    public function index($page = 0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Riview';
        $head['description'] = '!';
        $head['keywords'] = '';


        // CONFIG FOR PAGINATION
        $data['review'] = $this->AdminModel->getRiview($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getRiview($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/riview', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');


        // ACTION DELETE
        if (isset($_GET['delete'])) {
          $result = $this->AdminModel->deleteReview($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', ' Review is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Review delete!');
            }
          redirect('admin/riview');
        }



        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/riview', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
