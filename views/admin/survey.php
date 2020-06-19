<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Survey Questions</h5>
                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#addQuestionModal'>
                  <span class="fa fa-plus">Add Question</span>
                </button>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_questions" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th with="10%">Question ID</th>
                              <th with="75%">Description</th>
                              <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->questions)): ?>
                            <?php foreach ($this->questions as $key => $question): ?>
                              <tr>
                                <td><?php echo $question['questionID']; ?></td>
                                <td><?php echo $question['question']; ?></td>
                                <td class='align-middle text-center p-0'>
                                  <button type='button' class='btn btn-info' id="viewQuestion" rel="<?php echo URL ?>admin/choices/<?php echo $question['questionID'] ?>"><span class="fa fa-eye"></span></button>
                                  <button type='button' class='btn btn-primary' id="editQuestion">
                                    <span class="fa fa-edit"></span>
                                    <input type="hidden" id="qid" value="<?php echo $question['questionID']; ?>">
                                    <input type="hidden" id="qdesc" value="<?php echo $question['question']; ?>">
                                    <input type="hidden" id="qother" value="<?php echo $question['hasOther']; ?>">
                                  </button>
                                  <button type='button' class='btn btn-danger deleteQuestion'>
                                  <span class="fa fa-trash-o"></span>
                                    <input type="hidden" id="qid" value="<?php echo $question['questionID']; ?>">
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

        <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add new Question</h5>
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
                                          <label for="bname">Question: <span class="text-danger">*</span></label>
                                      </div>
                                      <div class="col">
                                          <textarea class="form-control" rows="3" id="question_desc"></textarea>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="form-group form-check offset-md-3 col">
                                      <input type="checkbox" class="form-check-input" id="question_other">
                                      <label class="form-check-label" for="question_other" style="cursor: pointer">Include "Other" as choice</label>
                                    </div>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="addQuestion">Confirm</button>
                    </div>
                </div>
            </div>
        </div> <!-- add branch modal -->

        <div class="modal fade" id="modifyQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Question Information</h5>
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
                                        <label for="bname">Question: <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col">
                                        <textarea class="form-control" rows="3" id="Equestion_desc"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                  <div class="form-group form-check offset-md-3 col">
                                    <input type="checkbox" class="form-check-input" id="Equestion_other">
                                    <label class="form-check-label" for="Equestion_other" style="cursor: pointer">Include "Other" as choice</label>
                                  </div>
                                </div>
                                  <input type="hidden" id="Equestion_id">
                              </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger w-25" id="updateQuestion">Update Question</button>
                    </div>
                </div>
            </div>
        </div> <!-- modify branch modal -->
