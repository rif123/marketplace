
<ul class="products list">
    <?php
      if (!empty($promobox)) {

        foreach ($promobox as $k => $v){
    ?>
    <li class="product">
        <div class="product-container">
            <div class="inner row">
                <div class="product-left col-xs-12 col-sm-5 col-md-4">
                    <div class="product-thumb">
                        <a class="product-img" href="<?php echo generateUrl('p', $v['title'], $v['idProd']); ?>">
                            <img src="<?php echo base_url('attachments/shop_images/').$v['image']; ?>" alt="Product">
                        </a>
                        <a title="Quick View" href="<?php echo generateUrl('p', $v['title'], $v['idProd']); ?>" class="btn-quick-view">Quick View</a>
                    </div>
                </div>
                <div class="product-right col-xs-12 col-sm-7 col-md-8">
                    <div class="product-name">
                        <a href="<?php echo generateUrl('p', $v['title'], $v['idProd']); ?>">
                            <?php echo $v['title']; ?>
                        </a>
                    </div>
                    <div class="price-box">
                          <span class="product-price"><?php echo numberToRp($v['price']); ?></span>
                        <span class="product-price-old"><?php echo numberToRp($v['old_price']); ?></span>
                    </div>
                    <div class="desc">
                        <?php
                            echo $v['title'];
                        ?>
                    </div>
                    <div class="product-button">
                        <a class="btn-add-wishlist" title="Add to Wishlist" href="<?php echo site_url('/add-wishlist')."?id=".$v['idProd']?>">Add Wishlist</a>
                        <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <?php
   }
  }else{
    ?>
    <div class="alert alert-success" style="margin-top:20%" role="alert">
        Maaf Barang Belum Tersedia.
      </div>
<?php
  }
  ?>
</ul>