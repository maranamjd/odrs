<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Courses</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addCourseModal'>
                  <span class="fa fa-plus">Add Course</span>
                     </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_courses" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th with="70%">Description</th>
                              <th with="15%">College</th>
                              <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->courses)): ?>
                            <?php foreach ($this->courses['courses'] as $key => $courses): ?>
                              <tr>
                                <td><?php echo $courses['description']; ?></td>
                                <td><?php echo $courses['acronym']; ?></td>
                                <td class='align-middle text-center p-0'>
                                    <button type='button' class='btn btn-primary' id="editCourse">
                                    <span class="fa fa-edit"></span>
                                      <input type="hidden" id="cid" value="<?php echo $courses['courseID']; ?>">
                                      <input type="hidden" id="cdesc" value="<?php echo $courses['description']; ?>">
                                      <input type="hidden" id="ccollege" value="<?php echo $courses['collegeID']; ?>">
                                    </button>
                                    <button type='button' class='btn btn-danger deleteCourse'>
                                      <span class="fa fa-trash-o"></span>
                                      <input type="hidden" id="cid" value="<?php echo $courses['courseID']; ?>">
                                    </button>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </tbody>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>

        <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row">
                            <div class="col-12">
                                <h5 style="color: maroon;">Please fill-up the following.</h5>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                                <form>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">Course Title: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="course_desc" placeholder="Enter Course Title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">College: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                          <select name="doc" class="form-control selectpicker border" data-live-search="true" data-style="btn" title="College" id="course_college">
                                            <?php if (isset($this->courses)): ?>
                                              <?php foreach ($this->courses['colleges'] as $course): ?>
                                                <option value="<?php echo $course['collegeID'] ?>"><?php echo $course['acronym'] ?></option>
                                              <?php endforeach; ?>
                                            <?php endif; ?>
                                          </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="addCourse">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- add branch modal -->

        <div class="modal fade" id="modifyCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Course Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row">
                            <div class="col-12">
                                <h5 style="color: maroon;">Please fill-up the following.</h5>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                              <form>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">Course Title: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="Ecourse_desc" placeholder="Enter Course Title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">College: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <select name="doc" class="form-control selectpicker border" data-live-search="true" data-style="btn" title="College" id="Ecourse_college">
                                        <?php if (isset($this->courses)): ?>
                                          <?php foreach ($this->courses['colleges'] as $course): ?>
                                            <option value="<?php echo $course['collegeID'] ?>"><?php echo $course['acronym'] ?></option>
                                          <?php endforeach; ?>
                                        <?php endif; ?>
                                      </select>
                                    </div>
                                </div>
                                  <input type="hidden" id="Ecourse_id">
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="updateCourse">Update Course</button>
                    </div>
                </div>
            </div>
        </div> <!-- modify branch modal -->
