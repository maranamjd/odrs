<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Payments Information</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addPaymentModal'>

                    <span class="fa fa-plus"> Add Payment</span>
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_offices" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th with="20%">Image</th>
                              <th with="65%">Description</th>
                              <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->payments)): ?>
                            <?php foreach ($this->payments as $key => $payment): ?>
                              <tr>
                                <td><img src="<?php echo URL ?>public/img/<?php echo $payment['image'] ?>" alt="" width="55" height="24"></td>
                                <td><?php echo $payment['description']; ?></td>
                                <td class='align-middle text-center p-0'>
                                    <button type='button' class='btn btn-primary' id="editPayment">
                                    <span class="fa fa-edit"></span>
                                      <input type="hidden" id="payment_id" value="<?php echo $payment['payment_type_id']; ?>">
                                      <input type="hidden" id="payment_desc" value="<?php echo $payment['description']; ?>">
                                    </button>
                                    <button type='button' class='btn btn-danger deletePayment'>
                                    <span class="fa fa-trash-o"></span>
                                      <input type="hidden" id="payment_id" value="<?php echo $payment['payment_type_id']; ?>">
                                    </button>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </tbody>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>

        <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Payment</h5>
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
                                            <label for="bname">description: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="payment_description" placeholder="Payment Description">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="bname">Image: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="file" id="payment_image" placeholder="Select an Image">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="addPayment" data-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- add branch modal -->

        <div class="modal fade" id="modifyOfficeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Office Information</h5>
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
                                          <input type="text" class="form-control" id="Eoffice_name" placeholder="Enter Branch Name">
                                      </div>
                                  </div>
                                  <input type="hidden" id="Eoid">
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="updateOffice" data-dismiss="modal">Update Office</button>
                    </div>
                </div>
            </div>
        </div> <!-- modify branch modal -->
