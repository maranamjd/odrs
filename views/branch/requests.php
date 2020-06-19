<div class="container-fluid mt-3 mb-2">
            <div class="p-2 bg-white border rounded">
                <h5 class="p-2 mx-1 m-0 text-uppercase text-info">Document Requests</h5>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_requests" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Fast Lane</th>
                                <th>Lastname</th>
                                <th>Firstname</th>
                                <th>Middle</th>
                                <th>Course</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = [
                                '2019-21331' => ['Dela Curz', 'Juan', 'A', 'BSIT', 1, date('Y-m-d'), 1],
                                '2019-21332' => ['Dela Curz', 'Juan', 'A', 'BSIT', 0, date('Y-m-d'), 1],
                                '2019-21333' => ['Dela Curz', 'Juan', 'A', 'BSCS', 0, date('Y-m-d'), 1],
                                '2019-21334' => ['Dela Curz', 'Juan', 'A', 'BSIT', 0, date('Y-m-d'), 1],
                                '2019-21336' => ['Dela Curz', 'Juan', 'A', 'BSCS', 1, date('Y-m-d'), 2],
                                '2019-21337' => ['Dela Curz', 'Juan', 'A', 'BSCS', 1, date('Y-m-d'), 2],
                                '2019-21338' => ['Dela Curz', 'Juan', 'A', 'BSCS', 0, date('Y-m-d'), 2],
                                '2019-21339' => ['Dela Curz', 'Juan', 'A', 'BSIT', 1, date('Y-m-d'), 4],
                                '2019-21340' => ['Dela Curz', 'Juan', 'A', 'BSCS', 0, date('Y-m-d'), 4],
                                '2019-21341' => ['Dela Curz', 'Juan', 'A', 'BSCS', 0, date('Y-m-d'), 4],
                                '2019-21341' => ['Dela Curz', 'Juan', 'A', 'BSIT', 0, date('Y-m-d'), 3]
                            ];
                            function action($n) {
                                if ($n == 1) {
                                    return "<span class='btn btn-outline-success btn-sm w-100'>for releasing</span>";
                                } else if ($n == 2) {
                                    return "<span class='btn btn-outline-warning btn-sm w-100'>payment pending</span>";
                                } else if ($n == 3) {
                                    return "<span class='btn btn-outline-info btn-sm w-100'>claimed</span>";
                                } else {
                                    return "<span class='btn btn-outline-secondary btn-sm w-100'>cancelled</span>";
                                }
                            };
                            function disabled($n) {
                                return $n == 1 || $n == 3 ? 'disabled' : '';
                            }
                            function isFastLane($bool) {
                                return $bool == 1 ? '<span class="btn btn-outline-danger btn-sm w-100">fast lane</span>' : '';
                            }

                            foreach ($data as $key => $requests) {
                                echo
                                    "<tr>
                                        <td>$key</td>
                                        <td>" . isFastLane($requests[4]) . "</td>
                                        <td>$requests[0]</td>
                                        <td>$requests[1]</td>
                                        <td>$requests[2]</td>
                                        <td>$requests[3]</td>
                                        <td>$requests[5]</td>
                                        <td class='align-middle text-center'>" . action($requests[6]) . "</td>
                                        <td class='align-middle text-center p-0'>
                                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#viewModal'>View</button>
                                            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#confirmDeleteModal' " . disabled($requests[6]) . ">Delete</button>
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
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Request ID: 2019-213-31</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12 mb-3">
                                <h6>Name: Juan Dela Cruz</h6>
                                <p class="m-0">Date of Request: 2019-03-12</p>
                                <p class="m-0">Date of Processed: 2019-03-14</p>
                            </div>
                            <div class="col-12">

                                <div class="row">
                                    <div class="col-12">
                                        <h6 style="color: maroon;">The list(s) of the requested documents.</h6>
                                    </div>
                                    <div class="col-12">
                                        <ul>
                                            <li class="my-1">
                                                Transcript of Records 3rd and 4th Year (For evaluation/reference)
                                                <span class="badge badge-info">&#8369;300, 1 item(s)</span>
                                            </li>
                                            <li class="my-1">
                                                Certification of Enrollment/Attendance/Units Earned
                                                <span class="badge badge-info">&#8369;300, 2 item(s)</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 my-2">
                                        <p class="m-0"><span class="font-weight-bold">
                                            Total:</span> &#8369;1800
                                            <span class="badge badge-success">For releasing</span>
                                            <span class="badge badge-warning">Fast Lane</span>
                                        </p>
                                    </div>
                                </div> <!-- document lists -->
                            </div>

                        </div> <!-- row -->

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div> <!-- modal content -->

            </div>
        </div> <!-- view request modal  -->
