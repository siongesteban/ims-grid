    <div class="container-fluid" style="padding: 0;">
    <div class="grid grid-category" style="margin-bottom: -48px;">
      <?php for($i = 0; $i < sizeof($categories); $i++): ?>
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
    </div>
    </div>