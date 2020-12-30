<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome Admin</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.6.1/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/theam/css/vendor.bundle.base.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/theam/css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/theam/css/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/theam/css/jquery-jvectormap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/theam/css/style.css??rnd=1.1" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/jquery.datepicker.css">
    <?php require_once('assets/data_table/data_table_css.php') ?>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/form_validation/formFieldValidation.js"></script>
    <script>
        var base_url = "<?php echo base_url(); ?>";
    </script>

</head>

<body>
 <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="img-logocss d-none d-lg-block brand-logo" href="#">
            <img src="https://www.farmstop.in/assets/images/farmstop.png" class="img-fluid"> 
        </a>
        <a class="navbar-brand brand-logo-mini" href="#">
            <?php

                            $result = $model2->getDetails($this->session->uid);
                            $inst_tbl = $model3->getInstitute($result['inst_tbl_id']);

                            ?>

                                <img src="https://www.farmstop.in/assets/images/farmstop.png" height="50" width="50" style="border-radius:50%">
        </a>
      </div>
      <div class="navbar-menu-wrapper">
        <div class="navbar-menu-wrapper-inner d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon ion-md-menu"></span>
          </button>
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="search">
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="search">
              </div>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <!--li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="icon ion-md-notifications-outline mx-0"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="icon ion-md-information-circle-outline mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Just now
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="icon ion-md-settings mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Private message
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="ion ion-md-contact mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      2 days ago
                    </p>
                  </div>
                </a>
              </div>
            </li-->
            <!--li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                <i class="ion ion-md-expand mx-0"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                      <img src="assets/images/faces/face28.png" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                      The meeting is cancelled
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                      <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                      New product launch
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                      <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                      Upcoming board meeting
                    </p>
                  </div>
                </a>
              </div>
            </li-->
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <span class="nav-profile-name">Admin</span>
                <img src="https://www.farmstop.in/assets/images/farmstop.png" style="width:34px !important">
                <!--<img src="<?php echo base_url() ?>assets/theam/images/faces/face28.png" alt="profile"/>-->
                
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="icon ion-md-settings text-primary"></i>
                  User Profile
                </a>
                <a class="dropdown-item" href="<?php echo base_url('logout'); ?>">
                  <i class="ion ion-md-log-out text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon ion-md-menu"></span>
          </button>
        </div>
      </div>
    </nav>
