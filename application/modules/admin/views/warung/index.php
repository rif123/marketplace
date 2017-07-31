<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;">MENU WARUNG</h1>
    <hr>
    <?php if (validation_errors()) { ?>
        <hr>
        <div class="alert alert-danger"><?= validation_errors('result_fail') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_fail')) {
        ?>
        <hr>
        <div class="alert alert-danger"><?= $this->session->flashdata('result_fail') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_add')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_add') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_delete')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div>
        <hr>
        <?php
    }
    ?>
   <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Kategori</a>
   <?php
   if ($lists) {
       ?>
       <table class="table table-striped custab">
           <thead>
               <tr>
                   <th>#ID</th>
                   <th>Warung</th>
                   <th>Category</th>
                   <th>Client</th>
                   <th>Kampus</th>
              <th class="text-center">Action</th>
               </tr>
           </thead>
           <?php
                $i=1;
                foreach ($lists as $key=> $cat) {
            ?>
               <tr>
                   <td><?= $i ?></td>
                   <td><?= $cat['nameWarung']?></td>
                   <td><?= $cat['nameCategory']?></td>
                   <td><?= $cat['nameClient']?></td>
                   <td><?= $cat['nameKampus']?></td>
                    <td class="text-center">
                       <div>
                           <a href="?delete=<?= isset($cat['idWarung']) ? $cat['idWarung'] : "" ?>" class="confirm-delete">Delete</a>
                           <a href="?edit=<?= isset($cat['idWarung']) ? $cat['idWarung'] : "" ?>">Edit</a>
                       </div>
                    </td>
               </tr>
           <?php $i++; } ?>
       </table>
   <?php
   echo $links_pagination;
   } else { ?>
       <div class="clearfix"></div><hr>
       <div class="alert alert-info">No users found!</div>
   <?php } ?>
   <!-- add edit users -->
   <div class="modal fade" id="add_edit_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <form action="" method="POST" enctype="multipart/form-data">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="myModalLabel">Add Warung</h4>
                   </div>
                   <div class="modal-body">
                       <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">
                       <div class="form-group">
                           <label for="username">Name Warung</label>
                           <input type="text" name="name_warung" value="<?= isset($edit['name_warung']) ? $edit['name_warung'] : '' ?>" class="form-control" id="name_warung">
                       </div>
                       <div class="form-group">
                           <label for="username">Category</label>
                           <select name="id_category" class="form-control" >
                               <?php
                                foreach ($listCategory as $key => $value) {
                                    $seleted = "";
                                    if ($value['id_category'] == $edit['id_category']) {
                                        $seleted = "selected='selected'";
                                    }
                                    echo '<option '.$seleted.'  value="'.$value['id_category'].'">'.$value['name_category'].'</option>';
                                }
                               ?>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="username">Client</label>
                           <select name="id_client" class="form-control" >
                               <?php
                                foreach ($listClient as $key => $value) {
                                    $seleted = "";
                                    if ($value['id_client'] == $edit['id_client']) {
                                        $seleted = "selected='selected'";
                                    }
                                    echo '<option  '.$seleted.' value="'.$value['id_client'].'">'.$value['name_client'].'</option>';
                                }
                               ?>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="username">Kampus</label>
                           <select name="id_kampus" class="form-control" >
                               <?php
                                foreach ($listkampus as $key => $value) {
                                    $seleted = "";
                                    if ($value['id_menu_kampus'] == $edit['id_kampus']) {
                                        $seleted = "selected='selected'";
                                    }
                                        echo '<option '.$seleted.' value="'.$value['id_menu_kampus'].'">'.$value['name_menu_kampus'].'</option>';
                                }
                               ?>
                           </select>
                       </div>
                   <div class="modal-footer">
                   <?php
                   if (isset($_GET['edit'])) {
                     ?>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary" name="update">Edit</button>
                    <?php
                       }else {
                    ?>
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-primary" name="save">Save</button>
                       <?php
                     }
                          ?>

                   </div>
               </form>
           </div>
       </div>
   </div>
</div>
<script>
<?php if (isset($_GET['edit'])) { ?>
       $(document).ready(function () {
           $("#add_edit_users").modal('show');
       });
<?php } ?>
</script>
