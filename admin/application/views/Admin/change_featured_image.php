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
    				<h4 class="card-title">Change Featured Image</h4>
    				<div class="add-items d-flex">
    				    <form class="w-100" role="form" id="change_featured" enctype="multipart/form-data" method="post">
                           <input type="hidden" name="pro_id" value="<?php echo $fimage['id'] ?>">
                           
                           <div class="row">
                            
                           <div class="form-group col-md-4">
                            <h4>Add Images</h4>
                           <input type="file" name="image[]">
                           <input type="hidden" name="image1" value="<?php echo $fimage['fimg']; ?>" >
                        
                           </div>
                           <div class="row">
                            
                             <div class="form-group col-md-4" id="<?php echo 'img'.$fimage['id'] ?>">
                             <img src="<?php echo base_url('uploads/product_variation_images/'.$fimage['fimg']) ?>" height="200" width="200">
                            </div>
                            
                             
                           </div>
                           <div class="form-group col-md-4">
                             <!--<button type="button" id="add_image" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></button>-->
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
  $(document).on('submit','#change_featured',(function(e){
    $('#response_edit').html(" ");
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/change_featured_image",
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