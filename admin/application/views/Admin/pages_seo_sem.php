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
    				<h4 class="card-title">Pages SEO SEM</h4>
    				<div class="add-items d-flex">
    				    <form class="w-100" role="form" id="pages_seo" enctype="multipart/form-data" method="post">
   <div class="row">
   <div class="form-group col-md-8">
   <center><h4>Home Page:</h4></center>
   </div>
   </div>
	 <div class="row">
   <div class="form-group col-md-8">
   <h4>Page Title</h4>
   <input type="text" name="home_title" value="<?php echo $seo['home_title'] ?>" class="form-control" >
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="home_desc" rows="4" class="form-control" ><?php echo $seo['home_desc'] ?></textarea>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keywords</h4>
   <textarea name="home_key" rows="4" class="form-control" ><?php echo $seo['home_key'] ?></textarea>
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-8">
   <center><h4>Who We Are:</h4></center>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Page Title</h4>
   <input type="text" name="who_title" value="<?php echo $seo['who_title'] ?>" class="form-control" >
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="who_desc" rows="4" class="form-control" ><?php echo $seo['who_desc'] ?></textarea>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keywords</h4>
   <textarea name="who_key" rows="4" class="form-control" ><?php echo $seo['who_key'] ?></textarea>
   </div>
   </div>


   <div class="row">
   <div class="form-group col-md-8">
   <center><h4>Shop Page:</h4></center>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Page Title</h4>
   <input type="text" name="shop_title" value="<?php echo $seo['shop_title'] ?>" class="form-control" >
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="shop_desc" rows="4" class="form-control" ><?php echo $seo['shop_desc'] ?></textarea>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keywords</h4>
   <textarea name="shop_key" rows="4" class="form-control" ><?php echo $seo['shop_key'] ?></textarea>
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-8">
   <center><h4>Locate a store:</h4></center>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Page Title</h4>
   <input type="text" name="locate_title" value="<?php echo $seo['locate_title'] ?>" class="form-control" >
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="locate_desc" rows="4" class="form-control" ><?php echo $seo['locate_desc'] ?></textarea>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keywords</h4>
   <textarea name="locate_key" rows="4" class="form-control" ><?php echo $seo['locate_key'] ?></textarea>
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-8">
   <center><h4>Contact Us:</h4></center>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Page Title</h4>
   <input type="text" name="contact_title" value="<?php echo $seo['contact_title'] ?>" class="form-control" >
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="contact_desc" rows="4" class="form-control" ><?php echo $seo['contact_desc'] ?></textarea>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keywords</h4>
   <textarea name="contact_key" rows="4" class="form-control" ><?php echo $seo['contact_key'] ?></textarea>
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-8">
   <center><h4>Career:</h4></center>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Page Title</h4>
   <input type="text" name="career_title" value="<?php echo $seo['career_title'] ?>" class="form-control" >
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="career_desc" rows="4" class="form-control" ><?php echo $seo['career_desc'] ?></textarea>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keywords</h4>
   <textarea name="career_key" rows="4" class="form-control" ><?php echo $seo['career_key'] ?></textarea>
   </div>
   </div>


   <div class="row">
   <div class="form-group col-md-8">
   <center><h4>Bulk Buy:</h4></center>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Page Title</h4>
   <input type="text" name="bulk_title" value="<?php echo $seo['bulk_title'] ?>" class="form-control" >
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="bulk_desc" rows="4" class="form-control" ><?php echo $seo['bulk_desc'] ?></textarea>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keywords</h4>
   <textarea name="bulk_key" rows="4" class="form-control" ><?php echo $seo['bulk_key'] ?></textarea>
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-8">
   <center><h4>Social Media Promoter:</h4></center>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Page Title</h4>
   <input type="text" name="social_title" value="<?php echo $seo['social_title'] ?>" class="form-control" >
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="social_desc" rows="4" class="form-control" ><?php echo $seo['social_desc'] ?></textarea>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keywords</h4>
   <textarea name="social_key" rows="4" class="form-control" ><?php echo $seo['social_key'] ?></textarea>
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-8">
   <center><h4>Investment Opportunities:</h4></center>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
   <h4>Page Title</h4>
   <input type="text" name="inves_title" value="<?php echo $seo['inves_title'] ?>" class="form-control" >
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Description</h4>
   <textarea name="inves_desc" rows="4" class="form-control" ><?php echo $seo['inves_desc'] ?></textarea>
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-8">
    <h4>Meta Keywords</h4>
   <textarea name="inves_key" rows="4" class="form-control" ><?php echo $seo['inves_key'] ?></textarea>
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
  $(document).on('submit','#pages_seo',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_pages_seo",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        //$("#pages_seo")[0].reset();
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));
 
});
  
</script>