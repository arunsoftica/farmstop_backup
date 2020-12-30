<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			     <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">Add Apartment</h4>
    				<div class="add-items d-flex">
    				    
    <form class="w-100" role="form" id="add_apartment" enctype="multipart/form-data" method="post">

    <div class="row">
   <div class="form-group col-md-8">
   <h4>Zone</h4>
   <select name="zone" class="form-control" required>
       <option value="">Select</option>
       <?php foreach($zones as $zone){ ?>
       <option value="<?php echo $zone['id'] ?>" ><?php echo $zone['zone_name'] ?></option>
       <?php } ?>
   </select>
   
   </div>
   </div>
   

	 <div class="row">
   <div class="form-group col-md-8">
   <h4>Apartment Name</h4>
   <input type="text" name="apartment" id="apartment" value="" class="form-control" required>
   
   </div>
   </div>
   
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Location</h4>
   <input type="text" name="location" id="location" value="" class="form-control" required>
   
   </div>
   </div>
   
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Select Delivery Days</h4>
   <input type="checkbox" name="ddays[]" value="1" > Sunday <br>
   <input type="checkbox" name="ddays[]" value="2" > Monday <br>
   <input type="checkbox" name="ddays[]" value="3" > Tuesday <br>
   <input type="checkbox" name="ddays[]" value="4" > Wednesday <br>
   <input type="checkbox" name="ddays[]" value="5" > Thursday <br>
   <input type="checkbox" name="ddays[]" value="6" > Friday <br>
   <input type="checkbox" name="ddays[]" value="7" > Saturday <br>
   
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
  
  $(document).on('submit','#add_apartment',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_apartment",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        alert(data);
        location.reload();
        
    
     }  
     });  
 }));
  
  
});
</script>