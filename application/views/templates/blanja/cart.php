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
                                                echo "<option value='".$value['idCategory']."'>".$value['nameCategory']."</option>";
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
		            <ul class="step">
		                <li class="current-step"><span>01. Summary</span></li>
		                <li><span>02. Address</span></li>
		                <li><span>03. Shipping</span></li>
		                <li><span>04. Payment</span></li>
		                <li><span>05. Status</span></li>
		            </ul>
		            <div class="heading-counter warning">Your shopping cart contains:
		                <span><?php echo count($listCart); ?> Product</span>
		            </div>
		            <div class="order-detail-content">
		                <table class="cart_summary">
		                    <thead>
		                        <tr>
		                            <th class="cart_product">Product</th>
		                            <th>Description</th>
		                            <th>Avail.</th>
		                            <th>Unit price</th>
		                            <th>Qty</th>
		                            <th>Total</th>
		                            <th class="action"><i class="fa fa-trash-o"></i></th>
		                        </tr>
		                    </thead>
		                    <tbody>
                                <?php
                                $total = 0;
                                foreach ($listCart as $key => $value) {
                                    $totalItems = $value['price_product'] * $value['quantity'];
                                    $total += $totalItems;
                                ?>
		                        <tr>
		                            <td class="cart_product">
		                                <a href="#"><img class="img-responsive" src="<?php echo base_url('/attachments/shop_images/').$value['image_product']; ?>" alt="Product"></a>
		                            </td>
		                            <td class="cart_description">
		                                <p class="product-name">
                                            <a href="#">
                                                <?= $value['title_product'] ?>
                                            </a>
                                        </p>
		                                <small class="cart_ref">Warung : #<?= $value['name_warung']; ?></small><br>
		                                <small><a href="#">Kampus : <?= $value['name_menu_kampus']; ?></a></small><br>
		                            </td>
                                    <?php
                                        if ($value['quantity'] <= $value['quantity_product']) {
                                    ?>
		                            <td class="cart_avail"><span class="label label-success">In stock</span></td>
                                    <?php } else {?>
                                        <td class="cart_avail"><span class="label label-danger">Out of stock</span></td>
                                    <?php } ?>
		                            <td class="price">
                                        <span><?= numberToRp($value['price_product']); ?></span>
                                    </td>
		                            <td class="qty">
		                                <input class="form-control input-sm qtyItems-<?php echo $key; ?>" type="text" value="<?= $value['quantity']; ?>">
		                                <a href="javascript:void(0)" class="upQty" data-literal="<?php echo $key; ?>"  data-price="<?php echo $value['price_product']; ?>" data-id-cart="<?php echo $value['id_cart']; ?>" ><i class="fa fa-caret-up"></i></a>
		                                <a href="javascript:void(0)" class="upDown" data-literal="<?php echo $key; ?>"  data-price="<?php echo $value['price_product']; ?>" data-id-cart="<?php echo $value['id_cart']; ?>"><i class="fa fa-caret-down"></i></a>
		                            </td>
		                            <td class="price total-items-<?= $key ?> ">
		                                <span>
                                            <?=  numberToRp($totalItems) ?>
                                        </span>
		                            </td>
		                            <td class="action">
		                                <a href="javascript:void(0)" class="deleteItems" id-cart="<?php echo $value['id_cart']; ?>" >Delete item</a>
		                            </td>
		                        </tr>
                                <?php } ?>
		                    </tbody>
		                    <tfoot>
		                        <tr>
		                            <td colspan="4"><strong>Total</strong></td>
		                            <td colspan="3" class="total-all-data" data-total-order="<?php echo $total; ?>"><strong><?= numberToRp($total); ?></strong></td>
		                        </tr>
		                    </tfoot>
		                </table>
		                <div class="cart_navigation">
		                    <a class="button" href="#"><i class="fa fa-angle-left"></i> Continue shopping </a>
		                    <a class="button pull-right" href="<?php echo site_url('/shipping/order'); ?>">Proceed to checkout <i class="fa fa-angle-right"></i></a>
		                </div>
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
        var urlPageCart = "<?php echo site_url('/cart/order'); ?>";
        var urlPage = "<?php echo site_url('/cart/update-order'); ?>";
        var urlPageDeleteOrder = "<?php echo site_url('/cart/delete-order'); ?>";
        var upQty = $('.upQty');
        var upDown = $('.upDown');
        var deleteItems = $('.deleteItems');

        upQty.click(function(){
            var lit = $(this).attr('data-literal');
            var box = $('.qtyItems-'+lit);
            var selTotalPerItems = $('.total-items-'+lit);
            var inputQty  = box.val();
            var totalOrder = $('.total-all-data');
            var q = Number(inputQty) + 1;
            // set qty
            box.val(q);
            // set update cart db
            var id_cart = $(this).attr('data-id-cart');
            var postUpdate = { quantity : q , id_cart : id_cart};
            ajaxPage(urlPage, 'post', postUpdate);

            var price = $(this).attr('data-price');
            var quantity = box.val();
            var totalItems = Number(price) * Number(quantity);
            // set price per items
            selTotalPerItems.html(toRp(totalItems));

            // total order
            var priceBeforeUpdate = totalOrder.attr('data-total-order');
            var allOrderPrice = Number(priceBeforeUpdate) + Number(price);
            totalOrder.html(toRp(allOrderPrice));
            totalOrder.attr('data-total-order', allOrderPrice);

        });
        upDown.click(function(){
            var lit = $(this).attr('data-literal');
            var box = $('.qtyItems-'+lit);
            var selTotalPerItems = $('.total-items-'+lit);
            var inputQty  = box.val();
            var totalOrder = $('.total-all-data');
            var q = Number(inputQty) - 1;
            if (q >= 1) {
                // set qty
                box.val(q);
                var id_cart = $(this).attr('data-id-cart');
                var postUpdate = { quantity : q , id_cart : id_cart};
                ajaxPage(urlPage, 'post', postUpdate);

                var price = $(this).attr('data-price');
                var quantity = box.val();
                var totalItems = Number(price) * Number(quantity);
                // set price per items
                selTotalPerItems.html(toRp(totalItems));
                // total order
                var priceBeforeUpdate = totalOrder.attr('data-total-order');
                var allOrderPrice = Number(priceBeforeUpdate) - Number(price);
                totalOrder.html(toRp(allOrderPrice));
                totalOrder.attr('data-total-order', allOrderPrice);
            }
        });
        deleteItems.click(function(){
            var id_cart = $(this).attr('id-cart');
            var postDelete = {id_cart : id_cart};
            ajaxPage(urlPageDeleteOrder, 'post', postDelete).success(function(retval){
                window.location = urlPageCart;
            });
        });
        function ajaxPage(url, type, data) {
            var ajaxGLobal = $.ajax({
              url: url,
              dataType: 'json',
              type: type,
              data :data
            });
            return ajaxGLobal;
        }
        function toRp(angka) {
            var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
            var rev2    = '';
            for(var i = 0; i < rev.length; i++){
                rev2  += rev[i];
                if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
                    rev2 += '.';
                }
            }
            return 'Rp. ' + rev2.split('').reverse().join('');
        }
    </script>
