<link href="<?= base_url('assets/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
<div>
    <h1><img src="<?= base_url('assets/imgs/orders.png') ?>" class="header-img" style="margin-top:-2px;"> Orders <?= isset($_GET['settings']) ? ' / Settings' : '' ?></h1>
</div>
<hr>

<?php
    if (!empty($listOrder)) {
        $actionOrder = $this->config->item('actionOrder');
        $statusOrder = $this->config->item('statusOrder');
        ?>
        <div style="margin-bottom:10px;">
            <select class="selectpicker changeOrder">
                <option value="">Filter Status</option>
                <option value="">All</option>
                <?php
                    $getStatusOrder = $this->input->get('statusOrder');
                    foreach ($statusOrder as $key => $v) {
                        $selected = "";
                        if ($getStatusOrder == $v){
                            $selected = "selected='selected'";
                        }
                        echo '<option  '.$selected.'  value="'.$v.'">'.$v.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Preview</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listOrder as $key => $tr) {
                        $class = 'bg-warning';
                        $type = 'Rejected';

                        if ($tr['status_order'] == 0) {
                            $class = 'bg-danger';
                        }
                        if ($tr['status_order'] == 1) {
                            $class = 'bg-success';
                        }
                        if ($tr['status_order'] == 2) {
                            $class = 'bg-warning';
                        }
                        $type = $statusOrder[$tr['status_order']];
                        ?>
                        <tr>
                            <td class="relative" id="order_id-id-<?= $tr['no_order'] ?>">
                                # <?= $tr['no_order'] ?>
                                <?php if ($tr['status_order'] == 3) { ?>
                                    <div id="new-order-alert-<?= $tr['id_order'] ?>">
                                        <img src="<?= base_url('assets/imgs/new-blinking.gif') ?>" style="width:100px;" alt="blinking">
                                    </div>
                                <?php } ?>
                                <div class="confirm-result">
                                    <?php if ($tr['status_order'] == '5') { ?>
                                        <span class="label label-success">Order Success</span>
                                    <?php } else {
                                        ?>
                                        <span class="label label-danger"><?php echo $statusOrder[$tr['status_order']]; ?></span>
                                    <?php } ?>
                                </div>
                            </td>
                            <td><?= date('d.M.Y / H:m:s', strtotime($tr['dateOrder'])); ?></td>
                            <td>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <?= $tr['name_client'] . ' ' . $tr['email_client'] ?>
                            </td>
                            <td><i class="fa fa-phone" aria-hidden="true"></i> <?= $tr['hp_client'] ?></td>
                            <td class="<?= $class ?> text-center" data-action-id="<?= $tr['id_order'] ?>">
                                <?php ?>
                                <div class="status" style="padding:5px; font-size:16px;">
                                    -- <b><?= $type ?></b> --
                                </div>
                                <?php
                                foreach ($actionOrder as $key => $v) {
                                    $disabled = "";
                                    if ($key == $tr['status_order']){
                                        $disabled = "disabled='disabled'";
                                    }
                                    echo '<button  '.$disabled.' onClick="changeOrdersOrderStatus(\''.$key.'\', \''.$tr['id_order'].'\')" class="btn btn-success btn-xs">'.$v.'</button> | ';
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0);" class="btn btn-default more-info" data-toggle="modal" data-target="#modalPreviewMoreInfo" style="margin-top:10%;" data-more-info="<?= $tr['no_order'] ?>">
                                    More Info
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td class="hidden" id="order-id-<?= $tr['no_order'] ?>">
                                <div class="table-responsive">
                                    <table class="table more-info-purchase">
                                        <tbody>
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td><a href="mailto:<?= $tr['email_client'] ?>"><?= $tr['email_client'] ?></a></td>
                                            </tr>
                                            <tr>
                                                <td><b>City</b></td>
                                                <td><?= $tr['kota'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Prov</b></td>
                                                <td><?= $tr['prov'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address</b></td>
                                                <td><?= $tr['address_shipping'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Postcode</b></td>
                                                <td><?= $tr['postal_shipping'] ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><b>Products</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <?php
                                                    $arr_products = getListProduct($tr['id_order']);
                                                    foreach ($arr_products as $product_id => $value) {
                                                        $productInfo = modules::run('admin/ecommerce/products/getProductInfo', $value['id_product']);
                                                        ?>
                                                        <div style="word-break: break-all;">
                                                            <div>
                                                                <img src="<?= base_url('attachments/shop_images/' . $value['image_product']) ?>" alt="Product" style="width:100px; margin-right:10px;" class="img-responsive">
                                                            </div>
                                                            <a data-toggle="tooltip" data-placement="top" title="Click to preview" target="_blank" href="<?= base_url($value['id_product']) ?>">
                                                                <?= base_url($value['id_product']) ?>
                                                                <div style=" background-color: #f1f1f1; border-radius: 2px; padding: 2px 5px;"><b>Quantity:</b> <?= $value['quantity'] ?></div>
                                                            </a>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <hr>
                                                    <?php }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                        $arr_products = getShipping($tr['id_shipping']);
                                    ?>
                                    <table class="table more-info-purchase">
                                        <tr>
                                            <td colspan="2"><div> Shipping </div></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td><?php echo $arr_products->first_name_shipping.'  '.$arr_products->last_name_shipping; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Company</td>
                                            <td><?php echo $arr_products->company_name_shipping; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $arr_products->email_shipping; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td><?php echo $arr_products->phone_shipping; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number</td>
                                            <td><?php echo $arr_products->address_shipping." ".$arr_products->kota.' '.$arr_products->prov; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?= $links_pagination ?>
    <?php } else {
        $statusOrder = $this->config->item('statusOrder');
        ?>
        <div style="margin-bottom:10px;">
            <select class="selectpicker changeOrder">
                <option value="">Filter Status</option>
                <option value="">All</option>
                <?php
                    $getStatusOrder = $this->input->get('statusOrder');
                    foreach ($statusOrder as $key => $v) {
                        $selected = "";
                        if ($getStatusOrder == $v){
                            $selected = "selected='selected'";
                        }
                        echo '<option  '.$selected.'  value="'.$v.'">'.$v.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="alert alert-info">No orders to the moment!</div>
    <?php }
    ?>
    <hr>
<script>
var urlorder =  "<?php echo site_url('/admin/orders'); ?>";
var urlStatusOrder =  "<?php echo site_url('/admin/orders'); ?>?statusOrder=";
</script>
<!-- Modal for more info buttons in orders -->
<div class="modal fade" id="modalPreviewMoreInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Preview <b id="client-name"></b></h4>
            </div>
            <div class="modal-body" id="preview-info-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/bootstrap-toggle.min.js') ?>"></script>
