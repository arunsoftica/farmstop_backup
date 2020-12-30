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
    				<h4 class="card-title">Update User Review</h4>
    				<div class="add-items d-flex">
    				    
    <form role="form" class="w-100" id="user_review" enctype="multipart/form-data" method="post">

    
   <input type="hidden" name="review_id" value="<?php echo $review['id'] ?>">
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Variation</h4>
   <input type="text" name="attr_name" value="<?php echo $review['aname'] ?>" class="form-control" readonly>
   </div>
   </div>
	 <div class="row">
   <div class="form-group col-md-8">
   <h4>User Name</h4>
   <input type="text" name="rname" value="<?php echo $review['name'] ?>" class="form-control" readonly>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>User Email</h4>
   <input type="text" name="remail" value="<?php echo $review['email'] ?>" class="form-control" readonly>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Rating</h4>
   <input type="text" name="rating" value="<?php echo $review['rating'] ?>" class="form-control" readonly>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Review Title</h4>
   <input type="text" name="title_review" value="<?php echo $review['title'] ?>" class="form-control" readonly>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Review</h4>
   
   <textarea name="review" class="form-control" readonly><?php echo $review['review'] ?></textarea>
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-8">
    <h4>Reply</h4>
   <textarea name="reply" class="ckeditor" ><?php echo $review['admin_reply'] ?></textarea>
   </div>
   
   
   </div>
   
   
   
   
   <div class="row">
   <div class="form-group col-md-4">
   <button type="submit" name="submit" id="submit" class="btn btn-primary">Update</button>
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
  $(document).on('submit','#user_review',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/update_review",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        
        $("#submit").removeClass("disabled");
        $("#submit").text('Update');
    
     }  
     });  
 }));
  $(document).on('click', '#add_image', function (e) {
   $("#append_div").append('<div class="form-group col-md-12" ><input type="file" name="image[]"></div>');   

     
  });
  $(document).on('click', '.delimg', function (e) {
      
     var imgid = $(this).val();
    $.ajax({
        type: "GET",
        //url: base_url +"/Ajaxcontroller/get_class",
        url: "<?php echo base_url("Ajaxcontroller/deleteProductImage") ?>",
        data: {imgid:imgid},
        success: function (data) {
            alert(data);
            $('#img'+imgid).remove();

        }
    });

     
  });
</script>