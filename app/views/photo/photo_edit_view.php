    <?php
      if($post['id_member'] != $this->session->userdata('memberId')) {
        redirect('photo/'.$post['id_photo']);
      }
    ?>
    <div class="container photo-view" style="padding: 20px; margin-top: 40px !important;">
      <?php
        $attributes = array(
          'data-toggle' => 'validator',
          'role' => 'form'
        );

        echo form_open('photo/edit/'.$post['id_photo'], $attributes);
      ?>
        <input type="hidden" name="id-photo" value="<?php echo $post['id_photo']; ?>"/>
        <div class="row">
          <div class="col-md-5">
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="form-lbl">Category</label>
                <select class="form-inp form-inp-txt" name="category">
                  <option value="<?php echo $post['category']; ?>" selected hidden><?php echo $post['category']; ?></option>
                  <?php
                    foreach($categories as $category): 
                  ?>
                    <option value="<?php echo $category['name']; ?>"><?php echo $category['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="form-lbl">Title</label>
                <?php
                  echo form_error('title');
                ?>
                <input class="form-inp form-inp-txt" type="text" name="title" maxLength="50" value="<?php echo $post['title']; ?>" required/>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label class="form-lbl">Camera</label>
                  </div>
                  <div class="col-md-12">
                    <input class="form-inp form-inp-txt" type="text" name="camera" value="<?php echo $post['camera']; ?>" required/>
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
                        <option selected><?php echo $post['aperture']; ?></option>
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
                      <input class="form-inp form-inp-txt" type="text" name="shutter-speed" placeholder="1/200s" maxLength="7" value="<?php echo $post['shutter_speed']; ?>" required/>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-xs-4">
                    <div class="form-group">
                      <select class="form-inp form-inp-txt" name="iso" data-required-error="Select ISO" required>
                        <option selected><?php echo $post['iso']; ?></option>
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
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="form-lbl">Description</label>
                <?php
                  echo form_error('story');
                ?>
                <textarea class="form-inp form-inp-txt" name="story" placeholder="Tell us more about your beautiful photo" rows="10" data-minlength="50" maxlength="1000" data-error="Use 50 characters or more." data-required-error="Please fill out this field." required><?php echo $post['story']; ?></textarea>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6">
                <a class="form-inp form-inp-btn form-inp-btn-gray" href="<?php echo base_url(); ?>photo/<?php echo $post['id_photo']; ?>">Cancel</a>
              </div>
              <div class="col-sm-6">
                <input class="form-inp form-inp-btn form-inp-btn-green" id="inp-id" type="submit" value="Save"/>
              </div>
            </div>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>