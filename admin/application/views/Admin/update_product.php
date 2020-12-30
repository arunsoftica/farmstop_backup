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
    				<h4 class="card-title">Update Product</h4>
    				<div class="add-items d-flex">
    				    
    <form role="form" class="w-100" id="update_product" enctype="multipart/form-data" method="post">

    
   <input type="hidden" name="pro_id" id="pro_id" value="<?php echo $products['id'] ?>">
	 <div class="row">
   <div class="form-group col-md-8">
   <h4>Product Title</h4>
   <input type="text" name="pro_title" id="pro_title" value="<?php echo $products['title'] ?>" class="form-control" >
   <p id="proslugmsg"></p>
   </div>
   
   
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Description</h4>
   <textarea name="description" class="ckeditor" ><?php echo $products['description'] ?></textarea>
   </div>
   
   
   </div>
   <div class="row">
    
   <div class="form-group col-md-4">
    <h4>Add Images</h4>
   <input type="file" name="image[]">
   <input type="hidden" name="image1" value="<?php echo $images[0]['image']; ?>" >

   </div>
   <div class="row">
    
     <div class="form-group col-md-4" id="<?php echo 'img'.$images[0]['id'] ?>">
     <img src="<?php echo base_url('uploads/product_images/'.$images[0]['image']) ?>" height="200" width="200"><!--<button type="button" class="btn btn-default delimg" value="<?php echo $img['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>-->
    </div>
    
     
   </div>
   <div class="form-group col-md-4">
     <!--<button type="button" id="add_image" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></button>-->
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
      <input type="text" name="page_title" value="<?php echo $products['page_title'] ?>" class="form-control">
    </div>
    <div class="form-group col-md-8">
      <h4>META Description</h4>
      <textarea name="meta_desc" rows="5" class="form-control"><?php echo $products['meta_desc'] ?></textarea>
    </div>
    <div class="form-group col-md-8">
      <h4>META Keywords</h4>
      <textarea name="meta_key" rows="5" class="form-control"><?php echo $products['meta_key'] ?></textarea>
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
$(document).on('blur','#pro_title', function (e){
      
      var slug = $(this).val();
      var id = $('#pro_id').val();
      $.ajax({
          url: "Ajaxcontroller/checkProductCategoryTitleUpdateTime",
          type: "GET",           
          data: {slug:slug,id:id},
          success: function(data){
             //alert(data);
             $('#proslugmsg').html();
             $('#proslugmsg').html(data);
           }
          });
  });
  $(document).on('submit','#update_product',(function(e){
    $('#response_edit').html(" ");
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
        
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');
    
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