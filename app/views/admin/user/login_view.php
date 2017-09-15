<?php if($this->session->userdata('userLoggedIn')) redirect('admin'); ?>
<div class="container">
  <div class="login-box">
    <div class="row">
      <div class="col-md-12">
        <div class="login-logo">
          <a href="<?php echo base_url(); ?>admin">
            IMSG<b>Admin</b>
          </a>
        </div>
        <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Log In</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
              $formAttr = array('class' => 'form-horizontal');
              echo form_open('admin/login', $formAttr);
            ?>
              <div class="box-body">
                <?php if($this->session->flashdata('adminLoginFailed')): ?>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <i class="fa fa-circle-o text-red"></i>
                      <span><?php echo $this->session->flashdata('adminLoginFailed'); ?></span>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="form-group <?php if(form_error('username')) echo 'has-error'; ?>">
                  <div class="col-sm-3">
                    <label for="inp-username" class="control-label">Username</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inp-username" name="username" placeholder="Username">
                   <?php echo form_error('username'); ?>
                  </div>
                </div>
                <div class="form-group <?php if(form_error('password')) echo 'has-error'; ?>">
                  <div class="col-sm-3">
                    <label for="inp-password" class="control-label">Password</label>
                  </div>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="inp-password" name="password" placeholder="Password">
                    <?php echo form_error('password'); ?>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-default" href="<?php echo base_url(); ?>">Cancel</a>
                <input type="submit" class="btn btn-info pull-right" value="Log In"/>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
      </div>
    </div>
  </div>
</div>