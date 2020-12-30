<section class="bg-light">
<div class="container">
	<div class="row pt-3 p-media">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
                <div class="row d-block d-sm-none search-box-div">
        		<div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-custom-blue dropdown-toggle search-click rounded-0">
                    	<span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu search-menu" role="menu">
                      <li><a class="dropdown-item" href="#contains">Contains</a></li>
                      <li><a class="dropdown-item" href="#its_equal">It's equal</a></li>
                      <li><a class="dropdown-item" href="#greather_than">Greather than </a></li>
                      <li><a class="dropdown-item" href="#less_than">Less than </a></li>
                     
                    </ul>
                </div>
                <input type="hidden" name="search_param rounded-0" value="all" id="search_param">         
                <input type="text" class="form-control rounded-0" name="x" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-custom-blue rounded-0" type="button"><span class="fa fa-search"></span></button>
                </span>
            </div>
            	</div>
        	  <div class="row d-none d-sm-block">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1 p-media">
                	<div class="accordion-side">
                 <div class="accordion mb-2" id="accordionExample">
                    <div class="card">
                        <div class="cat-list card-header">
                            <h2 class="mb-0"><span class="cat-span"> Categories</span></h2>
                        </div>
                    </div>
                    <!-- card -->
                    <?php
                    foreach($products as $product){
                    ?>
                    
                    <div class="card">
                        <div class="card-header" id="headingTwo<?php echo $product['id'] ?>">
                            <h2 class="mb-0">									
                                <!--a data-toggle="collapse" data-target="#collapseTwo<?php //echo $product['id'] ?>" aria-expanded="false" aria-controls="collapseTwo" -->
                                    <a href="<?php echo base_url('shop/?c='.$product['slug']) ?>" >
                                    <span><?php echo $product['title'] ?></span>
                                    <!--i class="fa fa-chevron-down toggle rotate"></i-->
                                </a>
                            </h2>
                        </div>
                        <?php 
                        $pro = $model2->getProductByProductCategory($product['id']); 
                        if($pro != FALSE){
                        ?>
                        <!--div id="collapseTwo<?php echo $product['id'] ?>" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul class="list-group">
                                    <?php foreach($pro as $pros){ ?>
                                    <li class="list-group-item"><a href="<?php //echo base_url('product/'.$pros['attribute_slug']) ?>"><?php //echo $pros['attribute_name'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div-->
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <!-- card -->
                    
                    
                </div>
                </div>
                </div>
            </div>
              <div class="row d-none d-sm-block">
              	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1 p-media">
                	<div class="accordion-side">
              			<div class="accordion">
              			<div class="card">
                        <div class="cat-list card-header">
                            <h2 class="mb-0"><span class="cat-span"> Filter By Price</span></h2>
                        </div>
                    </div>
                    <div class="card-body row m-0">
                    	<div class="form-price-range-filter p-3">
        <form method="post" action="">
            <div class="position-rel">
                <input type="" id="min" name="min_price"
                    value="100">
                
                <input type="" id="max" name="max_price"
                    value="298">
                    <div id="slider-range"></div>
            </div>
            
        </form>
    </div>
                    </div>
                    </div>
                    </div>
                  </div>
              </div>
              
        </div>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12">
        	 <div class="row mb-0">
              		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1 p-media">
              	<div class="product-top">
					<h4>Product</h4>
					<ul> 
						<li class="dropdown head-dpdn">
                        	<span class="orderby-title">Sort by : </span>
							<select id="sort-by">
                            	<option value="<?php echo base_url('shop/?s=new-and-popular') ?>" <?php if(isset($_GET['s']) && $_GET['s'] == 'new-and-popular') echo 'selected'; ?>>New and Popular </option>
                                <option value="<?php echo base_url('shop/?s=price-low-to-high') ?>" <?php if(isset($_GET['s']) && $_GET['s'] == 'price-low-to-high') echo 'selected'; ?>>Price : Low to High</option>
                                 <option value="<?php echo base_url('shop/?s=price-high-to-low') ?>" <?php if(isset($_GET['s']) && $_GET['s'] == 'price-high-to-low') echo 'selected'; ?>>Price : High to Low </option>
                                 <option value="<?php echo base_url('shop/?s=customer-review') ?>" <?php if(isset($_GET['s']) && $_GET['s'] == 'customer-review') echo 'selected'; ?>> Customer Review </option>
                            </select>
						</li>
						<li class="dropdown head-dpdn">
							
						</li>
					</ul> 
					<div class="clearfix"> </div>
				</div>
                	</div>
              </div>
	<div class="row mb-5">
	    <?php
$ct = 0;
if(count($variation)>0){
foreach($variation as $var){ ?>

			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 p-1 p-media">
							<div class="products">
							    
							    <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">
								<span class="wish-icon"><i class="
								<?php
								    if(isset($_SESSION['login_id'])){
								      $res = $model2->getWishlistStatus($var['id'],$_SESSION['login_id']);
								      if($res != FALSE){
								          echo 'fa fa-heart';
								      }else{
								          echo 'fa fa-heart-o';
								      }
								    }else{
								        echo 'fa fa-heart-o';
								    }
								    ?>
								"></i><input type="hidden" name="wishlist" class="wlist" id="wlist" value="<?php echo $var['id']; ?>"></span>
								<a class="btn-black-color" href="<?php echo base_url('product/'.$var['attribute_slug']) ?>">
								<div class="img-box">
									<img src="<?php echo base_url('teao/uploads/product_images/'.$var['fimage']) ?>" class="img-responsive img-fluid" alt="">									
								</div>
								<div class="thumb-content">
									<h4><?php echo $var['attribute_name'] ?></h4>
									<?php $review = $model2->getApprovedUserReviews($var['id']); ?>
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
									<?php $mPrice = $model2->getMinMaxPrice($var['id']); ?>
									<p class="item-price"><strike>Rs.<?php echo $mPrice['maxsp']  ?></strike> <b>Rs.<?php echo $mPrice['minsp']  ?></b></p>
									
								</div></a>
								<!--a href="#" class="btn btn-primary btn-cart">Add to Cart</a-->
								<button type="button" class="btn btn-primary btn-cart open_modal" data-toggle="modal" data-target="#myModal<?php echo $var['id']; ?>">Add to Cart</button>
							</div>
						</div>
						<!-- The Modal -->
<div class="modal" id="myModal<?php echo $var['id']; ?>">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $var['attribute_name'] ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form class="add_cart" did="<?php echo $ct; ?>" method="post">
          <input type="hidden" name="attribute_id" value="<?php echo $var['id'] ?>">
            <div class="row m-0">
                <div class="col-sm-5 col-4">
                    <div class="p-1 mt-4">
                    <img src="<?php echo base_url('teao/uploads/product_images/'.$var['fimage']) ?>" class="img-responsive img-fluid" alt="">
                    </div>
                </div>
                <div class="col-sm-7 col-8">
                    <div class="p-3">
                        <div class="padding-heading-top">
           		        <h4><?php echo $var['attribute_name'] ?></h4>
           		   </div>
           		        <div class=" mb-2 mt-2">
           		            <?php $vardetail = $model2->getVariationDetail($var['id']); ?>
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
                        <div class="mb-2 mt-4 submit">
                        
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
       <?php $ct = $ct + 1; }}else{
           echo '<div class="col-sm-12"><p align="center">No Product Found.</p></div>';
       }

?>     
            
	</div>
</div>
</div>
</div>
</section>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner gifting-slider">
      <div class="carousel-item active">
        <img class="d-block w-100" src="https://i.imgur.com/6axE29k.jpg slide" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://i.imgur.com/6axE29k.jpg slide" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="https://i.imgur.com/6axE29k.jpg slide" alt="Third slide">
      </div>
    </div>
</div>
<section class="bg_color">
	<div class="row bg-white">
    	<div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12 p-0">
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
        <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 col-12 p-0">
            <div class="bg-white padding-heading-top">
            	<h2 align="center">What they say</h2>
        		<div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="testimonial-indicators carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>   
                <div class="carousel-inner testimonial-new">		
                    <div class="item carousel-item active">
                        <div class="img-box">
                            <img src="assets/img/3.jpg" alt="">
                        </div>
                        <p class="testimonial">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                        <p class="overview"><b>Michael </b> Seo Analyst at <a href="#">read.</a></p>
                        
                    </div>
                    <div class="item carousel-item">
                        <div class="img-box">
                            <img src="assets/img/1.jpg" alt="">
                        </div>
                        <p class="testimonial">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                        <p class="overview"><b>Paula Willson</b> Media Analyst at <a href="#"> read.</a></p>
                    </div>
                    <div class="item carousel-item">
                        <div class="img-box">
                            <img src="assets/img/2.jpg" alt="">
                        </div>
                        <p class="testimonial">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                        <p class="overview"><b>Antonio Moreno</b> Web Developer<a href="#"> read.</a></p>
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
 <script type="text/javascript">

  $(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 1000,
      values: [ 100, 298 ],
      slide: function( event, ui ) {
        $( "#amount" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		$( "#min" ).val(ui.values[ 0 ]);
		$( "#max" ).val(ui.values[ 1 ]);
      }
      });
    $( "#amount" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) +
     " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  });
  </script>
<script>
$(document).ready(function(){
    
    $(document).on('click', '.open_modal', function (e) {
        $('.submit').html();
        $('.submit').html('<button type="submit" id="submit" class="btn btn-primary  btn-cart">Add to Cart</button>');
    });
    $(document).on('change', '#sort-by', function (e) {
        window.location.href = $('#sort-by').val();
    });
    $(document).on('click', '.fa-heart', function (e) {
        //alert($("#wlist").val());
        var v = $(this).siblings('.wlist').val()
        
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
        var v = $(this).siblings('.wlist').val();
        
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
        
        var str = $(this).val();
        var res = str.split("-");
        var v = res[3];
        /*$(this).parent().siblings('.rpsp').html();
        $(this).parent().siblings('.rpsp').html('Sale Price: '+res[1]);*/
        $.ajax({
            type: "GET",
            url: "<?php echo base_url("Ajaxcontroller/getSatusOfProduct") ?>",
            data: {v:v},
            success: function (data) {
               if(data == 'out'){
                   $('.submit').empty();
                   $('.submit').html('Product is out of stock.');
               }else if(data == 'in'){
                   
               }else if(data == 'not'){
                   $('.submit').empty();
                   $('.submit').html('Product is not available in stock.');
               }
                

            }
        });
            
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

