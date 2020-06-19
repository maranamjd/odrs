
<!-- <section class="bg-light">
  <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
    <h2>Welcome to Graduate Verification System</h2>
    <details>
      <summary class="text-primary">How to verify a graduate?</summary>
      <h6></h6>
      <p class="my-1">1. Fill-up the form below and click the <span class="badge badge-danger">Submit</span> button.</p>
      <p class="my-1">
        2. After you submit. You will be redirected to next page to receive your Verification ID and notify you via email for the lists of graduates you want to verify and the payment voucher.
        Click here for the available <a href="#">options for payment</a>.
      </p>
      <p class="my-1">
        3. When the payment is finished. Scan your copy of receipt and go to <a href="proceed.php">verification page</a> in order to complete your transaction.
      </p>
      <p class="font-weight-light m-0 mt-3">The cost of verification per graduate is 200 pesos for Local, 20 dollars for International.</p>
      <p class="font-weight-light my-1 mb-4">You will receive an email notification on the result after 1-3 weeks of processing.</p>
    </details>

    <p class="font-weight-light my-2">
      If you have the <span class="font-weight-normal">Verification ID and proof of payment</span>. Please <a href="company/transaction">click here</a>.
    </p>
  </div>
</section> -->



<div class="container my-4 px-sm-4 my-md-5 my-lg-4 px-lg-3 py-lg-4">
  <div class="progressbar">
    <ul>
      <li id="step1" class="active">
        Company info.
      </li>
      <li id="step2" class="">
        Representative info.
      </li>
      <li id="step3" class="">
        Applicant's info.
      </li>
      <li id="step4" class="">
        Submit Request
      </li>
      <li id="step5" class="">
        Voucher and Payment
      </li>
    </ul>
  </div>
  <br>
  <?php if (isset($this->companyDetails)): ?>
    <div class="steps">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-4">
            <div class="step1 step">
              <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Company Information</h6>
              <form class="request_form" action="#" method="post">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="container py-4 px-2 px-sm-3">
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label for="cname">Company Name:<span class="text-danger">*</span></label>
                        </div>
                        <div class="col">
                          <input type="text" name="cname" class="form-control" id="company_name" placeholder="Company Name" value="<?php echo $this->companyDetails['company']['companyName'] ?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label for="address">Business Nature:</label>
                        </div>
                        <div class="col">
                          <input type="text" name="cNature" class="form-control" id="company_nature" placeholder="Enter Business Nature" value="<?php echo $this->companyDetails['company']['businessNature'] ?>" disabled>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label for="address">Address:</label>
                        </div>
                        <div class="col-md-4">
                          <label for="company_addressNumber">Number:<span class="text-danger">*</span></label>
                          <input type="text" name="cAddressNumber" class="form-control" id="company_addressNumber"  value="<?php echo $this->companyDetails['company']['addressNumber'] ?>" disabled>
                        </div>
                        <div class="col-md-4">
                          <label for="company_addressSt">Street:<span class="text-danger">*</span></label>
                          <input type="text" name="cStreet" class="form-control" id="company_addressSt"  value="<?php echo $this->companyDetails['company']['addressSt'] ?>" disabled>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col">
                          <label for="company_addressBrgy">Brgy.:</label>
                          <input type="text" name="cBrgy" class="form-control" id="company_addressBrgy"  value="<?php echo $this->companyDetails['company']['addressBrgy'] ?>" disabled>
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
                              <!-- <input type="hidden" id="select_country" value="<?php echo $this->companyDetails['company']['addressCountry'] ?>"> -->
                              <!-- <select name="doc" class="form-control selectpicker crs-country border gds-cr gds-countryflag" data-live-search="true" data-style="btn" country-data-region-id="gds-cr-one" data-language="en" id="address_country"></select> -->
                              <input type="text" id="address_country" class="form-control" value="<?php echo $this->companyDetails['company']['addressCountry'] ?>" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <div class="col-12">
                              <label for="address">Region: <span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                              <!-- <input type="hidden" id="select_region" value=""> -->
                              <!-- <select id="gds-cr-one" class="form-control border"></select> -->
                              <input type="text" id="address_region" class="form-control" value="<?php echo $this->companyDetails['company']['addressRegion'] ?>" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-7">
                          <div class="form-group row">
                            <div class="col-12">
                              <label for="address_city">City/Municipality:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                              <input type="text" name="cCity" class="form-control" id="address_city"  value="<?php echo $this->companyDetails['company']['addressCity'] ?>" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group row">
                            <div class="col-12">
                              <label for="address_postalOrZipCode">Zip/Postal Code:</label>
                            </div>
                            <div class="col">
                              <input type="text" name="cPostatlZipCode" class="form-control" id="address_postalOrZipCode" placeholder="Enter Zip/Postal Code" value="<?php echo $this->companyDetails['company']['postalOrZipCode'] ?>" disabled>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <p><span class="font-weight-bold">Note:</span> Please check if your information is correct. If not <a href="<?php echo URL ?>company/info/<?php echo Session::get('repLogged'); ?>">click here</a></p>
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
                <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Representative Information</h6>
                <div class="container py-4 px-2 px-sm-3">
                  <form class="request_form" action="#" method="post">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="representative_lastName">
                          Last Name:<span class="text-danger">*</span>
                          <div class="w-100"></div>
                        </label>
                      </div>
                      <div class="col">
                        <input type="text" name="lname" class="form-control" id="representative_lastName" placeholder="Enter Last Name" value="<?php echo $this->companyDetails['representative']['lastName'] ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="representative_firstName">First Name:<span class="text-danger">*</span></label>
                      </div>
                      <div class="col">
                        <input type="text" name="fname" class="form-control" id="representative_firstName" placeholder="Enter First Name" value="<?php echo $this->companyDetails['representative']['firstName'] ?>" disabled>
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
                        <input type="text" name="middle" class="form-control" id="representative_middleName" placeholder="Enter Middle Name" value="<?php echo $this->companyDetails['representative']['middleName'] ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="representative_suffix">
                          Suffix:
                          <div class="w-100"></div>
                        </label>
                      </div>
                      <div class="col">
                        <input type="text" name="suffix" class="form-control" id="representative_suffix"value="<?php echo $this->companyDetails['representative']['suffix'] ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="representative_email">Email Address:<span class="text-danger">*</span></label>
                      </div>
                      <div class="col">
                        <input type="email" name="email" class="form-control" id="representative_email" placeholder="Enter Email" value="<?php echo $this->companyDetails['representative']['email'] ?>" disabled>
                        <small class="text-muted">The result of verification will be sent here.</small>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <p><span class="font-weight-bold">Note:</span> Please check if your information is correct. If not <a href="<?php echo URL ?>company/info/<?php echo Session::get('repLogged'); ?>">click here</a></p>
                    </div>
                    <div class="row">
                      <div class="col-md-2 mb-2">
                        <a href="#" class="btn btn-danger w-100 back_btn">back</a>
                      </div>
                      <div class="col-md-2 offset-md-8">
                        <input type="submit" name="submit" value="Next" class="btn btn-danger w-100 next_btn">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="step3 step">
              <div class="col-12 py-3">
                <div class="col-12 my-2 my-lg-4">
                  <div class="row">
                    <div class="col-md-2 offset-md-10">
                      <button class="btn btn-danger w-100" id="addApplicant" style="color: #fff">Add Applicant</button>
                    </div>
                  </div>
                </div>
                <form class="request_form" method="post" action="#" id="applicant_form">
                  <div id="applicant_field" class="row">
                    <div class="col-lg-4 mb-2">
                      <div class="row align-items-center bg-light m-0 p-1 border rounded-sm">
                        <div class="col-9 col-sm-10">
                          <h6 class="m-0">Applicant</h6>
                        </div>
                        <div class="col-3 col-sm-2 py-3">
                          <a id="removeApplicant" class="btn btn-danger btn-sm" style="color: #fff;cursor: pointer">&times;</a>
                        </div>
                      </div>
                      <div class="container py-4 px-2 px-sm-3">
                        <div class="form-group row">
                          <div class="col-md-5">
                            <label for="doctype">Document Type:<span class="text-danger">*</span></label>
                          </div>
                          <div class="col">
                            <select class="form-control border doctype" title="Document Type" data-live-search="true" data-style="btn" required pattern="a-zA-Z0-9{1}">
                              <option selected disabled value="">Document Type</option>
                              <option value="3">Transcript of Records</option>
                              <option value="5">Diploma</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-5">
                            <label for="file">File:<span class="text-danger">*</span></label>
                          </div>
                          <div class="col">
                            <div class="">
                              <input type="file" class="file" required>
                            </div>
                            <small class="text-muted">PDF copy of Transcript of Record/Diploma.</small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2 mb-2">
                      <a href="#" class="btn btn-danger w-100 back_btn">back</a>
                    </div>
                    <div class="col-md-2 offset-md-8">
                      <input type="submit" name="submit" value="Next" class="btn btn-danger w-100 next_btn">
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="step4 step">
              <div class="col-lg-12 mb-4">
                <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Request Summary</h6>
              </div>
              <div class="col-12 my-4" id="request_summary">

              </div>
              <div class="row">
                <div class="col-md-2 mb-2">
                  <a href="#" class="btn btn-danger w-100 back_btn">back</a>
                </div>
                <div class="col-md-2 offset-md-8">
                  <a href="#" id="submit_btn" class="btn btn-danger w-100" data-toggle='modal' data-target='#terms'>Submit</a>
                </div>
              </div>
            </div>
            <div class="step5 step">
              <section class="bg-light">
                <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
                  <h2>Complete your transaction</h2>
                </div>
              </section>
              <div class="container my-4 px-sm-4 my-md-5 my-lg-3 px-lg-3 py-lg-5 mb-lg-5">
                <div class="row mb-3">
                  <div class="col-12">
                    <h4 style="color: maroon;">Your request for verification is completed!</h4>
                    <h5 class="text-secondary">Your verification ID: <span class="font-weight-bold" id="verID"></span></h5>
                    <p class="font-weight-light my-1">
                      You can download your <span class="font-weight-normal">Payment Voucher by </span><a href="#" target="_blank" id="voucher">clicking here</a>.
                    </p>
                  </div>
                  <div class="col-12 my-4">
                    <!-- <p><span class="font-weight-bold">Note:</span> You will also recieve an email with an attached payment voucher file.</p> -->
                    <!-- <p><span class="font-weight-bold">OR</span></p> -->
                  </div>
                  <!-- <div class="col-12">
                  <p class="font-weight-light my-1">
                  You can pay using the following:
                </p>
                <div class="payment">
                <a href="verification/payment/visa" target="_blank"><img src="<?php echo URL ?>public/img/icon-visa.png" alt=""></a>

                <a href="verification/payment/master" target="_blank"><img src="<?php echo URL ?>public/img/icon-master.png" alt=""></a>

                <a href="verification/payment/paypal" target="_blank"><img src="<?php echo URL ?>public/img/icon-paypal.png" alt=""></a>
              </div>
            </div> -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-2 offset-md-10">
            <a href="#" id="finish_btn" class="btn btn-danger w-100">Finish</a>
          </div>
        </div>
      </div>
      <div class="step6 step">
        <section class="bg-light">
          <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
            <h2>Transaction Complete.</h2>
          </div>
          <div class="container">
            <p>Your verification request has been sent!</p>
            <p>Thank you for using PUP's graduate verification system!</p>
            <p>Have a great day!!</p>
          </div>
        </section>
        <div class="col-12 col-md-6 offset-lg-10 col-lg-2">
          <a href="<?php echo URL; ?>verification" class="btn btn-danger w-100">Return Home</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

  <?php else: ?>
    <div class="steps">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-4">
            <div class="step1 step">
              <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Company Information</h6>
              <form class="request_form" action="#" method="post">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="container py-4 px-2 px-sm-3">
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label for="cname">Company Name:<span class="text-danger">*</span></label>
                        </div>
                        <div class="col">
                          <input type="text" name="cname" class="form-control" id="company_name" placeholder="Company Name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label for="address">Business Nature:</label>
                        </div>
                        <div class="col">
                          <input type="text" name="cNature" class="form-control" id="company_nature" placeholder="Enter Business Nature">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label for="address">Address:</label>
                        </div>
                        <div class="col-md-4">
                          <label for="company_addressNumber">Building Number:<span class="text-danger">*</span></label>
                          <input type="text" name="cNumber" class="form-control" id="company_addressNumber" placeholder="e.g. #21 " required>
                        </div>
                        <div class="col-md-4">
                          <label for="company_addressSt">Street:<span class="text-danger">*</span></label>
                          <input type="text" name="cStreet" class="form-control" id="company_addressSt" placeholder="e.g. Bonifacio" required>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col">
                          <label for="company_addressBrgy">Brgy.:</label>
                          <input type="text" name="cBrgy" class="form-control" id="company_addressBrgy" placeholder="e.g. Tibay">
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
                              <select name="doc" class="form-control selectpicker crs-country border gds-cr gds-countryflag" data-live-search="true" data-style="btn" country-data-region-id="gds-cr-one" data-language="en" id="address_country" required></select>
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
                              <input type="hidden" id="select_region" value="">
                              <select id="gds-cr-one" class="form-control border" required></select>
                              <!-- <input type="text" id="address_region" class="form-control"> -->
                            </div>
                          </div>
                        </div>
                        <div class="col-md-7">
                          <div class="form-group row">
                            <div class="col-12">
                              <label for="address_city">City/Municipality:</label>
                            </div>
                            <div class="col">
                              <select name="cCity" class="form-control selectpicker crs-country border" data-live-search="true" data-style="btn" id="address_city"></select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group row">
                            <div class="col-12">
                              <label for="address_postalOrZipCode">Zip/Postal Code: </label>
                            </div>
                            <div class="col">
                              <input type="text" name="cPostatlZipCode" class="form-control" id="address_postalOrZipCode" placeholder="Enter Zip/Postal Code">
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
                </div>
              </form>
            </div>

            <div class="step2 step">
              <div class="col-lg-12 mb-4">
                <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Representative Information</h6>
                <div class="container py-4 px-2 px-sm-3">
                  <form class="request_form" action="#" method="post">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="representative_email">Email Address:<span class="text-danger">*</span></label>
                      </div>
                      <div class="col-md-8 row">
                        <div class="col-md-12">
                          <input type="email" name="email" class="form-control" id="representative_email" placeholder="Enter Email" title="sample@sample.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" required>
                          <small class="text-muted">The result of verification will be sent here.</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="representative_lastName">
                          Last Name:<span class="text-danger">*</span>
                          <div class="w-100"></div>
                        </label>
                      </div>
                      <div class="col-md-8 row">
                        <div class="col">
                          <input type="text" name="lname" class="form-control" id="representative_lastName" placeholder="Enter Last Name" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="representative_firstName">First Name:<span class="text-danger">*</span></label>
                      </div>
                      <div class="col-md-8 row">
                        <div class="col">
                          <input type="text" name="fname" class="form-control" id="representative_firstName" placeholder="Enter First Name" required>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="representative_middleName">
                          Middle Name:
                          <div class="w-100"></div>
                        </label>
                      </div>
                      <div class="col-md-8 row">
                        <div class="col">
                          <input type="text" name="middle" class="form-control" id="representative_middleName" placeholder="Enter Middle Name">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label for="representative_middleName">
                          Suffix:
                          <div class="w-100"></div>
                        </label>
                      </div>
                      <div class="col-md-8 row">
                        <div class="col">
                          <select name="representative_suffix" class="form-control selectpicker border" id="representative_suffix" title='Select suffix'>
                            <option value=""></option>
                            <option value="Jr">Jr</option>
                            <option value="Sr">Sr</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2 mb-2">
                        <a href="#" class="btn btn-danger w-100 back_btn">back</a>
                      </div>
                      <div class="col-md-2 offset-md-8">
                        <input type="submit" name="submit" value="Next" class="btn btn-danger w-100 next_btn" id="representative_submit_btn">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="step3 step">
              <div class="col-12 py-3">
                <div class="col-12 my-2 my-lg-4">
                  <div class="row">
                    <div class="col-md-2 offset-md-10">
                      <button class="btn btn-danger w-100" id="addApplicant" style="color: #fff">Add Applicant</button>
                    </div>
                  </div>
                </div>
                <form class="request_form" method="post" action="#" id="applicant_form">
                  <div id="applicant_field" class="row">
                    <div class="col-lg-4 mb-2">
                      <div class="row align-items-center bg-light m-0 p-1 border rounded-sm">
                        <div class="col-9 col-sm-10">
                          <h6 class="m-0">Applicant</h6>
                        </div>
                        <div class="col-3 col-sm-2 py-3">
                          <a id="removeApplicant" class="btn btn-danger btn-sm" style="color: #fff;cursor: pointer">&times;</a>
                        </div>
                      </div>
                      <div class="container py-4 px-2 px-sm-3">
                        <div class="form-group row">
                          <div class="col-md-5">
                            <label for="doctype">Document Type:<span class="text-danger">*</span></label>
                          </div>
                          <div class="col">
                            <select class="form-control border doctype" title="Document Type" data-live-search="true" data-style="btn" required pattern="a-zA-Z0-9{1}">
                              <option selected disabled value="">Document Type</option>
                              <option value="3">Transcript of Records</option>
                              <option value="5">Diploma</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-5">
                            <label for="file">File:<span class="text-danger">*</span></label>
                          </div>
                          <div class="col">
                            <div class="">
                              <input type="file" class="file" required>
                            </div>
                            <small class="text-muted">PDF copy of Transcript of Record/Diploma.</small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2 mb-2">
                      <a href="#" class="btn btn-danger w-100 back_btn">back</a>
                    </div>
                    <div class="col-md-2 offset-md-8">
                      <input type="submit" name="submit" value="Next" class="btn btn-danger w-100 next_btn">
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="step4 step">
              <div class="col-lg-12 mb-4">
                <h6 class="bg-light m-0 px-3 py-2 border rounded-sm">Request Summary</h6>
              </div>
              <div class="col-12 my-4" id="request_summary">

              </div>
              <div class="row">
                <div class="col-md-2 mb-2">
                  <a href="#" class="btn btn-danger w-100 back_btn">back</a>
                </div>
                <div class="col-md-2 offset-md-8">
                  <a href="#" id="submit_btn" class="btn btn-danger w-100" data-toggle='modal' data-target='#terms'>Submit</a>
                </div>
              </div>
            </div>
            <div class="step5 step">
              <section class="bg-light">
                <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
                  <h2>Complete your transaction</h2>
                </div>
              </section>
              <div class="container my-4 px-sm-4 my-md-5 my-lg-3 px-lg-3 py-lg-5 mb-lg-5">
                <div class="row mb-3">
                  <div class="col-12">
                    <h4 style="color: maroon;">Your request for verification is completed!</h4>
                    <h5 class="text-secondary">Your verification ID: <span class="font-weight-bold" id="verID"></span></h5>
                    <p class="font-weight-light my-1">
                      You can download your <span class="font-weight-normal">Payment Voucher by </span><a href="#" target="_blank" id="voucher">clicking here</a>.
                    </p>
                  </div>
                  <div class="col-12 my-4">
                    <!-- <p><span class="font-weight-bold">Note:</span> You will also recieve an email with an attached payment voucher file.</p> -->
                    <!-- <p><span class="font-weight-bold">OR</span></p> -->
                  </div>
                  <!-- <div class="col-12">
                  <p class="font-weight-light my-1">
                  You can pay using the following:
                </p>
                <div class="payment">
                <a href="verification/payment/visa" target="_blank"><img src="<?php echo URL ?>public/img/icon-visa.png" alt=""></a>

                <a href="verification/payment/master" target="_blank"><img src="<?php echo URL ?>public/img/icon-master.png" alt=""></a>

                <a href="verification/payment/paypal" target="_blank"><img src="<?php echo URL ?>public/img/icon-paypal.png" alt=""></a>
              </div>
            </div> -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-2 offset-md-10">
            <a href="#" id="finish_btn" class="btn btn-danger w-100">Finish</a>
          </div>
        </div>
      </div>
      <div class="step6 step">
        <section class="bg-light">
          <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
            <h2>Transaction Complete.</h2>
          </div>
          <div class="container">
            <p>Your verification request has been sent!</p>
            <p>Thank you for using PUP's graduate verification system!</p>
            <p>Have a great day!!</p>
          </div>
        </section>
        <div class="col-12 col-md-6 offset-lg-10 col-lg-2">
          <input type="hidden" id="repID">
          <a href="#" class="btn btn-danger w-100" id="askAccount">Return Home</a>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
  <?php endif; ?>
  <div class="col-12 my-2 my-lg-2">
    <div class="row">

    </div>
  </div>

  <div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Terms</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form id="terms_form">
                <div class="modal-body px-4">
                  <div class="container">
                    <h5>By using this service, you understood and agree to the PUP Online Services <a href="https://www.pup.edu.ph/terms/" target="_blank">Terms of Use</a> and <a href="https://www.pup.edu.ph/terms/" target="_blank">Privacy Statement</a></h5>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" value="isFastLane" id="fastlane" required>
                      <label class="custom-control-label" for="fastlane" style="cursor: pointer">I Agree</label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger w-25">Continue</button>
                </div>
              </form>
          </div>
      </div>
  </div> <!-- modify branch modal -->

</div>
<div class="modal fade" id="loadModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" style="background: rgba(0,0,0,0); text-align: center; border: none; color: #ccc">
            <img src="<?php echo URL ?>public/img/loading.gif" alt="load">
            <h5>Please wait..</h5>
        </div>
    </div>
</div>
