

<?php include'inc/slider.php' ?>
<section>
    <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="heading-new-h2 layoutheading">
              <h2>Our Products</h2>
            </div>
          </div>
        </div>
        <div class="row row-media">
            <div class="col-lg-12 col-12 p-1"><br><br><br><br></div>
            <div class="col-lg-3 col-6 p-1">
                <div class="offer_single_image">
                    <a href="<?php echo base_url() ?>shop/organic-vegetables">
                  <figure><img src="<?php echo base_url() ?>assets/images/veg.jpg" class="img-fluid" alt="">
                    <div class="offer-image-overlay">
                    </div>
                  </figure>
                      <!--<p class="scapt">Organic Veggies</p>-->
                    </a>
                </div>
            </div>
          
            <div class="col-lg-3 col-6 p-1">
                <div class="offer_single_image">
                    <a href="<?php echo base_url() ?>shop/organic-greens">
                        <figure><img src="<?php echo base_url() ?>assets/images/green-veg.jpg" class="img-fluid" alt="">
                            <div class="offer-image-overlay"></div>
                        </figure>
                        <!--<p class="scapt"> Organic Greens</p>-->
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6 p-1">
                <div class="offer_single_image">
                    <a href="<?php echo base_url() ?>shop/organic-fruits">
                        <figure><img src="<?php echo base_url() ?>assets/images/organic-fruit.jpg" class="img-fluid" alt="">
                            <div class="offer-image-overlay"></div>
                        </figure>
                        <!--<p class="scapt" >Organic Fruits</p>-->
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6 p-1">
                  <div class="offer_single_image">
                    <?php   foreach($products as $product){ if($product['id'] == 30){ ?>
                        <a href="<?php echo base_url('shop/'.$product['slug']) ?>">
                            <figure><img src="<?php echo base_url() ?>assets/images/staples.jpg" class="img-fluid" alt="">
                                <div class="offer-image-overlay"></div>
                            </figure>
                            <!--<p class="scapt">Staples</p>-->
                        </a>
                    <?php }} ?>
                </div>
            </div>
            <div class="col-lg-3 col-6 p-1">
                <div class="offer_single_image">
                    <a href="<?php echo base_url() ?>shop/millets">
                        <figure><img src="<?php echo base_url() ?>assets/images/Millets.jpg" class="img-fluid" alt="">
                            <div class="offer-image-overlay"></div>
                        </figure>
                        <!--<p class="scapt">Millets</p>-->
                  </a>
                </div>
            </div>
            <div class="col-lg-3 col-6 p-1">
                <div class="offer_single_image">
                    <a href="<?php echo base_url() ?>shop/Vegetable-and-Fruit-baskets">
                        <figure><img src="<?php echo base_url() ?>assets/images/baskets.jpg" class="img-fluid" alt="">
                            <div class="offer-image-overlay"></div>
                        </figure>
                        <!--<p class="scapt">Vegetables And Fruits Baskets </p>-->
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6 p-1">
                <div class="offer_single_image">
                    <a href="<?php echo base_url() ?>shop/Assorted-Leafy-Greens">
                        <figure><img src="<?php echo base_url() ?>assets/images/assorted_greens.jpg" class="img-fluid" alt="">
                            <div class="offer-image-overlay"></div>
                        </figure>
                        <!--<p class="scapt"  >Assorted Greens</p>-->
                    </a>
                </div>
            </div>
            <div class="col-lg-3  col-6 p-1">
                <div class="offer_single_image">
                    <a href="<?php echo base_url() ?>shop/others">
                        <figure><img src="<?php echo base_url() ?>assets/images/other.jpg" class="img-fluid" alt="">
                            <div class="offer-image-overlay"></div>
                        </figure>
                        <!--<p class="scapt">Others</p>-->
                    </a>
                </div>
            </div>
            <div class="col-lg-12 col-6 p-1"><br>      </div>
            <div class="col-lg-3  col-6 p-1">
                <div class="offer_single_image">
                    <a href="#">
                        <figure><img src="<?php echo base_url() ?>assets/images/white.jpg" class="img-fluid" alt="">
                            <div class="offer-image-overlay"></div>
                        </figure>
                        <p class="scapt"  ></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-3  col-6 p-1">
                <div class="offer_single_image">
                    <a href="#">
                        <figure><img src="<?php echo base_url() ?>assets/images/flowers.jpg" class="img-fluid" alt="">
                            <div class="offer-image-overlay"></div>
                        </figure>
                        <!--<p class="scapt" >Flowers</p>-->
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6 p-1">
                <div class="offer_single_image">
                    <a href="#">
                        <figure><img src="<?php echo base_url() ?>assets/images/organic_fertilizers.jpg" class="img-fluid" alt="">
                            <div class="offer-image-overlay"></div>
                        </figure>
                        <!--<p class="scapt">Organic Fertilizers</p>-->
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="Our-basket" class="Our-basket">
    <div class="container">
        <div class="row pt-5">
            <div class="col-lg-12">
                <div class="heading-new-h2">
                    <a class="text-muted" style="position: fixed;" target="_blank" title="Download APP" href="https://play.google.com/store/apps/details?id=com.farmstop">
                        <img width="90" src="<?php echo base_url() ?>assets/img/farmstop-app.png" class="img-fluid" />
                    </a>
                    <h2>Our Baskets</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
                $ct = 11000;
                foreach($basket as $var)
                { ?>
                        <div class="col-lg-4 col-md-12">
                            <div class="baskets-box">
                                <form class="add_cart" did="<?php echo $ct; ?>" method="post">
                                    <img src="<?php echo base_url('admin/uploads/product_variation_images/'.$var['fimage']) ?>" class="img-fluid">
                                    <div class="textboxsize"><span><?php echo $var['attribute_name'] ?></span></div>
                                    <div class="my-3"><?php echo $var['long_description'] ?></div>
                                    <div class="my-2"><span><?php echo $var['short_description'] ?></span></div>
                                    
                                    <?php
                                        $vardetail = $model2->getVariationDetail($var['id']); 
                                        //print_r($vardetail[0]['id']);
                                    ?>
                                    
                                    <input type="hidden" name="attribute_id" value="<?php echo $var['id'] ?>">
                                    <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">    		
                            		
                            		<?php
                                        if(is_null($vardetail[0]['sale_price']) || $vardetail[0]['sale_price'] == '0.00')
                                        {
                                            $sp = $vardetail[0]['regular_price'];
                                        } 
                                        else
                                        {
                                            $sp = $vardetail[0]['sale_price'];
                                        }
                                    ?>
                    									 
                                    <input type="hidden" name="aprice" value="<?php echo $vardetail[0]['regular_price'].'-'.$sp.'-'.$vardetail[0]['weight'].'-'.$vardetail[0]['id'] ?>" />
                                    <input class="form-control" name="nitem" id="nitem" value="1" type="hidden">
                                    
                                    <!--<a href="#">Order Now</a>-->
                                    
                                    <button type="button" class="buybtn btn cart__buy basketnewbtn" >Order Now <span class="fas fa-shopping-basket"></span></button>
                                    <button style="display:none;" value="1" type="submit" id="submit<?php echo $ct; ?>" class="atcbtn btn cartnewbtn" >Add <span class="fa fa-shopping-cart"></span></button>
                                    <div class="rediousBox">
                                        <div class="rediousBoxinner"><span>Rs. <?php echo ($sp/12).'/-' ?></span></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                <?php $ct=$ct+1; } ?>
        </div>
    </div>
