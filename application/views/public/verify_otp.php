
<section class="heading-bar main-banner-colorbg">
	<div class="container">
            <div class="row py-5">
                <div class="col-md-4 offset-md-4 login-form-new">
                    
                    <h3>Verify Mobile Number</h3>
                    <p id="reset_msg"></p>
                    <form class="form-signin" id="verify_otp">
                        
                    
                    <fieldset class="login-button-container-box">
                            <input type="text" name="veotps" id="veotps" class="login-user-input-email login-user-input" placeholder="Enter OTP" value="" required />
                            <input type="hidden" name="usrmob" id="usrmob" value="<?php echo $_GET['mob'] ?>" />
                            
                            
                        </fieldset>
                        
                        <fieldset class="login-button-container-box">
                            <button type="button" name="verumob" id="verumob" class="login-login-button">Verify OTP</button>
                            </fieldset>
                            
                            
                        
                        
                    </form>
                    
                    
                
            </div>
            
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        
        
     
     $(document).on('click','#verumob', function (e){
         var r = $('#usrmob').val();
         var e = $('#veotps').val();
         var v = "<?php echo $_SESSION['login_vmob'] ?>";
         if(e == v){
             window.location.href = "<?php echo base_url('Ajaxcontroller/verify_user?loginid=') ?>"+r;
         }else{
            alert('Enter Correct OTP'); 
         }
         
     });
     
     
    });
</script>