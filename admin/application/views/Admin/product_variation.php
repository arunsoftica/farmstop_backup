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
    				<h4 class="card-title">Product Variation</h4>
    				<div class="add-items d-flex">
    				    <form role="form" class="w-100" id="product_variation" enctype="multipart/form-data" method="post">

    

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>Product Category</h4>
   <select name="product" class="form-control" required>
    <option value="">Select</option>
    <?php
    foreach($products as $prod){ ?>
     <option value="<?php echo $prod['id']; ?>"><?php echo $prod['title']; ?></option>
   <?php }

    ?>
   </select>
   </div>
   <div class="form-group col-md-4">
   <h4>Product Name</h4>
   <input type="text" name="attr_name" id="attr_name" value="" class="form-control" required>
   <p id="attrslugmsg"></p>
   </div>
   
   
   </div>
   <div class="row">
     <div class="col-md-8">
      <h4>Short Description</h4>
     <input type="text" name="short_desc" value="" class="form-control" required>
     </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Description</h4>
   <textarea name="long_desc" class="ckeditor" required></textarea>
   </div>
   </div>
   <div id="variation_add">
    <div class="row">
    <div class="form-group col-md-3">
    <h4>Product Attribute</h4>
    
    <select name="product_attr[]" class="form-control" required>
     <option value="">Select</option> 
     <?php
    foreach($attributes as $attribute){ ?>
     <option value="<?php echo $attribute['id']; ?>"><?php echo $attribute['product_attr']; ?></option>
   <?php }

    ?>
    </select>
    </div>
    <div class="form-group col-md-3">
    <h4>Product Attribute Value</h4>
    <input type="text" name="weight[]" value="" class="form-control" required>
   </div>
   <div class="form-group col-md-3">
    <h4>Regular Price</h4>
    <input type="number" name="regular_price[]" value="" class="form-control" required>
   </div>
   <div class="form-group col-md-3">
    <h4>Sale Price</h4>
    <input type="number" name="sale_price[]" value="" class="form-control">
   </div>
   
   
   
   </div>
   <div class="row">
     <div class="form-group col-md-4">
  
   <button type="button" id="add_variation" class="btn btn-primary"><i class="ion ion-md-add" aria-hidden="true"></i></button>
   </div>
   </div>
   </div>
   <div class="row">
    
   <div class="form-group col-md-6">
    <h4>Add Images(First image is featured image)</h4>
   <input type="file" class="image" name="image[]" required>
   

   </div>
   <div class="form-group col-md-6">
     <button type="button" id="add_image" class="btn btn-primary"><i class="ion ion-md-add" aria-hidden="true"></i></button>
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
     $(document).on('change','.image', function (e){
    /*$('.image').change(function(){*/
        //alert('hello');
            var str = $(this).val();
            var v  = str.split(".");
            if(v.length > 2){
                alert('ERROR: Invalid image name.please select another image.');
                $("#submit").attr("disabled", true);
            }else{
                $("#submit").attr("disabled", false);
            }
                
        });
  $(document).on('click', '#add_image', function (e) {
   $("#append_div").append('<div class="form-group col-md-12" ><input type="file" class="image" name="image[]"></div>');   

     
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
      $.ajax({
          url: "Ajaxcontroller/checkProductName",
          type: "GET",           
          data: {slug:slug},
          success: function(data){
             //alert(data);
             $('#attrslugmsg').html();
             $('#attrslugmsg').html(data);
           }
          });
  });
  $(document).on('submit','#product_variation',(function(e){
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
        //alert(data);
        $('#response_edit').html(data);
        $("#product_variation")[0].reset();
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');
    
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
            $("#variation_add").append('<div class="row"><div class="form-group col-md-3"><h4>Product Attribute</h4><select name="product_attr[]" class="form-control" ><option value="">Select</option>'+html_content+'</select></div><div class="form-group col-md-3"><h4>Product Attribute Value</h4><input type="text" name="weight[]" value="" class="form-control" ></div><div class="form-group col-md-3"><h4>Regular Price</h4><input type="number" name="regular_price[]" value="" class="form-control"></div><div class="form-group col-md-3"><h4>Sale Price</h4><input type="number" name="sale_price[]" value="" class="form-control" ></div></div>');
        }
      });
   /**/   

     
  });
  
});
</script>