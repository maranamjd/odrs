<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Subjects</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addSubjectModal'>
                  <span class="fa fa-plus">Add Subject</span>
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_subjects" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Subject Code</th>
                                <th width="55%">Title</th>
                                <th width="10%">Credits</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->subjects)): ?>
                            <?php foreach ($this->subjects as $key => $subject): ?>
                              <tr>
                                <td><?php echo $subject['subjectCode']; ?></td>
                                <td><?php echo $subject['title']; ?></td>
                                <td><?php echo $subject['credits']; ?></td>
                                <td>
                                  <button type='button' class='btn btn-primary' id="editSubject">
                                  <span class="fa fa-edit"></span>
                                    <input type="hidden" id="ecode" value="<?php echo $subject['subjectCode']; ?>">
                                    <input type="hidden" id="etitle" value="<?php echo $subject['title']; ?>">
                                    <input type="hidden" id="ecredit" value="<?php echo $subject['credits']; ?>">
                                  </button>
                                  <button type='button' class='btn btn-danger deleteSubject'>
                                    <span class="fa fa-trash-o"></span>
                                    <input type="hidden" id="ecode" value="<?php echo $subject['subjectCode']; ?>">
                                  </button>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div> <!-- box -->
        </div> <!-- container -->

        <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Subject</h5>
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
                                            <label for="bname">Subject Code: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="subject_code" placeholder="Enter Subject Code">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="badd">Title: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="subject_title" placeholder="Enter Subject Title">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="dir">Credits: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="fullname" class="form-control" id="subject_credit" placeholder="Enter Subject Credit/s">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="addSubject">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- add branch modal -->

        <div class="modal fade" id="modifySubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Subject</h5>
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
                                            <label for="bname">Subject Code: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="Esubject_code" placeholder="Enter Subject Code" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="badd">Title: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="Esubject_title" placeholder="Enter Subject Title">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="dir">Credits: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="fullname" class="form-control" id="Esubject_credit" placeholder="Enter Subject Credit/s">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="updateSubject">Update</button>
                    </div>
                </div>
            </div>
        </div> <!-- add branch modal -->
