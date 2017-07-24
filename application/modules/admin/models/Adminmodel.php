<?php

class AdminModel extends CI_Model
{

    public function loginCheck($values)
    {
        $arr = array(
            'username' => $values['username'],
            'password' => md5($values['password']),
        );
        $this->db->where($arr);
        $result = $this->db->get('users');
        $resultArray = $result->row_array();
        if ($result->num_rows() > 0) {
            $this->db->where('id', $resultArray['id']);
            $this->db->update('users', array('last_login' => time()));
        }
        return $resultArray;
    }

    public function getMaxProductId()
    {
        $this->db->select_max('id');
        $result = $this->db->get('products');
        $obj = $result->row();
        return $obj->id;
    }

    public function productsCount($search_title = null, $category = null)
    {
        if ($search_title != null) {
            $search_title = trim($this->db->escape_like_str($search_title));
            $this->db->where("(translations.title LIKE '%$search_title%')");
        }
        if ($category != null) {
            $this->db->where('shop_categorie', $category);
        }
        $this->db->join('translations', 'translations.for_id = products.id', 'left');
        $this->db->where('translations.type', 'product');
        $this->db->where('translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        return $this->db->count_all_results('products');
    }

    public function getLanguages()
    {
        $query = $this->db->query('SELECT * FROM languages');
        return $query;
    }

    public function getSeoPages()
    {
        $result = $this->db->get('seo_pages');
        return $result->result_array();
    }

    public function setSeoPageTranslations($translations)
    {
        $i = 0;
        foreach ($translations['pages'] as $page) {
            foreach ($translations['abbr'] as $abbr) {
                $this->db->where('type', 'page_' . $page);
                $this->db->where('abbr', $abbr);
                $num_rows = $this->db->count_all_results('translations');
                if ($num_rows == 0) {
                    $this->db->insert('translations', array(
                        'type' => 'page_' . $page,
                        'abbr' => $abbr,
                        'title' => $translations['title'][$i],
                        'description' => $translations['description'][$i]
                    ));
                } else {
                    $this->db->where('type', 'page_' . $page);
                    $this->db->where('abbr', $abbr);
                    $this->db->update('translations', array(
                        'title' => $translations['title'][$i],
                        'description' => $translations['description'][$i]
                    ));
                }
                $i++;
            }
        }
    }

    public function getSeoTranslations()
    {
        $this->db->like('type', 'page_');
        $result = $this->db->get('translations');
        $arr = array();
        foreach ($result->result_array() as $row) {
            $arr[$row['type']][$row['abbr']]['title'] = $row['title'];
            $arr[$row['type']][$row['abbr']]['description'] = $row['description'];
        }
        return $arr;
    }

    public function countLangs($name = null, $abbr = null)
    {
        if ($name != null) {
            $this->db->where('name', $name);
        }
        if ($abbr != null) {
            $this->db->or_where('abbr', $abbr);
        }
        return $this->db->count_all_results('languages');
    }

    public function getAdminUsers($user = null)
    {
        if ($user != null && is_numeric($user)) {
            $this->db->where('id', $user);
        } else if ($user != null && is_string($user)) {
            $this->db->where('username', $user);
        }
        $query = $this->db->get('users');
        if ($user != null) {
            return $query->row_array();
        } else {
            return $query;
        }
    }
    public function getBankedit($user)
    {
        $this->db->where('id_bank', $user);
        $query = $this->db->get('dk_m_bank');
        return $query->row_array();
    }
    public function getIdentityedit($user)
    {
        $this->db->where('id_identity', $user);
        $query = $this->db->get('dk_identity');
        return $query->row_array();
    }
    public function getBusinessedit($user)
    {
        $this->db->where('id_type_business', $user);
        $query = $this->db->get('dk_type_business');
        return $query->row_array();
    }
    public function getProvedit($user)
    {
        $this->db->where('id_prov', $user);
        $query = $this->db->get('dk_prov');
        return $query->row_array();
    }
    public function getCityedit($user)
    {
      $query =$this->db->query('SELECT dk_city.id_city,
                                      dk_city.id_prov AS no_prov,
                                      dk_city.name AS name_city,
                                      dk_prov.id_prov,
                                      dk_prov.name AS name_prov
                                      FROM dk_city
                                      LEFT JOIN dk_prov ON dk_city.id_prov = dk_prov.id_prov WHERE id_city ='.$user);

        return $query->row_array();
    }
    public function getDistrictsedit($user)
    {
      $query =$this->db->query('SELECT dk_districts.id_districts,
                                      dk_districts.id_city AS no_city,
                                      dk_districts.name AS name_districts,
                                      dk_city.id_city,
                                      dk_city.name AS name_city
                                      FROM dk_districts
                                      LEFT JOIN dk_city ON dk_districts.id_city = dk_city.id_city WHERE id_districts ='.$user);

        return $query->row_array();
    }
    public function getPopulerCategoryedit($user)
    {
      $query =$this->db->query('SELECT * FROM `dk_popular_categories`
                               LEFT JOIN (SELECT * FROM translations where type= "shop_categorie")
                                AS shop ON dk_popular_categories.id_category = shop.for_id
                                LEFT JOIN users ON dk_popular_categories.creator = users.id WHERE id_popular_category ='.$user);

        return $query->row_array();
    }
    public function getPartneredit($user)
    {
        $this->db->where('id_partner', $user);
        $query = $this->db->get('dk_partner');
        return $query->row_array();
    }

    public function getConfigedit($user)
    {
        $this->db->where('id_config', $user);
        $query = $this->db->get('dk_config');
        return $query->row_array();
    }
    public function getPromoedit($user)
    {
        $this->db->where('dk_promotion_id', $user);
        $query = $this->db->get('dk_promo');
        return $query->row_array();
    }
    public function getPromoSlideredit($user)
    {
        $this->db->where('dk_promotion_id', $user);
        $query = $this->db->get('dk_promo');
        return $query->row_array();
    }

    public function getBank($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT dk_m_bank.id_bank,dk_m_bank.name_bank,dk_m_bank.created,dk_m_bank.edited,users.id,users.username
                                FROM dk_m_bank
                                LEFT JOIN users ON dk_m_bank.creator = users.id'. $limit_sql);
            return $query;
        } else {
            // FOR STATUS FALSE
            return $this->db->count_all_results('dk_m_bank');
        }
    }
    public function getIdentity($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT dk_identity.id_identity,dk_identity.name_identity,dk_identity.created,dk_identity.edited,users.id,users.username
                                FROM dk_identity
                                LEFT JOIN users ON dk_identity.creator = users.id'. $limit_sql);
            return $query;
        } else {
            // FOR STATUS FALSE
            return $this->db->count_all_results('dk_identity');
        }
    }
    public function getBusiness($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT dk_type_business.id_type_business,dk_type_business.name_type_business,dk_type_business.created,dk_type_business.edited,users.id,users.username
                                FROM dk_type_business
                                LEFT JOIN users ON dk_type_business.creator = users.id'. $limit_sql);
            return $query;
        } else {
            // FOR STATUS FALSE
            return $this->db->count_all_results('dk_type_business');
        }
    }
    public function getProv($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT * FROM dk_prov'. $limit_sql);

            return $query;
        } else {
            // FOR STATUS FALSE
            return $this->db->count_all_results('dk_prov');
        }
    }
    public function getCity($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT dk_city.id_city,
		                                        dk_city.id_prov AS no_prov,
		                                        dk_city.name AS name_city,dk_prov.id_prov,
		                                        dk_prov.name AS name_prov
                                            FROM dk_city
                                            LEFT JOIN dk_prov ON dk_city.id_prov = dk_prov.id_prov'. $limit_sql);
            return $query;
        } else {
          $query =$this->db->query('SELECT dk_city.id_city,
                                          dk_city.id_prov AS no_prov,
                                          dk_city.name AS name_city,dk_prov.id_prov,
                                          dk_prov.name AS name_prov
                                          FROM dk_city
                                          LEFT JOIN dk_prov ON dk_city.id_prov = dk_prov.id_prov');
          return $query->num_rows();
        }
    }
    public function getDistricts($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT dk_districts.id_districts,
                                            dk_districts.id_city AS no_city,
                                            dk_districts.name AS name_districts,
                                            dk_city.id_city,
                                            dk_city.name AS name_city
                                            FROM dk_districts
                                            LEFT JOIN dk_city ON dk_districts.id_city = dk_city.id_city'. $limit_sql);
            return $query;
        } else {
          $query =$this->db->query('SELECT dk_districts.id_districts,
                                          dk_districts.id_city AS no_city,
                                          dk_districts.name AS name_districts,
                                          dk_city.id_city,
                                          dk_city.name AS name_city
                                          FROM dk_districts
                                          LEFT JOIN dk_city ON dk_districts.id_city = dk_city.id_city');
          return $query->num_rows();
        }
    }
    public function getPopulerCategory($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }

