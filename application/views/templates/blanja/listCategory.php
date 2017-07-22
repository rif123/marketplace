<?php
    $this->load->view('templates/blanja/core/header_detail');
?>

	<!-- header -->
	<header id="header">
		<!-- Top bar -->
        <!-- main header -->
            <?php $this->load->view('templates/blanja/component/mainheader'); ?>
        <!-- ./main header -->
		<!-- Top bar -->
		<div class="container">
			<!-- box header -->
			<div class="row">
				<div class="box-header">
					<div class="col-sm-12 col-md-12 col-lg-3"></div>
					<div class="block-wrap-search col-sm-6 col-md-6 col-lg-5">
						<div class="advanced-search box-radius">
                            <form class="form-inline" action="<?php echo site_url('/global/search'); ?>">
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
					<div class="wrap-block-cl col-sm-3 col-md-3 col-lg-2">

					</div>
					<div class="block-wrap-cart col-sm-3 col-md-3 col-lg-2">
						<div class="iner-block-cart box-radius">
							<a href="cart.html">
								<span class="total">$459.00</span>
							</a>
						</div>
						<div class="block-mini-cart">
							<div class="mini-cart-content">
                            <h5 class="mini-cart-head">2 Items in my cart</h5>
                            <div class="mini-cart-list">
                                <ul>
	                                <li class="product-info">
	                                    <div class="p-left">
	                                        <a href="#" class="remove_link"></a>
	                                        <a href="#">
	                                        <img class="img-responsive" src="data/p1.jpg" alt="Product">
	                                        </a>
	                                    </div>
	                                    <div class="p-right">
	                                        <p class="p-name">Donec Ac Tempus</p>
	                                        <p class="product-price">$139.98</p>
	                                        <p>Qty: 1</p>
	                                    </div>
	                                </li>
	                                <li class="product-info">
	                                    <div class="p-left">
	                                        <a href="#" class="remove_link"></a>
	                                        <a href="#">
	                                        <img class="img-responsive" src="data/p2.jpg" alt="Product">
	                                        </a>
	                                    </div>
	                                    <div class="p-right">
	                                        <p class="p-name">Donec Ac Tempus</p>
	                                        <p class="product-price">$139.98</p>
	                                        <p>Qty: 1</p>
	                                    </div>
	                                </li>
	                            </ul>
	                            </div>
	                            <div class="toal-cart">
	                                <span>Total</span>
	                                <span class="toal-price pull-right">$279.96</span>
	                            </div>
	                            <div class="cart-buttons">
	                                <a href="checkout.html" class="button-radius btn-check-out">Checkout<span class="icon"></span></a>
	                            </div>
	                        </div>
						</div>
					</div>
				</div>
			</div>
			<!-- ./box header -->
			<!-- main header -->
			<div class="row">
				<div class="main-header">

				</div>
			</div>
			<!-- ./main header -->
		</div>
		<!-- main menu-->
		<div class="main-menu">
            <!-- main menu-->
        		<?php $this->load->view('templates/blanja/component/mainmenu',  ['listCategory' => $home_categories]); ?>
            <!-- ./main menu-->
		</div>
		<!-- ./main menu-->
	</header>
	<!-- ./header -->
	<div class="container product-page">
		<div class="row">
			<div class="block block-breadcrumbs">
				<ul>
					<li class="home">
						<a href="#"><i class="fa fa-home"></i></a>
						<span></span>
					</li>
					<li><a href="#">Beauty & Perfumes</a><span></span></li>
					<li>Men</li>
				</ul>
			</div>
		</div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="block block-sidebar">
                    <div class="block-head">
                        <h5 class="widget-title"><?php echo $whereCategory['name']; ?></h5>
                    </div>
                    <div class="block-inner">
                        <div class="block-list-category">
                            <ul >
                                <?php
                                $level3 = [];
                                    foreach ($whereCategory['children'] as $key => $value) {
                                ?>
                                <li >
                                    <a href="<?php echo generateUrl('', $value['name'],  "")."?category=".$whereCategory['idCategory']."&c2=".$value['idCategory']; ?>">
                                        <?php echo $value['name']; ?>
                                    </a>
                                    <ul>
                                        <?php
                                        if (!empty($value['children'])) {
                                            foreach ($value['children'] as $k => $v) {
                                                $level3[] = $v;
                                                ?>
                                                <li><span></span><a href="<?php echo generateUrl('', $v['name'],  "")."?category=".$whereCategory['idCategory']."&c2=".$value['idCategory']."&c3=".$v['idCategory']; ?>"><?php echo $v['name']; ?></a></li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="block block-sidebar">
                    <div class="block-head">
                        <h5 class="widget-title">Catalog</h5>
                    </div>
                    <div class="block-inner">
                        <div class="block-filter">
                            <div class="block-sub-title">Jumlah Kategori </div>
                            <div class="block-filter-inner">
                                <ul class="check-box-list">
                                    <?php
                                        foreach ($level3 as $key => $value) {
                                    ?>
                                        <li>
                                            <label for="c1">
                                                <?php echo $value['name']; ?><span class="count">(<?php echo getCountItems($value); ?>)</span>
                                            </label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="block-filter">
                            <div class="block-sub-title">Price</div>
                            <div class="block-filter-inner">
                                <div class="amount-range-price">Range: $50 - $350</div>
                                <div data-label-reasult="Range:" data-min="0" data-max="500" data-unit="$" class="slider-range-price" data-value-min="50" data-value-max="350"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- block  top sellers -->
                <div class="block block-top-sellers">
                    <div class="block-head">
                        <div class="block-title">
                            <div class="block-icon">
                                <img src="<?php echo base_url('assets/tempdkantin/data/top-seller-icon.png'); ?>" alt="store icon">
                            </div>
                            <div class="block-title-text text-sm">top</div>
                            <div class="block-title-text text-lg">SELLERS</div>
                        </div>
                    </div>
                    <div class="block-inner">
                        <ul class="products kt-owl-carousel" data-items="1" data-autoplay="true" data-loop="true" data-nav="true">
                            <?php
                                foreach ($bestSellers as $key => $value) {

                            ?>
                            <li class="product">
                                <div class="product-container">
                                    <div class="product-left">
                                        <div class="product-thumb">
                                            <a class="product-img" href="#">
                                                <img src="<?php echo base_url('/attachments/shop_images/').$value['image']; ?>" alt="Product">
                                            </a>
                                            <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-right">
                                        <div class="product-name">
                                            <a href="<?php echo generateUrl('p', $value['title'], $value['id']); ?>">
                                                <?php
                                                    echo $value['title'];
                                                ?>
                                            </a>
                                        </div>
                                        <div class="price-box">
                                            <span class="product-price"><?php echo numberToRp($value['price']); ?></span>
                                            <span class="product-price-old"><?php echo numberToRp($value['old_price']); ?></span>
                                        </div>
                                        <div class="product-button">
                                            <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                            <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <!-- block  top sellers -->

            </div>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <h3 class="page-title">
                    <span><?php echo $nameCategory ?></span>
                </h3>
                <?php if (!empty($listItems)) {?>
                <div class="sortPagiBar">
                    <?php
                        $view = $this->input->get('view');
                        $sel = "";
                        if ($view == 'list') {
                            $sel ='selected';
                        }
                    ?>
                    <ul class="display-product-option">
                        <li class="view-as-grid <?php echo $sel == '' ? 'selected' : ''?>">
                            <span>grid</span>
                        </li>
                        <li class="view-as-list <?php echo $sel; ?>">
                            <span>list</span>
                        </li>
                    </ul>
                    <div class="sortPagiBar-inner">
                        <nav>
                            <nav>
                                <?php echo $links_pagination; ?>
                            </nav>
                        </nav>
                        <div class="sort-product">
                            <select name="price" class="price">
                                <option value="" <?php echo $this->input->get('sort') == '' ? "selected='selected'" : "" ?>>Harga</option>
                                <
                                <option value="desc" <?php echo $this->input->get('sort') == 'desc' ? "selected='selected'" : "" ?> >Product Termurah</option>
                                <option value="asc" <?php echo $this->input->get('sort') == 'asc' ? "selected='selected'" : "" ?>>Product Tertinggi</option>
                            </select>
                            <div class="icon"><i class="fa fa-sort-alpha-asc"></i></div>
                        </div>
                    </div>
                </div>

                <?php
                    if ($view == 'list') {
                ?>
                <div class="category-products">
                    <!-- product list-->
                		<?php $this->load->view('templates/blanja/feature/productlist/productlist', ['listItems' => $listItems, 'links_pagination' => $links_pagination]); ?>
                    <!-- product list-->

                </div>
                <?php } else { ?>
                <div class="category-products">
                    <!-- product list-->
                        <?php $this->load->view('templates/blanja/feature/productlist/productGrid', ['listItems' => $listItems, 'links_pagination' => $links_pagination]); ?>
                    <!-- product list-->
                </div>
                <?php } ?>
                <div class="sortPagiBar">
                    <ul class="display-product-option">
                        <li class="view-as-grid <?php echo $sel == '' ? 'selected' : ''?>">
                            <span>grid</span>
                        </li>
                        <li class="view-as-list <?php echo $sel; ?>">
                            <span>list</span>
                        </li>
                    </ul>
                    <div class="sortPagiBar-inner">
                        <nav>
                            <?php echo $links_pagination; ?>
                        </nav>
                        <div class="sort-product">
                            <select name="price" class="price">
                                <option value="" <?php echo $this->input->get('sort') == '' ? "selected='selected'" : "" ?>>Harga</option>
                                <
                                <option value="desc" <?php echo $this->input->get('sort') == 'desc' ? "selected='selected'" : "" ?> >Product Termurah</option>
                                <option value="asc" <?php echo $this->input->get('sort') == 'asc' ? "selected='selected'" : "" ?>>Product Tertinggi</option>
                            </select>
                            <div class="icon"><i class="fa fa-sort-alpha-asc"></i></div>
                        </div>
                    </div>
                </div>
                <?php }  else { ?>
                    <div class="alert alert-success" style="margin-top:20%"role="alert">
                        Maaf barang belum tersedia.
                    </div>
                <?php } ?>
            </div>
        </div>

	</div>
	<!-- footer -->
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
    <?php
        $this->load->view('templates/blanja/core/footer_detail');
    ?>

    <script>
    var current_base_url = "<?php echo $currentUrl ?>";
    var getView = "<?php echo !empty($view) ? $view : '' ?>";
    var sort = "<?php echo $this->input->get('sort'); ?>";
        $('.price').change(function(){
            if (getView != ""){
                window.location = current_base_url+"&sort="+$(this).val()+"&view="+getView;
            } else {
                window.location = current_base_url+"&sort="+$(this).val();
            }
        });
        $('.view-as-grid').click(function(){
            if (sort != ""){
                window.location = current_base_url+"&sort="+sort+"&view=grid";
            } else {
                window.location = current_base_url+"&view=grid";
            }
        });
        $('.view-as-list').click(function(){
            if (sort != ""){
                window.location = current_base_url+"&sort="+sort+"&view=list";
            } else {
                window.location = current_base_url+"&view=list";
            }
        });
    </script>
