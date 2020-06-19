
  <div class="container">
    <br>
    <ul class="nav nav-tabs mb-4" id="info_tab">
      <li class="nav-item">
        <a class="nav-link active" href="#company">Company</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#representative">Representative</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#account">Account</a>
      </li>
    </ul>
    <div class="row">
      <div class="col-lg-12 mb-4 tab-content">

        <div id="company" class="tab-pane show active fade">
          <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Information</h6>
          <form id="company_form">
            <div class="row">
              <div class="col-lg-6">
                <div class="container py-4 px-2 px-sm-3">
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="cname">Company Name:<span class="text-danger">*</span></label>
                    </div>
                    <div class="col">
                      <input type="hidden" name="cid" value="<?php echo $this->companyDetails['company']['companyID'] ?>" id="company_id">
                      <input type="text" name="cname" class="form-control" id="company_name" placeholder="Company Name" value="<?php echo $this->companyDetails['company']['companyName'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="address">Business Nature:</label>
                    </div>
                    <div class="col">
                      <input type="text" name="cNature" class="form-control" id="company_nature" placeholder="Enter Business Nature" value="<?php echo $this->companyDetails['company']['businessNature'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="address">Address:</label>
                    </div>
                    <div class="col-md-4">
                      <label for="company_addressNumber">Number:<span class="text-danger">*</span></label>
                      <input type="text" name="cAddressNumber" class="form-control" id="company_addressNumber" placeholder="Enter Number"  value="<?php echo $this->companyDetails['company']['addressNumber'] ?>" required>
                    </div>
                    <div class="col-md-4">
                      <label for="company_addressSt">Street:<span class="text-danger">*</span></label>
                      <input type="text" name="cStreet" class="form-control" id="company_addressSt" placeholder="Enter Street"  value="<?php echo $this->companyDetails['company']['addressSt'] ?>" required>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col">
                      <label for="company_addressBrgy">Brgy.:</label>
                      <input type="text" name="cBrgy" class="form-control" id="company_addressBrgy" placeholder="Enter Brgy"  value="<?php echo $this->companyDetails['company']['addressBrgy'] ?>">
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
                          <label for="address">Country: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" id="select_country" value="<?php echo $this->companyDetails['company']['addressCountry'] ?>" disabled>
                          <select name="doc" class="form-control selectpicker crs-country border gds-cr gds-countryflag" data-live-search="true" data-style="btn" country-data-region-id="gds-cr-one" data-language="en" id="address_country"></select>
                          <!-- <input type="text" id="address_country" class="form-control"> -->
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <div class="col-12">
                          <label for="address">Region: <span class="text-danger">*</span></label>
                        </div>
                        <div class="col">
                          <input type="text" class="form-control" id="select_region" value="<?php echo $this->companyDetails['company']['addressRegion'] ?>" disabled>
                          <select id="gds-cr-one" class="form-control border"></select>
                          <!-- <input type="text" id="address_region" class="form-control"> -->
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group row">
                        <div class="col-12">
                          <label for="address_city">City<span class="text-danger">*</span></label>
                        </div>
                        <div class="col">
                          <input type="text" name="cCity" class="form-control" id="select_city" placeholder="Enter City"  value="<?php echo $this->companyDetails['company']['addressCity'] ?>" disabled>
                          <select name="cCity" class="form-control crs-country border" id="address_city"></select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group row">
                        <div class="col-12">
                          <label for="address_postalOrZipCode">Zip/Postal Code:</label>
                        </div>
                        <div class="col">
                          <input type="text" name="cPostatlZipCode" class="form-control" id="address_postalOrZipCode" placeholder="Enter Zip/Postal Code" value="<?php echo $this->companyDetails['company']['postalOrZipCode'] ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 offset-lg-8 row">
                <div class="col-lg-6">
                  <a href="<?php echo URL; ?>verification/request/<?php echo Session::get('repLogged'); ?>" id="cancel_btn" class="btn btn-danger w-100">Cancel</a>
                </div>
                <div class="col-lg-6">
                  <button type="submit" name="save" class="btn btn-danger w-100">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="representative">
          <form id="representative_form">
            <div class="row">
              <div class="col-lg-12 mb-4">
                <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Information</h6>
                <div class="container py-4 px-2 px-sm-3">
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="representative_lastName">
                        Last Name:<span class="text-danger">*</span>
                        <div class="w-100"></div>
                      </label>
                    </div>
                    <div class="col">
                      <input type="text" name="lname" class="form-control" id="representative_lastName" placeholder="Enter Last Name" value="<?php echo $this->companyDetails['representative']['lastName'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="representative_firstName">First Name:<span class="text-danger">*</span></label>
                    </div>
                    <div class="col">
                      <input type="text" name="fname" class="form-control" id="representative_firstName" placeholder="Enter First Name" value="<?php echo $this->companyDetails['representative']['firstName'] ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="representative_middleName">
                        Middle Name:
                        <div class="w-100"></div>
                      </label>
                    </div>
                    <div class="col">
                      <input type="text" name="middle" class="form-control" id="representative_middleName" placeholder="Enter Middle Name" value="<?php echo $this->companyDetails['representative']['middleName'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="representative_middleName">
                        Suffix:
                        <div class="w-100"></div>
                      </label>
                    </div>
                    <div class="col">
                      <input type="hidden" id="suffix" value="<?php echo $this->companyDetails['representative']['suffix'] ?>">
                      <select name="representative_suffix" class="form-control selectpicker border" id="representative_suffix" title='Select suffix'>
                        <option value=''></option>
                        <option value="Jr">Jr</option>
                        <option value="Sr">Sr</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="representative_email">Email Address:<span class="text-danger">*</span></label>
                    </div>
                    <div class="col">
                      <input type="email" name="email" class="form-control" id="representative_email" placeholder="Enter Email" title="sample@sample.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" value="<?php echo $this->companyDetails['representative']['email'] ?>" required>
                      <!-- <small class="text-muted">The result of verification will be sent here.</small> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 offset-lg-8 row">
                <div class="col-lg-6">
                  <a href="<?php echo URL; ?>verification/request/<?php echo Session::get('repLogged'); ?>" id="cancel_btn" class="btn btn-danger w-100">Cancel</a>
                </div>
                <div class="col-lg-6">
                  <button type="submit" class="btn btn-danger w-100" name="save">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="account">
          <form id="account_form">
            <div class="row">
              <div class="col-lg-12 mb-4">
                <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Information</h6>
                <div class="container py-4 px-2 px-sm-3">
                  <div class="form-group row">
                    <div class="col-md-2 offset-md-2">
                      <label for="account_password">
                        New Password:<span class="text-danger">*</span>
                        <div class="w-100"></div>
                      </label>
                    </div>
                    <div class="col-md-6">
                      <input type="password" name="password" class="form-control password" id="account_password" title="must be aplha-numeric and atleast 8 characters long" pattern="^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d).*$" placeholder="Enter Password" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-2 offset-md-2">
                      <label for="account_verify">Verify password:<span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-6">
                      <input type="password" name="verify" class="form-control password mb-3" id="account_verify" title="must be aplha-numeric and atleast 8 characters long" pattern="^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d).*$" placeholder="Verify Password"  required>
                      <div class="alert alert-warning" role="alert" id="not_match" style="display:none">
                        Passwords do not match!!!!
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="fastlane">
                        <label class="custom-control-label" for="fastlane">Show Passwords</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 offset-lg-8 row">
                <div class="col-lg-6">
                  <a href="<?php echo URL; ?>verification/request/<?php echo Session::get('repLogged'); ?>" id="cancel_btn" class="btn btn-danger w-100">Cancel</a>
                </div>
                <div class="col-lg-6">
                  <button type="submit" class="btn btn-danger w-100" name="save" id="account_save" disabled>Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>

    </div>
  </div>
</div>
