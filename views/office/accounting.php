<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Accounting</h5>
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
                        <tbody>
                            <?php
                            $data = [
                                '2018-00213-MN-1' => ['Dela Curz', 'Juan', 'A', 'BSIT', '2nd', 3],
                                '2016-00213-MN-1' => ['Dela Curz', 'Juan', 'A', 'BSIT', '4th', 3],
                                '2019-00213-MN-1' => ['Dela Curz', 'Juan', 'A', 'BSCS', '1st', 3],
                                '2015-00213-MN-1' => ['Dela Curz', 'Juan', 'A', 'BSIT', '5th', 3],
                                '2019-00213-MN-1' => ['Dela Curz', 'Juan', 'A', 'BSIT', '1st', 3],
                            ];
                            function action($n) {
                                if ($n == 1) {
                                    return "<span class='btn btn-outline-success btn-sm w-100'>cleared</span>";
                                } else if ($n == 2) {
                                    return "<span class='btn btn-outline-danger btn-sm w-100'>not settled</span>";
                                } else {
                                    return "<span class='btn btn-outline-warning btn-sm w-100'>uncleared</span>";
                                    //return "<span class='btn btn-outline-secondary btn-sm'>canceled</span>";
                                }
                            };
                            function button($n) {
                                return $n != 1 ? "<button type='button' class='btn btn-success w-50'>Unmark</button>" : "<button type='button' class='btn btn-danger w-50'>Mark</button>";
                            }

                            foreach ($data as $key => $student) {
                                echo
                                    "<tr>
                                        <td>$key</td>
                                        <td>$student[0]</td>
                                        <td>$student[1]</td>
                                        <td>$student[2]</td>
                                        <td>$student[3]</td>
                                        <td>$student[4]</td>
                                        <td class='align-middle text-center'>" . action($student[5]) . "</td>
                                        <td class='align-middle text-center p-0'>
                                            " . button($student[5]) . "
                                            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#viewModal'>View</button>
                                            <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#editModal'>Edit</button>
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div> <!-- box -->
        </div> <!-- container -->
