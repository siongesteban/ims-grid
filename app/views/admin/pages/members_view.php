    <?php if(!$this->session->userdata('userLoggedIn')) redirect('admin/login'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>Members</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Members</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="row">
                <div class="col-sm-2 col-xs-6">
                  <button type="button" class="btn btn-block btn-primary btn-flat" data-toggle="modal" data-target="#add-member-modal">Add member</button>
                </div>
              </div>
              <table id="member-table" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Date Created</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($members as $member): ?>
                    <tr data-toggle="modal" data-target="#member-modal"
                      data-id-member="<?php echo $member['id_member']; ?>"
                      data-avatar-file-name="<?php echo base_url().'assets/images/uploads/users/avatars/'.$member['avatar_file_name']; ?>"
                      data-cover-file-name="background-image: url('<?php echo base_url().'assets/images/uploads/users/covers/'.$member['cover_file_name']; ?>'); background-size: cover; background-position: center;"
                      data-name="<?php echo $member['first_name'].' '.$member['last_name']; ?>"
                      data-username="<?php echo $member['username']; ?>"
                      data-email="<?php echo $member['email']; ?>"
                      data-birthdate="<?php echo $member['birthdate']; ?>"
                      data-short-bio="<?php echo $member['short_bio']; ?>"
                      data-intro="<?php echo $member['intro']; ?>"
                      data-date-created="<?php echo date('F N, Y', strtotime($member['created'])); ?>"
                      data-date-updated="<?php echo date('F N, Y - G:i', strtotime($member['updated'])); ?>"
                      data-profile-link="<?php echo base_url().'member/'.$member['id_member']; ?>"
                    >
                      <td><?php echo $member['id_member']; ?></td>
                      <td><?php echo $member['username']; ?></td>
                      <td>
                        <?php echo $member['first_name'].' '.$member['last_name']; ?>
                      </td>
                      <td><?php echo $member['created']; ?></td>
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

      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="modal fade" id="member-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" id="member-cover" style="">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h3 class="widget-user-username" id="name"></h3>
                  <h5 class="widget-user-desc">
                    <a href="" id="profile-link" target="_blank">View Profile</a>
                  </h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" id="member-avatar" src="" width="128px" height="128px">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header" id="date-created"></h5>
                        <span class="description-text">Date Created</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header" id="username"></h5>
                        <span class="description-text">Username</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header" id="last-update"></h5>
                        <span class="description-text">Last Profile Update</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="description-block left">
                        <h5 class="description-header center">Short Bio</h5>
                        <span class="description-text" id="short-bio"></span>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="description-block left">
                        <h5 class="description-header">Email</h5>
                        <span class="description-text center" id="email"></span>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="description-block left">
                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmation-modal">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.widget-user -->
            </div>
          </div>
        </div>
        </div>
      </div>

      <div class="modal fade" id="add-member-modal" tabindex="-1" role="dialog" aria-labelledby="add-member-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Add Member</h4>
            </div>
            <div class="modal-body">
              <?php echo form_open('addmember'); ?>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label for="inp-fname">First Name</label>
                    <input class="form-control" id="inp-fname" type="text" name="fname" required/>
                  </div>
                  <div class="col-sm-6">
                    <label for="inp-lname">Last Name</label>
                    <input class="form-control" id="inp-lname" type="text" name="lname" required/>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <input type="submit" class="btn btn-primary" value="Submit"/>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>

      <!--confirmation modal-->
      <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true" style="font-family: sans-serif !important;">
        <div class="modal-dialog" role="document" style=" width: 300px !important;">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete account</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure to delete this account?
            </div>
            <div class="modal-footer">
              <?php echo form_open('admin/users/members/delete'); ?>
                <input id="id" type="hidden" name="id" value=""/>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <input type="submit" class="btn btn-primary" value="Yes"/>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
    <!-- /.content -->