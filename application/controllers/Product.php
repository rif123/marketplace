<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
{
    private $num_rows = 10;
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
    public function getKota()
    {
        $kota = $this->input->post('kota');
        $getKota = $this->Publicmodel->getKampus($kota);
        echo json_encode($getKota);
    }
    public function setKotaKampus()
    {
        $kota = $this->input->post('kota');
        $kampus = $this->input->post('kampus');
        if ($kota != "" && $kampus != "") {
            $this->session->set_userdata("location", ['kota' => $kota, "kampus" => $kampus]);
            Redirect('/');
        }
        Redirect('/');
    }

    public function category()
    {
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
        $parser['listItemss']= $this->ProductModel->getListItems($print, $this->num_rows, $page);
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
        $parser['config'] = $this->ConfigModel->getConfig();
        $this->load->view('templates/blanja/listCategory', $parser);
    }

    public function globalSearch($page=0)
    {
        $all_categories = $this->ProductModel->globalSearch();
        $parser['config'] = $this->ConfigModel->getConfig();
        $parser['listSearchCategory'] = $this->ProductModel->getCategorySearch();
        $post = $this->input->get(NULL, TRUE);
        $parser['listItemss'] = $this->ProductModel->getItems($this->num_rows, $page, true, $post);
        $parser['currentUrl'] = $this->getCurrnetUrl('global/search', $post);
        $rowscount = $this->ProductModel->getItems($this->num_rows, $page, false, $post);
        $parser['links_pagination'] = pagination('global/search', $rowscount, $this->num_rows, 3);
        $this->load->view('templates/blanja/globalSearch', $parser);
    }

    public function getCurrnetUrl($root, $post){
        $query = [];
        if (!empty($post['category'])) {
            $query['category'] = $post['category'];
        }
        if (!empty($post['keyWords'])) {
            $query['keyWords'] = $post['keyWords'];
        }
        $q = http_build_query($query);
        return site_url('/').$root."?".$q;
    }

    public function detail()
    {
        $post = $this->input->get(NULL, TRUE);
        $detaiProd = $this->ProductModel->getDetailProd($post);
        $parser['home_categories'] = $this->ProductModel->getSearch();
        $parser['partner'] = $this->ProductModel->getPartner();
        $parser['reletedProduction']  = [];
        $data['partner'] = $this->ProductModel->getPartner();
        $parser['config'] = $this->ConfigModel->getConfig();
        $parser['listReview'] = $this->ProductModel->listReview($detaiProd[0]['id_product']);
        // $parser['listReview'] = [];
        $parser['item'] = $detaiProd;
        $parser['template'] = 'templates/blanja/feature/login/index';
        $this->load->view('templates/blanja/detail', $parser);
    }
    public function doSend()
    {
        $input = $this->input->post();
        $this->ProductModel->doSubscribed($input);
        redirect('/');
    }

    public function wishlist()
    {
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

    public function addWishlist()
    {
        $getIdProd = $this->input->get('id');
        $this->ProductModel->addWishlist($getIdProd);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function delWishlist()
    {
        $getIdProd = $this->input->get('idProd');
        $this->ProductModel->delWishlist($getIdProd);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function switchLoc()
    {
        $replace = [
            'kota' => $this->input->post('kota'),
            'kampus' => "",
        ];
        $this->session->set_userdata('location', $replace);
        echo json_encode(['status' => true]);
    }

    public function cart(){
        $post = $this->input->post(NULL, TRUE);
        $this->ProductModel->doCart($post);
        $result['status'] = true;
        echo json_encode($result);die;
    }
    public function cartOrder(){
        $page = !empty($s) ? $s : 0;
        if (!empty(getSession())) {
            $url = "global/search";
            $parser['config'] = $this->ConfigModel->getConfig();
            $parser['partner'] = $this->ProductModel->getPartner();
            $parser['home_categories'] = $this->ProductModel->getSearch();
            $parser['listCart'] = $this->ProductModel->getCart();
            if (empty($parser['listCart'])) {
                $this->session->set_flashdata('message_error', 'No order in chart');
                redirect("/");
            }
            $this->load->view('templates/blanja/cart', $parser);
        } else {
            redirect('/');
        }
    }
    public function updateCartOrder() {
        $post = $this->input->post(NULL, TRUE);
        $this->ProductModel->doCartUpdate($post);
        $result['status'] = true;
        echo json_encode($result);die;
    }
    public function deleteCartOrder() {
        $post = $this->input->post(NULL, TRUE);
        $this->ProductModel->doCartDelete($post);
        $result['status'] = true;
        echo json_encode($result);die;
    }

    // shipping
    public function orderShipping() {
        $page = !empty($s) ? $s : 0;
        $url = "global/search";
        $parser['config'] = $this->ConfigModel->getConfig();
        $parser['partner'] = $this->ProductModel->getPartner();
        $parser['home_categories'] = $this->ProductModel->getSearch();
        $parser['listProv'] = $this->ProductModel->getProv();
        $parser['listShipping'] = $this->ProductModel->getListShipping();
        $parser['listCart'] = $this->ProductModel->getCart();
        if (empty($parser['listCart'])) {
            $this->session->set_flashdata('message_error', 'No order in chart');
            redirect("/");
        }
        $this->load->view('templates/blanja/shipping', $parser);
    }
    // shipping


    public function doaddShipping() {
        $post = $this->input->post(NULL, TRUE);
        $this->ProductModel->doaddShipping($post);
        $result['status'] = true;
        echo json_encode($result);
    }
    public function getCity() {
        $post = $this->input->post(NULL, TRUE);
        $listCity = $this->ProductModel->getCity($post);
        $result['list'] = $listCity;
        echo json_encode($result);
    }
    public function dopayment() {
        $page = !empty($s) ? $s : 0;
        $url = "global/search";
        $parser['config'] = $this->ConfigModel->getConfig();
        $parser['partner'] = $this->ProductModel->getPartner();
        $parser['home_categories'] = $this->ProductModel->getSearch();
        $parser['payTotal'] = $this->ProductModel->getPayTotal()->priceTotal;
        $parser['listBank'] = $this->ProductModel->getListBank();
        $parser['listCart'] = $this->ProductModel->getCart();
        if (empty($parser['listCart'])) {
            $this->session->set_flashdata('message_error', 'No order in chart');
            redirect("/");
        }
        $this->load->view('templates/blanja/payment', $parser);
    }
    public function doOrderStore() {
        $post = $this->input->post(null, true);
        $auth = $this->session->userdata('auth');
        if (!empty($auth)) {
            $this->ProductModel->doOrderstore($post);
            $status['status'] = true;
            echo json_encode($status);die;
        } else {
            $status['status'] = false;
            echo json_encode($status);die;
        }
    }
    public function doOrderStatus() {
        $page = !empty($s) ? $s : 0;
        $url = "global/search";
        $parser['config'] = $this->ConfigModel->getConfig();
        $parser['partner'] = $this->ProductModel->getPartner();
        $parser['home_categories'] = $this->ProductModel->getSearch();
        $parser['payTotal'] = $this->ProductModel->getPayTotal()->priceTotal;
        $parser['listBank'] = $this->ProductModel->getListBank();
        $this->load->view('templates/blanja/statusPayment', $parser);
    }

    public function confirmOrder() {
        $page = !empty($s) ? $s : 0;
        if (!empty(getSession())) {
            $url = "global/search";
            $parser['config'] = $this->ConfigModel->getConfig();
            $parser['partner'] = $this->ProductModel->getPartner();
            $parser['home_categories'] = $this->ProductModel->getSearch();
            $parser['listCart'] = $this->ProductModel->getOrderConfirm();
            // if (empty($parser['listCart'])) {
            //     $this->session->set_flashdata('message_error', 'Tidak ada Order confirmasi');
            //     redirect('/');
            // }
            $parser['listCart'] = $this->groupByOrder($parser['listCart']);
            $this->load->view('templates/blanja/confirmOrder', $parser);
        } else {
            $this->session->set_flashdata('message_error', 'Harap login terlebih dahulu!');
            redirect('/');
        }
    }
    private function groupByOrder($listCart){
        $listOrder = [];
        foreach ($listCart as $key => $value) {
            $listOrder[$value['no_order']][] = $value;
        }
        return $listOrder;
    }
    public function doConfirmOrder() {
        $data = $this->input->post(null, true);
        $doConfirm = $this->ProductModel->doConfirmOrder($data);
        if ($doConfirm){
            $this->session->set_flashdata('message_success', 'Confirmasi Success order sedalang dalam process');
            redirect("confirm/pay-order");
        } else {
            $this->session->set_flashdata('message_error', 'Please check input data!');
            redirect("confirm/pay-order");
        }
    }



}
