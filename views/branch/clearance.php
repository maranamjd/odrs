<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Clearance</h5>
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
                                <th>Office</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = [
                                '2019-213-31' => ['Dela Curz', 'Juan', 'A', 'BSIT', 'Accounting', '2nd', 1],
                                '2019-213-32' => ['Dela Curz', 'Juan', 'A', 'BSCS', 'Library', '4th', 1],
                                '2019-213-33' => ['Dela Curz', 'Juan', 'A', 'BSCS', 'Accounting', '1st', 1],
                                '2019-213-34' => ['Dela Curz', 'Juan', 'A', 'BSIT', 'College Laboratory', '2nd', 1],
                                '2019-213-35' => ['Dela Curz', 'Juan', 'A', 'BSIT', 'Accounting', '4th', 1],
                                '2019-213-36' => ['Dela Curz', 'Juan', 'A', 'BSCS', 'Internal Audit', '1st', 2],
                                '2019-213-37' => ['Dela Curz', 'Juan', 'A', 'BSIT', 'Library', '5th', 2],
                                '2019-213-38' => ['Dela Curz', 'Juan', 'A', 'BSIT', 'College Laboratory', '1st', 2],
                            ];
                            function action($n) {
                                if ($n == 1) {
                                    return "<span class='btn btn-outline-success btn-sm w-100'>cleared</span>";
                                } else if ($n == 2) {
                                    return "<span class='btn btn-outline-warning btn-sm w-100'>uncleared</span>";
                                } else {
                                    return "<span class='btn btn-outline-warning btn-sm w-100'>uncleared</span>";
                                    //return "<span class='btn btn-outline-secondary btn-sm'>canceled</span>";
                                }
                            };

                            foreach ($data as $key => $clerance) {
                                echo
                                    "<tr>
                                        <td>$key</td>
                                        <td>$clerance[0]</td>
                                        <td>$clerance[1]</td>
                                        <td>$clerance[2]</td>
                                        <td>$clerance[3]</td>
                                        <td>$clerance[5]</td>
                                        <td>$clerance[4]</td>
                                        <td class='align-middle text-center'>" . action($clerance[6]) . "</td>
                                        <td class='align-middle text-center p-0'>
                                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#viewModal'>View</button>
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
