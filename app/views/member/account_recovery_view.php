    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <form class="form-sign" method="POST" action="<?php echo base_url(); ?>recover">
            <?php if($this->session->flashdata('idNotFound')): ?>
            <div class="form-group row">
              <div class="col-md-12">
                <p class="form-err-msg show">
                  <span class="head">Error</span>: <span class="msg">
                    <?php
                        echo $this->session->flashdata('idNotFound');
                    ?>
                  </span>
                </p>
              </div>
            </div>
            <?php endif; ?>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="inp-id" class="form-lbl">ID</label>
              </div>
              <div class="col-md-12">
                <?php
                  echo form_error('id');
                ?>
                <input id="inp-id" class="form-inp form-inp-txt" type="text" name="id" placeholder="Please enter your ID"/>
              </div>
            </div>
            <hr>
            <div class="form-group row">
              <div class="col-md-12">
                <input class="form-inp form-inp-btn form-inp-btn-blue" id="btn-login" type="submit" value="Enter"/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
