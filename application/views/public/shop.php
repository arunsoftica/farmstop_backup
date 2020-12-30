<section class="bg-light heading-bar">
  <div class="container d-none d-sm-block">
        <div class="row">
          <div class="col-sm-12">
              <h2> <?php  echo str_replace("-"," ",$this->uri->segment(2)); ?></h2>
            </div>
        </div>
    </div>
    <div class="d-block d-sm-none">
            <div class="row">
                <div class="col-12">
                    <div class="cat-slider" >
                         <?php
                    if(isset($products)){
                    foreach($products as $product){
                    ?>
                <li class="nav-item" style="border-style:none;">
                    <a class="nav-link <?php if($this->uri->segment(2)==$product["slug"]){echo 'active';}?>" href="<?php echo base_url('shop/'.$product['slug']) ?>" >
                        <!--<img src="<?php echo 'https://www.test.farmstop.in/admin/uploads/product_images/'.$product['img'] ?>" class="img-fluid">-->
                        <p style="font-size:20px;margin-left:10px;">
                        <?php
                        echo ucwords(str_replace("‘N’","",$product['title']));
                        //echo $product['title']
                        ?></p>
                    </a>
                </li>
                <?php }} ?>
                    </div>
                </div>
            </div>
    </div>
</section>
<section class="bg-white pb-m5">
<div class="container">
  <div class="row pt-3 p-media">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="row d-none d-sm-block">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-1 p-media">
                  <div class="accordion-side">
                 <div class="accordion mb-2" id="accordionExample">
                    <!-- card -->
                    <?php
                    foreach($products as $product){
                        if($product['id'] != 37){
                    ?>
                    
                    <div class="card">
                        <div class="card-header" id="headingTwo<?php echo $product['id'] ?>">
                            <h2 class="mb-0">                 
                                <!--a data-toggle="collapse" data-target="#collapseTwo<?php //echo $product['id'] ?>" aria-expanded="false" aria-controls="collapseTwo"
                                <a href="<?php echo base_url('shop/?c='.$product['slug']) ?>" >
                                -->
                                    <a href="<?php echo base_url('shop/'.$product['slug']) ?>" >
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
                    <?php }} ?>
                    <!-- card -->
                    
                    
                </div>
                </div>
                </div>
            </div>
              
        </div>
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12 col-12">
           <!--div class="row mb-0">
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
              </div-->
  <div class="row mb-5 scroll">
      <?php
