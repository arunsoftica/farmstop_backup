*Free shipping for orders 999 and above

<?php
if(isset($_SESSION['login_id'])){ ?>

<style>
      .razorpay-payment-button {
        color: #ffffff !important;
        background-color: #7266ba;
        border-color: #7266ba;
        font-size: 14px;
        padding: 10px;
      }
    </style>
<section class="bg-light heading-bar">
	<div class="container">
        <div class="row">
        	<div class="col-sm-12">
            	<h2>Checkout</h2>
            </div>
        </div>
    </div>
</section>
<section class="bg-light mt-0 mb-0 pb-m5">
	<div class="container">
        <form id="checkout" method="post">
            <div class="row checkout__row">
            <div class="col-12 col-lg-8 mb-4 line_right__border">
      <div class="multisteps-form__progress">
        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">Information <span class="fa fa-angle-right"></span></button>
        <button class="multisteps-form__progress-btn" type="button" title="Business details">Shipping <span class="fa fa-angle-right"></span></button>
        <button class="multisteps-form__progress-btn" type="button" title="Payment">Payment </button>
      </div>
      <div class="boxdivform multisteps-form__form">
           <!--single form panel-->
        <div class="multisteps-form__panel p-4 rounded bg-white js-active" data-animation="scaleIn">
            <p id="cvmsg" style="color:white;background-color:red;"></p>
          <div class="d-flex"><h4 class="multisteps-form__title">Contact Information</h4><!--<span class="ml-auto">Already have an account? <a href="#" class="textleftright">LogIn</a></span>--></div>
          <div class="multisteps-form__content">
            <div class="form-row mt-4">
              <div class="col-12 col-sm-12">
                  <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">
                  
                <input required placeholder="Enter Email*" name="email" id="email" class="multisteps-form__input form-control" type="email" value="<?php if(isset($_SESSION['login_email'])) echo $_SESSION['login_email']; ?>" />
              </div>
              <!--<div class="col-12 col-sm-12 mt-2">
                  <input type="checkbox"> Keep me up to date on news and exclusive offers
              </div>-->
            </div>
            <h4 class="multisteps-form__title mt-4">Shipping Address</h4>
            <div class="form-row mt-4">
              <div class="col-12 col-sm-6">
                <input required placeholder="Enter Name*" name="name" id="name" class="multisteps-form__input form-control" value="<?php if(isset($_SESSION['login_name'])) echo $_SESSION['login_name']; ?>" type="text" />
              </div>
              <div class="col-12 col-sm-6">
                 <input required placeholder="Enter Mobile No.*" id="mobile" name="mobile" class="multisteps-form__input form-control" value="<?php if(isset($_SESSION['login_mobile'])) echo $_SESSION['login_mobile']; ?>" type="number"/>
              </div>
              
            </div>
            <div class="form-row mt-4">
            <div class="col-sm-12">
                <h5 class="headding_subtitle">Choose your location</h5>
            </div>
            <div class="col-sm-6">
                                <label>
                                <input type="radio" class="ulive" checked="" value="1" name="ulive" id="ulive1"> Apartment
                                </label>&nbsp;&nbsp;
                                <label>
                                <input type="radio" class="ulive" value="2" name="ulive" id="ulive2"> Location/Area
                                </label>
                                </div>
            <div class="col-12 col-sm-6 apdiv">
                 <select name="apartment" id="apartment" class="apartmentselect multisteps-form__input form-control">
<option value="">Select Apartment</option>
                    <?php foreach($apartments as $apart){ ?>
                    <option value="<?php echo $apart['id'] ?>"><?php echo $apart['apartment'].'('.$apart['location'].')' ?></option>
                    <?php } ?>
                    
  </select>
              </div>
            </div>
            <div class="form-row mt-4">
                <div class="col-sm-12">
                <h5 class="headding_subtitle">Select Address</h5>
            </div>
            <?php foreach($uaddress as $uadrs){ ?>
               <div class="col-12 col-sm-6">
                   <label>
                       <input type="radio" class="usadrs" name="sua" value="<?php echo $uadrs['address'].'@'.$uadrs['district'].'@'.$uadrs['country'].'@'.$uadrs['zipcode'] ?>" id="usadrs<?php echo $uadrs['id'] ?>"><?php echo $uadrs['address'].' '.$uadrs['district'].' '.$uadrs['country'].' '.$uadrs['zipcode'] ?>
                    </label>
               </div>
               <?php } ?>
               <!--<div class="col-12 col-sm-6">
                   <label>
                       <input type="radio" class="searchby" checked="" value="1" name="choosebyaddress" id=""> kanpur Bengaluru 560070 India
                    </label>
                </div>-->
            </div>
            <div class="form-row mt-4">
              <div class="col-12 col-sm-6">
                  <textarea row="2" required placeholder="Flat no./House no./Building*" name="address" id="address" class="addresss multisteps-form__input form-control"></textarea>
                
              </div>
                 <div class="col-12 col-sm-6">
                <select name="state" id="state" class="state multisteps-form__input form-control" required>
                    <!--<option value="">Select State*</option>-->
                    
                    <option value="Karnataka">Karnataka</option>
                </select>
                
              </div>
              
              
            </div>
            <div class="form-row mt-4">
              <div class="col-12 col-sm-4">
                <input required placeholder="Pincode*" name="pin" id="pin" class="pin multisteps-form__input form-control" type="text"/>
              </div>
              <div class="col-12 col-sm-4">
                  <input type="text" name="district" id="district" class="district form-control" placeholder="Your District" value="Bengaluru" readonly />
                
              </div>
              <div class="col-12 col-sm-4">
                <input placeholder="Your Country" name="country" id="country" class="country multisteps-form__input form-control country" type="text"
                value="India" readonly
                />
              </div>
              </div>
            <div class="form-row mt-4">
              
            <div class="button-row btn-right-submit ml-auto">
              <button class="btn btn-success ml-auto cts" value="0" type="button" title="Next">Continue to shipping</button>
              <p class="mt-4"><b>Note:</b> If you reside in an apartment, please mention the Block/wing details and Door the Number. If otherwise kindly mention the complete address for a hasslefree delivery.Thanks :)</p>
            </div>
          </div>
        </div>
        </div>
        <!--single form panel-->
        <div class="multisteps-form__panel p-4 rounded bg-white" data-animation="scaleIn">
          <h3 class="multisteps-form__title">Shipping</h3>
          <div class="multisteps-form__content">
            <div class="form-row mt-4">
             <div class="col-12 col-sm-12">
                <div class="border__1">
                    <div class="d-flex">
                        <span>Contact </span>
                        <span> &nbsp;&nbsp;&nbsp;<?php if(isset($_SESSION['login_mobile'])) echo $_SESSION['login_mobile']; ?> </span> 
                        <span class=ml-auto><a href="javascript:void(0)" class="textleftright js-btn-prev" title="Prev">Change</a> </span>
                    </div>
                    <div class="line-horizantal"></div>
                    <div class="d-flex">
                        <span>Ship to </span>
                        <span class="sadrs"> &nbsp;&nbsp;&nbsp;govind nagar kanpur,India </span> 
                        <span class=ml-auto>
                            <a href="javascript:void(0)" class="textleftright js-btn-prev" title="Prev">Change</a>
                            <!--<button class="btn btn-primary js-btn-prev" type="button" title="Prev">Return to information</button>-->
                            </span>
                    </div>
                </div>
                <h4 class="multisteps-form__title my-4">Shipping Method</h4>
                    <div class="border__1">
                            <div class="d-flex">
                                <div class="radio w-50">
                                <label><input type="radio" name="stship" checked> Standard Shipping</label>
                                <p>*Free shipping for orders Rs.999/- and above</p>
                                
                                </div>
                                <span class=ml-auto><span class="textleftright stship">Rs. 0</span> </span>
                            </div>
                    </div>
                    
                    <!--<h4 class="multisteps-form__title my-4">Delivery Details</h4>
                    <div class="border__1">
                            <div class="d-flex">
                                <div class="radio w-50">
                                <label>Delivery Date*</label>
                                
                                </div>
                                <span class=ml-auto><span class="textleftright ">
                                    
                                    <input name="delivery_date" class="col-12 form-control DateFrom" placeholder="dd/mm/yy" id="depart" readonly="readonly" required></span> </span>
                            </div>
                            <div class="line-horizantal"></div>
                            <div class="d-flex">
                                <div class="radio w-50">
                                <label>Select Time Slot*</label>
                                
                                </div>
                                <span class=ml-auto><span class="textleftright ">
                                    
                                    <select name="timeslot" id="timeslot" class="form-control col-12" required aria-required="true">
                    	               <option value=""></option>
                    	               <option value="1">08:00 AM-12:00 PM</option>
                                       <option value="2">12:00 PM-04:00 PM</option>
                                       <option value="3">04:00 PM-08:00 PM</option>
                                    </select>
                                </span> </span>
                            </div>
                    </div>-->
                    
                            
                   
              </div>
            <div class="button-row w-100 d-flex mt-4">
                <div class="mr-auto">
                    <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Return to information</button>
                </div>
              <div class="ml-auto">
                  <button class="btn btn-success ctp" value="0" type="button" title="Next">Continue to Payment</button>
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="multisteps-form__panel p-4 rounded bg-white" data-animation="scaleIn">
          <h3 class="multisteps-form__title">Payment</h3>
          <div class="multisteps-form__content">
            <div class="form-row mt-4">
             <div class="col-12 col-sm-12">
                
            
                    <div class="border__1">
                        <div class="">
                            <div class="radio w-100 d-flex">
                            <label class="w-100 d-flex">
                                <input class="mt-1" type="radio" id="razor" name="optradio" value="4" checked>&nbsp;&nbsp; <img src="<?php echo base_url() ?>assets/images/Razorpay_logo.png" class="img-fluid " style="margin-top: -10px;">
                            <span class=ml-auto>
                                <ul class="img-hover-overlay">
                                   <li><img class="img-hover" src="<?php echo base_url() ?>assets/images/visa.png"></li>
                                   <li><img class="img-hover" src="<?php echo base_url() ?>assets/images/rupay.png"></li>
                                   <li><img class="img-hover" src="<?php echo base_url() ?>assets/images/mastercard.png"></li>
                                </ul>
                            </span>
                            </label>
                            
                            
                            </div>
                            <div class="line-horizantal"></div>
                            <div class="radio w-100 d-flex">
                            <label class="w-100 d-flex"><input class="mt-1" type="radio" id="cod" name="optradio" value="2">&nbsp;&nbsp;  Cash on Delivery
                            </label>
                            
                            
                            </div>
                        </div>
                        <div class="line-horizantal"></div>
                        <div class="form-group">
                              <input type="checkbox" name="readtc" required> I have read and agree to the website <a href="<?php echo base_url('privacy-policy'); ?>" target="_blank">Terms and Conditions</a>.
                         </div>
                        </div>
            </div>
            </div>
            
            <div class="row">
              <div class="button-row d-flex mt-4 col-12">
                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Return to shipping</button>
                
                <?php if(isset($_SESSION['login_id'])){ ?>
                  
                  <button type="submit" name="submit" id="osubmit" class="btn btn-success ml-auto">Place Order</button>
                  
             <?php } else { ?> 
             
             <button type="button" name="orderbtn" id="orderbtn" class="btn btn-success ml-auto">Place Order</button>
             
             <?php } ?>
                
              </div>
            </div>
          </div>
        </div>
      </div>
       
      
    </div>
            <div class="col-12 col-lg-4 mb-4">
                <div class="right-table-stru">
                    <h2 class="order-summry">Order Summary</h2>
                    <table class="table" id="cartitem" border="0">
                        <!--<tr>
                            <td>Foxtail Millet</td>
                            <td>Qty: 5</td>
                            <td>Rs.45.00</td>
                        </tr>
                        <tr>
                            <td>Foxtail Millet</td>
                            <td>Qty: 5</td>
                            <td>Rs.45.00</td>
                        </tr>-->
                        
                    </table>
                </div>
                <!--<div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Discount Code" />
                            </div>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-dark" type="button">Apply</button>
                        </div>
                    </div>
                <div class="total__priceBox">
                <table class="table" border="0">
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-aligttd">Rs. 200</td>
                        </tr>
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-aligttd">Rs. 200</td>
                        </tr>
                    </table>
                </div>
                <div class="Ptotal__priceBox">
                <table class="table" border="0">
                    <td>Total</td>
                    <td class="text-aligttd">Rs. 300</td>
                </table>
                </div>-->
            </div>
            </div>
        </form>
        
      </div>
