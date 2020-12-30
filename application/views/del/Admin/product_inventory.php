<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Product Inventory</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="product_inventory" enctype="multipart/form-data" method="post">

    

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>Select Product</h4>
   <select name="product" id="product" class="form-control">
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
   <select name="product_attr" id="product_attr" class="form-control">
    <option value="">Select</option>
    
   </select>
   </div>
   
   
   </div>
   <div class="row">
   <div class="form-group col-md-4">
    <h4>Available Product</h4>
    <input type="number" name="available_pro" id="available_pro" value="" class="form-control" readonly>
   </div>
   <div class="form-group col-md-4">
    <h4>Add No. of Product</h4>
    <input type="number" name="product_no" value="" class="form-control" >
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
  $(document).on('change', '#product_attr', function (e) {
        //alert('hello');
            var attrid = $(this).val();
            
            $.ajax({
                type: "GET",
                //url: base_url +"/Ajaxcontroller/get_class",
                url: "<?php echo base_url("Ajaxcontroller/get_available_product") ?>",
                data: {attrid:attrid},
                success: function (data) {
                    
                    $('#available_pro').val(data);

                }
            });
        });
  $(document).on('submit','#product_inventory',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_product_inventory",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#product_inventory")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));
  
</script>