<?php

class ProductModel extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('EncryptNative');
    }
    public function getPopularCategori() {
        try {
            $query = "select * from dk_popular_categories as dpc
                    LEFT JOIN translations as T on dpc.id_category = T.id and T.type = 'shop_categorie'";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getPartner() {
        try {
            $allData = $this->db->get('dk_partner')->result_array();
            return $allData;
        } catch (Exception $e) {
            return [];
        }
    }
    public function doSubscribed($subscribed) {
        try {
            $checkEmail = $this->db->get_where('dk_subscribed', array('email_subscribed' => $subscribed['subscribed']))->num_rows();
            if($checkEmail <= 0 ){
                $datainsert = [
                    'email_subscribed' =>$subscribed['subscribed'],
                    'creator' =>$subscribed['subscribed'],
                    'created' =>date('Y-m-d H:i:s')
                ];
                $allData = $this->db->insert('dk_subscribed',$datainsert);
            }
        } catch (Exception $e) {
            return [];
        }
    }
    public function getDetailProd($idCategory) {
        try {
            $query = "
                select * from translations as T
                LEFT JOIN products as P on  T.for_id = P.id
                where T.for_id = '".$idCategory."' and type = 'product'";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getReleted($shop_categorie, $id) {
        try {
            $query = " select
                        translations.id as kk,
                        products.id as idItems,
                        itemsDetail.title as itemNames,
                        products.image as itemImage,
                        itemsDetail.price as itemsPrice,
                        itemsDetail.old_price as itemsOldPrice
                        from translations
                        left join products on translations.for_id = products.shop_categorie
                        LEFT JOIN (select * from translations where translations.type = 'product') as itemsDetail on products.id = itemsDetail.for_id
                        where translations.type = 'product' and products.shop_categorie = '".$shop_categorie."' and  products.id != ".$id."
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function listReview($id) {
        try {
            $query = "select *  from dk_review where id_product   = ".$id;
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

    public function listItems($limit = null, $start = null, $itemsDetail, $status) {

        try {
            $sort = $this->input->get('sort');
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            if ($status){
                $query = " select
                        translations.id as kk,
                        products.id as idItems,
                        itemsDetail.title as itemNames,
                        products.image as itemImage,
                        itemsDetail.price as itemsPrice,
                        itemsDetail.old_price as itemsOldPrice,
                        itemsDetail.description as decItems
                        from translations
                        left join products on translations.for_id = products.shop_categorie
                        LEFT JOIN (select * from translations where translations.type = 'product') as itemsDetail on products.id = itemsDetail.for_id
                        where translations.type = 'product' and products.shop_categorie = '".$itemsDetail."'
                    ";
                $alldata = $this->db->query($query)->num_rows();
            } else {
                $shortby = "";
                if (!empty($sort)){
                    $shortby = " ORDER BY itemsDetail.price ".$sort;
                }
                $query = " select
                        translations.id as kk,
                        products.id as idItems,
                        itemsDetail.title as itemNames,
                        products.image as itemImage,
                        itemsDetail.price as itemsPrice,
                        itemsDetail.old_price as itemsOldPrice,
                        itemsDetail.description as decItems
                        from translations
                        left join products on translations.for_id = products.shop_categorie
                        LEFT JOIN (select * from translations where translations.type = 'product') as itemsDetail on products.id = itemsDetail.for_id
                        where translations.type = 'product' and products.shop_categorie = '".$itemsDetail."' $shortby  ".$limit_sql."
                    ";

                $alldata = $this->db->query($query)->result_array();
            }
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

}
