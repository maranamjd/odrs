<div class="container-fluid mb-4">
        <div class="row justify-content-center p-4 bg-white border rounded"  style="min-height: 450px;">
                <div class="col-md-8 offset-2 cont mb-4">
                  <div id="wrapper">
                  <br>
                  <span class='baricon bg-danger '>1</span>
                  <span id="bar1" class='progress_bar bg-secondary'></span>
                  <span id="icon2" class='baricon bg-secondary'>2</span>
                  <span id="bar2" class='progress_bar bg-secondary'></span>
                  <span id="icon3" class='baricon bg-secondary'>3</span>
                  <!-- <div class="progress" style="height:30px;">
                     <div class="progress-bar bg-danger" role="progressbar" style="width:35%;" id="progressBar">
                      <b class="lead" id="progressText">Step 1</b>
                    </div>
                  </div> -->

                  </div>
                  </div>
                  <div class="col-md-7 mt-0">
                  <form id="form-data" action="" method="post">
                    <div id="first" >
                      <h4 class="text-center p-1 rounded">Student Information</h4>
                      <div class="form-group col-md-8" style="display: inline-block;">
                        <label for="studno">Student Number:</label><font color="red">*</font>
                        <input type="text" name="studno" id="studno" class="form-control" placeholder="Enter Student Number" oninvalid="alert('error');" required>
                      </div>
                      <div class="form-group col-md-3" style="display: inline-block;">

                        <div class="checkbox form-control mt-4">

                          <label><input type="checkbox" name="isGrad" id="isGrad"> Graduate?</label>
                        </div>
                      </div>
                      <div class="form-group col-md-7 "style="display: inline-block;">
                        <label for="lname">Lastname:</label><font color="red">*</font>
                        <input type="text"id="lname" name="lname" class="form-control" pattern="[a-z A-Z]*" placeholder="Enter Lastname" required>


                      </div>
                      <div class="form-group col-md-4 " style="display: inline-block;">
                        <label for="suffix">Suffix: </label>
                        <select class="form-control" id="suff" name="suffix">
                          <option value=""selected disabled>Select suffix</option>
                          <option value="Jr">Jr</option>
                          <option value="Sr">Sr</option>
                          <option value="II">II</option>
                          <option value="III">III</option>
                          <option value="IV">IV</option>
                          <option value="V">V</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6  "style="display: inline-block;">
                        <label for="fname">Firstname: </label><font color="red">*</font>
                        <input type="text" name="fname" id="fname" class="form-control" pattern="[a-z A-Z]*" placeholder="Enter Firstname" required>

                      </div>
                      <div class="form-group col-md-5 "style="display: inline-block;">
                        <label for="mname">Middlename: </label>
                        <input type="text" name="mname" id="mname" class="form-control" pattern="[a-z A-Z]*" placeholder="Enter Middlename">

                      </div>
                      <div class="form-group col-md-6 " style="display: inline-block;">
                        <label for="mname">BirthDay: </label><font color="red">*</font>
                        <?php echo $limit = date('Y')-16; ?>
                        <input type="date" name="bday" id="bday" max="<?php echo $limit.'-12-31';?>" class="form-control" placeholder="Select Date" required>

                      </div>
                      <div class="form-group col-md-5 " style="display: inline-block;">
                        <label for="ecredential">Entrance Credential: </label><font color="red">*</font>
                        <select class="form-control" name="ecredential" id="ecredential" required>
                          <option value="" selected disabled> Select Credential type</option>
                          <option value="PUPCET">PUPCET</option>
                          <option value="Transferee">Transferee</option>

                        </select>

                      </div>
                      <div class="form-group col-md-7" style="display: inline-block;">
                        <label for="course">Course: </label><font color="red">*</font>
                        <select name="course" class="form-control selectpicker " id="course" data-live-search="true" data-style="btn" required>
                          <option value=""selected disabled>Select Course</option>
                          <?php if (isset($this->data['courses'])): ?>
                            <?php foreach ($this->data['courses'][0] as $value): ?>
                              <option value="<?php echo $value['courseID']; ?>"><?php echo $value['description'];  ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4 " style="display: inline-block;">
                        <label for="branch">Branch: </label><font color="red">*</font>
                        <select name="branch" class="form-control selectpicker " id="branch" data-live-search="true" data-style="btn" required>
                          <option value="" selected disabled>Select Branch</option>
                          <?php if (isset($this->data['branches'])): ?>
                            <?php foreach ($this->data['branches'][0] as $key => $val): ?>
                              <option value="<?php echo $val['branchID']; ?>"><?php echo $val['branchName']; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                      </div>
                      <div width="450px" class="mt-5">

                      </div>
                      <div class="form-group">
                        <a href="#" class="btn btn-danger float-right" id="next-1">Next</a>
                      </div>
                    </div>
                    <div id="second">
                      <h4 class="text-center p-1 rounded">Contact Information</h4>
                      <div class="form-group col-md-7" style="display: inline-block;">
                        <label for="email">Email:</label><font color="red">*</font>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>

                      </div>
                      <div class="form-group col-md-5 " style="display: inline-block;">
                        <label for="mobile">Mobile No.: </label>
                        <input type="text" name="mnum" id="mnum" class="form-control" pattern="[0-9]{11}" placeholder="E.g. 09123456789" >

                      </div>
                      <div class="form-group col-md-5 " style="display: inline-block;">
                        <label for="phone">Telephone No.: </label>
                        <input type="text" name="tnum" id="tnum" class="form-control" placeholder="Enter Telephone Number" >

                      </div>
                      <h5 class="text-center p-1 rounded">Permanent Address</h5>
                      <!-- <div class="form-group col-md-5 " style="display: inline-block;">
                        <label for="country">Country: </label><font color="red">*</font>
                        <select name="country" class="form-control selectpicker crs-country border gds-cr" data-live-search="true" data-style="btn" country-data-region-id="gds-cr-one" data-language="en" id="address_country" required></select>

                      </div> -->
                      <div class="form-group col-md-5 " style="display: inline-block;">
                        <label for="phone">Province: </label><font color="red">*</font>
                        <select name="region" id="province" class="form-control border" required></select>

                      </div>
                      <div class="form-group col-md-5 " style="display: inline-block;">
                        <label for="phone">City/Town:</label><font color="red">*</font>
                        <select name="city" class="form-control border"  id="city" required></select>

                      </div>
                      <div class="form-group col-md-5 "style="display: inline-block;">
                        <label for="barr">Barangay: </label><font color="red">*</font>
                        <input type="text" name="barr" id="barr" class="form-control" placeholder="E.g. Tanyag" required>

                      </div>
                      <div class="form-group col-md-5" style="display: inline-block;">
                        <label for="houseNum">House/Building No.: </label><font color="red">*</font>
                        <input type="text" name="houseNum" id="houseNum" class="form-control" placeholder="E.g. #32 blk 4" required>

                      </div>



                      <div class="form-group">
                        <a href="#" class="btn btn-danger" id="prev-2">Prev</a>
                        <a href="#" class="btn btn-danger float-right" id="next-2">Next</a>

                      </div>
                    </div>
                    <div id="third">
                      <h4 class="text-center p-1 rounded">Educational Background</h4>

                      <div class="form-group col-md-7 " style="display: inline-block;">
                        <label for="HSname">High School: </label><font color="red">*</font>
                        <input type="text" name="HSname" id="HSname" class="form-control" placeholder="Enter Name of High School" required>
                      </div>
                      <div class="form-group col-md-3 " style="display: inline-block;">

                        <label for="HSGrad">Year Graduated: </label><font color="red">*</font>
                        <select class="form-control" name="HSGrad" id="HSGrad" required>
                          <option value="" selected disabled>Select Year</option>

                          <?php
                          for ($i=date('Y'); $i >= 1950 ; $i--) {
                            echo "<option>".$i."</option>";
                          }
                           ?>

                        </select>
                      </div>
                      <div class="form-group col-md-7" style="display: inline-block;">
                        <label for="elemname">Elementary School: </label><font color="red">*</font>
                        <input type="text" name="elemname" id="elemname" class="form-control" placeholder="Enter Name of Elementary School" required>
                      </div>
                      <div class="form-group col-md-3" style="display: inline-block;">
                        <label for="elemGrad">Year Graduated: </label><font color="red">*</font>
                        <select class="form-control" name="elemGrad" id="elemGrad" readOnly required>
                          <option value="" selected disabled>Select Year</option>
                        </select>

                      </div>
                      <p class=" p-1 rounded">*in PUP:</p>

                      <div class="form-group col-md-4" id="dateGrads" style="display: inline-block;">
                        <label for="dateGrad">Date Graduated: </label><font color="red">*</font>
                        <input type="date" name="dateGrad" id="dateGrad" class="form-control">
                      </div>
                      <div class="form-group col-md-3" style="display: inline-block;">
                        <label for="sems">No. of Semester(s): </label><font color="red">*</font>
                        <input type="number" name="sems" id="sems" class="form-control " value="1" min="1" max="12" step="1" required>
                      </div>
                      <div class="form-group col-md-3" style="display: inline-block;">
                        <label for="summer">No. of Summer(s): </label><font color="red">*</font>
                        <input type="number" name="summer" id="summer" class="form-control" value="0" min="0" max="6" step="1" required>
                      </div>

                      <div class="form-group">
                        <a href="#" class="btn btn-danger float-left" id="prev-3">Prev</a>
                        <input type="submit" name="submit" value="Submit" id="submit" class="btn btn-primary float-right">
                      </div>
                    </div>
                  </form>
                </div>
        </div> <!-- container -->
  </div>
