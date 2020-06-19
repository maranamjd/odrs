<div class="container-fluid mt-3 mb-2">
  <div class="p-2 bg-white border rounded">
    <h4 class="text-info">Today</h4>
    <!-- <h6 class="text-info"><?php echo date('F j, Y - D'); ?></h6> -->
    <div class="container-fluid my-3 mt-3 mb-2">
      <div class="row">
        <div class="col-md-4 offset-md-1 my-1">
          <div class="card shadow rounded">
            <div class="card-body">
              <h3 class="card-title text-info">Document Request</h3>
              <div class="d-flex mb-2">
                <div class="row">
                  <div class="col-md-4 mb-2">
                    <span class="btn btn-outline-success btn-sm w-100">Claimed<h4 class="card-text text-secondary mr-3" id="req_claimed"></h4></span>
                  </div>
                  <div class="col-md-4 mb-2">
                    <span class="btn btn-outline-warning btn-sm w-100">Processing<h4 class="card-text text-secondary mr-3" id="req_processing"></h4></span>
                  </div>
                  <div class="col-md-4 mb-2">
                    <span class="btn btn-outline-secondary btn-sm w-100">Cancelled<h4 class="card-text text-secondary mr-3" id="req_cancelled"></h4></span>
                  </div>
                  <div class="col-md-6 mb-2">
                    <span class="btn btn-outline-primary btn-sm w-100">For Realeasing<h4 class="card-text text-secondary mr-3" id="req_releasing"></h4></span>
                  </div>
                  <div class="col-md-6 mb-2">
                    <span class="btn btn-outline-danger btn-sm w-100">Waiting For Payment<h4 class="card-text text-secondary mr-3" id="req_unpaid"></h4></span>
                  </div>
                </div>
              </div>
              <a href="<?php echo URL ?>registrar/requests" class="pull-right btn text-info">View Details <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 offset-md-1 my-1">
          <div class="card shadow rounded">
            <div class="card-body">
              <h3 class="card-title text-info">Graduate Verification</h3>
              <div class="d-flex mb-2">
                <div class="row">
                  <div class="col-md-6 mb-2">
                    <span class="btn btn-outline-success btn-sm w-100">Verified<h4 class="card-text text-secondary mr-3" id="ver_verified"></h4></span>
                  </div>
                  <div class="col-md-6 mb-2">
                    <span class="btn btn-outline-warning btn-sm w-100">Payment Approval<h4 class="card-text text-secondary mr-3" id="ver_approval"></h4></span>
                  </div>
                  <div class="col-md-6 mb-2">
                    <span class="btn btn-outline-primary btn-sm w-100">For Verification<h4 class="card-text text-secondary mr-3" id="ver_verification"></h4></span>
                  </div>
                  <div class="col-md-6 mb-2">
                    <span class="btn btn-outline-danger btn-sm w-100">Waiting For Payment<h4 class="card-text text-secondary mr-3" id="ver_unpaid"></h4></span>
                  </div>
                </div>
              </div>
              <a href="<?php echo URL ?>registrar/verification" class="pull-right btn text-info">View Details <i class="fa fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- cards -->
  </div>
</div>

<div class="container-fluid mt-3 mb-2">
  <div class="p-2 bg-white border rounded">
    <h4 class="text-info">This Week</h4>
    <!-- <h6 class="text-info"><?php echo date('F j, Y - D'); ?></h6> -->
    <div class="container-fluid my-4">
      <div class="p-4 bg-white border shadow rounded">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-12">
                <h5 class="text-uppercase text-info">Document Requests</h5>
              </div>
              <div class="col-12 mt-4">
                <canvas id="requests_chart" width="auto" height="180"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-12">
                <h5 class="text-uppercase text-info">Graduate Verification</h5>
              </div>
              <div class="col-12 mt-4">
                <canvas id="verifications_chart" width="auto" height="180"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- box -->
    </div> <!-- container -->
  </div>
</div>
