<span class="d-none d-sm-block">
   
</span>
<section class="d-none d-sm-block main-banneP">
<div class="container">
    <div class="row mrgin-productpage">
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
             <div class="xzoom-container">
                <img class="xzoom img-fluid" id="xzoom-default" src="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $prodetail['fimage'])) ?>" xoriginal="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $prodetail['fimage'])) ?>" />
                
          <div class="xzoom-thumbs">
              <?php if(count($images)>0){ ?>
              <a href="<?php echo base_url('admin/uploads/product_variation_images/'.$prodetail['fimage']) ?>">
                <img class="xzoom-gallery img-fluid" width="80" height="80" src="<?php echo base_url('admin/uploads/product_variation_images/'.$prodetail['fimage']) ?>"  xpreview="<?php echo base_url('admin/uploads/product_variation_images/'.$prodetail['fimage']) ?>">
            </a>
            <?php } ?>
              <?php
              
              foreach($images as $img){
                  
              ?>
            <a href="<?php echo base_url('admin/uploads/product_variation_images/'.$img['image']) ?>">
                <img class="xzoom-gallery" width="80" src="<?php echo base_url('admin/uploads/product_variation_images/'.$img['image']) ?>"  xpreview="<?php echo base_url('admin/uploads/product_variation_images/'.$img['image']) ?>">
            </a>
              
            <?php } ?>
          </div>
        </div> 
        
             <div class="social_sharing mt-1 mb-1">
                <!--<span>Share</span>-->
                <ul>
                    <li><a href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u=<?php echo base_url('product/'.$prodetail['pslug'].'/'.$prodetail['attribute_slug']) ?>" target="_blank"  class="bg-facebook" data-toggle="tooltip" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i> Share</a></li>
                    <li><a href="https://twitter.com/share?url=<?php echo base_url('product/'.$prodetail['pslug'].'/'.$prodetail['attribute_slug']) ?>" target="_blank" class="bg-Tweet" data-toggle="tooltip" title="" data-original-title="twitter"><i class="fa fa-twitter"></i> Tweet</a></li>
                    <!--<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo base_url('product/'.$prodetail['pslug'].'/'.$prodetail['attribute_slug']) ?>" target="_blank" class="bg-linkedin" data-toggle="tooltip" title="" data-original-title="linkedin"><i class="fa fa-linkedin"></i> Linkedin</a></li>-->
                    <li><a href="https://web.whatsapp.com/send?text=<?php echo base_url('product/'.$prodetail['pslug'].'/'.$prodetail['attribute_slug']) ?>" target="_blank" data-action="share/whatsapp/share" class="bg-whatsapp" data-toggle="tooltip" title="" data-original-title="whatsapp"><i class="fa fa-whatsapp"></i> Whatsapp</a></li>
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
                                        if($minmax['minrp'] != $minmax['maxrp']){
                                    ?>
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['minrp'].' ' ?></span>-
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['maxrp'].' ' ?></span>
                                    <?php }}else{ if($minmax['minsp'] != $minmax['maxsp']){ ?>
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['minsp'].' ' ?></span>-
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['maxsp'].' ' ?></span>
                                    
                                    <?php }} ?>
                                    
                                </div>
                               <div class="mb-3">
                                   <p><?php echo $prodetail['short_description'] ?></p>
                               </div>
                                <div class="mb-1">
                                    <h4>Available Options</h4>
                                    <!--p><?php //echo $prodetail['proattribute'] ?>: </p-->
                                    <p>
                                      <select class="select-weight" name="aprice" id="aprice" required>
                                        <!--<option value="">Select</option>-->
                                        <?php $cx = 0;
                                            foreach($vardetail as $vdet){ 
                                    if(is_null($vdet['sale_price']) || $vdet['sale_price'] == '0.00'){
                           $sp = $vdet['regular_price'];
                   } else{
                           $sp = $vdet['sale_price'];
                   }
                   
                   if($cx == 0){ $cxpr = $sp; }
                                             echo '<option value="'.$vdet['regular_price'].'-'.$sp.'-'.$vdet['weight'].'-'.$vdet['id'].'-'.$vdet['product_attribute_id'].'">'.$vdet['weight'].'</option>';
                                             $cx = $cx + 1;
                                            }
                                    
                                        ?>
                                      </select>
                                      
                                    </p>
                                    <p class="proprice">Rs.<?php echo $cxpr; ?></p>
                                    <!--p id="rpsp"></p-->
                                    <div class="product_stock mb-3">
                                        <div class="quantity1 quantity">
                        <p>Quantity : </p>                    
                        <div>
                            <div class="btn-minuss" value="1"><span class="fa fa-minus"></span></div>
                            <input name="nitem" id="nitem" value="1" readonly/>
                            <div class="btn-pluss" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>    
                                    </div>
                                    <div class="product_action_link mb-3">
                                        <ul>
                                            <li class="product_cart submit">
                                                <!--a href="#" title="Add to Cart">Add to Cart</a-->
                                                <!--<button type="submit" id="submit" class="btn btn-primary">Add to Cart</button>-->
                                            <?php if($prodetail['inventory_status'] == 0){ ?>
                                            <button type="submit" id="submit" value="1" class="atcbtn btn cartnewbtn pr-2 pl-2">Add to Cart</button>
                                                <button  type="submit" id="submit1" class="buybtn btn cart__buy cartnewbtn pr-2 pl-2">Buy Now</button>
                                            <?php }else{ echo 'Out of stock'; } ?>
                                                
                                            </li>
                                            <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">
                                            <div class="ml-3 d-inline upclass20"><span class="wish-icon">
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
                    
                    "></i><input type="hidden" name="wishlist" class="wlist" id="wlist" value="<?php echo $prodetail['id']; ?>">Add to Wishlist</span></div>
                                        </ul>
                                    </div>
                                    <div class="mb-3">
                                        <br>
                                        <b><h4>Description:</h4></b>
                                        <p><?php echo $prodetail['long_description'] ?></p>
                               </div>
                                    
                                </div>
                            </div>
                            </form>
            <!-- review -->
                <?php
                foreach($review as $rew){
                
                ?>
            <div class="card">
                
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
        
            </div>
            <?php } ?>
        <!-- review -->
        </div>
    </div>
 </div>
