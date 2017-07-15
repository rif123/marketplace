<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

    private $num_rows = 20;
    private $parser = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('pagination'));
        $this->load->Model('LoginModel');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        // $this->load->library('email');
        // $this->email->from('rifky.rachman@gmail.com', 'Admin Dkantin');
        // $this->email->to('rifky.rachman@yahoo.com');
        // $this->email->subject('Email Test lagi dan lagi');
        // $this->email->message('Testing the email class.xxxxxxx');
        // $this->email->send();
        $head = array();
        $parser['template'] = 'templates/blanja/feature/login/index';
        $this->load->view('templates/blanja/base', $parser);
    }

    public function register() {
        $head = array();
        $input = $this->input->post();
        $config  = $this->setValidations();
        $this->form_validation->set_rules($config);
        $secretKey = "Put your secret key here";
        $captcha = $this->curlCaptcha($input['g-recaptcha-response']);
        if ($captcha != true) {
            $this->session->set_flashdata('errors', "Captcha gagal silahkan periksa kembali!");
            redirect('auth/login', 'refreshs');
        }
        if ($this->form_validation->run() == true) {
            unset($input['g-recaptcha-response']);
            $callBack = $this->LoginModel->doInsertReg($input);
            if($callBack){
                // $this->SendMail->sendTo($input['email_client'], "rifky@gmail.com", "REGISTRASI DKANTIN", "Terma kasih telah melalkukan registrasi");
                $this->session->set_flashdata('success', "Registrasi Berhasil! Silahkan Check Email Untuk Confirmasi Pendaftaran");
                redirect('auth/login', 'refresh');
            } else {
                $this->session->set_flashdata('errors', "Nama telah digunakan");
                redirect('auth/login', 'refresh');
            }
        } else {
            $err = $this->form_validation->error_array();
            $value = reset($err);
            $this->session->set_flashdata('errors', $value);
            redirect('auth/login', 'refresh');
        }
    }


    private function setValidations() {
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
                            'field' => 'hp_client',
                            'label' => 'No Handphone',
                            'rules' => 'required|integer',
                            'errors' => array(
                                    'required' => '%s Wajib diisi.',
                                    'integer' => '%s Berupa Angka.',
                            ),
                    ),
                    array(
                            'field' => 'gender_client',
                            'label' => 'Jenis Kelamin',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => '%s Wajib dipilih.',
                            ),
                    ),
                    array(
                            'field' => 'email_client',
                            'label' => 'Email',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => '%s wajib diisi!.',
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
                    array(
                            'field' => 'g-recaptcha-response',
                            'label' => 'Captcha',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => '%s Silahkan cek Captcha.',
                            ),
                    )
            );
        return $config;
    }

    public function doLogin() {
        $input = $this->input->post();
        $config = $this->setValidationsLogin();
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == true) {
            $callBack = $this->LoginModel->doLogin($input);
            // var_dump($callBack);die;
            if ($callBack['status']) {
                unset($callBack['content']->password_client);
                $session['auth'] = $callBack['content'];
                $this->session->set_userdata($session);
                redirect('/');
            } else {
                $this->session->set_flashdata('error_login', "Login gagal silahkan cek kembali!");
                redirect('auth/login', 'refresh');
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

    private function curlCaptcha($geo) {
        $secretKey = "6LdH-CgUAAAAALuQNs-wSvcNGi1QMreSeTbrfJ5k";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$geo."&remoteip=".$ip);
        $responseKeys = json_decode($ressponse,true);
        if(intval($responseKeys["success"]) !== 1) {
            return false;
        } else {
            return true;
        }
    }

    public function doLogout() {
        $this->session->sess_destroy();
        redirect('/');
    }

}
