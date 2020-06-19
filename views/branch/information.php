<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Branch Information</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#branchInfoModal'>
                    Update Information
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="row">
                    <div class="col-1">
                        <h5>Name:</h5>
                    </div>
                    <div class="col">
                        <h5>Sta. Mesa</h5>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-1">
                        <h5>Address:</h5>
                    </div>
                    <div class="col">
                        <h5>Metro, Manila</h5>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-1">
                        <h5>Director:</h5>
                    </div>
                    <div class="col">
                        <h5>Juan Dela Cruz</h5>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-1">
                        <h5>Registrar:</h5>
                    </div>
                    <div class="col">
                        <h5>Juan Dela Cruz</h5>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-1">
                        <h5>Offices:</h5>
                    </div>
                    <div class="col-2">
                        <h5 class="invisible">hidden</h5>
                        <h5>Registrar</h5>
                        <h5>Library</h5>
                        <h5>College Laboratory</h5>
                        <h5>C.H.K (P.E.)</h5>
                        <h5>Accounting</h5>
                        <h5>Internal Audit</h5>
                    </div>
                    <div class="col-1">
                        <h5>Location:</h5>
                    </div>
                    <div class="col-3">
                        <h5 class="invisible">hidden</h5>
                        <h5>Registrar Location</h5>
                        <h5>Library Location</h5>
                        <h5>College Laboratory Location</h5>
                        <h5>C.H.K (P.E.) Location</h5>
                        <h5>Accounting Location</h5>
                        <h5>Internal Audit Location</h5>
                    </div>
                </div>

            </div> <!-- box -->
        </div> <!-- container -->

        <div class="modal fade" id="branchInfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                            <input type="text" class="form-control" id="bname" value="Sta. Mesa" placeholder="Enter Branch Name" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="badd">Branch Address: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="badd" value="Metro Manila" placeholder="Enter Branch Address" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="dir">Director <span class="text-muted"><small>(LN/FN/MI)</small></span>: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="lname" class="form-control" id="dir" value="Dela Cruz" placeholder="Last Name">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="fname" class="form-control" id="dir" value="Juan" placeholder="First Name">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="mi" class="form-control" id="dir" value="A" placeholder="Middle Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="reg">Registrar <span class="text-muted"><small>(LN/FN/MI)</small></span>: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="r_lname" class="form-control" id="reg" value="Dela Cruz" placeholder="Last Name">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="r_fname" class="form-control" id="reg" value="Juan" placeholder="First Name">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="r_mi" class="form-control" id="reg" value="A" placeholder="Middle Name">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-12">
                                            <label for="offices">Offices: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <p class="text-muted m-0">Name:</p>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="of_n1" class="form-control mb-2" value="Registrar" placeholder="Office Name">
                                                            <input type="text" name="of_n2" class="form-control mb-2" value="Library" placeholder="Office Name">
                                                            <input type="text" name="of_n3" class="form-control mb-2" value="College Laboratory" placeholder="Office Name">
                                                            <input type="text" name="of_n4" class="form-control mb-2" value="C.H.K (P.E.)" placeholder="Office Name">
                                                            <input type="text" name="of_n5" class="form-control mb-2" value="Accounting" placeholder="Office Name">
                                                            <input type="text" name="of_n6" class="form-control mb-2" value="Internal Audit" placeholder="Office Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <p class="text-muted m-0">Location:</p>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" name="of_loc1" class="form-control mb-2" value="Registrar Location" placeholder="Office Location">
                                                            <input type="text" name="of_loc2" class="form-control mb-2" value="Library Location" placeholder="Office Location">
                                                            <input type="text" name="of_loc3" class="form-control mb-2" value="College Laboratory Location" placeholder="Office Location">
                                                            <input type="text" name="of_loc4" class="form-control mb-2" value="C.H.K (P.E.) Location" placeholder="Office Location">
                                                            <input type="text" name="of_loc5" class="form-control mb-2" value="Accounting Location" placeholder="Office Location">
                                                            <input type="text" name="of_loc6" class="form-control mb-2" value="Internal Audit Location" placeholder="Office Location">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" data-dismiss="modal">Update Branch</button>
                    </div>
                </div>
            </div>
        </div> 
