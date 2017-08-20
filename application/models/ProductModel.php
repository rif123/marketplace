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

    public function getItems($start, $limit, $status, $post) {
        $limit_sql = '';
        if ($limit !== null && $start !== null) {
            $limit_sql = ' LIMIT ' . $limit . ',' . $start;
        }
        $order ="";
        if (!empty($this->input->get('sort'))) {
            $order ="ORDER BY dp.price_product ".$this->input->get('sort');
        }
        $where = "";
        if (!empty($post['keyWords'])) {
            $where .= " AND  dp.title_product like '%".$post['keyWords']."%'";
        }
        if (!empty($post['kampus'])) {
            $where .= ' AND dw.id_kampus = '.$post['kampus'];
        } else {
            $kampusSession = $this->session->userdata('location');
            if (!empty($kampusSession['kampus'])) {
                $where .= ' AND dw.id_kampus = '.$kampusSession['kampus'];
            }
        }
        if (!empty($post['kota'])) {
                $where .= ' AND dmk.id_menu_kota = '.$post['kota'];
        } else {
            $kampusSession = $this->session->userdata('location');
            if (!empty($kampusSession['kota'])) {
                $where .= ' AND dmk.id_menu_kota = '.$kampusSession['kota'];
            }
        }
        if (!empty($post['category'])) {
            $where .= ' AND dw.id_category = '.$post['category'];
        }

        $query = 'select * from dk_product as dp
                    LEFT JOIN dk_warung as dw on dp.id_warung = dw.id_warung
                    LEFT JOIN dk_category as dc on dw.id_category = dc.id_category
                    LEFT JOIN dk_menu_kampus as dmk on dw.id_kampus  = dmk.id_menu_kampus
                    LEFT JOIN dk_menu_kota as dmkot on dmk.id_menu_kota = dmkot.id_menu_kota
                    where 1=1
                    '.$where.'
                    '.$order.'
                    ';

        if ($status){
            $q = $query." ".$limit_sql;
            return $this->db->query($q)->result_array();
        } else {
            return $this->db->query($query)->num_rows();
        }

    }

    public function getCategorySearch() {
        try {

            $query = "select
                        dkc.id_category as idCategory,
                        dkc.name_category as nameCategory
                        from dk_category  as dkc
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getSideCategory() {
        try {
            $query = "select
                    	dmk.id_menu_kota as idKota,
                    	dmk.name_menu_kota as nameKota,
                    	dmk.icon as icKota
                     from dk_menu_kota as dmk
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getSideMenu($test) {
        try {

            $query = " select
                        dmk.name_menu_kampus as nameKampus
                        from dk_menu_kampus as dmk
                        where dmk.id_menu_kampus  = '".$test."'
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getSideBaru($test) {
        try {
            $query = " select
                          dw.id_warung as idWarung,
                          dmk.id_menu_kampus as idKampus,
                          dc.id_category as idCategory,
                          dmk.name_menu_kampus as nameKampus,
                          dw.name_warung as nameWarung,
                          dc.name_category as nameCategory
                          from dk_menu_kampus as dmk
                          right join dk_warung as dw on dmk.id_menu_kampus = dw.id_kampus
                          right join dk_category as dc on dw.id_category = dc.id_category
                          where dmk.id_menu_kampus = '".$test."'
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getSearch() {
        try {
            $query = " select
                        dc.id_category as idCategory,
                        dc.name_category as nameCategory,
                        dc.logo_category
                        from dk_category as dc
                        GROUP BY dc.name_category
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getTopSeller($test) {
        try {
          $category ="";
                  if (!empty($this->input->get('category'))) {
                      $category = "and dc.id_category  = ".$this->input->get('category');
                  }
            $query = " select dp.id_product  as idProd,
                      	dp.title_product as titleProd,
                      	dp.image_product as imageProd,
                      	dp.price_product as priceProd,
                      	dp.old_price_product as oldPriceProd,
                      	dp.quantity_product as qtyProd
                        from dk_favorite_product as dfp
                        LEFT JOIN dk_product as dp on dfp.id_product = dp.id_product
                        LEFT JOIN dk_warung as dw on dw.id_warung =  dp.id_warung
                        LEFT JOIN dk_category as dc on dw.id_category = dc.id_category
                        where dw.id_kampus = '".$test."' $category
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getListItems($test, $limit=NULL,$start=NULL) {

        try {

          $limit_sql = '';
                  if ($limit !== null && $start !== null) {
                  $limit_sql = ' LIMIT ' . $start . ',' . $limit;
                  }
          $order ="";
                    if (!empty($this->input->get('sort'))) {
                      $order ="ORDER BY priceProd ".$this->input->get('sort');

                    }
            $category ="";
                    if (!empty($this->input->get('category'))) {
                        $category = "and dw.id_warung = ".$this->input->get('category');
                    }
            $gc ="";
                    if (!empty($this->input->get('GC'))) {
                        $gc = "and dw.id_category = ".$this->input->get('GC');
                    }
            $search ="";
                    if (!empty($this->input->get('search'))) {
                        $search = "and   dp.title_product LIKE '%".$this->input->get('search')."%'";
                    }


            $query = " select
                          dp.id_product as idProd,
                          dp.title_product as titleProd,
                          dp.desc_product as descProd,
                          dp.basic_produc as basicProd,
                          dp.price_product as priceProd,
                          dp.old_price_product as oldPriceProd,
                          dp.image_product as imageProd
                          from dk_product as dp
                          LEFT JOIN dk_warung as dw on dp.id_warung = dw.id_warung
                          where dw.id_kampus = '".$test."' $category $search $gc
                          $order

                          $limit_sql
                    ";
                    // print_r($query);die;
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getListItemsCount() {
        try {
          $category ="";
                  if (!empty($this->input->get('category'))) {
                      $category = "and dw.id_warung = ".$this->input->get('category');
                  }
                  $search ="";
                          if (!empty($this->input->get('search'))) {
                              $search = "and   dp.title_product LIKE '%".$this->input->get('search')."%'";
                          }
                  $gc ="";
                          if (!empty($this->input->get('GC'))) {
                              $gc = "and dw.id_category = ".$this->input->get('GC');
                          }
        $id_campus =$this->input->get('kampus');
            $query = " select
                          dp.id_product as idProd,
                          dp.title_product as titleProd,
                          dp.desc_product as descProd,
                          dp.basic_produc as basicProd,
                          dp.price_product as priceProd,
                          dp.old_price_product as oldPriceProd,
                          dp.image_product as imageProd
                          from dk_product as dp
                          LEFT JOIN dk_warung as dw on dp.id_warung = dw.id_warung
                          where dw.id_kampus = '".$id_campus."' $category $search $gc
                    ";
            $alldata = $this->db->query($query)->num_rows();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getBestSeller() {
        try {

            $query = "select dc.id_category  as idCategory,
                    	dc.name_category as nameCategory,
                    	dc.logo_category as logoCategory,
                    	dc.id_warung as idWarung
                    from dk_category as dc
                                        ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getSeller($value) {
        try {
            $query = "select dp.id_product  as idProd,
                        	dp.title_product as titleProd,
                        	dp.image_product as imageProd,
                        	dp.price_product as priceProd,
                        	dp.old_price_product as oldPriceProd,
                        	dp.quantity_product as qtyProd from dk_favorite_product as dfp
                      LEFT JOIN dk_product as dp on dfp.id_product = dp.id_product
                      LEFT JOIN dk_warung as dw on dw.id_warung =  dp.id_warung
                      LEFT JOIN dk_category as dc on dw.id_category = dc.id_category
                      where dc.id_category = '".$value."'
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getCampus($idKota) {
        try {
            $query = "select
                    	dmk.id_menu_kota as idKota,
                    	dmk.name_menu_kota as nameKota,
                    	dmk.icon as icKota,
                    	k.id_menu_kampus as idKampus,
                    	k.name_menu_kampus as nameKampus
                     from dk_menu_kota as dmk
                    LEFT JOIN dk_menu_kampus as k on dmk.id_menu_kota = k.id_menu_kota
                    where dmk.id_menu_kota = '".$idKota."'
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }





    public function getPopularCategori() {
        try {
            $loc = $this->session->userdata('location');
                $query = "select * from dk_popular_categories as dpc
                        LEFT JOIN dk_category as dc on dpc.id_category = dc.id_category
                        LEFT JOIN dk_warung as dw on dw.id_warung = dc.id_warung
                        where dw.id_kampus = '".$loc['kampus']."'
            ";
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
    public function getDetailProd($post) {
        try {

            $query = "
                select * from dk_product as dp LEFT JOIN dk_warung as dw on dp.id_warung = dw.id_warung
                LEFT JOIN dk_category as dc on dw.id_category = dc.id_category
                LEFT JOIN dk_menu_kampus as dmk on dw.id_kampus = dmk.id_menu_kampus
                LEFT JOIN dk_menu_kota as dmkot on dmk.id_menu_kota = dmkot.id_menu_kota
                where 1=1 and dp.id_product = '".$post['detail']."' ";
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

    public function getItemsList($limit = null, $start = null, $keyWord, $status) {
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
                    where translations.type = 'product'
                    and  itemsDetail.title like '%".$keyWord."%'

                    ".$limit_sql."
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
                    where translations.type = 'product' and  itemsDetail.title like '%".$keyWord."%'
                    $shortby  ".$limit_sql."
                ";
            $alldata = $this->db->query($query)->result_array();
        }
        return $alldata;
    }

    public function addWishlist($getIdProd) {
        $data  = [
            'id_user' => 1,
            'id_prod' => $getIdProd,
            'created' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('dk_wishlist', $data);

    }
    public function delWishlist($getIdProd) {
        $this->db->delete('dk_wishlist', array('id_whislist' => $getIdProd));
    }

    public function globalSearch(){
        $query = "select * from dk_product as dp
                    LEFT JOIN dk_warung as dw on dp.id_warung = dw.id_warung
                    LEFT JOIN dk_menu_kampus as dmk on dw.id_kampus  = dmk.id_menu_kampus
                    LEFT JOIN dk_menu_kota as dmkot on dmk.id_menu_kota = dmkot.id_menu_kota
                    ";
        $query =$this->db->query($query);
        return $query->result_array();
    }

    public function doCart($post) {
        $post['id_client'] = getSession()->id_client;
        $post['created'] = date('Y-m-d H:i:s');
        $post['creator'] = getSession()->id_client;
        $checkExisting  = $this->getItemsCartExisting($post);
        if ($checkExisting) {
            $this->db->where('id_client', $post['id_client']);
            $this->db->where('id_product', $post['id_product']);
            return $this->db->update('dk_cart', ['quantity' => $post['quantity']]);
        } else {
            return $this->db->insert('dk_cart', $post);
        }

    }
    public function getItemsCartExisting($post) {
        $this->db->where('id_client', $post['id_client']);
        $this->db->where('id_product', $post['id_product']);
        $getItems = $this->db->get('dk_cart')->num_rows();
        $result  = $getItems > 0 ? true : false;
        return $result;
    }
    public function doCartUpdate($post) {
        $post['edited'] = date('Y-m-d H:i:s');
        $post['editor'] = "1";
        $this->db->where('id_cart', $post['id_cart']);
        return $this->db->update('dk_cart', $post);
    }
    public function doCartDelete($post) {
        $post['edited'] = date('Y-m-d H:i:s');
        $post['editor'] = getSession()->id_client;
        $this->db->where('id_cart', $post['id_cart']);
        return $this->db->delete('dk_cart');

    }
    public function getCart() {
        $auth = $this->session->userdata('auth');
        $query = "select * from dk_cart as dc
                    LEFT JOIN dk_product as dp on dc.id_product = dp.id_product
                    LEFT JOIN dk_warung as dw on dw.id_warung = dp.id_warung
                    LEFT JOIN dk_menu_kampus as dmk on dw.id_kampus = dmk.id_menu_kampus
                    WHERE dc.id_client = ".$auth->id_client."
                ";
        $query =$this->db->query($query);
        return $query->result_array();
    }
    public function getProv() {
        return $this->db->get('dk_prov')->result_array();
    }
    public function getCity($post) {
        $this->db->where('id_prov', $post['id_prov']);
        return $this->db->get('dk_city')->result_array();
    }
    public function doaddShipping($post) {
        $id_client  = getSession()->id_client;
        $post['created'] = date('Y-m-d H:i:s');
        $post['creator'] = $id_client;
        $post['id_client'] = $id_client;
        if (isset($post['existing'])) {
            return $this->chooseShipping($id_client, $post);
        } else {
            $this->db->insert('dk_shipping', $post);
            $insert_id = $this->db->insert_id();
            $post['id_shipping'] = $insert_id;
            return $this->chooseShipping($id_client, $post);
        }

    }
    private function chooseShipping($id_client, $post) {
        $this->db->where('id_client', $id_client);
        $this->db->where('status_order', 1);
        $checkExistingOrder  = $this->db->get('dk_order')->num_rows();
        if ($checkExistingOrder <= 0){
            $order = [
                'id_client' =>  $id_client,
                'id_shipping' =>  $post['id_shipping'],
                'created' =>  date('Y-m-d, H:i:s'),
                'creator' =>  $id_client
            ];
            return $this->db->insert('dk_order', $order);
        } else {
            $order = [
                'id_client' =>  $id_client,
                'id_shipping' =>  $post['id_shipping'],
                'edited' =>  date('Y-m-d, H:i:s'),
                'editor' =>  $id_client
            ];
            $this->db->where('id_client', $id_client);
            return $this->db->update('dk_order', $order);
        }
    }

    public function getListShipping() {
        $client = getSession()->id_client;
        $this->db->where('id_client', $client);
        $this->db->join('dk_city', 'dk_shipping.id_city = dk_city.id_city', 'left');
        return $this->db->get('dk_shipping')->result_array();
    }
    public function getPayTotal() {
        $query = "select
                        sum(dp.price_product * dc.quantity) as priceTotal from dk_cart as dc
                        LEFT JOIN dk_product as dp on dc.id_product = dp.id_product
                        where dc.id_client = 1";
        return $this->db->query($query)->row();
    }

    public function getListBank() {
        return $this->db->get('dk_m_bank')->result_array();
    }

    public function doOrderstore($post) {
        $client = getSession()->id_client;
        // get order by client
        $this->db->where('id_client', $client);
        $this->db->where('status_order', 1);
        $getOrderId = $this->db->get('dk_order', $client)->row();

        // get total order
        $query  = "select
                    sum(dp.price_product * dc.quantity) as priceTotal from dk_cart as dc
                    LEFT JOIN dk_product as dp on dc.id_product = dp.id_product
                    where dc.id_client = '".$client."'";
        $result = $this->db->query($query)->row();
        $totalPrice = $result->priceTotal;

        // update insert id_bank and total order
        $this->db->where('id_client',$client);
        $this->db->where('status_order',1);
        $order = [
            'id_bank' => $post['id_bank'],
            'total_order' => $totalPrice,
            'status_order' => 2,
            'no_order' => $this->generateNoOrder($getOrderId)
        ];
        $this->db->update('dk_order' , $order);

        // move to detail order
        $query = "
            INSERT INTO dk_order_detail (id_product, id_client, quantity, id_order, created, creator)
            SELECT id_product, id_client, quantity, '".$getOrderId->id_order."', '".date('Y-m-d H:i:s')."', '".$client."'  FROM dk_cart
            where id_client = '".$client."';
        ";
        $this->db->query($query);

        // delete cart
        $this->db->where('id_client', $client);
        $this->db->delete('dk_cart');
        return true;
    }
    private function generateNoOrder($getOrderId) {
        $client = getSession()->id_client;
        $noOrder = $client.$getOrderId->id_order.date('mdyhis').$client;
        return $noOrder;
    }
    public function getOrderConfirm(){
        $client = getSession()->id_client;
        $query = "select
                    dor.id_order,
                    dor.id_client,
                    dor.id_bank,
                    dor.no_order,
                    dor.total_order,
                    dc.name_client,
                    dp.id_product,
                    dp.title_product,
                    dp.desc_product,
                    dp.price_product,
                    dod.quantity,
                    dw.name_warung,
                    dmk.name_menu_kampus,
                    dp.quantity_product,
                    dp.image_product
                    from dk_order as dor
                    LEFT JOIN dk_client as dc  on dor.id_client = dc.id_client
                    LEFT JOIN dk_order_detail as dod on dor.id_order = dod.id_order
                    LEFT JOIN dk_product as dp on dp.id_product = dod.id_product
                    LEFT JOIN dk_warung as dw  on dw.id_warung = dp.id_warung
                    LEFT JOIN dk_menu_kampus as dmk on dw.id_kampus = dmk.id_menu_kampus
                    where dor.status_order = 2
                    and  dor.id_client = '".$client."'
                ";
        $query =$this->db->query($query);
        return $query->result_array();
    }

    public function doConfirmOrder ($data) {
        $client = getSession()->id_client;
        $data['created'] =date('Y-m-d H:i:s');
        $data['creator'] =$client;
        $data['id_client'] = $client;
        if ($this->checkOrder($data)){
            return true;
        } else {
            return false;
        }
    }

    public function checkOrder($data){
        $this->db->where('id_client', $data['creator']);
        $this->db->where('no_order', $data['no_order']);
        $res = $this->db->get('dk_order')->result_array();
        if (!empty($res)){
            // check price items and pay order
            if($this->checkPrice($data, $res)){
                // check get existing field order at dk_confirm_order
                if ($this->checkExistingConfim($data)){
                    // insert data to dk_confirm_order
                    // update data at dk_order
                    return $this->insertConfirm($data);
                } else {
                    return $this->updateConfirm($data);
                }
                return true;
            }
        }
        return false;
    }

    public function checkExistingConfim($data) {
        $this->db->where('id_client', $data['creator']);
        $this->db->where('no_order', $data['no_order']);
        $getData = $this->db->get('dk_confirm_order')->num_rows();
        if ($getData > 0){
            return false;
        }
        return true;
    }
    public function checkPrice($data, $res) {
        if ($data['total_transfer'] >= $res[0]['total_order']) {
            return true;
        }
        return false;
    }

    public function insertConfirm($data) {
        if (!empty($_FILES['filetransfer']['name'])) {
            $config['upload_path'] = './attachments/shop_images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('filetransfer')) {
                $this->session->set_flashdata('message_error',  $this->upload->display_errors());
                redirect("confirm/pay-order");
            }
            $img = $this->upload->data();
            if ($img['file_name'] != null) {
                $data['filetransfer'] = $img['file_name'];
            }
        }
        $this->db->insert('dk_confirm_order', $data);
        // update to dk_order
        $this->db->where('no_order',$data['no_order']);
        $this->db->update('dk_order',['status_order' => 3]);
        return true;
    }
    public function updateConfirm($data) {
        // insert to confirm
        $this->db->where('id_client', $data['creator']);
        $this->db->where('no_order', $data['no_order']);
        $this->db->update('dk_confirm_order', $data);

        // update to dk_order
        $this->db->where('no_order',$data['no_order']);
        $this->db->update('dk_order',['status_order' => 3]);
        return true;
    }

}
