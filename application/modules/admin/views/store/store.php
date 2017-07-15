

<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;">Store</h1>
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
    <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add new user</a> -->
    <?php
    if ($store->result()) {
        ?>
        <table class="table table-striped custab">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name Client</th>
                    <th>Original Name</th>
                    <th>Name Store</th>
                    <th>Identity</th>
                    <th>Number Identity</th>
                    <th>File Identity</th>
                    <th>NPWP</th>
                    <th>Address</th>
                    <th>Provinces</th>
                    <th>City</th>
                    <th>Districts</th>
                    <th>Postal Code</th>
                    <th>creator</th>
                    <th>Created</th>
                    <!-- <th class="text-center">Action</th> -->
                </tr>
            </thead>
            <?php $i=1; foreach ($store->result() as $key=> $user) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $user->name_client ?></td>
                    <td><?= $user->original_name_store ?></td>
                    <td><?= $user->name_store ?></td>
                    <td><?= $user->name_identity ?></td>
                    <td><?= $user->no_identity_store ?></td>
                    <td><?= $user->file_identity_store ?></td>
                    <td><?= $user->npwp_store ?></td>
                    <td><?= $user->address_store ?></td>
                    <td><?= $user->name_prov ?></td>
                    <td><?= $user->name_city ?></td>
                    <td><?= $user->name_districts ?></td>
                    <td><?= $user->postal_code ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->created ?></td>
                </tr>
            <?php $i++; } ?>
        </table>
    <?php echo $links_pagination;}
     else { ?>
        <div class="clearfix"></div><hr>
        <div class="alert alert-info">No users found!</div>
    <?php } ?>

<script>
<?php if (isset($_GET['edit'])) { ?>
        $(document).ready(function () {
            $("#add_edit_users").modal('show');
        });
<?php } ?>
</script>
