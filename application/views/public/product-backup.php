<span class="d-none d-sm-block">
   
</span>
<section class="d-none d-sm-block  main-margin pb-5 pt-5">
<div class="container">
    <div class="row mb-5 mt-5">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
             <div class="xzoom-container">
                <img class="xzoom img-fluid" id="xzoom-default" src="<?php echo base_url('teao/uploads/product_variation_images/'.$prodetail['fimage']) ?>" xoriginal="<?php echo base_url('teao/uploads/product_variation_images/'.$prodetail['fimage']) ?>" />
                
          <div class="xzoom-thumbs">
              <?php if(count($images)>0){ ?>
              <a href="<?php echo base_url('teao/uploads/product_variation_images/'.$prodetail['fimage']) ?>">
                <img class="xzoom-gallery img-fluid" width="80" height="80" src="<?php echo base_url('teao/uploads/product_variation_images/'.$prodetail['fimage']) ?>"  xpreview="<?php echo base_url('teao/uploads/product_variation_images/'.$prodetail['fimage']) ?>">
            </a>
            <?php } ?>
              <?php
              
              foreach($images as $img){
                  
              ?>
            <a href="<?php echo base_url('teao/uploads/product_variation_images/'.$img['image']) ?>">
                <img class="xzoom-gallery" width="80" src="<?php echo base_url('teao/uploads/product_variation_images/'.$img['image']) ?>"  xpreview="<?php echo base_url('teao/uploads/product_variation_images/'.$img['image']) ?>">
            </a>
              
            <?php } ?>
          </div>
        </div> 
        
             <div class="social_sharing mt-1 mb-1">
                <span>Share</span>
                <ul>
                    <li><a href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u=<?php echo base_url('product/'.$prodetail['attribute_slug']) ?>"  class="bg-facebook" data-toggle="tooltip" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i> Share</a></li>
                    <li><a href="#" target="_blank" class="bg-Tweet" data-toggle="tooltip" title="" data-original-title="twitter"><i class="fa fa-twitter"></i> Tweet</a></li>
                    <li><a href="#" target="_blank" class="bg-google" data-toggle="tooltip" title="" data-original-title="linkedin"><i class="fa fa-linkedin"></i> Linkedin</a></li>
                    <li><a href="#" target="_blank" class="bg-pinterest" data-toggle="tooltip" title="" data-original-title="whatsapp"><i class="fa fa-whatsapp"></i> Whatsapp</a></li>
                </ul>
             </div>
             <div class="actions-rating mt-3 mb-3">
            <ul>
            <li> <a class="button-rating actions-newreview"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
 Write a Review</a></li>
              <!--<li> <a href="#" class="actions-newreview"><i class="fa fa-comments" aria-hidden="true"></i>Ask a Question</a></li>-->
            </ul>
        </div> 
             <div class="stars">
             <form method="post" id="add_review">
                 <input type="hidden" name="attr_id" value="<?php echo $prodetail['id'] ?>">
    <span class="field-label-info"></span>
    <input type="hidden" name="rating" id="selected_rating"  value="" >
    </label>
        <span class="bold rating-header">
        <span class="selected-rating">0</span><small> / 5</small>
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
    <div class="form-group">
        <input type="text" name="rname" class="form-control" placeholder="Enter name" required>
    </div>
    <div class="form-group">
        <input type="email" name="remail" class="form-control" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <input type="text" name="title_review" class="form-control" placeholder="Review title" required>
    </div>
    <div class="form-group">
        <textarea name="review" class="form-control" placeholder="Your Review" required></textarea>
    </div>
    <div class="form-group">
        <button type="submit" id="submits" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i>
    Submit</button>
    <p id="responses_edit"></p>
    </div>
</form>
        </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
            
            <div class="product_details p-2">
                <form id="add_cart" method="post">
                                <input type="hidden" name="attribute_name" value="<?php echo $prodetail['attribute_name'] ?>">
