<ul class="sidebar-menu">
    <li class="sidebar-search">
        <div class="input-group custom-search-form">
            <form method="GET" action="<?= base_url('admin/products') ?>">
                <div class="input-group">
                    <input class="form-control" name="search_title" value="<?= isset($_GET['search_title']) ? $_GET['search_title'] : '' ?>" type="text" placeholder="Search in products...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" value="" placeholder="Find product.." type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </li>
    <li class="header">SETTINGS</li>
    <li><a href="<?= base_url('admin/settings') ?>" <?= urldecode(uri_string()) == 'admin/settings' ? 'class="active"' : '' ?>><i class="fa fa-wrench" aria-hidden="true"></i> Settings</a></li>
    <li><a href="<?= base_url('admin/history') ?>" <?= urldecode(uri_string()) == 'admin/history' ? 'class="active"' : '' ?>><i class="fa fa-history"></i> Activity History</a></li>
    <li class="header">ECOMMERCE</li>
    <li><a href="<?= base_url('admin/prod-merchant') ?>" <?= urldecode(uri_string()) == 'admin/publish' ? 'class="active"' : '' ?>><i class="fa fa-edit"></i> Publish product</a></li>
    <li><a href="<?= base_url('admin/prod-list-merchant') ?>" <?= urldecode(uri_string()) == 'admin/products' ? 'class="active"' : '' ?>><i class="fa fa-files-o"></i> Products</a></li>
    <?php if ($showBrands == 1) { ?>
        <li><a href="<?= base_url('admin/brands') ?>" <?= urldecode(uri_string()) == 'admin/brands' ? 'class="active"' : '' ?>><i class="fa fa-registered"></i> Brands</a></li>
    <?php } ?>
    <li>
        <a href="<?= base_url('admin/prod-order-merchant') ?>" <?= urldecode(uri_string()) == 'prod-order-merchant' ? 'class="active"' : '' ?>>
            <i class="fa fa-money" aria-hidden="true"></i> Orders
            <?php if ($numNotPreviewOrders > 0) { ?>
                <img src="<?= base_url('assets/imgs/exlamation-hi.png') ?>" style="position: absolute; right:10px; top:7px;" alt="">
            <?php } ?>
        </a>
    </li>
</ul>
