<div class="container-fluid my-3">
  <div class="row">
    <div class="col-md-3 my-1">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title text-info">Online Document Request</h5>
          <h6 class="card-subtitle mb-2 text-muted font-weight-light">Total Number of requests</h6>
          <h3 class="card-text text-secondary">260</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 my-1">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title text-info">Graduate Verification</h5>
          <h6 class="card-subtitle mb-2 text-muted font-weight-light">Total number of Verifications</h6>
          <h3 class="card-text text-secondary">80</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 my-1">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title text-info">Clearance Monitoring</h5>
          <h6 class="card-subtitle mb-2 text-muted font-weight-light">Total number of Verifications</h6>
          <div class="d-flex">
            <h5 class="card-text text-secondary mr-3">15 <span class="text-success">cleared</span></h6>
            <h5 class="card-text text-secondary mr-3">6 <span class="text-danger">marked</span></h6>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3 my-1">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title text-info">Traffic</h5>
          <h6 class="card-subtitle mb-2 text-muted font-weight-light">Visitors Today</h6>
          <h3 class="card-text text-secondary">150</h3>
        </div>
      </div>
    </div>
  </div>
</div> <!-- cards -->
<div class="container-fluid mb-4">
  <div class="p-4 bg-white border shadow-sm rounded mb-3">
    <h5 class="text-uppercase text-info">Online Document Request
      <span class="font-weight-light h6"><?php echo date('F j, Y - D'); ?></span>
    </h5>
    <div class="row mt-4">
      <div class="col-md-5 mb-4">
        <div class="row">
          <div class="col-12">
            <h6 class="text-uppercase text-secondary">Today</h6>
          </div>
          <div class="col-12 mt-4">
            <canvas id="doc_chart_today" width="auto" height="210"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-7 mb-4">
        <div class="row">
          <div class="col-12">
            <h6 class="text-uppercase text-secondary">This week</h6>
          </div>
          <div class="col-12 mt-4">
            <canvas id="doc_chart_main" width="auto" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- box -->

  <div class="p-4 bg-white border shadow-sm rounded mb-3">
    <h5 class="text-uppercase text-info">Graduate Verification
      <span class="font-weight-light h6"><?php echo date('F j, Y - D'); ?></span>
    </h5>
    <div class="row mt-4">
      <div class="col-md-5 mb-4">
        <div class="row">
          <div class="col-12">
            <h6 class="text-uppercase text-secondary">Today</h6>
          </div>
          <div class="col-12 mt-4">
            <canvas id="graduate_chart_today" width="auto" height="210"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-7 mb-4">
        <div class="row">
          <div class="col-12">
            <h6 class="text-uppercase text-secondary">This week</h6>
          </div>
          <div class="col-12 mt-4">
            <canvas id="graduate_chart_main" width="auto" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- box -->
  <div class="p-4 bg-white border shadow-sm rounded mb-3">
    <h5 class="text-uppercase text-info">
      Clearance Monitoring
      <span class="font-weight-light h6"><?php echo date('F j, Y - D'); ?></span>
    </h5>
    <div class="row mt-4">
      <div class="col-md-5 mb-4">
        <div class="row">
          <div class="col-12">
            <h6 class="text-uppercase text-secondary">Today</h6>
          </div>
          <div class="col-12 mt-4">
            <canvas id="clearance_chart_today" width="auto" height="210"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-7 mb-4">
        <div class="row">
          <div class="col-12">
            <h6 class="text-uppercase text-secondary">This week</h6>
          </div>
          <div class="col-12 mt-4">
            <canvas id="clearance_chart_main" width="auto" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- box -->
  <div class="p-4 bg-white border shadow-sm rounded mb-3">
    <h5 class="text-uppercase text-info">
      Traffic
      <span class="font-weight-light h6"><?php echo date('F j, Y - D'); ?></span>
    </h5>
    <div class="row mt-4">
      <div class="col-md-5 mb-4">
        <div class="row">
          <div class="col-12">
            <h6 class="text-uppercase text-secondary">Today</h6>
          </div>
          <div class="col-12 mt-4">
            <canvas id="traffic_chart_today" width="auto" height="210"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-7 mb-4">
        <div class="row">
          <div class="col-12">
            <h6 class="text-uppercase text-secondary">This week</h6>
          </div>
          <div class="col-12 mt-4">
            <canvas id="traffic_chart_main" width="auto" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- box -->
</div> <!-- container -->
