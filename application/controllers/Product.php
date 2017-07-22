<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller
{

    private $num_rows = 1;
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
        $segmentPage = $this->uri->segment(2);
        $page = !empty($segmentPage) ? $segmentPage : "0";
        $category = $this->input->get('category');
        $c2 = $this->input->get('c2');
        $c3 = $this->input->get('c3');
        $url  = $this->uri->segment('1');
        if (!empty($category) && !empty($c2) && !empty($c3)) {
            $idCategory = $c3;
            $idCategoryOrigin = $c3;
            $parser['currentUrl'] = base_url(uri_string())."?category=".$category."&c2=".$c2."&c3=".$c3;
        }  else if (!empty($category) && !empty($c2)) {
            $idCategory = $c2;
            $idCategoryOrigin = $c2;
            $parser['currentUrl'] = base_url(uri_string())."?category=".$category."&c2=".$c2;
        } else {
            $idCategory = $category;
            $idCategoryOrigin = $category;
            $parser['currentUrl'] = base_url(uri_string())."?category=".$category;
        }
        $getWhereCategory = [];
        foreach ($parser['home_categories'] as $key => $value) {
            if ($value['idCategory'] == $category) {
                $getWhereCategory = $value;
            }
        }

        $parser['whereCategory'] = $getWhereCategory;
        $parser['nameCategory'] = getUnIdBySlug($this->uri->segment(1));
        // for category
        $itemsDetail  = $this->ProductModel->getDetailProd($idCategory);
        $parser['reletedProduction']  = $this->ProductModel->getReleted($itemsDetail[0]['shop_categorie'], $itemsDetail[0]['id']);
        $data['partner'] = $this->ProductModel->getPartner();
        $parser['listReview'] = $this->ProductModel->listReview($itemsDetail[0]['id']);

        $parser['item'] = $itemsDetail;
        $parser['listItems'] = $this->ProductModel->listItems($this->num_rows,$page, $idCategoryOrigin, false);
        $countProd = $this->ProductModel->listItems($this->num_rows,$page, $idCategoryOrigin, true);

        $parser['links_pagination'] = paginationFrontEnd($url, $countProd, $this->num_rows, 2);


        $parser['bestSellers'] = $this->Publicmodel->getbestSellers();
        $this->load->view('templates/blanja/listCategory',$parser);

    }

    public function globalSearch() {
        $all_categories = $this->Publicmodel->getShopCategories();
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

        $this->load->view('templates/blanja/globalSearch',$parser);
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
