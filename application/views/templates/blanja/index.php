<header id="header">
    <!-- main header -->
    	<?php $this->load->view('templates/blanja/component/mainheader'); ?>
    <!-- ./main header -->
    <!-- main menu-->
		<?php $this->load->view('templates/blanja/component/mainmenu',  ['listCategory' => $home_categories]); ?>
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
                        <!-- menu vertical  -->
                        	<?php $this->load->view('templates/blanja/feature/categories/vertical', [  'categories' => $home_categories ]); ?>
                        <!-- menu vertical  -->
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <!-- block search -->
            <div class="col-sm-5 col-md-7">
                <div class="advanced-search box-radius">
                    <form class="form-inline" action="<?php echo site_url('/search'); ?>">
                        <div class="form-group search-category">
                            <select id="category-select" class="search-category-select" name="category">
                                <option value="">All Categories</option>
                                <?php
                                    foreach ($home_categories as $key => $value) {
                                        echo "<option value='".$value['id']."'>".$value['name']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group search-input">
                            <input type="text" placeholder="Mau Makan apa hari ini?" name="keyWords">
                        </div>
                        <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <!-- ./block search -->

            <div class="col-sm-9 col-md-7">
                <!-- Home slide -->
                <div class="block block-slider">
                    <ul class="home-slider kt-bxslider">
                        <?php foreach ($promoSlider as $key => $val) { ?>
                        <li>
                            <a href="<?php echo site_url('/promobox')."/".sanitizeStringForUrl(trim($val['dk_title_promotion']))."-".$val['dk_promotion_id']; ?>">
                                <img style="width:640px; height:383px" src="<?php echo base_url('attachments/slider').'/'.$val['dk_banner_promotion']; ?>" alt="Slider" onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/option2/slider1.jpg'); ?>'" >
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
                    <!-- menu vertical  -->
                            <?php $this->load->view('templates/blanja/feature/hotdeal/hotdeal', ['hotdeal' => $promoHorizontal ]); ?>
                    <!-- menu vertical  -->
                </div>
            </div>
            <!-- Block hot deals2 -->

            <!-- block tabs -->
            <div class="col-sm-12">
                <!--
                    <?php $this->load->view('templates/blanja/feature/newArrivals/Arrivals', ['hotdeal' => $promoHorizontal ]); ?>
                 -->
            </div>
            <!-- ./block tabs -->
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php $this->load->view('templates/blanja/feature/popularCategori/popularCategori', ['popularCategori' => $popularCategori ]); ?>
    </div>
</div>




<footer id="footer">
	<!-- footer information -->
			<?php $this->load->view('templates/blanja/component/footermenuvertical', ['partner', $partner]) ?>
	<!-- footer information -->

	<!-- footer icon & social media -->
			<?php $this->load->view('templates/blanja/component/footermiddleicon') ?>
	<!-- ffooter icon & social media -->

	<!-- footer icon & social media -->
			<?php $this->load->view('templates/blanja/component/footerabout') ?>
	<!-- ffooter icon & social media -->
</footer>
