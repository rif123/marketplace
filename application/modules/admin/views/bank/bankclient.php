
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



if ($bankclient->result()) {
?>
<table class="table table-striped custab">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Name Client</th>
            <th>Name Bank</th>
            <th>Substation</th>
            <th>Name Rek Bank</th>
            <th>No Rek Bank</th>
            <th>File Book Rek</th>
            <th>creator</th>
            <th>Created</th>
            <th class="text-center">Action</th>
            <!-- <th class="text-center">Action</th> -->
        </tr>
    </thead>

    <?php $i=1; foreach ($bankclient->result() as $key=> $user) { ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $user->name_client ?></td>
            <td><?= $user->name_bank ?></td>
            <td><?= $user->substation_bankClient ?></td>
            <td><?= $user->name_rek_bankClient ?></td>
            <td><?= $user->no_rek_bankClient ?></td>
            <td><?= $user->fileBookrek_bankClient ?></td>
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
<?php
echo $links_pagination;
} else { ?>
  <div class="clearfix"></div><hr>
  <div class="alert alert-info">No users found!</div>
<?php } ?>
