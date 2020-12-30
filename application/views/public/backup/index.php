

<?php include'slider.php' ?>
<div class="container">
  <div class="mt-5">
      <h2 align="center">Featured Products</h2>
    </div>
  <div class="row mt-5 mb-5">
      
      
      <?php
$ct = 0;
foreach($fproduct as $var){ ?>
      <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 p-1" id="product-one">
              <div class="products">
                <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">
								<span class="wish-icon">
								    <i class="
								    <?php
								    if(isset($_SESSION['login_id'])){
								      $res = $model2->getWishlistStatus($var['product'],$_SESSION['login_id']);
								      if($res != FALSE){
								          echo 'fa fa-heart';
								      }else{
								          echo 'fa fa-heart-o';
								      }
								    }
								    else{
								        echo 'fa fa-heart-o';
								    }
								    ?>
								    
								    "></i><input type="hidden" name="wishlist" class="wlist" id="wlist" value="<?php echo $var['product']; ?>"></span>
							<a class="btn-black-color" href="<?php echo base_url('product/'.$var['slug']) ?>">	    
                <div class="img-box">
                  <img src="<?php echo base_url('teao/uploads/product_images/'.$var['fimage']) ?>" class="img-responsive img-fluid" alt="">                  
                </div>
                <div class="thumb-content">
                    
                  <h4><?php echo $var['attribute'] ?></h4>
                  <?php $review = $model2->getApprovedUserReviews($var['product']);  ?>
                  <div class="star-rating">
                    <ul class="list-inline">
                        <?php
                                  if($review != FALSE){
                                    $rar = array();
                                    $car = 0;
                                   foreach($review as $rew){
                                      $rar[] = $rew['rating'];
                                      $car = $car + 1;
                                   }
                                   $oar = round(array_sum($rar)/$car);
                                     
                                       $rc = $oar;
                                       $mi = 5-$rc;
                                        for($m=0;$m<$rc;$m++){ ?>
                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                            
                                      <?php  }
                                        for($n=0;$n<$mi;$n++){ ?>
                                            
                                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                            
                                      <?php  } } else{ ?>
                                          
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                   <?php   }
                                   ?>
                      
                      
                      
                    </ul>
                  </div>
                  <?php $mPrice = $model2->getMinMaxPrice($var['product']); ?>
									<p class="item-price"><strike>Rs.<?php echo $mPrice['maxsp']  ?></strike> <b>Rs.<?php echo $mPrice['minsp']  ?></b></p></a>
                  <button type="button" class="btn btn-primary btn-cart" data-toggle="modal" data-target="#myModal<?php echo $var['product']; ?>">Add to Cart</button>
                </div>            
              </div>
            </div>
            <!-- The Modal -->
<div class="modal" id="myModal<?php echo $var['product']; ?>">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $var['attribute'] ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form class="add_cart" did="<?php echo $ct; ?>" method="post">
          <input type="hidden" name="attribute_id" value="<?php echo $var['product'] ?>">
            <div class="row m-0">
                <div class="col-sm-5 col-4">
                    <div class="p-1 mt-4">
                    <img src="<?php echo base_url('teao/uploads/product_images/'.$var['fimage']) ?>" class="img-responsive img-fluid" alt="">
                    </div>
                </div>
                <div class="col-sm-7 col-8">
                    <div class="p-3">
                        <div class="padding-heading-top">
           		        <h4><?php echo $var['attribute'] ?></h4>
           		   </div>
           		        <div class=" mb-2 mt-2">
           		            <?php $vardetail = $model2->getVariationDetail($var['product']); ?>
           		        <p>Weight:</p>
                                    <p>
                                    	<select name="aprice" class="aprice" required>
                                    		<option value="">Select</option>
                                    		<?php
                                            foreach($vardetail as $vdet){ 
                                    
                                             echo '<option value="'.$vdet['regular_price'].'-'.$vdet['sale_price'].'-'.$vdet['weight'].'-'.$vdet['id'].'">'.$vdet['weight'].' Rs.'.$vdet['sale_price'].'</option>';
                                            }
                                    
                                    		?>
                                    	</select>
                                    </p>
           		   </div>
           		        <div class="product_stock mb-2 mt-2">
                                        <div class="quantity1 quantity">
                        <h6 class="title-attr"><small>Quantity</small></h6>                    
                        <div>
                            <div class="btn-minus" value="1"><span class="fa fa-minus"></span></div>
                            <input name="nitem" id="nitem" value="1" />
                            <div class="btn-plus" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>    
                                    </div>
                        <div class="mb-2 mt-4">
                        
                        <button type="submit" id="submit" class="btn btn-primary  btn-cart">Add to Cart</button>
                        
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <p id="response_edit"></p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      </div>

    </div>
  </div>
</div>
<!-- The Modal -->
            <?php $ct = $ct + 1; } ?>
            
  </div>
