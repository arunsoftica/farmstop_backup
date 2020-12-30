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
    				<h4 class="card-title">Update Product Variation</h4>
    				<div class="add-items d-flex">
    				    
    <form role="form" class="w-100" id="update_variation" enctype="multipart/form-data" method="post">

    <input type="hidden" name="variation_id" id="variation_id" value="<?php echo $variation['id'] ?>">

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>Product Category</h4>
   <select name="product" class="form-control" disabled>
    <option value="">Select</option>
     <option value="<?php echo $variation['product_id']; ?>" selected><?php echo $variation['pname']; ?></option>
 
   </select>
   </div>
   <div class="form-group col-md-4">
   <h4>Product Name</h4>
   <input type="text" name="attr_name" id="attr_name" value="<?php echo $variation['attribute_name']; ?>" class="form-control" required>
   <p id="attrslugmsg"></p>
   </div>
   
   
   </div>
   <div class="row">
     <div class="form-group col-md-8">
      <h4>Short Description</h4>
     <input type="text" name="short_desc" value="<?php echo $variation['short_description']; ?>" class="form-control" required>
     </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Description</h4>
   <textarea name="long_desc" class="ckeditor" required><?php echo $variation['long_description']; ?></textarea>
   </div>
   </div>
   <div id="variation_add">
       <div class="col-md-4">
     <div class="form-group col-md-4">
  
   <button type="button" id="add_variation" class="btn btn-primary"><i class="ion ion-md-add" aria-hidden="true"></i></button>
   
   </div>
   </div>
       <?php 
       $n = 0;
       foreach($exdetails as $exdetail){ ?>
    <div class="row cls<?php echo $n; ?>">
    <div class="form-group col-md-3">
    <h4>Product Attribute</h4>
    
    <select name="product_attr[]" class="form-control" >
      
     
     <option value="<?php echo $exdetail['pro_attr_id']; ?>" selected><?php echo $exdetail['pro_attr']; ?></option>
   
    </select>
    </div>
    <div class="form-group col-md-3">
    <h4>Product Attribute Value</h4>
    <input type="text" name="weight[]" value="<?php echo $exdetail['weight'] ?>" class="form-control" readonly>
   </div>
   <div class="form-group col-md-3">
    <h4>Regular Price</h4>
    <input type="number" name="regular_price[]" value="<?php echo $exdetail['regular_price'] ?>" class="form-control" required>
   </div>
   <div class="form-group col-md-3">
    <h4>Sale Price</h4>
    <input type="number" name="sale_price[]" value="<?php echo $exdetail['sale_price'] ?>" class="form-control">
    <button type="button" value="<?php echo $variation['id'].','.$exdetail['pro_attr_id'].','.$exdetail['weight'].','.$n ?>" class="btn btn-light del-detail"><i class="ion ion-md-close-circle
" aria-hidden="true"></i></button>
   </div>
   
   
   
   </div>
   <?php $n = $n + 1; }  ?>
   
   </div>
   <div class="row">
    
   <div class="form-group col-md-6">
    <h4>Add Images</h4>
   <input type="file" name="image[]" >
   

   </div>
   <div class="form-group col-md-6">
     <button type="button" id="add_image" class="btn btn-primary"><i class="ion ion-md-add" aria-hidden="true"></i></button>
   </div>
   
   </div>
   <div class="row" id="append_div">
   
   
   
   </div>
   <div class="row">
    <?php
    foreach($images as $img){ 
    if($img['fstatus'] != 1){
    ?>
     <div class="form-group col-md-4" id="<?php echo 'img'.$img['id'] ?>">
     <img src="<?php echo base_url('uploads/product_variation_images/'.$img['image']) ?>" height="200" width="200">
    
     <button type="button" class="btn btn-light delimg" value="<?php echo $img['id'] ?>"><i class="ion ion-md-close-circle
" aria-hidden="true"></i></button>
    </div>

   <?php } }
    ?>
    
     
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
    $(document).on('click', '.del-detail', function (e) {
        var vid = $(this).val();
        var str = vid.split(",");
        $.ajax({
            type: "GET",
            //url: base_url +"/Ajaxcontroller/get_class",
            url: "<?php echo base_url("Ajaxcontroller/deleteProductVariationDetail") ?>",
            data: {vid:vid},
            success: function (data) {
                alert(data);
                //location.reload();
                $('.cls'+str[3]).empty();
                //if not empty form will take all data
                $('#submit').click();
    
            }
        });
    });
  $(document).on('click', '.delimg', function (e) {
      
     var imgid = $(this).val();
    $.ajax({
        type: "GET",
        //url: base_url +"/Ajaxcontroller/get_class",
        url: "<?php echo base_url("Ajaxcontroller/deleteProductVariationImage") ?>",
        data: {imgid:imgid},
        success: function (data) {
            alert(data);
            $('#img'+imgid).remove();

        }
    });
  });
  $(document).on('click', '#add_image', function (e) {
   $("#append_div").append('<div class="form-group col-md-12" ><input type="file" name="image[]"></div>');   

     
  });

  $(document).on('blur','#attr_slug', function (e){
      
      var slug = $(this).val();
      $.ajax({
          url: "Ajaxcontroller/checkProductSlug",
          type: "GET",           
          data: {slug:slug},
          success: function(data){
             //alert(data);
             $('#attrslugmsg').html();
             $('#attrslugmsg').html(data);
           }
          });
  });
   $(document).on('blur','#attr_name', function (e){
      
      var slug = $(this).val();
      var id = $('#variation_id').val();
      $.ajax({
          url: "Ajaxcontroller/checkProductNameUpdateTime",
          type: "GET",           
          data: {slug:slug,id:id},
          success: function(data){
             //alert(data);
             $('#attrslugmsg').html();
             $('#attrslugmsg').html(data);
           }
          });
  });
  $(document).on('submit','#update_variation',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_product_variation",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        alert(data);
        location.reload();
        /*$('#response_edit').html(data);
        $("#update_variation")[0].reset();
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');*/
    
     }  
     });  
 }));
  $(document).on('click', '#add_variation', function (e) {
    var a = 1;
    $.ajax({
        type: "GET",
        url: "<?php echo base_url("Ajaxcontroller/getProductAttribute") ?>",
        data: {a:a},
        success: function (data) {
            var parseJson = jQuery.parseJSON(data);
            //alert(parseJson.product_attribute);
            html_content = '';
            $.each(parseJson.product_attribute , function(index , value){
               html_content += '<option value="'+value['id']+'">'+value['product_attr']+'</option>';
            });
            $("#variation_add").append('<div class="row"><div class="form-group col-md-3"><h4>Product Attribute</h4><select name="product_attr[]" class="form-control" ><option value="">Select</option>'+html_content+'</select></div><div class="form-group col-md-3"><h4>Product Attribute Value</h4><input type="text" name="weight[]" value="" class="form-control" ></div><div class="form-group col-md-3"><h4>Regular Price</h4><input type="number" name="regular_price[]" value="" class="form-control" ></div><div class="form-group col-md-3"><h4>Sale Price</h4><input type="number" name="sale_price[]" value="" class="form-control" ></div></div>');
        }
      });
   /**/   

     
  });
  
  
});
</script>