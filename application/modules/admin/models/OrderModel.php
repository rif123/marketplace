<?php

class OrderModel extends CI_Model
{
    public function getListOrder($data)
    {
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
        $where = "where 1=1";
        if (!empty($data['statusOrder'])) {
            $where .= "  AND dor.status_order = '".$data['statusOrder']."'";
        }
        $order = "order by dor.created desc";
        $q = $query." ".$where." ".$order;
        $result = $this->db->query($q)->result_array();
        return $result;
    }

    public function changeOrderStatus($all) {
        $this->db->where('id_order', $all['id_order']);
        return $this->db->update('dk_order', ['status_order' => $all['status_order']]);

    }

}