</div>
<section class="bg_color1" id="scroll-div">
  <div class="shape-2">
      <div class="container-fluid">
          <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
             <div class="padding-heading-top">
              <h2 align="center">Who we are</h2>
        </div>
          </div>
        </div>
          <div class="row m-0">
        <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 col-12" id="who-we-are">
            <div class="padding-heading-top">
              <div class="section-title">
                    <h2>Easy, Fast, Accurrate!</h2>
                    <p>simply dummy text of the printing!</p>
                </div>
                <div class="section-description">
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12" id="who-we-are1">
          <div class="bg-white-gray padding-heading-top">
              <div class="p-5 video-list-thumbs">
                  <a data-toggle="modal" data-target="#myModal" title="">
                        <img src="assets/img/blog.jpg" alt="" class="img-fluid" />
                        <span class="fa fa-play-circle"></span>
                    </a>
      </div>
      </div>
        </div>
        </div>
        </div>
    </div>
</section>

<section class="bg_color">
  <div class="row bg-white">
      <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12 p-0" id="Recipies">
          <div class="bg-white1 padding-heading-top">
              <h2 align="center">Recipies</h2>
              <div class="p-5">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" height="50" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen>
                </iframe>
            </div>
      </div>
      </div>
        </div>
        <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 col-12 p-0" id="What-they-say">
            <div class="bg-white padding-heading-top">
              <h2 align="center">What they say</h2>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="testimonial-indicators carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>   
                <div class="carousel-inner testimonial-new">    
                    <div class="carousel-inner testimonial-new"> 
                    <?php
                    $t = 0;
                    foreach($testimonial as $test){
                    
                    ?>
                    <div class="
                    <?php 
                    if($t == 0){
                        echo 'item carousel-item active';
                    }else{
                        echo 'item carousel-item';
                    }
                    ?>
                    
                    ">
                    
                        <div class="img-box">
                            <img src="<?php echo base_url('teao/uploads/testimonial/'.$test['image']) ?>" alt="">
                        </div>
                        
                        <p class="testimonial"><?php echo $test['review'] ?></p>
                        <p class="overview"><b><?php echo $test['name'] ?></b></p>
                        <div class="star-rating">
										<ul class="list-inline">
									    <?php
									    
                                        for($m=0;$m<$test['rating'];$m++){ ?>
                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                            
                                      <?php  }
                                        for($n=0;$n<5-$test['rating'];$n++){ ?>
                                            
                                            <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                            
                                      <?php  } 
                                   ?>
											
											
											
										</ul>
									</div>
                        
                        </div>
                        <?php $t = $t + 1; } ?>
                    </div>
                        
                </div>
                <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
</div>
            </div>
        </div>
    </div>
</section>
<?php include'social-media-feeds.php' ?>
<?php include'partners-logo.php' ?>  
<div class="modal animated bounce" id="myModal">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Our Video</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <video controls>
                      <source src="mov_bbb.mp4" type="video/mp4">
                    </video>
                            </div>
                            <div class="modal-footer">
                            </div>
                            
                          </div>
                        </div>
                    </div>
                    
<script>
$(document).ready(function(){
    $(document).on('click', '.fa-heart', function (e) {
        //alert($("#wlist").val());
        var v = $("#wlist").val();
        var u = $("#userid").val();
        
        if(u != ''){
            
            $.ajax({
                type: "GET",
                url: "<?php echo base_url("Ajaxcontroller/add_to_wishlist") ?>",
                data: {v:v,u:u},
                success: function (data) {
                   alert(data);
                    

                }
            });
            
        }else{
            alert('Please login to add product in your wishlist');
        }
            
            
        });
        $(document).on('click', '.fa-heart-o', function (e) {
        //alert($("#wlist").val());
        var v = $("#wlist").val();
        var u = $("#userid").val();
        
        if(u != ''){
            
            $.ajax({
                type: "GET",
                url: "<?php echo base_url("Ajaxcontroller/remove_from_wishlist") ?>",
                data: {v:v,u:u},
                success: function (data) {
                   alert(data);
                    

                }
            });
            
        }else{
            alert('Please login to add product in your wishlist');
        }
            
            
        });
    $(document).on('change', '.aprice', function (e) {
        //alert($(this).val());
        var str = $(this).val();
        var res = str.split("-");
        //alert(res[0]);
        
        $(this).parent().siblings('.rpsp').html();
        $(this).parent().siblings('.rpsp').html('Sale Price: '+res[1]);
            
        });
        
    $(document).on('submit','.add_cart',(function(e){
        var qq = $(this).attr('did');
        $('#response_edit').html(" ");
        $("#submit").addClass('disabled');
        $("#submit").text('please wait....'); 
        e.preventDefault();
          $.ajax({
          url: "<?php echo base_url('Ajaxcontroller/add_item_to_cart') ?>",
          type: "POST",        
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,  
          success: function(data){
            
            //$('#response_edit').html(data);
            //alert(qq);
            $(".add_cart")[qq].reset();
            //$("#submit").removeClass("disabled");
            //$("#submit").text('Add to Cart');
            alert('this item added in your cart successfully..');
            //location.reload();
            var cart = 1;
                                    
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                data: {cart:cart},
                success: function (data) {
                    
                    $('#items').empty();
                    $('#items').append(data);
                }
            });
    
         }  
         });  
    }));
    
    
});
</script>
