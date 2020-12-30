<!--section class="main-banner main-banner-colorbg">
	<div class="container">
            <div class="row py-5">
                <div class="col-md-4 offset-md-4 login-form-new">
                    <h3>Login</h3>
                    <p><?php if(isset($msg)) echo $msg; ?></p>
                    <ul class="login-social">
                      <li><fb:login-button size="xlarge" scope="public_profile,email" onlogin="checkLoginState();">
                  </fb:login-button></li>
                  <li><div id="gSignInWrapper">
                    <span class="label"></span>
                    <div id="customBtn" class="customGPlusSignIn">
                      <span class="icon fa fa-google"></span>
                      <span class="buttonText"> Log In</span>
                    </div>
                  </div>
                  <script>startApp();</script></li>
                  </ul>
                    <form method="post" id="login_user">
                        <fieldset class="login-input-container-box">
                            <div class="login-input-item">
                                <input type="text" class="login-user-input-email login-user-input" name="usernm" placeholder="Your Email or Mobile">
                            </div>
                            <div class="login-input-item">
                                <input type="password" class="login-user-input-password login-user-input" name="passwd" placeholder="Your Password *">
                            </div>
                        </fieldset>
                        <fieldset class="login-button-container-box"><input name="submit" class="login-login-button" id="submit" type="submit" class="btnSubmit" value="Login" /></fieldset>
                        
                        
                    </form>
                    <div class="login-link-container-box"><a class="login-link" href="<?php echo base_url('reset-password') ?>">Reset password</a><div class="login-right-links"><a class="login-create-account-link login-link" href="<?php echo base_url('register') ?>">Create Account</a></div></div>
                    </div>
                
            </div>
            
        </div>
</section-->
<section>
<div class="container">
<div class="row my-5">
        <div class="col-md-7 mb-2 d-none d-sm-block">
            <img src="<?php echo base_url() ?>assets/images/login.jpg" class="img-fluid">
        </div>
        <div class="col-md-5 mt-5">
            <h2 class="mb-3">Welcome :)</h2>
			<p>To stay connected with us, please login with your personal information by email and password</p>
            <p><?php if(isset($msg)) echo $msg; ?></p>
        	<form method="post" id="login_user" class="contactpage">
                        <p id="contactmsg"></p>
                <div class="form-group">
                <input type="name" name="usernm" placeholder="Your Email or Mobile" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="passwd" placeholder="Your Password *" class="form-control">
                </div>
                <div class="form-group mt-2">
                <input name="submit" class="login-login-button" id="submit" type="submit" class="btnSubmit" value="Login" />
                </div>
            </form>
            <div class="login-link-container-box">
                <a class="login-link" href="<?php echo base_url('reset-password') ?>">Reset password</a>
                <div class="login-right-links">
                    <a class="login-create-account-link login-link" href="<?php echo base_url('register') ?>">Create Account</a>
                </div>
            </div>
            <div class="text-center my-3 orlogin">
                <h3>Or you can join with </h3>
            </div>
            <ul class="login-social mb-5">
                      <li><fb:login-button size="xlarge" scope="public_profile,email" onlogin="checkLoginState();">
                  </fb:login-button></li>
                  <li><div id="gSignInWrapper">
                    <span class="label"></span>
                    <div id="customBtn" class="customGPlusSignIn">
                      <span class="icon fa fa-google"></span>
                      <span class="buttonText"> Log In</span>
                    </div>
                  </div>
                  <script>startApp();</script></li>
                  </ul>
        </div>
    </div>
</div>
</section>