</div>
</section>
<section class="d-block d-sm-none">
   
  <div class="row p-2 main-margin">
      <div class="col-12">
          
          <div class="product_details">
               <form id="add_cart" method="post">
            <input type="hidden" name="attribute_name" value="<?php echo $prodetail['attribute_name'] ?>">
            <input type="hidden" name="attribute_id" value="<?php echo $prodetail['id'] ?>">
            <h3><?php echo $prodetail['attribute_name'] ?></h3>
            <div class="product_price">
                <?php
                                    if($minmax['minsp'] == '0.00'){
                                        if($minmax['minrp'] != $minmax['maxrp']){
                                    ?>
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['minrp'].' ' ?></span>-
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['maxrp'].' ' ?></span>
                                    <?php }}else{ if($minmax['minsp'] != $minmax['maxsp']){ ?>
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['minsp'].' ' ?></span>-
                                    <span class="current_price"><?php echo 'Rs.'.$minmax['maxsp'].' ' ?></span>
                                    
                                    <?php }} ?>
                
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
                                       <a class="button-rating actions-newreview"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            Write a Review</a>                                      
                </div>
            </div>
       </div>
       </div>
    </div>
  <div class="row">
     <ul class="product-slider">
        <li> <img src="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $prodetail['fimage'])) ?>" class="img-fluid"></li>
            <?php
              if(count($images)>0){
              foreach($images as $img){
                  
              ?>
            <li> <img src="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $img['image'])) ?>" class="img-fluid"></li>
            <?php }} ?>
        </ul>
    </div>
  <div class="p-2">
      <div class="mb-5 pb-5">
        <h5>Available Options</h5>
        <p><?php echo $prodetail['short_description'] ?></p>
        <p>
            <select class="select-weight" name="aprice" id="aprice" required>
            <?php $cx = 0;
                                            foreach($vardetail as $vdet){ 
                                    if(is_null($vdet['sale_price']) || $vdet['sale_price'] == '0.00'){
                           $sp = $vdet['regular_price'];
                   } else{
                           $sp = $vdet['sale_price'];
                   }
                   
                   if($cx == 0){ $cxpr = $sp; }
                                             echo '<option value="'.$vdet['regular_price'].'-'.$sp.'-'.$vdet['weight'].'-'.$vdet['id'].'-'.$vdet['product_attribute_id'].'">'.$vdet['weight'].'</option>';
                                             $cx = $cx + 1;
                                            }
                                    
                                        ?>
          </select>
           
        </p>
        <p class="proprice">Rs.<?php echo $cxpr; ?></p>
        <div class="product_stock mb-3">
                                        <div class="quantity1 quantity">
                        <p>Quantity : </p>                    
                        <div>
                            <div class="btn-minuss" value="1"><span class="fa fa-minus"></span></div>
                            <input name="nitem" id="nitem" value="1" readonly />
                            <div class="btn-pluss" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>    
                                    </div>
                                    <div class="product_action_link mb-3">
                                        <ul>
                                            <li class="product_cart submit">
                                                <!--a href="#" title="Add to Cart">Add to Cart</a-->
                                                <?php if($prodetail['inventory_status'] == 0){ ?>
                                            <button type="submit" id="submit" value="1" class="atcbtn btn cartnewbtn pr-2 pl-2">Add to Cart</button>
                                                <button  type="submit" id="submit1" class="buybtn btn cart__buy cartnewbtn pr-2 pl-2">Buy Now</button>
                                            <?php }else{ echo 'Out of stock'; } ?>
                                                
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
                                    </div></form>
        <div class="social_sharing mt-1 mb-1">
            <!--<span>Share</span>-->
            <ul>
                <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u=<?php echo base_url('product/'.$prodetail['pslug'].'/'.$prodetail['attribute_slug']) ?>"  class="bg-facebook" data-toggle="tooltip" title="" data-original-title="Facebook"><i class="fa fa-facebook"></i> Share</a></li>
                    <li><a href="https://twitter.com/share?url=<?php echo base_url('product/'.$prodetail['pslug'].'/'.$prodetail['attribute_slug']) ?>" target="_blank" class="bg-Tweet" data-toggle="tooltip" title="" data-original-title="twitter"><i class="fa fa-twitter"></i> Tweet</a></li>
                    <!--<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo base_url('product/'.$prodetail['pslug'].'/'.$prodetail['attribute_slug']) ?>" target="_blank" class="bg-linkedin" data-toggle="tooltip" title="" data-original-title="linkedin"><i class="fa fa-linkedin"></i> Linkedin</a></li>-->
                    <li><a href="https://api.whatsapp.com/send?text=<?php echo base_url('product/'.$prodetail['pslug'].'/'.$prodetail['attribute_slug']) ?>" data-action="share/whatsapp/share" target="_blank" class="bg-whatsapp" data-toggle="tooltip" title="" data-original-title="whatsapp"><i class="fa fa-whatsapp"></i> Whatsapp</a></li>
            </ul>
        </div>
        <div class="actions-rating mt-3 mb-1">
        <ul>
            <li> <!--<a class="button-rating actions-newreview"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            Write a Review</a>--></li>
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
            <br/>
            <b><h4>Description:</h4></b>
            <p><?php echo $prodetail['long_description'] ?></p></div>
     </div>
    </div>
    <!--<div class="p-2 p-2 pb-5 mb-5">
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
    </div>-->
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
<section class="bg-white">
      <div class="container">
            <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0 py-5">
          <div class="heading-new-h2">
                              <h2>Related Product</h2>
                        </div>
                <div class="partners-logos slider mt-5">
                <?php foreach($related_product as $fproduct){ ?>
                 <div class="slide">
                     <div class="productsnew">
                  <!--<form class="add_cart" did="0" method="post">-->
                  <input type="hidden" name="userid" id="userid" value="159">
                        
                                                                        <div class="row">
                  <div class="col-sm-12 col-12">
                      
                      <div class="save-price box-shadew">&nbsp;</div>
                      <div class="img-box">
                   <a href="<?php echo base_url('product/'.$fproduct['pslug'].'/'.$fproduct['attribute_slug']) ?>">
                  <img src="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $fproduct['fimage'])) ?>" class="img-responsive img-fluid" alt="">  
                  </a>                 
                </div>
                      <div class="productsnew-title text-center">
                  <h6>Farm Fresh</h6>
                  <a href="<?php echo base_url('product/'.$fproduct['pslug'].'/'.$fproduct['attribute_slug']) ?>"><?php echo $fproduct['attribute_name'] ?></a>
              </div>
                      <div class="itemproductdetail">
                          <div class="elementpro">
                              <?php $mPrice = $model2->getMinMaxPrice($fproduct['id']); ?>
                      <?php if(is_null($mPrice['minsp']) || $mPrice['minsp'] == '0.00'){ ?>
                      <h5 class="my-0">
                            <span class="iconrate">Rs.<?php echo $mPrice['minrp']  ?></span></h5>
                      <?php } else{ ?>
                      <h5 class="my-0">MRP:<span class="strickicon">Rs.<?php echo $mPrice['minrp']  ?> </span>
                            <span class="iconrate">Rs.<?php echo $mPrice['minsp']  ?></span></h5>
                      <?php } ?>
                            
                         </div>
                         <div class="clearfix"></div>
                      </div>
                  </div>
              </div>
              
              <!--</form>-->
          </div>
                 </div>
                 
                 <?php } ?>
                 <!--<div class="slide">
                     <div class="productsnew">
                  <form class="add_cart" did="0" method="post">
                  <input type="hidden" name="userid" id="userid" value="159">
                        
                                                                        <div class="row">
                  <div class="col-sm-5 col-5">
                      <span class="wish-icon">
                                    <i class="
                                                    fa fa-heart                                                 
                                                    "></i><input type="hidden" name="wishlist" class="wlist" id="wlist" value="187">
                                    
                                    
                                    </span>
                      <div class="save-price box-shadew">&nbsp;</div>
                      <div class="img-box">
                   <a href="https://www.test.farmstop.in/product/Neelam-Mango">
                  <img src="https://www.test.farmstop.in/admin/uploads/product_variation_images/10982494120187neelam0.png" class="img-responsive img-fluid" alt="">  
                  </a>                 
                </div>
                      <div class="productsnew-title">
                  <h6>Farm Fresh</h6>
                  <a href="https://www.test.farmstop.in/product/Neelam-Mango">Neelam Mango</a>
              </div>
                  </div>
                  <div class="col-sm-7 col-7">
                      <div class="row m-0">
                        <div class="col-sms-6 col-6 p-0">
                          <div class="qnty-selection">
                              <span>
                                                                <input type="hidden" name="attribute_id" value="187">
                      <select class="form-control aprice" name="aprice" required="">
                                                <option value="">Select</option>
                                                <option value="80.00-80.00-1 KG-416">1 KG (Rs.80.00)</option><option value="240.00-240.00-3 KG-417">3 KG (Rs.240.00)</option><option value="400.00-400.00-5 KG-418">5 KG (Rs.400.00)</option><option value="800.00-800.00-10 KG-419">10 KG (Rs.800.00)</option>                                       </select>
                              </span>
                          </div>
                      </div>
                      <div class="col-sm-6 col-6 p-0 textquant">
                          <div class="quantity1 quantity mt10px">                   
                        <div>
                            <div class="btn-minuss" value="1"><span class="fa fa-minus"></span></div>
                            <input class="form-control" name="nitem" id="nitem" value="1" readonly="">
                            <div class="btn-pluss" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>
                      </div>
                  </div>
                      <div class="itemproductdetail">
                  <div class="elementpro">
                                                                  <h5>MRP:<span class="strickicon">Rs.80.00 </span><span class="iconrate">Rs.80.00</span></h5>
                                        </div>
                  <div class="clearfix"></div>
                  
                  <div class="row m-0">
                      <div class="col-sms-12 col-12 p-0">
                          <input type="hidden" name="cnv" class="cnv" value="0">
                          <div class="text-center-flex submit">
                          <button type="button" class="buybtn btn cart__buy cartnewbtn mrginright2px">Buy <span class="fas fa-shopping-basket"></span></button>
                          
                          <button value="1" type="submit" id="submit0" class="atcbtn btn cartnewbtn">Add <span class="fa fa-shopping-cart"></span></button>
                          </div>
                      </div>
                      
                  </div>
              </div>
                  </div>
              </div>
              
              </form>
          </div>
                 </div>
                 <div class="slide">
                     <div class="productsnew">
                  <form class="add_cart" did="0" method="post">
                  <input type="hidden" name="userid" id="userid" value="159">
                        
                                                                        <div class="row">
                  <div class="col-sm-5 col-5">
                      <span class="wish-icon">
                                    <i class="
                                                    fa fa-heart                                                 
                                                    "></i><input type="hidden" name="wishlist" class="wlist" id="wlist" value="187">
                                    
                                    
                                    </span>
                      <div class="save-price box-shadew">&nbsp;</div>
                      <div class="img-box">
                   <a href="https://www.test.farmstop.in/product/Neelam-Mango">
                  <img src="https://www.test.farmstop.in/admin/uploads/product_variation_images/10982494120187neelam0.png" class="img-responsive img-fluid" alt="">  
                  </a>                 
                </div>
                      <div class="productsnew-title">
                  <h6>Farm Fresh</h6>
                  <a href="https://www.test.farmstop.in/product/Neelam-Mango">Neelam Mango</a>
              </div>
                  </div>
                  <div class="col-sm-7 col-7">
                      <div class="row m-0">
                        <div class="col-sms-6 col-6 p-0">
                          <div class="qnty-selection">
                              <span>
                                                                <input type="hidden" name="attribute_id" value="187">
                      <select class="form-control aprice" name="aprice" required="">
                                                <option value="">Select</option>
                                                <option value="80.00-80.00-1 KG-416">1 KG (Rs.80.00)</option><option value="240.00-240.00-3 KG-417">3 KG (Rs.240.00)</option><option value="400.00-400.00-5 KG-418">5 KG (Rs.400.00)</option><option value="800.00-800.00-10 KG-419">10 KG (Rs.800.00)</option>                                       </select>
                              </span>
                          </div>
                      </div>
                      <div class="col-sm-6 col-6 p-0 textquant">
                          <div class="quantity1 quantity mt10px">                   
                        <div>
                            <div class="btn-minuss" value="1"><span class="fa fa-minus"></span></div>
                            <input class="form-control" name="nitem" id="nitem" value="1" readonly="">
                            <div class="btn-pluss" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>
                      </div>
                  </div>
                      <div class="itemproductdetail">
                  <div class="elementpro">
                                                                  <h5>MRP:<span class="strickicon">Rs.80.00 </span><span class="iconrate">Rs.80.00</span></h5>
                                        </div>
                  <div class="clearfix"></div>
                  
                  <div class="row m-0">
                      <div class="col-sms-12 col-12 p-0">
                          <input type="hidden" name="cnv" class="cnv" value="0">
                          <div class="text-center-flex submit">
                          <button type="button" class="buybtn btn cart__buy cartnewbtn mrginright2px">Buy <span class="fas fa-shopping-basket"></span></button>
                          
                          <button value="1" type="submit" id="submit0" class="atcbtn btn cartnewbtn">Add <span class="fa fa-shopping-cart"></span></button>
                          </div>
                      </div>
                      
                  </div>
              </div>
                  </div>
              </div>
              
              </form>
          </div>
                 </div>
                 <div class="slide">
                     <div class="productsnew">
                  <form class="add_cart" did="0" method="post">
                  <input type="hidden" name="userid" id="userid" value="159">
                        
                                                                        <div class="row">
                  <div class="col-sm-5 col-5">
                      <span class="wish-icon">
                                    <i class="
                                                    fa fa-heart                                                 
                                                    "></i><input type="hidden" name="wishlist" class="wlist" id="wlist" value="187">
                                    
                                    
                                    </span>
                      <div class="save-price box-shadew">&nbsp;</div>
                      <div class="img-box">
                   <a href="https://www.test.farmstop.in/product/Neelam-Mango">
                  <img src="https://www.test.farmstop.in/admin/uploads/product_variation_images/10982494120187neelam0.png" class="img-responsive img-fluid" alt="">  
                  </a>                 
                </div>
                      <div class="productsnew-title">
                  <h6>Farm Fresh</h6>
                  <a href="https://www.test.farmstop.in/product/Neelam-Mango">Neelam Mango</a>
              </div>
                  </div>
                  <div class="col-sm-7 col-7">
                      <div class="row m-0">
                        <div class="col-sms-6 col-6 p-0">
                          <div class="qnty-selection">
                              <span>
                                                                <input type="hidden" name="attribute_id" value="187">
                      <select class="form-control aprice" name="aprice" required="">
                                                <option value="">Select</option>
                                                <option value="80.00-80.00-1 KG-416">1 KG (Rs.80.00)</option><option value="240.00-240.00-3 KG-417">3 KG (Rs.240.00)</option><option value="400.00-400.00-5 KG-418">5 KG (Rs.400.00)</option><option value="800.00-800.00-10 KG-419">10 KG (Rs.800.00)</option>                                       </select>
                              </span>
                          </div>
                      </div>
                      <div class="col-sm-6 col-6 p-0 textquant">
                          <div class="quantity1 quantity mt10px">                   
                        <div>
                            <div class="btn-minuss" value="1"><span class="fa fa-minus"></span></div>
                            <input class="form-control" name="nitem" id="nitem" value="1" readonly="">
                            <div class="btn-pluss" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>
                      </div>
                  </div>
                      <div class="itemproductdetail">
                  <div class="elementpro">
                                                                  <h5>MRP:<span class="strickicon">Rs.80.00 </span><span class="iconrate">Rs.80.00</span></h5>
                                        </div>
                  <div class="clearfix"></div>
                  
                  <div class="row m-0">
                      <div class="col-sms-12 col-12 p-0">
                          <input type="hidden" name="cnv" class="cnv" value="0">
                          <div class="text-center-flex submit">
                          <button type="button" class="buybtn btn cart__buy cartnewbtn mrginright2px">Buy <span class="fas fa-shopping-basket"></span></button>
                          
                          <button value="1" type="submit" id="submit0" class="atcbtn btn cartnewbtn">Add <span class="fa fa-shopping-cart"></span></button>
                          </div>
                      </div>
                      
                  </div>
              </div>
                  </div>
              </div>
              
              </form>
          </div>
                 </div>-->
              </div>
                </div>
        </div>
    </div>
    </div>
