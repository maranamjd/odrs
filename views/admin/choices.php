<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Choices</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addChoiceModal'>
                    <span class="fa fa-plus">New Choice</span>
                </button>
            </div>
            <?php if (isset($this->question)): ?>
              <div class="p-2 bg-white border rounded">
                <h6 class="p-2 mx-1 m-0 text-info">Question ID:</h6>
                <h5 class="p-2 mx-1 m-0"><?php echo $this->question['questionID']; ?></h5>
                <h6 class="p-2 mx-1 m-0 text-info">Question:</h6>
                <h5 class="p-2 mx-1 m-0"><?php echo $this->question['question']; ?></h5>
                <input type="hidden" id="question_id" value="<?php echo $this->question['questionID']; ?>">
              </div>
            <?php endif; ?>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_choices" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th width="10%">Choice ID</th>
                                <th width="65%">Description</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->choices)): ?>
                            <?php foreach ($this->choices as $key => $choice): ?>
                              <tr>
                                <td><?php echo $choice['choiceID']; ?></td>
                                <td><?php echo $choice['description']; ?></td>
                                <td class='align-middle text-center p-0'>
                                    <button type='button' class='btn btn-primary' id="editChoice">
                                      <span class="fa fa-edit"></span>
                                      <input type="hidden" id="cid" value="<?php echo $choice['choiceID']; ?>">
                                      <input type="hidden" id="cdesc" value="<?php echo $choice['description']; ?>">
                                    </button>
                                    <button type='button' class='btn btn-danger deleteChoice'>
                                      <span class="fa fa-trash-o"></span>
                                      <input type="hidden" id="cid" value="<?php echo $choice['choiceID']; ?>">
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

        <div class="modal fade" id="addChoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Choice</h5>
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
                                          <label for="bname">Choice: <span class="text-danger">*</span></label>
                                      </div>
                                      <div class="col">
                                          <input type="text" class="form-control" id="choice_desc"></input>
                                      </div>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="addChoice">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- add branch modal -->

        <div class="modal fade" id="modifyChoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Choice Information</h5>
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
                                        <label for="bname">Choice: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="Echoice_desc"></input>
                                    </div>
                                </div>
                                <input type="hidden" id="Echoice_id">
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="updateChoice">Update Choice</button>
                    </div>
                </div>
            </div>
        </div> <!-- modify branch modal -->
