<?php if (!empty($this->session->flashdata('message_error'))) { ?>
<script>
swal("Failed!", "<?php echo $this->session->flashdata('message_error'); ?>");
</script>
<?php  } ?>

<?php if (!empty($this->session->flashdata('message_success'))) { ?>
<script>
swal("Success", "<?php echo $this->session->flashdata('message_success'); ?>");
</script>
<?php  } ?>
