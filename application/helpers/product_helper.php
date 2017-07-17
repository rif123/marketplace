<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * Clean query strings and protocols from urls
 * Returns only hostname
 */

function getCategoryMenu($id){
    $CI =& get_instance();
    $query = 'select * from translations as T
                LEFT JOIN products as P on T.for_id  = P.id
                LEFT JOIN   (select ctr.name,ctr.for_id from translations as ctr where ctr.type="shop_categorie") as ct on P.shop_categorie = ct.for_id
                where T.type = "product" and ct.for_id="'.$id.'" ';
    $data = $CI->db->query($query)->result_array();
    return $data;
}

function getDetailPromo($id){
    $CI =& get_instance();
    $query = "select * from dk_promo_items as dpi
                LEFT JOIN translations as T on dpi.id_prod = T.id and T.type='product'
                LEFT JOIN products as P on T.for_id = P.id
                where dpi.dk_promotion_id = '".$id."'
                LIMIT 10
                ";
    $allData = $CI->db->query($query)->result_array();
    return $allData;
}

function getListCategoryPop($shop_categorie){
    $CI =& get_instance();
    $query = "  select * from products as P
                LEFT JOIN translations as T on P.shop_categorie = T.for_id
                where T.type  = 'product' and P.shop_categorie = ".$shop_categorie."
                LIMIT 10
                ";
    $allData = $CI->db->query($query)->result_array();
    return $allData;
}

function numberToRp($num){
    $rp = number_format($num, 0, ".", ".");
    return "Rp.".$rp;
}
