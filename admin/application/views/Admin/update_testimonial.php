<style>
  div.stars-admin {display:block;background:#e8effe4f;padding: 15px;}
  
input.star { display: none; }
label.star {float:right;padding: 6px;font-size: 25px;color: #444;transition: all .2s;}
input.star:checked ~ label.star:before {content: '⭐';color: #FD4;transition: all .25s;}
input.star-5:checked ~ label.star:before {color: #FE7;text-shadow:0 0 15px #575859c7;}
input.star-1:checked ~ label.star:before { color: #F62; }
label.star:hover { transform: rotate(-15deg) scale(1.3); }
label.star:before {content: '✰';font-family: FontAwesome;}
.card-inner{margin-left: 4rem;}
.rating-header{font-size: 20px;}
.rating-header small{font-size: 20px;}
.actions-rating ul{ text-align:center;padding:0px; margin:0px; list-style-type:none;}
.actions-rating ul li{ display:inline-block;}
.actions-rating ul li a {cursor:pointer;margin-top: 5px;margin-bottom: 5px;}
.actions-newreview {font-size: 18px;text-decoration: none;font-weight: 400;text-align: center;
width: 100%;line-height: 30px;background: 0 0;color: #000;border: 1px solid #333;padding: 5px 30px;border-radius: 1px;}
</style>
<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">Update Testimonial</h4>
    				<div class="add-items d-flex">
    				   
    <form role="form" class="w-100" id="update_testimonial" enctype="multipart/form-data" method="post">

   

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>User Name</h4>
   <input type="hidden" name="testimonial_id" value="<?php echo $testdetail[0]['id'] ?>">
   <input type="text" name="name" value="<?php echo $testdetail[0]['name'] ?>" class="form-control" required>
   </div>
   <div class="form-group col-md-4">
    <h4>Profile Picture</h4>
         
   <input type="file" name="image" class="form-control" >
   <img class="img-fluid" src="<?php echo base_url('uploads/testimonial/').$testdetail[0]['image'] ?>">
   </div>
   <input type="hidden" name="image1" value="<?php echo $testdetail[0]['image']  ?>">
   
   </div>
   
   <div class="row">
   <div class="form-group col-md-8">
   <h4>User Review</h4>
   <textarea name="review" class="form-control" required><?php echo $testdetail[0]['review'] ?></textarea>
   </div>
   <div class="row">
   <!-- rating section -->
   <div class="form-group col-md-12">
    <h4>User Rating</h4>
   <div class="stars-admin">
             
                 
    <span class="field-label-info"></span>
    <input type="hidden" name="rating" id="selected_rating"  value="<?php echo $testdetail[0]['rating'] ?>" >
    </label>
        <span class="bold rating-header">
        <span class="selected-rating"><?php echo $testdetail[0]['rating'] ?></span><small> / 5</small>
        </span>
      <input class="star star-5" id="star-5" data-attr="5" type="radio" name="star"/>
      <label class="star star-5" for="star-5"></label>
      <input class="star star-4" id="star-4" data-attr="4" type="radio" name="star"/>
      <label class="star star-4" for="star-4"></label>
      <input class="star star-3" id="star-3" data-attr="3" type="radio" name="star"/>
      <label class="star star-3" for="star-3"></label>
      <input class="star star-2" id="star-2" data-attr="2" type="radio" name="star"/>
      <label class="star star-2" for="star-2"></label>
      <input class="star star-1" id="star-1" data-attr="1" type="radio" name="star"/>
      <label class="star star-1" for="star-1"></label>
    
    
        </div>
        </div>


   <!-- rating section -->


   </div>
   
   
   </div>





   

   
   

   <div class="row">
   <div class="form-group col-md-4">
   <button type="submit" id="submit" name="submit" class="btn btn-primary">SUBMIT</button>
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
// rating javascript
$(document).ready(function(e) {
  $(document).on('click','.button-rating',function(){
  $('.stars-admin').slideToggle('slow');
  $('.product-description').hide();
  }); 
});
$(document).ready(function(e) {
  $(document).on('click','.des-product',function(){
  $('.product-description').slideToggle('slow');
  $('.stars-admin').hide();
  }); 
});
  
jQuery(document).ready(function($){
  $(".star").on('click',(function(e) {
  var previous_value = $("#selected_rating").val();
  var selected_value = $(this).attr("data-attr");
  $("#selected_rating").val(selected_value);
  $(".selected-rating").empty();
  $(".selected-rating").html(selected_value); 
  }));
});
jQuery(document).ready(function($){
  $(".star").on('click',(function(e) {
  var previous_value = $("#selected_rating1").val();
  var selected_value = $(this).attr("data-attr");
  $("#selected_rating1").val(selected_value);
  $(".selected-rating1").empty();
  $(".selected-rating1").html(selected_value);  
  }));
});

// rating javascript
$(document).on('submit','#update_testimonial',(function(e){
    $('#response_edit').html(" ");
  
    $("#submit").attr("disabled", true);
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_testimonial",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        alert(data);
        location.reload();
        /*$('#response_edit').html(data);
        $("#update_testimonial")[0].reset();
        $("#submit").attr("disabled", false);
        $("#submit").text('SUBMIT');*/
    
     }  
     });  
 }));
 
});
</script>