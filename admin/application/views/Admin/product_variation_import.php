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
    				<h4 class="card-title">Product Variation Import</h4>
    				<div class="add-items d-flex">
            
    <form role="form" id="product_variation_import" enctype="multipart/form-data" method="post">

    <div class="col-md-12">
        <a href='<?php echo base_url('uploads/admin/add_product_new.csv') ?>'>Demo Import File</a>
    </div>

	 <div class="row">

   <div class="form-group col-md-12">
   <h4>Import File</h4>
   <input type="file" name="product_file" id="product_file" value="" class="form-control" required>
   <p id="attrslugmsg"></p>
   </div>
   
   
   </div>
  
   
   
   
   
   

   <div class="row">
   <div class="form-group col-md-12">
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


  $(document).on('submit','#product_variation_import',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);

    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_product_variation_import",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#product_variation")[0].reset();
       location.reload();
    
     }  
     });  
 }));
 
});
</script>