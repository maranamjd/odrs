<div class="container-fluid mt-3 mb-2">
  <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
    <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Data Backup and Restore</h5>
  </div>
</div>
<div class="container-fluid mb-4">
  <div class="p-4 bg-white border rounded">
    <ul class="nav nav-tabs mb-4" id="backup_tab">
      <li class="nav-item">
        <a class="nav-link active" href="#backup">Backup</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#restore">Restore</a>
      </li>
    </ul>
    <div class="col-lg-12 mb-4 tab-content">

      <div id="backup" class="tab-pane show active fade">
        <div class="row">
          <div class="col">
            <h4>Backing up files can protect against accidental loss of user data, database corruption, hardware failures, and even natural disasters. It's your job as an administrator to make sure that backups are performed.</h4>
            <button type="submit" name="backup" class="btn btn-danger pull-right" id="backup_data">Backup Data Now</button>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="restore">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <form id="restore_form">
              <div class="form-group">
                <select name="restore" class="form-control selectpicker border" id="restore_point" title='Available Restore Point' required>
                </select>
              </div>
              <h5>OR</h5>
              <div class="form-group">
                <div class="col-md-8">
                  <div class="">
                    <input type="file" class="" id="restore_file" required>
                  </div>
                  <small class="text-muted">Backup SQL File</small>
                </div>
              </div>
              <button type="submit" name="restore" class="btn btn-danger pull-right">Restore</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="loadModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" style="background: rgba(0,0,0,0); text-align: center; border: none; color: #ccc">
            <img src="<?php echo URL ?>public/img/loading.gif" alt="load">
            <h5>Please wait..</h5>
        </div>
    </div>
</div>