<input type="hidden" name="attribute_id" value="<?php echo $prodetail['id'] ?>">
                                <h3><?php echo $prodetail['attribute_name'] ?></h3>
                                <div class="float-right star-chacked">
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
                                            <span class="fa fa-star checked"></span>
                                            
                                      <?php  }
                                        for($n=0;$n<$mi;$n++){ ?>
                                            
                                            <span class="fa fa-star"></span>
                                            
                                      <?php  } echo '('.$car.' customer reviews)';
                                    }else{ ?>
                                    
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                        
                                   <?php }
                                   ?>
                                </div>
                                <div class="product_price">
                                    <?php
                                    if($minmax['minsp'] == '0.00'){
                                    ?>
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['minrp'].' ' ?></span>-
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['maxrp'].' ' ?></span>
                                    <?php }else{ ?>
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['minsp'].' ' ?></span>-
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['maxsp'].' ' ?></span>
                                    
                                    <?php } ?>
                                    
                                </div>
                               <div class="mb-3">
                                   <p><?php echo $prodetail['short_description'] ?></p>
                               </div>
                                <div class="mb-1">
                                    <h3>Available Options</h3>
                                    <!--p><?php //echo $prodetail['proattribute'] ?>: </p-->
                                    <p>
                                      <select class="select-weight" name="aprice" id="aprice" required>
                                        <option value="">Select</option>
                                        <?php
                                            foreach($vardetail as $vdet){ 
                                    if(is_null($vdet['sale_price']) || $vdet['sale_price'] == '0.00'){
                           $sp = $vdet['regular_price'];
                   } else{
                           $sp = $vdet['sale_price'];
                   } 
                                             echo '<option value="'.$vdet['regular_price'].'-'.$sp.'-'.$vdet['weight'].'-'.$vdet['id'].'-'.$vdet['product_attribute_id'].'">'.$vdet['weight'].' (Rs.'.$sp.')'.'</option>';
                                            }
                                    
                                        ?>
                                      </select>
                                    </p>
                                    <!--p id="rpsp"></p-->
                                    <div class="product_stock mb-3">
                                        <div class="quantity1 quantity">
                        <p>Quantity : </p>                    
                        <div>
                            <div class="btn-minus" value="1"><span class="fa fa-minus"></span></div>
                            <input name="nitem" id="nitem" value="1" />
                            <div class="btn-plus" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>    
                                    </div>
                                    <div class="product_action_link mb-3">
                                        <ul>
                                            <li class="product_cart submit">
                                                <!--a href="#" title="Add to Cart">Add to Cart</a-->
                                                <button type="submit" id="submit" class="btn btn-primary">Add to Cart</button>
                                            </li>
                                            <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">
                                            <span class="wish-icon">
                    <i class="
                    <?php
                    if(isset($_SESSION['login_id'])){
                      $res = $model2->getWishlistStatus($prodetail['id'],$_SESSION['login_id']);
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
                    
                    "></i><input type="hidden" name="wishlist" class="wlist" id="wlist" value="<?php echo $prodetail['id']; ?>">Add to Wishlist</span>
                                        </ul>
                                    </div>
                                    <div class="mb-3">
                                        <p><?php echo $prodetail['long_description'] ?></p>
                               </div>
                                    
                                </div>
                            </div>
                            </form>
            <div class="card">
                <!-- review -->
                <?php
                foreach($review as $rew){
                
                ?>
                <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-2 col-sm-2 col-2">
                    <img src="<?php echo base_url() ?>assets/img/men.jpg" class="img img-rounded img-fluid"/>
                </div>
                <div class="col-md-10 col-sm-10 col-10">
                        <a class="float-left" href="#"><strong><?php echo $rew['name'] ?></strong></a>
                       <div class="float-right star-chacked">
                            <?php
                        
                           $rc = $rew['rating'];
                           $mi = 5-$rc;
                            for($m=0;$m<$rc;$m++){ ?>
                                <span class="fa fa-star checked"></span>
                                
                          <?php  }
                            for($n=0;$n<$mi;$n++){ ?>
                                
                                <span class="fa fa-star"></span>
                                
                          <?php  } ?>
                          
                           
                        </div>

                   <div class="clearfix"></div>
                    <p><?php echo $rew['review'] ?></p>
                    <p class="text-secondary float-left">15 Minutes Ago</p>
                </div>
            </div>
            <?php
            if(!empty($rew['admin_reply'])){
            
            ?>
            <div class="card card-inner">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-2 col-sm-2 col-2">
                                <img src="<?php echo base_url() ?>assets/img/men.jpg" class="img img-rounded img-fluid"/>
                            </div>
                            <div class="col-md-10 col-sm-10 col-10">
                                <p><a href="#"><strong>Admin</strong></a></p>
                                <p><?php echo $rew['admin_reply'] ?></p>
                                 <p class="text-secondary float-left">15 Minutes Ago</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
        </div>
        <?php } ?>
        <!-- review -->
            </div>
            
        </div>
    </div>
 </div>
</div>
</section>
<section class="d-block d-sm-none">
   
  <div class="row p-2">
      <div class="col-12">
          
          <div class="product_details">
               <form id="add_cart" method="post">
            <input type="hidden" name="attribute_name" value="<?php echo $prodetail['attribute_name'] ?>">
            <input type="hidden" name="attribute_id" value="<?php echo $prodetail['id'] ?>">
            <h3><?php echo $prodetail['attribute_name'] ?></h3>
            <div class="product_price">
                <span class="current_price"><?php echo 'Rs.'.$minmax['minsp'].' -' ?></span>
                <span class="old_price"><?php echo 'Rs.'.$minmax['maxsp'].' ' ?></span>
                <div class="float-right star-chacked">
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
                                            <span class="fa fa-star checked"></span>
                                            
                                      <?php  }
                                        for($n=0;$n<$mi;$n++){ ?>
                                            
                                            <span class="fa fa-star"></span>
                                            
                                      <?php  } echo '('.$car.' reviews)';
                                    }else{ ?>
                                    
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                        
                                   <?php }
                                   ?>
                                                                             
                </div>
            </div>
            <div class="mb-3">
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
           </div>
       </div>
       </div>
    </div>
  <div class="row">
      <div id="mobile-slider" class="carousel slide" data-ride="carousel">
              <ul class="carousel-indicators mobile-indicators">
                <li data-target="#mobile-slider" data-slide-to="0" class="active"></li>
                <li data-target="#mobile-slider" data-slide-to="1"></li>
                <li data-target="#mobile-slider" data-slide-to="2"></li>
              </ul>
              <div class="carousel-inner mobile-inner">
                <!--<div class="carousel-item active">
                  <img src="<?php echo base_url() ?>assets/img/products/original/1.jpg" class="img-fluid" alt="">
                </div>
                <div class="carousel-item">
                  <img src="<?php echo base_url() ?>assets/img/products/original/2.jpg" class="img-fluid" alt="">
                </div>
                <div class="carousel-item">
                  <img src="<?php echo base_url() ?>assets/img/products/original/1.jpg" class="img-fluid" alt="">
                </div>-->
                <div class="carousel-item active">
                  <img src="<?php echo base_url('teao/uploads/product_variation_images/'.$prodetail['fimage']) ?>" class="img-fluid" alt="">
                </div>
                
                <?php
              if(count($images)>0){
              foreach($images as $img){
                  
              ?>
              <div class="carousel-item">
                  <img src="<?php echo base_url('teao/uploads/product_variation_images/'.$img['image']) ?>" class="img-fluid" alt="">
                </div>
              
            <?php } } ?>
              </div>
              <?php
              if(count($images)>0){ ?>
              <a class="carousel-control-prev" href="#mobile-slider" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="carousel-control-next" href="#mobile-slider" data-slide="next">
                <span class="carousel-control-next-icon"></span>
              </a>
              <?php } ?>
    </div>
    </div>
  <div class="p-2">
      <div class="mb-1">
        <h5>Available Options</h5>
        <p><?php echo $prodetail['short_description'] ?></p>
        <p>
            <select class="select-weight" name="aprice" id="aprice" required>
            <option value="">Select</option>
            <?php
                                            foreach($vardetail as $vdet){ 
                                    if(is_null($vdet['sale_price']) || $vdet['sale_price'] == '0.00'){
                           $sp = $vdet['regular_price'];
                   } else{
                           $sp = $vdet['sale_price'];
                   } 
                                             echo '<option value="'.$vdet['regular_price'].'-'.$sp.'-'.$vdet['weight'].'-'.$vdet['id'].'-'.$vdet['product_attribute_id'].'">'.$vdet['weight'].' (Rs.'.$sp.')'.'</option>';
                                            }
                                    
                                        ?>
          </select>
           
        </p>
        
        <div class="product_stock mb-3">
           <div class="quantity1 quantity">
                        <p>Quantity : </p>                    
                        <div>
                            <div class="btn-minus" value="1"><span class="fa fa-minus"></span></div>
                            <input name="nitem" id="nitem" value="1" />
                            <div class="btn-plus" value="1"><span class="fa fa-plus"></span></div>
