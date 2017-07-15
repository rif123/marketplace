<header id="header">
    <!-- main header -->
    	<?php $this->load->view('templates/blanja/component/mainheader'); ?>
    <!-- ./main header -->
    <!-- main menu-->
		<?php $this->load->view('templates/blanja/component/mainmenu'); ?>
    <!-- ./main menu-->
</header>


<div class="container">
    <div class="row">
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Categories</h5>
                    </div>
                    <div class="vertical-menu-content">
                        <!-- main header -->
                        	<?php $this->load->view('templates/blanja/feature/categories/vertical', [  'categories' => $home_categories ]); ?>
                        <!-- ./main header -->
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <!-- block search -->
            <div class="col-sm-5 col-md-7">
                <div class="advanced-search box-radius">
                    <form class="form-inline">
                        <div class="form-group search-category">
                            <select id="category-select" class="search-category-select">
                                <option value="1">All Categories</option>
                                <option value="2">Men</option>
                                <option value="3">Women</option>
                            </select>
                        </div>
                        <div class="form-group search-input">
                            <input type="text" placeholder="What are you looking for?">
                        </div>
                        <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <!-- ./block search -->
            <!-- block cl-->
            <div class="col-sm-4 col-md-3 wrap-block-cl">
                <div class="inner-cl box-radius">
                    <div class="dropdown language">
                        <a data-toggle="dropdown" role="button"><img src="<?php echo base_url('assets/tempdkantin/data/en.jpg'); ?>" alt="languae">English</a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/en.jpg'); ?>" alt="languae">English</a></li>
                            <li><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/fr.jpg'); ?>" alt="languae">French</a></li>
                        </ul>
                    </div>
                    <div class="dropdown currency">
                        <a data-toggle="dropdown" role="button">USD</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">$ USD</a></li>
                            <li><a href="#">€ EUR</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ./block cl-->
            <div class="col-sm-9 col-md-7">
                <!-- Home slide -->
                <div class="block block-slider">
                    <ul class="home-slider kt-bxslider">
                        <?php foreach ($promoSlider as $key => $val) { ?>
                        <li>
                            <a href="<?php echo site_url('/promobox')."/".sanitizeStringForUrl(trim($val['dk_title_promotion']))."-".$val['dk_promotion_id']; ?>">
                                <img src="<?php echo base_url('attachments/slider').'/'.$val['dk_banner_promotion']; ?>" alt="Slider" onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/option2/slider1.jpg'); ?>'" >
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- ./Home slide -->
            </div>

            <div class="col-sm-9 col-md-3">
                <div class="block-banner-right banner-hover">
                    <?php foreach ($promoSlider as $key => $val) {
                            if ($key < 2){
                         ?>
                            <a href="<?php echo site_url('/promobox')."/".sanitizeStringForUrl(trim($val['dk_title_promotion']))."-".$val['dk_promotion_id']; ?>">
                                <img src="<?php echo base_url('attachments/slider').'/'.$val['dk_banner_promotion']; ?>" alt="Banner" onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/option2/banner2.png'); ?>'" >
                            </a>
                    <?php }} ?>

                </div>
            </div>
            <!-- block banner owl-->
            <div class="col-sm-12">
                <div class="block block-banner-owl" >
                    <div class="block-inner kt-owl-carousel" data-margin="30" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
                    <?php
                        foreach ($promoHorizontal as $key => $val) {
                    ?>
                        <div class="banner-text" style="background:<?php echo $val['dk_banner_promotion'];   ?>">
                            <h4><?php echo $val['dk_head_title']; ?></h4>
                            <h2><b><?php echo $val['dk_title_promotion']; ?></b></h2>
                            <p><?php echo $val['dk_description_promotion']; ?></p>
                            <a class="button-radius white" href="<?php echo site_url('/promobox')."/".sanitizeStringForUrl(trim($val['dk_title_promotion']))."-".$val['dk_promotion_id']; ?>">Shop     now<span class="icon"></span></a>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <!-- ./block banner owl-->
            <!-- block tabs -->
            <div class="col-sm-12">
                <div class="block block-tabs">
                    <div class="block-head">
                        <div class="block-title">
                            <div class="block-title-text text-lg">best selling</div>
                        </div>
                        <ul class="nav-tab">
                            <li><a data-toggle="tab" href="#tab-2">All</a></li>
                            <li  class="active"><a data-toggle="tab" href="#tab-1">Beauty & Perfumes</a></li>
                            <li><a data-toggle="tab" href="#tab-2">Mobile & Tablets</a></li>
                            <li><a data-toggle="tab" href="#tab-1">Fashion</a></li>
                            <li><a data-toggle="tab" href="#tab-2">Auto Accessories</a></li>
                        </ul>
                    </div>
                    <div class="block-inner">
                        <div class="tab-container">
                            <div id="tab-1" class="tab-panel active">
                                <ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p1.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p2.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p3.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p4.jpg'); ?>" alt="Produuct"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p5.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div id="tab-2" class="tab-panel">
                                <ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p6.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p7.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p8.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p9.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p10.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./block tabs -->
            <!-- Block hot deals2 -->
            <div class="col-sm-12">
                <div class="block-hot-deals2">
                    <h3 class="title">hot deals</h3>
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <div class="hot-deal-tab">
                                <div class="countdown">
                                    <span class="countdown-lastest" data-y="2016" data-m="10" data-d="1" data-h="00" data-i="00" data-s="00"></span>
                                </div>
                                <ul class="nav-tab">
                                    <li class="active"><a data-toggle="tab" href="#hotdeals-1">up to 70% off</a></li>
                                    <li><a data-toggle="tab" href="#hotdeals-2">up to 60% off</a></li>
                                    <li><a data-toggle="tab" href="#hotdeals-1">up to 50% off</a></li>
                                    <li><a data-toggle="tab" href="#hotdeals-2">up to 40% off</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-9">
                            <div class="tab-container">
                                <div id="hotdeals-1" class="tab-panel active">
                                    <ul class="products kt-owl-carousel" data-margin="30" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
                                        <li class="product">
                                            <div class="product-container">
                                                <div class="product-left">
                                                    <div class="product-thumb">
                                                        <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p21.jpg'); ?>" alt="Product"></a>
                                                        <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                    </div>
                                                </div>
                                                <div class="product-right">
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
                                                    <div class="product-button">
                                                        <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                        <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                        <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product">
                                            <div class="product-container">
                                                <div class="product-left">
                                                    <div class="product-thumb">
                                                        <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p22.jpg'); ?>" alt="Product"></a>
                                                        <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                    </div>
                                                </div>
                                                <div class="product-right">
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
                                                    <div class="product-button">
                                                        <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                        <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                        <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product">
                                            <div class="product-container">
                                                <div class="product-left">
                                                    <div class="product-thumb">
                                                        <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p23.jpg'); ?>" alt="Product"></a>
                                                        <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                    </div>
                                                </div>
                                                <div class="product-right">
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
                                                    <div class="product-button">
                                                        <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                        <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                        <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div id="hotdeals-2" class="tab-panel">
                                    <ul class="products kt-owl-carousel" data-margin="30" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
                                        <li class="product">
                                            <div class="product-container">
                                                <div class="product-left">
                                                    <div class="product-thumb">
                                                        <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p24.jpg'); ?>" alt="Product"></a>
                                                        <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                    </div>
                                                </div>
                                                <div class="product-right">
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
                                                    <div class="product-button">
                                                        <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                        <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                        <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product">
                                            <div class="product-container">
                                                <div class="product-left">
                                                    <div class="product-thumb">
                                                        <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p25.jpg'); ?>" alt="Product"></a>
                                                        <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                    </div>
                                                </div>
                                                <div class="product-right">
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
                                                    <div class="product-button">
                                                        <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                        <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                        <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product">
                                            <div class="product-container">
                                                <div class="product-left">
                                                    <div class="product-thumb">
                                                        <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p26.jpg'); ?>" alt="Product"></a>
                                                        <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                    </div>
                                                </div>
                                                <div class="product-right">
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
                                                    <div class="product-button">
                                                        <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                        <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                        <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Block hot deals2 -->
            <!-- block banner -->
            <div class="col-sm-12">
                <div class="block block-banner2">
                    <div class="row">
                        <div class="box-left col-sm-12 col-md-8">
                            <div class="col-sm-6">
                                <div class="inner">
                                    <h4><i>DIVE INTO NEW</i></h4>
                                    <h3><b>EXPERIENCES</b></h3>
                                    <div class="content-text">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry everything in-between</p>
                                    </div>
                                    <a href="#" class="button-radius">Shop now<span class="icon"></span></a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/br-banner1.jpg'); ?>" alt="Banner"></a>
                            </div>
                        </div>
                        <div class="box-right col-sm-12 col-md-4">
                            <div class="item i1">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h5><i>DIVE INTO NEW</i></h5>
                                        <h5><b>EXPERIENCES</b></h5>
                                        <div class="content-text">
                                            <p>Clever additions that make your smartphone even smarter.</p>
                                        </div>
                                        <a href="#" class="button-radius">Shop now<span class="icon"></span></a>
                                    </div>
                                    <div class="col-sm-4">
                                        <a class="pull-right" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/b8.png'); ?>" alt="b8"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item i2" style="background: url('<?php echo base_url('assets/tempdkantin/data/option2/b9.jpg'); ?>) no-repeat right center;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5><i>DIVE INTO NEW</i></h5>
                                        <h5><b>EXPERIENCES</b></h5>
                                        <a href="#" class="button-radius">Shop now<span class="icon"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./block banner -->
            <!-- block tabs -->
            <div class="col-sm-12">
                <div class="block 18 block-tabs">
                    <div class="block-head">
                        <div class="block-title">
                            <div class="block-title-text text-lg">new arrivals</div>
                        </div>
                        <ul class="nav-tab">
                            <li><a data-toggle="tab" href="#tab-4">All</a></li>
                            <li  class="active"><a data-toggle="tab" href="#tab-3">Beauty & Perfumes</a></li>
                            <li><a data-toggle="tab" href="#tab-4">Mobile & Tablets</a></li>
                            <li><a data-toggle="tab" href="#tab-3">Fashion</a></li>
                            <li><a data-toggle="tab" href="#tab-4">Auto Accessories</a></li>
                        </ul>
                    </div>
                    <div class="block-inner">
                        <div class="tab-container">
                            <div id="tab-3" class="tab-panel active">
                                <ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p11.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p12.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p13.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p14.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p15.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div id="tab-4" class="tab-panel">
                                <ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p16.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p17.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p18.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p19.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="product">
                                        <div class="product-container">
                                            <div class="product-left">
                                                <div class="product-thumb">
                                                    <a class="product-img" href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/p20.jpg'); ?>" alt="Product"></a>
                                                    <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                                </div>
                                            </div>
                                            <div class="product-right">
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
                                                <div class="product-button">
                                                    <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                                    <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                                    <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./block tabs -->
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="block-popular-cat2">
            <h3 class="title">Popular Categories</h3>
            <div class="block block-popular-cat2-item">
                <div class="block-inner">
                    <div class="cat-name">Electronics</div>
                    <div class="box-subcat">
                        <ul class="list-subcat kt-owl-carousel" data-margin="0" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":7}}'>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c1.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c2.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c3.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c4.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c5.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c6.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c7.jpg'); ?>" alt="Cat"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="block block-popular-cat2-item box2">
                <div class="block-inner">
                    <div class="cat-name">fashion</div>
                    <div class="box-subcat">
                        <ul class="list-subcat kt-owl-carousel" data-margin="0" data-nav="true" data-loop="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":7}}'>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c8.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c9.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c10.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c11.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c12.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c13.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c14.jpg'); ?>" alt="Cat"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="block block-popular-cat2-item box3">
                <div class="block-inner">
                    <div class="cat-name">Sport</div>
                    <div class="box-subcat">
                        <ul class="list-subcat kt-owl-carousel" data-margin="0" data-nav="true" data-loop="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":7}}'>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c15.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c16.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c17.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c18.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c19.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c20.jpg'); ?>" alt="Cat"></a></li>
                            <li class="item"><a href="#"><img src="<?php echo base_url('assets/tempdkantin/data/option2/c21.jpg'); ?>" alt="Cat"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<footer id="footer">
	<!-- footer information -->
			<?php $this->load->view('templates/blanja/component/footermenuvertical') ?>
	<!-- footer information -->

	<!-- footer icon & social media -->
			<?php $this->load->view('templates/blanja/component/footermiddleicon') ?>
	<!-- ffooter icon & social media -->

	<!-- footer icon & social media -->
			<?php $this->load->view('templates/blanja/component/footerabout') ?>
	<!-- ffooter icon & social media -->
</footer>
