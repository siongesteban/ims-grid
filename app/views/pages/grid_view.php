		<div class="grid official" style="margin-bottom: -48px;">
			<div class="grid-size"></div>
      <?php if(!empty($posts)): ?>
			<?php foreach($posts as $post): ?>
      <a href="<?php echo base_url(); ?>assets/images/uploads/photos/<?php echo $post['file_name']; ?>">
        <div class="grid-item">
          <div class="grid-item-content">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/photos/thumbnails/thumb_<?php echo $post['file_name']; ?>"
            title="
              <span class='photo-lightbox-title'><?php echo $post['title']; ?></span><br>by <span class='photo-lightbox-author'><a href='<?php echo site_url('/member/'.$post['id_member']); ?>'><?php echo $post['member_first_name'].' '.$post['member_last_name']; ?></a></span><br>
              <span class='photo-lightbox-desc'><?php echo character_limiter($post['story'], 40); ?></span>
              <a class='photo-lightbox-see-more' href='<?php echo site_url('/photo/'.$post['id_photo']); ?>'>See more</a>
            "
            />
            <div class="overlay">
              <div class="center-hv">
                <div>
                  <h1 class="grid-title"><?php echo $post['title']; ?></h1>
                </div>
                <div>
                  <span class="grid-author"><small>by</small> </span>
                  <span class="grid-author">
                    <?php echo $post['member_first_name']; ?> 
                    <?php echo $post['member_last_name']; ?>
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