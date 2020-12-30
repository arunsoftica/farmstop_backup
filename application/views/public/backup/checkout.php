<?php
if(!isset($_SESSION['login_id'])){
?>
<section class="m-0">
<div class="row m-0">
         <div class="main-banner" style="position: relative;background: #000;">
            <img class="img-fluid" src="assets/img/banner.jpg" style=" width:100%;max-height: 200px;
    opacity: 0.6;"  />
    		<div class="sidemenu-row mb-2 mt-2">
          	 <ul class="sidmenu">
                      <li><a href="#">Home</a> / </li>
                      <li><a href="#">SignUp</a> / </li>
                      <li class="active">SignUp</li>
                    </ul>
          </div>
        </div>
</div>
</section>

<section>
	<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Login</h3>
                    <form class="form-signin" method="post" id="login_user">
                        <div class="form-group">
                            <input type="text" name="usernm" class="form-control" placeholder="Your Email or Mobile *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="passwd" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input name="submit" id="submit" type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="#" class="ForgetPwd">Forget Password?</a>
                        </div>
                    </form>
                    <ul class="login-social">
                      <li><fb:login-button size="xlarge" scope="public_profile,email" onlogin="checkLoginState();">
                  </fb:login-button></li>
                  <li><div id="gSignInWrapper">
                    <span class="label"></span>
                    <div id="customBtn1" class="customGPlusSignIn">
                      <span class="icon fa fa-google"></span>
                      <span class="buttonText"> Log In</span>
                    </div>
                  </div>
                  <script>startApp();</script></li>
                  </ul>
                    </div>
                <div class="col-md-6 login-form-2">
                    <h3>Sign Up</h3>
                    <form method="post" id="register_user">
                    	<div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Your Mobile No *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="passwd" id="passwd" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="btnSubmit" value="SignUp" />
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
</section>
<script>
$(document).ready(function(){
    $(document).on('submit','#register_user',(function(e){
    var usernm = $('#mobile').val();
    var passwd = $('#passwd').val();
    e.preventDefault();
      $.ajax({
      url: "<?php echo base_url('Ajaxcontroller/register_user') ?>",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        $("#register_user")[0].reset();
        if(data == 'registered'){
            $.ajax({
              url: "Ajaxcontroller/login_user",
              type: "POST",           
              data: {usernm:usernm,passwd:passwd},
              success: function(data){
               if(data == 'yes'){
                    alert('you have registered successfully');
                    location.reload();
                }
                  
                
               }
              });
        }else if(data == 'exist'){
            alert('This email id already exist');
        }
     }  
     });  
 }));
 
});
</script>
<?php } else { ?>
<style>
      .razorpay-payment-button {
        color: #ffffff !important;
        background-color: #7266ba;
        border-color: #7266ba;
        font-size: 14px;
        padding: 10px;
      }
    </style>
<section class="m-0">
<div class="row m-0">
         <div class="main-banner" style="position: relative;background: #000;">
            <img class="img-fluid" src="<?php echo base_url() ?>assets/img/banner.jpg" style=" width:100%;max-height: 200px;
    opacity: 0.6;"  />
    		<div class="sidemenu-row mb-2 mt-2">
          	 <ul class="sidmenu">
                      <li><a href="#">Home</a> / </li>
                      <li><a href="#">Cart</a> / </li>
                      <li class="active">Checkout</li>
                    </ul>
          </div>
        </div>
</div>
</section>
<section class="bg-light mt-0 mb-0">
	<div class="container">
        
<form id="checkout" method="post">
        <div class="row">
            <div class="col-md-12">
            	<div class="heading-text">
                <h4>Billing details</h4>
                </div>
                
                           <div class="row form-group">
                        	<div class="col-sm-6">
                            	<label>Name <span class="text-danger">*</span></label>
                            	<input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required value="<?php if(isset($_SESSION['login_name'])) echo $_SESSION['login_name']; ?>" />
                            </div>
                            <div class="col-sm-6">
                            	<label>Your Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required value="<?php if(isset($_SESSION['login_email'])) echo $_SESSION['login_email']; ?>" />
                            </div>
                          </div>
                          
                           <div class="row form-group">
                        	<div class="col-sm-6">
                            	<label>Your Mobile No <span class="text-danger">*</span></label>
                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Your Mobile No" required value="<?php if(isset($_SESSION['login_mobile'])) echo $_SESSION['login_mobile']; ?>" />
                            </div>
                            <div class="col-sm-6">
                            	<label>Country <span class="text-danger">*</span></label><br />
                            <strong>India</strong>
                            </div>
                          </div>
                          <div class="form-group">
                              <label>Select Address</label>
                        	<?php if(isset($_SESSION['login_id'])){
                        	    foreach($uaddress as $uadrs){ ?>
                        	       <div class="col-sm-6"> 
                        	       <input type="radio" name="adrs" class="adrs" value="<?php echo $uadrs['address'].'@'.$uadrs['district'].'@'.$uadrs['zipcode'] ?>" /><?php echo $uadrs['address'].' '.$uadrs['district'].' '.$uadrs['zipcode'].' '.$uadrs['country'].'<br>' ?> 
                        	           </div>
                        	    <?php } }	?>
                        	    </div>
                            <div class="row form-group">
                                <div class="col-sm-6">
                            	<label>Address <span class="text-danger">*</span></label>
                            <textarea type="text" name="address" id="address" class="form-control" placeholder="Your Address" required ></textarea>
                            </div>
                        	<div class="col-sm-6">
                            	<label>District<span class="text-danger">*</span></label>
                            <input type="text" name="district" id="district" class="form-control" placeholder="Your District" value="" required />
                            </div>
                            
                          </div>
                          <div class="row form-group">
                        	<div class="col-sm-6">
                            	<label>Postcode / ZIP <span class="text-danger">*</span></label>
                            <input type="text" name="pin" id="pin" class="form-control" placeholder="Postcode / ZIP
" required value="" />
                            </div>
                            <div class="col-sm-6">
                            	
                            </div>
                          </div>
                    
           </div>
	</div>
    	<table class="table bg-white">
	<thead>
		<tr>
			<th class="product-name">Product</th>
			<th class="product-total">Total</th>
		</tr>
	</thead>
	<tbody id="cartitem">
							
										
						</tbody>
	
</table>
		<div class="row">
        	<div class="col-sm-12">
            	<div class="bg-white p-3">
        			
        	<div class="form-check pb-3">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" id="online" name="optradio" value="1" checked>Credit Card/Debit Card/NetBanking(PayU money) 
  </label>
</div>
            <div class="form-check pb-3">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" id="razor" name="optradio" value="4">Credit Card/Debit Card/NetBanking(Razorpay) 
              </label>
            </div>
            <div class="form-check pb-3">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" id="cod" name="optradio" value="2"> Cash on delivery
              </label>
            </div>
            <!--div class="form-check pb-0">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" id="dbt" name="optradio" value="3">Direct bank transfer
              </label>
            </div-->
            <hr />
            <div class="form-group">
            	<p class="display-text">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
            </div>
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck-pay" name="readtc" required>
                <label class="custom-control-label" for="customCheck-pay">I have read and agree to the website terms and conditions </label>
              </div>
              <?php if(isset($_SESSION['login_id'])){ ?>
                  
                  <button type="submit" name="submit" id="osubmit" class="btn btn-success mt-0">Place Order</button>
                  
             <?php } else { ?> 
             
             <button type="button" name="orderbtn" id="orderbtn" class="btn btn-success mt-0">Place Order</button>
             
             <?php } ?>
              
              
              
              
            
            
            	</div>
            </div>
        </div>
        
    </div>
    </form>
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
<?php foreach($coupans as $coupon){ 
    if($coupon['code_type'] == 'p'){
        $ctype = '%';
    }else if($coupon['code_type'] == 'a'){
        $ctype = 'Rs.';
    }
?>
<div class="custom-control custom-radio mb-2">
  <input type="radio" class="custom-control-input coupon" id="code<?php echo $coupon['id'] ?>" value="<?php echo $coupon['code'].','.$coupon['code_type'].','.$coupon['code_value'] ?>" name="coupon_code">
  <label for="code<?php echo $coupon['id'] ?>" class="custom-control-label" ><?php echo $coupon['code'].'( Get '.$coupon['code_value'].' '.$ctype.' off)' ?></label>
</div>
<?php } ?>
                </div>
            </div><!-- /.row -->
      </div>
    </div>
  </div>
</div>
    <form id="go_success" method="post" action="<?php echo base_url('order-list') ?>">
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
           $('#submit_cod').hide();
           $('.razorpay-payment-button').hide();
           
           var cart = 3;
            
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                data: {cart:cart},
                success: function (data) {
                    
                    if(data == 'no-item'){
                        $('#checkout').empty();
                        $('#checkout').html('<div style="padding:10px;background-color:white;">There are no items in your shopping cart.<br><br><a href="shop">Return to shop</a></div>');
                    }else{
                        var cart = 4;
                        $.ajax({
                            type: "GET",
                            
                            url: "<?php echo base_url("Ajaxcontroller/show_item_to_checkout") ?>",
                            data: {cart:cart},
                            success: function (data) {
                                
                                $('#cartitem').empty();
                                $('#cartitem').html(data);
                                
                            }
                        });
                    }
                    
                }
            });
           
            
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
                    
                        
                        $('#postFormsRazor').submit();
                    
                }else if(parseJson.pay_u[0] == 2){
                    
                        $('#mob_otp').html();
                        $('#mob_otp').html(parseJson.pay_u[1]);
                        $("#submit_cod").click();
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
                            //alert(data);
                             $('#shippingcost').html();
                             $('#shippingcost').html("₹ "+data);
                             $('#total').val(parseInt(ta)+parseInt(data));
                             $('#shipping').val(data);
                             $('#total_amount').html();
                             $('#total_amount').html(parseInt(ta)+parseInt(data));
                             //$('.postFormsRazor script').attr('data-amount', (parseInt(ta)+parseInt(data))*100);
                             
                        }else{
                           alert('Delivery is not available in this area');
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
               $('#district').val(res[1]);
               $('#pin').val(res[2]);
               $("#pin").blur();
           });
            $(document).on('change','.coupon',(function(e){
                var cval = $(this).val();
                var res = cval.split(",");
                //alert(res[0]);
                $('.closed').click();
                $('#applied_coupon_code').val(res[0]);
            }));
           
});
</script>
<?php } ?>