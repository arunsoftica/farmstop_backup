
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


<section class="m-0">
<div class="row m-0">
         <div class="main-banner" style="position: relative;background: #000;">
            <img class="img-fluid" src="assets/img/banner.jpg" style=" width:100%;max-height: 200px;
    opacity: 0.6;"  />
    		<div class="sidemenu-row mb-2 mt-2">
          	 <ul class="sidmenu">
                      <li><a href="#">Home</a> / </li>
                      <li class="active">Account</li>
                    </ul>
          </div>
        </div>
</div>
</section>
	<section>
    	<div class="container-fluid">
        	<div class="row mt-3 mb-3">
            	<div class="col-sm-3">
                	<div class="account-sidemenu">
                	<div class="list-group">
    <a href="<?php echo base_url('my-account') ?>" class="list-group-item list-group-item-action active">
        <i class="fa fa-user"></i> My Profile
    </a>
    
    <a href="<?php echo base_url('order-list') ?>" class="list-group-item list-group-item-action">
        Order History 
    </a>
    <a href="<?php echo base_url('wishlist') ?>" class="list-group-item list-group-item-action">
        Wishlist
    </a>
</div>
					</div>
                    <div class="">
                    </div>
                </div>
                <div class="col-sm-8">
                	<div class="acct-head">
                	<h2>My Profile</h2>
                    <h3><img src="assets/img/user-icon.png" class="img-fluid" /> Account Info <a data-toggle="collapse" href="#collapse-profile" role="button" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-pencil act-icon"></span></a></h3>
                    	<div class="collapse" id="collapse-profile">
                                    <div class="card card-body add-address">
                                    	<form>
                    	<div class="form-group">
                        	<label>Name <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" placeholder="Name" value=""></textarea>
                        </div>
                        <div class="form-group">
                        	<label>Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Email" value="" />
                        </div>
                        <div class="form-group">
                        	<label>Mobile No <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Mobile No" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit btnSubmit-check" value="Edit" />
                        </div>
                    </form>
                                    </div>
                                </div>
                    	<ul class="info-user">
                        	<li><p>Name: &nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $_SESSION['login_name']; ?></span></p></li>
                            <li><p>Email: &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-info"><?php echo $_SESSION['login_email']; ?></span></p></li>
                            <li><p>Mobile No: &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-info"><?php echo $details['mobile']; ?></span></p></li>
                            <li><p>Role: &nbsp;&nbsp;&nbsp;&nbsp;<span>User</span></p></li>
                            <li><p>Status: &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-success">Active</span></p></li>
                        </ul>
                        <h3><img src="assets/img/address.png" class="img-fluid" /> Default address </h3>
                    	<div class="row mr-0 ml-0">
                    	    <div class="col-sm-6 p-1">
                                <a class="add-adress-btn" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-plus-circle"></span> Add New Address</a>
                            	<div class="collapse" id="collapseExample">
                                    <div class="card card-body add-address">
                        <form id="add_address" method="post">
                            <input type="hidden" name="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>" >
                            <input type="hidden" name="email" value="<?php if(isset($_SESSION['login_email'])) echo $_SESSION['login_email']; ?>" >
                    	<div class="form-group">
                        	<label>Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" placeholder="Enter Address" required></textarea>
                        </div>
                        <div class="form-group">
                        	<label>District <span class="text-danger">*</span></label>
                            <input type="text" name="district" class="form-control" placeholder="Enter District" value="" required />
                        </div>
                        <div class="form-group">
                        	<label>Pincode <span class="text-danger">*</span></label>
                            <input type="number" name="pin" class="form-control" placeholder="Enter Pincode" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="addsubmit" class="btnSubmit btnSubmit-check" value="Add" />
                        </div>
                    </form>
                                    </div>
                                </div>
                            </div>
                        	<div class="col-sm-6 p-1">
                        	    <!-- Show Address -->
                        	    <?php
                        	    
                        	    foreach($uaddress as $uadrs){
                        	    ?>
                            	<div class="jumbotron jumbotron-address p-4">
                                  <address class="address-act">
                                  	<?php echo $uadrs['address'].' '.$uadrs['district'].' '.$uadrs['zipcode'].' '.$uadrs['country'] ?>
                                  </address>
                                  <ul class="address-btnlist">
                                  	<li class="list-inline">
                                    <li class="list-inline"><a><span class="fa fa-trash"></span></a></li>
                                  	
                                    </ul>
         						 </div>
         						 <?php } ?>
         						 <!-- Show Address -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
$(document).ready(function(){
    $(document).on('submit','#add_address',(function(e){
    
    e.preventDefault();
      $.ajax({
      url: "<?php echo base_url('Ajaxcontroller/add_user_address') ?>",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //$("#register_user")[0].reset();
        alert(data);
        location.reload();
        
     }  
     });  
 }));
 
});
</script>


<?php } ?>