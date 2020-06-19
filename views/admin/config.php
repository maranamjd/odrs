<div class="container-fluid my-3">
  <div class="p-2 bg-white border rounded">
  <h4 class="text-info">Document Request</h4>
    <div class="row">
      <div class="col-md-6 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Account Block Time Span</h5>
            <select class="selectpicker configUpdate" title="Time" id="block_time" rel="RESET_INTERVAL_TYPE">
              <option value="HOUR">Hour</option>
              <option value="HOUR_MINUTE">Minute</option>
              <option value="HOUR_SECOND">Second</option>
              <option value="DAY">Day</option>
              <option value="WEEK">Week</option>
            </select>
            <select class="selectpicker configUpdate" title="Value" id="block_value" rel="RESET_INTERVAL_NUM">
              <?php for ($num = 0; $num <= 60; $num++): ?>
                <option value="<?php echo $num ?>"><?php echo $num ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Account Verification Attemp</h5>
            <select class="selectpicker configUpdate" title="Value" id="attempt" rel="MAX_ATTEMPT">
              <?php for ($num = 0; $num <= 10; $num++): ?>
                <option value="<?php echo $num ?>"><?php echo $num ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Document Claiming Days</h5>
            <select class="selectpicker configUpdate" title="Value" id="claim_days" rel="FORFEITION_NUM">
              <?php for ($num = 0; $num <= 100; $num++): ?>
                <option value="<?php echo $num ?>"><?php echo $num ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Extra Copies</h5>
            <div class="row">
              <div class="col-md-8">
                <input type="number" class="form-control" name="copies" id="copies"min="1" step="1" value="<?php echo $GLOBALS['MAX_COPY'] ?>">
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary saveCopy" rel="MAX_COPY" name="button">Save</button>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-6 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">University President</h5>
            <div class="row">
              <div class="col-md-8">
                <input type="text" class="form-control" name="presName" id="presName" value="<?php echo $GLOBALS['UNIV_PRESIDENT'] ?>">
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary savePres" rel="UNIV_PRESIDENT" name="button">Save</button>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-md-6 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">University Registrar</h5>
            <div class="row">
              <div class="col-md-8">
                <input type="text" class="form-control" name="regiName" id="regiName" value="<?php echo $GLOBALS['UNIV_REGISTRAR'] ?>">
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary saveRegi" rel="UNIV_REGISTRAR" name="button">Save</button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- cards -->
