<div class="container-fluid my-3">
  <div class="p-2 bg-white border rounded">
  <h4 class="text-info">Institution</h4>
    <div class="row">
      <div class="col-md-3 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Employees</h5>
            <div class="d-flex">
              <h1 class="card-text text-secondary mr-3" id="employee_active"><a href="<?php echo URL ?>admin/employee_info" class="pull-right btn text-success">Active</a></h1>
              <h1 class="card-text text-secondary mr-3" id="employee_trash"><a href="<?php echo URL ?>admin/employeeTrash" class="pull-right btn text-danger">Inactive</a></h1>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Branches</h5>
            <div class="d-flex">
              <h1 class="card-text text-secondary mr-3" id="branch_active"><a href="<?php echo URL ?>admin/branch_info" class="pull-right btn text-success">Active</a></h1>
              <h1 class="card-text text-secondary mr-3" id="branch_trash"><a href="<?php echo URL ?>admin/branchTrash" class="pull-right btn text-danger">Trash</a></h1>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Offices/Colleges</h5>
            <div class="d-flex">
              <h1 class="card-text text-secondary mr-3" id="office_active"><a href="<?php echo URL ?>admin/offices" class="pull-right btn text-success">Active</a></h1>
              <h1 class="card-text text-secondary mr-3" id="office_trash"><a href="<?php echo URL ?>admin/officeTrash" class="pull-right btn text-danger">Trash</a></h1>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Courses</h5>
            <div class="d-flex">
              <h1 class="card-text text-secondary mr-3" id="course_active"><a href="<?php echo URL ?>admin/courses" class="pull-right btn text-success">Active</a></h1>
              <h1 class="card-text text-secondary mr-3" id="course_trash"><a href="<?php echo URL ?>admin/courseTrash" class="pull-right btn text-danger">Trash</a></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- cards -->

<div class="container-fluid my-3">
  <div class="p-2 bg-white border rounded">
  <h4 class="text-info">Document Request</h4>
    <div class="row">
      <div class="col-md-3 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Documents</h5>
            <div class="d-flex">
              <h1 class="card-text text-secondary mr-3" id="document_active"><a href="<?php echo URL ?>admin/documents" class="pull-right btn text-success">Active</a></h1>
              <h1 class="card-text text-secondary mr-3" id="document_trash"><a href="<?php echo URL ?>admin/documentTrash" class="pull-right btn text-danger">Trash</a></h1>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Document Types</h5>
            <div class="d-flex">
              <h1 class="card-text text-secondary mr-3" id="doctype_active"><a href="<?php echo URL ?>admin/document_types" class="pull-right btn text-success">Active</a></h1>
              <h1 class="card-text text-secondary mr-3" id="doctype_trash"><a href="<?php echo URL ?>admin/documentTypeTrash" class="pull-right btn text-danger">Trash</a></h1>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Subjects</h5>
            <div class="d-flex">
              <h1 class="card-text text-secondary mr-3" id="subject_active"><a href="<?php echo URL ?>admin/subjects" class="pull-right btn text-success">Active</a></h1>
              <h1 class="card-text text-secondary mr-3" id="subject_trash"><a href="<?php echo URL ?>admin/subjectTrash" class="pull-right btn text-danger">Trash</a></h1>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 my-1">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title text-secondary">Survey Questions</h5>
            <div class="d-flex">
              <h1 class="card-text text-secondary mr-3" id="survey_active"><a href="<?php echo URL ?>admin/survey_questions" class="pull-right btn text-success">Active</a></h1>
              <h1 class="card-text text-secondary mr-3" id="survey_trash"><a href="<?php echo URL ?>admin/surveyTrash" class="pull-right btn text-danger">Trash</a></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- cards -->

<div class="container-fluid mt-3 mb-2">
  <div class="p-2 bg-white border rounded">
    <h4 class="text-info">Today</h4>
    <!-- <h6 class="text-info"><?php echo date('F j, Y - D'); ?></h6> -->
    <div class="container-fluid my-3 mt-3 mb-2">
      <div class="row">
        <div class="col-md-4 offset-md-1 my-1">
          <div class="card shadow rounded">
            <div class="card-body">
              <h3 class="card-title text-secondary">Document Request</h3>
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
            </div>
          </div>
        </div>
        <div class="col-md-4 offset-md-1 my-1">
          <div class="card shadow rounded">
            <div class="card-body">
              <h3 class="card-title text-secondary">Graduate Verification</h3>
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
                <h5 class="text-uppercase text-secondary">Document Requests</h5>
              </div>
              <div class="col-12 mt-4">
                <canvas id="requests_chart" width="auto" height="180"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-12">
                <h5 class="text-uppercase text-secondary">Graduate Verification</h5>
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
