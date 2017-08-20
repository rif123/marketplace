<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * Clean query strings and protocols from urls
 * Returns only hostname
 */

/**
 * config global
 */

function getPartner() {
    $CI =& get_instance();
    return $CI->ProductModel->getPartner();
}

/**
 * get Side category
 */
function getSideCategory() {
     $CI =& get_instance();
     return $CI->ProductModel->getSideCategory();
}
/**
 * get Side category
 */
function getBestSeller() {
     $CI =& get_instance();
     return $CI->ProductModel->getBestSeller();
}
/**
/**
 * get Side category
 */
function getSeller($value) {
     $CI =& get_instance();
     return $CI->ProductModel->getSeller($value);
}
/**
 * get Campus
 */
function getCampus($idKota) {
     $CI =& get_instance();
     return $CI->ProductModel->getCampus($idKota);
}

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
    $query = "  select * from dk_promo_items as dpi
                LEFT JOIN dk_product as dp on dpi.id_prod  = dp.id_product
                where dpi.dk_promotion_id = '".$id."'
                LIMIT 10
                ";

    $allData = $CI->db->query($query)->result_array();
    return $allData;
}
function getDetailPromoCategory($id){
    $CI =& get_instance();
    $loc = $CI->session->userdata('location');
    $where = "";
    if (!empty($loc['kampus'])) {
        $where .= " AND dw.id_kampus = ".$loc['kampus'];
    }
    if (!empty($loc['kota'])) {
        $where .= " AND dpi.id_menu_kota = ".$loc['kota'];
    }
    $query = "  select * from dk_promo_items as dpi
                LEFT JOIN dk_product as dp on dpi.id_prod  = dp.id_product
                LEFT JOIN dk_warung as dw on dw.id_warung = dp.id_warung
                LEFT JOIN dk_category as dc on dw.id_category = dc.id_category
                where dc.id_category = '".$id."'
                ".$where."
                LIMIT 10
                ";
        $allData = $CI->db->query($query)->result_array();
    return $allData;
}
function getItemsPopuler($id){
    $CI =& get_instance();
    $loc = $CI->session->userdata('location');
    $where = "";
    if (!empty($loc['kampus'])) {
        $where .= " AND dw.id_kampus = ".$loc['kampus'];
    }
    if (!empty($loc['kota'])) {
        $where .= " AND dmkot.id_menu_kota = ".$loc['kota'];
    }
    $query = "  select * from dk_product as dp
                LEFT JOIN dk_warung as dw on dw.id_warung = dp.id_warung
                LEFT JOIN dk_category as dc on dw.id_category = dc.id_category
                LEFT JOIN dk_menu_kampus as dmk on dw.id_kampus = dmk.id_menu_kampus
                LEFT JOIN dk_menu_kota as dmkot on dmk.id_menu_kota = dmkot.id_menu_kota
                where dc.id_category = '".$id."'
                ".$where."
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

     $rp = number_format($num, 0, ".",".");

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
function getWishlist() {
    $CI =& get_instance();
    $query = "select * from dk_wishlist LEFT JOIN dk_client on dk_wishlist.id_user = dk_client.id_client
    left JOIN translations on dk_wishlist.id_prod  = translations.for_id
    where translations.type = 'product'  and  dk_wishlist.id_user = 1
    ";
    $allData = $CI->db->query($query);
    return $allData;
}
function generateQueryString($custom=[]) {
    $CI =& get_instance();
    $query  =  $_GET;
    $url = http_build_query($query);
    if (!empty($url)) {
        $url = "?".$url;
    }

    if (!empty($custom)) {
        foreach ($custom as $key => $value) {
            // if (empty($CI->input->get($key))) {

                if (!empty($url)) {
                    if (!empty($value)) {
                        $url .=  "&".$key."=".$value;
                    }
                } else {
                    $url =  "?".$key."=".$value;
                }
            // }
        }
    }
    return $url;
}

function getImageOther($idProd) {
    $CI =& get_instance();
    $CI->db->where('id_product', $idProd);
    $allData = $CI->db->get('dk_image_prod')->result_array();
    return $allData;
}


function getSession(){
    $CI =& get_instance();
    $auth = $CI->session->userdata('auth');
    return $auth;
}


function getCountCart(){
    $CI =& get_instance();
    $session = getSession();
    if (!empty($session->id_client)) {
        $q  = " select
                sum(dp.price_product * dc.quantity) as priceTotal from dk_cart as dc
                LEFT JOIN dk_product as dp on dc.id_product = dp.id_product
                where dc.id_client = '".$session->id_client."'
                ";
        $result  = $CI->db->query($q)->row();
        $return =  $result->priceTotal;
    } else {
        $return = 0;
    }
    return $return;
}
function getListProduct($id_order) {
    $CI =& get_instance();
    $session = getSession();
    if (!empty($session->id_client)) {
        $q  = "
                select dod.id_order_detail, dod.quantity, dod.id_product, dp.title_product, dp.price_product, dp.image_product
                from dk_order_detail as dod
                LEFT JOIN dk_product as dp on dod.id_product = dp.id_product
                WHERE dod.id_order = '".$id_order."'
                ";
        $return  = $CI->db->query($q)->result_array();
    } else {
        $return = [];
    }
    return $return;
}
function getShipping($id_shipping) {
    $CI =& get_instance();
    $query = "select * , dc.`name` as kota, dp.`name` as prov
            from dk_shipping as dks
            LEFT JOIN dk_city as dc on dks.id_city = dc.id_city
            LEFT JOIN dk_prov as dp on dc.id_prov = dp.id_prov
            where dks.id_shipping = '".$id_shipping."'
            ";
    $result = $CI->db->query($query)->row();
    return $result;
}
