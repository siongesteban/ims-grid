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
					  <li role="presentation"><a href="<?php echo base_url(); ?>settings/password/<?php echo $member['id_member']; ?>">Change Password</a></li>
					  <li role="presentation"><a href="<?php echo base_url(); ?>settings/networks/<?php echo $member['id_member']; ?>">Networks</a></li>
					  <li role="presentation" class="active"><a href="<?php echo base_url(); ?>settings/delete/<?php echo $member['id_member']; ?>">Delete Account</a></li>
					</ul>
				</div>
				<div class="col-md-12 col-lg-9">
					<?php if($this->session->flashdata('deleteAccountFailed')): ?>
						<div class="form-group row">
              <div class="col-md-12">
                <p class="form-err-msg show">
                  <span class="msg">
                    <?php
                        echo $this->session->flashdata('deleteAccountFailed');
                    ?>
                  </span>
                </p>
              </div>
            </div>
          <?php endif; ?>
					<?php echo form_open('member/deleteaccount/'.$member['id_member']); ?>
						<div class="form-group row">
							<div class="col-md-6">
								<label class="form-lbl" for="inp-password">Security Question:<br><?php echo $member['security_question'] ?></label>
								<?php
                  echo form_error('security-question-ans');
                ?>
	  						<input class="form-inp form-inp-txt" id="inp-password" type="text" name="security-question-ans" placeholder="Enter the answer"/>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-6">
								<input class="form-inp form-inp-btn form-inp-btn-red" type="submit" value="Delete Account"/>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>