<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/animate.min.css" />
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/magnific.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta property="og:site_name" content="TEAO" />
    <meta property="og:title" content="TEAO SHOPPING 2019" />
    <?php
    $seg1 = ''; $seg2 = ''; $seg3 = '';
    if($this->uri->segment(1)){
        $seg1 = $this->uri->segment(1);
    }
    if($this->uri->segment(2)){
        $seg2 = $this->uri->segment(2);
        $seg3 = $prodetail['des'];
    }
    
    ?>
    <meta property="og:url" content="<?php echo base_url($seg1.'/'.$seg2) ?>" />
    <meta property="og:description" content="Product Page" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="" />
  <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/slick-carousel.js"></script>
  <script src="<?php echo base_url() ?>assets/js/instafeed.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/menual.js"></script>
  <script src="<?php echo base_url() ?>assets/js/custom.js"></script>
    <script src="<?php echo base_url() ?>assets/js/magnific.min.js"></script>
  
  
<title>Untitled Document</title>
<!--script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script-->
<?php $this->load->view("public/fbgo"); ?>

</head>

<body>
<div class="top-header">
  <div class="container">
      <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-7 col-7">
                <p> TEAO e commerce website</p>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-5 col-5">
               
            </div>
        </div>
    </div>
  </div>
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
              <a class="navbar-brand" href=""#"<?php echo base_url('index') ?>"><img class="img-logo" src="https://staticaltmetric.s3.amazonaws.com/uploads/2015/12/Altmetric_rgb.png" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="fa fa-bars"></span>
            </button>
          <div class="collapse navbar-collapse nav-right" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto float-lg-right">
                <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url() ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                 <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('about') ?>">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index#scroll-div">Who we are</a>
                </li>
                <li class="nav-item">
                
                <a class="nav-link" href="<?php echo base_url('shop') ?>">Shop</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Locate a store</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Collaborate
                </a>
                <div class="dropdown-menu drop-nav animated bounceIn" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Bulk Buy/Distributors</a>
                <a class="dropdown-item" href="#">Social media Promoter/Influencer</a>
                <a class="dropdown-item" href="#">Investment opportunities</a>
                </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('blog') ?>">Blog</a>
                </li>
                 <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('contact') ?>">Contact</a>
                </li>
          
        </ul>
         </div>
         <div class="find-option float-right">
             <ul class="line-right">
                
                    <?php
                    if(isset($_SESSION['login_id'])){ ?>
                        <li class="user-log" style="position:relative">
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-o" aria-hidden="true"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?php echo base_url('my-account') ?>">Dashboard</a>
                    <a class="dropdown-item" href="<?php echo base_url('order-list') ?>">Order</a>
                    <a class="dropdown-item" href="<?php echo base_url('wishlist') ?>">Wishlist</a>
                      <?php
                      if($_SESSION['login_type'] == 2){ ?>
                      
                    <button type="button" value="1" onclick="FB.logout()" id="logoutbtn"  ><i class="fa fa-sign-out" aria-hidden="true"></i>
                   </button>
                  
                          <!--id="logoutbtn"  -->
<!--a href="#" onclick="FB.logout()" ><i class="fa fa-sign-out" aria-hidden="true"></i>
</a-->
                          
                     <?php }else{ ?>
                     <button type="button" value="2" id="logoutbtn"  ><i class="fa fa-sign-out" aria-hidden="true"></i>
                     </button>
                         <!--a href="<?php echo base_url('logout') ?>" ><i class="fa fa-sign-out" aria-hidden="true"></i>
</a--> 
                   <?php   }
                      
                      ?>
                      </div>
                        </li>
                  <?php  } else {
                    ?>
                    <li>
                     <a id="sidebarCollapse" >
                <i class="fa fa-user-o" aria-hidden="true"></i></a>
                </li>
                    <?php } ?>
                    
                    
     
                
               
                <li><a id="sidebarCollapse-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge badge-toggle" id="items">0</span></a></li>
            </ul>
                                
            </div>
  </div>
    </div>
</nav>
<div class="sidebar-overlay"></div>
<div class="wrapper">
        <!-- Sidebar  -->
        <div id="sidebar-form">
            <div id="dismiss">
                <i class="fa fa-arrow-right"></i>
            </div>
            <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</h5>
              <form class="form-signin" method="post" id="login_user">
              <div class="form-label-group">
                
                <input type="text" name="usernm" id="inputEmail" class="form-control" placeholder="Enter email or mobile" value="" required autofocus>
              </div>

              <div class="form-label-group">
                
                <input type="password" name="passwd" value="" id="inputPassword" class="form-control" placeholder="Password" required>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
                <span class="float-right small"><a class="text-dark" href="<?php echo base_url('my-account') ?>">Register Now</a></span>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit" id="submit">Sign in</button>
              
              <hr class="my-4">
              </form>
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
              
              
          </div>
        </div>
        </div>
    <div id="sidebar-cart">
            <div id="dismiss">
                <i class="fa fa-arrow-right"></i>
            </div>
            <div class="card card-signin my-5">
          <div class="card-body" id="cart-items">
            
              
                  <!-- Cart Items -->
                  
                    <!-- Cart Items -->
                    
                
          </div>
        </div>
        </div>
        <!-- Page Content  -->
    </div>