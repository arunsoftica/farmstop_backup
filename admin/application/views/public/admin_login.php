<?php include_once('public_header.php') ?>

<div class="container">
<?php echo validation_errors(); ?>
 <form class="form-horizontal" role="form" id="form_login" method="post" action="<?php echo base_url()?>login/admin_login">  
<?php  //echo form_open('login/admin_login',['class'=>'form-horizontal']); ?>
  <fieldset>
    <legend>Admin Login</legend>
    
     <?php if($error=$this->session->flashdata('login_failed')): ?>
    <div class="row">
    <div class="col-lg-6">
    <div class="alert alert-dismissible alert-danger">
  
      <?php echo $error; ?>
    </div>
    </div>
    </div>
  <?php endif; ?>


    <div class="row">
    <div class="col-lg-6">
    <label for="inputEmail" class="col-lg-3 control-label">User Name</label>
      <div class="col-lg-9">
      <?php echo form_input(['name'=>'username','placeholder'=>'username','class'=>'form-control','value'=>set_value('username')]); ?>
      <?php //echo form_error('username','<div class="text-danger">', '</div>'); ?>
           <?php echo form_error('username'); ?>
 
       <!-- <input type="text" class="form-control" id="inputEmail" placeholder="username">-->
      </div>
    </div>
    </div>
    <div class="row">
    <div class="col-lg-6">
    <label for="inputPassword" class="col-lg-3 control-label">Password</label>
      <div class="col-lg-9">
            <?php echo form_password(['name'=>'password','placeholder'=>'password','class'=>'form-control']); ?>

       <!-- <input type="password" class="form-control" id="inputPassword" placeholder="password">-->
       
      </div>
    </div>
    </div>
      
   
    <br>
   
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <?php echo form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-primary']); ?>
        <!-- <button type="submit" class="btn btn-primary">Submit</button>-->
      </div>
    </div>
  </fieldset>
</form>

	

</div>







<?php include_once('public_footer.php') ?>