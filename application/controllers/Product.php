<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{

    private $num_rows = 20;
    private $parser = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('ProductModel');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function category() {
        $parser['template'] = 'templates/blanja/feature/login/index';
        $this->load->view('templates/blanja/detail');
    }

    public function globalSearch() {
        print_R($_GET);die;
    }

    public function detail() {
        $all_categories = $this->Publicmodel->getShopCategories();
        /*
         * Tree Builder for categories menu
         */

        function buildTree(array $elements, $parentId = 0)
        {
            $branch = array();
            foreach ($elements as $element) {
                if ($element['sub_for'] == $parentId) {
                    $children = buildTree($elements, $element['id']);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
            return $branch;
        }
        $parser['home_categories'] = $tree = buildTree($all_categories);

        $parser['partner'] = $this->ProductModel->getPartner();
        $segment = $this->uri->segment_array();
        $record_num = end($segment);
        $idCategory = getIdBySlug($record_num);

        $itemsDetail  = $this->ProductModel->getDetailProd($idCategory);
        $parser['reletedProduction']  = $this->ProductModel->getReleted($itemsDetail[0]['shop_categorie'], $itemsDetail[0]['id']);
        $data['partner'] = $this->ProductModel->getPartner();
        $parser['listReview'] = $this->ProductModel->listReview($itemsDetail[0]['id']);
        $parser['item'] = $itemsDetail;
        $parser['template'] = 'templates/blanja/feature/login/index';
        $this->load->view('templates/blanja/detail', $parser);
    }
    public function doSend() {
        $input = $this->input->post();
        $this->ProductModel->doSubscribed($input);
        redirect('/');
    }

}
