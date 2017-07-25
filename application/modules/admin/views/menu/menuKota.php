<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;">MENU KOTA</h1>
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
   <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Menu Kota</a>
   <?php
   if ($menuKota->result()) {
       ?>
       <table class="table table-striped custab">
           <thead>
               <tr>
                   <th>#ID</th>
                   <th>Menu Kota</th>
              <th class="text-center">Action</th>
               </tr>
           </thead>
           <?php $i=1; foreach ($menuKota->result() as $key=> $user) { ?>
               <tr>
                   <td><?= $i ?></td>
                   <td><?= $user->name_menu_kota ?></td>
                <td class="text-center">
                       <div>
                           <a href="?delete=<?= isset($user->id_menu_kota) ? $user->id_menu_kota : "" ?>" class="confirm-delete">Delete</a>
                           <a href="?edit=<?= isset($user->id_menu_kota) ? $user->id_menu_kota : "" ?>">Edit</a>
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
                       <h4 class="modal-title" id="myModalLabel">Add Menu Kota</h4>
                   </div>
                   <div class="modal-body">
                       <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">

                       <div class="form-group">
                           <label for="username">Menu Kota</label>

                           <input type="text" name="name_menu_kota" value="<?= isset($edit['name_menu_kota']) ? $edit['name_menu_kota'] : '' ?>" class="form-control" id="username">
                       </div>

                   <div class="modal-footer">
                   <?php
                   if (isset($edit['id_menu_kota'])) {
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