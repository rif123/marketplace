<ul class="vertical-menu-list">
    <?php
    foreach ($categories as $key => $val) {
    ?>
    <li class="ef4896">
        <a href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/').$val['icon']; ?>"><?php echo $val['name']; ?></a>
        <div class="vertical-dropdown-menu">
            <div class="vertical-groups col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="block-content-vertical-menu">
                            <h3 class="head">Kategori <?php echo $val['name']; ?></h3>
                            <div class="inner">
                                <a href="<?php echo site_url('/promobox').'/'.sanitizeStringForUrl($val['name']).'-'.$val['idCategory']; ?>">
                                    <img src="<?php echo base_url('attachments/category/').$val['banner']; ?>"  onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/option2/banner2.png'); ?>'"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="row mega-products">
                            <?php
                                $getCategoryMenu = getCategoryMenu($val['idCategory']);
                                foreach ($getCategoryMenu as $k => $items) {
                            ?>
                                <div class="col-sm-4 mega-product">
                                    <div class="product-avatar">
                                        <a href="<?php echo site_url('/p').'/'.sanitizeStringForUrl($items['title']).'-'.$items['id']; ?>">
                                            <img src="<?php echo base_url('attachments/shop_images/').$items['image']; ?>" alt="product1"
                                            onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/p10.jpg'); ?>'">
                                        </a>
                                    </div>
                                    <div class="product-name">
                                        <a href="<?php echo site_url('/p').'/'.sanitizeStringForUrl($items['title']).'-'.$items['id']; ?>"><?php echo $items['title']; ?></a>
                                    </div>
                                    <div class="price-box">
                                        <span class="product-price"><?php echo numberToRp($items['price']); ?></span>
                                        <span class="product-price-old"><?php echo numberToRp($items['old_price']); ?></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>
