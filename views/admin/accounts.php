<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Branch Accounts</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#assignUserModal'>
                    Assign new user
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
                                <th>Branch Assigned</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = [
                                'USER-B100' => ['Dela Curz', 'Juan', 'A', 'Sta. Mesa', 1],
                                'USER-B101' => ['Dela Curz', 'Juan', 'A', 'Taguig City', 1],
                                'USER-B102' => ['Dela Curz', 'Juan', 'A', 'Quezon City', 1],
                                'USER-B103' => ['Dela Curz', 'Juan', 'A', 'Bataan', 1],
                                'USER-B104' => ['Dela Curz', 'Juan', 'A', 'Lopez, Quezon', 1],
                                'USER-B105' => ['Dela Curz', 'Juan', 'A', 'Mulanay, Quezon', 1],
                                'USER-B106' => ['Dela Curz', 'Juan', 'A', 'Unisan, Quezon', 1],
                                'USER-B107' => ['Dela Curz', 'Juan', 'A', 'Ragay, Camarines Sur', 1],
                                'USER-B108' => ['Dela Curz', 'Juan', 'A', 'Sto. Tomas, Batangas', 1],
                                'USER-B109' => ['Dela Curz', 'Juan', 'A', 'Maragondon, Cavite', 2]
                            ];
                            function action($n) {
                                if ($n == 1) {
                                    return "<span class='btn btn-outline-success btn-sm w-100'>active</span>";
                                } else {
                                    return "<span class='btn btn-outline-secondary btn-sm w-100'>deactivated</span>";
                                }
                            };

                            foreach ($data as $key => $acount) {
                                echo
                                    "<tr>
                                        <td>".$key."</td>
                                        <td>".$acount[0]."</td>
                                        <td>".$acount[1]."</td>
                                        <td>".$acount[2]."</td>
                                        <td>".$acount[3]."</td>
                                        <td class='align-middle text-center'>" . action($acount[4]) . "</td>
                                        <td class='align-middle text-center p-0'>
                                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modifyUserModal'>
                                                Modify
                                            </button>
                                                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#disableModal'>
                                                Disable
                                            </button>
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>

        <div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="Comfirm Delete" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: maroon;" id="confirmDeleteTitle">Disable Branch?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Are you sure you want to disable this branch?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- disable -->

        <div class="modal fade" id="assignUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Assign User</h5>
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
                                <label for="emal">Email:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <input type="email" name="emal" class="form-control" id="emal" placeholder="Enter Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="office">Branch:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <select name="stBranch" class="form-control selectpicker border" title="Select a Branch" data-live-search="true" data-style="btn" id="stBranch">
                                    <optgroup label="Metro Manila">
                                        <option>Sta. Mesa</option>
                                        <option>Taguig</option>
                                        <option>San Juan City</option>
                                        <option>Parañaque City</option>
                                    </optgroup>
                                    <optgroup label="Central Luzon">
                                        <option>Bataan</option>
                                        <option>Sta. Maria, Bulacan</option>
                                        <option>Pulilan, Bulacan</option>
                                        <option>Cabiao, Nueva Ecija</option>
                                    </optgroup>
                                    <optgroup label="South Luzon">
                                        <option>Lopez, Quezon</option>
                                        <option>Mulanay, Quezon</option>
                                        <option>Unisan, Quezon</option>
                                        <option>Ragay, Camarines Sur</option>
                                        <option>Sto. Tomas, Batangas</option>
                                        <option>Maragondon, Cavite</option>
                                        <option>Bansud, Oriental Mindoro</option>
                                        <option>Sablayan, Occidental Mindoro</option>
                                        <option>Biñan, Laguna</option>
                                        <option>San Pedro, Laguna</option>
                                        <option>Sta. Rosa, Laguna</option>
                                        <option>Calauan, Laguna</option>
                                    </optgroup>
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
                        <button type="button" class="btn btn-danger w-25" data-dismiss="modal">Assign User</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- assign user -->

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
                                <label for="emal">Email:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <input type="email" name="emal" class="form-control" id="emal" value="user1@gmail.com" placeholder="Enter Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="office">Branch:<span class="text-danger">*</span></label>
                            </div>
                            <div class="col">
                                <select name="stBranch" class="form-control selectpicker border" title="Select a Branch" data-live-search="true" data-style="btn" id="stBranch">
                                    <optgroup label="Metro Manila">
                                        <option selected>Sta. Mesa</option>
                                        <option>Taguig</option>
                                        <option>San Juan City</option>
                                        <option>Parañaque City</option>
                                    </optgroup>
                                    <optgroup label="Central Luzon">
                                        <option>Bataan</option>
                                        <option>Sta. Maria, Bulacan</option>
                                        <option>Pulilan, Bulacan</option>
                                        <option>Cabiao, Nueva Ecija</option>
                                    </optgroup>
                                    <optgroup label="South Luzon">
                                        <option>Lopez, Quezon</option>
                                        <option>Mulanay, Quezon</option>
                                        <option>Unisan, Quezon</option>
                                        <option>Ragay, Camarines Sur</option>
                                        <option>Sto. Tomas, Batangas</option>
                                        <option>Maragondon, Cavite</option>
                                        <option>Bansud, Oriental Mindoro</option>
                                        <option>Sablayan, Occidental Mindoro</option>
                                        <option>Biñan, Laguna</option>
                                        <option>San Pedro, Laguna</option>
                                        <option>Sta. Rosa, Laguna</option>
                                        <option>Calauan, Laguna</option>
                                    </optgroup>
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