</section>


<script>
$(document).ready(function(){
    $(document).on('click','.btn-minuss',(function(e){
        var v = $(this).siblings('#nitem').val();
        if(v>1){
            var x = parseInt(v)-1;
            $(this).siblings('#nitem').val(x);
            var q = $(this).parent().parent().parent().siblings().find('#aprice').val();
        
            var ex = q.split('-');
            var qq = parseFloat(parseFloat(ex[1])*parseFloat(x)).toFixed(2);
            //alert(qq);
            $(this).parent().parent().parent().siblings('.proprice').html('');
            $(this).parent().parent().parent().siblings('.proprice').html('Rs.'+qq);
            
        }
        
    }));
    
    $(document).on('click','.btn-pluss',(function(e){
        var v = $(this).siblings('#nitem').val();
        var x = parseInt(v)+1;
        $(this).siblings('#nitem').val(x);
        var q = $(this).parent().parent().parent().siblings().find('#aprice').val();
        
            var ex = q.split('-');
            var qq = parseFloat(parseFloat(ex[1])*parseFloat(x)).toFixed(2);
            //alert(qq);
            $(this).parent().parent().parent().siblings('.proprice').html('');
            $(this).parent().parent().parent().siblings('.proprice').html('Rs.'+qq);
    }));
    $(document).on('click', '.buybtn', function (e) {
        
        
            $(this).siblings('.atcbtn').val(2);
            $(this).siblings('.atcbtn').click();
        
    });
    
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
                    $('#cart-slow-motionB').html('');
                     $('#cart-slow-motionB').html(data);
                     $('#alerthbtn').click();
                   //alert(data);
                    

                }
            });
            
        }else{
            $('#cart-slow-motionB').html('');
             $('#cart-slow-motionB').html('Please login to add product in your wishlist');
             $('#alerthbtn').click();
            //alert('Please login to add product in your wishlist');
            $(this).attr('class','fa fa-heart-o');
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
                   $('#cart-slow-motionB').html('');
                     $('#cart-slow-motionB').html(data);
                     $('#alerthbtn').click();
                    

                }
            });
            
        }else{
            $('#cart-slow-motionB').html('');
                     $('#cart-slow-motionB').html('Please login to add product in your wishlist');
                     $('#alerthbtn').click();
            //alert('Please login to add product in your wishlist');
            $(this).attr('class','fa fa-heart');
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
    var bv = $('.atcbtn').val();
    //alert(bv);
    $("#submit").addClass('disabled');
    //$("#submit").text('please wait....'); 
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
         
         $('#cart-slow-motionB').html('');
         $('#cart-slow-motionB').html('this item added in your cart successfully..');
         $('#alerthbtn').click();
        //alert('this item added in your cart successfully..');
        if(bv == 2){
                       window.location.href="<?php echo base_url('checkout') ?>";
                     }else{
                        location.reload(); 
                     }
        

     }  
     });  
 }));
 $(document).on('change', '#aprice', function (e) {
     var str = $(this).val();
        var res = str.split("-");
        var v = res[1];
        $(this).parent().siblings('.proprice').html('Rs.'+v);
        $(this).parent().siblings('.product_stock').find('#nitem').val(1);
     
 });
    /*$(document).on('change', '#aprice', function (e) {
        var str = $(this).val();
        var res = str.split("-");
        var v = res[3];
        $(this).parent().siblings('.product_stock').find('#nitem').val(1);
        var vx = $(this).parent().siblings('.product_stock').find('#nitem').val();
        var vvx = parseFloat(parseFloat(res[1])*parseFloat(vx)).toFixed(2);
        $(this).parent().siblings('.proprice').html('');
        $(this).parent().siblings('.proprice').html('Rs.'+vvx);
        
        
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
            
        });*/
        
});
</script>
<script src='<?php //echo base_url() ?>assets/js/xzoom.min.js'></script>