<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>

<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Update Subject</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="update_subject" method="post">

   <div class="row">
   <div class="form-group col-md-4">
   <h4>Class Name</h4>
   <input type="hidden" name="sub_id" value="<?php echo $getsubject['id'] ?>">
   <input type="text" name="class" id="class" value="<?php echo $getsubject['classname'] ?>" class="form-control" readonly>
   
   </div>
   
   </div> 
   
   <div class="row">
   <div class="form-group col-md-4">
   <h4>Subject Name</h4>
   <input type="text" name="subject_name" value="<?php echo $getsubject['subject_name'] ?>" class="form-control" >
   </div>
   
   </div>


   <div class="row">
   <div class="form-group col-md-6">
   
   <button type="submit" name="submit" class="btn btn-primary">Update</button>
   </div>
   
   </div> 






    </form>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

</div>
</div>

<script>


</script>