</div>
</div>    
        </div>
        <div class="product_action_link mb-3">
            <ul>
                <li class="product_cart submit">
                    
                    <button type="submit" id="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                    </li>
                <li class="add_links"><a href="#" title="Add to Wishlist"><i class="fa fa-heart-o"></i> Add to wishlist</a></li>
            </ul>
        </div>
        <div class="social_sharing mt-1 mb-1">
            <span>Share</span>
            <ul>
                <li><a href="#" class="bg-facebook" data-toggle="tooltip" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i> Share</a></li>
                <li><a href="#" class="bg-Tweet" data-toggle="tooltip" title="" data-original-title="twitter"><i class="fa fa-twitter"></i> Tweet</a></li>
                <li><a href="#" class="bg-google" data-toggle="tooltip" title="" data-original-title="google-plus"><i class="fa fa-google-plus"></i> Google+</a></li>
                <li><a href="#" class="bg-pinterest" data-toggle="tooltip" title="" data-original-title="pinterest"><i class="fa fa-pinterest"></i> Pinterest</a></li>
            </ul>
        </div>
        <div class="actions-rating mt-3 mb-1">
        <ul>
            <li> <a class="button-rating actions-newreview"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            Write a Review</a></li>
            <!--<li> <a href="#" class="actions-newreview"><i class="fa fa-comments" aria-hidden="true"></i>Ask a Question</a></li>-->
            <li> <a class="des-product actions-newreview"><i class="fa fa-comments" aria-hidden="true"></i>Description</a></li>
        </ul>
        </div>
        <div class="stars">
