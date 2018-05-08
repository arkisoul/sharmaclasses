<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login | Admin</title>

  <!-- Bootstrap CSS -->
  <link href="<?php echo base_url(); ?>theme/css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="<?php echo base_url(); ?>theme/css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="<?php echo base_url(); ?>theme/css/elegant-icons-style.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>theme/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="<?php echo base_url(); ?>theme/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>theme/css/style-responsive.css" rel="stylesheet" />

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-img3-body">
  <div class="container">
    <div class="login-form">
      <div class="alert alert-success alert-dismissible alert-alert" role="alert" id="alertSuccess">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success!</strong> Login Successful!
      </div>
      <div class="alert alert-danger alert-dismissible alert-alert" role="alert" id="alertDanger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> Incorrect username or password!
      </div>
      <?php echo form_open('admin', array('id' => 'loginForm', 'role' => 'form')); ?>
        <div class="login-wrap">
          <p class="login-img"><i class="icon_lock_alt"></i></p>
          <div class="input-group">
            <span class="input-group-addon"><i class="icon_profile"></i></span>
            <?php echo form_input('username', '', array('class' => 'form-control', 'id' => 'username', 'placeholder' => 'Enter your Username', 'autofocus' => 'true', 'autocomplete' => 'true')); ?>
          </div>
          <div class="form_error"></div>
          <div class="input-group">
            <span class="input-group-addon"><i class="icon_key_alt"></i></span>
            <?php echo form_password('password', '', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Enter your Password', 'autofocus' => 'true', 'autocomplete' => 'true')); ?>
          </div>
          <div class="form_error"></div>
          <?php echo form_submit(array('value' => 'Login', 'name' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block', 'id' => 'login-btn')); ?>
        </div>
      <?php echo form_close(); ?>
    </div>
  </div>
  <script src="<?php echo base_url(); ?>theme/js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>theme/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>theme/js/ajax-calls.js"></script>
</body>
</html>
