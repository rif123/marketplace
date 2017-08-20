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
		<div class="container" >
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
                                    <input type="text" placeholder="Mau Makan apa hari ini?" name="keyWords" value="<?php echo $this->input->get('keyWords'); ?>">
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

<!-- LIST CART -->
        <div class="row">
            <div class="main-page">
				<h1 class="page-title">Shopping Cart Summary</h1>
				<div class="page-content page-order">
		            <ul class="step" style="padding-left:100px">
		                <li><span>01. Summary</span></li>
		                <li><span>02. Address</span></li>
		                <li class="current-step"><span>Payment</span></li>
		                <li><span>05. Status</span></li>
		            </ul>
                    <div class="box-border checkout-page">
                        <div class="row" style="padding-left:15px; padding-right:15px; ">
                            <div class="heading-counter warning" style="margin:0px">
                                <strong>Subtotal</strong>  <div class="pull-right"><strong><?php echo  numberToRp($payTotal); ?></strong></div>
                            </div>
                            <div class="heading-counter warning" style="margin:0px">
                                Kupon Blanja  <div class="pull-right">-</div>
                            </div>
                            <div class="heading-counter warning" style="margin:0px">
                                <strong>Total Pembayaran </strong> <div class="pull-right"><strong><?php echo  numberToRp($payTotal); ?></strong></div>
                            </div>
                        </div>
                        <div class="row">
                            <div style="padding-left:15px">
                                <h4>Pilih Methode Pembayaran</h4>
                            </div>
                            <?php
                                foreach ($listBank as $key => $val) {
                            ?>
                            <div class="col-sm-3 col-md-3 " style="cursor:pointer">
                                <div class="block footer-block-box box-bank" data-id-bank="<?php echo $val['id_bank']?>" >
                                    <div class="block-head">
                                        <div class="block-title">
                                            <div class="block-title-text text-lg text-center"><?php echo $val['name_bank']; ?></div>
                                        </div>
                                    </div>
                                    <div class="block-inner">
                                        <img src="<?php echo base_url('/attachments/shop_images/').$val['image_bank']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <form>
                                <input type="hidden" value="" class="id_bank" autocomplete="off"/>
                            </form>
                        </div>
                        <div class="cart_navigation">
                            <a class="button" href="<?php echo site_url('/cart/order'); ?>"><i class="fa fa-angle-left"></i>Back Cart</a>
                            <a class="button pull-right dopayment" href="javascript:void(0)">
                                Proceed to checkout
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </form>
                    </div>
		        </div>
			</div>
        </div>
<!-- LIST CART -->
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
        var urlMain = "<?php echo site_url('/'); ?>";
        var urlPage = "<?php echo site_url('/shipping/order-store'); ?>";
        var urlPagePayment = "<?php echo site_url('/shipping/order-status'); ?>";
        $('.box-bank').click(function() {
            $('.box-bank').css('border', '1px solid #eaeaea');
            $(this).css('border', '2px solid red');
            var getIdBank = $(this).attr('data-id-bank');
            $('.id_bank').val(getIdBank);
        });
        $('.dopayment').click(function() {
            var id_bank = $('.id_bank').val();
            $.ajax({
                url: urlPage,
                dataType: 'json',
                type: 'post',
                data :{id_bank : id_bank},
                success: function(retval) {
                    if (retval.status) {
                        window.location = urlPagePayment;
                    } else {
                        window.location = urlMain;
                    }
                }
            });
        });
    </script>
