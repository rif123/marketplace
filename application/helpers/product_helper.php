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


function numberToRp($num){
    $rp = number_format($num, 0, ".", ".");
    return "Rp.".$rp;
}
