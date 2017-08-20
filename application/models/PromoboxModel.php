<?php

class PromoboxModel extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;
    private $num_rows = 1;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('EncryptNative');
    }

    public function getTypePromo($promoId) {
        try {
            $query = "
                    select *
                    from dk_promo
                    where
                    dk_promotion_id = '".$promoId."' ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata[0];
        } catch (Exception $e) {
            return [];
        }
    }
    public function getCategoryPromo($promoId, $kampus) {
        try {
            $query = "
            select  dp.dk_promotion_id,
                    dw.id_warung as idWarung,
                    dc.id_category as idCategory,
                    dmk.name_menu_kampus as nameKampus,
                    dmk.id_menu_kampus as idKampus,
                    dw.name_warung as nameWarung,
                    dc.name_category as nameCategory,
                    dw.id_warung, name_warung,
                    dc.name_category
            from dk_promo as dp
            LEFT JOIN dk_promo_items as dpi on dp.dk_promotion_id = dpi.dk_promotion_id
            LEFT JOIN dk_product as dpc on dpi.id_prod = dpc.id_product
            LEFT JOIN dk_warung as dw on dpc.id_warung = dw.id_warung
            LEFT JOIN dk_category as dc on dw.id_category = dc.id_category
            LEFT JOIN dk_menu_kampus as dmk on dw.id_kampus = dmk.id_menu_kampus
            where dp.dk_promotion_id = '".$promoId."' and dw.id_kampus = '".$kampus."'
            GROUP BY dw.name_warung
            ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getListItemPromo($test, $limit=NULL,$start=NULL, $status) {

        try {
            $q = "select  dp.dk_promotion_id,
                dw.id_warung as idWarung,
                dc.id_category as idCategory,
                dpc.id_product as idProd,
                dmk.name_menu_kampus as nameKampus,
                dmk.id_menu_kampus as idKampus,
                dw.name_warung as nameWarung,
                dc.name_category as nameCategory,
                dw.id_warung, name_warung,
                dc.name_category,
                dpc.title_product as titleProd,
                dpc.desc_product as descProd,
                dpc.basic_produc as basicProd,
                dpc.price_product as priceProd,
                dpc.old_price_product as oldPriceProd,
                dpc.image_product as imageProd
                from dk_promo as dp
                LEFT JOIN dk_promo_items as dpi on dp.dk_promotion_id = dpi.dk_promotion_id
                LEFT JOIN dk_product as dpc on dpi.id_prod = dpc.id_product
                LEFT JOIN dk_warung as dw on dpc.id_warung = dw.id_warung
                LEFT JOIN dk_category as dc on dw.id_category = dc.id_category
                LEFT JOIN dk_menu_kampus as dmk on dw.id_kampus = dmk.id_menu_kampus
                where 1=1
                ";
            $where = "";
            if (!empty($this->input->get('kampus'))) {
                $where .= ' and dw.id_kampus = '.$this->input->get('kampus');
            } else {
                $kampusSession = $this->session->userdata('location');
                if (!empty($kampusSession['kampus'])) {
                    $where .= ' and dw.id_kampus = '.$kampusSession['kampus'];
                }
            }
            if (!empty($this->input->get('kota'))) {
                    $where .= ' and dmk.id_menu_kota = '.$this->input->get('kota');
            } else {
                $kampusSession = $this->session->userdata('location');
                if (!empty($kampusSession['kota'])) {
                    $where .= ' and dmk.id_menu_kota = '.$kampusSession['kota'];
                }
            }

            if (!empty($this->input->get('category'))) {
                $where .= " and dw.id_warung = ".$this->input->get('category');
            }
            if (!empty($this->input->get('search'))) {
                $where .= " and dp.title_product LIKE '%".$this->input->get('search')."%'";
            }
            if (!empty($this->input->get('GC'))) {
                $where .= " and dw.id_category = ".$this->input->get('GC');
            }
            if (!empty($this->input->get('promo'))) {
                $where .= " and dp.dk_promotion_id= ".$this->input->get('promo');
            }
            $order ="";
            if (!empty($this->input->get('sort'))) {
                $order =" ORDER BY priceProd ".$this->input->get('sort');
            }

            if ($status) {
                $limit_sql = '';
                if ($limit !== null && $start !== null) {
                    $limit_sql = ' LIMIT ' . $start . ',' . $limit;
                }
                $query = $q." ".$where." ".$order."".$limit_sql;
                $alldata = $this->db->query($query)->result_array();
                return $alldata;
            } else {
                $query = $q." ".$where;
                $alldata = $this->db->query($query)->num_rows();
                return $alldata;
            }

        } catch (Exception $e) {
            return [];
        }
    }


    public function getPromo($type) {
        try {
            // print_R($this->session->all_userdata());die;
            $loc = $this->session->userdata('location');
            $where = "";
            if (!empty($loc['kampus'])) {
                $where .= " AND dpi.id_menu_kampus = ".$loc['kampus'];
            }
            if (!empty($loc['kota'])) {
                $where .= " AND dpi.id_menu_kota = ".$loc['kota'];
            }
            $query = "select * from dk_promo as dp
                        left join dk_promo_items as dpi on dp.dk_promotion_id = dpi.dk_promotion_id
                        where
                        dp.dk_promotion_type = '".$type."'
                        ".$where."
                        GROUP BY dp.dk_promotion_id
             ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }


    public function getPopularCategori($category="") {
        try {
            $loc = $this->session->userdata('location');
            $where = "";
            if (!empty($loc['kampus'])) {
                $where .= " AND dw.id_kampus = ".$loc['kampus'];
            }
            if (!empty($loc['kota'])) {
                $where .= " AND dpc.id_kota  = ".$loc['kota'];
            }
            $query = "
                    select * from dk_popular_categories as dpc
                    LEFT JOIN dk_category as dc on dpc.id_category = dc.id_category
                    LEFT JOIN dk_warung as dw on dw.id_warung = dc.id_warung
                    LEFT JOIN dk_menu_kampus  as dmk on dw.id_kampus = dmk.id_menu_kampus
                    LEFT JOIN dk_menu_kota as dmkot on dmk.id_menu_kota = dmkot.id_menu_kota
                    where 1=1
                    ".$where."
                    ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }


    public function getPromoDiscount($type) {
        try {
            $loc = $this->session->userdata('location');
            $query = "select * from dk_promo as dp
                    LEFT JOIN dk_popular_categories  as dpc on dp.dk_promotion_id = dpc.id_category
                    LEFT JOIN dk_warung as dw on dpc.id_category = dw.id_category
                    where dw.id_kampus = 1 and dp.dk_promotion_type = '".$type."' and dw.id_kampus = '".$loc['kampus']."'
                    GROUP BY dp.dk_promotion_id
             ";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }
    public function getPromobox($type) {
        try {
            $query = " select  dpi.id_prod  as idProd,  T.title, T.price, T.old_price, P.image  from dk_promo_items as dpi
                      LEFT JOIN dk_promo as dp on dpi.dk_promotion_id = dp.dk_promotion_id
                      LEFT JOIN translations as T on dpi.id_prod = T.id
                      LEFT JOIN products as P on T.for_id = P.id and T.type = 'product'
                      where dpi.dk_promotion_id = '".$type."'";
            $alldata = $this->db->query($query)->result_array();
            return $alldata;
        } catch (Exception $e) {
            return [];
        }
    }

}
