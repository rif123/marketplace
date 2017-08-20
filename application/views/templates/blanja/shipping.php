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
		                <li><span>01. Summary</span></li>
		                <li class="current-step"><span>02. Address</span></li>
		                <li><span>03. Shipping</span></li>
		                <li><span>04. Payment</span></li>
		                <li><span>05. Status</span></li>
		            </ul>
                    <div class="box-border checkout-page">
                        <p>History Address</p>
                        <div class="panel-group">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                      <a data-toggle="collapse" href="#collapse1">Address</a>
                                    </h4>
                                  </div>
                            <div id="collapse1" class="panel-collapse collapse">
                              <ul class="list-group checked-list-box">
                                    <?php
                                        foreach ($listShipping as $key => $value) {
                                            echo '<li class="list-group-item">
                                                    <input type="checkbox" value="'.$value['id_shipping'].'" class="shipping-history" name="id_shipping" /> '.
                                                    $value['address_shipping']. "|".$value['name'].
                                                "</li>";
                                        }
                                    ?>
                              </ul>
                            <div class="panel-footer">Pilih Alamat</div>
                          </div>
                         </div>
                        </div>
                        <hr />
                        <form id="doShipping">
                            <ul>
                                <li class="row">
                                    <div class="col-sm-6">
                                        <label for="first_name_1" class="required">First Name</label>
                                        <input type="text" name="first_name_shipping" id="first_name_1">
                                    </div>
                                    <!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label for="last_name_1" class="required">Last Name</label>
                                        <input type="text" name="last_name_shipping" id="last_name_1">
                                    </div>
                                    <!--/ [col] -->
                                </li>
                                <!--/ .row -->
                                <li class="row">
                                    <div class="col-sm-6">
                                        <label for="company_name_1">Company Name</label>
                                        <input type="text" name="company_name_shipping" id="company_name_1">
                                    </div>
                                    <!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label for="email_address_1" class="required">Email Address</label>
                                        <input type="text" name="email_shipping" id="email_address_1">
                                    </div>
                                    <!--/ [col] -->
                                </li>
                                <!--/ .row -->
                                <li class="row">
                                    <div class="col-xs-12">
                                        <label for="address_1" class="required">Address</label>
                                        <input type="text" name="address_shipping" id="address_1">
                                    </div>
                                    <!--/ [col] -->
                                </li>
                                <!--/ .row -->
                                <li class="row">
                                    <!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label class="required">State/Province</label>
                                        <div class="custom_select">
                                            <select name="id_prov" class="provinsi_shipping">
                                                <option value=""> Provinsi </option>
                                                <?php
                                                    foreach ($listProv as $key => $value) {
                                                        echo "<option value='".$value['id_prov']."'>".$value['name']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--/ [col] -->
                                    <div class="col-sm-6">
                                        <label for="city_1" class="required">City</label>
                                        <select name="id_city" class="city_shipping">
                                            <option value=""> City </option>
                                        </select>
                                    </div>
                                </li>
                                <!--/ .row -->
                                <li class="row">
                                    <div class="col-sm-6">
                                        <label for="postal_code_1" class="required">Zip/Postal Code</label>
                                        <input type="text" name="postal_shipping" id="postal_code_1">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="telephone_1" class="required">Telephone</label>
                                        <input type="text" name="phone_shipping" id="telephone_1">
                                    </div>
                                </li>
                            </ul>
                            <div class="cart_navigation">
                            <a class="button" href="<?php echo site_url('/cart/order'); ?>"><i class="fa fa-angle-left"></i>Back Cart</a>
                            <a class="button pull-right doshipping" href="javascript:void(0)">
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
        var urlPage = "<?php echo site_url('/shipping/add-shipping'); ?>";
        var urlPagePayment = "<?php echo site_url('/shipping/payment'); ?>";
        var urlGetCity = "<?php echo site_url('/shipping/get-city'); ?>";
        var upQty = $('.upQty');
        var upDown = $('.upDown');
        $('.doshipping').click(function() {
            var data = $('#doShipping').serialize();
            $.ajax({
                url: urlPage,
                dataType: 'json',
                type: 'post',
                data :data,
                success: function(retval) {
                    window.location = urlPagePayment;
                }
            });
        });
        $('.provinsi_shipping').change(function(){
            var id_prov = $(this).val();
            $.ajax({
                url: urlGetCity,
                dataType: 'json',
                type: 'post',
                data : {id_prov : id_prov},
                success: function(retval) {
                    var html  = "";
                    $(retval.list).each(function(index, value){
                        html += "<option value='"+value.id_city+"'>"+value.name+"</option>";
                    });
                    $('.city_shipping').html(html);
                }
            });
        });

        $("input:checkbox").on('click', function() {
          // in the handler, 'this' refers to the box clicked on
          var $box = $(this);
          if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
          } else {
            $box.prop("checked", false);
          }
          swal({
              title: "Are you sure choose address ?",
              text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#31b0d5",
              confirmButtonText: "Yes",
              cancelButtonText: false,
              closeOnConfirm: true,
              closeOnCancel: true
            },
            function(isConfirm){
                var id_shipping = $box.val();
                $.ajax({
                    url: urlPage,
                    dataType: 'json',
                    type: 'post',
                    data :{id_shipping : id_shipping, 'existing' : true},
                    success: function(retval) {
                        window.location = urlPagePayment;
                    }
                });
            });
      });
    </script>
