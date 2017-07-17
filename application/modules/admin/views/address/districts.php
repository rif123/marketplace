<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Admin Users</h1>
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
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add new user</a>
    <?php
    if ($districts->result()) {
        ?>
        <table class="table table-striped custab">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Districts</th>
                    <th>City</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php $i=1; foreach ($districts->result() as $key=> $user) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $user->name_districts ?></td>
                    <td><?= $user->name_city ?></td>
                    <td class="text-center">
                        <div>
                            <a href="?delete=<?= isset($user->id_districts) ? $user->id_districts : "" ?>" class="confirm-delete">Delete</a>
                            <a href="?edit=<?= isset($user->id_districts) ? $user->id_districts : "" ?>">Edit</a>
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
                        <h4 class="modal-title" id="myModalLabel">Add Administrator</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">
                        <div class="form-group">
                            <label>City</label>

                            <select class="form-control" name="citys">
                                <option value="0">None</option>
                                <?php

                                foreach ($city as $key_cat => $citys) {
                                        $selected ="";
                                      if ($edit['id_city'] == $citys['id_city']) {
                                          $selected ="selected";
                                      }
                                      ?>
                                    <option value="<?= $citys['id_city'] ?>" <?php echo $selected; ?> ><?= $citys['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="username">Districts</label>

                            <input type="text" name="name" value="<?= isset($edit['name_districts']) ? $edit['name_districts'] : '' ?>" class="form-control" id="username">
                        </div>

                    <div class="modal-footer">
                    <?php
                    if (isset($edit['id_city'])) {
                      ?>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                      <input type="hidden" name="update" value="<?= isset($data['id_city']) ? $data['id_city'] : '0' ?>">
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
