<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Offices</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter'>
                    Add Office
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
                                <th>Name</th>
                                <th>Date Added</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = [
                                'OFFICE-101' => ['Registrar', date('Y-m-d')],
                                'OFFICE-102' => ['Library', date('Y-m-d')],
                                'OFFICE-103' => ['College Laboratory', date('Y-m-d')],
                                'OFFICE-104' => ['C.H.K (P.E.)', date('Y-m-d')],
                                'OFFICE-105' => ['Accounting', date('Y-m-d')],
                                'OFFICE-106' => ['Internal Audit', date('Y-m-d')]
                            ];

                            foreach ($data as $key => $office) {
                                echo
                                    "<tr>
                                        <td class='w-25'>$key</td>
                                        <td>$office[0]</td>
                                        <td>$office[1]</td>
                                        <td class='align-middle text-center p-0'>
                                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modifyModal'>
                                                Modify
                                            </button>
                                                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#confirmDeleteModal'>
                                                Delete
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

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Office</h5>
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
                        <div class="row mt-3">
                            <div class="col-12">

                                <form>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="stID">Office Name:<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="stID" class="form-control" id="stID" placeholder="Enter Office Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="cdmg">Office Location:<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="cdmg" class="form-control" id="cdmg" placeholder="Enter Office Location">
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Add Office</button>
                    </div>
                </div>
            </div>
        </div> <!-- add office -->

        <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Modify Office</h5>
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
                        <div class="row mt-3">
                            <div class="col-12">

                                <form>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="stID">Office Name:<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="stID" class="form-control" id="stID" value="Registrar" placeholder="Enter Office Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="cdmg">Office Location:<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="cdmg" class="form-control" id="cdmg" value="Registrar Location" placeholder="Enter Office Location">
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Save Changes</button>
                    </div>
                </div>
            </div>
        </div> <!-- modify office -->
