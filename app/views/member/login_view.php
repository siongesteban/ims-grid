    <?php
      if($this->session->userdata('loggedIn')) {
        redirect('home');
      }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <form class="form-sign" role="form" data-toggle="validator" method="POST" action="<?php echo base_url(); ?>login">
            <?php if($this->session->flashdata('loginFailed')): ?>
            <div class="form-group row">
              <div class="col-md-12">
                <p class="form-err-msg show">
                  <span class="head">Error</span>: <span class="msg">
                    <?php
                        echo $this->session->flashdata('loginFailed');
                    ?>
                  </span>
                </p>
              </div>
            </div>
            <?php elseif($this->session->flashdata('signupSuccess')): ?>
            <div class="form-group row">
              <div class="col-md-12">
                <p class="form-success-msg show">
                  <span class="msg">
                    <?php
                        echo $this->session->flashdata('signupSuccess');
                    ?>
                  </span>
                </p>
              </div>
            </div>
            <?php endif; ?>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="inp-username" class="form-lbl">Username</label>
              </div>
              <div class="col-md-12">
                <?php
                  echo form_error('username');
                ?>
                <input id="inp-username" class="form-inp form-inp-txt" type="text" name="username"
                value="<?php if($this->session->flashdata('logUsername')) echo $this->session->flashdata('logUsername'); ?>" required/>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="inp-password" class="form-lbl">Password</label>
              </div>
              <div class="col-md-12">
                <?php
                  echo form_error('password');
                ?>
                <input id="inp-password" class="form-inp form-inp-txt" type="password" name="password" required/>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <a href="<?php echo base_url(); ?>recover" class="anch-blue anch-bold">Forgot password?</a>
              </div>
            </div>
            <hr>
            <div class="form-group row">
              <div class="col-md-12">
                <input class="form-inp form-inp-btn form-inp-btn-blue" id="btn-login" type="submit" value="Log In"/>
              </div>
              <div class="col-md-12">
                <p class="text-center gray"><em>or</em></p>
              </div>
              <div class="col-md-12">
                <a class="form-inp form-inp-btn form-inp-btn-green" href="<?php echo base_url(); ?>create">Create Account</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