</section>
<section class="bg-light mt-0 mb-0">
	<div class="container">
        

    <button type="button" id="submit_cod" class="btn btn-primary btn-cart" data-toggle="modal" data-target="#myModal">SUBMIT COD</button>
    						<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">OTP has been sent to your mobile number +91 <p id="mob_otp"></p> for order(COD)</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="codform" method="post">
      <!-- Modal body -->
      <div class="modal-body">
            Enter OTP
            <input type="text" name="otp" class="form-control" />
            <p id="response_edit"></p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="submit" name="cod_submit" id="cod_submit" class="btn btn-success" >Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="coupon-code" tabindex="-1" role="dialog" aria-labelledby="product-modalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product-modalTitle">Coupon Code</h5>
        <button type="button" class="close closed" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body product-details">
            <div class="row">
                <div class="col-lg-12">
<?php if(count($coupans) > 0){ ?>
<?php foreach($coupans as $coupon){ 
    if($coupon['code_type'] == 'p'){
        $ctype = '%';
    }else if($coupon['code_type'] == 'a'){
        $ctype = 'Rs.';
    }
?>
<div class="custom-control custom-radio mb-2">
  <input type="radio" class="custom-control-input coupon" id="code<?php echo $coupon['id'] ?>" value="<?php echo $coupon['code'].','.$coupon['code_type'].','.$coupon['code_value'].','.$coupon['id'] ?>" name="coupon_code">
  <label for="code<?php echo $coupon['id'] ?>" class="custom-control-label" ><?php echo $coupon['code'].'( Get '.$coupon['code_value'].' '.$ctype.' off)' ?></label>
</div>
<?php } } else{ echo 'No coupons are available.';} ?>
                </div>
            </div><!-- /.row -->
      </div>
    </div>
  </div>
