<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Survey Questions</h5>

            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_questions" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th with="20%">Question ID</th>
                              <th with="70%">Description</th>
                              <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->questions)): ?>
                            <?php foreach ($this->questions as $key => $question): ?>
                              <tr>
                                <td><?php echo $question['questionID']; ?></td>
                                <td><?php echo $question['question']; ?></td>
                                <td class='align-middle text-center p-0'>

                                  <button type='button' class='btn btn-success recoverQuestion'>
                                    <span class="fa fa-repeat"></span>
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
