<?php

class HistoryModel extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('EncryptNative');
    }

    public function getListOrder() {
        $id_client = getSession()->id_client;
        $query = 'select
                    	dor.no_order,
                    	dc.name_client,
                    	dor.total_order,
                    	dor.status_order
                    from dk_order as dor
                    INNER JOIN dk_client as dc  on dor.id_client = dc.id_client
                    INNER JOIN dk_shipping as ds on dor.id_shipping = ds.id_shipping
                    where dor.id_client = "'.$id_client.'"
                ';
        return $this->db->query($query)->result_array();
    }
}
