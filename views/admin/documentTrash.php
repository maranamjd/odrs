<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">Documents Bin</h5>
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
                                <th width="30%">Requirements</th>
                                <th width="10%">Actions</th>
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
                                  <button type='button' class='btn btn-success recoverDocument'>
                                    <span class="fa fa-repeat"></span>
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
