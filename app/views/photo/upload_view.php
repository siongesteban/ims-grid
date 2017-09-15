	<?php
	  if(!$this->session->userdata('loggedIn')) {
	    redirect('login');
	  } elseif($this->session->userdata('published') === '0') {
      redirect('settings/profile/'.$this->session->userdata('memberId'));
	  }
  ?>
    <div class="container">
    	<div class="row">
    		<div class="col-md-10 col-md-offset-1 upload-container">
    			<?php
    				$attributes = array(
    					'class' => 'form-sign',
    					'data-toggle' => 'validator',
    					'role' => 'form'
  					);

  					echo form_open_multipart('upload', $attributes);
    			?>
    				<input type="hidden" value="<?php echo $this->session->userdata('memberId'); ?>" name="id"/>
    				<div class="row">
    					<div class="col-md-6">
    						<div class="row">
			    				<div class="col-md-12">
			    					<div class="image-container">
			    						<p id="browse-thumbnail" class="text-center text-center-v">
			    							<i class="fa fa-image"></i>
			    						</p>
			    						<img id="img-preview" class="img-responsive" src=""/>
			    					</div>
			    					<div class="form-group">
				    					<input id="browse-file" type="file" name="userfile" accept="image/jpeg" data-required-error="Please select an image file." required/>
				    					<div class="help-block with-errors"></div>
			    					</div>
			    					<?php if(!empty($error)): ?>
			    					<div class="form-err-msg show">
		                  <span class="head">Error</span>: <span class="msg">
		                    <?php
		                        echo $error;
		                    ?>
		                  </span>
		                </div>
		              	<?php endif; ?>
		              	<p class="form-err-msg show" style="border-color: #0094ff;">
                      <span class="msg">
                        <strong>Requirements:</strong><br>
                        <strong><em>Maximum file size:</em></strong> 5MB<br>
                        <strong><em>Maximum dimension:</em></strong> 3000px<br>
                        <strong><em>Minimum dimension:</em></strong> 1000px<br>
                      </span>
                    </p><br>
			    				</div>
			    			</div>
    					</div>
    					<div class="col-md-6">
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
		            <?php endif; ?>
    						<div class="form-group row">
			  					<div class="col-md-12">
			  						<label class="form-lbl">Category</label>
			  					</div>
			  					<div class="col-md-12">
			  						<select class="form-inp form-inp-txt" name="category">
			  							<option value="Uncategorized" selected>Uncategorized</option>
			  							<?php
			  								foreach($categories as $category): 
			  									if($category['slug'] === 'uncategorized') continue;
			  							?>
			  								<option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
			  							<?php endforeach; ?>
			  						</select>
			  					</div>
			  				</div>
			  				<div class="form-group row">
			  					<div class="col-md-12">
			  						<label class="form-lbl">Title</label>
			  					</div>
			  					<div class="col-md-12">
			  						<?php
		                  echo form_error('title');
		                ?>
			  						<input class="form-inp form-inp-txt" type="text" name="title" maxLength="50" required/>
			  						<div class="help-block with-errors"></div>
			  					</div>
			  				</div>
			  				<div class="form-group row">
			  					<div class="col-md-12">
			  						<label class="form-lbl">Description</label>
			  					</div>
			  					<div class="col-md-12">
			  						<?php
		                  echo form_error('story');
		                ?>
			  						<textarea class="form-inp form-inp-txt" name="story" placeholder="Tell us more about your beautiful photo" rows="10" data-minlength="50" maxlength="1000" data-error="Use 50 characters or more." data-required-error="Please fill out this field." required></textarea>
			  						<div class="help-block with-errors"></div>
			  					</div>
			  				</div>
			  				<hr>
		  					<div class="form-group row">
			  					<div class="col-md-12">
			  						<label class="form-lbl">Camera</label>
			  					</div>
			  					<div class="col-md-12">
			  						<input class="form-inp form-inp-txt" type="text" name="camera" required/>
			  						<div class="help-block with-errors"></div>
			  					</div>
		  					</div>
		  					<div class="form-group row">
		  						<div class="col-lg-4 col-xs-4">
		  							<label class="form-lbl">Aperture<br></label>
		  						</div>
		  						<div class="col-lg-4 col-xs-4">
		  							<label class="form-lbl">Shutter Speed</label>
		  						</div>
		  						<div class="col-lg-4 col-xs-4">
		  							<label class="form-lbl">ISO</label>
		  						</div>
			  				</div>
		  					<div class="row">
		  						<div class="col-lg-4 col-xs-4">
		  							<div class="form-group">
			  							<select class="form-inp form-inp-txt" name="aperture" data-required-error="Select Aperture" required>
			  								<option selected hidden disabled></option>
			  								<option value="ƒ/1.2">ƒ/1.2</option>
			  								<option value="ƒ/1.4">ƒ/1.4</option>
			  								<option value="ƒ/1.8">ƒ/1.8</option>
			  								<option value="ƒ/2.8">ƒ/2.8</option>
			  								<option value="ƒ/3.2">ƒ/3.2</option>
			  								<option value="ƒ/3.5">ƒ/3.5</option>
			  								<option value="ƒ/4">ƒ/4</option>
			  								<option value="ƒ/4.5">ƒ/4.5</option>
			  								<option value="ƒ/5">ƒ/5</option>
			  								<option value="ƒ/5.6">ƒ/5.6</option>
			  								<option value="ƒ/6.3">ƒ/6.3</option>
			  								<option value="ƒ/7.1">ƒ/7.1</option>
			  								<option value="ƒ/8">ƒ/8</option>
			  								<option value="ƒ/9">ƒ/9</option>
			  								<option value="ƒ/10">ƒ/10</option>
			  								<option value="ƒ/11">ƒ/11</option>
			  								<option value="ƒ/13">ƒ/13</option>
			  								<option value="ƒ/14">ƒ/14</option>
			  								<option value="ƒ/16">ƒ/16</option>
			  								<option value="ƒ/18">ƒ/18</option>
			  								<option value="ƒ/20">ƒ/20</option>
			  								<option value="ƒ/22">ƒ/22</option>
			  							</select>
			  							<div class="help-block with-errors"></div>
		  							</div>
		  						</div>
		  						<div class="col-lg-4 col-xs-4">
		  							<div class="form-group">
			  							<input class="form-inp form-inp-txt" type="text" name="shutter-speed" placeholder="1/200s" maxLength="7" required/>
			  							<div class="help-block with-errors"></div>
		  							</div>
		  						</div>
		  						<div class="col-lg-4 col-xs-4">
		  							<div class="form-group">
			  							<select class="form-inp form-inp-txt" name="iso" data-required-error="Select ISO" required>
			  								<option selected hidden disabled></option>
			  								<option value="50">50</option>
			  								<option value="100">100</option>
			  								<option value="125">125</option>
			  								<option value="160">160</option>
			  								<option value="200">200</option>
			  								<option value="250">250</option>
			  								<option value="320">320</option>
			  								<option value="400">400</option>
			  								<option value="500">500</option>
			  								<option value="640">640</option>
			  								<option value="800">800</option>
			  								<option value="1000">1000</option>
			  								<option value="1250">1250</option>
			  								<option value="1600">1600</option>
			  								<option value="2000">2000</option>
			  								<option value="2500">2500</option>
			  								<option value="3200">3200</option>
			  								<option value="4000">4000</option>
			  								<option value="5000">5000</option>
			  								<option value="6400">6400</option>
			  							</select>
			  							<div class="help-block with-errors"></div>
		  							</div>
		  						</div>
			  				</div>
			  				<hr>
			  				<div class="form-group row">
			  					<div class="col-md-12">
			  						<input class="form-inp form-inp-btn form-inp-btn-blue" type="submit" value="Publish photo"/>
			  					</div>
			  				</div>
    					</div>
    				</div>
  				</form>
    		</div>
    	</div>
    </div>