<?php if(!$this->session->userdata('userLoggedIn')) redirect('admin/login'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Posts
        <small>Published</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Posts</a></li>
        <li class="active">Published</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <table id="post-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Date Added</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($posts as $post): ?>
                    <tr>
                      <td><?php echo $post['id_photo']; ?></td>
                      <td><a class="item" href="<?php echo base_url(); ?>assets/images/uploads/photos/<?php echo $post['file_name']; ?>"
                        data-slide="
                          <span class='photo-lightbox-title'><?php echo $post['title']; ?></span><br>by <span class='photo-lightbox-author'><a href='<?php echo site_url('/member/'.$post['id_member']); ?>' target='_blank'><?php echo $post['member_first_name'].' '.$post['member_last_name']; ?></a></span><br>
                          <span class='photo-lightbox-desc'><?php echo character_limiter($post['story'], 40); ?></span>
                          <a class='photo-lightbox-see-more' href='<?php echo site_url('/photo/'.$post['id_photo']); ?>' target='_blank'>See more</a>
                        "
                        ><?php echo character_limiter($post['title'], 20); ?></a>

                        <a class="label label-danger pull-right" data-toggle="modal" data-target="#confirmation-modal">Delete</a>
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
                                <?php echo form_open('photo/delete/'.$post['id_photo'].'/'.$post['file_name'].'/adminn'); ?>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                  <input type="submit" class="btn btn-primary" value="Yes"/>
                                <?php echo form_close(); ?>
                              </div>
                            </div>
                          </div>
                        </div>

                        </td>
                      <td><?php echo $post['category']; ?></td>
                      <td>
                        <?php echo character_limiter($post['member_first_name'].' '.$post['member_last_name'], 12); ?>
                      </td>
                      <td><?php echo $post['upload_date_time']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>