
<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Add Admin</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="add_admin" enctype="multipart/form-data" method="post">

   

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>First Name</h4>
   <input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Middle Name</h4>
   <input type="text" name="middle_name" value="<?php echo set_value('middle_name'); ?>" class="form-control" >
   </div>
   
   </div>
   <div class="row">
   <div class="form-group col-md-4">
    <h4>Last Name</h4>
   <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Profile Picture</h4>
         
   <input type="file" name="image" class="form-control">
   </div>
   
   </div>
   <div class="row">
   <div class="form-group col-md-4">
   <h4>Mobile</h4>
   <input type="number" name="mobile" value="<?php echo set_value('mobile'); ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Email</h4>
   <input type="mobile" name="email" value="<?php echo set_value('email'); ?>" class="form-control" >
   </div>
   
   
   </div>

   <div class="row">
    <div class="form-group col-md-4">
    <h4>Password</h4>
    <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" >
    
   </div>
   <div class="form-group col-md-4">
   <h4>Address</h4>
   
   <textarea name="address" value="<?php echo set_value('address'); ?>" class="form-control"></textarea>

   </div>
   
   
   </div>

   <div class="row">
    
   <div class="form-group col-md-6">
    <h4>Gender</h4>
    <input type="radio" name="gender" id="male" value="m">Male
    <input type="radio" name="gender" id="female" value="f">Female
   </div>
   
   
   </div>

   

   
   

   <div class="row">
   <div class="form-group col-md-4">
   <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
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