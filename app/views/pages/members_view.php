    <div class="container member-grid">
      <div class="row">
        <?php foreach($members as $member): ?>
          <?php if($member['is_published'] === '0') continue; ?>
          <div class="col-lg-3 col-sm-6">
            <a href="<?php echo site_url('/member/'.$member['id_member']); ?>">
              <div class="member-block">
                <div class="member-avatar">
                <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/users/avatars/<?php echo $member['avatar_file_name']; ?>"/>
                </div>
                <hr>
                <h1 class="member-name">
                  <?php echo character_limiter($member['first_name'], 6); ?>
                </h1>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>