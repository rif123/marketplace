<link href="<?= base_url('assets/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<h1><img src="<?= base_url('assets/imgs/settings-page.png') ?>" class="header-img" style="margin-top:-3px;">Settings</h1>
<hr>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-success col-h">
            <div class="panel-heading">Setting Toko</div>
            <div class="panel-body">
                <?php if ($this->session->flashdata('resultfooterSocial')) { ?>
                    <div class="alert alert-info"><?= $this->session->flashdata('resultfooterSocial') ?></div>
                <?php } ?>
                <form method="POST" action="">
                    <div class="form-group" style="position: relative;">
                        <label>Nama Warung</label>
                        <input type="text" class="form-control" name="name_warung" value="<?php echo !empty($edit['name_warung']) ? $edit['name_warung'] : ''; ?>">
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label>Kota</label>
                        <select name="id_city" class="form-control">
                            <option value="">Kota</option>
                            <?php
                                foreach ($listKota as $key => $value) {
                                    $selected = "";
                                    if(!empty($edit['id_city'])) {
                                        if ($value['id_menu_kota'] == $edit['id_city']) {
                                            $selected = "selected='selected'";
                                        }
                                    }
                                    echo "<option  ".$selected."  value='".$value['id_menu_kota']."'>".$value['name_menu_kota']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label>Kategori</label>
                        <select name="id_category" class="form-control">
                            <option value="">Kategori</option>
                            <?php
                                foreach ($listCategory as $key => $value) {
                                    $selected = "";
                                    if(!empty($edit['id_category_master'])) {
                                        if ($value['name_category'] == $edit['name_category']) {
                                            $selected = "selected='selected'";
                                        }
                                    }
                                    echo "<option  ".$selected." value='".$value['name_category']."'>".$value['name_category']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label>Kampus</label>
                        <select name="id_kampus" class="form-control">
                            <option value="">Kampus</option>
                            <?php
                                foreach ($listMenuKampus as $key => $value) {
                                    $selected = "";
                                    if(!empty($edit['id_kampus'])) {
                                        if ($value['id_menu_kampus'] == $edit['id_kampus']) {
                                            $selected = "selected";
                                        }
                                    }
                                    echo "<option ".$selected." value='".$value['id_menu_kampus']."'>".$value['name_menu_kampus']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label>Alamat Warung</label>
                        <textarea name="address_warung" class="form-control"><?php echo $edit['address_warung'];  ?></textarea>
                    </div>
                    <?php
                        if ($statusButton) {
                    ?>
                    <div class="form-group" style="position: relative;">
                        <button class="button button-success" name="update">Update</button>
                    </div>
                <?php } else {?>
                    <div class="form-group" style="position: relative;">
                        <button class="button button-success" name="save">Save</button>
                    </div>
                <?php }  ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/js/bootstrap-toggle.min.js') ?>"></script>
