<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | Admin</title>

    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url(); ?>theme/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url(); ?>theme/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url(); ?>theme/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>theme/css/font-awesome.min.css" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="<?php echo base_url(); ?>theme/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>theme/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="<?php echo base_url(); ?>theme/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/css/owl.carousel.css" type="text/css">
    <link href="<?php echo base_url(); ?>theme/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>theme/css/fullcalendar.css">
    <link href="<?php echo base_url(); ?>theme/css/widgets.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>theme/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>theme/css/style-responsive.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>theme/css/xcharts.min.css" rel=" stylesheet">
    <link href="<?php echo base_url(); ?>theme/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>theme/js/jquery.js"></script>
  </head>
  <body>
    <!-- container section start -->
    <section id="container" class="">
      <header class="header dark-bg">
        <div class="toggle-nav">
            <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class=""></i></div>
        </div>

        <!--logo start-->
        <a href="<?php echo base_url(); ?>dashboard" class="logo"><span class="lite"><i class="fa fa-dashboard"></i> Admin Dashboard</span></a>
        <!--logo end-->
        <div class="top-nav notification-row">
          <!-- notificatoin dropdown start-->
          <ul class="nav pull-right top-menu">
            <!-- task notificatoin start -->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="profile-ava">
                        <img alt="" src="">
                    </span>
                    <span class="username">Welcome <?php $user = $this->session->__get('user');
echo ucwords($user['name']);?>
                    </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li class="eborder-top">
                        <a href="#"><i class="icon_profile"></i> My Profile</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/logout"><i class="icon_key_alt"></i> Log Out</a>
                    </li>
                </ul>
            </li>
          </ul>
          <!-- notificatoin dropdown end-->
        </div>
      </header>
      <!--header end-->

  <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="active">
                      <a class="" href="<?php echo base_url(); ?>dashboard">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                           <i class="fa fa-book"></i>
                          <span>Subject</span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="<?php echo base_url(); ?>subject/new"><i class="fa fa-plus"></i> Add</a></li>
                          <li><a class="" href="<?php echo base_url(); ?>subject"><i class="fa fa-list"></i> List</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="fa fa-file-text"></i>
                          <span>Chapter</span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="<?php echo base_url(); ?>chapter/new"><i class="fa fa-plus"></i> Add</a></li>
                          <li><a class="" href="<?php echo base_url(); ?>chapter"><i class="fa fa-list"></i> List</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="fa fa-certificate"></i>
                          <span>Test</span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="<?php echo base_url(); ?>test/new"><i class="fa fa-plus"></i> Add</a></li>
                          <li><a class="" href="<?php echo base_url(); ?>test"><i class="fa fa-list"></i> List</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" class="">
                          <i class="fa fa-question"></i>
                          <span>Question</span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="<?php echo base_url(); ?>question/new"><i class="fa fa-plus"></i> Add</a></li>
                          <li><a class="" href="<?php echo base_url(); ?>question"><i class="fa fa-list"></i> List</a></li>
                          <li><a class="" href="<?php echo base_url(); ?>question/import"><i class="fa fa-upload"></i> Upload Questions</a></li>
                      </ul>
                  </li>

                  <!-- <li class="sub-menu">
                      <a href="javascript:;" class="">
                         <i class="fa fa-user"></i>
                          <span>Users</span>
                      </a>
                      <ul class="sub">
                          <li><a class="" href="<?php echo base_url(); ?>admin/user_list">User List</a></li>
                      </ul>
                  </li> -->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

