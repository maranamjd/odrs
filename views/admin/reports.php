<div class="container-fluid mt-3 mb-2">
  <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
    <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Reports</h5>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="container-fluid my-3 col-md-6">
      <div class="p-2 bg-white border rounded">
        <h4 class="text-info">Document Request</h4>
        <form class="report_form">
          <div class="row container">
            <div class="col-md-6 my-1">
              <h5 class="text-secondary">Type</h5>
              <select class="selectpicker" title="Type" id="report_type" required>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
              </select>
            </div>
            <div class="col-md-6 my-1" id="date_div">
            </div>
            <div class="col-md-6 my-1">
              <h5 class="text-secondary">Category</h5>
              <select class="selectpicker" title="Category" id="category" required>
                <option value="All">All</option>
                <option value="Document">Document</option>
                <option value="Course">Course</option>
                <option value="College">College</option>
                <option value="Branch">Branch</option>

              </select>
            </div>
            <div class="col-md-6 my-1" id="category_div">

            </div>
            <div class="col-md-6 my-1">
              <h5 class="text-secondary">Request Type</h5>
              <select class="selectpicker" title="Category" id="request_type" required>
                <option value="All">All</option>
                <option value="Graduate">Graduate</option>
                <option value="Undergraduate">Undergraduate</option>
              </select>
            </div>
            <div class="col-md-4 my-1 offset-md-2">
              <button type="submit" class="btn btn-md btn-danger mt-4">Generate Report</button>
            </div>
          </div>
        </form>
      </div>
    </div> <!-- cards -->

    <div class="container-fluid my-3 col-md-6">
      <div class="p-2 bg-white border rounded">
        <h4 class="text-info">Graduate Verification</h4>
        <form class="ver_report_form">
          <div class="row container">
            <div class="col-md-6 my-1">
              <h5 class="text-secondary">Type</h5>
              <select class="selectpicker" title="Type" id="ver_report_type" required>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
              </select>
            </div>
            <div class="col-md-6 my-1" id="ver_date_div">
            </div>
            <div class="col-md-4 my-1 offset-md-8">
              <button type="submit" class="btn btn-md btn-danger mt-4">Generate Report</button>
            </div>
          </div>
        </form>
      </div>
    </div> <!-- cards -->
  </div>

</div>
