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
				<div class="page-content page-order">
		            <ul class="step">
		                <li class="current-step"><span>Confirmasi payment</span></li>
		            </ul>
		            <div class="order-detail-content">
                        <div class="box-border checkout-page">
                            <form id="doConfirm" method="post" action="<?php echo site_url('/confirm/post-order'); ?>" enctype="multipart/form-data">
                                <ul>
                                    <li class="row">
                                        <div class="col-sm-6">
                                            <label for="first_name_1" class="required">Nomor Order</label>
                                            <input type="text" name="no_order" id="first_name_1">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="last_name_1" class="required">Total Transfer</label>
                                            <input type="text" name="total_transfer" id="last_name_1">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="last_name_1" class="required">Bank Transfer </label>
                                            <input type="text" name="bank_transfer" id="last_name_1">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="last_name_1" class="required">To Bank Transfer Dkantin</label>
                                            <input type="text" name="to_bank_transfer" id="last_name_1">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="last_name_1" class="required">Name Account transfer</label>
                                            <input type="text" name="account_transfer" id="last_name_1">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="last_name_1" class="required">Upload file transfer</label>
                                            <input type="file" name="filetransfer" id="last_name_1">
                                        </div>
                                    </li>
                                    <li>&nbsp;</li>
                                    <li>
                                        <input type="hidden" name="id_order" value="<?php echo !empty($listCart[0]['id_order']) ? $listCart[0]['id_order'] : ''; ?>">
                                        <button class="button confirmasi" type="submit">Confirm</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
		                <table class="cart_summary">
		                    <thead>
		                        <tr>
		                            <th class="cart_product">Product</th>
		                            <th>No Order</th>
		                            <th>Description</th>
		                            <th>Avail.</th>
		                            <th>Unit price</th>
		                            <th>Qty</th>
		                            <th>Total</th>
		                        </tr>
		                    </thead>
		                    <tbody>
                                <?php

                                foreach ($listCart as $k => $parents) {
                                    $total = 0;
                                    foreach ($parents as $key => $value) {
                                        $totalItems = $value['price_product'] * $value['quantity'];
                                        $total += $totalItems;
                                    ?>
    		                        <tr>
    		                            <td class="cart_product">
    		                                <a href="#"><img class="img-responsive" src="<?php echo base_url('/attachments/shop_images/').$value['image_product']; ?>" alt="Product"></a>
    		                            </td>
                                        <td class="cart_product">
                                            <?php echo $k; ?>
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
    		                                <?= $value['quantity']; ?>
    		                            </td>
    		                            <td class="price total-items-<?= $key ?> ">
    		                                <span>
                                                <?=  numberToRp($totalItems) ?>
                                            </span>
    		                            </td>
    		                        </tr>
                                    <?php } ?>
                                    <tr>
    		                            <td colspan="6"><strong>Total</strong></td>
    		                            <td colspan="2" class="total-all-data" data-total-order="<?php echo $total; ?>"><strong><?= numberToRp($total); ?></strong></td>
    		                        </tr>
                                <?php } ?>
		                    </tbody>
		                </table>
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
