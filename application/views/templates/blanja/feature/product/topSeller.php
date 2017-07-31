
<div class="block block-top-sellers">
    <div class="block-head">
        <div class="block-title">
            <div class="block-icon">
                <img src="<?php echo base_url('assets/tempdkantin/data/top-seller-icon.png'); ?>" alt="store icon">
            </div>
            <div class="block-title-text text-sm">top</div>
            <div class="block-title-text text-lg">Favorite</div>
        </div>
    </div>
    <div class="block-inner">
        <ul class="products kt-owl-carousel" data-items="1" data-autoplay="true" data-loop="true" data-nav="true">
            <?php
                foreach ($topSeller as $key => $value) {

            ?>
            <li class="product">
                <div class="product-container">
                    <div class="product-left">
                        <div class="product-thumb">
                            <a class="product-img" href="">
                                <img src="<?php echo base_url('/attachments/shop_images/').$value['imageProd']; ?>" alt="Product">
                            </a>
                            <a title="Quick View" href="" class="btn-quick-view">Quick View</a>
                        </div>
                    </div>
                    <div class="product-right">
                        <div class="product-name">
                            <a href="">
                                <?php
                                    echo $value['titleProd'];
                                ?>
                            </a>
                        </div>
                        <div class="price-box">
                            <span class="product-price"><?php echo numberToRp($value['priceProd']); ?></span>
                            <span class="product-price-old"><?php echo numberToRp($value['oldPriceProd']); ?></span>
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
