<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

  <link href="<?php echo base_url(); ?>assets/css/fonts.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ims-grid-styles/ims-grid-admin.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.skin-blue.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
  <link href="<?php echo base_url(); ?>assets/css/simplelightbox.min.css" rel="stylesheet" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>A</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>IMSG</b>Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/images/uploads/users/avatars/<?php echo $this->session->userdata('avatarFileName'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo character_limiter($this->session->userdata('name'), 11); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/images/uploads/users/avatars/<?php echo $this->session->userdata('avatarFileName'); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo character_limiter($this->session->userdata('name'), 11); ?>
                  <small>Administrator since
                  <?php echo date('F d, o', strtotime($this->session->userdata('createDate'))); ?>
                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a class="btn btn-default btn-flat" data-toggle="modal" data-target="#admin-modal">Settings</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url(); ?>admin/logout" class="btn btn-default btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="modal fade" id="admin-modal" tabindex="-1" role="dialog" aria-hidden="true" style="font-family: sans-serif !important;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Admin Settings</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php echo form_open('admin/update/'.$admin[0]['id_admin']); ?>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-6">
                <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $admin[0]['first_name']; ?>" minLength="3" required/>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $admin[0]['last_name']; ?>" minLength="3" required/>
              </div>
            </div>
            <hr>
            <div class="form-group row">
              <div class="col-md-6">
                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $admin[0]['username']; ?>"  minLength="6" required/>
              </div>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password" placeholder="Change password"/>
              </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <input type="submit" class="btn btn-primary" value="Save"/>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/images/uploads/users/avatars/<?php echo $this->session->userdata('avatarFileName'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <br><p><?php echo character_limiter($this->session->userdata('name'), 11); ?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if($activePage === 'dashboard') echo 'active'; ?>
        treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($activePage === 'dashboard') echo 'class="active"'; ?>><a href="<?php echo base_url(); ?>admin"><i class="fa fa-circle-o"></i> Home</a></li>
          </ul>
        </li>
        <li class="<?php if($activePage === 'members') echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>admin/users/members">
            <i class="fa fa-users"></i>
            <span>Members</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"><?php echo $countMember; ?></span>
            </span>
          </a>
        </li>
        <li class="<?php if($activePage === 'postapprovals' || $activePage === 'approvedposts') echo 'active'; ?> treeview">
          <a href="#">
            <i class="fa fa-photo"></i>
            <span>Posts</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"><?php echo $countPost; ?></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($activePage === 'postapprovals') echo 'class="active"'; ?>">
              <a href="<?php echo base_url(); ?>admin/posts/approvals">
              <i class="fa fa-circle-o"></i> Approvals
              <span class="pull-right-container">
                <span class="label pull-right"><?php echo $countPostApprovals; ?></span>
              </span>
              </a>
            </li>
            <li <?php if($activePage === 'approvedposts') echo 'class="active"'; ?>">
              <a href="<?php echo base_url(); ?>admin/posts/published">
              <i class="fa fa-circle-o"></i> Published
              <span class="pull-right-container">
                <span class="label pull-right"><?php echo $countPostPublished; ?></span>
              </span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">