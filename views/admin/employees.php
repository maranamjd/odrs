<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Employee Information</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addEmployeeModal'>

                    <span class="fa fa-plus">Add Employee</span>
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_employees" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>Employee ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Branch</th>
                              <th>Office</th>
                              <th>Position</th>
                              <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->employees)): ?>
                            <?php foreach ($this->employees as $key => $employee): ?>
                              <tr>
                                <td width="15%"><?php echo $employee['id']; ?></td>
                                <td width="20%"><?php echo Functions::name_format($employee['fname'], $employee['lname'], $employee['mname'], true); ?></td>
                                <td width="10%"><?php echo $employee['email']; ?></td>
                                <td width="10%"><?php echo $employee['branch']; ?></td>
                                <td width="10%"><?php echo $employee['office']; ?></td>
                                <td width="20%"><?php echo $employee['position']; ?></td>
                                <td width="15%" class='align-middle text-center p-0'>
                                    <button type='button' class='btn btn-primary' id="editEmployee">
                                      <span class="fa fa-edit"></span>
                                      <input type="hidden" id="eid" value="<?php echo $employee['id']; ?>">
                                      <input type="hidden" id="efname" value="<?php echo $employee['fname']; ?>">
                                      <input type="hidden" id="emname" value="<?php echo $employee['mname']; ?>">
                                      <input type="hidden" id="elname" value="<?php echo $employee['lname']; ?>">
                                      <input type="hidden" id="eemail" value="<?php echo $employee['email']; ?>">
                                      <input type="hidden" id="ebranch" value="<?php echo $employee['branchid']; ?>">
                                      <input type="hidden" id="eoffice" value="<?php echo $employee['officeid']; ?>">
                                      <input type="hidden" id="eposition" value="<?php echo $employee['position']; ?>">
                                      <input type="hidden" id="eutype" value="<?php echo $employee['utypeid']; ?>">
                                    </button>
                                    <button type='button' class='btn btn-danger deleteEmployee'>
                                      <span class="fa fa-trash-o"></span>
                                      <input type="hidden" id="eid" value="<?php echo $employee['id']; ?>">
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

        <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Employee</h5>
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
                                            <label for="bname">Employee ID: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="employee_id" placeholder="Enter Employee ID">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">First Name: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="employee_fname" placeholder="Enter First Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">Middle Name: <span class="text-danger"></span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="employee_mname" placeholder="Enter Middle Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">Last Name: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="employee_lname" placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">Email: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="email" class="form-control" id="employee_email" placeholder="Enter Employee Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">Postition: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="employee_position" placeholder="Enter Employee Position">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">Branch: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                          <select name="employee_branch" class="form-control w-50 selectpicker border" id="employee_branch" title='Branch'>
                                            <?php if (isset($this->branches)): ?>
                                              <?php foreach ($this->branches as $branch): ?>
                                                <option value="<?php echo $branch['branchID']; ?>"><?php echo $branch['branchName']; ?></option>
                                              <?php endforeach; ?>
                                            <?php endif; ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">Office: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                          <select name="employee_office" class="form-control w-50 selectpicker border" id="employee_office" title='Office'>
                                            <?php if (isset($this->offices)): ?>
                                              <?php foreach ($this->offices as $office): ?>
                                                <option value="<?php echo $office['officeID']; ?>"><?php echo $office['name']; ?></option>
                                              <?php endforeach; ?>
                                            <?php endif; ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">User Type: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                          <select name="employee_utype" class="form-control w-50 selectpicker border" id="employee_utype" title='User Type'>
                            
                                                <option value="2">Registrar Personnel</option>
                                                <option value="3">Branch Personnel</option>
                                                <option value="4">Office Personnel</option>
                                          </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="addEmployee">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- add branch modal -->

        <div class="modal fade" id="modifyEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Employee Information</h5>
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
                                        <label for="bname">Employee ID: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="Eemployee_id" placeholder="Enter Employee ID" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">First Name: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="Eemployee_fname" placeholder="Enter First Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">Middle Name: <span class="text-danger"></span></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="Eemployee_mname" placeholder="Enter Middle Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">Last Name: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="Eemployee_lname" placeholder="Enter Last Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">Email: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                        <input type="email" class="form-control" id="Eemployee_email" placeholder="Enter Employee Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">Postition: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="Eemployee_position" placeholder="Enter Employee Position">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">Branch: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <select name="employee_branch" class="form-control w-50 selectpicker border" id="Eemployee_branch" title='Branch'>
                                        <?php if (isset($this->branches)): ?>
                                          <?php foreach ($this->branches as $branch): ?>
                                            <option value="<?php echo $branch['branchID']; ?>"><?php echo $branch['branchName']; ?></option>
                                          <?php endforeach; ?>
                                        <?php endif; ?>
                                      </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">Office: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <select name="employee_office" class="form-control w-50 selectpicker border" id="Eemployee_office" title='Office'>
                                        <?php if (isset($this->offices)): ?>
                                          <?php foreach ($this->offices as $office): ?>
                                            <option value="<?php echo $office['officeID']; ?>"><?php echo $office['name']; ?></option>
                                          <?php endforeach; ?>
                                        <?php endif; ?>
                                      </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="bname">User Type: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <select name="employee_utype" class="form-control w-50 selectpicker border" id="Eemployee_utype" title='User Type'>
                                            <option value="1">Admin</option>
                                            <option value="2">Registrar Personnel</option>
                                            <option value="3">Branch Personnel</option>
                                            <option value="4">Office Personnel</option>
                                      </select>
                                    </div>
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="updateEmployee">Update</button>
                    </div>
                </div>
            </div>
        </div>
      </div><!-- modify branch modal -->
