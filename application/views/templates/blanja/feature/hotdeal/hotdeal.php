<h3 class="title">hot deals</h3>
<div class="row">
    <div class="col-sm-4 col-md-3">
        <div class="hot-deal-tab">
            <div class="countdown">
                <span class="countdown-lastest" data-y="2016" data-m="10" data-d="1" data-h="00" data-i="00" data-s="00"></span>
            </div>
            <ul class="nav-tab">
                <?php foreach ($hotdeal as $key => $value) {
                    $active = "";
                    if ($key == 0){
                        $active = "active";
                    }
                    ?>
                    <li class="<?php echo $active; ?>">
                        <a data-toggle="tab" href="#hotdeals-<?php echo $key;  ?>"><?php  echo $value['dk_title_promotion']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="col-sm-8 col-md-9">
        <div class="tab-container">
            <?php foreach ($hotdeal as $n => $v) {
                    $active = "";
                    if ($n== 0){
                        $active = "active";
                    }
                    $itemsList = getDetailPromo($v['dk_promotion_id']);
                ?>
                <div id="hotdeals-<?php echo $n; ?>" class="tab-panel <?php echo $active; ?>">

                    <ul class="products kt-owl-carousel" data-margin="30" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
                        <?php foreach ($itemsList as $kn => $itm) {?>
                        <li class="product">
                            <div class="product-container">
                                <div class="product-left">
                                    <div class="product-thumb">
                                        <a class="product-img" href="<?php echo site_url('/p').'/'.sanitizeStringForUrl($itm['title_product']).'?detail='.$itm['id_prod']; ?>">
                                            <img style="width:250px; height:250px" src="<?php echo base_url('attachments/shop_images/').$itm['image_product']; ?>" alt="<?php echo $itm['title_product']; ?>"
                                            onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/option2/p21.jpg'); ?>'">
                                        </a>
                                        <a title="Quick View" href="<?php echo site_url('/p').'/'.sanitizeStringForUrl($itm['title_product']).'?detail='.$itm['id_prod']; ?>" class="btn-quick-view">Quick View</a>
                                    </div>
                                </div>
                                <div class="product-right">
                                    <div class="product-name">
                                        <a href="<?php echo site_url('/p').'/'.sanitizeStringForUrl($itm['title_product']).'?detail='.$itm['id_prod']; ?>">
                                            <?php echo $itm['title_product']; ?>
                                        </a>
                                    </div>
                                    <div class="price-box">
                                        <span class="product-price"><?php echo numberToRp($itm['price_product']); ?></span>
                                        <span class="product-price-old"><?php echo numberToRp($itm['old_price_product']); ?></span>
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
            <?php }?>


        </div>
    </div>
</div>
