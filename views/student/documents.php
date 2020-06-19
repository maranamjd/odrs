<?php if (isset($this->pageInfo['clearance'])): ?>
  <section class="bg-light">
    <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-3">
      <div class="row justify-content-center align-items-center my-lg-4">
        <div class="col-lg-10 my-3 my-lg-4">
          <div class="bg-white p-2 p-lg-5 shadow-sm rounded-lg">
            <h4 style="color: maroon;">You have an unsettled clearance record.</h4>
            <div class="col-lg-12">
              <p><span class="font-weight-bold">Note:</span> You cannot transact a new request until you settle your clearance record.</p>
            </div>
            <div class="">
              <ul id="clr" class="list-group">
                <div class="container">
                  <?php foreach ($this->pageInfo['clearance'] as  $val): ?>
                    <li class="list-group-item mb-2">
                      <p><b><?php echo $val['name'] ?>:</b></p>
                      <p class="float-right"><?php echo date('F d, Y', strtotime($val['created_on'])) ?></p>
                      <p class="ml-4"><?php echo $val['description'] ?></p>
                    </li>
                  <?php endforeach; ?>
                </div>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php else: ?>

  <?php if (isset($this->pageInfo['pending'])): ?>
    <input type="hidden" class="pending" value="<?php echo $this->pageInfo['pending']['controlNumber']; ?>">
    <section class="bg-light">
      <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-3">
        <div class="row justify-content-center align-items-center my-lg-4">
          <div class="col-lg-10 my-3 my-lg-4">
            <div class="bg-white p-4 p-lg-5 shadow-sm rounded-lg">
              <h4 style="color: maroon;">You have a Pending Request</h4>
              <h6 class="text-secondary mb-4">Control Number: <?php echo $this->pageInfo['pending']['controlNumber']; ?></h6>
              <div class="container mb-4">
                <ul class="list-group" id="requested_docs">
                </ul>
              </div>
              <div class="col-lg-12">
                <p><span class="font-weight-bold">Note:</span> You cannot transact a new request until your pending request is either Claimed or Cancelled.</p>
              </div>
              <div class="form-group m-0">
                <div class="row justify-content-end">
                  <div class="col-md-3 pl-md-0">
                    <input type="submit" id="cancel" class="btn btn-danger w-100 mt-1 mt-sm-0" value="Cancel Request"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php else: ?>
    <input type="hidden" class="pending" value="0">
    <section class="bg-light">
      <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-3">
        <div class="row justify-content-center align-items-center my-lg-4">
          <div class="col-lg-10 my-3 my-lg-4">
            <div class="bg-white p-4 p-lg-5 shadow-sm rounded-lg">
              <?php if (isset($this->pageInfo['documents'])): ?>
                <form method="post" action="#" id="document_form">
                  <h4 style="color: maroon;">Please select a document</h4>
                  <h6 class="text-secondary mb-4">ID: <?php echo $this->pageInfo['student']['studentNumber']; ?></h6>
                  <p class="mb-1"><small>Documents</small></p>

                  <!-- Select Documents -->
                  <div class="form-row mb-2" id="docDiv">
                    <div class='form-group row col-12 my-1'>
                      <div class='input-group col-11 inputs'>
                        <select name='document[]' class='form-control w-50 border document' title='Select a Document' data-live-search='true' data-style='btn' required pattern="a-zA-Z0-9{1}">
                          <option selected disabled value="">Select Document</option>
                          <?php foreach ($this->pageInfo['documents'] as $key => $type): ?>
                            <optgroup label="<?php echo $key ?>">
                              <?php foreach ($type as $doc): ?>
                                <option class='doc_<?php echo $doc['documentID'] ?>' value='<?php echo $doc['documentID'] ?>' rel="<?php echo $doc['price'] ?>">
                                  <?php echo $doc['description'] ?>
                                </option>
                              <?php endforeach; ?>
                            </optgroup>
                          <?php endforeach; ?>
                        </select>
                        <select name='quantity[]' class="form-control w-10 border quantity" title='Copies' data-live-search='true' data-style='btn' required>
                          <?php for ($i=1; $i <= $GLOBALS['MAX_COPY'] ; $i++) {?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                          <?php  } ?>
                        </select>
                        <div class='input-group-prepend'>
                          <input type="hidden" name="price[]" class="price">
                          <span class='input-group-text'>&#8369;</span>
                        </div>
                      </div>
                      <div class="col-1">
                        <a href='#' class='btn btn-danger ml-1 ml-sm-2 ml-md-3 removeDoc'><span class="fa fa-trash-o"></span></a>
                      </div>
                    </div>
                  </div> <!-- Select Documents -->
                  <!-- add document/fast lane -->
                  <div class="form-row align-items-center mb-3 mb-md-5" id="conf">
                    <div class="form-group col-12 col-sm-6 col-md-4">
                      <a href="#" id="addDoc" class="btn btn-danger w-100">Add More Documents</a>
                    </div>
                    <div class="form-group col-6 col-sm-3 col-md-4">
                      <div class="ml-sm-3">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" value="isFastLane" id="fastlane">
                          <label class="custom-control-label" for="fastlane" style="cursor: pointer">Fast Lane</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-6 col-sm-3 col-md-4">
                      <p class="m-0 text-right">Total: &#8369; <span class="font-weight-bold" id="total">0</span></p>
                    </div>
                    <div class="col-lg-12">
                      <p><span class="font-weight-bold">Note:</span> Extra copies of document is free.</p>
                    </div>
                  </div> <!-- add document/fast lane -->

                  <?php if ($this->pageInfo['student']['email'] == null || $this->pageInfo['student']['mobileNumber'] == null): ?>
                    <div class="form-row my-3 my-md-4">
                      <h4 style="color: maroon;">Please enter your contact information</h4>
                      <div class="form-group col-12 my-2">
                        <label for="mob_num" class="mb-1"><small>Mobile Number:<span class="text-danger">* </span></small></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="mob_num">
                              09
                            </span>
                          </div><input type="text" name="mobile_number" class="form-control" id="ver_mobile_number" placeholder="559507192" pattern="[0-9]{9}" value="<?php echo ltrim($this->pageInfo['student']['mobileNumber'], '09') ?>" required autofocus>
                        </div>
                      </div>
                      <div class="form-group col-12 my-2">
                        <label for="email" class="mb-1"><small>Email:<span class="text-danger">* </span></small></label>
                        <input type="text" name="email" class="form-control" id="ver_email" placeholder="sample@sample.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" value="<?php echo $this->pageInfo['student']['email'] ?>" required>
                      </div>
                      <div class="col-lg-12">
                        <p><span class="font-weight-bold">Note:</span> Request Updates will be sent here.</p>
                      </div>
                    </div> <!-- credentials -->
                  <?php endif; ?>
                  <!-- proceed -->
                  <div class="form-group m-0">
                    <div class="row justify-content-end">
                      <div class="col-md-3 pl-md-0">
                        <input type="submit" id="proceed" class="btn btn-danger w-100 mt-1 mt-sm-0" value="Proceed" style="display: none"/>
                      </div>
                    </div>
                  </div>
                </form>
              <?php else: ?>
                <h6 class="text-secondary mb-4">Sorry. There are no available documents at the time.</h6>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

