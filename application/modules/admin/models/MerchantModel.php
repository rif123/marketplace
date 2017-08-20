<?php

class MerchantModel extends CI_Model
{

    public function listMerchant($limit, $start, $status = null, $where=[])
    {
        $query = " select *, dc.id_client as idClient from dk_client as dc
        LEFT JOIN dk_warung as dw on dc.id_client = dw.id_client
        where status_client = 2";
        if ($status) {
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }

            $q = $query.$limit_sql;
            $result = $this->db->query($q);
            return $result->result_array();
        } else {
            return $this->db->query($query)->num_rows();
        }
    }
    public function getMerchantEdit($id)
    {
        $query = " select *, dc.id_client as idClient from dk_client as dc
        LEFT JOIN dk_warung as dw on dc.id_client = dw.id_client
        where status_client = 2 and dc.id_client = '".$id."' ";
        $result = $this->db->query($query)->result_array();
        return !empty($result) ? $result[0] : [];
    }
    public function merchantUpdate($post)
    {
        $datasession = $this->session->userdata();
        $data = array(
            'name_client' =>$post['name_client'],
            'hp_client' =>$post['hp_client'],
            'gender_client' =>$post['gender_client'],
            'email_client' =>$post['email_client'],
            'password_client' => md5($post['password_client']),
            'editor' => $datasession['authlog']['id_client'],
            'edited' => date('Y-m-d H:i:s')
        );
        if (!empty($input['password_client'])) {
            unset($data['password_client']);
        }
        $this->db->where('id_client', $post['edit']);
        $this->db->where('status_client', 2);
        $result =$this->db->update('dk_client', $data);
        return $result;
    }
    public function merchantDelete($id)
    {
        $this->db->where('id_client', $id);
        $this->db->where('status_client', 2);
        $result =$this->db->delete('dk_client');
        return $result;
    }

    public function saveProduct($post) {
        $datasession = $this->session->userdata();
        $id_warung = $this->getWarungId();
        $datasave['title_product'] = $post['title'];
        $datasave['desc_product'] = $post['description'];
        $datasave['basic_produc'] = $post['basic_description'];
        $datasave['price_product'] = $post['price'];
        $datasave['old_price_product'] = $post['old_price'];
        $datasave['quantity_product'] = $post['quantity'];
        $datasave['id_warung'] = $id_warung['id_warung'];
        $datasave['image_product'] = $post['image'];
        $datasave['creator'] = $datasession['authlog']['id_client'];
        $datasave['created'] = date('Y-m-d H:i:s');
        $this->db->insert('dk_product', $datasave);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function saveUploadProd($post, $id) {
        $datasession = $this->session->userdata();
        foreach ($post['otherImages'] as $key => $value) {
            $datasave['name_image_prod'] = $value;
            $datasave['id_product'] = $id;
            $datasave['created'] = $datasession['authlog']['id_client'];
            $datasave['creator'] = date('Y-m-d H:i:s');
            $this->db->insert('dk_image_prod', $datasave);
        }
    }

    private function getWarungId()
    {
        $id_client = $this->session->userdata('authlog');
        $query = "select * from dk_warung as dw
                    LEFT JOIN dk_category_master as dcm on dw.id_category = dcm.id_category_master
                    where dw.id_client = '".$id_client['id_client']."'
                ";
        $result = $this->db->query($query)->result_array();
        return !empty($result[0]) ? $result[0] : "";
    }

    public function listProduct($limit, $start, $status = null, $search_title="", $orderby="", $category) {
        $getClient = $this->session->userdata('authlog');
        $query = "select
                dp.id_product as idProd,
                dp.title_product as titleProd,
                dp.desc_product as descProd,
                dp.basic_produc as basicProd,
                dp.price_product as priceProd,
                dp.old_price_product as oldPriceProd,
                dp.quantity_product as qtyProd,
                dp.image_product as imgProd,
                dw.id_client
                from dk_product as dp
                LEFT JOIN dk_warung as dw on dp.id_warung  = dw.id_warung
        ";
        if ($status) {
            $limit_sql = '';
            if ($limit !== null && $start !== null) {
                $limit_sql = ' LIMIT ' . $start . ',' . $limit;
            }
            $where = " WHERE dw.id_client = '".$getClient['id_client']."'";
            if (!empty($search_title)){
                $where = "AND  title_product like '%".$search_title."%'";
            }

            if (!empty($orderby)){
                $orderby = " ORDER BY ".$orderby;
            } else {
                $orderby = " ORDER BY dp.id_product desc ";
            }

            $query  = $query.$where.$orderby.$limit_sql;
            $result = $this->db->query($query);
            return $result->result_array();
        } else {
            $where = "";
            if (!empty($search_title)){
                $where = "WHERE title_product like '%".$search_title."%'";
            }
            $query  = $query.$where;
            return $this->db->query($query)->num_rows();
        }
    }

    public function updateProduct($post, $id) {
        $datasession = $this->session->userdata();
        $datasave['title_product'] = $post['title'];
        $datasave['desc_product'] = $post['description'];
        $datasave['basic_produc'] = $post['basic_description'];
        $datasave['price_product'] = $post['price'];
        $datasave['old_price_product'] = $post['old_price'];
        $datasave['quantity_product'] = $post['quantity'];
        if (!empty($post['image'])) {
            $datasave['image_product'] = $post['image'];
        }
        $datasave['editor'] = $datasession['authlog']['id_client'];
        $datasave['edited'] = date('Y-m-d H:i:s');
        $this->db->where('id_product', $id);
        return $this->db->update('dk_product', $datasave);
    }

    public function deleteproduct($id) {
        $this->db->where('id_product', $id);
        $this->db->delete('dk_product');
        // image
        $this->db->where('id_product', $id);
        $this->db->delete('dk_image_prod');
        return $result;
    }

    public function getListOrder($data) {
        $authLog = $this->session->userdata('authlog');

        $query   = "
                    select *,dor.created as dateOrder,  dct.`name` as kota, dp.`name` as prov
                    from
                    dk_order as dor
                    LEFT JOIN dk_client as dc on dor.id_client  = dc.id_client
                    LEFT JOIN dk_shipping as ds on ds.id_shipping = dor.id_shipping
                    LEFT JOIN dk_city as dct on ds.id_city  = dct.id_city
                    LEFT JOIN dk_prov as dp on dct.id_prov = dp.id_prov
                ";
        $statusOrder = $this->config->item('statusOrder');
        foreach ($statusOrder as $key => $value) {
            if (!empty($data['statusOrder'])) {
                if ($value == $data['statusOrder']) {
                    $data['statusOrder'] = $key;
                }
            }
        }
        $where = "where dor.id_client = '".$authLog['id_client']."'";
        if (!empty($data['statusOrder'])) {
            $where .= "  AND dor.status_order = '".$data['statusOrder']."'";
        }
        $order = "order by dor.created desc";
        $q = $query." ".$where." ".$order;
        $result = $this->db->query($q)->result_array();
        return $result;
    }

}
