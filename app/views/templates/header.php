  <!DOCTYPE html>
  <!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
  <!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
  <!--[if IE 8]><html class="preIE9"><![endif]-->
  <!--[if gte IE 9]><!-->
  <!--<![endif]-->
  <html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width,initial-scale=1">

      <title><?php echo $title; ?></title>

      <meta name="author" content="Siong Esteban">
      <meta name="description"
        content="
          <?php if(!$desc): ?>
          The official website of Interactive Media Society of AMA Computer College - Tarlac Campus.
          <?php else: echo $desc; ?>
          <?php endif; ?>
      ">
      <meta name="keywords" content="gallery, photography, portfolio, photography club, official, ims, ama computer college">

      <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
      <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
      <link href="<?php echo base_url(); ?>assets/css/simplelightbox.min.css" rel="stylesheet" />
      <link href="<?php echo base_url(); ?>assets/css/fonts.css" rel="stylesheet" />
      <link href="<?php echo base_url(); ?>assets/css/ims-grid.css" rel="stylesheet" />

      <link rel="shortcut icon" href="favicon/favicon.ico" type="image/vnd.microsoft.icon">
      <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>favicon/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>favicon/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>favicon/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>favicon/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>favicon/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>favicon/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>favicon/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>favicon/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>favicon/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>favicon/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>favicon/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>favicon/favicon-16x16.png">
      <link rel="manifest" href="favicon/manifest.json">

      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">

      <script type="text/javascript">
         var _gaq = _gaq || [];
         _gaq.push(['_setAccount', 'UA-XXXXXXXX-Y']);
         _gaq.push(['_trackPageview']);
         (function()
         {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
         })();
      </script>
    </head>
    <body>
      <div id="wrapper">
      <!--navigation bar-->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="<?php echo base_url(); ?>">IMS Grid</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav no-border">
              <li><a href="<?php echo base_url(); ?>grid">Grid</a></li>
              <li><a href="<?php echo base_url(); ?>categories">Categories</a></li>
              <li><a href="<?php echo base_url(); ?>members">Members</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php if($this->session->userdata('loggedIn')): ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <img class="img-responsive navbar-user-avatar" src='<?php echo base_url(); ?>assets/images/uploads/users/avatars/<?php echo $this->session->userdata('memberAvatar'); ?>'/>
                  <?php echo character_limiter($this->session->userdata('firstName'), 6); ?>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url(); ?>upload">Upload</a></li>
                  <li><a href="<?php echo base_url(); ?>member/<?php echo $this->session->userdata('memberId'); ?>">Profile</a></li>
                  <li><a href="<?php echo base_url(); ?>settings/profile/<?php echo $this->session->userdata('memberId'); ?>">Settings</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?php echo base_url(); ?>logout/<?php echo $this->session->userdata('memberId'); ?>">Log Out</a></li>
                </ul>
              </li>
              <?php else: ?>
              <!---<li><a class="nav-item-blue" href="<?php echo base_url(); ?>login">Log In</a></li>
              <li><a class="nav-item-green" href="<?php echo base_url(); ?>create">Create Account</a></li>-->
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>
      <div class="load">
        <p><i class="fa fa-spinner fa-spin" style="color: #0094ff" aria-hidden="true"></i></p>
      </div>
      <div class="body">
      <?php if($this->session->flashdata('uploadSuccess')): ?>
        <div class="alert alert-info alert-dismissible" role="alert" style="font-family: sans-serif !important;">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Upload successful.</strong> <?php echo $this->session->flashdata('uploadSuccess'); ?>
        </div>
      <?php endif; ?>