<?php endif; ?>





<div class="modal fade" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="verify_form" action="#" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <!-- credentials -->
          <h4 style="color: maroon;">Please fill-up the form for verification.</h4>
          <h6 class="text-muted my-2">fill up the form with your information (while in PUP)</h6>
          <div class="form-row my-3 my-md-4">
            <div class="form-group col-md-6 mb-2 offset-md-1">
              <label for="lname">Last Name:<span class="text-danger">* </span></label>
              <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter Last Name" required autofocus>
            </div>
            <div class="form-group col-md-6 mb-2 offset-md-1">
              <label for="fname">First Name:<span class="text-danger">* </span></label>
              <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter First Name" required>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label for="suffix">Suffix:</label>
              <select name="suffix" class="form-control selectpicker border" id="suffix" title='Select suffix'>
                <option value=""></option>
                <option value="Jr">Jr</option>
                <option value="Sr">Sr</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
              </select>
            </div>
            <div class="form-group col-md-6 mb-2 offset-md-1">
              <label for="middle">Middle Name:</label>
              <input type="text" name="middle" class="form-control" id="mname" placeholder="Enter Middle Name">
            </div>
            <div class="form-group col-md-6 mb-2 offset-md-1">
              <label for="course">Course:<span class="text-danger">* </span></label>
              <select name="course" class="form-control selectpicker border" id="course" data-live-search="true" data-style="btn" title='Select Course' required>
                <?php if (isset($this->pageInfo['courses'])): ?>
                  <?php foreach ($this->pageInfo['courses'] as $key => $course): ?>
                    <option value="<?php echo $course['courseID'] ?>"><?php echo $course['description'] ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label for="year_graduated">Year Graduated:</label>
              <select name="year_graduated" class="form-control selectpicker border" id="year_graduated" title='Select year'>
                <option value="">Undergraduate</option>
                <?php
                  $yearNow = date('Y');
                  for ($x = 0; $x <= 60; $x++) {
                    $year = $yearNow - $x;
                    echo "<option value='$year'>$year</option>";
                  }
                ?>
              </select>
            </div>
          </div> <!-- credentials -->
          <h6 class="text-muted my-2">You have <b id="attempt"><?php echo $this->pageInfo['student']['attempt'] ?></b> remaining attempts.</h6>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="verify">Verify</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div> <!-- modal content -->
  </div>
</div> <!-- view request modal  -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <form class="contact_form" action="#" method="post">
        <div class="modal-header">
          <h5 class="modal-title" style="color: maroon;">Contact Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <!-- credentials -->
          <h4 style="color: maroon;">Request updates will be sent to your contact details</h4>
          <h6 class="text-muted my-2">please make sure your contact information is always updated.</h6>
          <div class="form-row my-3 my-md-4">
            <div class="form-group col-12 my-2">
              <label for="mob_num" class="mb-1"><small>Mobile Number:<span class="text-danger">* </span></small></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="mob_num">
                    09
                  </span>
                </div><input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="559507192" value="<?php echo ltrim($this->pageInfo['student']['mobileNumber'], '09') ?>" pattern="[0-9]{9}" required autofocus>
              </div>
            </div>
            <div class="form-group col-12 my-2">
              <label for="email" class="mb-1"><small>Email:<span class="text-danger">* </span></small></label>
              <input type="text" name="email" class="form-control" id="email" value="<?php echo $this->pageInfo['student']['email'] ?>" placeholder="sample@sample.com" required>
            </div>
          </div> <!-- credentials -->
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="save">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div> <!-- modal content -->
  </div>
</div> <!-- view request modal  -->
