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
        $this->load->Model('ConfigModel');
        $this->load->library('form_validation');
        $this->load->library('session');

    }

    public function category() {

        $segment = $this->uri->segment(3);
        $page = !empty($segment) ? $segment :0;

           $print =$this->input->get('kampus');
        $sideBaru = $this->ProductModel->getSideBaru($print);
        $side =[];
          foreach ($sideBaru as $key => $value) {
                $side[$value['nameCategory'].'|||'.$value['idCategory']][] =$value;
            }

        $parser['sideBaru'] = $side;
        $parser['topSeller']= $this->ProductModel->getTopSeller($print);
        $parser['listItemss']= $this->ProductModel->getListItems($print, $this->num_rows,$page);
        $parser['sideMenu'] = $this->ProductModel->getSideMenu($print);
        $parser['home_categories'] = $this->ProductModel->getSearch();
        $parser['links_pagination'] ='';
        $keyWord = $this->input->get('keyWords');
        $kampus = $this->input->get('kampus');
        $url ="c/".$this->uri->segment(2);
        $countProd = $this->ProductModel->getListItemsCount();
        $parser['links_pagination'] = paginationFrontEnd($url, $countProd, $this->num_rows, 3);
        $category ="";
        if (!empty($this->input->get('category'))) {
          $category = "&category=".$this->input->get('category');
        }
        $parser['currentUrl'] = base_url(uri_string())."?keyWords=".$keyWord."&kampus=".$kampus.$category;
;

        $parser['config'] = $this->ConfigModel->getConfig();
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
        $s = $this->uri->segment(3);
        $page = !empty($s) ? $s : 0;
        $url = "global/search";

        $parser['home_categories'] = $tree = buildTree($all_categories);
        $parser['partner'] = $this->ProductModel->getPartner();
        $keyWord = $this->input->get('keyWords');
        $parser['currentUrl'] = base_url(uri_string())."?keyWords=".$keyWord;
        $parser['listItems'] = $this->ProductModel->getItemsList($this->num_rows,$page, $keyWord, false);
        $countProd = $this->ProductModel->getItemsList($this->num_rows,$page, $keyWord, true);
        $parser['links_pagination'] = paginationFrontEnd($url, $countProd, $this->num_rows, 3);
        $parser['config'] = $this->ConfigModel->getConfig();

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
        $parser['config'] = $this->ConfigModel->getConfig();
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

    public function wishlist() {
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
        $s = $this->uri->segment(3);
        $page = !empty($s) ? $s : 0;
        $url = "global/search";
        $parser['home_categories'] = $tree = buildTree($all_categories);
        $parser['config'] = $this->ConfigModel->getConfig();
        $parser['partner'] = $this->ProductModel->getPartner();
        $this->load->view('templates/blanja/wishlist', $parser);
    }

    public function addWishlist() {
        $getIdProd = $this->input->get('id');
        $this->ProductModel->addWishlist($getIdProd);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function delWishlist() {
        $getIdProd = $this->input->get('idProd');
        $this->ProductModel->delWishlist($getIdProd);
        redirect($_SERVER['HTTP_REFERER']);
    }

}
