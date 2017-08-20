<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MerchantController extends MY_Controller
{

    private $num_rows = 20;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('AdminModel');
        $this->load->Model('PromoboxModel');
        $this->load->Model('ProductModel');
        $this->load->Model('ConfigModel');
        $this->load->Model('MerchantModel');
        $this->load->library('form_validation');
    }

    public function authMerchant() {
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
        $parser['config'] = $this->ConfigModel->getConfig();
        $head = array();
        $parser['template'] = 'templates/blanja/feature/merchant/index';
        $this->load->view('templates/blanja/base', $parser);
    }

    public function doLogin() {
        $input = $this->input->post();
        $config = $this->setValidationsLogin();
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == true) {
            $callBack = $this->MerchantModel->doLogin($input);
            if ($callBack['status']) {
                $this->session->set_userdata('logged_in', $callBack['content']['name_client']);
                unset($callBack['content']['password_client']);
                $this->session->set_userdata('authlog', $callBack['content']);
                redirect('admin/home');
            } else {
                $this->session->set_flashdata('error_login', "Login gagal silahkan cek kembali!");
                redirect('auth/merchant', 'refresh');
            }
        }
    }
    private function setValidationsLogin(){
        $config = array(
                    array(
                            'field' => 'name_client',
                            'label' => 'Nama',
                            'rules' => 'required|alpha',
                            'errors' => array(
                                    'required' => '%s Wajib diisi',
                                    'alpha' => '%s Harus berupa Hurup',
                            ),
                    ),
                    array(
                            'field' => 'password_client',
                            'label' => 'Password',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => '%s Wajib diisi.',
                            ),
                    ),

            );
        return $config;
    }


}
