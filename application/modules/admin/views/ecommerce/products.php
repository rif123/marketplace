<div id="products">
    <?php
    if ($this->session->flashdata('result_delete')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_publish')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div>
        <hr>
        <?php
    }
    $langs = $languages->result();
    ?>
    <h1><img src="<?= base_url('assets/imgs/products-img.png') ?>" class="header-img" style="margin-top:-2px;"> Products</h1>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <div class="well hidden-xs">
                <div class="row">
                    <form method="GET" id="searchProductsForm" action="">
                        <div class="col-sm-4">
                            <label>Order:</label>
                            <select name="order_by" class="form-control selectpicker change-products-form">
                                <option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'dp.id_product desc' ? 'selected=""' : '' ?> value="dp.id_product desc">Newest</option>
                                <option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'dp.id_product asc' ? 'selected=""' : '' ?> value="dp.id_product asc">Latest</option>
                                <option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'dp.quantity_product desc' ? 'selected=""' : '' ?> value="dp.quantity_product desc">Low Quantity</option>
                                <option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'dp.quantity_product asc' ? 'selected=""' : '' ?> value="dp.quantity_product asc">High Quantity</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Title:</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Product Title" type="text" value="<?= isset($_GET['search_title']) ? $_GET['search_title'] : '' ?>" name="search_title">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" value="">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label>Category:</label>
                            <select name="category" class="form-control selectpicker change-products-form">
                                <option value="">None</option>
                                <?php foreach ($shop_categories as $key_cat => $shop_categorie) { ?>
                                    <option <?= isset($_GET['category']) && $_GET['category'] == $key_cat ? 'selected=""' : '' ?> value="<?= $key_cat ?>">
                                        <?php
                                        foreach ($shop_categorie['info'] as $nameAbbr) {
                                            if ($nameAbbr['abbr'] == $this->config->item('language_abbr')) {
                                                echo $nameAbbr['name'];
                                            }
                                        }
                                        ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <?php
            if (!empty($products)) {
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Old Price </th>
                                <th>Quantity</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($products as $row) {
                                $u_path = 'attachments/shop_images/';
                                if ($row['imgProd'] != null && file_exists($u_path . $row['imgProd'])) {
                                    $image = base_url($u_path . $row['imgProd']);
                                } else {
                                    $image = base_url('attachments/no-image.png');
                                }
                                ?>
                                <tr>
                                    <td>
                                        <img src="<?= $image ?>" alt="No Image" class="img-thumbnail" style="height:100px;">
                                    </td>
                                    <td>
                                        <?= $row['titleProd'] ?>
                                    </td>
                                    <td><?= $row['oldPriceProd'] ?></td>
                                    <td>
                                        <?= $row['priceProd'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['qtyProd'] > 5) {
                                            $color = 'label-success';
                                        }
                                        if ($row['qtyProd'] <= 5) {
                                            $color = 'label-warning';
                                        }
                                        if ($row['qtyProd']== 0) {
                                            $color = 'label-danger';
                                        }
                                        ?>
                                        <span style="font-size:12px;" class="label <?= $color ?>">
                                            <?= $row['qtyProd'] ?>
                                        </span>
                                    </td>

                                    <td>
                                        <div class="pull-right">
                                            <a href="<?= base_url('admin/publish/' .$row['idProd']) ?>" class="btn btn-info">Edit</a>
                                            <a href="<?= base_url('admin/products?delete=' . $row['idProd']) ?>"  class="btn btn-danger confirm-delete">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?= $links_pagination ?>
            </div>
            <?php
        } else {
            ?>
            <div class ="alert alert-info">No products found!</div>
        <?php } ?>
    </div>
