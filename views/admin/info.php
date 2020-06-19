<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Branch Information</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addBranchModal'>
                    <span class="fa fa-plus">Add Branch</span>
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_requests" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>Branch</th>
                              <th>Director</th>
                              <th>Branch Code</th>
                              <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->branches)): ?>
                            <?php foreach ($this->branches as $key => $branch): ?>
                              <tr>
                                <td width="25%"><?php echo $branch['branchName']; ?></td>
                                <td width="45%"><?php echo $branch['directorFullName']; ?></td>
                                <td width="15%"><?php echo $branch['acronym']; ?></td>
                                <td width="15%" class='align-middle text-center p-0'>
                                    <button type='button' class='btn btn-primary' id="editBranch">
                                      <span class="fa fa-edit"></span>
                                      <input type="hidden" id="bname" value="<?php echo $branch['branchName']; ?>">
                                      <input type="hidden" id="bdirector" value="<?php echo $branch['directorFullName']; ?>">
                                      <input type="hidden" id="bacronym" value="<?php echo $branch['acronym']; ?>">
                                      <input type="hidden" id="bid" value="<?php echo $branch['branchID']; ?>">
                                    </button>
                                    <button type='button' class='btn btn-danger deleteBranch'>
                                      <span class="fa fa-trash-o"></span>
                                      <input type="hidden" id="bid" value="<?php echo $branch['branchID']; ?>">
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

        <div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Branch</h5>
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
                                            <label for="bname">Branch Name: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="branch_name" placeholder="Enter Branch Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="badd">Branch Acronym: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" id="branch_acronym" placeholder="Enter Acronym">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="dir">Director <span class="text-muted"><small>(LN/FN/MI)</small></span>:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="fullname" class="form-control" id="director" placeholder="Full Name">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="addBranch">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- add branch modal -->

        <div class="modal fade" id="modifyBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Branch Information</h5>
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
                                          <label for="bname">Branch Name: <span class="text-danger">*</span></label>
                                      </div>
                                      <div class="col">
                                          <input type="text" class="form-control" id="Ebranch_name" placeholder="Enter Branch Name">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <div class="col-md-3">
                                          <label for="badd">Branch Acronym: <span class="text-danger">*</span></label>
                                      </div>
                                      <div class="col-md-3">
                                          <input type="text" class="form-control" id="Ebranch_acronym" placeholder="Enter Acronym">
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <div class="col-md-3">
                                          <label for="dir">Director <span class="text-muted"><small>(LN/FN/MI)</small></span>:</label>
                                      </div>
                                      <div class="col-md-9">
                                          <input type="text" name="fullname" class="form-control" id="Edirector" placeholder="Full Name">
                                      </div>
                                  </div>

                                      <input type="hidden" id="Ebid">
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="updateBranch">Update Branch</button>
                    </div>
                </div>
            </div>
        </div> <!-- modify branch modal -->
