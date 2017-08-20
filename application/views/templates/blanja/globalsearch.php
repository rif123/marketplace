<?php
    $this->load->view('templates/blanja/core/header_detail');
?>

	<!-- header -->
	<header id="header">
		<!-- Top bar -->
        <!-- main header -->
            <?php $this->load->view('templates/blanja/component/mainheader', ['config', $config]); ?>
        <!-- ./main header -->
		<!-- Top bar -->
		<div class="container">
			<!-- box header -->
			<div class="row">
				<div class="box-header">
					<div class="col-sm-12 col-md-12 col-lg-3"></div>
                  <!-- main header -->
                  <?php $this->load->view('templates/blanja/feature/product/search', ['home_categories' => $listSearchCategory,'$currentUrl',""]); ?>
                  <!-- ./main header -->
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
        		<?php $this->load->view('templates/blanja/component/mainmenu',  ['listCategory' => []]); ?>
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
                  <!-- Side Level 2 -->
                    <?php
                        if (!empty($sideMenu)) {
                     ?>
                      <?php $this->load->view('templates/blanja/feature/promo/sideMenuLevel2Promo', ['sideMenu', $sideMenu ,'sideBaru' ,$sideBaru ]); ?>
                    <?php  } ?>
                  <!-- ./Side Level 2 -->
                  <!-- Catalog -->
                      <?php $this->load->view('templates/blanja/feature/product/catalog'); ?>
                  <!-- ./Catalog -->
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9">

                <?php if (empty($listItems)) {?>
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
                                <option value="asc" <?php echo $this->input->get('sort') == 'asc' ? "selected='selected'" : "" ?> >Product Termurah</option>
                                <option value="desc" <?php echo $this->input->get('sort') == 'desc' ? "selected='selected'" : "" ?>>Product Tertinggi</option>
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
                    		<?php $this->load->view('templates/blanja/feature/search/listProduct', ['listItems' => $listItemss, 'links_pagination' => $links_pagination]); ?>
                        <!-- product list-->
                    </div>
                    <?php } else { ?>
                    <div class="category-products">
                        <!-- product list-->
                            <?php $this->load->view('templates/blanja/feature/search/listProductGrid', ['listItems' => $listItemss, 'links_pagination' => $links_pagination]); ?>
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
                                <option value="asc" <?php echo $this->input->get('sort') == 'asc' ? "selected='selected'" : "" ?> >Product Termurah</option>
                                <option value="desc" <?php echo $this->input->get('sort') == 'desc' ? "selected='selected'" : "" ?>>Product Tertinggi</option>
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
                <?php $this->load->view('templates/blanja/component/footermenuvertical', ['partner', [] ]) ?>
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