$ct = 0;
if(count($variation)>0){
    //echo count($variation);
foreach($variation as $var){ 
if($var['product_id'] != 37){
?>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 p-1 p-media divid" value="<?php echo $ct+1; ?>" divid="<?php echo $ct+1; ?>" >
          <div class="productsnew" style="border-top:    1px solid ;  border-right:  1px solid ;   border-left: 1px solid ;border-bottom:none">
              <form class="add_cart" did="<?php echo $ct; ?>" method="post">
              <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">
                        
            <?php $mPrice = $model2->getMinMaxPrice($var['id']); ?>
                      <?php if(is_null($mPrice['minsp']) || $mPrice['minsp'] == '0.00'){ 
                      $dc = 0;
                      }
                      else{ 
                      $dc = ((($mPrice['minrp']-$mPrice['minsp'])/$mPrice['minrp'])*100);
                      $dc = number_format((float)$dc, 0, '.', '');
                      } ?>
              <div class="row">
                  <div class="col-sm-5 col-5">
                      <span class="wish-icon">
            <i class="
                    <?php
                    if(isset($_SESSION['login_id'])){
                      $res = $model2->getWishlistStatus($var['id'],$_SESSION['login_id']);
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
                    
                    "></i><input type="hidden" name="wishlist" class="wlist" id="wlist" value="<?php echo $var['id']; ?>">
            
            
            </span>
                      <div class="save-price box-shadew"><?php if($dc>0){?>
              GET <?php echo $dc; ?>% OFF<?php }else{?>&nbsp;<?php } ?></div>
                      <div class="img-box">
                   <a href="<?php echo base_url('product/'.$var['pslug'].'/'.$var['attribute_slug']);?>">
                  <img src="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $var['fimage'])) ?>" class="img-responsive img-fluid" alt="">  
                  </a>                 
                </div>
                      <div class="productsnew-title">
                  <!--<h6>Farm Fresh</h6>-->
                  <a href="<?php echo base_url('product/'.$var['pslug'].'/'.$var['attribute_slug']);?>"><?php echo $var['attribute_name'] ?></a>
              </div>
                  </div>
                  <div class="col-sm-7 col-7">
                      <div class="row m-0">
                        <div class="col-sms-4 col-4  p-0">
                          <div class="qnty-selection">
                              <span >
                                <?php $vardetail = $model2->getVariationDetail($var['id']); ?>
                                <input type="hidden" name="attribute_id" class="pull-left" value="<?php echo $var['id'] ?>" >
                      <select class="form-control aprice" name="aprice" required>
                                        <!--<option value="">Select</option>-->
                                        <?php
                                        $cx = 0;
                                            foreach($vardetail as $vdet){ 
                                            if(is_null($vdet['sale_price']) || $vdet['sale_price'] == '0.00'){
                           $sp = $vdet['regular_price'];
                   } else{
                           $sp = $vdet['sale_price'];
                   }
                   if($cx == 0){ $cxpr = $sp; }
                                             echo '<option value="'.$vdet['regular_price'].'-'.$sp.'-'.$vdet['weight'].'-'.$vdet['id'].'">'.$vdet['weight'].'</option>';
                                             $cx = $cx + 1;
                                            }
                                    
                                        ?>
                                      </select>
                              </span>
                          </div>
                      </div>
                      <div class="col-sm-2 col-2">
                      </div>
                      <div class="col-sm-6  col-6 p-0 textquant ">
                          <div class="quantity1 quantity mt10px">                   
                        <div >
                            <div class="btn-minuss" value="1"><span class="fa fa-minus"></span></div>
                            <input class="form-control" name="nitem" id="nitem" value="1" readonly="" style="width:50px">
                            <div class="btn-pluss" value="1"  ><span class="fa fa-plus"></span></div>
                        </div>
                    </div>
                      </div>
                  </div>
                      <div class="itemproductdetail">
                  <div class="elementpro">
                      <h5><span class="iconrate">Rs.<?php echo $cxpr;  ?></span></h5>
                  </div>
                  <div class="clearfix"></div>
                  
                  <div class="row m-0">
                      <div class="col-sms-12 col-12 p-0">
                          <input type="hidden" name="cnv" class="cnv" value="<?php echo $ct; ?>" />
                          <div class="text-center-flex submit">
                              <?php if($var['inventory_status'] == 0){ ?>
                              <button type="button" class="buybtn btn cart__buy cartnewbtn mrginright2px" >Buy <span class="fas fa-shopping-basket"></span></button>
                          
                          <button value="1" type="submit" id="submit<?php echo $ct; ?>" class="atcbtn btn cartnewbtn" >Add <span class="fa fa-shopping-cart"></span></button>
                              <?php }else{ echo 'Out of stock'; } ?>
                          
                          </div>
                      </div>
                      
                  </div>
              </div>
                  </div>
              </div>
              
              </form>
          </div>
      </div>
      
      <?php $ct = $ct + 1; }}}else{
           echo '<div class="col-sm-12"><p align="center">No Product Found.</p></div>';
       } ?>
       
       
       <div class="smileyo">
      <div class="cssload-preloader">
          <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
         </div>
  </div>
      
      
      
      
            
  </div>
</div>
</div>
</div>
</section>

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
    //lakshman

    var timeout;

 $(window).scroll(function() {
         if($('.divid').last().attr('value') == $('.divid').last().attr('divid')){
             clearTimeout(timeout);  
        timeout = setTimeout(function() {
            if(($(window).scrollTop() + $(window).innerHeight()) >= $(document).height()-1000){
          
               
           var ur = "<?php echo $this->uri->segment(2).','.$this->uri->segment(3).','.$this->uri->segment(4) ?>";
           var s = "https://<?php echo $_SERVER['HTTP_HOST'] ?><?php echo $_SERVER['REQUEST_URI'] ?>";
           
           
           
           
           var c = "<?php if(isset($_GET['c'])) echo $_GET['c'] ?>";
           var flag = $('.divid').last().attr('value');
           alert($_SERVER['REQUEST_URI']);
           $('.divid').last().attr('divid',flag+20);
           //alert($('.divid').last().attr('value'));
           $('.smileyo').show();
           //$('html, body').css('overflowY', 'hidden');
          
           
       }
        }, 50);
         }
        
    });

    
    
    $(document).on('click','.btn-minuss',(function(e){
        var v = $(this).siblings('#nitem').val();
        if(v>1){
            var x = parseInt(v)-1;
            $(this).siblings('#nitem').val(x);
            var q = $(this).parent().parent().parent().siblings().find('.aprice').val();
            var ex = q.split('-');
            var qq = parseFloat(parseFloat(ex[1])*parseFloat(x)).toFixed(2);
            
            $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.elementpro').html('');
            $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.elementpro').html('<h5><span class="iconrate">Rs.'+qq+'</span></h5>');
            
        }
        
    }));
    
    $(document).on('click','.btn-pluss',(function(e){
        var v = $(this).siblings('#nitem').val();
        var x = parseInt(v)+1;
        $(this).siblings('#nitem').val(x);
        var q = $(this).parent().parent().parent().siblings().find('.aprice').val();
            var ex = q.split('-');
            var qq = parseFloat(parseFloat(ex[1])*parseFloat(x)).toFixed(2);
            
            $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.elementpro').html('');
            $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.elementpro').html('<h5><span class="iconrate">Rs.'+qq+'</span></h5>');
    }));
    $(document).on('click', '.buybtn', function (e) {
        
        
            $(this).siblings('.atcbtn').val(2);
            $(this).siblings('.atcbtn').click();
        
    });
    $(document).on('click', '.open_modal', function (e) {
        $('.submit').html();
        $('.submit').html('<button type="submit" id="submit" class="btn btn-primary  btn-cart">Add to Cart</button>');
        $('select[name=aprice').val('');
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
                   $('#cart-slow-motionB').html('');
                     $('#cart-slow-motionB').html(data);
                     $('#alerthbtn').click();
                    

                }
            });
            
        }else{
            $('#cart-slow-motionB').html('');
             $('#cart-slow-motionB').html('Please login to add product in your wishlist');
             $('#alerthbtn').click();
            //alert($(this).attr('class'));
            $(this).attr('class','fa fa-heart-o');
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
                   $('#cart-slow-motionB').html('');
                     $('#cart-slow-motionB').html(data);
                     $('#alerthbtn').click();
                    

                }
            });
            
        }else{
            $('#cart-slow-motionB').html('');
                     $('#cart-slow-motionB').html('Please login to add product in your wishlist');
                     $('#alerthbtn').click();
            
            $(this).attr('class','fa fa-heart');
        }
            
            
        });
    /*$(document).on('change', '.aprice', function (e) {
        
        var str = $(this).val();
        var res = str.split("-");
        $(this).parent().parent().parent().siblings('.textquant').find('#nitem').val(1);
        var zz = $(this).parent().parent().parent().siblings('.textquant').find('#nitem').val();
        var zzz = parseFloat(parseFloat(zz)*parseFloat(res[1])).toFixed(2);
        ///alert(zzz);
        $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.elementpro').html('');
        
        var v = res[3];
        $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.elementpro').html('<h5><span class="iconrate">Rs.'+zzz+'</span></h5>');
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
                   $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.submit').html('<button type="button" class="buybtn btn cart__buy cartnewbtn mrginright2px" >Buy<span class="fas fa-shopping-basket"></span></button><button value="1" type="submit" id="submit'+cnv+'" class="atcbtn btn cartnewbtn" >Add<span class="fa fa-shopping-cart"></span></button>');
               }else if(data == 'not'){
                   $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.submit').empty();
                   $(this).parent().parent().parent().parent().siblings('.itemproductdetail').find('.submit').html('Product is not available in stock.');
               }
                

            }
        });
            
        });*/
        
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
            $(".add_cart")[qq].reset();
            
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