            $query =$this->db->query('SELECT * FROM `dk_popular_categories`
	                                    LEFT JOIN (SELECT * FROM translations where type = "shop_categorie" ) AS shop ON dk_popular_categories.id_category = shop.for_id
                                      LEFT JOIN users ON dk_popular_categories.creator = users.id'. $limit_sql);
            return $query;
        } else {
          $query =$this->db->query('SELECT * FROM `dk_popular_categories`
	                                 LEFT JOIN (SELECT * FROM translations where type= "shop_categorie")
                                    AS shop ON dk_popular_categories.id_category = shop.for_id
                                    LEFT JOIN users ON dk_popular_categories.creator = users.id');
          return $query->num_rows();
        }
    }
    public function getSubscribed($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT * FROM dk_subscribed'. $limit_sql);

            return $query;
        } else {
            // FOR STATUS FALSE
            return $this->db->count_all_results('dk_subscribed');
        }
    }
    public function getRiview($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT dk_review.id_review,dk_review.name_review,dk_review.email_review,dk_review.website_review,dk_review.comment_review,dk_review.created,products.image,users.username FROM dk_review
                                      LEFT JOIN products ON dk_review.id_product = products.id
                                      LEFT JOIN users ON dk_review.creator = users.id'. $limit_sql);

            return $query;
        } else {
            // FOR STATUS FALSE
            return $this->db->count_all_results('dk_review');
        }
    }
    public function getWishlist($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT dk_wishlist.created,dk_wishlist.id_whislist,dk_wishlist.created,dk_client.name_client,products.image,users.username FROM dk_wishlist
                                      LEFT JOIN dk_client ON dk_wishlist.id_user = dk_client.id_client
                                      LEFT JOIN products ON dk_wishlist.id_prod = products.id
                                      LEFT JOIN users ON dk_wishlist.creator = users.id'. $limit_sql);

            return $query;
        } else {
            // FOR STATUS FALSE
            return $this->db->count_all_results('dk_review');
        }
    }
    public function getConfig($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT * FROM dk_config'. $limit_sql);
            return $query;
        } else {
            // FOR STATUS FALSE
            return $this->db->count_all_results('dk_config');
        }
    }
    public function getPartner($limit = null, $start = null, $status){
        // FOR STATUS TRUE
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query =$this->db->query('SELECT *
                                FROM dk_partner
                                LEFT JOIN users ON dk_partner.creator = users.id'. $limit_sql);
            return $query;
        } else {
            // FOR STATUS FALSE
            return $this->db->count_all_results('dk_partner');
        }
    }

        public function getPromo($limit = null, $start = null, $status){
            // FOR STATUS TRUE
            if ($status) {
                // FOR CONFIG LIMIT
                $limit_sql = '';
                if ($limit !== null && $start !== null) {
                    $limit_sql = ' LIMIT ' . $start . ',' . $limit;
                }
                $query =$this->db->query('SELECT dk_promo.dk_promotion_id,dk_promo.dk_head_title,dk_promo.dk_title_promotion,dk_promo.dk_description_promotion,dk_promo.dk_start_date_promotion,dk_promo.dk_end_date_promotion,dk_promo.dk_banner_promotion,dk_promo.dk_promotion_type,dk_promo.dk_promotion_db,dk_promo.dk_status,dk_promo.created,dk_promo.edited,users.username
                                    FROM dk_promo
                                    LEFT JOIN users ON dk_promo.creator = users.id
                    								WHERE dk_promotion_type ="1"'. $limit_sql);
                return $query;
            } else {
                // FOR STATUS FALSE
                $promotionType =1;
                        $this->db->where('dk_promotion_type',$promotionType);
                return $this->db->count_all_results('dk_promo');
            }
        }
        public function getPromoSlider($limit = null, $start = null, $status){
            // FOR STATUS TRUE
            if ($status) {
                // FOR CONFIG LIMIT
                $limit_sql = '';
                if ($limit !== null && $start !== null) {
                    $limit_sql = ' LIMIT ' . $start . ',' . $limit;
                }
                $query =$this->db->query('SELECT dk_promo.dk_promotion_id,dk_promo.dk_head_title,dk_promo.dk_title_promotion,dk_promo.dk_description_promotion,dk_promo.dk_start_date_promotion,dk_promo.dk_end_date_promotion,dk_promo.dk_banner_promotion,dk_promo.dk_promotion_type,dk_promo.dk_promotion_db,dk_promo.dk_status,dk_promo.created,dk_promo.edited,users.username
                                    FROM dk_promo
                                    LEFT JOIN users ON dk_promo.creator = users.id
                    								WHERE dk_promotion_type ="2"'. $limit_sql);
                return $query;
            } else {
                // FOR STATUS FALSE
                $promotionType =2;
                        $this->db->where('dk_promotion_type',$promotionType);
                return $this->db->count_all_results('dk_promo');
            }
        }
    public function getPopuler(){
            $user ='shop_categorie';
              $this->db->where('type', $user);
        $query =$this->db->get('translations');

        return $query->result_array();
    }
    public function getDetailStore($limit = null, $start = null, $status){
     // FOR STATUS TRUE
     if ($status) {
         // FOR CONFIG LIMIT
         $limit_sql = '';
         if ($limit !== null && $start !== null) {
             $limit_sql = ' LIMIT ' . $start . ',' . $limit;
         }
         $query =$this->db->query('SELECT dk_detail_store.id_detail_store,dk_detail_store.addres_detail_store,dk_detail_store.filelogo_detail_store,dk_detail_store.postal_code,dk_detail_store.desc_detail_store,dk_detail_store.prod_origin_store,dk_detail_store.filelicense_detail_store,dk_detail_store.referal_detail_store,dk_detail_store.created,dk_client.id_client,dk_client.name_client,dk_prov.id_prov,users.username,users.id,
                                   dk_prov.name AS name_prov,
                                   dk_city.name AS name_city,
                                   dk_districts.name AS name_districts,
                                   dk_type_business.name_type_business AS name_type_business
                             FROM dk_detail_store
                             LEFT JOIN users ON dk_detail_store.creator = users.id
                             LEFT JOIN dk_client ON dk_detail_store.id_client = dk_client.id_client
                             LEFT JOIN dk_prov ON dk_detail_store.id_prov = dk_prov.id_prov
                             LEFT JOIN dk_city ON dk_detail_store.id_city = dk_city.id_city
                             LEFT JOIN dk_districts ON dk_detail_store.id_districts = dk_districts.id_districts
                             LEFT JOIN dk_type_business ON dk_detail_store.id_type_business = dk_type_business.id_type_business'.$limit_sql);

         return $query;

     } else {
         // FOR STATUS FALSE
         return $this->db->count_all_results('dk_detail_store');
     }
 }
 public function getStore($limit = null, $start = null, $status){
   // FOR STATUS TRUE
   if ($status) {
       // FOR CONFIG LIMIT
       $limit_sql = '';
       if ($limit !== null && $start !== null) {
           $limit_sql = ' LIMIT ' . $start . ',' . $limit;
       }
       $query =$this->db->query('SELECT dk_store.id_store,dk_store.original_name_store,dk_store.name_store,dk_store.no_identity_store,dk_store.file_identity_store,dk_store.npwp_store,dk_store.address_store,dk_store.postal_code,dk_store.created,dk_client.id_client,dk_client.name_client,users.username,users.id,
                                 dk_prov.name AS name_prov,
                                 dk_city.name AS name_city,
                                 dk_districts.name AS name_districts,
                                 dk_identity.name_identity AS name_identity
                           FROM dk_store
                           LEFT JOIN users ON dk_store.creator = users.id
                           LEFT JOIN dk_client ON dk_store.id_client = dk_client.id_client
                           LEFT JOIN dk_prov ON dk_store.id_prov = dk_prov.id_prov
                           LEFT JOIN dk_city ON dk_store.id_city = dk_city.id_city
                           LEFT JOIN dk_districts ON dk_store.id_districts = dk_districts.id_districts
                           LEFT JOIN dk_identity ON dk_store.id_identity = dk_identity.id_identity'.$limit_sql);

       return $query;

   } else {
       // FOR STATUS FALSE
       return $this->db->count_all_results('dk_store');
   }
}
public function getBankClient($limit = null, $start = null, $status){
       // FOR STATUS TRUE
       if ($status) {
           // FOR CONFIG LIMIT
           $limit_sql = '';
           if ($limit !== null && $start !== null) {
               $limit_sql = ' LIMIT ' . $start . ',' . $limit;
           }
           $query =$this->db->query('SELECT dk_bankClient.id_bankClient,dk_bankClient.substation_bankClient,dk_bankClient.name_rek_bankClient,dk_bankClient.no_rek_bankClient,dk_bankClient.fileBookrek_bankClient,dk_bankClient.created,users.username,users.id,dk_client.id_client,dk_client.name_client,dk_m_bank.id_bank,dk_m_bank.name_bank
                               FROM dk_bankClient
                               LEFT JOIN users ON dk_bankClient.creator = users.id
                               LEFT JOIN dk_client ON dk_bankClient.id_client = dk_client.id_client
                               LEFT JOIN dk_m_bank ON dk_bankClient.id_bank = dk_m_bank.id_bank'. $limit_sql);

           return $query;

       } else {
           // FOR STATUS FALSE
           return $this->db->count_all_results('dk_bankClient');
       }
   }

    public function getProvs(){
        $query =$this->db->get('dk_prov');

        return $query->result_array();
    }
    public function getCitys(){
        $query =$this->db->get('dk_city');

        return $query->result_array();
    }
    public function updateBank($POST){
      $datasession = $this->session->userdata();
      $this->db->where('name_bank',$POST['name_bank']);
      $result =$this->db->get('dk_m_bank');
      if ($result->num_rows() == 0) {
        $data = array(
        'name_bank' => $POST['name_bank'],
        'editor' => $datasession['authlog']['id'],
        'edited' => date('Y-m-d H:i:s')
        );

        $this->db->where('id_bank', $POST['edit']);
        $result =$this->db->update('dk_m_bank', $data);
      }else{
        $result =false;
      }

        return $result;

    }
    public function updateIdentity($POST){
      $datasession = $this->session->userdata();
      $this->db->where('name_identity',$POST['name_identity']);
      $result =$this->db->get('dk_identity');
      if ($result->num_rows() == 0) {
        $data = array(
        'name_identity' => $POST['name_identity'],
        'editor' => $datasession['authlog']['id'],
        'edited' => date('Y-m-d H:i:s')
        );

        $this->db->where('id_identity', $POST['edit']);
        $result =$this->db->update('dk_identity', $data);
      }else{
        $result =false;
      }

        return $result;

    }
    public function updateBusiness($POST){
      $datasession = $this->session->userdata();
      $this->db->where('name_type_business',$POST['name_type_business']);
      $result =$this->db->get('dk_type_business');
      if ($result->num_rows() == 0) {
        $data = array(
        'name_type_business' => $POST['name_type_business'],
        'editor' => $datasession['authlog']['id'],
        'edited' => date('Y-m-d H:i:s')
        );

        $this->db->where('id_type_business', $POST['edit']);
        $result =$this->db->update('dk_type_business', $data);
      }else{
        $result =false;
      }

        return $result;

    }
    public function updateProv($POST){
      $this->db->where('name',$POST['name']);
      $result =$this->db->get('dk_prov');
      if ($result->num_rows() == 0) {
        $data = array(
        'name' => $POST['name']
        );

        $this->db->where('id_prov', $POST['edit']);
        $result =$this->db->update('dk_prov', $data);
      }else{
        $result =false;
      }

        return $result;

    }
    public function updateCity($POST){
      $this->db->where('name',$POST['name']);
      $result =$this->db->get('dk_city');
      if ($result->num_rows() == 0) {
        $data = array(
        'name' => $POST['name'],
        'id_prov' => $POST['provinces']
        );

        $this->db->where('id_city', $POST['edit']);
        $result =$this->db->update('dk_city', $data);
      }else{
        $result =false;
      }

        return $result;

    }
    public function updateDistricts($POST){
      $this->db->where('name',$POST['name']);
      $result =$this->db->get('dk_districts');
      if ($result->num_rows() == 0) {
        $data = array(
        'name' => $POST['name'],
        'id_city' => $POST['citys']
        );

        $this->db->where('id_districts', $POST['edit']);
        $result =$this->db->update('dk_districts', $data);
      }else{
        $result =false;
      }

        return $result;

    }
    public function updatePopulerCategory($POST){
      $datasession = $this->session->userdata();
      $this->db->where('id_category',$POST['id_category']);
      $result =$this->db->get('dk_popular_categories');
      if ($result->num_rows() == 0) {
        $data = array(
        'id_category' => $POST['id_category'],
        'editor' => $datasession['authlog']['id'],
        'edited' => date('Y-m-d H:i:s')
        );

        $this->db->where('id_popular_category', $POST['edit']);
        $result =$this->db->update('dk_popular_categories', $data);
      }else{
        $result =false;
      }

        return $result;

    }
    public function updatePartner($POST){
      $datasession = $this->session->userdata();
      $this->db->where('name_partner',$POST['name_partner']);
      $result =$this->db->get('dk_partner');

      if ($result->num_rows() == 0) {
        $data = array(
        'name_partner' => $POST['name_partner'],
        'img_partner' => $POST['img_partner'],
        'editor' => $datasession['authlog']['id'],
        'edited' => date('Y-m-d H:i:s')
        );

        $this->db->where('id_partner', $POST['edit']);
        $result =$this->db->update('dk_partner', $data);
      }else{
        $result =false;
      }

        return $result;

    }
    public function updatePromo($test){
      $datasession = $this->session->userdata();
      $result =$this->db->get('dk_partner');
        $data = array(
            'dk_head_title' =>$test['dk_head_title'],
            'dk_title_promotion' =>$test['dk_title_promotion'],
            'dk_description_promotion' =>$test['dk_description_promotion'],
            'dk_start_date_promotion' =>$test['dk_start_date_promotion'],
            'dk_end_date_promotion' =>$test['dk_end_date_promotion'],
            'dk_banner_promotion' =>$test['dk_banner_promotion'],
            'dk_promotion_type' =>1,
            'dk_promotion_db' =>'dk_promo_discount',
            'dk_status' =>$test['dk_status'],
            'editor' => $datasession['authlog']['id'],
            'edited' => date('Y-m-d H:i:s')

          );

        $this->db->where('dk_promotion_id', $test['edit']);
        $result =$this->db->update('dk_promo', $data);

        return $result;

    }
    public function updatePromoSlider($test){
      $datasession = $this->session->userdata();
      $result =$this->db->get('dk_partner');

      if (!empty($test['dk_banner_promotion'])) {

        $data = array(
            'dk_head_title' =>$test['dk_head_title'],
            'dk_title_promotion' =>$test['dk_title_promotion'],
            'dk_description_promotion' =>$test['dk_description_promotion'],
            'dk_start_date_promotion' =>$test['dk_start_date_promotion'],
            'dk_end_date_promotion' =>$test['dk_end_date_promotion'],
            'dk_banner_promotion' =>$test['dk_banner_promotion'],
            'dk_promotion_type' =>2,
            'dk_promotion_db' =>'dk_promo_sliders',
            'dk_status' =>$test['dk_status'],
            'editor' => $datasession['authlog']['id'],
            'edited' => date('Y-m-d H:i:s')

          );
        }else{
          $data = array(
            'dk_head_title' =>$test['dk_head_title'],
            'dk_title_promotion' =>$test['dk_title_promotion'],
            'dk_description_promotion' =>$test['dk_description_promotion'],
            'dk_start_date_promotion' =>$test['dk_start_date_promotion'],
            'dk_end_date_promotion' =>$test['dk_end_date_promotion'],
            'dk_promotion_type' =>2,
            'dk_promotion_db' =>'dk_promo_sliders',
            'dk_status' =>$test['dk_status'],
            'editor' => $datasession['authlog']['id'],
            'edited' => date('Y-m-d H:i:s')

          );

        }

        $this->db->where('dk_promotion_id', $test['edit']);
        $result =$this->db->update('dk_promo', $data);

        return $result;

    }


    public function saveDataBank($test){
        $datasession = $this->session->userdata();
          $this->db->where('name_bank',$test['name_bank']);
          $result =$this->db->get('dk_m_bank');

          if ($result->num_rows() == 0) {
            $data = array(
              'name_bank' =>$test['name_bank'],
              'creator' => $datasession['authlog']['id'],
              'created' => date('Y-m-d H:i:s')

            );
            $result =$this->db->insert('dk_m_bank', $data);

          }else{
            $result =false;
          }


      return $result;
    }
    public function savePromo($test){
        $datasession = $this->session->userdata();
          $data = array(
              'dk_head_title' =>$test['dk_head_title'],
              'dk_title_promotion' =>$test['dk_title_promotion'],
              'dk_description_promotion' =>$test['dk_description_promotion'],
              'dk_start_date_promotion' =>$test['dk_start_date_promotion'],
              'dk_end_date_promotion' =>$test['dk_end_date_promotion'],
              'dk_banner_promotion' =>$test['dk_banner_promotion'],
              'dk_promotion_type' =>1,
              'dk_promotion_db' =>'dk_promo_discount',
              'dk_status' =>$test['dk_status'],
              'creator' => $datasession['authlog']['id'],
              'created' => date('Y-m-d H:i:s')

            );
            $result =$this->db->insert('dk_promo', $data);

      return $result;
    }
    public function savePromoSlider($test){
        $datasession = $this->session->userdata();
          $data = array(
              'dk_head_title' =>$test['dk_head_title'],
              'dk_title_promotion' =>$test['dk_title_promotion'],
              'dk_description_promotion' =>$test['dk_description_promotion'],
              'dk_start_date_promotion' =>$test['dk_start_date_promotion'],
              'dk_end_date_promotion' =>$test['dk_end_date_promotion'],
              'dk_banner_promotion' =>$test['dk_banner_promotion'],
              'dk_promotion_type' =>2,
              'dk_promotion_db' =>'dk_promo_sliders',
              'dk_status' =>$test['dk_status'],
              'creator' => $datasession['authlog']['id'],
              'created' => date('Y-m-d H:i:s')

            );
            $result =$this->db->insert('dk_promo', $data);

      return $result;
    }
    public function saveIdentity($test){
        $datasession = $this->session->userdata();
          $this->db->where('name_identity',$test['name_identity']);
          $result =$this->db->get('dk_identity');

          if ($result->num_rows() == 0) {
            $data = array(
              'name_identity' =>$test['name_identity'],
              'creator' => $datasession['authlog']['id'],
              'created' => date('Y-m-d H:i:s')

            );
            $result =$this->db->insert('dk_identity', $data);

          }else{
            $result =false;
          }


      return $result;
    }
    public function saveBusiness($test){
        $datasession = $this->session->userdata();
          $this->db->where('name_type_business',$test['name_type_business']);
          $result =$this->db->get('dk_type_business');

          if ($result->num_rows() == 0) {
            $data = array(
              'name_type_business' =>$test['name_type_business'],
              'creator' => $datasession['authlog']['id'],
              'created' => date('Y-m-d H:i:s')

            );
            $result =$this->db->insert('dk_type_business', $data);

          }else{
            $result =false;
          }


      return $result;
    }
    public function saveProv($test){
          $this->db->where('name',$test['name']);
          $result =$this->db->get('dk_prov');

          if ($result->num_rows() == 0) {
            $data = array(
              'name' =>$test['name']
            );
            $result =$this->db->insert('dk_prov', $data);

          }else{
            $result =false;
          }


      return $result;
    }
    public function saveCity($test){
          $this->db->where('name',$test['name']);
          $result =$this->db->get('dk_city');

          if ($result->num_rows() == 0) {
            $data = array(
              'id_prov' =>$test['provinces'],
              'name' =>$test['name']
            );
            $result =$this->db->insert('dk_city', $data);

          }else{
            $result =false;
          }


      return $result;
    }
    public function saveDistricts($test){
          $this->db->where('name',$test['name']);
          $result =$this->db->get('dk_districts');

          if ($result->num_rows() == 0) {
            $data = array(
              'id_city' =>$test['citys'],
              'name' =>$test['name']
            );
            $result =$this->db->insert('dk_districts', $data);

          }else{
            $result =false;
          }


      return $result;
    }
    public function savePopulerCategory($test){
        $datasession = $this->session->userdata();
          $this->db->where('id_category',$test['id_category']);
          $result =$this->db->get('dk_popular_categories');

          if ($result->num_rows() == 0) {
            $data = array(
              'id_category' =>$test['id_category'],
              'creator' =>$datasession['authlog']['id'],
              'credited' => date('Y-m-d H:i:s')
            );
            $result =$this->db->insert('dk_popular_categories', $data);

          }else{
            $result =false;
          }


      return $result;
    }
    public function saveConfig($test){

    $result =$this->db->get('dk_config');

    if ($result->num_rows() == 0) {
      $data = array(
        'telp_config' =>$test['telp_config'],
        'logofile_config' =>$test['image'],
        'fb_config' =>$test['fb_config'],
        'logo_fb_config' =>$test['logo_fb_config'],
        'twit_config' =>$test['twit_config'],
        'logo_twit_config' =>$test['logo_twit_config'],
        'gp_config' =>$test['gp_config'],
        'logo_gp_config' =>$test['logo_gp_config'],
        'li_config' =>$test['li_config'],
        'logo_li_config' =>$test['logo_li_config'],
        'skype_config' =>$test['skype_config'],
        'footer_tittle_config' =>$test['footer_tittle_config'],
        'logo_skype_config' =>$test['logo_skype_config'],
        'cc_config' =>$test['cc_config'],
        'favicon_config' =>$test['favicon_config']

      );
      $result =$this->db->insert('dk_config', $data);

    }else{
      if ($test['image']=="") {
        $data = array(
          'telp_config' =>$test['telp_config'],
          'fb_config' =>$test['fb_config'],
          'logo_fb_config' =>$test['logo_fb_config'],
          'twit_config' =>$test['twit_config'],
          'logo_twit_config' =>$test['logo_twit_config'],
          'gp_config' =>$test['gp_config'],
          'logo_gp_config' =>$test['logo_gp_config'],
          'li_config' =>$test['li_config'],
          'logo_li_config' =>$test['logo_li_config'],
          'skype_config' =>$test['skype_config'],
          'footer_tittle_config' =>$test['footer_tittle_config'],
          'logo_skype_config' =>$test['logo_skype_config']
        );
      }else{

      $data = array(
        'telp_config' =>$test['telp_config'],
        'logofile_config' =>$test['image'],
        'fb_config' =>$test['fb_config'],
        'logo_fb_config' =>$test['logo_fb_config'],
        'twit_config' =>$test['twit_config'],
        'logo_twit_config' =>$test['logo_twit_config'],
        'gp_config' =>$test['gp_config'],
        'logo_gp_config' =>$test['logo_gp_config'],
        'li_config' =>$test['li_config'],
        'logo_li_config' =>$test['logo_li_config'],
        'skype_config' =>$test['skype_config'],
        'footer_tittle_config' =>$test['footer_tittle_config'],
        'logo_skype_config' =>$test['logo_skype_config']
      );
    }
      $result =$this->db->update('dk_config', $data);
    }
    return $result;
  }

    public function savePartner($test){
        $datasession = $this->session->userdata();
          $this->db->where('name_partner',$test['name_partner']);
          $result =$this->db->get('dk_partner');

          if ($result->num_rows() == 0) {
            $data = array(
              'name_partner' =>$test['name_partner'],
              'img_partner' =>$test['img_partner'],
              'creator' => $datasession['authlog']['id'],
              'created' => date('Y-m-d H:i:s')

            );
            $result =$this->db->insert('dk_partner', $data);

          }else{
            $result =false;
          }


      return $result;
    }



    public function numShopProducts()
    {
        return $this->db->count_all_results('products');
    }

    public function setLanguage($post)
    {
        $post['name'] = strtolower($post['name']);
        $post['abbr'] = strtolower($post['abbr']);
        $result = $this->db->insert('languages', $post);
        return $result;
    }

    public function setAdminUser($post)
    {
        if ($post['edit'] > 0) {
            if (trim($post['password']) == '') {
                unset($post['password']);
            } else {
                $post['password'] = md5($post['password']);
            }
            $this->db->where('id', $post['edit']);
            unset($post['id'], $post['edit']);
            $result = $this->db->update('users', $post);
        } else {
            unset($post['edit']);
            $post['password'] = md5($post['password']);
            $result = $this->db->insert('users', $post);
        }
        return $result;
    }

    public function deleteLanguage($id)
    {
        $this->db->select('abbr');
        $this->db->where('id', $id);
        $res = $this->db->get('languages');
        $row = $res->row_array();
        $this->db->trans_start();
        $this->db->query('DELETE FROM languages WHERE id = ' . $this->db->escape($id));
        $this->db->query('DELETE FROM translations WHERE abbr = ' . $row['abbr']);
        $this->db->query('DELETE FROM cookie_law_translations WHERE abbr = ' . $row['abbr']);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        return true;
    }

    public function deleteAdminUser($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->delete('users');
        return $result;
    }
    public function deleteBank($id)
    {
        $this->db->where('id_bank', $id);
        $result = $this->db->delete('dk_m_bank');
        return $result;
    }
    public function deleteIdentity($id)
    {
        $this->db->where('id_identity', $id);
        $result = $this->db->delete('dk_identity');
        return $result;
    }
    public function deleteBusiness($id)
    {
        $this->db->where('id_type_business', $id);
        $result = $this->db->delete('dk_type_business');
        return $result;
    }
    public function deleteProv($id)
    {
        $this->db->where('id_prov', $id);
        $result = $this->db->delete('dk_prov');
        return $result;
    }
    public function deleteCity($id)
    {
        $this->db->where('id_city', $id);
        $result = $this->db->delete('dk_city');
        return $result;
    }
    public function deleteDistricts($id)
    {
        $this->db->where('id_districts', $id);
        $result = $this->db->delete('dk_districts');
        return $result;
    }
    public function deletePopulerCategory($id)
    {
        $this->db->where('id_popular_category', $id);
        $result = $this->db->delete('dk_popular_categories');
        return $result;
    }
    public function deleteSubscribed($id)
    {
        $this->db->where('id_subscribed', $id);
        $result = $this->db->delete('dk_subscribed');
        return $result;
    }
    public function deleteReview($id)
    {
        $this->db->where('id_review', $id);
        $result = $this->db->delete('dk_review');
        return $result;
    }
    public function deletePartner($id)
    {
        $this->db->where('id_partner', $id);
        $result = $this->db->delete('dk_partner');
        return $result;
    }
    public function deletePromo($id)
    {
        $this->db->where('dk_promotion_id', $id);
        $result = $this->db->delete('dk_promo');
        return $result;
    }
    public function deletePromoSlider($id)
    {
        $this->db->where('dk_promotion_id', $id);
        $result = $this->db->delete('dk_promo');
        return $result;
    }

    public function setProduct($post, $id = 0)
    {
        if ($id > 0) {
            unset($post['title_for_url']);
            $post['time_update'] = time();
            $result = $this->db->where('id', $id)->update('products', $post);
        } else {
            if (trim($post['title_for_url']) != '') {
                $url_fr = except_letters($post['title_for_url']);
            } else {
                $url_fr = 'shop-product';
            }
            unset($post['title_for_url']);
            $this->db->select_max('id');
            $query = $this->db->get('products');
            $rr = $query->row_array();
            $post['id'] = $rr['id'] + 1;
            $post['url'] = str_replace(' ', '_', $url_fr . '_' . $post['id']);
            $post['time'] = time();
            unset($post['id']);
            $result = $this->db->insert('products', $post);
            $last_id = $this->db->insert_id();
        }
        if ($result == false)
            return false;
        else {
            if ($id > 0)
                return $id;
            else
                return $last_id;
        }
    }

    public function setPage($name)
    {
        $name = strtolower($name);
        $name = str_replace(' ', '-', $name);
        $this->db->insert('active_pages', array('name' => $name, 'enabled' => 1));
        $thisId = $this->db->insert_id();
        $languages = $this->getLanguages();
        foreach ($languages->result() as $language) {
            $this->db->insert('translations', array(
                'type' => 'page',
                'for_id' => $thisId,
                'abbr' => $language->abbr
            ));
        }
    }

    public function deletePage($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('active_pages');

        $this->db->where('for_id', $id);
        $this->db->where('type', 'page');
        $this->db->delete('translations');
    }

    public function setProductTranslation($post, $id, $is_update)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id, 'product');
        foreach ($post['abbr'] as $abbr) {
            $arr = array();
            $emergency_insert = false;
            if (!isset($current_trans[$abbr])) {
                $emergency_insert = true;
            }
            $post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
            $post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
            $post['price'][$i] = str_replace(',', '', $post['price'][$i]);
            $arr = array(
                'title' => $post['title'][$i],
                'basic_description' => $post['basic_description'][$i],
                'description' => $post['description'][$i],
                'price' => $post['price'][$i],
                'old_price' => $post['old_price'][$i],
                'abbr' => $abbr,
                'for_id' => $id,
                'type' => 'product'
            );
            if ($is_update === true && $emergency_insert === false) {
                $abbr = $arr['abbr'];
                unset($arr['for_id'], $arr['abbr'], $arr['url']);
                $this->db->where('abbr', $abbr)->where('for_id', $id)->where('type', 'product')->update('translations', $arr);
            } else
                $this->db->insert('translations', $arr);
            $i++;
        }
    }

    public function getShopCategories($limit = null, $start = null)
    {
        $limit_sql = '';
        if ($limit !== null && $start !== null) {
            $limit_sql = ' LIMIT ' . $start . ',' . $limit;
        }

        $query = $this->db->query('SELECT translations_first.*,
        (SELECT name FROM translations WHERE for_id = sub_for AND type="shop_categorie" AND abbr = translations_first.abbr) as sub_is, shop_categories.position
        FROM translations as translations_first
        INNER JOIN shop_categories ON shop_categories.id = translations_first.for_id WHERE type="shop_categorie" ORDER BY position ASC ' . $limit_sql);
        $arr = array();
          foreach ($query->result() as $shop_categorie) {
            $arr[$shop_categorie->for_id]['info'][] = array(
                'abbr' => $shop_categorie->abbr,
                'name' => $shop_categorie->name
            );
            $arr[$shop_categorie->for_id]['sub'][] = $shop_categorie->sub_is;
            $arr[$shop_categorie->for_id]['position'] = $shop_categorie->position;
        }
        return $arr;
    }

    public function categoriesCount()
    {
        return $this->db->count_all_results('shop_categories');
    }

    public function setShopCategorie($post)
    {
        $this->db->insert('shop_categories', array('sub_for' => $post['sub_for']));
        $id = $this->db->insert_id();

        $i = 0;
        foreach ($post['translations'] as $abbr) {
            $arr = array();
            $arr['abbr'] = $abbr;
            $arr['type'] = 'shop_categorie';
            $arr['name'] = $post['categorie_name'][$i];
            $arr['for_id'] = $id;
            $arr['banner'] = $post['image'];
            $result = $this->db->insert('translations', $arr);
            $i++;
        }
        return $result;
    }

    public function editShopCategorieSub($post)
    {
        if ($post['editSubId'] != $post['newSubIs']) {
            $this->db->where('id', $post['editSubId']);
            $result = $this->db->update('shop_categories', array(
                'sub_for' => $post['newSubIs']
            ));
        } else {
            $result = false;
        }
        return $result;
    }

    public function deleteShopCategorie($id)
    {
        $this->db->where('for_id', $id);
        $this->db->where('type', 'shop_categorie');
        $this->db->delete('translations');

        $this->db->where('id', $id);
        $this->db->or_where('sub_for', $id);
        $result = $this->db->delete('shop_categories');
        return $result;
    }

    public function historyCount()
    {
        return $this->db->count_all_results('history');
    }

    public function ordersCount($onlyNew = false)
    {
        if ($onlyNew == true) {
            $this->db->where('viewed', 0);
        }
        return $this->db->count_all_results('orders');
    }

    public function countLowQuantityProducts()
    {
        $this->db->where('quantity <=', 5);
        return $this->db->count_all_results('products');
    }

    public function emailsCount()
    {
        return $this->db->count_all_results('subscribed');
    }

    public function lastSubscribedEmailsCount()
    {
        $yesterday = strtotime('-1 day', time());
        $this->db->where('time > ', $yesterday);
        return $this->db->count_all_results('subscribed');
    }

    public function setHistory($activity, $user)
    {
        $this->db->insert('history', array('activity' => $activity, 'username' => $user, 'time' => time()));
    }

    public function getHistory($limit, $page)
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')->get('history', $limit, $page);
        return $query;
    }

    public function getProducts($limit, $page, $search_title = null, $orderby = null, $category = null)
    {
        if ($search_title != null) {
            $search_title = trim($this->db->escape_like_str($search_title));
            $this->db->where("(translations.title LIKE '%$search_title%')");
        }
        if ($orderby !== null) {
            $ord = explode('=', $orderby);
            if (isset($ord[0]) && isset($ord[1])) {
                $this->db->order_by('products.' . $ord[0], $ord[1]);
            }
        } else {
            $this->db->order_by('products.position', 'asc');
        }
        if ($category != null) {
            $this->db->where('shop_categorie', $category);
        }
        $this->db->join('translations', 'translations.for_id = products.id', 'left');
        $this->db->where('translations.type', 'product');
        $this->db->where('translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $query = $this->db->select('products.*, translations.title, translations.description, translations.price, translations.old_price, translations.abbr, products.url, translations.for_id, translations.type, translations.basic_description')->get('products', $limit, $page);
        return $query;
    }

    public function getOneProduct($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function deleteproduct($id)
    {
        $this->deleteTranslations($id, 'product');
        $this->db->where('id', $id);
        $result = $this->db->delete('products');
        return $result;
    }

    public function getMostSoldProducts($limit = 10)
    {
        $this->db->select('url, procurement');
        $this->db->order_by('procurement', 'desc');
        $this->db->where('procurement >', 0);
        $this->db->limit($limit);
        $queryResult = $this->db->get('products');
        return $queryResult->result_array();
    }

    public function getReferralOrders()
    {

        $this->db->select('count(id) as num, clean_referrer as referrer');
        $this->db->group_by('clean_referrer');
        $queryResult = $this->db->get('orders');
        return $queryResult->result_array();
    }

    public function getOrdersByPaymentType($limit = 10)
    {
        $this->db->select('count(id) as num, payment_type');
        $this->db->group_by('payment_type');
        $this->db->limit($limit);
        $queryResult = $this->db->get('orders');
        return $queryResult->result_array();
    }

    private function deleteTranslations($id, $type)
    {
        $this->db->where('for_id', $id);
        $this->db->where('type', $type);
        $this->db->delete('translations');
    }

    public function getTranslations($id, $type)
    {
        $this->db->where('for_id', $id);
        $this->db->where('type', $type);
        $query = $this->db->select('*')->get('translations');
        $arr = array();
        foreach ($query->result() as $row) {
            $arr[$row->abbr]['title'] = $row->title;
            $arr[$row->abbr]['basic_description'] = $row->basic_description;
            $arr[$row->abbr]['description'] = $row->description;
            $arr[$row->abbr]['price'] = $row->price;
            $arr[$row->abbr]['old_price'] = $row->old_price;
        }
        return $arr;
    }

    public function setBlogTranslations($post, $id, $is_update)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id, 'blog');
        foreach ($post['abbr'] as $abbr) {
            $arr = array();
            $emergency_insert = false;
            if (!isset($current_trans[$abbr])) {
                $emergency_insert = true;
            }
            $post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
            $arr = array(
                'title' => $post['title'][$i],
                'description' => $post['description'][$i],
                'abbr' => $abbr,
                'for_id' => $id,
                'type' => 'blog'
            );
            if ($is_update === true && $emergency_insert === false) {
                $abbr = $arr['abbr'];
                unset($arr['for_id'], $arr['abbr'], $arr['url']);
                $this->db->where('abbr', $abbr)->where('for_id', $id)->where('type', 'blog')->update('translations', $arr);
            } else
                $this->db->insert('translations', $arr);
            $i++;
        }
    }

    public function setEditPageTranslations($post, $id)
    {
        $i = 0;
        foreach ($post['abbr'] as $abbr) {
            $arr = array(
                'name' => $post['name'][$i],
                'description' => $post['description'][$i]
            );
            $this->db->where('abbr', $abbr)->where('for_id', $id)->where('type', 'page')->update('translations', $arr);
            $i++;
        }
    }

    public function productStatusChange($id, $to_status)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('products', array('visibility' => $to_status));
        return $result;
    }

    public function changeOrderStatus($id, $to_status)
    {
        $this->db->where('id', $id);
        $this->db->select('processed');
        $result1 = $this->db->get('orders');
        $res = $result1->row_array();

        if ($res['processed'] != $to_status) {
            $this->db->where('id', $id);
            $result = $this->db->update('orders', array('processed' => $to_status, 'viewed' => '1'));
            if ($result == true) {
                $this->manageQuantitiesAndProcurement($id, $to_status, $res['processed']);
            }
        } else {
            $result = false;
        }
        return $result;
    }

    private function manageQuantitiesAndProcurement($id, $to_status, $current)
    {
        if (($to_status == 0 || $to_status == 2) && $current == 1) {
            $operator = '+';
            $operator_pro = '-';
        }
        if ($to_status == 1) {
            $operator = '-';
            $operator_pro = '+';
        }
        $this->db->select('products');
        $this->db->where('id', $id);
        $result = $this->db->get('orders');
        $arr = $result->row_array();
        $products = unserialize($arr['products']);
        foreach ($products as $product_id => $quantity) {
            if (isset($operator))
                $this->db->query('UPDATE products SET quantity=quantity' . $operator . $quantity . ' WHERE id = ' . $product_id);
            if (isset($operator_pro))
                $this->db->query('UPDATE products SET procurement=procurement' . $operator_pro . $quantity . ' WHERE id = ' . $product_id);
        }
    }

    public function changePass($new_pass, $username)
    {
        $this->db->where('username', $username);
        $result = $this->db->update('users', array('password' => md5($new_pass)));
        return $result;
    }

    public function orders($limit, $page, $order_by)
    {
        if ($order_by != null) {
            $this->db->order_by($order_by, 'DESC');
        } else {
            $this->db->order_by('id', 'DESC');
        }
        $this->db->select('orders.*, orders_clients.first_name,'
                . ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
                . 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
                . ' orders_clients.notes');
        $this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
        $result = $this->db->get('orders', $limit, $page);
        return $result->result_array();
    }

    public function getPages($active = null, $advanced = false)
    {
        if ($active != null) {
            $this->db->where('enabled', $active);
        }
        if ($advanced == false) {
            $this->db->select('name');
        } else {
            $this->db->select('*');
        }
        $result = $this->db->get('active_pages');
        if ($result != false) {
            $array = array();
            if ($advanced == false) {
                foreach ($result->result_array() as $arr)
                    $array[] = $arr['name'];
            } else {
                $array = $result->result_array();
            }
            return $array;
        }
    }

    public function getOnePageForEdit($pname)
    {
        $this->db->join('translations', 'translations.for_id = active_pages.id', 'left');
        $this->db->join('languages', 'translations.abbr = languages.abbr', 'left');
        $this->db->where('translations.type', 'page');
        $this->db->where('active_pages.enabled', 1);
        $this->db->where('active_pages.name', $pname);
        $query = $this->db->select('active_pages.id, translations.description, translations.abbr, translations.name, languages.name as lname, languages.flag')->get('active_pages');
        return $query->result_array();
    }

    public function getOnePost($id)
    {
        $query = $this->db->where('id', $id)->get('blog_posts');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function setPost($post, $id)
    {
        if ($id > 0) {
            return $id;
        } else {
            $post['time'] = time();
            $title = str_replace('"', "'", $post['title']);
            unset($post['title']);
            $result = $this->db->insert('blog_posts', $post);
            $last_id = $this->db->insert_id();

            $arr = array();

            $arr['url'] = str_replace(' ', '-', except_letters($title)) . '_' . $last_id . '';
            $this->db->where('id', $last_id);
            $this->db->update('blog_posts', $arr);

            if ($result === true)
                $result = $last_id;
        }
        return $result;
    }

    public function postsCount($search = null)
    {
        if ($search !== null) {
            $this->db->like('translations.title', $search);
        }
        $this->db->join('translations', 'translations.for_id = blog_posts.id', 'left');
        $this->db->where('translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        return $this->db->count_all_results('blog_posts');
    }

    public function getPosts($lang = null, $limit, $page, $search = null, $month = null)
    {
        if ($search !== null) {
            $search = $this->db->escape_like_str($search);
            $this->db->where("(translations.title LIKE '%$search%' OR translations.description LIKE '%$search%')");
        }
        if ($month !== null) {
            $from = $month['from'];
            $to = $month['to'];
            $this->db->where("time BETWEEN $from AND $to");
        }
        $this->db->join('translations', 'translations.for_id = blog_posts.id', 'left');
        $this->db->where('translations.type', 'blog');
        if ($lang == null) {
            $this->db->where('translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        } else {
            $this->db->where('translations.abbr', $lang);
        }
        $query = $this->db->select('blog_posts.id, translations.title, translations.description, blog_posts.url, blog_posts.time, blog_posts.image')->get('blog_posts', $limit, $page);
        return $query->result_array();
    }

    public function deletePost($id)
    {
        $this->db->where('id', $id)->delete('blog_posts');
        $this->db->where('for_id', $id)->where('type', 'blog')->delete('translations');
    }

    public function changePageStatus($id, $to_status)
    {
        $result = $this->db->where('id', $id)->update('active_pages', array('enabled' => $to_status));
        return $result;
    }

    public function setValueStore($key, $value)
    {
        $this->db->where('thekey', $key);
        $query = $this->db->get('value_store');
        if ($query->num_rows() > 0) {
            $this->db->where('thekey', $key);
            $this->db->update('value_store', array('value' => $value));
        } else {
            $this->db->insert('value_store', array('value' => $value, 'thekey' => $key));
        }
    }

    public function getValueStore($key)
    {
        $query = $this->db->query("SELECT value FROM value_store WHERE thekey = '$key'");
        $img = $query->row_array();
        return $img['value'];
    }

    public function getSuscribedEmails($limit, $page)
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')->get('subscribed', $limit, $page);
        return $query;
    }

    public function deleteEmail($id)
    {
        $this->db->where('id', $id)->delete('subscribed');
    }

    public function newOrdersCheck()
    {
        $result = $this->db->query("SELECT count(id) as num FROM `orders` WHERE viewed = 0");
        $row = $result->row_array();
        return $row['num'];
    }

    public function setCookieLaw($post)
    {
        $query = $this->db->query('SELECT id FROM cookie_law');
        if ($query->num_rows() == 0) {
            $id = 1;
        } else {
            $result = $query->row_array();
            $id = $result['id'];
        }

        $this->db->replace('cookie_law', array(
            'id' => $id,
            'link' => $post['link'],
            'theme' => $post['theme'],
            'visibility' => $post['visibility']
        ));
        $for_id = $this->db->insert_id();

        $i = 0;
        foreach ($post['translations'] as $translate) {
            $this->db->replace('cookie_law_translations', array(
                'message' => htmlspecialchars($post['message'][$i]),
                'button_text' => htmlspecialchars($post['button_text'][$i]),
                'learn_more' => htmlspecialchars($post['learn_more'][$i]),
                'abbr' => $translate,
                'for_id' => $for_id
            ));
            $i++;
        }
    }

    public function getCookieLaw()
    {
        $arr = array('cookieInfo' => null, 'cookieTranslate' => null);
        $query = $this->db->query('SELECT * FROM cookie_law');
        if ($query->num_rows() > 0) {
            $arr['cookieInfo'] = $query->row_array();
            $query = $this->db->query('SELECT * FROM cookie_law_translations');
            $arrTrans = $query->result_array();
            foreach ($arrTrans as $trans) {
                $arr['cookieTranslate'][$trans['abbr']] = array(
                    'message' => $trans['message'],
                    'button_text' => $trans['button_text'],
                    'learn_more' => $trans['learn_more']
                );
            }
        }
        return $arr;
    }

    public function setBankAccountSettings($post)
    {
        $query = $this->db->query('SELECT id FROM bank_accounts');
        if ($query->num_rows() == 0) {
            $id = 1;
        } else {
            $result = $query->row_array();
            $id = $result['id'];
        }
        $post['id'] = $id;
        $this->db->replace('bank_accounts', $post);
    }

    public function getBankAccountSettings()
    {
        $result = $this->db->query("SELECT * FROM bank_accounts LIMIT 1");
        return $result->row_array();
    }

    public function getBrands()
    {
        $result = $this->db->get('brands');
        return $result->result_array();
    }

    public function setBrand($name)
    {
        $this->db->insert('brands', array('name' => $name));
    }

    public function deleteBrand($id)
    {
        $this->db->where('id', $id)->delete('brands');
    }

    public function editShopCategorie($post)
    {
        $this->db->where('abbr', $post['abbr']);
        $this->db->where('for_id', $post['for_id']);
        $this->db->where('type', $post['type']);
        $this->db->update('translations', array(
            'name' => $post['name']
        ));
    }

    public function getOrdersByMonth()
    {
        $result = $this->db->query("SELECT YEAR(FROM_UNIXTIME(date)) as year, MONTH(FROM_UNIXTIME(date)) as month, COUNT(id) as num FROM orders GROUP BY YEAR(FROM_UNIXTIME(date)), MONTH(FROM_UNIXTIME(date)) ASC");
        $result = $result->result_array();
        $orders = array();
        $years = array();
        foreach ($result as $res) {
            if (!isset($orders[$res['year']])) {
                for ($i = 1; $i <= 12; $i++) {
                    $orders[$res['year']][$i] = 0;
                }
            }
            $years[] = $res['year'];
            $orders[$res['year']][$res['month']] = $res['num'];
        }
        return array(
            'years' => array_unique($years),
            'orders' => $orders
        );
    }

    public function editShopCategoriePosition($post)
    {
        $this->db->where('id', $post['editid']);
        $result = $this->db->update('shop_categories', array(
            'position' => $post['new_pos']
        ));
    }

}
