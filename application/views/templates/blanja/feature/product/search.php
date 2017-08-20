<?
$kampus ="?kampus=".$this->input->get('kampus');
$c =$this->uri->segment(2);
$search ="&search=". $this->input->get('search');
$gc ="&GC=".$this->input->get('GC');
$link =site_url('/c').'/'.$c.$kampus;
 ?>
<div class="block-wrap-search col-sm-6 col-md-6 col-lg-5">
  <div class="advanced-search box-radius">
                  <form class="form-inline" action="">
                      <div class="form-group search-category">
                          <select id="category-select" class="search-category-select" name="category">
                              <option value="">All Categories</option>
                               <?php
                                $category = $this->input->get('category');
                                  foreach ($home_categories as $key => $value) {
                                      $selected  = "";
                                      if (!empty($category)){
                                          if ($category == $value['idCategory']) {
                                            $selected = "selected='selected'";
                                          }
                                      }
                                      echo "<option  ".$selected." value='".$value['idCategory']."'>".$value['nameCategory']."</option>";
                                  }
                              ?>
                          </select>
                      </div>
                      <div class="form-group search-input">
                          <?php
                            $keYwords = $this->input->get('keyWords');
                          ?>
                          <input type="text" placeholder="Mau Makan apa hari ini?" name="keyWords" value="<?php echo  !empty($keYwords) ?  $keYwords : "";  ?>">
                      </div>
                        <?php
                          if (!empty($this->input->get('kampus'))) {
                            ?>

                          <input type="hidden" value="<?php echo $this->input->get('kampus'); ?>" name="kampus">
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

                      <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                      <?php
                      ?>
                  </form>
  </div>
</div>
