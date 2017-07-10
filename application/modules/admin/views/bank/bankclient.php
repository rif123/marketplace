
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
    if ($bank->result()) {
        ?>
        <table class="table table-striped custab">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name Bank</th>
                    <th>creator</th>
                    <th>Created</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php $i=1; foreach ($bank->result() as $key=> $user) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $user->name_bank ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->created ?></td>
                    <td class="text-center">
                        <div>
                            <a href="?delete=<?= $user->id_bank ?>" class="confirm-delete">Delete</a>
                            <a href="?edit=<?= $user->id_bank ?>">Edit</a>
                        </div>
                    </td>
                </tr>
            <?php $i++; } ?>
        </table>
    <?php } else { ?>
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
                          <label for="username">Bank</label>
                            <select class="form-control" name="id_bank">
                                <option value="0">None</option>
                                <?php
                                foreach ($shop_categories as $key_cat => $shop_categorie) {
                                    $aa = '';
                                    foreach ($shop_categorie['info'] as $ff) {
                                        $aa .= '[' . $ff['abbr'] . ']' . $ff['name'] . '/';
                                    }
                                    ?>
                                    <option value="<?= $key_cat ?>"><?= $aa ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Substation Bank</label>

                            <input type="text" name="substation_bankClient" value="<?= isset($edit['substation_bankClient']) ? $edit['substation_bankClient'] : '' ?>" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="username">Name Rek Bank</label>

                            <input type="text" name="name_rek_bankClient" value="<?= isset($edit['name_rek_bankClient']) ? $edit['name_rek_bankClient'] : '' ?>" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="username">No Rek Bank</label>

                            <input type="text" name="no_rek_bankClient" value="<?= isset($edit['no_rek_bankClient']) ? $edit['no_rek_bankClient'] : '' ?>" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label>Fille attachments</label>
                            <input type="file" name="fileBookrek_bankClient" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                    <?php
                    if (isset($edit['id_bank'])) {
                      ?>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                      <input type="hidden" name="update" value="<?= isset($data['id_bank']) ? $data['id_bank'] : '0' ?>">
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