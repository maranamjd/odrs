<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Courses Bin</h5>

            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_courses" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th with="70%">Description</th>
                              <th with="20%">College</th>
                              <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->courses)): ?>
                            <?php foreach ($this->courses as $key => $courses): ?>
                              <tr>
                                <td><?php echo $courses['description']; ?></td>
                                <td><?php echo $courses['college']; ?></td>
                                <td class='align-middle text-center p-0'>

                                    <button type='button' class='btn btn-success recoverCourse'>
                                      <span class="fa fa-repeat"></span>
                                      <input type="hidden" id="cid" value="<?php echo $courses['courseID']; ?>">
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
