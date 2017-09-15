    <?php
      if($this->session->userdata('loggedIn')) {
        redirect('home');
      }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <form class="form-sign" method="POST" data-toggle="validator" role="form" action="<?php echo base_url(); ?>create">
          <?php if($this->session->flashdata('signupFailed')): ?>
            <div class="form-group row">
              <div class="col-md-12">
                <p class="form-err-msg show">
                  <span class="head">Error</span>: <span class="msg">
                    <?php
                        echo $this->session->flashdata('signupFailed');
                    ?>
                  </span>
                </p>
              </div>
            </div>
          <?php endif; ?>
            <div class="form-group row">
              <div class="col-md-12">
                <p class="form-err-msg show" style="border-color: #0094ff;">
                  <span class="msg">
                    Only the members of Interactive Member Society can create an account here on IMS Grid.<br>The ID is given during the membership.
                  </span>
                </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="inp-id" class="form-lbl">ID</label>
                  </div>
                  <div class="col-md-12">
                    <?php echo form_error('id-member'); ?>
                    <input id="inp-id" class="form-inp form-inp-txt" type="text" name="id-member" value="<?php if($this->session->flashdata('logId')) echo $this->session->flashdata('logId'); ?>" pattern="[-+]?[0-9]*?[0-9]+" maxLength="6" data-pattern-error="Invalid ID" data-required-error="Please fill out this field." required/>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="inp-username" class="form-lbl">Username</label>
                  </div>
                  <div class="col-md-12">
                    <?php echo form_error('username'); ?>
                    <input id="inp-username" class="form-inp form-inp-txt" type="text" name="username" value="<?php if($this->session->flashdata('logUsername')) echo $this->session->flashdata('logUsername'); ?>" pattern="[A-Za-z0-9\S]{1,25}" data-minlength="4" maxLength="12" data-required-error="Please fill out this field." data-pattern-error="Username can't contain spaces" required/>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="inp-password" class="form-lbl">Password</label>
                  </div>
                  <div class="col-md-12">
                    <?php echo form_error('password'); ?>
                    <input id="inp-password" class="form-inp form-inp-txt" type="password" name="password" minlength="8" maxLength="255" data-minlength-error="Too short" data-required-error="Please fill out this field." required/>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="inp-confirm-password" class="form-lbl">Confirm Password</label>
                  </div>
                  <div class="col-md-12">
                    <?php echo form_error('password-confirm'); ?>
                    <input id="inp-confirm-password" class="form-inp form-inp-txt" type="password" name="password-confirm" minlength="8" maxLength="255" data-match="#inp-password" required/>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label class="form-lbl" for="inp-shortbio">Short Bio</label>
                    <?php
                      echo form_error('shortbio');
                    ?>
                  </div>
                  <div class="col-md-12">
                    <textarea class="form-inp form-inp-txt" id="inp-shortbio" name="shortbio" rows="5" data-minlength="50" maxlength="600" data-error="Use 50 characters or more." data-required-error="Please fill out this field." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="inp-security-question" class="form-lbl">Security Question</label>
                  </div>
                  <div class="col-md-12">
                    <?php echo form_error('security-question'); ?>
                    <input id="inp-security-question" class="form-inp form-inp-txt" type="text" name="security-question" required/>
                    <div class="help-block with-errors"></div>
                    <p class="form-err-msg show" style="border-color: #0094ff; padding-top: 10px;">
                      <span class="msg">
                        Security question will be used for account recovery.
                        <br>*Make sure that you're the only one who knows the answer.
                        <br>e.g. What is the first name of the person you first kissed?
                      </span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="inp-security-question-ans" class="form-lbl">Answer to your Security Question</label>
                  </div>
                  <div class="col-md-12">
                    <?php echo form_error('security-question-ans'); ?>
                    <input id="inp-security-question-ans" class="form-inp form-inp-txt" type="text" name="security-question-ans" required/>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="form-group row">
                  <div class="col-md-12">
                    <input class="form-inp form-inp-btn form-inp-btn-green" id="inp-id" type="submit" name="id" value="Create Account"/>
                  </div>
                  <div class="col-md-12">
                      <p class="text-center gray"><em>or</em></p>
                    </div>
                    <div class="col-md-12">
                      <a class="form-inp form-inp-btn form-inp-btn-blue" href="<?php echo base_url(); ?>login">Log In</a>
                    </div>
                </div>
              </div>
            </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
