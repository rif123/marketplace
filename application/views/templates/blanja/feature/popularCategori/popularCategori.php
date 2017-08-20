<div class="block-popular-cat2">
    <h3 class="title">Popular Categories</h3>
    <?php foreach ($popularCategori as $key => $value) {
        $listdata = getItemsPopuler($value['id_category']);
        ?>
    <div class="block block-popular-cat2-item">
        <div class="block-inner">
            <div class="cat-name"><?php echo $value['name_category']; ?></div>
            <div class="box-subcat">
                <ul class="list-subcat kt-owl-carousel" data-margin="0" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":7}}'>
                    <?php foreach ($listdata as $ky => $vl) {
                        ?>
                            <li class="item">
                                <a href="<?php echo site_url('/p').'/'.sanitizeStringForUrl($vl['title_product']).'?detail='.$vl['id_product']; ?>">
                                    <img style="width:63px; height:56px" src="<?php echo base_url('attachments/shop_images/').$vl['image_product']; ?>" alt="<?php $vl['title_product']; ?>"
                                    onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/option2/c1.jpg'); ?>'">
                                </a>
                            </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
