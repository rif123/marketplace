
<div class="col-sm-12">
    <div class="block block-tabs">
        <div class="block-head">
            <div class="block-title">
                <div class="block-title-text text-lg">best selling</div>
            </div>
        </div>
        <div class="block-inner">
            <div class="tab-container">
                <div id="tab-1" class="tab-panel active">
                    <ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":5}}'>
                      <?php
                        foreach ($bestSellers as $key => $value) {
                          ?>

                        <li class="product">
                            <div class="product-container">
                                <div class="product-left">
                                    <div class="product-thumb">
                                        <a class="product-img" href="<?php echo generateUrl('p', $value['title'], $value['id']); ?>"><img src="<?php echo base_url('/attachments/shop_images/').$value['image']; ?>" alt="Product" style="width:201px; height:210px"></a>
                                        <a title="Quick View" href="<?php echo generateUrl('p', $value['title'], $value['id']); ?>" class="btn-quick-view">Quick View</a>
                                    </div>
                                </div>
                                <div class="product-right">
                                    <div class="product-name">
                                        <a href="<?php echo generateUrl('p', $value['title'], $value['id']); ?>"><?php echo $value['title']; ?></a>
                                    </div>
                                    <div class="price-box">
                                        <span class="product-price"><?php echo $value['price']; ?></span>
                                        <span class="product-price-old"><?php echo $value['old_price']; ?></span>
                                    </div>
                                    <div class="product-star">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </div>
                                    <div class="product-button">
                                        <a class="btn-add-wishlist" title="Add to Wishlist" href="#">Add Wishlist</a>
                                        <a class="btn-add-comparre" title="Add to Compare" href="#">Add Compare</a>
                                        <a class="button-radius btn-add-cart" title="Add to Cart" href="#">Buy<span class="icon"></span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php }?>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