<form method="post" id="addreview">
<input type="hidden" name="attr_id" value="<?php echo $prodetail['id'] ?>">
<span class="field-label-info"></span>
<input type="hidden" id="selected_rating1" name="rating" value="" required="required">
</label>
<span class="bold rating-header">
<span class="selected-rating">0</span><small> / 5</small>
</span>
<input class="star star-5" id="star-10" data-attr="5" type="radio" name="star"/>
<label class="star star-5" for="star-10"></label>
<input class="star star-4" id="star-9" data-attr="4" type="radio" name="star"/>
<label class="star star-4" for="star-9"></label>
<input class="star star-3" id="star-8" data-attr="3" type="radio" name="star"/>
<label class="star star-3" for="star-8"></label>
<input class="star star-2" id="star-7" data-attr="2" type="radio" name="star"/>
<label class="star star-2" for="star-7"></label>
<input class="star star-1" id="star-6" data-attr="1" type="radio" name="star"/>
<label class="star star-1" for="star-6"></label>


    <div class="form-group">
        <input type="text" name="rname" class="form-control" placeholder="Enter name" required>
    </div>
    <div class="form-group">
        <input type="email" name="remail" class="form-control" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <input type="text" name="title_review" class="form-control" placeholder="Review title" required>
    </div>
    <div class="form-group">
        <textarea name="review" class="form-control" placeholder="Your Review" required></textarea>
    </div>
    <div class="form-group">
        <button type="submit" id="rsubmits" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i>
    Submit</button>
    <p id="responses_edit1"></p>
    </div>


