<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Promo extends ADMIN_Controller
{
    private $num_rows = 10;
    public function index($page=0)
    {

        $this->login_check();
        //HEAD
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Promo';
        $head['description'] = '!';
        $head['keywords'] = '';

        // CONFIG FOR PAGINATION
    $data['promo'] = $this->AdminModel->getPromo($this->num_rows, $page, true);
    $rowscount = $this->AdminModel->getPromo($this->num_rows, $page, false);
    $data['links_pagination'] = pagination('admin/promo', $rowscount, $this->num_rows, 3);

    if (isset($_POST['save'])) {

      $checkTo =substr($_POST['daterange'],39,2);
      $minutesTo =substr($_POST['daterange'],36,2);
      $yearsTo =substr($_POST['daterange'],28,4);
      $monthTo =substr($_POST['daterange'],25,2);
      $dateTo =substr($_POST['daterange'],22,2);
      $CheckFrom =substr($_POST['daterange'],17,2);
      $seconds ='59';

      $minutesFrom =substr($_POST['daterange'],14,2);

      $yearsFrom =substr($_POST['daterange'],6,4);
      $monthFrom =substr($_POST['daterange'],3,2);
      $dateFrom =substr($_POST['daterange'],0,2);
      if ($checkTo =="PM") {

        $hoursTo =substr($_POST['daterange'],33,2) +12;
      }else{
        $hoursTo =substr($_POST['daterange'],33,2);
      }
      if ($CheckFrom =="PM") {

        $hoursFrom =substr($_POST['daterange'],11,2) +12 ;
      }else{
        $hoursFrom =substr($_POST['daterange'],11,2) ;

      }

      $_POST['dk_start_date_promotion'] = $yearsFrom.'-'.$monthFrom.'-'.$dateFrom.' '.$hoursFrom.':'.$minutesFrom.':'.$seconds;
      $_POST['dk_end_date_promotion'] = $yearsTo.'-'.$monthTo.'-'.$dateTo.' '.$hoursTo.':'.$minutesTo.':'.$seconds;

      $result =$this->AdminModel->savePromo($_POST);
         if ($result ==1) {
           $this->session->set_flashdata('result_add', 'Promo is added!');
           $this->saveHistory('Create Promo user - ' . $_POST['dk_head_title']);

         }else{
           $this->session->set_flashdata('result_fail', 'Problem with Promo add!');
           $this->saveHistory('Cant add admin Promo');

         }

         redirect('admin/promo');

      }
      //EDIT DATA
      if (isset($_GET['edit'])) {
          $data['edit']  =$this->AdminModel->getPromoedit($_GET['edit']);

      }
      // ACTION UPDATE
      if (isset($_POST['update'])) {
        $checkTo =substr($_POST['daterange'],39,2);
        $minutesTo =substr($_POST['daterange'],36,2);
        $yearsTo =substr($_POST['daterange'],28,4);
        $monthTo =substr($_POST['daterange'],25,2);
        $dateTo =substr($_POST['daterange'],22,2);
        $CheckFrom =substr($_POST['daterange'],17,2);
        $seconds ='59';

        $minutesFrom =substr($_POST['daterange'],14,2);

        $yearsFrom =substr($_POST['daterange'],6,4);
        $monthFrom =substr($_POST['daterange'],3,2);
        $dateFrom =substr($_POST['daterange'],0,2);
        if ($checkTo =="PM") {

          $hoursTo =substr($_POST['daterange'],33,2) +12;
        }else{
          $hoursTo =substr($_POST['daterange'],33,2);
        }
        if ($CheckFrom =="PM") {

          $hoursFrom =substr($_POST['daterange'],11,2) +12 ;
        }else{
          $hoursFrom =substr($_POST['daterange'],11,2) ;

        }

        $_POST['dk_start_date_promotion'] = $yearsFrom.'-'.$monthFrom.'-'.$dateFrom.' '.$hoursFrom.':'.$minutesFrom.':'.$seconds;
        $_POST['dk_end_date_promotion'] = $yearsTo.'-'.$monthTo.'-'.$dateTo.' '.$hoursTo.':'.$minutesTo.':'.$seconds;

        $result  =$this->AdminModel->updatePromo($_POST);
        if ($result ==1) {
          $this->session->set_flashdata('result_add', 'Promo is Update!');
          $this->saveHistory('Create City  - ' . $_POST['dk_head_title']);

        }else{
          $this->session->set_flashdata('result_fail', 'Problem with Promo Update!');
          $this->saveHistory('Cant add City ');

        }

        redirect('admin/promo');
      }
      // ACTION DELETE
      if (isset($_GET['delete'])) {
        $result = $this->AdminModel->deletePromo($_GET['delete']);
          if ($result == true) {
              $this->saveHistory('Delete Promo id - ' . $_GET['delete']);
              $this->session->set_flashdata('result_delete', 'Promo is deleted!');
          } else {
              $this->session->set_flashdata('result_delete', 'Problem with Promo delete!');
          }
        redirect('admin/promo');
      }

        //TAMPIL DATA

        $this->load->view('_parts/header', $head);
        $this->load->view('promo/promo', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');

      }


}