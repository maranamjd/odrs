<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Choices</h5>

            </div>

        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_choices" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th width="10%">Choice ID</th>
                                <th width="60%">Description</th>
                                <th width="20%">QuestionID</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->choices)): ?>
                            <?php foreach ($this->choices as $key => $choice): ?>
                              <tr>
                                <td><?php echo $choice['choiceID']; ?></td>
                                <td><?php echo $choice['description']; ?></td>
                                <td><?php echo $choice['questionID']; ?></td>
                                <td class='align-middle text-center p-0'>

                                    <button type='button' class='btn btn-success recoverChoice'>
                                      <span class="fa fa-repeat"></span>
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
