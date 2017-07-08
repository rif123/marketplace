<?php

class CategoryModels extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }
    public function getCategory(){
        $data['id'] = 1;
        $data['name'] = "Fast Food";
        $data['image'] = "ic_fast_food.jpeg";
        $data['status'] = 1;


        $data['id'] = 2;
        $data['name'] = "Rm Padang";
        $data['image'] = "ic_rm_padang.jpeg";
        $data['status'] = 1;

        $data['id'] = 3;
        $data['name'] = "Kantin";
        $data['image'] = "ic_kantin.jpeg";
        $data['status'] = 1;

        $data['id'] = 4;
        $data['name'] = "Mie Ayam";
        $data['image'] = "ic_kantin.jpeg";
        $data['status'] = 1;
        return $data;
    }
}
