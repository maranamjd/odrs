<section class="bg-light">
  <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
    <div class="row justify-content-center align-items-center my-lg-4">
      <div class="col-lg-6 px-4 py-2">
        <h2>Request for your TOR, Certificate and more!</h2>
        <details>
          <summary class="text-primary">How to request</summary>
          <p class="my-1">Enter your Student Number and Birth Date</p>
          <p class="my-1">Select the document you want to request</p>
          <p class="my-1">Print your voucher and look for Payment Instructions</p>
          <p class="my-1">Accomplish your Clearance</p>
          <p class="my-1">Check your Email to monitor updates pertaining to your request</p>
          <p class="my-1">or Check your ODRS account</p>
        </details>
      </div>
      <div class="col-lg-5 my-3 my-lg-4">
        <div class="bg-white p-4 shadow-sm rounded-lg">
          <form id="login">
            <fieldset>
              <legend>
                <h5 class="my-2" style="color: maroon;">Student Login</h5>
              </legend>
              <div class="form-row">
                <div class="form-group col-12 my-1">
                  <label for="stNo" class="mb-1"><small>Student Number</small></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="stNo">
                        N
                      </span>
                    </div>
                    <input class="form-control" id="student_number" type="text" placeholder="Enter Student Number" title="2018-15762-MN-1" pattern="[0-9]{4}-[0-9]{5}-[A-Z]{2}-[0-9]{1}$" required>
                  </div>
                </div>
                <div class="form-group col-12 my-1">
                  <label for="bdate" class="mb-1"><small>Birth Date</small></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">D</span>
                    </div>
                    <select name="student_bmonth" class="form-control w-25 selectpicker border" id="student_bmonth" title='Month' required>
                      <option value="1">January</option>
                      <option value="2">February</option>
                      <option value="3">March</option>
                      <option value="4">April</option>
                      <option value="5">May</option>
                      <option value="6">June</option>
                      <option value="7">July</option>
                      <option value="8">August</option>
                      <option value="9">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select>
                    <select name="student_bday" class="form-control selectpicker border" id="student_bday" title='Day' required>
                      <?php
                        for ($x = 1; $x <= 31; $x++) {
                          echo "<option value='$x'>$x</option>";
                        }
                      ?>
                    </select>
                    <select name="student_byear" class="form-control selectpicker border" id="student_byear" title='Year' required>
                      <?php
                        $yearNow = date('Y');
                        for ($x = 0; $x <= 60; $x++) {
                          $year = $yearNow - $x;
                          echo "<option value='$year'>$year</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group col-12 col-lg-4 my-1">
                  <button type="submit" class="btn btn-danger mt-3 w-100">Login</button>
                </div>
              </div>
              <p class="font-weight-light my-1">
                 Forgot your Student Number? <a href="student/remember">click here</a>.<br>
              </p>
              <p class="font-weight-light my-1">
                 Check Request Status. <a href="#" data-toggle='modal' data-target='#statusModal'>click here</a>.<br>
              </p>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container my-4 px-sm-4 my-md-5 my-lg-4 px-lg-3 py-lg-4">
  <div class="row py-lg-3">
    <div class="col-lg-4 mb-5 mb-lg-auto">
      <h5>Document Requesting</h5>
      <p>Requesting of documents is now available online. Create an account and upload your valid ID for verification to get an access to the Online Document Request Page</p>
      <details>
        <summary class="text-primary">See Document Request Flow</summary>
        <p class="my-1">1. Submission of Request</p>
        <p class="my-1">2. Payment of Request</p>
        <p class="my-1">3. Submission of Requirement/s (if applicable)</p>
        <p class="my-1">4. Automated General Clearance</p>
        <p class="my-1">5. Student Records Processing</p>
        <p class="my-1">6. Releasing</p>
      </details>
    </div>

    <div class="col-lg-4 mb-5 mb-lg-auto">
      <h5>Easy Payment</h5>
      <p>Payment of Document Request is easy. Either through any LandBank Branch or through PUP Cashier's Office</p>
      <details>
        <summary class="text-primary">See payment instructions</summary>
        <p class="my-1">Text</p>
        <p class="my-1">Text</p>
        <p class="my-1">Text</p>
        <p class="my-1">Text</p>
      </details>
    </div>

    <div class="col-lg-4 mb-5 mb-lg-auto">
      <h5>Clearance Monitoring</h5>
      <p>Before, Document Requests should be submitted together with the Clearance Form, signed by all required signatories. But now, you’ll just have to wait (and do some actions if necessary) for the system to accomplish your clearance automatically.</p>
      <details>
      <summary class="text-primary">See status flow</summary>
        <p class="my-1">Text</p>
        <p class="my-1">Text</p>
        <p class="my-1">Text</p>
        <p class="my-1">Text</p>
      </details>
    </div>
  </div>
</div>


<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: maroon;" id="">Request Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="statusForm">
              <div class="modal-body">
                <div class="col mb-4">
                  <label for="proceed_code">Control Number:<span class="text-danger">*</span></label>
                  <input type="text" name="control_number" class="form-control" id="control_number" placeholder="e.g. 201908240001" title="e.g. 201908240001" pattern="[0-9]{12}" required autofocus>
                </div>
                <div class="col" id="status">

                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
        </div>
    </div>
</div> <!-- disable -->
