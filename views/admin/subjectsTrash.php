<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Subjects Bin</h5>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_subjects" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Subject Code</th>
                                <th width="55%">Title</th>
                                <th width="5%">Credits</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->subjects)): ?>
                            <?php foreach ($this->subjects as $key => $subject): ?>
                              <tr>
                                <td><?php echo $subject['subjectCode']; ?></td>
                                <td><?php echo $subject['title']; ?></td>
                                <td><?php echo $subject['credits']; ?></td>
                                <td>
                                  <button type='button' class='btn btn-success recoverSubject'>
                                    <span class="fa fa-repeat"></span>
                                    <input type="hidden" id="recID" value="<?php echo $subject['subjectCode']; ?>">
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
