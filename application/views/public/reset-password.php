
<section class="heading-bar main-banner-colorbg">
	<div class="container">
            <div class="row py-5">
                <div class="col-md-4 offset-md-4 login-form-new">
                    <?php if(isset($_GET['em'])){ ?>
                    <h3>Set New Password</h3>
                      <form class="form-signin" method="post" id="save_password">
                          <fieldset class="login-input-container-box">
                            <input type="hidden" name="email" id="email" value="<?php if(isset($email)) echo $email ?>">
                            <input type="password" name="new_pwd" id="new_pwd" class="login-user-input-email login-user-input" placeholder="Enter New Password *" value="" required/>
                        </fieldset>
                        <fieldset class="login-input-container-box">
                            <input type="password" name="con_pwd" id="con_pwd" class="login-user-input-email login-user-input" placeholder="Repeat Password *" value="" required/>
                            </fieldset>
                        
                        <fieldset class="login-input-container-box">
                            <input name="submit" id="submit" type="button" class="login-login-button" value="Save My Password" />
                        </fieldset>
                      </form>
                    <?php }else{ ?>
                    <h3>Reset Password ?</h3>
                    <p id="reset_msg"></p>
                    <form class="form-signin" id="reset_password">
                        <fieldset class="login-input-container-box resetemail">
                           <div class="login-input-item">
                                <!--<input type="text" class="login-user-input-email login-user-input" name="usernm" placeholder="Your Email or Mobile">-->
                                <input type="email" class="login-user-input-email login-user-input" name="reset_email" id="reset_email" placeholder="Enter Mobile Number*" required />
                            </div>
                        </fieldset>
                        <fieldset class="login-button-container-box resetmp">
                            <!--<input name="submit" class="login-login-button" id="submit" type="submit" class="btnSubmit" value="Send Reset Link" />-->
                            <input name="rpsubmit" id="rpsubmit" type="button" class="login-login-button" value="Reset My Password" />
                            </fieldset>
                        <div class="votps">
                    <fieldset class="login-button-container-box">
                            <input type="text" name="eotps" id="eotps" class="login-user-input-email login-user-input" placeholder="Enter OTP" value="" required />
                            <input type="hidden" name="votps" id="votps" value="" />
                            <input type="hidden" name="remails" id="remails" value="" />
                            
                        </fieldset>
                        
                        <fieldset class="login-button-container-box">
                            <button type="button" name="verotps" id="verotps" class="login-login-button">Verify OTP</button>
                            </fieldset>
                            
                            </div>
                        
                        
                    </form>
                    <?php } ?>
                    
                
            </div>
            
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        
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
     
     $(document).on('click','#rpsubmit', function (e){
             var intRegex = /^\d+$/;   
             var email = $("#reset_email").val();
             
              if(email != ""){
                  $.ajax({
                  url: "Ajaxcontroller/resetMyPassword",
                  type: "GET",           
                  data: {email:email},
                  success: function(data){
                      if(intRegex.test(data)) {
                          //alert(data);
                           alert('OTP has been sent to your Registered Mobile Number');
                           $('.resetemail').hide();
                           $('.resetmp').hide();
                           $('#votps').val(data);
                            $('#remails').val(email);
                            $('.votps').show();
                        }else{
                           alert(data); 
                        }
                      
                    
                   }
                  });
              }else{
                  alert('Enter Mobile Number to reset your password');
              }
           });
           
     $(document).on('click','#submit', function (e){
                
             var pwd = $("#new_pwd").val();
             var cpwd = $("#con_pwd").val();
             var email = $("#email").val();
              if(pwd != "" && email != ''){
                  if(pwd == cpwd){
                      $.ajax({
                  url: "Ajaxcontroller/saveMyPassword",
                  type: "GET",           
                  data: {pwd:pwd,email:email},
                  success: function(data){
                      
                      if(data == 'saved'){
                          window.location.href = "<?php echo base_url('my-account?msg=saved') ?>";
                      }else{
                          alert(data);
                      }
                    
                   }
                  });
                  }else{
                      alert('Password and Confirm Password are not same.');
                  }
                  
                  
                  
                  
              }else{
                  alert('Enter Password');
              }
           });
    });
</script>