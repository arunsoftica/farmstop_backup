<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Product Variation</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="product_variation" enctype="multipart/form-data" method="post">

    

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>Select Product</h4>
   <select name="product" class="form-control">
    <option value="">Select</option>
    <?php
    foreach($products as $prod){ ?>
     <option value="<?php echo $prod['id']; ?>"><?php echo $prod['title']; ?></option>
   <?php }

    ?>
   </select>
   </div>
   <div class="form-group col-md-4">
   <h4>Attribute Name</h4>
   <input type="text" name="attr_name" value="" class="form-control" >
   </div>
   
   
   </div>
   <div class="row">
   <div class="form-group col-md-4">
    <h4>Regular Price</h4>
    <input type="number" name="regular_price" value="" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Sale Price</h4>
    <input type="number" name="sale_price" value="" class="form-control" >
   </div>
   
   </div>
   <div class="row">
   <div class="form-group col-md-4">
    <h4>Weight</h4>
    <input type="text" name="weight" value="" class="form-control" >
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

</div>
</div>
<script>
  $(document).on('submit','#product_variation',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").addClass('disabled');
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
        $("#submit").removeClass("disabled");
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));
  
</script>