<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title Start -->
    <!-- This script block is added by Lakshman for time bening till automatic title and description are added from backend -->
    <title>
        
        <?php
           // echo ucfirst($this->uri->segment(1)). " ";
        
            if($this->uri->segment(1) == 'product' )
            { 
                //Proudcts title 
                echo $prodetail['attribute_name'];
                
            }
            else if($this->uri->segment(1) == 'abouts' && empty($this->uri->segment(3)))
            {
                //About us title 
                echo "Organic farmers turned Entrepreneurs";
            } 
            else if($this->uri->segment(1) == 'shop' && empty($this->uri->segment(3)))
            {
                //Shop title 
                echo "Shop Organic products online | Certified organic farms";
            } 
            
            else if($this->uri->segment(1) == 'contact' && empty($this->uri->segment(3)))
            {
                //Shop title 
                echo "Contact us | Farmstop";
            } 
            else 
            { 
                //Home page title
                echo "Farmstop - Organic e-store in Bangalore";
            }
        ?>   
         
        
             
    </title>
    <!-- Title End ! -->
    
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="farmstop.in">
    <!-- Meta Description starts -->
    <!-- This script block is added by Lakshman for time bening till automatic title and description are added from backend -->
    <meta name="description"                content="
    
        <?php
        
            if($this->uri->segment(1) == 'product' )
            { 
                //Proudcts title 
                if(!empty($prodetail['long_description'])) echo $prodetail['long_description']; else echo $prodetail['short_description']; 
                
            }
            else if($this->uri->segment(1) == 'abouts' && empty($this->uri->segment(3)))
            {
                //About us title 
                echo "Farmstop was started with a motive to help and encourage farmers to take up organic farming as we strongly believe organic farming is the only way to attain sustainable farming and living.
                        
                        Online store for genuine organic produce at www.farmstop.in";
            } 
            else if($this->uri->segment(1) == 'shop' && empty($this->uri->segment(3)))
            {
                //Shop title 
                echo "Shop with us for genuine organic produce procured from our farms and local organic farmers. local produce, organic vegetables, organic greens, Millets, Cereals, Pulses, Grains.";
            } 
            
            else if($this->uri->segment(1) == 'contact' && empty($this->uri->segment(3)))
            {
                //Shop title 
                echo "Farm Visit";
            } 
            else 
            { 
                //Home page title
                echo "Buy organic products online. Farmstop is the Best organic store in Bangalore. We are certified in organic farming. Doorstep organic products delivery Bangalore";
            }
        ?>   
    
    
    
    ">
    <!-- Meta Description Ends ! -->
    <!-- Meta Keywords  starts -->
    <!-- This script block is added by Lakshman for time bening till automatic Meta Keywords are added from backend -->
    <meta name="keywords"                content="
    
        <?php
        
            if($this->uri->segment(1) == 'product' )
            { 
                //Proudcts title 
                if(!empty($prodetail['long_description'])) echo $prodetail['long_description']; else echo $prodetail['short_description']; 
                
            }
            else if($this->uri->segment(1) == 'abouts' && empty($this->uri->segment(3)))
            {
                //About us title 
                echo ucwords("vegetable delivery, online vegetables, buy organic vegetables online, organic vegetables online, organic greens online, vegetables online Bangalore, buy vegetables online Bangalore, online fruits in Bangalore, organic fruits and vegetables, fresh organic fruits, online grocery Bangalore, fresh vegetables online, moringa leaves online, organic store, organic food store, buy fresh vegetables, organic food online, online fresh vegetables, online vegetable delivery, organic grocery, organic food online shopping, vegetables online, vegetables home delivery, best organic food store, organic grocery online, order vegetables online, best organic food store, ");
            } 
            else if($this->uri->segment(1) == 'shop' && empty($this->uri->segment(3)))
            {
                //Shop title 
                echo ucwords("vegetable delivery, online vegetables, buy organic vegetables online, organic vegetables online, organic greens online, vegetables online Bangalore, buy vegetables online Bangalore, online fruits in Bangalore, organic fruits and vegetables, fresh organic fruits, online grocery Bangalore, fresh vegetables online, moringa leaves online, organic store, organic food store, buy fresh vegetables, organic food online, online fresh vegetables, online vegetable delivery, organic grocery, organic food online shopping, vegetables online, vegetables home delivery, best organic food store, organic grocery online, order vegetables online, best organic food store,  ");
            } 
            
            else if($this->uri->segment(1) == 'contact' && empty($this->uri->segment(3)))
            {
                //Shop title 
                echo ucwords("vegetable delivery, online vegetables, buy organic vegetables online, organic vegetables online, organic greens online, vegetables online Bangalore, buy vegetables online Bangalore, online fruits in Bangalore, organic fruits and vegetables, fresh organic fruits, online grocery Bangalore, fresh vegetables online, moringa leaves online, organic store, organic food store, buy fresh vegetables, organic food online, online fresh vegetables, online vegetable delivery, organic grocery, organic food online shopping, vegetables online, vegetables home delivery, best organic food store, organic grocery online, order vegetables online, best organic food store, ");
            } 
            else 
            { 
                //Home page title
                echo ucwords("Organic Vegetables, organic fruits, Organic Rice, Organic Cereals, Millets,  ");
            }
        ?>   
    
    
    
    ">
    <!-- Meta Keywords Ends ! -->
    
    
    
    <meta name="google-site-verification" content="-0CuCJgF95T9MMQwQq12OsOmJ907ylgkMcu7_VkaSNg" />

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/animate.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css?rnd=3.0" />
    
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cardo" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css" type="text/css" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" type="text/css" rel="stylesheet" >
    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css" />
    
    <script src="<?php echo base_url() ?>assets/js/instafeed.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/slick-carousel.js"></script>
    <script src="<?php echo base_url() ?>assets/js/menual.js?rnd=1.2"></script>
    
    <link rel="icon" type="image/png" sizes="18x18" href="<?php echo base_url() ?>assets/images/farmstop.png"/>  

    <?php if($this->uri->segment(1) == 'product' && !empty($this->uri->segment(3))){ ?>

        <meta property="og:site_name"           content="FARMSTOP" />
        <meta property="og:title"               content="<?php echo $prodetail['attribute_name'] ?>" />
        <meta property="og:url"                 content="<?php echo "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>" />
        <meta property="og:description"         content="<?php echo $prodetail['short_description'] ?>" />
        <meta property="og:type"                content="website" />
        <meta property="og:image"               content="<?php echo base_url('teao/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $prodetail['fimage'])) ?>" />
        <!--<meta name="description"                content="<?php if(!empty($prodetail['long_description'])) echo $prodetail['long_description']; else echo $prodetail['short_description']; ?>">-->
        <meta name="google-site-verification"   content="ROeqgX6YnZvxLbRUbsK_OmwPsevcg4SWR600E8Egwn4" />
    
    
    <?php } ?>
    
    <script>
        $(function () 
        {
            $(".apartmentselect").select2();
        });
    </script>   
    <?php $this->load->view("public/fbgo"); ?>

    
    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '435434434106556');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=435434434106556&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
        
        
    <!-- Google Tag Manager(added by Lakshman) -->
    <!-- 
    
        Added by Lakshman on 24Dec2020 up on requested by Nagarajun Dande
        one more addon script is added below 
    -->
    
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-T9ZGB6J');</script>
        
    <!-- End Google Tag Manager -->


