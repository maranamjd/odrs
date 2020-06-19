<section class="bg-light">
            <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-3">
                <div class="row justify-content-center my-lg-4">

                    <div class="col-lg-10 my-3 my-lg-4">
                        <div class="bg-white p-4 p-lg-5 shadow-sm rounded-lg">

                            <?php
                            $returnee = true;
                            if ($returnee) {
                                echo "<h4 class='my-2' style='color: maroon;'>Your documents is ongoing.</h4>";
                            } else {
                                echo "<h4 class='my-2' style='color: maroon;'>Your request is almost complete.</h4>";
                            }
                            ?>
                            <h6 class="text-muted my-2">ID: 2019-00536-MN-1</h6>

                            <div class="row mt-3">
                                <div class="col-12 mt-3">
                                    <h6 style="color: maroon;">The list(s) of the requested documents.</h6>
                                </div>
                                <div class="col-12">
                                    <ul>
                                        <li>
                                            Transcript of Records 3rd and 4th Year (For evaluation/reference)
                                            <span class="badge badge-danger">&#8369;300, 1 item(s)</span>
                                        </li>
                                        <li>
                                            Certification of Enrollment/Attendance/Units Earned
                                            <span class="badge badge-danger">&#8369;300, 2 item(s)</span>
                                        </li>
                                    </ul>

                                    <?php
                                    // add status
                                    $status = $returnee ? "<span class='badge badge-warning'>Pending for payment</span>" : '';
                                    echo "<p class='mt-3'><span class='font-weight-bold'>Total:</span> &#8369;1800 <span class='badge badge-warning'>Fast Lane</span> $status</p>";

                                    // add print voucher if true
                                    if ($returnee) {
                                        echo "<p class='mt-4'>Please print your payment voucher. <a href='payment voucher.pdf' target='_blank' data-toggle='modal' data-target='#printVoucherModal'>Click here</a>.</p>";
                                    }
                                    ?>

                                </div>
                            </div> <!-- row1 document lists -->

                            <div class="row">

                                <?php

                                if ($returnee) {
                                    ?>
                                    <div class="col-12 mt-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <a href="index.php" class="btn btn-danger w-100">Return Home</a>
                                            </div>
                                            <div class="col-md-auto px-md-2">
                                                <a href="index.php" data-toggle="modal" data-target="#cancelModal">I want to cancel my request.</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" value="agree" id="agree">
                                                <label class="custom-control-label" for="agree">I agree to the Office of the University Registrar's <a href="#">Terms and Conditions</a>.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2 mt-md-4">
                                        <div class="row justify-content-end">
                                            <div class="col-md-3 col-lg-2">
                                                <a href="step2.php" class="btn btn-secondary w-100">Go Back</a>
                                            </div>
                                            <div class="col-md-4 col-lg-3 pl-md-0">
                                                <a href="survey" class="btn btn-danger w-100 mt-1 mt-md-0">Complete Request</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                        </div> <!-- box -->
                    </div> <!-- col -->

                </div> <!-- row main -->
            </div> <!-- container -->
        </section>