</form>
</div>
        <div class="mb-3 product-description" style="display:none;">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis laborum, facilis in provident pariatur, assumenda accusantium asperiores iste corrupti laboriosam quasi eius illum minus aperiam doloribus, distinctio unde? Nam recusandae ipsam repellendus repellat eum nisi obcaecati, doloremque mollitia iste, ab delectus, error quia, quae eligendi!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis laborum, facilis in provident pariatur, assumenda accusantium asperiores iste corrupti laboriosam quasi eius illum minus aperiam doloribus, distinctio unde? Nam recusandae ipsam repellendus repellat eum nisi obcaecati, doloremque mollitia iste, ab delectus, error quia, quae eligendi!</p>
        </div>
     </div>
    </div>
    <div class="p-2 p-2 pb-5 mb-5">
      <div class="padding-heading-top mb-3">
            <h2 align="center">Related Product</h2>
         </div>
      <ul class="product-multiple">
            <li class="item-product">
                <div class="products products-mob-size">
                    <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                    <div class="img-box">
                        <img src="<?php echo base_url() ?>assets/img/tea/1.jpg" class="img-responsive img-fluid" alt="">                  
                    </div>
                    <div class="thumb-content">
                        <h4>Lecos Milk Tea</h4>                 
                        <div class="star-rating">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                            </ul>
                        </div>
                        <p class="item-price"><strike>Rs.300.00</strike> <b>Rs.250.00</b></p>
                        <a href="#" class="btn btn-cart btn-primary">Add to Cart</a>
                    </div>            
                </div>
            </li>
            <li class="item-product">
                <div class="products products-mob-size">
                    <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                    <div class="img-box">
                        <img src="<?php echo base_url() ?>assets/img/tea/1.jpg" class="img-responsive img-fluid" alt="">                  
                    </div>
                    <div class="thumb-content">
                        <h4>Lecos Milk Tea</h4>                 
                        <div class="star-rating">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                            </ul>
                        </div>
                        <p class="item-price"><strike>Rs.300.00</strike> <b>Rs.250.00</b></p>
                        <a href="#" class="btn btn-cart btn-primary">Add to Cart</a>
                    </div>            
                </div>
            </li>
            <li class="item-product">
                <div class="products products-mob-size">
                    <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                    <div class="img-box">
                        <img src="<?php echo base_url() ?>assets/img/tea/1.jpg" class="img-responsive img-fluid" alt="">                  
                    </div>
                    <div class="thumb-content">
                        <h4>Lecos Milk Tea</h4>                 
                        <div class="star-rating">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                            </ul>
                        </div>
                        <p class="item-price"><strike>Rs.300.00</strike> <b>Rs.250.00</b></p>
                        <a href="#" class="btn btn-cart btn-primary">Add to Cart</a>
                    </div>            
                </div>
            </li>
            <li class="item-product">
                <div class="products products-mob-size">
                    <span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                    <div class="img-box">
                        <img src="<?php echo base_url() ?>assets/img/tea/1.jpg" class="img-responsive img-fluid" alt="">                  
                    </div>
                    <div class="thumb-content">
                        <h4>Lecos Milk Tea</h4>                 
                        <div class="star-rating">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                            </ul>
                        </div>
                        <p class="item-price"><strike>Rs.300.00</strike> <b>Rs.250.00</b></p>
                        <a href="#" class="btn btn-cart btn-primary">Add to Cart</a>
                    </div>            
                </div>
            </li>     
        </ul>
    </div>
    <div class="p-2">
      <div class="card">
            <!-- review -->
                <?php
                foreach($review as $rew){
                
                ?>
                <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-2 col-sm-2 col-2">
                    <img src="<?php echo base_url() ?>assets/img/men.jpg" class="img img-rounded img-fluid"/>
                </div>
                <div class="col-md-10 col-sm-10 col-10">
                        <a class="float-left" href="#"><strong><?php echo $rew['name'] ?></strong></a>
                       <div class="float-right star-chacked">
                            <?php
                        
                           $rc = $rew['rating'];
                           $mi = 5-$rc;
                            for($m=0;$m<$rc;$m++){ ?>
                                <span class="fa fa-star checked"></span>
                                
                          <?php  }
                            for($n=0;$n<$mi;$n++){ ?>
                                
                                <span class="fa fa-star"></span>
                                
                          <?php  } ?>
                          
                           
                        </div>

                   <div class="clearfix"></div>
                    <p><?php echo $rew['review'] ?></p>
                    <p class="text-secondary float-left">15 Minutes Ago</p>
                </div>
            </div>
            <?php
            if(!empty($rew['admin_reply'])){
            
            ?>
            <div class="card card-inner">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-2 col-sm-2 col-2">
                                <img src="<?php echo base_url() ?>assets/img/men.jpg" class="img img-rounded img-fluid"/>
                            </div>
                            <div class="col-md-10 col-sm-10 col-10">
                                <p><a href="#"><strong>Admin</strong></a></p>
                                <p><?php echo $rew['admin_reply'] ?></p>
                                 <p class="text-secondary float-left">15 Minutes Ago</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
        </div>
        <?php } ?>
        <!-- review -->
          </div>
    </div>
</section>


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
$(document).on('submit','#add_review',(function(e){
    if($('#selected_rating').val() == '' ){
        e.preventDefault();
        $('#responses_edit').html('Please Select Rating');
    }else{
        $('#responses_edit').html(" ");
        $("#submits").addClass('disabled');
        $("#submits").text('please wait....');
        e.preventDefault();
          $.ajax({
          url: "<?php echo base_url('Ajaxcontroller/add_review') ?>",
          type: "POST",        
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,  
          success: function(data){
            //alert(data);
            $('#responses_edit').html(data);
            $("#add_review")[0].reset();
            $("#submits").removeClass("disabled");
            $("#submits").text('Submit');
            
    
         }  
         });  
    }
    
    }));
    $(document).on('submit','#addreview',(function(e){
    if($('#selected_rating1').val() == '' ){
        e.preventDefault();
        $('#responses_edit1').html('Please Select Rating');
    }else{
        $('#responses_edit1').html(" ");
        $("#rsubmits").addClass('disabled');
        $("#rsubmits").text('please wait....');
        e.preventDefault();
          $.ajax({
          url: "<?php echo base_url('Ajaxcontroller/add_review') ?>",
          type: "POST",        
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,  
          success: function(data){
            //alert(data);
            $('#responses_edit1').html(data);
            $("#addreview")[0].reset();
            $("#rsubmits").removeClass("disabled");
            $("#rsubmits").text('Submit');
            
    
         }  
         });  
    }
    
    }));
$(document).on('submit','#add_cart',(function(e){
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
        //$("#add_cart")[0].reset();
        //$("#submit").removeClass("disabled");
        //$("#submit").text('Add to Cart');
        alert('this item added in your cart successfully..');
        location.reload();

     }  
     });  
 }));
    $(document).on('change', '#aprice', function (e) {
        var str = $(this).val();
        var res = str.split("-");
        
        /*$('#rpsp').empty();
        $('#rpsp').html('Sale Price: '+res[1]);*/
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
        
});
</script>
<script src='<?php echo base_url() ?>assets/js/xzoom.min.js'></script>