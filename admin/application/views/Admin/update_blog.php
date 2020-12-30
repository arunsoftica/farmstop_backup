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
    				<h4 class="card-title">Update Blog</h4>
    				<div class="add-items d-flex">
    					
    <form role="form" classs="w-100" id="update_blog" enctype="multipart/form-data" method="post">

    

	 <div class="row">
   <div class="form-group col-md-8">
   <h4>Blog Title</h4>
   <input type="hidden" name="blogid" value="<?php echo $blogs['id'] ?>">
   <input type="text" value="<?php echo $blogs['title'] ?>" name="pro_title" id="pro_title" value="" class="form-control" required>
   <p id="proslugmsg"></p>
   </div>
   </div>
   
   <div class="row">
    
   <div class="form-group col-md-4">
    <h4>Add Image</h4>
   <input type="file" name="image[]" >
   <img src="<?php echo base_url('uploads/blog_images/').$blogs['image'] ?>" height="150" width="150">
   <input type="hidden" name="image1" value="<?php echo $blogs['image'] ?>">
   

   </div>
   <div class="form-group col-md-4">
     <!--button type="button" id="add_image" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></button-->
   </div>
   
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Description</h4>
   <textarea name="description" class="ckeditor" ><?php echo $blogs['description'] ?></textarea>
   </div>
   
   
   </div>
   
   <div class="row" id="append_div">
   
   
   
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="meta_description" class="form-control" ><?php echo $blogs['meta_description'] ?></textarea>
   </div>
   
   
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keyword</h4>
   <textarea name="meta_keyword" class="form-control" ><?php echo $blogs['meta_keyword'] ?></textarea>
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
  
  $(document).on('submit','#update_blog',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_blog",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        alert(data);
        location.reload();
        /*$('#response_edit').html(data);
        $("#update_blog")[0].reset();
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');*/
    
     }  
     });  
 }));
  $(document).on('click', '#add_image', function (e) {
   $("#append_div").append('<div class="form-group col-md-12" ><input type="file" name="image[]"></div>');   

     
  });
  
});
</script>