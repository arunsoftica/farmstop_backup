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
    				<h4 class="card-title">Add Coupon</h4>
    				<div class="add-items d-flex">
    				    <form class="w-100" role="form" id="add_coupon" enctype="multipart/form-data" method="post">
                    	 <div class="row">
                            <div class="form-group col-md-8">
                       <h4>Coupon Code</h4>
                       <input type="text" name="code" id="code" value="" class="form-control" required>
                       </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                       <h4>Code Type</h4>
                       <select name="code_type" class="form-control">
                           <option value="p">Percent</option>
                           <option value="a">Amount</option>
                       </select>
                       </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                       <h4>Code Value</h4>
                       <input type="number" name="code_value" id="code_value" value="" class="form-control" required>
                       </div>
                        </div>
                       <div class="row">
                       <div class="form-group col-md-8">
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
  
  $(document).on('submit','#add_coupon',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_coupon",
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