</head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- 
        Added by Lakshman on 24Dec2020 up on requested by Nagarajun Dande
        Please note this below code is addon script for above Google Tag Manager(added by Lakshman) 
    -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124277165-1"></script>
    <script>
    
        jQuery(document).ready(function(){
            $(".clickbtn").click(function () {
                $(this).siblings(".dropdownlocation").toggle();
                $('.sidebar-overlay').addClass('active');
                //$(".dropdownlocation").show();
                // $("#").show();   
            });
            $(' .sidebar-overlay').on('click', function () {
                        $('.dropdownlocation').css("display", "none");
                        $('.sidebar-overlay').removeClass('active');
                    });
        });
        
        
        jQuery(document).ready(function(){
            $(".clickbtn_m").click(function () {
                $(this).siblings(".dropdownlocation_m").toggle();
                //$(".dropdownlocation").show();
                // $("#").show();   
            });
        });
    
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', 'UA-124277165-1');
    </script>
    <body>
        
        
        <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T9ZGB6J"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

<div class="sidebar-overlay"></div>
<section class="d-none d-sm-block topbarhead">
    	<div class="col-sm-12 p-0">
            <div class="alert alert-success alert-dismissible p-0" role="alert">
            <button type="button" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button> <marquee class="marque-head"><p><b></b>****Genuine, Authentic Organic Produce, from certified farms, Check our certification****  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ****Organic Produce harvested from our farms and delivered to your door step. Delivery on Monday, Tuesday, Wednesday, Friday and Saturday**** &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; **Know your source! Know your farms!**</b></p></marquee>
            </div>
        </div>
        <header class="bg__header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="float-left textulnav">
                            <ul>
                                <li class="">
                                    <a title="Find your location in Bangalore" class="listapartcss nav-link clickbtn mr-auto" href="#"><span>Location</span>  </a>
        							    <div class="dropdownlocation">
                                            <h4 align="center">Location!</h4>
                                            <div class="location-body-wrapper">
                                                <div class="cities-row">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                        <label>
                                                        <input type="radio" class="searchby" checked value="1" name="searchby" id="rd1" /> Apartment
                                                        </label>&nbsp;&nbsp;
                                                        <label>
                                                        <input type="radio" class="searchby" value="2" name="searchby" id="rd2" /> Pincode
                                                        </label>
                                                        </div>
                                            	    <div class="col-md-12">
                                            	        <div class="form-group search-popupA mb-0">
                                                        <input readonly val="1" class="hintsearch form-control" type="text" name="kw" value="" placeholder="Your apartment name or Location" autocomplete="off">
                                                        
                                                        <button type="button" class="search-button-sm searchbtnjs"><i class="fa fa-search"></i></button>
                                                        </div>
                                                        <div class="sowaperttext p-2" style="display:none;">
                                                            <div class="d-flex">
                                                            <p>Apartment</p>
                                                            <a class="changeAprt ml-auto" href="#">change apertment</a>
                                                            </div>
                                                        </div>
                                            	        <div class="search-showhide search-ajax show-example" style="display: block;">
                                                             <ul class="ulsp">
                                                             </ul>
                                                             <div class="d-flex">
                                                             <p class="currentloc lineheight20"></p>
                                                             <p class="changeloc ml-auto"><a class="changelocationcss">Change Location</a></p>
                                                             </div>
                                                        </div>
                                            	    </div>
                                            	     
                                             	</div>
                                             	
                                                </div>
                                                
                                            </div>
                                        </div>
                                </li>
                                
                                <li class="<?php if($this->uri->segment(1)=="organic-certification") {echo 'active';}?>"><a                             href="<?php echo base_url('organic-certification') ?>"> Organic Certification</a></li>
                                <li class="<?php if($this->uri->segment(1)=="our-farms")             {echo 'active';}?>"><a class="js-scroll-trigger"   href="<?php echo base_url('#Our-basket') ?>">           Baskets</a></li>
                                <li class="<?php if($this->uri->segment(1)=="shop")                  {echo 'active';}?>"><a                             href="<?php echo base_url('shop') ?>">                  Our Products</a></li>
                                
                                <!--<li class="<?php if($this->uri->segment(1)=="gallery"){echo 'active';}?>"><a href="<?php echo base_url('gallery') ?>">Gallery</a></li>-->
                                <!--<li class="<?php if($this->uri->segment(1)=="about"){echo 'active';}?>"><a href="<?php echo base_url('about') ?>">About Us</a></li>-->
                                <!--<li class="<?php if($this->uri->segment(1)=="our-farms"){echo 'active';}?>"><a href="<?php echo base_url('our-farms') ?>">Our Farms</a></li>-->
                                
                            </ul>
                        </div>
                    </div> 
                    <div class="col-sm-2">
                        <div class="text-align-img">
        					<a title="Farmstop" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/images/farmstop.png" class="img-fluid" alt="Farmstop" title="Farmstop" /></a>
        				</div>
                    </div>
                    <div class="col-sm-5">
                        <div class="float-right textulnav">
                            <ul>
                                <li class="<?php if($this->uri->segment(1)=="shop"){echo 'active';}?>"><a class="text-muted" target="_blank" title="Download APP" href="https://play.google.com/store/apps/details?id=com.farmstop"><img width="90" src="<?php echo base_url() ?>assets/img/farmstop-app.png" class="img-fluid" /></a></li>
                                <li class="<?php if($this->uri->segment(1)=="farmvisit"){echo 'active';}?>"><a href="<?php echo base_url('farmvisit') ?>">Farmvisit</a></li>
                                <?php
                                    if(isset($_SESSION['login_id']))
                                    {   
                                ?>
                                        <li class="user-log" style="position:relative">
                                            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="<?php echo base_url('my-account') ?>">My Account</a>
                                            <a class="dropdown-item" href="<?php echo base_url('order-list') ?>">My Order</a>
                                            <a class="dropdown-item" href="<?php echo base_url('wishlist') ?>">My Wishlist</a>
                                            <?php
                                            if($_SESSION['login_type'] == 2){ ?>
                                            
                                            <button class="logout-Button" type="button" value="1" onclick="FB.logout()" id="logoutbtn"  >LogOut</i>
                                            </button>
                                            
                                            <?php }else{ ?>
                                            <button class="logout-Button" type="button" value="2" id="logoutbtn"  >LogOut
                                            </button>
                                            <?php   }
                                            
                                            ?>
                                            </div>
                                        </li>
                                
                                <?php  } else { ?>
                                
                                <li><a href="<?php echo base_url('login')?>">Login</a></li>
                                <li><a href="<?php echo base_url('register')?>">Register</a></li>
                                
                                <?php } ?>
                                
        						<li>
        					        <a class="clickbtnsearch"><img src="<?php echo base_url() ?>assets/images/search.png" class="img-fluid" alt="Product Search" /></a>
        						    <div id="dropdownsearch">
                                        <div class="location-body-wrapper">
                                            <div class="search__box">
                            					<form method="get" action="<?php echo base_url('shop') ?>">
                            						<div class="form-group search-popup mb-0">
                                                        <input class="form-control hintsearch-box" type="text" name="kw" value="<?php if(isset($_GET['kw'])) echo $_GET['kw']; ?>" placeholder="Search Product..." autocomplete="off">
                                                        <button type="submit" class="search-button-sm"><i class="fa fa-search"></i></button>
                                                        <div class="search-showhiden-box search-ajax show-example" style="display: block;">
                                                            <ul class="ulspx"></ul>
                                                        </div>
                                                    </div>
                            					</form>
        			                        </div>  
                                        </div>
                                    </div>
        						</li>
        						<li><a id="sidebarCollapse-cart" class="carticondes"><img src="<?php echo base_url() ?>assets/images/cart.png" class="img-fluid" /> <span class="cart-number" id="items">0</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
