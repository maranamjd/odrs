<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Document Types</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addDoctypeModal'>
                    <span class="fa fa-plus"> Add Type</span>
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_doctypes" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th with="10%">Document Type ID</th>
                              <th with="70%">Description</th>
                              <th width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->doctypes)): ?>
                            <?php foreach ($this->doctypes as $key => $doctype): ?>
                              <tr>
                                <td><?php echo $doctype['classID']; ?></td>
                                <td><?php echo $doctype['description']; ?></td>
                                <td class='align-middle text-center p-0'>
                                    <button type='button' class='btn btn-primary' id="editDoctype">
                                    <span class="fa fa-edit"></span>
                                      <input type="hidden" id="doctypeid" value="<?php echo $doctype['classID']; ?>">
                                      <input type="hidden" id="doctypedesc" value="<?php echo $doctype['description']; ?>">
                                    </button>
                                    <button type='button' class='btn btn-danger deleteDoctype'>
                                    <span class="fa fa-trash-o"></span>
                                      <input type="hidden" id="doctypeid" value="<?php echo $doctype['classID']; ?>">
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

        <div class="modal fade" id="addDoctypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Document Type</h5>
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
                                            <label for="bname">Description: <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="doctype_desc" placeholder="Enter Document Type">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="addDoctype">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- add branch modal -->

        <div class="modal fade" id="modifyDoctypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Document Type Information</h5>
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
                                          <label for="bname">Description: <span class="text-danger">*</span></label>
                                      </div>
                                      <div class="col">
                                          <input type="text" class="form-control" id="Edoctype_desc" placeholder="Enter Document Type">
                                      </div>
                                  </div>
                                  <input type="hidden" id="Edoctypeid">
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="updateDoctype">Update</button>
                    </div>
                </div>
            </div>
        </div> <!-- modify branch modal -->
