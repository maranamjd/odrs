<div class="container-fluid mt-3 mb-2">
            <div class="p-2 bg-white border rounded">
                <div class="row">
                  <div class="col-md-10">
                      <h5 class="p-2 mx-1 m-0 text-uppercase text-info">Document Requests</h5>
                  </div>

                  <div class="col-md-2">
                    <select class="form-control" id="sortID">
                      <option value=" ">Show All</option>
                      <option value="Waiting for Payment">Waiting for Payment</option>
                      <option value="For Processing">For Processing</option>
                      <option value="For Releasing">For Releasing</option>
                      <option value="Claimed">Claimed</option>
                      <option value="Cancelled">Cancelled</option>
                    </select>
                  </div>
                </div>
            </div>

        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_requests" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Control Number</th>
                                <th width="5%">Fast Lane</th>
                                <th width="15%">Name</th>
                                <th width="10%">Date Filed</th>
                                <th width="10%">Due Date</th>
                                <th width="10%">Date Finished</th>
                                <th width="15%">Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>




        <div class="modal fade" id="processModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <h5>Juan Dela Cruz</h5>
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
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        Transcript of Records 3rd and 4th Year (For evaluation/reference)
                                                        <span class="badge badge-info">&#8369;300, 1 item(s)</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="button" class="btn btn-danger btn-sm w-100" >Print Document</button>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="my-1">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        Certification of Enrollment/Attendance/Units Earned
                                                        <span class="badge badge-info">&#8369;300, 2 item(s)</span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="button" class="btn btn-danger btn-sm w-100" >Print Document</button>
                                                    </div>
                                                </div>
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Mark as Claimed</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div> <!-- modal content -->

            </div>
        </div> <!-- view request modal  -->

        <div class="modal fade" id="viewPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
           <div class="modal-dialog modal-md modal-dialog-centered" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                     <h5 class="modal-title" id="payTitle"></h5>
                     <input type="hidden" id="control">
                   </div>
                   <div class="modal-body py-4">
                     <div class="row py-1">
                         <div class="col-4">
                             <h6>Payment Type:  </h6>
                         </div>
                         <div class="col-8">
                            <select class="selectpicker" id="payType" title="Select Payment Type">
                              <?php if (isset($this->payment)): ?>
                                <?php foreach ($this->payment as $payment): ?>
                                  <option value="<?php echo $payment['payment_type_id'] ?>"><?php echo $payment['description'] ?></option>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                         </div>
                     </div>
                     <div class="row py-1">
                         <div class="col-4">
                             <h6>Payment Date:  </h6>
                         </div>
                         <div class="col-8">
                             <input type="date" name="payDate" id="payDate" class="form-control">
                         </div>
                     </div>
                     <div class="row py-1">
                       <div class="col-4">
                         <h6>Official Receipt Number: </h6>

                       </div>
                       <div class="col-8">
                        <input type="text" id="recieptNum" class="form-control" value="">

                       </div>
                     </div>

                   </div>

               <div class="modal-footer">
                   <button id='' class='btn btn-success submitReciept' data-dismiss="modal">Submit</button>
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               </div>
           </div>
         </div>
       </div> <!-- viewVerificationModal -->

       <div class="modal fade" id="updatesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
           <div class="modal-dialog modal-md modal-dialog-centered" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title">Updates</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <form class="update_form">
                     <div class="modal-body px-4">
                       <div class="row">
                         <div class="col-12">
                           <h5>Control Number: <p id="controlNumber" class="m-0"></p></h5>
                           <p id="name" class="m-0"></p>
                           <p id="email" class="m-0"></p>
                         </div>
                       </div>
                       <br>
                       <div class="row my-1">
                         <div class="col-12">
                           <h5 style="color: maroon;">Update</h5>
                         </div>
                         <br>
                         <div class="col-12">
                           <select class="selectpicker" id="updateType" required>
                             <option value="" selected disabled>Select update type</option>
                             <option value="1">Ready for Claiming</option>
                             <option value="2">Delayed Release</option>
                             <option value="3">Forfeited</option>
                           </select>
                         </div>

                       </div>
                       <div class="col-12">
                         <div class="form-group">
                           <label for="message-text" class="col-form-label"><h6 class="m-0" style="color: maroon;">Note:</h6></label>
                           <textarea class="form-control" rows="3" id="note" required></textarea>
                         </div>
                       </div>
                     </div>
                     <div class="modal-footer">
                       <button type="submit" class="btn btn-danger">Send Email</button>
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                   </form>
               </div>
           </div>
       </div> <!-- verifyVerificationModal -->
       <div class="modal fade" id="loadModal" tabindex="-1">
           <div class="modal-dialog modal-sm modal-dialog-centered">
               <div class="modal-content" style="background: rgba(0,0,0,0); text-align: center; border: none; color: #ccc">
                   <img src="<?php echo URL ?>public/img/loading.gif" alt="load">
                   <h5>Please wait..</h5>
               </div>
           </div>
       </div>
