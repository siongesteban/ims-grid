    <div class="container-fluid photo-view photo">
      <div class="row">
        <div class="col-md-12">
          <img class="img-responsive photo center-block" src="<?php echo base_url(); ?>assets/images/uploads/photos/<?php echo $post['file_name']; ?>"/>
        </div>
      </div>
    </div>
    <div class="container photo-view">
      <div class="row">
        <div class="col-md-12">
          <h1 class="photo-view-photo-title"><?php echo $post['title']; ?></h1>
          by
          <h3 class="photo-view-photo-author">
            <a href="<?php echo site_url('/member/'.$post['id_member']); ?>">
              <?php echo $post['member_first_name']; ?> 
              <?php echo $post['member_last_name']; ?>
            </a>
          </h3>
          <a href="<?php echo base_url(); ?>photo/<?php echo $post['id_photo'] ?>" class="photo-view-photo-date"><?php echo date('F d, o - g:ia', strtotime($post['upload_date_time'])); ?></a>
          <div class="addthis_inline_share_toolbox"></div>
          <?php if($this->session->userdata('memberId') === $post['id_member']): ?>
            <?php echo form_open('photo/delete/'.$post['id_photo'].'/'.$post['file_name']); ?>
              <p>
                <a class="form-inp form-inp-btn outline-red form-inp-btn-red sm" data-toggle="modal" data-target="#confirmation-modal">Delete</a>
                <a class="form-inp form-inp-btn outline-blue form-inp-btn-blue sm " href="<?php echo site_url('/photo/edit/'.$post['id_photo']); ?>">Edit</a>
              </p>
            </form>
          <?php endif; ?>
          <p class="photo-view-photo-desc">
            <br>In <a href="<?php echo base_url().'category/'.$post['category_slug']; ?>"><?php echo $post['category']; ?></a><br><br>
            <?php echo $post['story']; ?>
          </p>
          <br>
          <p><?php echo $post['camera']; ?></p>
          <p>
            <?php echo $post['aperture']; ?> / <?php echo $post['shutter_speed']; ?> / ISO <?php echo $post['iso']; ?>
          </p>
        </div>
      </div>
    </div>
    <div class="container photo-view">
      <div class="row">
        <div class="col-md-12">
          <div id="disqus_thread"></div>
        </div>
      </div>
    </div>
    <!--confirmation modal-->
      <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true" style="font-family: sans-serif !important;">
        <div class="modal-dialog" role="document" style=" width: 300px !important;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure to delete this post?
            </div>
            <div class="modal-footer">
              <?php echo form_open('photo/delete/'.$post['id_photo'].'/'.$post['file_name']); ?>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <input type="submit" class="btn btn-primary" value="Yes"/>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if(sizeof($memberPosts) > 1): ?>
    <div class="grid container" style="padding: 0; border-top: 3px solid #d2d6de; box-shadow: 0 1px 1px rgba(0,0,0,0.1); background: #fff;">
      <h3 style="padding-left: 10px;">Other posts by <span style="font-family: 'Raleway Bold'; "><?php echo $post['member_first_name']; ?></span></h3>
      <div class="grid-size"></div>
      <?php
        $numOfPost;
        if(sizeof($memberPosts) < 9)
          $numOfPost = sizeof($memberPosts);
        else
          $numOfPost = 9;
      ?>
      <?php for($i = 0; $i < $numOfPost; $i++): ?>
      <?php if($memberPosts[$i]['id_photo'] == $post['id_photo']) continue; ?>
      <a href="<?php echo site_url('/photo/'.$memberPosts[$i]['id_photo']); ?>">
        <div class="grid-item">
          <div class="grid-item-content">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/photos/thumbnails/thumb_<?php echo $memberPosts[$i]['file_name']; ?>"/>
            <div class="overlay">
              <div class="center-hv">
                <div>
                  <h1 class="grid-title"><?php echo $memberPosts[$i]['title']; ?></h1>
                </div>
                <div>
                  <span class="grid-date">
                    <?php echo date('F d, o', strtotime($memberPosts[$i]['upload_date_time'])); ?>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <?php endfor; ?>
      <?php if($memberPosts): ?>
      <a href="<?php echo site_url('/member/'.$post['id_member']); ?>">
        <div class="grid-item">
          <div class="grid-item-content">
            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/uploads/photos/thumbnails/category/thumb_street.jpg"/>
            <div class="overlay visible" style="background: linear-gradient(141deg, #1fc8db 51%, #2cb5e8 75%);">
              <div class="center-hv">
                <div>
                  <h1 class="grid-title"><?php echo $post['member_first_name']; ?>'s profile</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <script>
      /**
      *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
      *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
      /*
      var disqus_config = function () {
      this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
      this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
      };
      */
      (function() { // DON'T EDIT BELOW THIS LINE
      var d = document, s = d.createElement('script');
      s.src = '//imsgrid.disqus.com/embed.js';
      s.setAttribute('data-timestamp', +new Date());
      (d.head || d.body).appendChild(s);
      })();
    </script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58b2dfc6a75a1c03"></script> 