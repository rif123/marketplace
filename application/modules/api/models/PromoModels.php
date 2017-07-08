<?php

class PromoModels extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }
    public function getPromo(){
        $data['id'] = 1;
        $data['name'] = "Promo Ongkir";
        $data['description'] = "Cepat Ada promo";
        $data['image'] = "image.jpg";
        $data['status'] = 1;
        return $data;
    }
}
