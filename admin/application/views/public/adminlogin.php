
<?php $this->load->view('public/public_header')  ?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="https://www.farmstop.in/assets/images/farmstop.png" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <?php if($error=$this->session->flashdata('login_failed')): ?>
   
  
                       <center><h3><?php echo $error; ?></h3></center> 
   
                        <?php endif; ?>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="form-horizontal pt-3" role="form" id="form_login" method="post">
                <div class="form-group">
                    <input class="form-control form-control-lg" value="<?php echo set_value('username'); ?>" name="username" type="text" placeholder="Enter Mobile/Email" >
                    <?php echo form_error('username'); ?>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" placeholder="Enter Password" name="password" type="password" value="">
                </div>
                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                    </label>
                </div>
                <div class="mt-3">
                    <button name="submit" type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

    <!--div class="container">
        
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?php if($error=$this->session->flashdata('login_failed')): ?>
   
  
                       <center><h3><?php echo $error; ?></h3></center> 
   
                        <?php endif; ?>
                <div class="login-panel panel panel-default" >

                    <div class="panel-heading">
                        
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body" style="margin:10px;">
                        <form class="form-horizontal" role="form" id="form_login" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" value="<?php echo set_value('username'); ?>" placeholder="Enter Mobile/Email" name="username" type="text" >
                                    <?php echo form_error('username'); ?>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Enter Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <button name="submit" type="submit" class="btn btn-primary">Login2</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div-->

<?php $this->load->view('public/public_footer')  ?>




   