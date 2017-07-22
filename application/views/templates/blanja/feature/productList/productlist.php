<ul class="products list">
    <?php
        foreach ($listItems as $k => $v){
    ?>
    <li class="product">
        <div class="product-container">
            <div class="inner row">
                <div class="product-left col-xs-12 col-sm-5 col-md-4">
                    <div class="product-thumb">
                        <a class="product-img" href="<?php echo generateUrl('p', $v['itemNames'], $v['idItems']); ?>">
                            <img src="<?php echo base_url('attachments/shop_images/').$v['itemImage']; ?>" alt="Product">
                        </a>
                        <a title="Quick View" href="#" class="btn-quick-view">Quick View</a>
                    </div>
                </div>
                <div class="product-right col-xs-12 col-sm-7 col-md-8">
                    <div class="product-name">
                        <a href="<?php echo generateUrl('p', $v['itemNames'], $v['idItems']); ?>">
                            <?php echo $v['itemNames']; ?>
                        </a>
                    </div>
                    <div class="price-box">
                        <span class="product-price"><?php echo numberToRp($v['itemsPrice']); ?></span>
                        <span class="product-price-old"><?php echo numberToRp($v['itemsOldPrice']); ?></span>
                    </div>
                    <div class="desc">
                        <?php
                            echo $v['decItems'];
                        ?>
                    </div>
                    <div class="product-button">
                        <a class="btn-add-wishlist" title="Add to Wishlist" href="<?php echo site_url('/add-wishlist')."?id=".$v['idItems']?>">Add Wishlist</a>
                        <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>
