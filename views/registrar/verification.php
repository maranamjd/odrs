<div class="container-fluid mt-3 mb-2">
            <div class="p-2 bg-white border rounded">
              <div class="row">
                <div class="col-md-10">
                  <h5 class="p-2 mx-1 m-0 text-uppercase text-info">Graduate Verification</h5>
                </div>

                <div class="col-md-2">
                  <select class="form-control" id="sortID">
                    <option value=" ">Show All</option>
                    <option value="Waiting for Payment">Waiting for Payment</option>
                    <option value="For Approval">For Approval</option>
                    <option value="For Verification">For Verification</option>
                    <option value="Verified">Verified</option>

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
                                <th width="15%">Controller ID</th>
                                <th width="28%">Company</th>
                                <th width="16%">Representative</th>
                                <th width="11%">Date Filed</th>
                                <th width="11%">Date Finished</th>
                                <th width="15%">Status</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->verifications)): ?>
                            <?php foreach ($this->verifications as $key => $verif): ?>
                              <tr rel="<?php echo $verif['linkRel']; ?>" style="cursor: pointer;" title="double click to view details">
                                <td><?php echo $verif['verControllerID']; ?></td>
                                <td><?php echo $verif['companyName']; ?></td>
                                <td><?php echo $verif['representative']; ?></td>
                                <td><?php echo $verif['created_on']; ?></td>
                                <td id="<?php echo $verif['verControllerID'] ?>_dateFinished"><?php echo $verif['dateFinished']; ?></td>
                                <td id="<?php echo $verif['verControllerID'] ?>_status"><?php echo $verif['status'];?></td>
                                <td id="<?php echo $verif['verControllerID'] ?>_action" class='align-middle text-center p-0'>
                                    <?php echo $verif['action'];?>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>

                        </tbody>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>



        <div class="modal fade" id="verifyVerificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verifyTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body px-4">
                        <div class="row">
                            <div class="col-12">

                                <h5>Representative:</h5>
                                <p id="repName" class="m-0"></p>
                                <p id="repEmail" class="m-0"></p>
                                <input type="hidden" id="control">
                            </div>
                        </div>
                          <br>

                        <div class="row my-1">
                            <div class="col-12">
                                <h5 style="color: maroon;">Verification Result(s): </h5>

                            </div>
                            <br>

                            <div class="col-12">
                                <ul id="verifyList" class="list-unstyled">

                                </ul>
                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"><h6 class="m-0" style="color: maroon;">Registrar Note: (optional)</h6></label>
                                <textarea class="form-control" rows="3" id="regiNote"></textarea>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger sendBtn"> Submit and Send Email</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
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

        <div class="modal fade" id="declineRecieptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verifyTitle">Decline Receipt</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body px-4">
                        <div class="row">
                            <div class="col-12">

                                <h5>Representative:</h5>
                                <p id="repNameDecline" class="m-0"></p>
                                <p id="repEmailDecline" class="m-0"></p>
                                <input type="hidden" id="controlDecline">
                            </div>
                        </div>
                          <br>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"><h6 class="m-0" style="color: maroon;">Reason:</h6></label>
                                <textarea class="form-control" rows="3" id="declineReason"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger declineBtn"> Submit and Send Email</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="viewApprovalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                      <h5 class="modal-title" id="approvalTitle"></h5>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>


                     <input type="hidden" id="control">
                   </div>
                   <div class="modal-body">

                     <div class="row ">
                         <div class="col-12">
                             <h6>Date Submitted:  </h6> <p id='payDate' class="m-0"></p>

                         </div>
                         <div class="col-12">
                           <h6>Reciept Number:  </h6> <p id='payOR' class="m-0"></p>
                           <h6>Currency:  </h6> <p id='payCurrency' class="m-0"></p>
                         </div>
                     </div>
                     <div class="row pt-3 px-3">
                      <iframe  src="" width="100%" height="400px" id="showFile"></iframe>

                     </div>
                   </div>

               <div class="modal-footer">

                   <button id='' class='btn btn-success acceptReciept '>Accept</button>
                   <button id='' class='btn btn-danger declineReciept ' data-dismiss="modal">Decline</button>
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               </div>
           </div>
       </div> <!-- viewVerificationModal -->
