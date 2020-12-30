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
    				<h4 class="card-title">Add Featured Product</h4>
    				<div class="add-items d-flex">
    				   <form class="w-100" role="form" id="featured_product" enctype="multipart/form-data" method="post">

    

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>Select Product</h4>
   <select name="product" id="product" class="form-control" required>
    <option value="">Select</option>
    <?php
    foreach($products as $prod){ ?>
     <option value="<?php echo $prod['id']; ?>"><?php echo $prod['title']; ?></option>
   <?php }

    ?>
   </select>
   </div>
   <div class="form-group col-md-4">
   <h4>Product Attribute</h4>
   <select name="product_attr" id="product_attr" class="form-control" required>
    <option value="">Select</option>
    
   </select>
   </div>
   <div class="form-group col-md-4">
   <h4>Product Type</h4>
   <select name="protypes" id="protypes" class="form-control" required>
    <option value="">Select</option>
    <option value="1">Featured Product</option>
    <option value="2">New Product</option>
   </select>
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
  $(document).on('change', '#product', function (e) {
        //alert('hello');
            var proid = $(this).val();
            
            $.ajax({
                type: "GET",
                //url: base_url +"/Ajaxcontroller/get_class",
                url: "<?php echo base_url("Ajaxcontroller/get_product_attribute") ?>",
                data: {proid:proid},
                success: function (data) {
                    //alert(data);
                    //$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'your stylesheet url') );
                    
                    $('#product_attr').empty();
                    $('#product_attr').html();

                    $('#product_attr').html(data);

                }
            });
        });
  
  $(document).on('submit','#featured_product',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_featured_product",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#featured_product")[0].reset();
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));
 
});
  
</script>