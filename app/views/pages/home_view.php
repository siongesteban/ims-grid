    <!--jumbotron-->
    <div class="jumbotron home" style="background-image: url('<?php echo base_url(); ?>assets/images/uploads/photos/<?php echo $posts[rand(0, sizeof($posts) - 1)]['file_name']; ?>');">
      <div class="jumbotron-overlay">
        <div class="container">
          <div class="jumbotron-title"><h1>Interactive<br>Media<br>Society</h1></div>
          <h4>AMA Computer College - Tarlac Campus</h4>
        </div>
      </div>
    </div>
    <div class="home-header-block">
      <h1 class="home-header">Photos</h1><br><span class="home-header-sub">Great photos taken by the photographers of Interactive Media Society.</span>
    </div>
    <!--photo grid-->
    <div class="grid grid-photo">
      <div class="grid-size"></div>
      <?php
        $numOfPost;
        if(sizeof($posts) < 9)
          $numOfPost = sizeof($posts);
        else
          $numOfPost = 9;
      ?>
      <?php for($i = 0; $i < $numOfPost; $i++): ?>
      <a href="<?php echo site_url('/photo/'.$posts[$i]['id_photo']); ?>">
        <div class="grid-item">
          <div class="grid-item-content">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/photos/thumbnails/thumb_<?php echo $posts[$i]['file_name']; ?>"/>
            <div class="overlay">
              <div class="center-hv">
                <div>
                  <h1 class="grid-title"><?php echo $posts[$i]['title']; ?></h1>
                </div>
                <div>
                  <span class="grid-author"><small>by</small><br></span>
                  <span class="grid-author">
                    <?php echo $posts[$i]['member_first_name']; ?> 
                    <?php echo $posts[$i]['member_last_name']; ?>
                  </span>
                </div>
                <div>
                  <span class="grid-date">
                    <?php echo date('F d, o', strtotime($posts[$i]['upload_date_time'])); ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <?php endfor; ?>
      <?php if(sizeof($posts) > 9): ?>
      <a href="<?php echo base_url(); ?>grid">
        <div class="grid-item">
          <div class="grid-item-content">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/photos/thumbnails/etc/etc1.jpg"/>
            <div class="overlay visible">
              <div class="center-hv">
                <div>
                  <h1 class="grid-title">See more</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <?php endif; ?>
    </div>
    <div class="home-header-block">
      <h1 class="home-header">Categories</h1><br><span class="home-header-sub">24 different categories</span>
    </div>
    <div class="grid grid-category" style="margin-bottom: 0 !important;">
      <div class="grid-size"></div>
      <?php for($i = 0; $i < 9; $i++): ?>
      <a href="<?php echo base_url(); ?>category/<?php echo $categories[$i]['slug']; ?>">
        <div class="grid-item">
          <div class="grid-item-content">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/photos/thumbnails/category/<?php echo $categories[$i]['thumbnail_file_name']; ?>"/>
            <div class="overlay">
              <div class="center-hv">
                <div>
                  <h1 class="grid-title"><?php echo $categories[$i]['name']; ?></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <?php endfor; ?>
      <a href="<?php echo base_url(); ?>categories">
        <div class="grid-item">
          <div class="grid-item-content">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/photos/thumbnails/etc/etc2.jpg"/>
            <div class="overlay visible">
              <div class="center-hv">
                <div>
                  <h1 class="grid-title">See all</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="home-header-block">
      <h1 class="home-header">Members</h1><br><span class="home-header-sub">Interactive Media Society is composed of excellent photographers and filmmakers.</span>
    </div>
    <!--photo grid-->
    <div class="grid grid-photo" style="margin-bottom: -48px;">
      <div class="grid-size"></div>
      <?php 
        $numOfMember;
        if(sizeof($members) < 9)
          $numOfMember = sizeof($members);
        else
          $numOfMember = 9;
      ?>
      <?php for($i = 0; $i < $numOfMember; $i++): ?>
      <?php if($members[$i]['is_published'] === '0') continue; ?>
      <a href="<?php echo site_url('/member/'.$members[$i]['id_member']); ?>">
        <div class="grid-item">
          <div class="grid-item-content">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/users/avatars/<?php echo $members[$i]['avatar_file_name']; ?>"/>
            <div class="overlay">
              <div class="center-hv">
                <div>
                  <h1 class="grid-title">
                    <?php echo $members[$i]['first_name']; ?> 
                    <?php echo $members[$i]['last_name']; ?>
                  </h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <?php endfor; ?>
      <?php if(sizeof($members) > 9): ?>
      <a href="<?php echo base_url(); ?>members">
        <div class="grid-item">
          <div class="grid-item-content">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/photos/thumbnails/etc/etc3.jpg"/>
            <div class="overlay visible">
              <div class="center-hv">
                <div>
                  <h1 class="grid-title">See all</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <?php endif; ?>
    </div>
    </div>