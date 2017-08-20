<?php

class PromoModel extends CI_Model
{
    public function getPromoItem($limit = null, $start = null, $status)
    {
        // FOR STATUS TRUE
        $q = "select
                    dpr.dk_title_promotion as titlePromo,
                    dpi.id_promo_items  as idPromoItems,
                    dpi.dk_promotion_id as idPromo,
                    dpi.id_warung as idWarung,
                    dw.name_warung as nameWarung,
                    dpi.id_menu_kampus as idMenuKampus,
                    dpi.id_menu_kota,
                    dp.title_product  as titleProd,
                    dmk.name_menu_kampus as nameKampus,
                    dmkot.name_menu_kota as nameKota
                    from dk_promo_items as dpi
                    LEFT JOIN dk_promo as dpr on dpi.dk_promotion_id = dpr.dk_promotion_id
                    LEFT JOIN dk_product as dp on dpi.id_prod = dp.id_product
                    LEFT JOIN dk_warung as dw on dpi.id_warung = dw.id_warung
                    LEFT JOIN dk_menu_kampus as dmk on dpi.id_menu_kampus = dmk.id_menu_kampus
                    LEFT JOIN dk_menu_kota as dmkot on dpi.id_menu_kota = dmkot.id_menu_kota ";
        if ($status) {
            // FOR CONFIG LIMIT
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $query = $q." ".$limit_sql;
            $result = $this->db->query($query)->result_array();
            return $result;
        } else {
            $result = $this->db->query($q)->num_rows();
            return $result;
        }
    }
    public function getPromoItemedit($user)
    {
        $this->db->where('id_promo_items', $user);
        $query = $this->db->get('dk_promo_items');
        return $query->row_array();
    }
    public function updatePromoItem($post)
    {
        $datasession = $this->session->userdata();
        $allAtribute = $this->getKampus($post);
        $post['editor'] = $datasession['authlog']['id_client'];
        $post['edited'] = date('Y-m-d H:i:s');
        $post['id_menu_kampus'] =  $allAtribute->idMenuKampus;
        $post['id_menu_kota'] =  $allAtribute->idMenuKota;
        $this->db->where('id_promo_items', $post['edit']);
        unset($post['edit']);
        unset($post['update']);
        $result = $this->db->update('dk_promo_items', $post);
        return $result;
    }
    public function deletePromoItem($id)
    {
        $this->db->where('id_promo_items', $id);
        $result = $this->db->delete('dk_promo_items');
        return $result;
    }
    public function getWarung()
    {
        $query = "select * from dk_warung";
        return $this->db->query($query)->result_array();
    }
    public function getProduct($id_warung)
    {
        $query = "select * from dk_product where id_warung = ".$id_warung;
        return $this->db->query($query)->result_array();
    }
    public function savePromoItem($post)
    {
        $allAtribute = $this->getKampus($post);

        unset($post['edit']);
        unset($post['save']);
        $post['id_menu_kampus'] =  $allAtribute->idMenuKampus;
        $post['id_menu_kota'] =  $allAtribute->idMenuKota;
        return $this->db->insert('dk_promo_items', $post);
    }
    public function getKampus($post)
    {
        $query = "select
                    dw.id_warung as idWarung,
                    dw.name_warung as nameWarung,
                    dmk.id_menu_kampus as idMenuKampus,
                    dmk.name_menu_kampus as nameMenuKampus,
                    dmkot.id_menu_kota as idMenuKota,
                    dmkot.name_menu_kota as menuKota
                    from dk_warung as dw
                    LEFT JOIN dk_menu_kampus as dmk on dw.id_kampus = dmk.id_menu_kampus
                    LEFT JOIN dk_menu_kota as dmkot on dmk.id_menu_kota = dmkot.id_menu_kota
                    where dw.id_warung = '".$post['id_warung']."'
                    ";
        return $this->db->query($query)->row();
    }
    public function getPromos(){

        $query =$this->db->query('SELECT dk_promo.dk_promotion_id,dk_promo.dk_head_title, dk_promo.dk_title_promotion FROM dk_promo');

        return $query->result_array();
    }
}
