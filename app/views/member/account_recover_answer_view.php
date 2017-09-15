    <?php if(!$this->session->flashdata('idFound')) redirect('recover'); ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <form class="form-sign" method="POST" action="<?php echo base_url(); ?>recover/<?php echo $this->session->flashdata('memberId'); ?>">
            <?php if(!$this->session->flashdata('successRecovery')): ?>
              <?php if($this->session->flashdata('invalidAnswer')): ?>
              <div class="form-group row">
                <div class="col-md-12">
                  <p class="form-err-msg show">
                    <span class="head">Error</span>: <span class="msg">
                      <?php
                          echo $this->session->flashdata('invalidAnswer');
                      ?>
                    </span>
                  </p>
                </div>
              </div>
              <?php endif; ?>
              <div class="form-group row">
                <div class="col-md-12">
                  <small>To recover your account, please answer the security question.</small><br>
                  <label for="inp-id" class="form-lbl"><?php echo $this->session->flashdata('securityQuestion'); ?></label>
                </div>
                <div class="col-md-12">
                  <?php
                    echo form_error('security-question-ans-r');
                  ?>
                  <input id="inp-id" class="form-inp form-inp-txt" type="text" name="security-question-ans-r" placeholder="Enter your answer"/>
                </div>
              </div>
              <hr>
              <div class="form-group row">
                <div class="col-md-12">
                  <input class="form-inp form-inp-btn form-inp-btn-blue" type="submit" value="Submit"/>
                </div>
              </div>
            <?php else: ?>
              <div class="form-group row">
                <div class="col-md-12">
                  <p class="form-success-msg show">
                      Your account has been recovered.<br>Below is your new password. Your can now log in your account.
                    </span>
                  </p>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-12">
                <input id="inp-id" class="form-inp form-inp-txt text-center" type="text" value="<?php echo $this->session->flashdata('newPassword'); ?>" disabled/>
                <a href="<?php echo base_url(); ?>login">Go to log in page.</a>
                </div>
              </div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