</section>
<section class="fixed-top d-block d-sm-none bg-mobile-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <a id="sidebarCollapseM" class="top-menubar-button"><i class="fa fa-bars"></i></a>
                <div class="d-inline-block">
                    <a class="clickbtn_m top-menubar-button ml-2"><i class="fa fa-map-marker"></i></a>
                    <div class="dropdownlocation_m">
                        <h4 align="center">Where do you want the delivery?</h4>
                        <div class="location-body-wrapper">
                            <div class="cities-row">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <label>
                                            <input type="radio" checked value="1" name="searchby" id="rd1" /> Apartment
                                        </label>&nbsp;&nbsp;
                                        <label>
                                            <input type="radio" value="2" name="searchby" id="rd2" /> Area
                                        </label>
                                    </div>
                        	        <div class="col-md-12">
                            	        <div class="form-group search-popup_m mb-0">
                                            <input val="2" class="hintsearch_m form-control" type="text" name="kw" value="" placeholder="Find Apartment / Location" autocomplete="off">
                                            <button type="button" class="search-button-sm searchbtnjs"><i class="fa fa-search"></i></button>
                                        </div>
                                        <div class="sowaperttext_m p-2" style="display:none;">
                                            <div class="d-flex">
                                                <p class="currentloc_m"></p>
                                                <p class="changeloc_m changeAprt ml-auto"><a class="changelocationcss">Change Location</a></p>
                                            </div>
                                        </div>
                            	        <div class="search-showhide_m" style="display: block;">
                                             <ul class="ulsp_m"></ul>
                                        </div>
                                    </div>
                         	    </div>
                         	</div>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="col-2 p-0">
                <div class="text-align-Mimg">
					<a title="Farmstop" href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/images/farmstop.png" alt="Farmstop" title="Farmstop" class="img-fluid" /></a>
				</div>
            </div>
            <div class="col-5">
                <a title="cart" href="<?php echo base_url('cart');?>" class="carticondesM"><img alt="framstop cart" src="<?php echo base_url() ?>assets/images/cart.png" class="img-fluid" width="30" /> <span class="cart-number" id="itemz">0</span></a>
                <div class="d-inline positionR">
                    <a class="clickbtnsearch carticondesM">
                        <span class="fas fa-search hidesearch"></span>
                        <span class="far fa-times hidesow"></span>
                    </a>
                   <div class="search-box-div">
                        <div class="search__box">
                            <form method="get" action="<?php echo base_url('shop') ?>">
                                <div class="form-group search-popup mb-0">
                                    <input class="form-control" type="text" name="kw" value="<?php if(isset($_GET['kw'])) echo $_GET['kw'];?>" placeholder="Search Product..." autocomplete="off">
                                    <button type="submit" class="search-button-sm"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  Mobile Menu -->
