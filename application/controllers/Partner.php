<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends MY_Controller
{

    private $num_rows = 20;
    private $parser = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('LoginModel');
        $this->load->Model('ProductModel');
        $this->load->Model('ConfigModel');
        $this->load->Model('PartnerModel');
        $this->load->library('form_validation');
        $this->load->library('session');
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
      $segmentPage = $this->uri->segment(3);
      $page = !empty($segmentPage) ? $segmentPage : "0";
      $category = $this->input->get('category');
      $c2 = $this->input->get('c2');
      $c3 = $this->input->get('c3');
      $url  = $this->uri->segment('1')."/".$this->uri->segment('2');
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
      $parser['nameCategory'] = getUnIdBySlug($this->uri->segment(2));
      // for category
      $itemsDetail  = $this->ProductModel->getDetailProd($idCategory);

      $parser['config'] = $this->ConfigModel->getConfig();
      $parser['partner'] = $this->PartnerModel->getPartner();
      $parser['item'] = $itemsDetail;
      $parser['listItems'] = $this->ProductModel->listItems($this->num_rows,$page, $idCategoryOrigin, false);
      $countProd = $this->ProductModel->listItems($this->num_rows,$page, $idCategoryOrigin, true);
      $parser['links_pagination'] = paginationFrontEnd($url, $countProd, $this->num_rows, 3);


      $parser['bestSellers'] = $this->Publicmodel->getbestSellers();
      $this->load->view('templates/blanja/partner',$parser);
    }


}
