    <?php if(!$this->session->userdata('userLoggedIn')) redirect('admin/login'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Home</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Home</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $countPost; ?></h3>
              <p>Post<?php if($countPost > 1) echo 's'; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-image<?php if($countPost > 1) echo 's'; ?>"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/posts/published" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $countLoggedIn; ?></h3>
              <p>Online User<?php if($countLoggedIn > 1) echo 's'; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-<?php if($countLoggedIn <= 1) echo 'person'; else echo 'ios-people' ?>"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/users/members/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $countMember; ?></h3>
              <p>Member<?php if($countMember > 1) echo 's'; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-<?php if($countMember <= 1) echo 'person-outline'; else echo 'ios-people-outline' ?>"></i>
            </div>
            <a href="<?php echo base_url(); ?>admin/users/members/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->