<div id="sidebar-formM">
    <div id="dismiss-menuM">
        <i class="fa fa-times"></i>
    </div>
    <div class="card border-0">
        <div class="bg-red-colorM mb-0 padding-cat-box">
            <h5 class="p-1"><img src="<?php echo base_url() ?>assets/images/user.png" width="30" class="img-fluid" alt=""> Welcome!</h5>
        </div>
        <div class="menu-sideullist">
            <div class="mt-3">
                <h2 class="heading-media">Category</h2>
                <div class="line-bottom-color"></div>
                <ul>
                    <?php foreach($products as $pros){ ?>
                        <li><a href="<?php echo base_url('shop/'.$pros['slug']) ?>"> <?php echo $pros['title'] ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="mt-3">
                <h2 class="heading-media">Account Info</h2>
                <div class="line-bottom-color"></div>
                <ul>
                    <?php if(isset($_SESSION['login_id'])){ ?>
                        <li><a href="#"><?php if(!empty($details['name'])) echo $details['name']; else echo 'Farmstop user'; ?></a></li>
                        <li><a href="<?php echo base_url('my-account') ?>">                     My Account </a></li>
                        <li><a href="<?php echo base_url('order-list') ?>">                     My Order </a></li>
                        <li><a href="<?php echo base_url('cart') ?>">                           My Cart</a></li>
                        <li><a href="<?php echo base_url('wishlist') ?>">                       My Wishlist</a></li>
                        <li><button class="btn-none" type="button" value="2" id="logoutbtn">    Logout</button>
                        
                    <?php } else{ ?>
                    
                        <li><a href="<?php echo base_url('my-account') ?>">     Sign-In</a></li>
                        <li><a href="<?php echo base_url('register') ?>">       Register</a></li> 
                                
                    <?php } ?>
                </ul>
            </div>
            <div class="mt-3">
                <h2 class="heading-media">Farmstop</h2>
                <div class="line-bottom-color"></div>
                <ul>
                    <li><a href="<?php echo base_url('farmvisit') ?>">              Farmvisit</a></li>
                    <li><a href="<?php echo base_url('organic-certification') ?>">  Certificate</a></li>
                    <li><a href="<?php echo base_url('abouts') ?>">                 About Us</a></li>
                    <li><a href="<?php echo base_url('contact') ?>">                Contact Us</a></li>
                    <li><a href="<?php echo base_url('privacy-policy') ?>">         Privacy Policy</a></li>
                    <!--             
                        <a class="text-muted;" style="position:absolute" target="_blank" title="Download APP" href="https://play.google.com/store/apps/details?id=com.farmstop">
                        <img width="90" src="<?php echo base_url() ?>assets/img/farmstop-app.png" class="img-fluid" /></a>
                    -->
                </ul>
            </div>
            <div class="mt-3">
                <h2 class="heading-media">Help &amp; Support</h2>
                <div class="line-bottom-color"></div>
                <ul>
                    <li><a href="tel:+918123018988"><i class="fa fa-phone fa-flip-horizontal fa-fw" style="color:green"></i><span class="ml-1"><tel>+91-8123018988</tel></span></a></li>
                </ul>
            </div>
            <div class="mt-3">
                <h2 class="heading-media">Available on</h2>
                <div class="line-bottom-color"></div>
                <ul class="d-flex mt-2">
                    <li>
                        <a class="text-muted p-1" title="Download APP" href="https://play.google.com/store/apps/details?id=com.farmstop">
                        <img width="150" src="https://www.farmstop.in/assets/img/farmstop-app.png" class="img-fluid"></a>
                    </li>
                    <li>
                        <a class="text-muted p-1" title="Download APP" href="#"><img width="150" src="https://www.farmstop.in/assets/images/iphone.png" class="img-fluid"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="sidebar-cart">
    <div id="dismiss"><i class="fa fa-arrow-right"></i></div>
    <div class="card card-signin my-5"><div class="card-body" id="cart-items"></div></div>
</div>

<style>
    /* ---------------------------------------------------
        google login STYLE
    ----------------------------------------------------- */
    #customBtn {display: inline-block;background: #ea4335;color: #fff;padding: 1px;padding-left: 4px;
    padding-right: 8px;border-radius: 2px;white-space: nowrap;}
    #customBtn:hover {cursor: pointer;}
    .buttonText {display: inline-block;vertical-align: middle;font-size: 25px;font-weight: bold;}
    #customBtn .icon{background: #fff;padding: 8px;border-radius: 2px;color: #e12a2a;font-size: 19px;
    vertical-align: middle;}
    .login-social{text-align: center;}
    .login-social li{display: inline-block;vertical-align: middle;}
    /* ---------------------------------------------------
        google login STYLE
    ----------------------------------------------------- */
