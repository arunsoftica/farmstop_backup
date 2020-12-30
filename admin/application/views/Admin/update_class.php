<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Update Class</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="update_class" method="post">

   <div class="row">
   <div class="form-group col-md-6">
   <h4>Class Name</h4>
   <input type="hidden" name="class_id" value="<?php echo $getclass['id'] ?>">
   <input type="text" value="<?php echo $getclass['class_name'] ?>" name="class_name" class="form-control" >
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