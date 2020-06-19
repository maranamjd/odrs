<div class="container-fluid ">
  <div class="row">
    <div class="col-md-6">
      <div class="p-2 bg-white border rounded">
                <h6 class="p-2 mx-1 m-0 text-info">Control Number:</h6>
                <div class="row">
                  <div class="col-md-4">
                    <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['controlNumber']; ?> </h5>
                     </div>
                     <div class="col-md-2">
                       <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['fastlane']; ?> </h5>
                        </div>
                </div>
                <h6 class="p-2 mx-1 m-0 text-info">Student Name:</h6>
                    <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['name']; ?></h5>
                <h6 class="p-2 mx-1 m-0 text-info">Course:</h6>
                    <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['course']; ?></h5>
                <h6 class="p-2 mx-1 m-0 text-info"></h6>
                    <h6 class="p-2 mx-1 m-0 text-info">Diploma Number:</h6>
                    <div class="col-md-5">
                      <input type="text" name="dipNum" id="dipNum" value="<?php echo $this->data['details']['diplomaNumber']; ?>" class="form-control">
                    </div>


            </div>
        </div>

        <div class="col-md-6">
          <div class="p-2 bg-white border rounded">
            <h6 class="p-2 mx-1 m-0 text-info">Request Date:</h6>
                <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['dateFiled']; ?></h5>
                    <h6 class="p-2 mx-1 m-0 text-info">Expected release Date:</h6>
                        <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['exRelease']; ?></h5>
                    <h6 class="p-2 mx-1 m-0 text-info">Date Finished</h6>
                        <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['dateFinished']; ?></h5>
                    <h6 class="p-2 mx-1 m-0 text-info">Status:</h6>
                    <div class="col-md-8 offset-2">
                      <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['status']; ?></h5>
                    </div>
                </div>
            </div>
    </div>
<br>
        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded">

                <div class="table-responsive">
                    <table id="tbl_requests" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="45%">Document</th>
                                <th width="5%">Quantity</th>
                                <th width="20%">Status</th>
                                <th width="15%">Date Printed</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($this->data['documents'] as $key => $value): ?>
                            <tr>
                              <td><?php echo $value['description']; ?></td>
                              <td><?php echo $value['quantity']; ?></td>
                              <td><?php echo $value['status']; ?></td>
                              <td><?php echo $value['datePrinted']; ?></td>
                              <td><?php echo $value['action']; ?></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>
