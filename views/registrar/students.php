<div class="container-fluid mt-3 mb-2">
            <div class="p-2 bg-white border rounded">
              <div class="row">
                <div class="col-md-10">
                  <h5 class="p-2 mx-1 m-0 text-uppercase text-info">Students Record</h5>
                </div>

                <div class="col-md-2">
                  <a href="/registrar/addRecord" class="btn btn-primary"><i class="fa fa-plus"></i> Add Student</a>
                </div>
              </div>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_students" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="15%">Student Number</th>
                                <th width="25%">Name</th>
                                <th width="20%">Course</th>
                                <th width="15%">Branch</th>
                                <th width="15%">Status</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($this->students)): ?>
                            <?php foreach ($this->students as $key => $verif): ?>
                              <tr rel="<?php echo $verif['linkRel']; ?>" style="cursor: pointer;" title="double click to view details">
                                <td><?php echo $verif['studentNumber']; ?></td>
                                <td><?php echo $verif['fullName']; ?></td>
                                <td><?php echo $verif['course']; ?></td>
                                <td><?php echo $verif['branch']; ?></td>
                                <td><?php echo $verif['status']; ?></td>

                              </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>
