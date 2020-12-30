<div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="icon ion-md-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ion ion-md-close-circle-outline"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles primary"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
          

        <ul class="nav">
          <li class="nav-item">
            <!--<p class="sidebar-title">Layouts</p>-->
            <a class="nav-link" href="<?php echo base_url('dashboard') ?>">
              <i class="ion ion ion-ios-archive menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#blog" aria-expanded="false" aria-controls="ui-blog">
              <i class="ion ion-logo-rss menu-icon"></i>
              <span class="menu-title">Blog</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blog">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('add_blog') ?>">Add Blog</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('view_blog') ?>">View Blog</a></li>
              </ul>
            </div>
          </li><li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#blog" aria-expanded="false" aria-controls="ui-blog">
              <i class="ion ion-logo-rss menu-icon"></i>
              <span class="menu-title">Coupon</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blog">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('add_coupon') ?>">Add Coupon</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('view_coupon') ?>">View Coupon</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-zone" aria-expanded="false" aria-controls="ui-zone">
              <i class="ion ion-md-tv menu-icon"></i>
              <span class="menu-title">Push Notification</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-zone">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('push_notification') ?>">Send Push Notification</a></li>
                
               
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-zone" aria-expanded="false" aria-controls="ui-zone">
              <i class="ion ion-md-tv menu-icon"></i>
              <span class="menu-title">Zone</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-zone">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('add_zone') ?>">Add Zone</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('view_zone') ?>">View Zone</a></li>
               
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-aprt" aria-expanded="false" aria-controls="ui-aprt">
              <i class="ion ion-md-business menu-icon"></i>
              <span class="menu-title">Apartment</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-aprt">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_apartment') ?>">Add Apartment</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_apartment') ?>">View Apartment</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('apartment_import') ?>">Apartment Bulk</a></li>
              </ul>
            </div>
            <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-product" aria-expanded="false" aria-controls="ui-product">
              <i class="ion ion-md-list menu-icon"></i>
              <span class="menu-title">Product</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-product">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_product') ?>">Add Product</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_product') ?>">View Product</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('pages_seo_sem') ?>">
              <i class="ion ion-md-paper-plane menu-icon"></i>
              <span class="menu-title">Page Seo</span>
            </a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-product-inventory" aria-expanded="false" aria-controls="ui-product-inventory">
              <i class="ion ion-logo-dropbox menu-icon"></i>
              <span class="menu-title">Product Inventory</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-product-inventory">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('product_inventory') ?>">Product Inventory</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('product_inventory_report') ?>">Product Inventory Report By Product</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('product_selling_report') ?>">Product Inventory Report</a></li>
              </ul>
            </div>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-product-Variation" aria-expanded="false" aria-controls="ui-product-Variation">
              <i class="ion ion-md-cart menu-icon"></i>
              <span class="menu-title">Product Variation</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-product-Variation">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('product_variation') ?>">Add Product Variation</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_product_variation') ?>">View Product Variation</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('product_variation_import') ?>">Product Variation Bulk</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_import_product_variation') ?>">View Product Variation Bulk</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-user">
              <i class="ion ion-md-contacts menu-icon"></i>
              <span class="menu-title">User</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-user">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('social_user') ?>">Social User</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('register_user') ?>">Register User</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('basket_delivery') ?>">
              <i class="ion ion-md-basket menu-icon"></i>
              <span class="menu-title">Basket Delivery</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('user_review') ?>">
              <i class="ion ion-md-happy menu-icon"></i>
              <span class="menu-title">User Reviews</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-order" aria-expanded="false" aria-controls="ui-order">
              <i class="ion ion-md-pricetag menu-icon"></i>
              <span class="menu-title">Order</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-order">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_preorder') ?>">View Preorder</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('user_order') ?>">User Order</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('filter_order') ?>">Filter Order</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('failed_transaction') ?>">Failed Order</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-fproduct" aria-expanded="false" aria-controls="ui-fproduct">
              <i class="ion ion-md-cube menu-icon"></i>
              <span class="menu-title">Featured Product</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-fproduct">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_featured_product') ?>">Add Featured Product</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_featured_product') ?>">View Featured Product</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-testimonial" aria-expanded="false" aria-controls="ui-testimonial">
              <i class="ion ion-md-contact menu-icon"></i>
              <span class="menu-title">Testimonial</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-testimonial">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_testimonial') ?>">Add Testimonial</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_testimonial') ?>">View Testimonial</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-Pincode" aria-expanded="false" aria-controls="ui-Pincode">
              <i class="ion ion-md-paper menu-icon"></i>
              <span class="menu-title">Pincode</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Pincode">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('add_pincode') ?>">Add Pincode</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_pincode') ?>">View Pincode</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-Moderator" aria-expanded="false" aria-controls="ui-Moderator">
              <i class="ion ion-md-paper menu-icon"></i>
              <span class="menu-title">Moderator</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Moderator">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('moderator') ?>">Add Moderator</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_moderator') ?>">View Moderator</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-Moderator" aria-expanded="false" aria-controls="ui-Moderator">
              <i class="ion ion-md-paper-plane menu-icon"></i>
              <span class="menu-title">Blogger</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Moderator">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('blogger') ?>">Add Blogger</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_blogger') ?>">View Blogger</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-Manager" aria-expanded="false" aria-controls="ui-Manager">
              <i class="ion ion-md-build menu-icon"></i>
              <span class="menu-title">Operation Manager</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Manager">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('operation_manager') ?>">Add Operation Manager</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url('view_operation_manager') ?>">View Operation Manager</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
<div class="main-panel">