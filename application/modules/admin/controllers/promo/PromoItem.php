<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class PromoItem extends ADMIN_Controller
{
    private $num_rows = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('PromoModel');
    }

    public function index($page = 0)
    {
        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration -Promo Item';
        $head['description'] = '!';
        $head['keywords'] = '';

        // CONFIG FOR PAGINATION
        $data['promo'] = $this->PromoModel->getPromos();
        $data['product'] = $this->AdminModel->getProduct();
        $data['promoitem'] = $this->PromoModel->getPromoItem($this->num_rows, $page, true);

        $data['listWarung'] = $this->PromoModel->getWarung();
        $rowscount = $this->PromoModel->getPromoItem($this->num_rows, $page, false);
        $data['links_pagination'] = pagination('admin/promoItem', $rowscount, $this->num_rows, 3);

        // ACTION SAVE
        if (isset($_POST['save'])) {
            $post = $this->input->post(NULL, TRUE);
            $result =$this->PromoModel->savePromoItem($post);
            if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Promo is added!');
                $this->saveHistory('Create Promo user - ' . $_POST['name_bank']);
            } else {
                $this->session->set_flashdata('result_fail', 'Problem with Promo add!');
                $this->saveHistory('Cant add admin Promo');
            }

            redirect('admin/promoItem');
        }

        // ACTION DELETE
        if (isset($_GET['delete'])) {
            $result = $this->PromoModel->deletePromoItem($_GET['delete']);
            if ($result == true) {
                $this->saveHistory('Delete user id - ' . $_GET['delete']);
                $this->session->set_flashdata('result_delete', 'Promo Item is deleted!');
            } else {
                $this->session->set_flashdata('result_delete', 'Problem with Promo Item delete!');
            }
            redirect('admin/promoItem');
        }


        // ACTION SHOW FOR EDIT
        if (isset($_GET['edit'])) {
            $data['edit']  = $this->PromoModel->getPromoItemedit($_GET['edit']);
            $data['listProduct'] = $this->PromoModel->getProduct($data['edit']['id_warung']);
        }

        // ACTION UPDATE
        if (isset($_POST['update'])) {
            $result  =$this->PromoModel->updatePromoItem($_POST);
            if ($result ==1) {
                $this->session->set_flashdata('result_add', 'Promo Item is Update!');
                $this->saveHistory('Create promo Item user - ' . $_POST['dk_promotion_id']);
            } else {
                $this->session->set_flashdata('result_fail', 'Problem with promo Item Update!');
                $this->saveHistory('Cant add admin user');
            }

            redirect('admin/promoItem');
        }

        //TAMPIL DATA
        $this->load->view('_parts/header', $head);
        $this->load->view('promo/promoItem', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');
    }
    public function getProduct()
    {
        $id_warung = $this->input->post('id_warung');
        $result['listData'] = $this->PromoModel->getProduct($id_warung);
        echo json_encode($result);die;
    }
}
