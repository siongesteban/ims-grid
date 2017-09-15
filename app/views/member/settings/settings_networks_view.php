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
					  <li role="presentation" class="active"><a href="<?php echo base_url(); ?>settings/networks/<?php echo $member['id_member']; ?>">Networks</a></li>
					  <li role="presentation"><a href="<?php echo base_url(); ?>settings/delete/<?php echo $member['id_member']; ?>">Delete Account</a></li>
					</ul>
				</div>
				<div class="col-md-12 col-lg-9">
					<?php echo form_open('member/savenetwork/'.$member['id_member']); ?>
						<div class="form-group row">
							<div class="col-lg-6 col-md-12">
								<label class="form-lbl" for="inp-password">Facebook</label>
	  						<input class="form-inp form-inp-txt" id="inp-password" type="text" name="n-facebook" placeholder="Enter Facebook username" value="<?php echo $member['n_facebook']; ?>"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6 col-md-12">
								<label class="form-lbl" for="inp-password">Twitter</label>
	  						<input class="form-inp form-inp-txt" id="inp-password" type="text" name="n-twitter" placeholder="Enter Twitter username" value="<?php echo $member['n_twitter']; ?>"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6 col-md-12">
								<label class="form-lbl" for="inp-password">Instagram</label>
								<?php
                  echo form_error('security-question-ans');
                ?>
	  						<input class="form-inp form-inp-txt" id="inp-password" type="text" name="n-instagram" placeholder="Enter Instagram username" value="<?php echo $member['n_instagram']; ?>"/>
							</div>
						</div>
						<hr>
						<div class="form-group row">
							<div class="col-md-6">
								<input class="form-inp form-inp-btn form-inp-btn-green" type="submit" value="Save"/>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>