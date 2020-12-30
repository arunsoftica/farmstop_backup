<!--section class="main-banner main-banner-colorbg pb-m5">
	<div class="container">
            <div class="row py-5">
                <div class="col-md-4 offset-md-4 login-form-new">
                    <h3>Signup</h3>
                    <p id="verify_link"></p>
                    
                    <form method="post" id="register_user">
                        <fieldset class="login-input-container-box">
                            <div class="login-input-item">
                                <input type="text" class="login-user-input-email login-user-input" name="name" placeholder="Your Name *">
                            </div>
                            <div class="login-input-item">
                                <input type="text" class="login-user-input-email login-user-input" name="email" placeholder="Your Email *">
                            </div>
                            <div class="login-input-item">
                                <input type="text" class="login-user-input-email login-user-input" id="mobile" name="mobile" placeholder="Your Mobile *">
                            </div>
                            <div class="login-input-item">
                                <input type="password" class="login-user-input-password login-user-input" name="passwd" placeholder="Your Password *">
                            </div>
                        </fieldset>
                        <fieldset class="login-button-container-box"><input name="submit" class="login-login-button" id="submit" type="submit" value="Register" /></fieldset>
                        
                        
                    </form>
                    <div class="register-link-container-box ahac">
                        <div class="register-login-link">
                            <span class="register-info-text">Already have an account?</span>
                            <a class="register-create-account-link register-link" href="<?php echo base_url('login') ?>">Login!</a>
                        </div>
                    </div>
                    
                    <div class="votp">
                    <div class="form-group">
                            <input type="text" name="eotp" id="eotp" class="login-user-input-email login-user-input" placeholder="Enter OTP" value="" required />
                            <input type="hidden" name="votp" id="votp" value="" />
                            <input type="hidden" name="remail" id="remail" value="" />
                            
                        </div>
                        
                        <div class="form-group">
                            <button type="button" name="verotp" id="verotp" class="btn btn-success">Verify OTP</button>
                            <button type="button" value="" name="resotp" id="resotp" class="btn btn-primary" style="    background-color: #17a2b8;">Resend OTP</button>
                            </div>
                            
                            <div class="form-group">
                                <p id="rotpmsg"></p>
                            </div>
                            
                            </div>
                
            </div>
            
        </div>
    </div>
</section-->
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<section>
<div class="container">
<div class="row my-5">
        <div class="col-md-6 mb-2 d-none d-sm-block p-5">
            <img src="<?php echo base_url() ?>assets/images/register.jpg" class="img-fluid">
        </div>
        <div class="col-md-6 mt-5">
					<h2>Register here</h2>
            <p id="verify_link"></p>
        	<form method="post" id="register_user" class="contactpage">
                        <p id="contactmsg"></p>
                <div class="form-group">
                <input type="name" name="name" placeholder="Your Name *" class="form-control">
                </div>
                <div class="form-group">
                <input type="email" name="email" placeholder="Your Email *" class="form-control">
                </div>
                <div class="form-group">
                <input type="number" id="mobile" name="mobile" placeholder="Your Mobile *" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="passwd" placeholder="Your Password *" class="form-control">
                </div>
                <div class="form-group mt-2">
                <input name="submit" class="login-login-button" id="submit" type="submit" value="Register" />
                </div>
            </form>
            <div class="register-link-container-box ahac">
                        <div class="register-login-link">
                            <span class="register-info-text">Already have an account?</span>
                            <a class="register-create-account-link register-link" href="<?php echo base_url('login') ?>">Login!</a>
                        </div>
                    </div>
            <div class="votp">
                    <div class="form-group">
                            <input type="text" name="eotp" id="eotp" class="login-user-input-email login-user-input" placeholder="Enter OTP" value="" required />
                            <input type="hidden" name="votp" id="votp" value="" />
                            <input type="hidden" name="remail" id="remail" value="" />
                            
                        </div>
                        
                        <div class="form-group">
                            <button type="button" name="verotp" id="verotp" class="btn btn-success">Verify OTP</button>
                            <button type="button" value="" name="resotp" id="resotp" class="btn btn-primary" style="    background-color: #17a2b8;">Resend OTP</button>
                            </div>
                            
                            <div class="form-group">
                                <p id="rotpmsg"></p>
                            </div>
                            
                            </div>
        </div>
        <div class="col-md-12 text-center">
            <h5>Having issues signing up, please write to us at
<a href="mailto:info@farmstop.in">info@farmstop.in</a></h5>
        </div>
    </div>
</div>
</section>
<script>
    $('.votp').hide();
    $('.votps').hide();
    $(document).on('click','#resotp', function (e){
         var ro = $(this).val();
         $.ajax({
                  url: "Ajaxcontroller/resend_otp",
                  type: "GET",           
                  data: {ro:ro},
                  success: function(data){
                          $('#votp').val(data);
                          $('#rotpmsg').html('');
                          $('#rotpmsg').html('OTP sent successfully.');
                      
                    
                   }
                  });
         
     });
     $(document).on('click','#verotps', function (e){
         var r = $('#remails').val();
         var e = $('#eotps').val();
         var v = $('#votps').val();
         if(e == v){
             window.location.href = "<?php echo base_url('reset-password?em=') ?>"+r;
         }else{
            alert('Enter Correct OTP'); 
         }
         
     });
     $(document).on('click','#verotp', function (e){
         var r = $('#remail').val();
         var e = $('#eotp').val();
         var v = $('#votp').val();
         if(e == v){
             window.location.href = "<?php echo base_url('Ajaxcontroller/verify_user?loginid=') ?>"+r;
         }else{
            alert('Enter Correct OTP'); 
         }
         
     });
    $(document).on('submit','#register_user',(function(e){
        var rm = $('.rgemail').val();
    var usernm = $('#mobile').val();
    var passwd = $('#passwd').val();
    $('#resotp').val(usernm);
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
        /*if(data == 'registered'){
            $('#verify_link').html('An OTP has been sent to your Email ID / Mobile Number');
            
        }else */if(data == 'exist'){
            alert('This email id already exist');
        }else if(data == 'mobile'){
            alert('This mobile already exist');
        }else{
            $('#verify_link').html('A verification link has been sent to your email id, click that link or enter OTP to activate your account.');
            $('.ahac').hide();
            $('#register_user').hide();
            $('#votp').val(data);
            $('#remail').val(usernm);
            $('.votp').show();
        }
     }  
     });  
 }));
</script>