</section>
<section class="my-5">
    <div class="counter-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-new-h2">
                      <h2>Subscribe Now!</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="countbox">
                      <p>0 1</p>
                      <div class="linehoer"><span></span></div>
                      <h3>SAVES MONEY</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="countbox">
                        <p>0 2</p>
                        <div class="linehoer"><span></span></div>
                        <h3>SAVES TIME</h3>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="countbox">
                        <p>0 3</p>
                        <div class="linehoer"><span></span></div>
                        <h3>HELPS STOP FOOD WASTAGE</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-new-h2">
                  <h2>How does It Work</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row py-3">
            <div class="col-lg-7">
                <div class="howitwork-box">
                    <img src="<?php echo base_url() ?>assets/images/howitwork.jpg" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-5">
                <div class="howitwork-box">
                    <ul>
                      <li><span class="number-howitwork">01</span></li>
                      <li>We source fresh organic produce from our certified farms and known sources</li>
                      <li><span class="number-howitwork">02</span></li>
                      <li>You could either subscribe to our baskets and desired frequency or order when whenever possible. We recommend a subscription</li>
                      <li><span class="number-howitwork">03</span></li>
                      <li>Your order will de delivered to your door step</li>
                      <li><span class="Queries-howitwork">Any Queries?</span></li>
                      <li><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="row">
        <div class="col-lg-5">
            <div class="img-mission">
                <img src="<?php echo base_url() ?>assets/images/to.jpg" class="img-fluid">
                <div class="rediousBoxMission">
                    <div class="rediousBoxinnerMission"><span>Eat healthy <br>Go Organic</span></div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="box-mission">
                <div class="heading-new-h2">
                    <h2>Our Vision</h2>
                </div>
                <div class="text-mission">
                    <p style="font-size:27px;text-align:justify">We at farmstop practice organic farming with passion and devotion and be a part of creating a sustainable planet. We also help and encourage farmers to take up organic farming and want to lead by example in creating a sustainable environment and have the same amount of passion to deliver farm-fresh, authentic, and genuine organic produce to consumers' doorstep.</p>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Farmstop Video Popup     Note :  not sure from where it is triggering -->
    <div class="modal animated bounce" id="myModalvideo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Our Videos</h4>
                    <button type="button" class="close btn-popup-close" data-dismiss="modal"><span class="close-x" aria-hidden="true">X</span></button>
                </div>
                <div class="modal-body iframe-video">
                    <iframe class="mfp-iframe" src="//www.youtube.com/embed/EAau8pPymb4?autoplay=0" frameborder="0" allowfullscreen=""></iframe>
                </div>
                <div class="modal-footer"></div>
            </div>  
        </div>
    </div>

