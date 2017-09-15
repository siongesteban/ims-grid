		<?php
		  if(!$this->session->userdata('loggedIn') || $this->session->userdata('memberId') !== $member['id_member']) {
		    redirect('');
		  }
	  ?>
		<div class="container">
			<div class="row form-sign">
				<div class="col-md-12 col-lg-3">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation" class="active"><a href="<?php echo base_url(); ?>settings/profile/<?php echo $member['id_member']; ?>">Edit Profile</a></li>
					  <li role="presentation"><a href="<?php echo base_url(); ?>settings/password/<?php echo $member['id_member']; ?>">Change Password</a></li>
					  <li role="presentation"><a href="<?php echo base_url(); ?>settings/networks/<?php echo $member['id_member']; ?>">Networks</a></li>
					  <li role="presentation"><a href="<?php echo base_url(); ?>settings/delete/<?php echo $member['id_member']; ?>">Delete Account</a></li>
					</ul>
				</div>
				<div class="col-md-12 col-lg-9">
					<?php if($this->session->flashdata('updateProfileSuccess')): ?>
						<div class="form-group row">
              <div class="col-md-12">
                <p class="form-success-msg show">
                  <span class="msg">
                    <?php
                        echo $this->session->flashdata('updateProfileSuccess');
                    ?>
                  </span>
                </p>
              </div>
            </div>
          <?php endif; ?>
          <form role="form" data-toggle="validator" method="POST" action="<?php echo base_url(); ?>member/updateprofile/<?php echo $member['id_member']; ?>">

          	<?php if($this->session->userdata('published') === '1'): ?>
          		<p class="form-err-msg show" style="border-color: #0094ff">
                <span class="msg">
                  To change your profile and cover picture, go to your <a href="<?php echo base_url(); ?>member/<?php echo $member['id_member']; ?>">profile page</a>.
                </span>
              </p>
              <hr>
						<?php endif; ?>
						</p>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-lbl" for="inp-username">Username</label>
									<?php
	                  echo form_error('username');
	                ?>
		  						<input id="inp-username" class="form-inp form-inp-txt" type="text" name="username" pattern="[a-zA-Z 0-9_]+" data-minlength="4" maxLength="12" data-required-error="Please fill out this field." data-pattern-error="This field can't contain special symbols" value="<?php echo $member['username']; ?>" required/>
	                <div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-lbl" for="inp-fname">First Name</label>
									<?php
	                  echo form_error('fname');
	                ?>
		  						<input class="form-inp form-inp-txt" id="inp-fname" type="text" name="fname" placeholder="First Name" value="<?php echo $member['first_name']; ?>" pattern="[a-zA-Z ]+" maxLength="50" data-pattern-error="This field can't contain symbols and numbers." required/>
		  						<div class="help-block with-errors"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-lbl" for="inp-lname">Last Name</label>
									<?php
	                  echo form_error('lname');
	                ?>
		  						<input class="form-inp form-inp-txt" id="inp-lname" type="text" name="lname" placeholder="Last Name" value="<?php echo $member['last_name']; ?>" pattern="[a-zA-Z ]+" maxLength="50" data-pattern-error="This field can't contain symbols and numbers." required/>
		  						<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<label class="form-lbl" for="inp-shortbio">Short Bio</label>
								<?php
                  echo form_error('shortbio');
                ?>
	  						<textarea class="form-inp form-inp-txt" id="inp-shortbio" name="shortbio" rows="5" data-minlength="50" maxlength="600" data-error="Use 50 characters or more." data-required-error="Please fill out this field." required><?php echo $member['short_bio']; ?></textarea>
	  						<div class="help-block with-errors"></div>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-6 col-md-offset-6">
							<input class="form-inp form-inp-btn form-inp-btn-green" type="submit" value="Save Changes"
							/>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>