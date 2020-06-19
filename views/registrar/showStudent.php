<div class="container-fluid mt-3 mb-5">
            <div class="p-4 border ">
              <h4 align="center">Student Information</h4><br>
              <div class="row">
                  <input type="hidden" name="isGrad" id="isGrad" value="<?php echo $this->showStudent['info'][0]['isGrad']; ?>">
                  <div class="form-group col-md-3" style="display: inline-block;">
                    <label for="studentNumber">Student Number:</label>
                    <div class="input-container">
                      <i class="fa fa-2x icon"></i>
                      <input class="input-field" type="text" value="<?php echo $this->showStudent['info'][0]['studentNumber']; ?>" id="studentNumber" name="studentNumber" readonly>
                      </div>
                  </div>
                  <div class="form-group col-md-4" style="display: inline-block;">
                    <label for="course">Course:</label>
                    <div class="input-container">
                    <i class="fa fa-2x icon"></i>
                      <textarea name="course" id="course" class="form-control" rows="2" cols="80" readonly><?php echo $this->showStudent['info'][0]['course']; ?></textarea>

                      </div>
                  </div>
                  <div class="form-group col-md-3" style="display: inline-block;">
                    <label for="branch">Branch:</label>
                    <div class="input-container">
                      <i class="fa fa-2x icon"></i>
                      <input class="input-field" type="text" value="<?php echo $this->showStudent['info'][0]['branch']; ?>" id="branch" name="branch" readonly>
                      </div>
                  </div>
                  <div class="form-group col-md-2" style="display: inline-block;">
                    <label for="credentials">Credentials:</label>
                    <div class="input-container">
                    <i class="fa fa-2x icon"></i>
                      <input class="input-field" type="text" value="<?php echo $this->showStudent['info'][0]['credential']; ?>" id="credentials" name="credentials" readonly>
                      </div>
                  </div>

                  <div class="form-group col-md-4" style="display: inline-block;">
                    <label for="name">Fullname:</label>
                    <div class="input-container">
                    <i class="fa fa-2x icon"></i>
                      <input class="input-field" type="text" value="<?php echo $this->showStudent['info'][0]['fullName']; ?>" id="name" name="name" readonly>
                      </div>
                  </div>

                  <div class="form-group col-md-2" style="display: inline-block;">
                    <label for="bday">Birthday:</label>
                    <div class="input-container">
                    <i class="fa fa-2x icon"></i>
                      <input class="input-field" type="text" value="<?php echo $this->showStudent['info'][0]['bday']; ?>" id="bday" name="bday" readonly>
                      </div>
                  </div>
                  <div class="form-group col-md-2" style="display: inline-block;">
                    <label for="yearAdmitted">Year Admitted  :</label>
                    <div class="input-container">
                      <i class="fa fa-2x icon"></i>
                      <input class="input-field" type="text" value="<?php echo $this->showStudent['info'][0]['yearAdmitted']; ?>" id="yearAdmitted" name="yearAdmitted" readonly>
                      </div>

                  </div>
                  <div class="form-group col-md-2" style="display: inline-block;">
                    <label for="status">Status:</label>
                    <div class="input-container">
                      <i class="fa fa-2x icon"></i>
                      <input class="input-field" type="text" value="<?php echo $this->showStudent['info'][0]['status']; ?>" id="status" name="status" readonly>
                      </div>

                  </div>
                  <div class="form-group col-md-2" style="display: inline-block;">
                    <label for="yrGrad">Year Graduated:</label>
                    <div class="input-container">
                      <i class="fa fa-2x icon"></i>
                      <input class="input-field" type="text" value="<?php echo $this->showStudent['info'][0]['dateGraduated']; ?>" id="yrGrad" name="yrGrad" readonly>
                      </div>

                  </div>

                  <div class="form-group col-md-5" style="display: inline-block;">
                    <label for="address">Permanent Address:</label>
                    <div class="input-container">
                      <i class="fa fa-2x icon"></i>
                      <textarea name="name" class="form-control" rows="2" cols="80" readonly><?php echo $this->showStudent['info'][0]['address']; ?></textarea>
                      </div>
                  </div>
                  <div class="form-group col-md-4" style="display: inline-block;">
                    <label for="emails">Email:</label>
                    <div class="input-container">
                      <i class="fa fa-lg icon"></i>
                      <input class="input-field" type="text" value="<?php echo $this->showStudent['info'][0]['email']; ?>" id="emails" name="emails" readonly>
                      </div>
                  </div>
            </div>
        </div>

        <div class="container-fluid mt-4 mb-4">

            <div class="p-4 bg-white border rounded col-md-10 offset-1">
              <h4 align="center">Subjects Taken </h4><br>

              <button type="button" id="addBtn" name="button" class="btn btn-primary mb-4 float-right"><i class="fa fa-plus"></i>Add</button>


                <div class="table-responsive">
                    <table id="tbl_subjects" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="15%">Subject Code</th>
                                <th width="35%">Description</th>
                                <th width="15%">Semester</th>
                                <th width="15%">School Year</th>
                                <th width="10%">Grade</th>
                                <th width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->showStudent['subjects'])): ?>
                            <?php foreach ($this->showStudent['subjects'] as $val): ?>
                              <tr >
                                <td><?php echo $val['subjectCode']; ?></td>
                                <td><?php echo $val['title']; ?></td>
                                <td><?php echo $val['sem']; ?></td>
                                <td><?php echo $val['year']; ?></td>
                                <td><?php echo $val['grade']; ?></td>
                                <td><?php echo $val['action']; ?></td>
                              </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>


                <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="subjectTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body px-4">
                              <form id="form-subject" action="" method="post">
                                <div class="row m-3">
                                    <input type="hidden" name="studno" id="studno" value="">
                                    <label for="name" class="col-lg-4">School Year:</label>
                                    <div class="col-lg-8">
                                      <select name="yearpicker" id="yearpicker" class="form-control" required>
                                      <option value="" selected disabled>--SELECT SCHOOL YEAR--</option>
                                    </select>
                                      </div>
                                  </div>

                                  <div class="row m-3">
                                      <label for="name" class="col-lg-4">Semester:</label>
                                      <div class="col-lg-8">
                                        <select class="form-control" name="sems" id="sems" required>
                                          <option value="" selected disabled>--SELECT SEM--</option>
                                          <option value="1">FIRST SEM</option>
                                          <option value="2">SECOND SEM</option>
                                          <option value="3">SUMMER</option>

                                        </select>
                                        </div>
                                    </div>

                                        <div class="row">
                                          <label for="name" class="col-lg-3 ml-4">Subject:</label>
                                            <div class="col-md-12">
                                              <select name="subject" class="form-control selectpicker border " id="subject" data-live-search="true" data-style="btn" required>
                                                <option value=""selected disabled>Select Subject</option>
                                                <?php if (isset($this->showStudent['subjectList'])): ?>
                                                  <?php foreach ($this->showStudent['subjectList'][0] as $value): ?>
                                                    <option value="<?php echo $value['subjectCode']; ?>"><?php echo str_replace(' ', '',$value['subjectCode']).'  - '.$value['title'];  ?></option>
                                                  <?php endforeach; ?>
                                                  <?php endif; ?>
                                              </select>
                                            </div>
                                        </div>

                                        <div class="row m-3">
                                            <label for="name" class="col-lg-4">Grade:</label>
                                            <div class="col-lg-8">
                                              <input type="text" name="grade" class="form-control" value="" required>
                                              </div>
                                          </div>



                            </div>

                            <div class="modal-footer">
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- verifyVerificationModal -->

                <div class="modal fade" id="edtSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="edtTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body px-4">
                              <form id="form-uptsubject" action="" method="post">
                                <div class="row m-3">
                                    <input type="hidden" name="recID" id="recID" value="">
                                    <label for="name" class="col-lg-4">Subject:</label>
                                    <div class="col-lg-6 offset-1">
                                      <input type="text" name="subCode" id="subCode" class="form-control mb-2" readonly>
                                      </div>

                                      <div class="col-lg-12">
                                        <input type="text" name="subName" id="subName" class="form-control" readonly>
                                        </div>
                                  </div>
                                <div class="row m-3">
                                  
                                    <label for="name" class="col-lg-4">School Year:</label>
                                    <div class="col-lg-8">
                                      <select name="edtschoolYear" id="edtschoolYear" class="form-control" required>
                                    </select>
                                      </div>
                                  </div>

                                  <div class="row m-3">
                                      <label for="name" class="col-lg-4">Semester:</label>
                                      <div class="col-lg-8">
                                        <select class="form-control" name="edtsems" id="edtsems" required>

                                          <option value="1">FIRST SEM</option>
                                          <option value="2">SECOND SEM</option>
                                          <option value="3">SUMMER</option>

                                        </select>
                                        </div>
                                    </div>



                                        <div class="row m-3">
                                            <label for="name" class="col-lg-4">Grade:</label>
                                            <div class="col-lg-8">
                                              <input type="text" name="edtgrade" id="edtgrade" class="form-control" value="" required>
                                              </div>
                                          </div>



                            </div>

                            <div class="modal-footer">
                                <input type="submit" name="submit" class="btn btn-warning " id="updateBtn" value="Update">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- verifyVerificationModal -->
