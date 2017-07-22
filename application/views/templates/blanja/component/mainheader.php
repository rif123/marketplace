
<div class="container">
    <div class="row">
        <div class="main-header">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="logo">
                        <a href="<?php echo site_url('/'); ?>">
                            <img src="<?php echo base_url('/attachments/config/').$config[0]['logofile_config']; ?>" alt="Logo" style="width:123px; height:46px;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 main-header-banner">
                    <div class="block block-header-right">
                        <ul class="list-link">
                            <li class="item">
                                <a href="#">
                                <span class="icon phone"></span>
                                <span class="line1">Call us:<br><strong><?php echo $config[0]['telp_config']; ?></strong></span>
                                </a>
                            </li>
                            <li class="item">
                                <a href="wishlist.html">
                                <span class="icon wish-list"></span>
                                <span class="line1">Wish<br><strong>List</strong></span>
                                </a>
                            </li>
                            <?php
                                if ($this->session->userdata('auth')) {
                            ?>
                            <li class="item">
                                <a href="<?php echo site_url('/auth/logout'); ?>">
                                    <span class="icon login"></span>
                                    <span class="line1">Logout<br><strong>Keluar Website</strong></span>
                                </a>
                            </li>
                            <?php } else { ?>
                                <li class="item">
                                    <a href="<?php echo site_url('/auth/login'); ?>">
                                        <span class="icon login"></span>
                                        <span class="line1">Login/Registrasi<br><strong>Masuk Website</strong></span>
                                    </a>
                                </li>

                            <?php } ?>
                            <?php if ($this->session->userdata('chart')) { ?>
                            <li class="item">
                                <a href="<?php echo site_url('/'); ?>">
                                    <span class="icon checkout"></span>
                                    <span class="line1">Checkout<br><strong>Order</strong></span>
                                </a>
                            </li>
                            <?php } ?>
                            <li class="item item-cart block-wrap-cart">
                                <a href="cart.html">
                                <span class="icon cart"></span>
                                <span class="line1">Shopping Cart<br><strong>$0.00</strong></span>
                                </a>
                                <?php if ($this->session->userdata('chart')) { ?>
                                <div class="block-mini-cart">
                                    <div class="mini-cart-content">
                                        <h5 class="mini-cart-head">2 Items in my cart</h5>
                                        <div class="mini-cart-list">
                                            <ul>
                                                <li class="product-info">
                                                    <div class="p-left">
                                                        <a href="#" class="remove_link"></a>
                                                        <a href="#">
                                                        <img class="img-responsive" src="<?php echo base_url('assets/tempdkantin/data/p1.jpg') ?>" alt="Product">
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
                                                        <img class="img-responsive" src="<?php echo base_url('assets/tempdkantin/data/p2.jpg') ?>" alt="Product">
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
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
