<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Promobox extends MY_Controller
{

    private $num_rows = 3;
    private $parser = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('LoginModel');
        $this->load->Model('ProductModel');
        $this->load->Model('ConfigModel');
        $this->load->Model('PromoboxModel');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function detail()
    {
        $promoId  = $this->input->get('promo');
        $type = $this->PromoboxModel->getTypePromo($promoId);
        if ($type['dk_promotion_type'] == 1) {
            $segment = $this->uri->segment(3);
            $page = !empty($segment) ? $segment :0;
            $print =$this->input->get('kampus');
            if (empty($print)) {
                $getSessionLoc = $this->session->userdata('location');
                $print = $getSessionLoc['kampus'];
            }
            $sideBaru = $this->PromoboxModel->getCategoryPromo($promoId, $print);
            $side =[];
            foreach ($sideBaru as $key => $value) {
                $side[$value['nameCategory'].'|||'.$value['idCategory']][] =$value;
            }
            $parser['typePromo'] = '1';
            $parser['namePromo'] = $type['dk_title_promotion'];
            $parser['backcolor'] = $type['dk_banner_promotion'];
            $parser['sideBaru'] = $side;
            $parser['listItemss']= $this->PromoboxModel->getListItemPromo($print, $this->num_rows,$page, true);
            $parser['sideMenu'] = $this->ProductModel->getSideMenu($print);
            $parser['home_categories'] = $this->ProductModel->getSearch();
            $parser['links_pagination'] ='';
            $keyWord = $this->input->get('keyWords');
            $url ="promobox/".$this->uri->segment(2);
            $countProd = $this->PromoboxModel->getListItemPromo($print, $this->num_rows,$page, false);
            $parser['links_pagination'] = paginationFrontEnd($url, $countProd, $this->num_rows, 3);
            $category ="";
            if (!empty($this->input->get('category'))) {
              $category = "&category=".$this->input->get('category');
            }
            $GC ="";
            if (!empty($this->input->get('GC'))) {
              $GC = "&GC=".$this->input->get('GC');
            }
            $promo ="";
            if (!empty($this->input->get('promo'))) {
              $promo = "&promo=".$this->input->get('promo');
            }
            $parser['currentUrl'] = base_url(uri_string())."?keyWords=".$keyWord."&kampus=".$print.$category.$GC.$promo;
            $parser['config'] = $this->ConfigModel->getConfig();
            $this->load->view('templates/blanja/promobox',$parser);
        } else {
            $segment = $this->uri->segment(3);
            $page = !empty($segment) ? $segment :0;
            $print =$this->input->get('kampus');
            if (empty($print)) {
                $getSessionLoc = $this->session->userdata('location');
                $print = $getSessionLoc['kampus'];
            }
            $sideBaru = $this->PromoboxModel->getCategoryPromo($promoId, $print);
            $side =[];
            foreach ($sideBaru as $key => $value) {
                $side[$value['nameCategory'].'|||'.$value['idCategory']][] =$value;
            }

            $parser['typePromo'] = '2';
            $parser['namePromo'] = $type['dk_title_promotion'];
            $parser['backcolor'] = $type['dk_banner_promotion'];
            $parser['sideBaru'] = $side;
            $parser['listItemss']= $this->PromoboxModel->getListItemPromo($print, $this->num_rows,$page, true);
            $parser['sideMenu'] = $this->ProductModel->getSideMenu($print);
            $parser['home_categories'] = $this->ProductModel->getSearch();
            $parser['links_pagination'] ='';
            $keyWord = $this->input->get('keyWords');
            $url ="promobox/".$this->uri->segment(2);
            $countProd = $this->PromoboxModel->getListItemPromo($print, $this->num_rows,$page, false);
            $parser['links_pagination'] = paginationFrontEnd($url, $countProd, $this->num_rows, 3);
            $category ="";
            if (!empty($this->input->get('category'))) {
              $category = "&category=".$this->input->get('category');
            }
            $GC ="";
            if (!empty($this->input->get('GC'))) {
              $GC = "&GC=".$this->input->get('GC');
            }
            $promo ="";
            if (!empty($this->input->get('promo'))) {
              $promo = "&promo=".$this->input->get('promo');
            }
            $parser['currentUrl'] = base_url(uri_string())."?keyWords=".$keyWord."&kampus=".$print.$category.$GC.$promo;
            $parser['config'] = $this->ConfigModel->getConfig();
            $this->load->view('templates/blanja/promobox',$parser);
        }
    }

}
