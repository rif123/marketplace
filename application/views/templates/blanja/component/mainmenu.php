<div class="main-menu">
    <div class="container">
        <div class="row">
            <nav class="navbar" id="main-menu">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="#">MENU</a>
                    </div>

                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?php echo site_url('/'); ?>">Home</a></li>
                            <?php
                                foreach ($listCategory as $k => $val) {
                            ?>
                            <li class="dropdown">
                                    <a href="<?php echo site_url('/').sanitizeStringForUrl($val['name']).'/'.$val['id']; ?>" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url('assets/tempdkantin/data/icon_sale.png'); ?>" alt="<?php echo $val['name']; ?>" />
                                    <?php echo $val['name']; ?></a>
                                    <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 850px;">
                                        <li class="block-container col-sm-3 border">
                                            <div class="img_container banner-hover">
                                                <a href="#">
                                                <img class="img-responsive"  src="<?php echo base_url('attachments/category/').$val['banner']; ?>"  onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/banner/b12.png'); ?>'" alt="<?php echo $val['name']; ?>" />
                                                </a>
                                            </div>
                                        </li>

                                    <li class="block-container col-sm-3">
                                        <ul class="block-megamenu-link">
                                            <li class="link_container group_header">
                                                <a href="#">TO <?php echo $val['name']; ?></a>
                                            </li>
                                            <?php
                                                foreach ($val['children'] as $ky => $v){
                                            ?>
                                                <li class="link_container">
                                                    <a href="<?php echo site_url('/').sanitizeStringForUrl($v['name']).'/'.$v['id']; ?>">
                                                        <?php echo $v['name']; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <?php $getCategoryMenu = getCategoryMenu($val['idCategory']); ?>
                                    <li class="block-container col-sm-3">
                                        <ul class="block-megamenu-img">
                                            <?php
                                                foreach ($getCategoryMenu as $k => $items) {
                                                    if ($k < 3) {
                                            ?>
                                            <li class="img_container banner-hover">
                                                <a href="<?php echo site_url('/p').'/'.sanitizeStringForUrl($items['title']).'-'.$items['id']; ?>">
                                                <img class="img-responsive" src="<?php echo base_url('attachments/shop_images/').$items['image']; ?>" onerror="<?php echo base_url('assets/tempdkantin/data/banner/b13.png'); ?>" alt="<?php echo $items['name']; ?>">
                                                </a>
                                            </li>
                                            <?php }} ?>
                                        </ul>
                                    </li>
                                    <li class="block-container col-sm-3">
                                        <ul class="block-megamenu-img">
                                            <?php
                                                foreach ($getCategoryMenu as $k => $items) {
                                                    if ($k >= 3 && $k <= 6) {
                                            ?>
                                            <li class="img_container banner-hover">
                                                <a href="<?php echo site_url('/p').'/'.sanitizeStringForUrl($items['title']).'-'.$items['id']; ?>">
                                                    <img class="img-responsive" src="<?php echo base_url('attachments/shop_images/').$items['image']; ?>" onerror="<?php echo base_url('assets/tempdkantin/data/banner/b13.png'); ?>" alt="<?php echo $items['name']; ?>">
                                                </a>
                                            </li>
                                            <?php }} ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <?php } ?>
                            <li><a href="blog.html">Blog</a></li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </nav>
        </div>
    </div>
</div>
