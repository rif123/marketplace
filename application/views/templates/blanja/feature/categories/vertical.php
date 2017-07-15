<?php
    // echo "<pre>";
    // print_R($categories);die;
?>
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
    <li class="ef4896">
        <a href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/1.png'); ?>">Fashion</a>
        <div class="vertical-dropdown-menu">
            <div class="vertical-groups col-sm-12">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="block-content-vertical-menu">
                            <h3 class="head">PRODUCTS SPECIAL</h3>
                            <div class="inner">
                                <p>Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="row mega-products">
                            <div class="col-sm-4 mega-product">
                                <div class="product-avatar">
                                    <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/p10.jpg'); ?>" alt="product1"></a>
                                </div>
                                <div class="product-name">
                                    <a href="#">Cotton Lycra Leggings</a>
                                </div>
                                <div class="price-box">
                                    <span class="product-price">$139.98</span>
                                    <span class="product-price-old">$169.00</span>
                                </div>
                                <div class="product-star">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                            <div class="col-sm-4 mega-product">
                                <div class="product-avatar">
                                    <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/p11.jpg'); ?>" alt="product1"></a>
                                </div>
                                <div class="product-name">
                                    <a href="#">Cotton Lycra Leggings</a>
                                </div>
                                <div class="price-box">
                                    <span class="product-price">$139.98</span>
                                    <span class="product-price-old">$169.00</span>
                                </div>
                                <div class="product-star">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                            <div class="col-sm-4 mega-product">
                                <div class="product-avatar">
                                    <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/p12.jpg'); ?>" alt="product1"></a>
                                </div>
                                <div class="product-name">
                                    <a href="#">Cotton Lycra Leggings</a>
                                </div>
                                <div class="price-box">
                                    <span class="product-price">$139.98</span>
                                    <span class="product-price-old">$169.00</span>
                                </div>
                                <div class="product-star">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="e664fe">
        <a href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/2.png'); ?>">Mother & Baby</a>
        <div class="vertical-dropdown-menu">
            <div class="vertical-groups">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="block-content-vertical-menu border banner-hover">
                            <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/banner/b42.png'); ?>" alt="Banner"></a>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="block-content-vertical-menu banner-hover">
                            <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/banner/b43.png'); ?>" alt="Banner"></a>
                        </div>
                        <div class="block-content-vertical-menu">
                            <div class="inner">
                                <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec rutrum congue leo eget malesuada. Proin eget tortor risus. </p>
                                <a href="#" class="button-radius">Shop now<span class="icon"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="block-content-vertical-menu border-left">
                            <h3 class="head" style="background:#e664fe;">CATEGORIES</h3>
                            <div class="inner">
                                <ul class="vertical-menu-link">
                                    <li>
                                        <a href="#">
                                        <span class="text">Skincare</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Metkup</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Mobile phone</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Tablet</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Men's Apparel</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Women's Apparel</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Watch sport</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Metkup</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Mobile phone</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Tablet</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="fe64a9">
        <a href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/3.png'); ?>">Cosmetics</a>
        <div class="vertical-dropdown-menu">
            <div class="vertical-groups">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="block-content-vertical-menu border">
                            <h3 class="head">CATEGORIES</h3>
                            <div class="inner">
                                <div class="inner-img">
                                    <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/banner/4.jpg'); ?>" alt="Banner"></a>
                                </div>
                                <ul class="vertical-menu-link">
                                    <li>
                                        <a href="#">
                                        <span class="text">Skincare</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Metkup</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Mobile phone</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Tablet</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="block-content-vertical-menu border">
                            <h3 class="head">CATEGORIES</h3>
                            <div class="inner">
                                <div class="inner-img">
                                    <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/banner/5.jpg'); ?>" alt="Banner"></a>
                                </div>
                                <ul class="vertical-menu-link">
                                    <li>
                                        <a href="#">
                                        <span class="text">Skincare</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Metkup</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Mobile phone</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Tablet</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="block-content-vertical-menu border">
                            <h3 class="head">CATEGORIES</h3>
                            <div class="inner">
                                <div class="inner-img">
                                    <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/banner/6.jpg'); ?>" alt="Banner"></a>
                                </div>
                                <ul class="vertical-menu-link">
                                    <li>
                                        <a href="#">
                                        <span class="text">Skincare</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Metkup</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Mobile phone</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Tablet</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="block-content-vertical-menu border">
                            <h3 class="head">CATEGORIES</h3>
                            <div class="inner">
                                <div class="inner-img">
                                    <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/banner/7.jpg'); ?>" alt="Banner"></a>
                                </div>
                                <ul class="vertical-menu-link">
                                    <li>
                                        <a href="#">
                                        <span class="text">Skincare</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Metkup</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Mobile phone</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <span class="text">Tablet</span>
                                        <span class="count">(9)</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li><a href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/4.png'); ?>">Electronics</a></li>
    <li><a href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/5.png'); ?>">Interior</a></li>
    <li>
        <a class="parent" href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/6.png'); ?>">Sport</a>
    </li>
    <li><a href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/7.png'); ?>">Mobile & Tablet</a></li>
    <li><a href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/8.png'); ?>">Other</a></li>
</ul>
