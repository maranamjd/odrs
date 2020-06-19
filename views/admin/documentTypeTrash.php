<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Document Types</h5>
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

                                    <button type='button' class='btn btn-success recoverDoctype'>
                                      Restore
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
 <!-- modify branch modal -->
