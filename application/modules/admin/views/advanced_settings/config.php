<style>

a.disabled {
   pointer-events: none;
   cursor: default;
}
</style>
<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Config</h1>
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
      $status ='';

      if ($config->num_rows() == 1) {
        $status ='disabled';

      }

      ?>
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right <?php echo $status; ?>" style="margin-bottom:10px;"><b>+</b> Add new user</a>
    <?php
    if ($config->result()) {
        ?>
        <table class="table table-striped custab">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Contact</th>
                    <th>Logo Config</th>
                    <th>Facebook</th>
                    <th>Logo</th>
                    <th>Twitter</th>
                    <th>Logo</th>
                    <th>Google Plus</th>
                    <th>Logo</th>
                    <th>LinkedIn</th>
                    <th>Logo</th>
                    <th>Skype</th>
                    <th>Logo</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php $i=1; foreach ($config->result() as $key=> $user) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $user->telp_config ?></td>
                    <td><img src="<?php echo base_url('/attachments/config/').$user->logofile_config ?>" width="50px"></td>
                    <td><?= $user->fb_config ?></td>
                    <td><i class="<?= $user->logo_fb_config ?>"></i></td>
                    <td><?= $user->twit_config ?></td>
                    <td><i class="<?= $user->logo_twit_config ?>"></i></td>
                    <td><?= $user->gp_config ?></td>
                    <td><i class="<?= $user->logo_gp_config ?>"></i></td>
                    <td><?= $user->li_config ?></td>
                    <td><i class="<?= $user->logo_li_config ?>"></i></td>
                    <td><?= $user->skype_config ?></td>
                    <td><i class="<?= $user->logo_skype_config   ?>"></i></td>
                    <td class="text-center">
                        <div>
                            <a href="?edit=<?= $user->id_config ?>">Edit</a>
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
                            <label for="username">Contact</label>

                            <input type="text" name="telp_config" value="<?= isset($edit['telp_config']) ? $edit['telp_config'] : '' ?>" class="form-control" id="username">
                        </div>

                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" name="logofile_config" class="form-control">
                            <img src="<?php echo base_url('/attachments/config/').$user->logofile_config ?>" width="30px">
                        </div>

                        <div class="form-group">
                            <label for="username">Facebook</label>

                            <input type="text" name="fb_config" value="<?= isset($edit['fb_config']) ? $edit['fb_config'] : '' ?>" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="username">Twitter</label>

                            <input type="text" name="twit_config" value="<?= isset($edit['twit_config']) ? $edit['twit_config'] : '' ?>" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="username">Google Plus</label>

                            <input type="text" name="gp_config" value="<?= isset($edit['gp_config']) ? $edit['gp_config'] : '' ?>" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="username">linkin</label>

                            <input type="text" name="li_config" value="<?= isset($edit['li_config']) ? $edit['li_config'] : '' ?>" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="username">Skype</label>

                            <input type="text" name="skype_config" value="<?= isset($edit['skype_config']) ? $edit['skype_config'] : '' ?>" class="form-control" id="username">
                        </div>

                    <div class="modal-footer">
                    <?php
                    if (isset($edit['id_config'])) {
                      ?>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                      <input type="hidden" name="update" value="<?= isset($data['id_config']) ? $data['id_config'] : '0' ?>">
                      <button type="submit" class="btn btn-primary" name="save">Edit</button>
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
