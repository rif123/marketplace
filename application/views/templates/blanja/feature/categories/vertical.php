<ul class="vertical-menu-list">
    <?php
    $categories = getSideCategory();
    foreach ($categories as $key => $val) {
    ?>
    <li class="ef4896">
        <a href="#"><img class="icon-menu" alt="Funky roots" src="<?php echo base_url('assets/tempdkantin/data/').$val['icKota']; ?>"><?php echo $val['nameKota']; ?></a>
        <div class="vertical-dropdown-menu">
            <div class="vertical-groups col-sm-12">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="row mega-products">
                            <?php
                                $getCampus = getCampus($val['idKota']);
                                foreach ($getCampus as $k => $v) {
                            ?>
                            <div class="col-sm-4 mega-product">
                                <div class="product-name">
                                    <a href="<?php echo site_url('/p').'/'.sanitizeStringForUrl($v['nameKampus']).'-'.$v['idKampus']; ?>"><?php echo $v['nameKampus']; ?></a>
                                </div>
                            </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>
