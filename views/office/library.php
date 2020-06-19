<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Library</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addClearanceModal'>
                    Add Student Clearance
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_requests" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Lastname</th>
                                <th>Firstname</th>
                                <th>Middle</th>
                                <th>Course</th>
                                <th>Year</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div> <!-- box -->
        </div> <!-- container -->
        <!-- view modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Student ID: 2019-00213-MN-1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                <div class="row">
                    <div class="col-12">
                        <h5>Dela Curz, Juan A.</h5>
                        <p class="m-0">Course: BSIT</p>
                        <p class="m-0">Cost of damage: <span class="badge badge-danger">&#8369;120</span></p>
                        <p class="m-0">Date happened: 2019-03-12</p>
                        <p class="m-0">Date to be settled: 2019-12-15</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <h6 style="color: maroon;">Cause Description</h6>
                        <p>
                            Example Cause Description Example Cause Description
                            Example Cause DescriptionExample Cause Description
                            Example Cause DescriptionExample Cause Description
                        </p>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Student ID: 2019-00213-MN-1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="stID">Student ID:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <input type="text" name="stID" class="form-control" id="stID" value="2015-00113-MN-1" placeholder="Enter Student ID">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="cdmg">Cost of Damage:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <input type="text" name="cdmg" class="form-control" id="cdmg" value="120" placeholder="Cost of Damage">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="dateh">Date happened:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <input type="date" name="dateh" class="form-control" value="2019-03-12" id="dateh">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="dates">Date to be settled:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <input type="date" name="dates" class="form-control" value="2019-12-15" id="dates">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="dates">Cause Description:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <textarea class="form-control" rows="3" id="desc-text">Example Cause Example Cause Example Cause Example Cause Example Cause Example Cause Example Cause Example Cause Example Cause</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <button type='button' class='btn btn-danger'>Mark</button> -->

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- add new clearance modal -->
<div class="modal fade" id="addClearanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add Student Clearance</h5>
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
                                <div class="col-md-4">
                                    <label for="stID">Student ID:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <input type="text" name="stID" class="form-control" id="stID" placeholder="Enter Student ID">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="cdmg">Cost of Damage:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <input type="text" name="cdmg" class="form-control" id="cdmg" placeholder="Cost of Damage">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="dateh">Date happened:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <input type="date" name="dateh" class="form-control" id="dateh">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="dates">Date to be settled:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <input type="date" name="dates" class="form-control" id="dates">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="dates">Cause Description:<span class="text-danger">*</span></label>
                                </div>
                                <div class="col">
                                    <textarea class="form-control" rows="3" id="desc-text"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger  w-50" data-dismiss="modal">Add</button>
            </div>
        </div>
    </div>
</div>
