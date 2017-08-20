<?php
    $this->load->view('templates/blanja/_parts/header');
?>

<header id="header">
    <!-- main header -->
    	<?php $this->load->view('templates/blanja/component/mainheader'); ?>
    <!-- ./main header -->
    <!-- main menu-->
		<?php $this->load->view('templates/blanja/component/mainmenu'); ?>
    <!-- ./main menu-->
</header>

<div class="container">
        <div class="row">
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <!-- Block vertical-menu -->
                <div class="block block-vertical-menu">
                    <div class="vertical-head">
                        <h5 class="vertical-title">Categories</h5>
                    </div>
                    <div class="vertical-menu-content">
                        <!-- menu vertical  -->
                        	<?php $this->load->view('templates/blanja/feature/categories/vertical'); ?>
                        <!-- menu vertical  -->
                    </div>
                </div>
                <!-- ./Block vertical-menu -->
            </div>
            <!-- block search -->
            <div class="col-sm-5 col-md-7">
                <div class="advanced-search box-radius">
                    <form class="form-inline" action="<?php echo site_url('/global/search'); ?>">
                        <div class="form-group search-category">
                            <select id="category-select" class="search-category-select" name="category">
                                <option value="">All Categories</option>
                                <?php
                                    foreach ($listSearchcategory as $key => $value) {
                                        echo "<option value='".$value['idCategory']."'>".$value['nameCategory']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group search-input">
                            <input type="text" placeholder="Mau Makan apa hari inis?" name="keyWords">
                        </div>
                        <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <!-- ./block search -->

            <div class="col-sm-9 col-md-7">
                <!-- Home slide -->
                <div class="block block-slider">
                    <ul class="home-slider kt-bxslider">
                        <?php foreach ($promoSlider as $key => $val) { ?>
                        <li>
                            <a href="<?php echo site_url('/promobox')."/".sanitizeStringForUrl(trim($val['dk_title_promotion']))."?promo=".$val['dk_promotion_id'];  ?>">
                                <img style="width:640px; height:383px" src="<?php echo base_url('attachments/slider').'/'.$val['dk_banner_promotion']; ?>" alt="Slider" onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/option2/slider1.jpg'); ?>'" >
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- ./Home slide -->
            </div>


            <div class="col-sm-9 col-md-3">
                <div class="block-banner-right banner-hover">
                    <?php
                        foreach ($promoSlider as $key => $val) {
                            if ($key < 2) {
                    ?>
                            <a href="<?php echo site_url('/promobox')."/".sanitizeStringForUrl(trim($val['dk_title_promotion']))."?promo=".$val['dk_promotion_id'];  ?>">
                                <img src="<?php echo base_url('attachments/slider').'/'.$val['dk_banner_promotion']; ?>" alt="Banner" onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/option2/banner2.png'); ?>'" >
                            </a>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>

            <!-- block banner owl-->
            <div class="col-sm-12">
                <div class="block block-banner-owl" >
                    <div class="block-inner kt-owl-carousel" data-margin="30" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":3}}'>
                    <?php
                        foreach ($promoDiscount as $key => $val) {
                    ?>
                        <div class="banner-text" style="background:<?php echo $val['dk_banner_promotion'];   ?>">
                            <h4><?php echo $val['dk_head_title']; ?></h4>
                            <h2><b><?php echo $val['dk_title_promotion']; ?></b></h2>
                            <p><?php echo $val['dk_description_promotion']; ?></p>
                            <a class="button-radius white" href="<?php echo site_url('/promobox')."/".sanitizeStringForUrl(trim($val['dk_title_promotion']))."?promo=".$val['dk_promotion_id']; ?>">Shop     now<span class="icon"></span></a>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <!-- ./block banner owl-->



            <!-- block tabs -->
                <?php $this->load->view('templates/blanja/feature/product/bestSeller/bestSeller', ['bestSellers' => $bestSellers ]); ?>
            <!-- ./block tabs -->
            <!-- Block hot deals2 -->
            <div class="col-sm-12">
                <div class="block-hot-deals2">
                    <!-- menu vertical  -->
                            <?php $this->load->view('templates/blanja/feature/hotdeal/hotdeal', ['hotdeal' => $hotDeal ]); ?>
                    <!-- menu vertical  -->
                </div>
            </div>
            <!-- Block hot deals2 -->

    </div>
</div>
<div class="container">
    <div class="row">
        <?php $this->load->view('templates/blanja/feature/popularCategori/popularCategori', ['popularCategori' => $popularCategori ]); ?>
    </div>
</div>




<footer id="footer">
	<!-- footer information -->
			<?php $this->load->view('templates/blanja/component/footermenuvertical') ?>
	<!-- footer information -->

	<!-- footer icon & social media -->
			<?php $this->load->view('templates/blanja/component/footermiddleicon',['config',$config ]) ?>
	<!-- ffooter icon & social media -->

	<!-- footer icon & social media -->
			<?php $this->load->view('templates/blanja/component/footerabout',['config',$config ]) ?>
	<!-- ffooter icon & social media -->
<?php $this->load->view('templates/blanja/_parts/footer'); ?>

<?php     $this->load->view('templates/blanja/core/alertNotif');  ?>
<script>
    var urlSetUrl = "<?php echo site_url('/lokasi/switch-loc'); ?>";
    var urlHome = "<?php echo site_url('/'); ?>";
    $('.kotaEvent').click(function(){
        var kota = $(this).attr('data-id-kota');
        $.ajax({
            url: urlSetUrl,
            dataType : 'json',
            data : {kota : kota},
            type : 'post',
            success: function(html){
                if(html.status){
                    window.location = urlHome;
                }
            }
        });
    });
</script>
