<?php
if (isset($edit)) {
  //11-07-2017 5 30 AM - 11-08-2017 6 40 PM
    $cik =date('d-m-Y H i A',strtotime($edit['dk_start_date_promotion'])).' - '.date('d-m-Y H i A',strtotime($edit['dk_end_date_promotion']));
  // print_r($cik);die;
}
 ?>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> PROMO SLIDER</h1>
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
   <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add new promo slider</a>
   <?php
   if ($promo->result()) {
       ?>
       <table class="table table-striped custab">
           <thead>
               <tr>
                   <th>#ID</th>
                   <th>Head Title</th>
                   <th>Title</th>
                   <th>Desc</th>
                   <th>Start</th>
                   <th>End</th>
                   <th>Banner</th>
                   <th>db</th>
                   <th>status</th>
                   <th>creator</th>
                   <th>Created</th>
                   <th class="text-center">Action</th>
               </tr>
           </thead>
           <?php $i=1; foreach ($promo->result() as $key=> $user) { ?>
               <tr>
                   <td><?= $i ?></td>
                   <td><?= $user->dk_head_title ?></td>
                   <td><?= $user->dk_title_promotion ?></td>
                   <td><?= $user->dk_description_promotion ?></td>
                   <td><?= date('d-m-Y H:i:s', strtotime($user->dk_start_date_promotion)) ?></td>
                   <td><?= date('d-m-Y H:i:s', strtotime($user->dk_end_date_promotion)) ?></td>
                   <td><img src="<?php echo base_url('/attachments/slider/').$user->dk_banner_promotion ?>" width="30px"></td>
                   <td><?= $user->dk_promotion_db ?></td>
                   <td><?= $user->dk_status ?></td>
                   <td><?= $user->username ?></td>
                   <td><?= $user->created ?></td>
                   <td class="text-center">
                       <div>
                           <a href="?delete=<?= $user->dk_promotion_id ?>" class="confirm-delete">Delete</a>
                           <a href="?edit=<?= $user->dk_promotion_id ?>">Edit</a>
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
                       <h4 class="modal-title" id="myModalLabel">Add Promo</h4>
                   </div>
                   <div class="modal-body">
                      <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">

                   <div class="form-group">
                           <label for="username">Head Title</label>

                           <input type="text" name="dk_head_title" value="<?php echo  isset($edit['dk_head_title']) ? $edit['dk_head_title'] : '' ; ?>" class="form-control" id="username">
                       </div>
                       <div class="form-group">
                           <label for="username">Title</label>
                           <input type="text" name="dk_title_promotion" value="<?php echo  isset($edit['dk_title_promotion']) ? $edit['dk_title_promotion'] : '' ; ?>" class="form-control" id="username">
                       </div>
                       <div class="form-group">
                           <label for="username">Description</label>
                           <input type="text" name="dk_description_promotion" value="<?php echo  isset($edit['dk_description_promotion']) ? $edit['dk_description_promotion'] : '' ; ?>" class="form-control" id="username">
                       </div>
                       <div class="form-group">
                           <label for="username">From To</label>
                           <input type="text" name="daterange" value="<?php echo isset($cik) ? $cik :''; ?>" class="form-control" id="username">
                       </div>
                       <div class="form-group">
                           <label>Banner</label>
                           <input type="file" name="dk_banner_promotion" class="form-control">
                           <?php
                             if (isset($edit['dk_banner_promotion'])) {
                               ?>
                               <img src="<?php echo base_url('/attachments/slider/').$edit['dk_banner_promotion'] ?>" width="30px">

                               <?php
                             }
                            ?>
                       </div>
                       <?php
                       $status= ['Active','No-active'];
                          ?>
                          <div class="form-group">
                              <label>Status</label>

                              <select class="form-control" name="dk_status">
                                  <option value="0">None</option>
                                  <?php

                                  foreach ($status as $key_cat => $stat) {
                                      $selected ="";
                                        if (isset($edit['dk_status'])) {
                                          if ($edit['dk_status'] == $stat) {
                                              $selected ="selected";
                                          }
                                        }
                                        ?>
                                      <option value="<?= $stat ?>"<?= $selected ?> ><?= $stat ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                   <div class="modal-footer">
                     <?php
                     if (isset($edit['dk_promotion_id'])) {
                       ?>
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                       <input type="hidden" name="update" value="<?= isset($data['dk_promotion_id']) ? $data['dk_promotion_id'] : '0' ?>">
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


   <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

 <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
   <script type="text/javascript">

   $(function() {
       $('input[name="daterange"]').daterangepicker({
           timePicker: true,
           timePickerIncrement: 1,
           locale: {
               format: 'DD-MM-YYYY h mm A'
           }
       });
   });
   </script>
   <script>
   <?php if (isset($_GET['edit'])) { ?>
          $(document).ready(function () {
              $("#add_edit_users").modal('show');
          });
   <?php } ?>
   </script>
