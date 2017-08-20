<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;">Merchant</h1>
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
   <?php
   if ($lists) {
       ?>
       <table class="table table-striped custab">
           <thead>
               <tr>
                   <th>#ID</th>
                   <th>Name</th>
                   <th>Email</th>
                   <th>Hp</th>
                   <th>Label Merchant</th>
              <th class="text-center">Action</th>
               </tr>
           </thead>
           <?php
                $statusClient = $this->config->item('statusClient');
                $i=1;
                foreach ($lists as $key=> $cat) {
            ?>
               <tr>
                   <td><?= $i ?></td>
                   <td><?= $cat['name_client']?></td>
                   <td><?= $cat['email_client']?></td>
                   <td><?= $cat['hp_client']?></td>
                   <td><?= !empty($cat['name_warung']) ? $cat['name_warung'] : "-" ?></td>
                    <td class="text-center">
                       <div>
                           <a href="?delete=<?= isset($cat['idClient']) ? $cat['idClient'] : "" ?>" class="confirm-delete">Delete</a>
                           <a href="?edit=<?= isset($cat['idClient']) ? $cat['idClient'] : "" ?>">Edit</a>
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
                       <h4 class="modal-title" id="myModalLabel"> Merchant </h4>
                   </div>
                   <div class="modal-body">
                       <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">

                        <div class="form-group">
                           <label for="username">Name</label>
                           <input type="text" name="name_client" value="<?= isset($edit['name_client']) ? $edit['name_client'] : '' ?>" class="form-control" id="name_client">
                        </div>

                        <div class="form-group">
                           <label for="username">Email</label>
                           <input type="text" name="email_client" value="<?= isset($edit['email_client']) ? $edit['email_client'] : '' ?>" class="form-control" id="email_client">
                        </div>

                        <div class="form-group">
                           <label for="username">Hp Client</label>
                           <input type="text" name="hp_client" value="<?= isset($edit['hp_client']) ? $edit['hp_client'] : '' ?>" class="form-control" id="hp_client">
                        </div>

                        <div class="form-group">
                           <label for="username">Gender</label>
                           <select class="form-control"  name="gender_client">
                               <?php
                                $listGender = $this->config->item('listGender');
                                foreach ($listGender as $key => $value) {
                                    $seleted = "";
                                    if ($value == $edit['gender_client']) {
                                        $seleted = "selected='selected'";
                                    }
                                    echo "<option ".$seleted." value='".$value."'>".$value."</option>";
                                }
                               ?>
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="username">Password</label>
                           <input type="password" name="password_client" value="" class="form-control" id="password_client">
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
