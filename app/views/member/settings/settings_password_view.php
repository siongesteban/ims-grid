		<?php
		  if(!$this->session->userdata('loggedIn') || $this->session->userdata('memberId') !== $member['id_member']) {
		    redirect('');
		  }
	  ?>
		<div class="container">
			<div class="row form-sign">
				<div class="col-md-12 col-lg-3">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation"><a href="<?php echo base_url(); ?>settings/profile/<?php echo $member['id_member']; ?>">Edit Profile</a></li>
					  <li role="presentation" class="active"><a href="<?php echo base_url(); ?>settings/password/<?php echo $member['id_member']; ?>">Change Password</a></li>
					  <li role="presentation"><a href="<?php echo base_url(); ?>settings/networks/<?php echo $member['id_member']; ?>">Networks</a></li>
					  <li role="presentation"><a href="<?php echo base_url(); ?>settings/delete/<?php echo $member['id_member']; ?>">Delete Account</a></li>
					</ul>
				</div>
				<div class="col-md-12 col-lg-9">
					<?php if($this->session->flashdata('updatePasswordSuccess')): ?>
						<div class="form-group row">
              <div class="col-md-12">
                <p class="form-success-msg show">
                  <span class="msg">
                    <?php
                        echo $this->session->flashdata('updatePasswordSuccess');
                    ?>
                  </span>
                </p>
              </div>
            </div>
          <?php else: ?>
	          <div class="form-group row">
	              <div class="col-md-12">
	                <p class="form-err-msg show">
	                  <span class="msg">
	                    <?php
	                        echo $this->session->flashdata('updatePasswordFailed');
	                    ?>
	                  </span>
	                </p>
	              </div>
	            </div>
          <?php endif; ?>
					<?php echo form_open('member/updatepassword/'.$member['id_member']); ?>
						<div class="form-group row">
							<div class="col-md-6">
								<label class="form-lbl" for="inp-old-password">Current Password</label>
								<?php
                  echo form_error('old-password');
                ?>
	  						<input class="form-inp form-inp-txt" id="inp-old-password" type="password" name="old-password" placeholder="Enter old password"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label class="form-lbl" for="inp-new-password">New Password</label>
								<?php
                  echo form_error('new-password');
                ?>
	  						<input class="form-inp form-inp-txt" id="inp-new-password" type="password" name="new-password" placeholder="Enter new password"/>
							</div>
							<div class="col-md-6">
								<label class="form-lbl" for="inp-new-password-confirm">Confirm New Password</label>
								<?php
                  echo form_error('new-password-confirm');
                ?>
	  						<input class="form-inp form-inp-txt" id="inp-new-password-confirm" type="password" name="new-password-confirm" placeholder="Confirm new password"/>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-6 col-md-offset-6">
							<input class="form-inp form-inp-btn form-inp-btn-green" type="submit" value="Save changes"/>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>