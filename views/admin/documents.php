<div class="container-fluid mt-3 mb-2">
  <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
      <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Documents</h5>
      <button type='button' class='btn btn-danger addDoc'>
          <span class="fa fa-plus"> Add Document</span>
      </button>
  </div>

        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_requests" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="45%">Description</th>
                                <th width="5%">Price</th>
                                <th width="5%">Processing Time</th>
                                <th width="5%">Type</th>
                                <th width="25%">Requirements</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->docs)): ?>
                            <?php foreach ($this->docs as $key => $doc): ?>
                              <tr>
                                <td><?php echo $doc['description']; ?></td>
                                <td><?php echo $doc['price']; ?></td>
                                <td><?php echo $doc['processingTime']; ?></td>
                                <td><?php echo $doc['documentType']; ?></td>
                                <td><?php echo $doc['requirements']; ?></td>
                                <td>
                                  <button type='button' class='btn btn-primary' id="editDocument">
                                    <span class="fa fa-edit"></span>
                                    <input type="hidden" id="docid" value="<?php echo $doc['documentID']; ?>">
                                    <input type="hidden" id="ddesc" value="<?php echo $doc['description']; ?>">
                                    <input type="hidden" id="dprice" value="<?php echo $doc['price']; ?>">
                                    <input type="hidden" id="dprocesstime" value="<?php echo $doc['processingTime']; ?>">
                                    <input type="hidden" id="dtype" value="<?php echo $doc['documentTypeID']; ?>">
                                    <input type="hidden" id="dreqs" value="<?php echo $doc['requirements']; ?>">
                                    <input type="hidden" id="dgraduate" value="<?php echo $doc['graduate']; ?>">
                                  </button>
                                  <button type='button' class='btn btn-danger deleteDocument'>
                                    <span class="fa fa-trash-o"></span>
                                    <input type="hidden" id="did" value="<?php echo $doc['documentID']; ?>">
                                  </button>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div> <!-- box -->
        </div> <!-- container -->

        <div class="modal fade" id="modifyDocumentModal" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Update document</h5>
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
                                    <div class="col-md-4">
                                      <label for="price">Price<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <input type="number" name="dates" class="form-control" id="Edocument_price">
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-md-4">
                                      <label for="processTime">Processing time<span class="text-danger">*</span> (day/s)</label>
                                    </div>
                                    <div class="col">
                                      <input type="number" name="dates" class="form-control" id="Edocument_processtime">
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-md-4">
                                      <label for="docType">Type<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <select name="employee_branch" class="form-control w-100 selectpicker border" id="Edocument_type" title='Document type'>
                                        <?php if (isset($this->doctype)): ?>
                                          <?php foreach ($this->doctype as $type): ?>
                                            <option value="<?php echo $type['classID']; ?>"><?php echo $type['description']; ?></option>
                                          <?php endforeach; ?>
                                        <?php endif; ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-md-4">
                                      <label for="docType">Document Available for:<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <select name="employee_branch" class="form-control w-100 selectpicker border" id="Edocument_graduate" title='Student Status'>
                                        <option value="0">Under Graduate</option>
                                        <option value="1">Post Graduate</option>
                                        <option value="2">Under Graduate and Post Graduate</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-12">
                                      <label for="description">Description<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <textarea class="form-control" rows="3" id="Edocument_desc"></textarea>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                      <div class="col-12">
                                          <label for="requirements">Requirements</label>
                                      </div>
                                      <div class="col">
                                          <textarea class="form-control" rows="3" id="Edocument_reqs"></textarea>
                                      </div>
                                  </div>
                                  <input type="hidden" id="Edid">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="updateDocument">Update Document</button>
                    </div>
                </div>
            </div>
        </div> <!-- add new document -->

        <div class="modal fade" id="addDocModal" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Add document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form  id="AddDocForm" action="" method="POST">
                    <div class="modal-body px-4">
                        <div class="row">
                            <div class="col-12">
                                <h5 style="color: maroon;">Please fill-up the following.</h5>


                            </div>
                            <div class="col-md-1">
                              <h5 style="color: red;">*NOTE: </h5>
                            </div>
                            <div class="col-md-6">
                              <p> The system can't generate this document.</p>

                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">

                                  <div class="form-group row">
                                    <div class="col-md-4">
                                      <label for="price">Price<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <input type="number" name="docPrice" class="form-control" min="1" step="1" required>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-md-4">
                                      <label for="processTime">Processing time<span class="text-danger">*</span> (day/s)</label>
                                    </div>
                                    <div class="col">
                                      <input type="number" name="docPT" class="form-control" min="1" max="31" step="1"required>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-md-4">
                                      <label for="docType">Type<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <select name="docType" class="form-control w-100 selectpicker border"  title='Document type' required>
                                        <?php if (isset($this->doctype)): ?>
                                          <?php foreach ($this->doctype as $type): ?>
                                            <option value="<?php echo $type['classID']; ?>"><?php echo $type['description']; ?></option>
                                          <?php endforeach; ?>
                                        <?php endif; ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-md-4">
                                      <label for="docType">Document Available for:<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <select name="docAvail" class="form-control w-100 selectpicker border"  title='Student Status' required>
                                        <option value="0">Under Graduate</option>
                                        <option value="1">Post Graduate</option>
                                        <option value="2">Under Graduate and Post Graduate</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-12">
                                      <label for="description">Description<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                      <textarea class="form-control" rows="3" name="docDesc" required></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-12">
                                          <label for="requirements">Requirements</label>
                                      </div>
                                      <div class="col">
                                          <textarea class="form-control" name="docReq" rows="3" ></textarea>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer px-4 float-right">
                        <input type="submit" name="submit" class="btn btn-danger" value="Submit">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
            </div>
        </div> <!-- add new document -->
