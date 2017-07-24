<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;">Promo Item</h1>
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
   <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add new promo item</a>
   <?php
   if ($promoitem->result()) {
       ?>
       <table class="table table-striped custab">
           <thead>
               <tr>
                   <th>#ID</th>
                   <th>Head Title</th>
                   <th>Title Product</th>
                   <th>creator</th>
                   <th>created</th>
                    <th class="text-center">Action</th>
               </tr>
           </thead>
           <?php $i=1; foreach ($promoitem->result() as $key=> $user) { ?>
               <tr>
                   <td><?= $i ?></td>
                   <td><?= $user->dk_head_title ?></td>
                   <td><?= $user->title ?></td>
                   <td><?= $user->username ?></td>
                   <td><?= $user->created ?></td>
                   <td class="text-center">
                       <div>
                           <a href="?delete=<?= isset($user->id_promo_items) ? $user->id_promo_items : "" ?>" class="confirm-delete">Delete</a>
                           <a href="?edit=<?= isset($user->id_promo_items) ? $user->id_promo_items : "" ?>">Edit</a>
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
                       <h4 class="modal-title" id="myModalLabel">Add Promo Item</h4>
                   </div>
                   <div class="modal-body">
                       <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">
                       <div class="form-group">
                           <label>Head Title</label>

                           <select class="form-control" name="dk_promotion_id">
                               <option value="0">None</option>
                               <?php

                               foreach ($promo as $key_cat => $promos) {
                                 $selected ="";
                                  if (isset($edit['dk_promotion_id'])) {
                                      if ($edit['dk_promotion_id'] == $promos['dk_promotion_id']) {
                                        $selected ="selected";
                                      }
                                  }
                                     ?>
                                   <option value="<?= $promos['dk_promotion_id'] ?>"<?= $selected ?>><?= $promos['dk_head_title'] ?></option>
                               <?php } ?>
                           </select>
                       </div>
                       <div class="form-group">
                           <label>Title Product</label>

                           <select class="form-control" name="id_prod">
                               <option value="0">None</option>
                               <?php

                               foreach ($product as $key_cat => $products) {
                                 if (isset($edit['id_prod'])) {
                                   $selected="";
                                     if ($edit['id_prod'] == $products['id']) {
                                       $selected ="selected";
                                     }
                                 }
                                     ?>
                                   <option value="<?= $products['id'] ?>"<?= $selected ?>><?= $products['title'] ?></option>
                               <?php } ?>
                           </select>
                       </div>
                   <div class="modal-footer">
                   <?php
                   if (isset($edit['id_promo_items'])) {
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
