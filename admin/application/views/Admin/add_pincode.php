
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
    				<h4 class="card-title">Add Pincode</h4>
    				<div class="add-items d-flex">
    				    
    <form role="form" class="w-100" id="add_pincode" enctype="multipart/form-data" method="post">

   

	 <div class="row">
	     <div class="form-group col-md-4">
    <h4>State</h4>
         
   <input type="text" name="state" value="" class="form-control" required>
   </div>
   <div class="form-group col-md-4">
       
   <h4>Area Name</h4>
   <input type="text" name="name" value="" class="form-control" required>
   </div>
   <div class="form-group col-md-4">
    <h4>Area Pincode</h4>
         
   <input type="text" name="pin" value="" class="form-control" required>
   </div>
   
   </div>
   
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Shipping Cost</h4>
   <input type="text" name="shipping" value="" class="form-control" required>
   </div>
   
   
   
   </div>

   <div class="row">
   <div class="form-group col-md-4">
   <button type="submit" id="submit" name="submit" class="btn btn-primary">SUBMIT</button>
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
$(document).on('submit','#add_pincode',(function(e){
    $('#response_edit').html(" ");
  
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_pincode",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#add_pincode")[0].reset();
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));
 
});
</script>