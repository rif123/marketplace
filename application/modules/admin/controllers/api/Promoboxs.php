<?php

/*
 * @Author:    -
 *  Gitgub:    -
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Promoboxs extends ADMIN_Controller
{

    public function index()
    {
        echo "xxxx";die;
        $data = array();
        $head = array();
        $this->getPromobox->getPromobox();
    }

}
