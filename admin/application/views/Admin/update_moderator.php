<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">Update Moderator</h4>
    				<div class="add-items d-flex">
    				    <form class="w-100" role="form" id="add_admin" enctype="multipart/form-data" method="post">

    <input type="hidden" name="admtype" value="3">

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>First Name</h4>
   <input type="hidden" name="getid" value="<?php echo $moderator['id'] ?>" />
   <input type="text" name="first_name" value="<?php echo $moderator['first_name'] ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Middle Name</h4>
   <input type="text" name="middle_name" value="<?php echo $moderator['middle_name'] ?>" class="form-control" >
   </div>
   
   </div>
   <div class="row">
   <div class="form-group col-md-4">
    <h4>Last Name</h4>
   <input type="text" name="last_name" value="<?php echo $moderator['last_name'] ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Profile Picture</h4>
         
   <input type="file" name="image" class="form-control">
   <img src="<?php echo base_url('uploads/moderator/'.$moderator['image']) ?>" height="100" width="100">
   <input type="hidden" name="image1" value="<?php echo $moderator['image'] ?>" />
   </div>
   
   </div>
   <div class="row">
   <div class="form-group col-md-4">
   <h4>Mobile</h4>
   <input type="number" name="mobile" value="<?php echo $moderator['mobile'] ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Email</h4>
   <input type="email" name="email" value="<?php echo $moderator['email'] ?>" class="form-control" >
   </div>
   
   
   </div>

   <div class="row">
    <div class="form-group col-md-4">
    <h4>Password</h4>
    <input type="password" name="password" value="" class="form-control" >
    
   </div>
   <div class="form-group col-md-4">
   <h4>Address</h4>
   
   <textarea name="address"  class="form-control"><?php echo $moderator['address'] ?></textarea>

   </div>
   
   
   </div>

   <div class="row">
    
   <div class="form-group col-md-6">
    <h4>Gender</h4>
    <input type="radio" name="gender" <?php if($moderator['gender'] == 'm') echo 'checked'; ?> id="male" value="m"> Male
    <input type="radio" name="gender" <?php if($moderator['gender'] == 'f') echo 'checked'; ?> id="female" value="f"> Female
   </div>
   
   
   </div>

   

   
   

   <div class="row">
   <div class="form-group col-md-4">
   <button type="submit" name="submit" id="submit" class="btn btn-primary">SUBMIT</button>
   <p id="response_edit"></p>
   </div>
   </div>
   
   </form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<script>
$(document).ready(function(){
  $(document).on('submit','#add_admin',(function(e){
    $('#response_edit').html(" ");
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/update_admin",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        //$("#add_admin")[0].reset();
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));
 
});
</script>