</div>
    <form id="go_success" method="post" action="<?php echo base_url('thankyou') ?>">
        <input type="hidden" name="postvar" value="success"/>
    </form>
    <div id="postForms">
        
    </div>
    <div id="razor">
      <form class="postFormsRazor" id="postFormsRazor" action="<?php echo base_url('order-list') ?>" method="POST">
    <!-- Note that the amount is in paise = 50 INR -->
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_test_UZAcQOZFtEtGvt"
        data-amount="100"
        data-buttontext="Pay with Razorpay"
        data-name="Softica Technologies"
        data-description="Product Payment"
        data-image="https://your-awesome-site.com/your_logo.jpg"
        data-prefill.name="<?php if(isset($_SESSION['login_name'])) echo $_SESSION['login_name']; ?>"
        data-prefill.email="<?php if(isset($_SESSION['login_email'])) echo $_SESSION['login_email']; ?>"
        data-theme.color="#F37254"
    ></script>
    <input type="hidden" value="Hidden Element" name="hidden">
    </form>  
    </div>
</section>

<script>
$(document).ready(function(){
           $('#pin').val('');
           $('#submit_cod').hide();
         
           $('.razorpay-payment-button').hide();
           //$('.apply-coupon').hide();
           var cart = 3;
            
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                data: {cart:cart},
                success: function (data) {
                    
                    if(data == 'no-item'){
                        $('#checkout').empty();
                        $('#checkout').html('<div class="text-center p-3"><p>There are no items in your shopping cart.</p><a href="shop" style="font-size:22px; color:#000;">Return to shop</a></div>');
                    }else{
                        var cart = 4;
                        $.ajax({
                            type: "GET",
                            
                            url: "<?php echo base_url("Ajaxcontroller/show_item_to_checkout") ?>",
                            data: {cart:cart},
                            success: function (data) {
                                
                                $('#cartitem').empty();
                                $('#cartitem').html(data);
                                var tl = $('#total').val();
                                if(parseInt(tl) < parseInt(360)){
                                    $('.cts').attr('disabled','true');
                                    $('#cvmsg').html('Total cart value should be greater than or equal to 360.<a href="shop">Shop More</a>');
                                    
                                }
                                
                            }
                        });
                    }
                    
                }
            });
            
            $(document).on('click','.cts',(function(e){
                if($(this).val() == 0){
                    var adrs = $('.addresss').val();
                    var dis = $('.district').val();
                    var st = $('.state').val();
                    var cn = $('.country').val();
                    var pin = $('.pin').val();
                    //var apr = $('.apartmentselect').val();
                    if(st == '' || dis == '' || adrs == '' || cn == '' || pin == '' ){
                        //$(this).attr('disabled','true');
                        alert('All * fields are required');
                    }else{
                        //$(this).attr('disabled','false');
                        $('.sadrs').html('');
                    $('.sadrs').html('&nbsp;&nbsp;&nbsp;'+adrs+' '+dis+' '+st+' '+cn+'-'+pin);
                    $(this).val(1);
                    $('.cts').addClass('js-btn-next');
                    $('.cts').click();
                }
                }
                
                
                
            }));
            
            $(document).on('click','.ulive',(function(e){
                var v = $(this).val();
                /*alert(v);*/
                if(v == 1){
                    $('.apdiv').show();
                }else if(v == 2){
                    $('.apdiv').hide();
                }
                
            }));
            
            $(document).on('click','.usadrs',(function(e){
                var v = $(this).val();
                var ex = v.split('@');
                $('#address').val(ex[0]);
                $('#pin').val(ex[3]);
                $('#pin').blur();
                
            }));
            
            $(document).on('click','.ctp',(function(e){
                if($(this).val() == 0){
                    var dd = $('.DateFrom').val();
                    //var ts = $('#timeslot').val();
                    
                    if(dd == ''){                    //$(this).attr('disabled','true');
                        alert('All * fields are required');
                    }else{
                        //$(this).attr('disabled','false');
                    $(this).val(1);    
                    $('.ctp').addClass('js-btn-next');
                    $('.ctp').click();
                    }
                }
                
                
                
            }));
           
            
            $(document).on('submit','#checkout',(function(e){
            
            //$("#osubmit").addClass('disabled');
            $("#osubmit").attr("disabled", true);
            $("#osubmit").text('please wait....'); 
            e.preventDefault();
              $.ajax({
              url: "<?php echo base_url('Ajaxcontroller/go_to_payment') ?>",
              type: "POST",        
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData:false,  
              success: function(data){
                
                var parseJson = jQuery.parseJSON(data);
                var hello = 1;
                $.ajax({
                    type: "GET",
                    
                    url: "<?php echo base_url("Ajaxcontroller/delete_all_item_from_cart") ?>",
                    data: {hello:hello},
                    success: function (data) {
                       
                    }
                });
                
                if(parseJson.pay_u[0] == 1){
                    var html_content = '';
                        html_content += '<form id="postForm" name="postForm" action="https://secure.payu.in/_payment" method="post">';
                        html_content += '<input type="hidden" name="key" value="'+parseJson.pay_u[1]+'" />';
                        html_content += '<input type="hidden" name="hash" value="'+parseJson.pay_u[3]+'"/>';
                        html_content += '<input type="hidden" name="txnid" value="'+parseJson.pay_u[4]+'"/>';
                        html_content += '<input type="hidden" name="amount" value="'+parseJson.pay_u[5]+'" />';
                        html_content += '<input type="hidden" name="firstname" value="'+parseJson.pay_u[6]+'" />';
                        html_content += '<input type="hidden" name="email" value="'+parseJson.pay_u[7]+'" />';
                        html_content += '<input type="hidden" name="phone" value="'+parseJson.pay_u[8]+'" />';
                        html_content += '<input type="hidden" name="productinfo" value="'+parseJson.pay_u[9]+'" />';
                        html_content += '<input type="hidden" name="service_provider" value="payu_paisa" size="64" />';
                        html_content += '<input type="hidden" name="surl" value="'+parseJson.pay_u[10]+'" />';
                        html_content += '<input type="hidden" name="furl" value="'+parseJson.pay_u[11]+'" />';
                        html_content += '</form>';
                        $('#postForms').empty();
                        $('#postForms').html(html_content);
                        $('#postForm').submit();
                }
                else if(parseJson.pay_u[0] == 4){
                    
                        window.location.href = "<?php echo base_url('razor1') ?>";
                        //$('#postFormsRazor').submit();
                    
                }else if(parseJson.pay_u[0] == 2){
                        /* disable otp*/
                        /*$('#mob_otp').html();
                        $('#mob_otp').html(parseJson.pay_u[1]);
                        $("#submit_cod").click();*/
                        /*alert('Thanks for your order. We will contact you soon.');*/
                        $('#go_success').submit();
                }
             }  
             });  
            }));
            
            $(document).on('submit','#codform',(function(e){
            
            //$("#cod_submit").addClass('disabled');
            $("#cod_submit").attr("disabled", true);
            $("#cod_submit").text('please wait....'); 
            e.preventDefault();
              $.ajax({
              url: "<?php echo base_url('Ajaxcontroller/verify_otp_cod') ?>",
              type: "POST",        
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData:false,  
              success: function(data){
                var parseJson = jQuery.parseJSON(data);
                
                if(parseJson.verify_otp[0] == 'yes'){
                        
                    //window.location.href = "<?php //echo base_url('success') ?>";
                    $('#go_success').submit();
                }else if(parseJson.verify_otp[0] == 'no'){
                    $('#response_edit').html();
                    $('#response_edit').html('Incorrect OTP');
                    $('#cod_submit').attr("disabled", false);
                    $("#cod_submit").text('Submit');
                }
               
             }  
             });  
            }));
            
            $(document).on('blur','#pin', function (e){
                
             var pin = $("#pin").val();
             var ta = $("#total1").val();
             //alert(ta);
              if(pin != ""){
                  $.ajax({
                  url: "Ajaxcontroller/getShippingCost",
                  type: "GET",           
                  data: {pin:pin,ta:ta},
                  success: function(data){
                        if(data != 'no'){
                            $("#osubmit").attr("disabled", false);
                            //alert(data);
                             $('#shippingcost').html();
                             $('#shippingcost').html("₹ "+data);
                             $('.stship').html();
                             $('.stship').html("₹ "+data);
                             $('#total').val(parseInt(ta)+parseInt(data));
                             $('#shipping').val(data);
                             $('#total_amount').html();
                             $('#total_amount').html(parseInt(ta)+parseInt(data));
                             $('#net_total').html();
                             $('#net_total').html('<span class="woocommerce-Price-currencySymbol">₹ </span>'+(parseInt(ta)+parseInt(data)));
                             //$('.postFormsRazor script').attr('data-amount', (parseInt(ta)+parseInt(data))*100);
                             
                        }else{
                           alert('Delivery is not available in this area');
                           $("#osubmit").attr("disabled", true);
                        }
                      
                    
                   }
                  });
              }
           });
           $(document).on('click','#orderbtn', function (e){
               
               alert('Please login to place your order');
               
           });
           $(document).on('change','.adrs', function (e){
               var str = $(this).val();
               var res = str.split("@");
               $('#address').val(res[0]);
               //$('#district').val(res[1]);
               $('#pin').val(res[2]);
               $("#pin").blur();
           });
            $(document).on('change','.coupon',(function(e){
                var pin = $('#pin').val();
                var cval = $(this).val();
                var res = cval.split(",");
                //alert(res[0]);
                $('.closed').click();
                var pin = $('#pin').val();
                if(pin != ''){
                $('#applied_coupon_code').val(res[0]);
                $('#coupon_code').val(res[3]);
                //var tval = parseInt($('#total1').val())+parseInt($('#shipping').val());
                var tval = parseInt($('#total1').val());
                var net = '';
                if(res[1] == 'p'){
                    var dis = parseInt((parseInt(tval)*parseInt(res[2]))/100);
                    var net = parseInt(tval)-parseInt(dis);
                }else if(res[1] == 'a'){
                    var dis = res[2];
                    var net = parseInt(tval)-parseInt(dis);
                }
                var net = parseInt(net)+parseInt($('#shipping').val());
                $('#total').val(net);
                $('#net_total').empty();
                $('#net_total').html();
                $('#net_total').html('<span class="woocommerce-Price-currencySymbol">₹ </span>'+net);
                }else{
                    alert('First select pincode..');
                }
            }));
            
           
});
</script>
<script>
$(document) .ready(function(e) {
    var minDate = new Date();
	$("#depart") .datepicker({
		showAnim: 'drop',
		numberOfMonth:1,
		/*minDate: minDate,*/
		minDate: +3,
		dateFormat:'dd/mm/yy',
	});
});
</script>

<?php } else { $this->load->view('public/login'); } ?>