</style>
<script>
        $(".search-icon").on('click', function() {
            if ($(this).hasClass('opened')) {
                $(this).removeClass('opened');
                $('.search-icon i').removeClass('active-search').addClass('fa-search');
                $('.search-form').fadeOut('slow').removeClass('').addClass('');
            } else {
                $(this).addClass('opened');
                $('.search-icon i').addClass('active-search').removeClass('fa-search');
                $(".search-form").fadeIn('slow').removeClass('').addClass('');
            }
            });
            $("body").on('click', function() {
                $('.search-icon').removeClass('opened');
                $('.search-icon i').removeClass('active-search').addClass('fa-search');
                $('.search-form').fadeOut('slow').removeClass('').addClass('');
            });
            $('.tr-search').on('click', function(e) {
                e.stopPropagation();
            });
</script>
<!--Start of Tawk.to Script-->
<!-- We are not using it any more need to check and delete it ( comment added by lakshman need to check with pradeep ) -->
    <script type="text/javascript">
        /*var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5ae053595f7cdf4f053398b4/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();*/
    </script>
<!--End of Tawk.to Script-->
<style>
    #cart-slow-motion {
    visibility: hidden;
    min-width: 183px;
    background-color: #80b435;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 11px;
    position: fixed;
    z-index: 12;
    right: 77px;
    top: 129px;
    font-size: 12px;
    }
    
    #cart-slow-motion.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }
    #cart-slow-motionB {
    visibility: hidden;
    min-width: 183px;
    background-color: #80b435;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 11px;
    position: fixed;
    z-index: 12;
    right: 77px;
    top: 129px;
    font-size: 12px;
    }
    
    #cart-slow-motionB.show {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }
    
    @-webkit-keyframes fadein {
      from {top: 0; opacity: 0;} 
      to {top: 129px; opacity: 1;}
    }
    
    @keyframes fadein {
      from {top: 0; opacity: 0;}
      to {top: 129px; opacity: 1;}
    }
    
    @-webkit-keyframes fadeout {
      from {top: 129px; opacity: 1;} 
      to {top: 0; opacity: 0;}
    }
    
    @keyframes fadeout {
      from {top: 129px; opacity: 1;}
      to {top: 0; opacity: 0;}
    }
</style>
    <button class="mycartfunction" style="display:none;" onclick="mycartfunction()">Show Snackbar</button>
    <div id="cart-slow-motion">Added to Cart..</div>
    <input type="button" id="alerthbtn" value="" class="mycartfunction1" style="display:none;" onclick="mycartfunction1()" />
    <!--<button class="mycartfunction" style="display:none;" onclick="mycartfunction1()">Show Snackbars1</button>-->
    <div id="cart-slow-motionB">Delete item..</div>
    
    
