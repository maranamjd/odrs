<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Accounts</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addUserModal'>
                    Add New User
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_requests" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Lastname</th>
                                <th>Firstname</th>
                                <th>Middle</th>
                                <th>Office</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = [
                                'ACCOUNT-101' => ['Dela Curz', 'Juan', 'A', 'Registrar', 1],
                                'ACCOUNT-102' => ['Dela Curz', 'Juan', 'A', 'Library', 1],
                                'ACCOUNT-103' => ['Dela Curz', 'Juan', 'A', 'College Laboratory', 1],
                                'ACCOUNT-104' => ['Dela Curz', 'Juan', 'A', 'C.H.K (P.E.)', 1],
                                'ACCOUNT-105' => ['Dela Curz', 'Juan', 'A', 'Accounting', 1],
                                'ACCOUNT-106' => ['Dela Curz', 'Juan', 'A', 'Internal Audit', 1],
                                'ACCOUNT-107' => ['Dela Curz', 'Juan', 'A', 'Legal', 1],
                                'ACCOUNT-108' => ['Dela Curz', 'Juan', 'A', 'Legal', 2],
                            ];
                            function action($n) {
                                if ($n == 1) {
                                    return "<span class='btn btn-outline-success btn-sm w-100'>active</span>";
                                } else {
                                    return "<span class='btn btn-outline-secondary btn-sm w-100'>deactivated</span>";
                                }
                            };

                            foreach ($data as $key => $account) {
                                echo
                                    "<tr>
                                        <td class='w-25'>$key</td>
                                        <td>$account[0]</td>
                                        <td>$account[1]</td>
                                        <td>$account[2]</td>
                                        <td>$account[3]</td>
                                        <td class='align-middle text-center'>" . action($account[4]) . "</td>
                                        <td class='align-middle text-center p-0'>
                                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modifyUserModal'>Modify</button>
                                            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#confirmDeleteModal'>Delete</button>
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>

        <!-- add user -->
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-4 pb-2">
                        <div class="row pb-3">
                            <div class="col-12">
                                <h5 style="color: maroon;">Please fill-up the following.</h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="lname">
                                    Last Name:<span class="text-danger">*</span>
                                </label>
                            </div>
                            <div class="col">
                                <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter Last Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="fname">First Name:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter First Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="middle">
                                    Middle Name:
                                </label>
                            </div>
                            <div class="col">
                                <input type="text" name="middle" class="form-control" id="middle" placeholder="Enter Middle Name">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="chkMiddle" class="form-check-input" id="noMiddle">
                                    <label class="form-check-label text-muted" for="noMiddle">No middle name</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="office">Office:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <select name="office" class="form-control" data-live-search="true" id="office">
                                    <option selected>Office</option>
                                    <option value="1">Registrar</option>
                                    <option value="2">Library</option>
                                    <option value="3">College Laboratory</option>
                                    <option value="4">C.H.K (P.E.)</option>
                                    <option value="5">Accounting</option>
                                    <option value="6">Internal Audit</option>
                                    <option value="7">	Legal</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="user">Username:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <input type="text" name="user" class="form-control" id="user" placeholder="Enter Username">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="pass">Password:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <input type="password" name="pass" class="form-control" id="pass" placeholder="Enter Password">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" data-dismiss="modal">Add User</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add user -->

        <!-- modify user -->
        <div class="modal fade" id="modifyUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Modify Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-4 pb-2">
                        <div class="row pb-3">
                            <div class="col-12">
                                <h5 style="color: maroon;">Please fill-up the following.</h5>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="lname">
                                    Last Name:<span class="text-danger">*</span>
                                </label>
                            </div>
                            <div class="col">
                                <input type="text" name="lname" class="form-control" id="lname" value="Dela Curz" placeholder="Enter Last Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="fname">First Name:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <input type="text" name="fname" class="form-control" id="fname" value="Juan" placeholder="Enter First Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="middle">
                                    Middle Name:
                                </label>
                            </div>
                            <div class="col">
                                <input type="text" name="middle" class="form-control" id="middle" value="A" placeholder="Enter Middle Name">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="chkMiddle" class="form-check-input" id="noMiddle">
                                    <label class="form-check-label text-muted" for="noMiddle">No middle name</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="office">Office:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <select name="office" class="form-control" data-live-search="true" id="office">
                                    <option selected>Office</option>
                                    <option value="1" selected>Registrar</option>
                                    <option value="2">Library</option>
                                    <option value="3">College Laboratory</option>
                                    <option value="4">C.H.K (P.E.)</option>
                                    <option value="5">Accounting</option>
                                    <option value="6">Internal Audit</option>
                                    <option value="7">	Legal</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="user">Username:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <input type="text" name="user" class="form-control" id="user" value="registrar25" placeholder="Enter Username">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="user">Status:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <select name="u_status" class="form-control" id="user">
                                    <option>Active</option>
                                    <option>Deactivated</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="pass">Password:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <input type="password" name="pass" class="form-control" id="pass" placeholder="Enter Password">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-50" data-dismiss="modal">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="Comfirm Delete" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: maroon;" id="confirmDeleteTitle">Confirm Delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure you want to delete?</h5>
                        <p class="m-0 mt-3">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- confirm delete -->
