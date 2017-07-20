<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Wishlist extends ADMIN_Controller
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
        $data['wishlist'] = $this->AdminModel->getWishlist($this->num_rows, $page, true);
        $rowscount = $this->AdminModel->getWishlist($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/subscribed', $rowscount, $this->num_rows, 3);

        // $this->form_validation->set_rules('name_bank', 'User', 'trim|required');



        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/wishlist', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}