<script>
        $(document).ready(function(){
            $(document).on('click','.btn-minuss',(function(e){
                var v = $(this).siblings('#nitem').val();
                if(v>1){
                    var x = parseInt(v)-1;
                    $(this).siblings('#nitem').val(x);
                }
                
            }));
            
            $(document).on('click','.btn-pluss',(function(e){
                var v = $(this).siblings('#nitem').val();
                var x = parseInt(v)+1;
                $(this).siblings('#nitem').val(x);
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
                           alert(data);
                            
        
                        }
                    });
                    
                }else{
                    alert('Please login to add product in your wishlist');
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
                           alert(data);
                            
        
                        }
                    });
                    
                }else{
                    alert('Please login to add product in your wishlist');
                    $(this).attr('class','fa fa-heart');
                }
                    
                    
                });
            $(document).on('change', '.aprice', function (e) {
                //alert($(this).val());
                var str = $(this).val();
                var res = str.split("-");
                var v = res[3];
                //alert(res[0]);
                $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.elementpro').html('<h5><span class="iconrate">Rs.'+res[1]+'</span></h5>');
                var cnv = $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.cnv').val();
                
                    $.ajax({
                        type: "GET",
                        url: "<?php echo base_url("Ajaxcontroller/getSatusOfProduct") ?>",
                        data: {v:v},
                        context:this,
                        success: function (data) {
                           if(data == 'out'){
                               $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.submit').empty();
                               $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.submit').html('Product is out of stock.');
                           }else if(data == 'in'){
                               $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.submit').empty();
                               $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.submit').html('<button type="button" class="buybtn btn cart__buy cartnewbtn" >Buy<span class="fas fa-shopping-basket"></span></button><button value="1" type="submit" id="submit'+cnv+'" class="atcbtn btn cartnewbtn" >Add<span class="fa fa-shopping-cart"></span></button>');
                           }else if(data == 'not'){
                               $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.submit').empty();
                               $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.submit').html('Product is not available in stock.');
                           }
                            
            
                        }
                    });
                    
                });
                
            $(document).on('submit','.add_cart',(function(e){
                var qq = $(this).attr('did');
                $('#response_edit').html(" ");
                var bv = $("#submit"+[qq]).val();
                
                $("#submit"+[qq]).attr('disabled','true');
                
                e.preventDefault();
                  $.ajax({
                  url: "<?php echo base_url('Ajaxcontroller/add_item_to_cart') ?>",
                  type: "POST",        
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData:false,  
                  success: function(data){
                    
                    
                    $("#submit"+[qq]).removeAttr('disabled');
                    //$(".add_cart")[qq].reset();
                    $('.add_cart').trigger("reset");
                    
                    $('.add_cart_close').click();
                    $('.mycartfunction').click();
                    
                    
                    var cart = 1;
                                            
                    $.ajax({
                        type: "GET",
                        
                        url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                        data: {cart:cart},
                        success: function (data) {
                            
                            $('#items').empty();
                            $('#items').append(data);
                            $('#itemz').html('');
                            $('#itemz').html(data);
                            if(bv == 2){
                               window.location.href="<?php echo base_url('checkout') ?>";
                             }
                        }
                    });
            
                 }  
                 });  
            }));
            
            
            
            
        });

</script>


