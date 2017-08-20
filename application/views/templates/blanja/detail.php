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
                            <form class="form-inline" action="<?php echo site_url('/search'); ?>">
                                <div class="form-group search-category">
                                    <select id="category-select" class="search-category-select" name="id_category">
                                        <option value="">All Categories</option>
                                        <?php
                                            foreach ($home_categories as $key => $value) {
                                                echo "<option value='".$value['idCategory']."'>".$value['nameCategory']."</option>";
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
        		<?php
                $this->load->view('templates/blanja/component/mainmenu',  ['listCategory' => $home_categories]);
                ?>
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
			<div class="row">
				<div class="col-sm-5">
					<div class="block block-product-image">
						<div class="product-image easyzoom easyzoom--overlay easyzoom--with-thumbnails">
							<a href="<?php echo base_url('/attachments/shop_images/'). $item[0]['image_product']; ?>">
								<img src="<?php echo base_url('/attachments/shop_images/'). $item[0]['image_product']; ?>" alt="Product" width="450" height="450" />
							</a>
						</div>
						<div class="text"><?php echo $item[0]['title_product']?></div>
						<div class="product-list-thumb">
							<ul class="thumbnails kt-owl-carousel" data-margin="10" data-nav="true" data-responsive='{"0":{"items":2},"600":{"items":2},"1000":{"items":3}}'>
								<li>
									<a class="selected" href="<?php echo base_url('/attachments/shop_images/'). $item[0]['image_product']; ?>" data-standard="<?php echo base_url('/attachments/shop_images/'). $item[0]['image_product']; ?>">
										<img src="<?php echo base_url('/attachments/shop_images/'). $item[0]['image_product']; ?>" alt="" />
									</a>
								</li>
                                <?php
                                    $listImage = getImageOther($item[0]['id_product']);
                                    foreach ($listImage as $key => $value) {
                                ?>
								<li>
									<a href="<?php echo base_url('/attachments/shop_images/'). $value['name_image_prod']; ?>" data-standard="<?php echo base_url('/attachments/shop_images/'). $value['name_image_prod']; ?>">
										<img src="<?php echo base_url('/attachments/shop_images/'). $value['name_image_prod']; ?>" alt="" />
									</a>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="row">
						<div class="col-sm-12 col-md-7">
							<div class="block-product-info">
								<h2 class="product-name"><?php echo $item[0]['title_product']; ?></h2>
								<div class="price-box">
									<span class="product-price"><?php echo numberToRp($item[0]['price_product']); ?></span>
									<span class="product-price-old"><?php echo numberToRp($item[0]['old_price_product']); ?></span>
								</div>
		                        <div class="desc"><?php echo $item[0]['desc_product']; ?></div>
								<div class="variations-box">
									<table class="variations-table">
										<tr>
											<td class="table-label">Qty</td>
											<td class="table-value">
												<div class="box-qty">
													<a href="javascript:void(0)" class="quantity-minus">-</a>
													<input type="text" class="quantity" value="1">
													<a href="javascript:void(0)" class="quantity-plus">+</a>
												</div>
												<a href="javascript:void(0)" class="button-radius btn-add-cart cart" data-id-prod="<?php echo $item[0]['id_product']; ?>">Buy<span class="icon"></span></a>
											</td>
										</tr>
									</table>
								</div>
								<div class="box-control-button">
									<a class="link-wishlist" href="#">wishlist</a>
									<a class="link-print" href="#">Print</a>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-5">
						</div>
						<div class="col-sm-12 col-md-12">
							<div class="block block-category-list">
								<div class="block-inner">
                                    <?php
                                        foreach ($home_categories as $kl => $val) {
                                    ?>
									<a href="<?php echo site_url('c/').sanitizeStringForUrl($val['nameCategory']).'?category='.$val['idCategory']; ?>">
										<img class="icon1" src="<?php echo base_url('/assets/tempdkantin/data/').$val['logo_category']; ?>" alt="Icon">
										<img class="icon2" src="<?php echo base_url('/assets/tempdkantin/data/').$val['logo_category']; ?>" alt="Icon">
										<span><?php echo $val['nameCategory']; ?></span>
									</a>
                                    <?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- Product tab -->
			<div class="block block-tabs tab-left">
				<div class="block-head">
					<ul class="nav-tab">
                        <li class="active"><a data-toggle="tab" href="#tab-1">description</a></li>
                        <li><a data-toggle="tab" href="#tab-3">Reviews</a></li>
                  	</ul>
				</div>
				<div class="block-inner">
					<div class="tab-container">
						<div id="tab-1" class="tab-panel active">
							<p>
                                <?php echo $item[0]['desc_product']; ?>
							</p>
						</div>
						<div id="tab-3" class="tab-panel">
							<div id="reviews">
                                <?php
                                    foreach ($listReview as $key => $value) {
                                ?>
								<h4 class="comments-title"><?php echo count($listReview); ?> review for "<?php echo $item[0]['title']; ?>"</h4>
								<ol class="comment-list">
									<li class="comment">
										<div class="comment-avatar">
											<img src="<?php echo base_url('/assets/tempdkantin/data/avatar.jpg'); ?>" alt="Avatar">
										</div>
										<div class="comment-content">
											<div class="comment-meta">
												<a href="#" class="comment-author"><?php echo $value['name_review']; ?></a>
												<span class="comment-date"><?php echo date("d M Y H-i-s", strtotime($value['created'])); ?></span>
												<div class="review-rating">
						                            <i class="fa fa-star-half-o"></i>
						                        </div>
											</div>
											<div class="comment-entry">
												<p><?php echo $value['comment_review']; ?></p>
											</div>
										</div>
									</li>
								</ol>
                                <?php } ?>
                                <form action="<?php site_url('/') ?>" method="post" >
    								<div class="comment-form">
    									<h3 class="comment-reply-title">Leave a Review</h3>
    									<small>Your email address will not be published. Required fields are marked *</small>
    									<p>
    										<label class="required">Name</label>
    										<input type="text">
    									</p>
    									<p>
    										<label class="required">Email</label>
    										<input type="text">
    									</p>
    									<p>
    										<label>Website</label>
    										<input type="text">
    									</p>
    									<p>
    										<label class="required">Comment</label>
    										<textarea rows="5"></textarea>
    									</p>
    									<p>
    										<button class="button">Post review</button>
    									</p>
    								</div>
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Product tab -->
			<!-- Related Products -->
			<div class="block block-products-owl">
				<div class="block-head">
					<div class="block-title">
						<div class="block-title-text text-lg">Related Products</div>
					</div>
				</div>
				<div class="block-inner">
						<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                            <?php
                                foreach ($reletedProduction as $key => $value) {
                            ?>
							<li class="product">
								<div class="product-container">
									<div class="product-left">
										<div class="product-thumb">
											<a class="product-img" href="<?php echo generateUrl('p', $value['itemNames'], $value['idItems']); ?>">
                                                <img src="<?php echo base_url('/attachments/shop_images/').$value['itemImage']; ?>" alt=""></a>
											<a href="<?php echo generateUrl('p', $value['itemNames'], $value['idItems']); ?>" title="Quick View" href="#" class="btn-quick-view">Quick View</a>
										</div>
									</div>
									<div class="product-right">
										<div class="product-name">
											<a href="<?php echo generateUrl('p', $value['itemNames'], $value['idItems']); ?>">
                                                <?php echo $value['itemNames']; ?>
                                            </a>
										</div>
										<div class="price-box">
											<span class="product-price"><?php echo numberToRp($value['itemsPrice']); ?></span>
											<span class="product-price-old"><?php echo numberToRp($value['itemsOldPrice']); ?></span>
										</div>
	                                    <div class="product-button">
	                                    	<a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wish list</a>
	                                    	<a class="button-radius btn-add-cart" title="Add to Cart" href="javascript:void(0)">Buy<span class="icon"></span></a>
	                                    </div>
									</div>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
			</div>
			<!-- ./Related Products -->
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
        $client = !empty($this->session->userdata('auth')->id_client) ? $this->session->userdata('auth')->id_client : "";
        $checksession = !empty($client) ? $client : "";
    ?>
<script>
    var urlCart = "<?php echo site_url('/cart'); ?>";
    var urlCartOrder = "<?php echo site_url('/cart/order'); ?>";
    var qmin = $('.quantity-minus');
    var qplus = $('.quantity-plus');
    var cart = $('.cart');
    var q = $('.quantity');
    var statusSession = "<?php echo $checksession ?>";
    var urlLogin = "<?php echo site_url('//auth/login'); ?>";
    qmin.click(function(){
        var vq = q.val();
        if (vq > 1 ){
            var m  = vq - 1;
            q.val(m);
        }
    });
    qplus.click(function(){
        var vq = q.val();
        var m  = Number(vq) + Number(1);
        q.val(m);
    });

    cart.click(function(){
        var id_product = $(this).attr('data-id-prod');
        var quantity = q.val();
        if (statusSession != "") {
            $.ajax({
                url: urlCart,
                type: "POST",
                data: {quantity : quantity, id_product : id_product},
                dataType : 'json',
                success: function(retval){
                    if (retval.status) {
                        window.location = urlCartOrder;
                    }
                }
            });
        } else {
            swal({
                title: "Info",
                text: "Harap Login terlebuh dahulu!",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: false
        	},
        	function(isConfirm){
                window.location  = urlLogin;
        	});
        }
    });
</script>
