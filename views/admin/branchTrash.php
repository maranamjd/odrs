<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Branch Information</h5>

            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_requests" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>Branch</th>
                              <th>Director</th>
                              <th>Branch Code</th>
                              <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->branches)): ?>
                            <?php foreach ($this->branches as $key => $branch): ?>
                              <tr>
                                <td width="25%"><?php echo $branch['branchName']; ?></td>
                                <td width="40%"><?php echo $branch['directorFullName']; ?></td>
                                <td width="25%"><?php echo $branch['acronym']; ?></td>
                                <td width="10%" class='align-middle text-center p-0'>

                                    <button type='button' class='btn btn-success recoverBranch'>
                                      <span class="fa fa-repeat"></span>
                                      <input type="hidden" id="bid" value="<?php echo $branch['branchID']; ?>">
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
