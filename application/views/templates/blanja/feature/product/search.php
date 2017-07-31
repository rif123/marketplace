<?


$kampus ="?kampus=".$this->input->get('kampus');
$c =$this->uri->segment(2);
$search ="&search=". $this->input->get('search');
$gc ="&GC=".$this->input->get('GC');
$link =site_url('/c').'/'.$c.$kampus;

 // echo site_url('/c').'/'.sanitizeStringForUrl($v['nameKampus']).'?kampus='.$v['idKampus'].'&category='.$v['idWarung'];
 // die;
 ?>
<div class="block-wrap-search col-sm-6 col-md-6 col-lg-5">
  <div class="advanced-search box-radius">
                  <form class="form-inline" action="">
                      <div class="form-group search-category">
                          <select id="category-select" class="search-category-select" name="GC">
                              <option value="">All Categories</option>
                               <?php
                                  foreach ($home_categories as $key => $value) {
                                      echo "<option value='".$value['idCategory']."'>".$value['nameCategory']."</option>";
                                  }
                              ?>
                          </select>
                      </div>
                      <div class="form-group search-input">
                          <input type="text" placeholder="Mau Makan apa hari ini?" name="search">
                      </div>
                        <?php
                          if (!empty($this->input->get('kampus'))) {
                            ?>

                          <input type="hidden" value="<?php echo $this->input->get('kampus'); ?>" name="kampus">
                        <?php } ?>
                        <?php
                          if (!empty($this->input->get('category'))) {
                            ?>

                          <input type="hidden" value="<?php echo $this->input->get('category'); ?>" name="category">
                        <?php } ?>
                        <?php
                          if (!empty($this->input->get('view'))) {
                            ?>

                          <input type="hidden" value="<?php echo $this->input->get('view'); ?>" name="view">
                        <?php } ?>
                        <?php
                          if (!empty($this->input->get('sort'))) {
                            ?>

                          <input type="hidden" value="<?php echo $this->input->get('sort'); ?>" name="sort">
                        <?php } ?>
                        <?php
                          if (!empty($this->input->get('keyWords'))) {
                            ?>

                          <input type="hidden" value="<?php echo $this->input->get('keyWords'); ?>" name="keyWords">
                        <?php } ?>



                      <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                      <?php
                      ?>
                  </form>
  </div>
</div>
