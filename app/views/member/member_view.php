    <?php if($member['is_published'] === '0'): ?>
      <?php redirect('settings/profile/'.$member['id_member']); ?>
    <?php else: ?>
    <div class="container-fluid" style="padding: 0; margin-top: 20px;">
    <div class="member-view">
      <div class="jumbotron member-cover" style="background-image: url('<?php echo base_url(); ?>assets/images/uploads/users/covers/<?php echo $member['cover_file_name'] ?>');">
        <?php if($this->session->userdata('memberId') === $member['id_member']): ?>
        <div class="row">
          <div class="col-md-12">
            <?php echo form_open_multipart('member/u/'.$member['id_member'], array('id' => 'cover-upload')); ?>
            <?php if(!empty($errorCover)): ?>
            <div class="form-err-msg show">
              <span class="head">Error</span>: <span class="msg">
                <?php
                    echo $errorCover;
                ?>
              </span>
            </div>
            <?php endif; ?>
            <input class="file-cover" style="display: none;" type="file" name="cover" accept="image/jpeg"/>
            <p class="cover-btn-pri"><button type="button" class="btn-change-cover" href="#">Upload cover</button></p>
            <p class="cover-btn-sec"><button type="button" id="cancel-cover" class="btn-cancel-cover" href="#">Cancel</button><input type="submit" id="save-cover" class="btn-save-cover green" name="cover" value="Save"/></p>
            <?php form_close(); ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <div class="container user-info">
        <div class="row basic-info">
          <div class="col-md-8 col-md-offset-2">
            <div class="user-page-avatar"
            style="background-image: url('<?php echo base_url(); ?>assets/images/uploads/users/avatars/<?php echo $member['avatar_file_name']; ?>');
            <?php if($this->session->userdata('memberId') === $member['id_member']): ?>
            cursor: pointer;
            <?php else: ?>
            pointer-events: none;
            <?php endif; ?>
            ">
            </div>
            <?php echo form_open_multipart('member/u/'.$member['id_member']); ?>
              <input class="file-avatar" style="display: none;" type="file" name="avatar" accept="image/jpeg"/>
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <?php if(!empty($errorPicture)): ?>
                <div class="form-err-msg show" style="margin-top: 20px;">
                  <span class="head">Error</span>: <span class="msg">
                    <?php
                        echo $errorPicture;
                    ?>
                  </span>
                </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2 col-md-offset-5 update-avatar-btns">
                <div class="update-avatar-btn">
                  <button type="button" class="cancel form-inp form-inp-btn sm outline-gray form-inp-btn-gray">Cancel</button>
                  <input type="submit" class="form-inp form-inp-btn sm outline-green form-inp-btn-green" name="picture" value="Save"/>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?>
            <h1 class="user-name text-center">
              <?php echo $member['first_name']; ?>
              <?php echo $member['last_name']; ?>
            </h1>
            <p class="text-center">
              <?php
                if($member['n_facebook'])
                  echo '<a class="fa fa-facebook fa-lg" href="https://www.facebook.com/'.$member['n_facebook'].'" target="_blank" style="color: #3b5998; margin-right: 10px;"></a>';
                if($member['n_twitter'])
                  echo '<a class="fa fa-twitter fa-lg" href="https://www.twitter.com/'.$member['n_twitter'].'" target="_blank" style="color: #1da1f2; margin-right: 10px;"></a>';
                if($member['n_instagram'])
                  echo '<a class="fa fa-instagram fa-lg" href="https://www.instagram.com/'.$member['n_instagram'].'" target="_blank" style="color: #ce3d5a; margin-right: 10px;"></a>';
              ?>
            </p>
            <p class="user-bio">
              <?php echo $member['short_bio']; ?>
            </p>
          </div>
        </div>
      </div>
      </div>
      <!--user page photo grid-->
      <div class="grid official" style="margin-bottom: -48px;">
        <div class="grid-size"></div>
        <?php if(!empty($posts)): ?>
        <?php foreach($posts as $post): ?>
        <a href="<?php echo base_url(); ?>assets/images/uploads/photos/<?php echo $post['file_name']; ?>">
          <div class="grid-item">
            <div class="grid-item-content">
              <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/photos/thumbnails/thumb_<?php echo $post['file_name']; ?>"
                title="
                  <span class='photo-lightbox-title'><?php echo $post['title']; ?></span><br>
                  <span class='photo-lightbox-desc'><?php echo character_limiter($post['story'], 40); ?></span>
                  <a class='photo-lightbox-see-more' href='<?php echo site_url('/photo/'.$post['id_photo']); ?>'>See more</a>
                "/>
              <div class="overlay">
                <div class="center-hv">
                  <div>
                    <h1 class="grid-title"><?php echo $post['title']; ?></h1>
                  </div>
                  <div>
                    <span class="grid-date">
                      <?php echo date('F d, o', strtotime($post['upload_date_time'])); ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
        <?php else: ?>
          <br><p class="text-center">No post to show.</p>
        <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>