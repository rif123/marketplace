<div class="block block-sidebar">
  <?php
  foreach ($sideMenu as $key => $sideMenus) {
    ?>
    <div class="block-head">
        <h5 class="widget-title"><?php echo $sideMenus['nameKampus'] ?></h5>
    </div>
<?php } ?>
    <div class="block-inner">
        <div class="block-list-category">
            <ul>
                <?php
                $kampus = $this->input->get('kampus');
                if ($kampus == "") {
                    $loc = $this->session->userdata('location');
                    $kampus = $loc['kampus'];
                }
                $promo = $this->input->get('promo');
                $getTitleSegment = $this->uri->segment(2);
                foreach ($sideBaru as $key => $value) {
                    $parent = explode("|||",$key);
                 ?>
                <li >
                    <a href="<?php echo site_url('/promobox').'/'.sanitizeStringForUrl($getTitleSegment).'?kampus='.$kampus.'&GC='.$parent[1]."&promo=".$promo;?>">
                        <?php echo $parent[0]; ?>
                    </a>
                    <ul>
                        <?php
                          foreach ($value as $k => $v) {
                         ?>
                      <li><span></span><a href="<?php echo site_url('/promobox').'/'.sanitizeStringForUrl($getTitleSegment).'?kampus='.$v['idKampus'].'&category='.$v['idWarung'].'&GC='.$parent[1]."&promo=".$promo; ?>"><?php echo $v['nameWarung'] ?></a></li>
                      <?php } ?>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
