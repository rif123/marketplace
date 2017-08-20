<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Settings extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
    }


    public function index()
    {
        $this->login_check();
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Settings';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['listCategory'] = $this->SettingModel->getCategoryMaster();
        $data['listMenuKampus'] = $this->SettingModel->getKampus();
        $data['listKota'] = $this->SettingModel->getKota();
        $data['edit'] = $this->SettingModel->getWarungId();
        $data['statusButton'] = false;
        $post = $this->input->post(null, true);
        if (!empty($data['edit'])) {
            $data['statusButton'] = true;
        }
        if(isset($post['update'])) {
            $this->SettingModel->updateMerchant($post);
            redirect('/admin/settings');
        }


        $this->load->view('_parts/header', $head);
        $this->load->view('settings/settings', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Settings Page');
    }
}
