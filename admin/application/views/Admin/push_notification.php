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
    				<h4 class="card-title">Send Notification</h4>
    				<div class="add-items d-flex">
    					<form role="form" class="w-100" id="send_notification" enctype="multipart/form-data" method="post">
    
    
    
                        	 <div class="row">
                           <div class="form-group col-md-8">
                           <h4>Title</h4>
                           <input type="text" name="pro_title" id="pro_title" value="" class="form-control" required>
                           <p id="proslugmsg"></p>
                           </div>
                           </div>
                           
                           <div class="row">
                            
                           <div class="form-group col-md-4">
                            <h4>Add Image</h4>
                           <input type="file" name="image[]" required>
                           
                        
                           </div>
                           <div class="form-group col-md-4">
                             <!--button type="button" id="add_image" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></button-->
                           </div>
                           
                           </div>
                           <div class="row">
                           <div class="form-group col-md-8">
                            <h4>Message</h4>
                           <textarea name="description" class="form-control" ></textarea>
                           </div>
                           
                           
                           </div>
                           
                           <div class="row" id="append_div">
                           
                           
                           
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
  
  $(document).on('submit','#send_notification',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/send_push_notification",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#send_notification")[0].reset();
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));
  $(document).on('click', '#add_image', function (e) {
   $("#append_div").append('<div class="form-group col-md-12" ><input type="file" name="image[]"></div>');   

     
  });
  
});
</script>