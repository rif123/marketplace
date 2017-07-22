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
    $query = " select
                products.id as idItems,
                itemsDetail.title as itemNames,
                products.image as itemImage
                from translations
                left join products on translations.for_id = products.shop_categorie
                LEFT JOIN (select * from translations where translations.type = 'product') as itemsDetail on products.id = itemsDetail.for_id
                where translations.type = 'shop_categorie' and translations.id = '".$shop_categorie."'
                LIMIT 10
                ";
    $allData = $CI->db->query($query)->result_array();
    return $allData;
}
function generateUrl($pref="p", $itemNames, $idItems){
    $CI =& get_instance();
    if (!empty($pref)) {
        $url = site_url('/').$pref.'/'.sanitizeStringForUrl($itemNames).'-'.$idItems;
    } else {
        $url = site_url('/').sanitizeStringForUrl($itemNames).'-'.$idItems;
    }
    return $url;
}
function numberToRp($num){
    $rp = number_format($num, 0, ".", ".");
    return "Rp.".$rp;
}
function getIdBySlug($slug){
    $splitSlug  = explode("-", $slug);
    $id  = end($splitSlug);
    return $id;
}
function getUnIdBySlug($slug){
    $splitSlug  = str_replace("-", " ", $slug);
    return $splitSlug;
}
function getCountItems($value){
    $CI =& get_instance();
    $query = " select
                products.id as idItems,
                itemsDetail.title as itemNames,
                products.image as itemImage
                from translations
                left join products on translations.for_id = products.shop_categorie
                LEFT JOIN (select * from translations where translations.type = 'product') as itemsDetail on products.id = itemsDetail.for_id
                where translations.type = 'shop_categorie' and products.shop_categorie = '".$value['idCategory']."'
                ";
    $allData = $CI->db->query($query)->num_rows();
    return $allData;

}
