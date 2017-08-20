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
    <li class="header">ECOMMERCE</li>
    <li><a href="<?= base_url('admin/publish') ?>" <?= urldecode(uri_string()) == 'admin/publish' ? 'class="active"' : '' ?>><i class="fa fa-edit"></i> Publish product</a></li>
    <li><a href="<?= base_url('admin/products') ?>" <?= urldecode(uri_string()) == 'admin/products' ? 'class="active"' : '' ?>><i class="fa fa-files-o"></i> Products</a></li>
    <?php if ($showBrands == 1) { ?>
        <li><a href="<?= base_url('admin/brands') ?>" <?= urldecode(uri_string()) == 'admin/brands' ? 'class="active"' : '' ?>><i class="fa fa-registered"></i> Brands</a></li>
    <?php } ?>
    <li><a href="<?= base_url('admin/shopcategories') ?>" <?= urldecode(uri_string()) == 'admin/shopcategories' ? 'class="active"' : '' ?>><i class="fa fa-list-alt"></i>Categories</a></li>
    <li>
        <a href="<?= base_url('admin/orders') ?>" <?= urldecode(uri_string()) == 'admin/orders' ? 'class="active"' : '' ?>>
            <i class="fa fa-money" aria-hidden="true"></i> Orders
            <?php if ($numNotPreviewOrders > 0) { ?>
                <img src="<?= base_url('assets/imgs/exlamation-hi.png') ?>" style="position: absolute; right:10px; top:7px;" alt="">
            <?php } ?>
        </a>
    </li>
    <?php if (in_array('blog', $activePages)) { ?>
        <li class="header">BLOG</li>
        <li><a href="<?= base_url('admin/blogpublish') ?>" <?= urldecode(uri_string()) == 'admin/blogpublish' ? 'class="active"' : '' ?>><i class="fa fa-edit" aria-hidden="true"></i> Publish post</a></li>
        <li><a href="<?= base_url('admin/blog') ?>" <?= urldecode(uri_string()) == 'admin/blog' ? 'class="active"' : '' ?>><i class="fa fa-th" aria-hidden="true"></i> Posts</a></li>
    <?php } ?>
    <?php
    if (!empty($textualPages)) {
        foreach ($nonDynPages as $nonDynPage) {
            if (($key = array_search($nonDynPage, $textualPages)) !== false) {
                unset($textualPages[$key]);
            }
        }
        ?>
        <li class="header">TEXTUAL PAGES</li>
        <?php foreach ($textualPages as $textualPage) { ?>
            <li><a href="<?= base_url('admin/pageedit/' . $textualPage) ?>" <?= strpos(urldecode(uri_string()), $textualPage) ? 'class="active"' : '' ?>><i class="fa fa-edit" aria-hidden="true"></i> <?= strtoupper($textualPage) ?></a></li>
            <?php
        }
    }
    ?>
    <li class="header">SETTINGS</li>
    <li><a href="<?= base_url('admin/settings') ?>" <?= urldecode(uri_string()) == 'admin/settings' ? 'class="active"' : '' ?>><i class="fa fa-wrench" aria-hidden="true"></i> Settings</a></li>
    <li><a href="<?= base_url('admin/styling') ?>" <?= urldecode(uri_string()) == 'admin/styling' ? 'class="active"' : '' ?>><i class="fa fa-laptop" aria-hidden="true"></i> Styling</a></li>
    <li><a href="<?= base_url('admin/templates') ?>" <?= urldecode(uri_string()) == 'admin/templates' ? 'class="active"' : '' ?>><i class="fa fa-binoculars" aria-hidden="true"></i> Templates</a></li>
    <li><a href="<?= base_url('admin/titles') ?>" <?= urldecode(uri_string()) == 'admin/titles' ? 'class="active"' : '' ?>><i class="fa fa-font" aria-hidden="true"></i> Titles / Descriptions</a></li>
    <li><a href="<?= base_url('admin/pages') ?>" <?= urldecode(uri_string()) == 'admin/pages' ? 'class="active"' : '' ?>><i class="fa fa-file" aria-hidden="true"></i> Active Pages</a></li>
    <li><a href="<?= base_url('admin/emails') ?>" <?= urldecode(uri_string()) == 'admin/emails' ? 'class="active"' : '' ?>><i class="fa fa-envelope-o" aria-hidden="true"></i> Subscribed Emails</a></li>
    <li><a href="<?= base_url('admin/history') ?>" <?= urldecode(uri_string()) == 'admin/history' ? 'class="active"' : '' ?>><i class="fa fa-history"></i> Activity History</a></li>
    <li class="header">ADVANCED SETTINGS</li>
    <li><a href="<?= base_url('admin/merchant') ?>" <?= urldecode(uri_string()) == 'admin/merchant' ? 'class="active"' : '' ?>><i class="fa fa-globe"></i> Users</a></li>
    <li><a href="<?= base_url('admin/languages') ?>" <?= urldecode(uri_string()) == 'admin/languages' ? 'class="active"' : '' ?>><i class="fa fa-globe"></i> Languages</a></li>
    <li><a href="<?= base_url('admin/filemanager') ?>" <?= urldecode(uri_string()) == 'admin/filemanager' ? 'class="active"' : '' ?>><i class="fa fa-file-code-o"></i> File Manager</a></li>
    <li><a href="<?= base_url('admin/adminusers') ?>" <?= urldecode(uri_string()) == 'admin/adminusers' ? 'class="active"' : '' ?>><i class="fa fa-user" aria-hidden="true"></i> Admin Users</a></li>
    <li><a href="<?= base_url('admin/databank') ?>" <?= urldecode(uri_string()) == 'admin/databank' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Data Bank</a></li>
    <li><a href="<?= base_url('admin/bankclient') ?>" <?= urldecode(uri_string()) == 'admin/bankclient' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Bank Client</a></li>
    <li><a href="<?= base_url('admin/identity') ?>" <?= urldecode(uri_string()) == 'admin/identity' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Identity</a></li>
    <li><a href="<?= base_url('admin/business') ?>" <?= urldecode(uri_string()) == 'admin/business' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Type Business</a></li>
    <li><a href="<?= base_url('admin/config') ?>" <?= urldecode(uri_string()) == 'admin/config' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Config</a></li>
    <li><a href="<?= base_url('admin/prov') ?>" <?= urldecode(uri_string()) == 'admin/prov' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Data Prov</a></li>
    <li><a href="<?= base_url('admin/city') ?>" <?= urldecode(uri_string()) == 'admin/city' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Data City</a></li>
    <li><a href="<?= base_url('admin/districts') ?>" <?= urldecode(uri_string()) == 'admin/districts' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Data Districts</a></li>
    <li><a href="<?= base_url('admin/populerCategory') ?>" <?= urldecode(uri_string()) == 'admin/populerCategory' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Populer Category</a></li>
    <li><a href="<?= base_url('admin/subscribed') ?>" <?= urldecode(uri_string()) == 'admin/subscribed' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Subscribed</a></li>
    <li><a href="<?= base_url('admin/partner') ?>" <?= urldecode(uri_string()) == 'admin/partner' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Partner</a></li>
    <li><a href="<?= base_url('admin/detailStore') ?>" <?= urldecode(uri_string()) == 'admin/detailStore' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Detail Store</a></li>
    <li><a href="<?= base_url('admin/store') ?>" <?= urldecode(uri_string()) == 'admin/store' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Store</a></li>
    <li><a href="<?= base_url('admin/riview') ?>" <?= urldecode(uri_string()) == 'admin/riview' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Riview</a></li>
    <li><a href="<?= base_url('admin/wishlist') ?>" <?= urldecode(uri_string()) == 'admin/wishlist' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Wishlist</a></li>
    <li><a href="<?= base_url('admin/promo') ?>" <?= urldecode(uri_string()) == 'admin/promo' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Promo</a></li>
    <li><a href="<?= base_url('admin/promoSlider') ?>" <?= urldecode(uri_string()) == 'admin/promoSlider' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Promo Slide</a></li>
    <li><a href="<?= base_url('admin/promoItem') ?>" <?= urldecode(uri_string()) == 'admin/promoItem' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Promo Item</a></li>
    <li><a href="<?= base_url('admin/menuKampus') ?>" <?= urldecode(uri_string()) == 'admin/menuKampus' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Menu Kampus</a></li>
    <li><a href="<?= base_url('admin/kategory') ?>" <?= urldecode(uri_string()) == 'admin/menuKota' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Menu Kota</a></li>
    <li><a href="<?= base_url('admin/category') ?>" <?= urldecode(uri_string()) == 'admin/category' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Menu category</a></li>
    <li><a href="<?= base_url('admin/warung') ?>" <?= urldecode(uri_string()) == 'admin/warung' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i>Warung</a></li>
</ul>
