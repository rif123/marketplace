<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AdminMerchant extends ADMIN_Controller
{
    private $num_rows = 7;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('MerchantModel');
        $this->load->Model('ProductModel');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index($id = 0)
    {
        $this->login_check();
        $is_update = false;
        $trans_load = null;
        if ($id > 0 && $_POST == null) {
            $trans_load = $this->AdminModel->getProductOne($id);
        }
        if (isset($_GET['delete'])) {
            $result = $this->MerchantModel->deleteproduct($_GET['delete']);
            if ($result == true) {
                $this->session->set_flashdata('result_delete', 'product is deleted!');
                $this->saveHistory('Delete product id - ' . $_GET['delete']);
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with product delete!');
            }
            redirect('admin/prod-list-merchant');
        }

        if (isset($_POST['submit'])) {
            if ($id > 0) {
                $is_update = true;
            }
            unset($_POST['submit']);
            $config['upload_path'] = './attachments/shop_images/';
            $config['allowed_types'] = $this->allowed_img_types;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) {
                log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
            }
            $img = $this->upload->data();
            if ($img['file_name'    ] != null) {
                $_POST['image'] = $img['file_name'];
            }
            if (isset($_GET['to_lang'])) {
                $id = 0;
            }
            if ($is_update) {
                $result = $this->MerchantModel->updateProduct($_POST, $id);
                $this->AdminModel->updateUploadProd($_POST, $id);
                if ( $result ==1 ) {
                    $this->session->set_flashdata('result_add', $this->title.' is added!');
                    $this->saveHistory('Create City  - ' . $_POST['name']);
                } else {
                    $this->session->set_flashdata('result_fail', 'Problem with '. $this->title.' add!');
                    $this->saveHistory('Cant add '.$this->title);

                }
                redirect('admin/prod-list-merchant');
            } else {
                $post = $this->input->post(null, true);
                $result = $this->MerchantModel->saveProduct($post);
                $this->MerchantModel->saveUploadProd($_POST, $result);
                $this->session->set_flashdata('result_add',$this->title. ' is added!');
                $this->saveHistory('Create City  - ' . $_POST['name']);
                  redirect('admin/prod-merchant');
            }
        }
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Publish Product';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['id'] = $id;
        $data['trans_load'] = $trans_load;
        $data['languages'] = $this->AdminModel->getLanguages();
        $data['shop_categories'] = $this->AdminModel->getCategoryWarung();
        $data['brands'] = $this->AdminModel->getBrands();
        $data['otherImgs'] = $this->AdminModel->getImageProd($id);
        $data['listWarung'] = $this->ProductModel->getWarung();
        // echo "<pre>";
        // print_R($data['getWarung']);die;
        $this->load->view('_parts/header', $head);
        $this->load->view('adminMerchant/product', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to publish product');
    }
    public function listProdMerchant($page=0) {
        $this->login_check();
        $this->saveHistory('Go to products');
        if (isset($_GET['delete'])) {
            $result = $this->AdminModel->deleteproduct($_GET['delete']);
            if ($result == true) {
                $this->session->set_flashdata('result_delete', 'product is deleted!');
                $this->saveHistory('Delete product id - ' . $_GET['delete']);
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with product delete!');
            }
            redirect('admin/products');
        }
        $data = array();
        $head = array();
        $head['title'] = 'Administration - View products';
        $head['description'] = '!';
        $head['keywords'] = '';
        unset($_SESSION['filter']);
        $search_title = null;
        if ($this->input->get('search_title') !== NULL) {
            $search_title = $this->input->get('search_title');
            $_SESSION['filter']['search_title'] = $search_title;
            $this->saveHistory('Search for product title - ' . $search_title);
        }
        $orderby = null;
        if ($this->input->get('order_by') !== NULL) {
            $orderby = $this->input->get('order_by');
            $_SESSION['filter']['order_by '] = $orderby;
        }
        $category = null;
        if ($this->input->get('category') !== NULL) {
            $category = $this->input->get('category');
            $_SESSION['filter']['category '] = $category;
            $this->saveHistory('Search for product code - ' . $category);
        }
        $data['products_lang'] = $products_lang = $this->session->userdata('admin_lang_products');

        $rowscount = $this->MerchantModel->listProduct($this->num_rows, $page, false, $search_title, $orderby, $category);
        $data['products'] = $this->MerchantModel->listProduct($this->num_rows, $page, true, $search_title, $orderby, $category);
        $data['links_pagination'] = pagination('admin/products', $rowscount, $this->num_rows, 3);
        $data['num_shop_art'] = $this->AdminModel->numShopproducts();
        $data['languages'] = $this->AdminModel->getLanguages();
        $data['shop_categories'] = $this->AdminModel->getShopCategories(null, null, 2);
        $this->load->view('_parts/header', $head);
        $this->load->view('adminMerchant/listProduct', $data);
        $this->load->view('_parts/footer');
    }

    public function orderMerchant($page=0) {
        $this->login_check();
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Orders';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data = $this->input->get(null, true);
        $data['listOrder'] = $this->MerchantModel->getListOrder($data);
        $data['links_pagination'] = "";
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/orders', $data);
        $this->load->view('_parts/footer');
        if ($page == 0) {
            $this->saveHistory('Go to orders page');
        }
    }
}
