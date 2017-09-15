<?php if(!$this->session->userdata('userLoggedIn')) redirect('admin/login'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Posts
        <small>Approvals</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="#">Posts</a></li>
        <li class="active">Approvals</li>
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
                    <span><?php echo $post['story']; ?></span><br><hr>
                    <span><strong>Camera:</strong> <?php echo $post['camera']; ?></span><br>
                    <span><strong>Aperture:</strong> <?php echo $post['aperture']; ?></span><br>
                    <span><strong>Shutter Speed:</strong> <?php echo $post['shutter_speed']; ?></span><br>
                    <span><strong>ISO:</strong> <?php echo $post['iso']; ?></span>
                        "
                        ><?php echo character_limiter($post['title'], 20); ?></a>
                        <span class="pull-right-container">
                          <a class="label pull-right bg-red" data-toggle="modal" data-target="#confirmation-modal">Delete</a>
                          <?php echo form_open('admin/posts/approvepost/'.$post['id_photo'], array('style' => 'display: inline; float: right; margin-right: 2px; margin-top: -4px;')); ?>
                            <input type="submit" class="btn btn-success" value="Approve" style="padding: 0; font-weight: bold; font-size: 10px;"/>
                          <?php echo form_close(); ?>
                        </span>
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