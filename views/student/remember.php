
<section class="bg-light">
  <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
    <h2>Welcome to PUP's Online Document Request System</h2>
    <p class="font-weight-light my-2">
      Please fill out the necessary <span class="font-weight-normal">Information</span> for the system to check your credentials.
    </p>
  </div>
</section>



<div class="container">
  <div class="steps">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="step1 step">
            <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Personal Information</h6>
            <form class="request_form" action="#" method="post">
              <div class="row">
                <div class="col-lg-6">
                  <div class="container py-4 px-2 px-sm-3">
                    <div class="col-12">
                      <label for="address_city">Name</label>
                    </div>
                    <div class="form-group row">
                      <div class="col">
                        <label for="last_name">Last Name:<span class="text-danger">*</span></label>
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col">
                        <label for="first_name">First Name:<span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="container py-4 px-2 px-sm-3">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-12">
                            <label for="address_city">Birth Date</label>
                          </div>
                          <div class="col-md-8">
                            <label for="birth_month">Month:<span class="text-danger">*</span></label>
                            <select name="student_bmonth" class="form-control selectpicker border" id="birth_month" title='Month' required>
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
                          </div>
                          <div class="col-md-6">
                            <label for="birth_month">Day:<span class="text-danger">*</span></label>
                            <select name="student_bday" class="form-control selectpicker border" id="birth_day" title='Day' required>
                              <?php
                              for ($x = 1; $x <= 31; $x++) {
                                echo "<option value='$x'>$x</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label for="birth_month">Year:<span class="text-danger">*</span></label>
                            <select name="student_byear" class="form-control selectpicker border" id="birth_year" title='Year' required>
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
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-2 offset-md-10">
                <input type="submit" name="submit" value="Next" class="btn btn-danger w-100 next_btn">
                <!-- <a href="#" id="next_btn" class="btn btn-danger w-100">Next</a> -->
              </div>
            </form>
          </div>

          <div class="step2 step">
            <div class="col-lg-12 mb-4">
              <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Academic Information</h6>
              <div class="container py-4 px-2 px-sm-3">
                <form class="request_form" action="#" method="post">
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="course">Course:<span class="text-danger">*</span><div class="w-100"></div>
                      </label>
                    </div>
                    <div class="col">
                      <select name="course" class="form-control w-100 selectpicker border" data-live-search='true' data-style='btn' id="course" title='Course' required>
                        <?php if (isset($this->pageData)): ?>
                          <?php foreach ($this->pageData['courses'] as $course): ?>
                            <option value="<?php echo $course['courseID']; ?>"><?php echo $course['description']; ?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="Branch">Branch:<span class="text-danger">*</span></label>
                    </div>
                    <div class="col">
                      <select name="Branch" class="form-control w-100 selectpicker border" data-live-search='true' data-style='btn' id="branch" title='Branch/Campus' required>
                        <?php if (isset($this->pageData)): ?>
                          <?php foreach ($this->pageData['branches'] as $branch): ?>
                            <option value="<?php echo $branch['branchID']; ?>"><?php echo $branch['branchName']; ?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <a href="#" class="btn btn-danger w-100 back_btn">back</a>
                    </div>
                    <div class="col-md-2 offset-md-8">
                      <input type="submit" name="submit" value="Next" class="btn btn-danger w-100" id="submit_btn">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="step3 step">
            <div class="col-12 py-3 container" id="result">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
