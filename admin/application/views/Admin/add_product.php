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
    				<h4 class="card-title">Add Product</h4>
    				<div class="add-items d-flex">
    				    <form class="w-100" role="form" id="add_product" enctype="multipart/form-data" method="post">
	 <div class="row">
   <div class="form-group col-md-8">
   <h4>Product Title</h4>
   <input type="text" name="pro_title" id="pro_title" value="" class="form-control" required>
   <p id="proslugmsg"></p>
   </div>
   </div>
   <!--<div class="row">
   <div class="form-group col-md-8">
   <h4>Product Slug</h4>
   <input type="text" name="pro_slug" id="pro_slug" value="" class="form-control" required>
   
   </div>
   </div>-->
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Description</h4>
   <textarea name="description" class="ckeditor" ></textarea>
   </div>
   
   
   </div>
   <div class="row">
    
   <div class="form-group col-md-4">
    <h4>Add Images</h4>
   <input type="file" name="image[]" class="image" required>
   

   </div>
   <div class="form-group col-md-4">
     <!--button type="button" id="add_image" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></button-->
   </div>
   
   </div>
   <div class="row" id="append_div">
   
   
   
   </div>
   <div class="row">
    <div class="form-group col-md-8">
      <h4>For SEO:</h4>
    </div>
    <div class="form-group col-md-8">
      <h4>Page Title</h4>
      <input type="text" name="page_title" class="form-control">
    </div>
    <div class="form-group col-md-8">
      <h4>META Description</h4>
      <textarea name="meta_desc" rows="5" class="form-control"></textarea>
    </div>
    <div class="form-group col-md-8">
      <h4>META Keywords</h4>
      <textarea name="meta_key" rows="5" class="form-control"></textarea>
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
   
        $('input[type="file"]').change(function(){
            var str = $(this).val();
            var v  = str.split(".");
            if(v.length > 2){
                alert('Invalid Image');
                $("#submit").attr("disabled", true);
            }else{
                $("#submit").attr("disabled", false);
            }
                
        });
    
  $(document).on('blur','#pro_slug', function (e){
      
      var slug = $(this).val();
      $.ajax({
          url: "Ajaxcontroller/checkProductCategorySlug",
          type: "GET",           
          data: {slug:slug},
          success: function(data){
             //alert(data);
             $('#proslugmsg').html();
             $('#proslugmsg').html(data);
           }
          });
  });
  $(document).on('blur','#pro_title', function (e){
      
      var slug = $(this).val();
      $.ajax({
          url: "Ajaxcontroller/checkProductCategoryTitle",
          type: "GET",           
          data: {slug:slug},
          success: function(data){
             //alert(data);
             $('#proslugmsg').html();
             $('#proslugmsg').html(data);
           }
          });
  });
  $(document).on('submit','#add_product',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_product",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#add_product")[0].reset();
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