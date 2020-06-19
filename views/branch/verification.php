<div class="container-fluid mt-3 mb-2">
            <div class="p-2 bg-white border rounded">
                <h5 class="p-2 mx-1 m-0 text-uppercase text-info">Graduate Verification</h5>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_requests" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Verification ID</th>
                                <th>Representative</th>
                                <th>Company</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = [
                                '2019-213-31' => ['Dela Curz', 'Accenture Philippines', date('Y-m-d'), 1],
                                '2019-213-32' => ['Dela Curz', 'San Miguel Corporation', date('Y-m-d'), 1],
                                '2019-213-33' => ['Dela Curz', 'Nestle Philippines', date('Y-m-d'), 1],
                                '2019-213-34' => ['Dela Curz', 'BDO Unibank', date('Y-m-d'), 1],
                                '2019-213-36' => ['Dela Curz', 'Ayala Corporation', date('Y-m-d'), 2],
                                '2019-213-37' => ['Dela Curz', 'Coca-Cola FEMSA Philippines', date('Y-m-d'), 2],
                                '2019-213-38' => ['Dela Curz', 'San Miguel Corporation', date('Y-m-d'), 3],
                                '2019-213-39' => ['Dela Curz', 'Google Philippines', date('Y-m-d'), 3],
                                '2019-213-40' => ['Dela Curz', 'Coca-Cola FEMSA Philippines', date('Y-m-d'), 4],
                                '2019-213-41' => ['Dela Curz', 'Accenture Philippines', date('Y-m-d'), 4],
                                '2019-213-42' => ['Dela Curz', 'Accenture Philippines', date('Y-m-d'), 4],
                                '2019-213-43' => ['Dela Curz', 'Accenture Philippines', date('Y-m-d'), 4]
                            ];
                            function action($n) {
                                if ($n == 1) {
                                    return "<span class='btn btn-outline-success btn-sm w-100'>for verification</span>";
                                } else if ($n == 2) {
                                    return "<span class='btn btn-outline-warning btn-sm w-100'>payment pending</span>";
                                } else if ($n == 3){
                                    return "<span class='btn btn-outline-info btn-sm w-100'>verified</span>";
                                } else {
                                    return "<span class='btn btn-outline-secondary btn-sm w-100'>cancelled</span>";
                                }
                            };
                            function disabled($n) {
                                return $n == 1 || $n == 3 ? 'disabled' : '';
                            }

                            foreach ($data as $key => $request) {
                                echo
                                    "<tr>
                                        <td>$key</td>
                                        <td>$request[0]</td>
                                        <td>$request[1]</td>
                                        <td>$request[2]</td>
                                        <td class='align-middle text-center'>" . action($request[3]) . "</td>
                                        <td class='align-middle text-center p-0'>
                                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#viewModal'>View</button>
                                            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#confirmDeleteModal' " . disabled($request[3]) . ">Delete</button>
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
                        <h5 class="modal-title" id="exampleModalCenterTitle">Verification ID: 2019-213-31</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="row">
                            <div class="col-12">
                                <h5>Accenture Philippines</h5>
                                <p class="m-0">Professional services Technology services</p>
                                <p class="m-0">MSE Building, Ayala Ave, Makati, 1200 Metro Manila</p>
                                <p class="m-0">Philippines</p>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 style="color: maroon;">The list(s) of the graduate to verify.</h6>
                                    </div>
                                    <div class="col-12">
                                        <ul>
                                            <li class="my-1">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        Juan Dela Cruz
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-danger btn-sm w-100">View TOR</button>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="my-1">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        Juan Dela Cruz
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-danger btn-sm w-100">View TOR</button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div> <!-- graduate lists -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 style="color: maroon;">Proof of Payment:</h6>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger btn-sm w-100">View Receipt</button>
                                                <!-- <p class="m-0">Not Available</p> -->
                                            </div>

                                        </div>
                                    </div> <!-- Proof of Payment -->
                                </div>
                            </div> <!-- lists of grad -->
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <p class="m-0"><span class="font-weight-bold">
                                    Total:</span> &#8369;400
                                    <span class="badge badge-success">For Verification</span>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> <!-- viewVerificationModal -->
