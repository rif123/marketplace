<?php

class SettingModel extends CI_Model
{
    public function getCategoryMaster()
    {
        return $this->db->get('dk_category')->result_array();
    }
    public function getKampus()
    {
        return $this->db->get('dk_menu_kampus')->result_array();
    }
    public function getKota()
    {
        return $this->db->get('dk_menu_kota')->result_array();
    }
    public function updateMerchant($post)
    {
        unset($post['update']);
        $nameCategory = $this->getIdCategoryMaster($post['id_category']);
        $post['id_category'] = $nameCategory;
        $id_client = $this->session->userdata('authlog');
        $this->db->where('id_client', $id_client['id_client']);
        return $this->db->update('dk_warung', $post);
    }

    private function getIdCategoryMaster($id_category){
        $this->db->where('name_category', $id_category);
        $result= $this->db->get('dk_category_master')->result_array();
        return !empty($result[0]['id_category_master']) ? $result[0]['id_category_master'] : "";
    }
    public function getWarungId()
    {
        $id_client = $this->session->userdata('authlog');
        $query = "select * from dk_warung as dw
                    LEFT JOIN dk_category_master as dcm on dw.id_category = dcm.id_category_master
                    where dw.id_client = '".$id_client['id_client']."'
                ";
        $result = $this->db->query($query)->result_array();
        return !empty($result[0]) ? $result[0] : "";
    }

    public function changeOrderStatus($all) {
        $this->db->where('id_order', $all['id_order']);
        return $this->db->update('dk_order', ['status_order' => $all['status_order']]);

    }

}
