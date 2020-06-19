<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <div class="p-2 bg-white border rounded">
          <h6 class="p-2 mx-1 m-0 text-info">Control Number:</h6>
              <h5 id="allControl" class="p-2 mx-1 m-0"><?php echo $this->data['details']['verControllerID']; ?></h5>
          <h6 class="p-2 mx-1 m-0 text-info">Company:</h6>
              <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['company']; ?></h5>
          <h6 class="p-2 mx-1 m-0 text-info">Address:</h6>
              <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['address1']; ?></h5>
              <h5 class="p-2 mx-1 m-0"></h5>
              <h5 class="p-2 mx-1 m-0"></h5>

      </div>
    </div>

    <div class="col-md-6">
      <div class="p-2 bg-white border rounded">
        <h6 class="p-2 mx-1 m-0 text-info">Date Filed:</h6>
        <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['dateFiled']; ?></h5>
          <h6 class="p-2 mx-1 m-0 text-info">Representative:</h6>
              <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['representative']; ?></h5>
          <h6 class="p-2 mx-1 m-0 text-info">Email:</h6>
              <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['email']; ?></h5>
          <h6 class="p-2 mx-1 m-0 text-info">Status:</h6>
          <div class="col-md-8 offset-2">
            <h5 class="p-2 mx-1 m-0"><?php echo $this->data['details']['status']; ?></h5>
          </div>


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
                                <th width="30%">File Name</th>
                                <th width="30%">Documment Type</th>
                                <th width="20%">Result</th>
                                <th class="action" width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($this->data['verifications'] as $key => $value): ?>
                            <tr>
                              <td><?php echo $value['fileName']; ?></td>
                              <td><?php echo $value['docType']; ?></td>
                              <td><?php echo $value['result']; ?></td>
                              <td><?php echo $value['action']; ?></td>

                            </tr>
                          <?php endforeach; ?>

                        </tbody>
                    </table>

                </div> <!-- box -->
            </div> <!-- container -->

        </div>

        <div class="modal fade" id="viewVerifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
           <div class="modal-dialog modal-md modal-dialog-centered" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                     <h5 class="modal-title" id="approvalTitle">Verify</h5>
                   </div>
                   <div class="modal-body px-4">
                     <div class="row ">
                         <div class="col-12">
                            <input type="hidden" id="doctypeID">

                         </div>
                         <div class="col-12">
                           <input type="hidden" id="control">
                           <h6>File Name:  </h6> <p id='fileName' class="m-0"></p>
                           <h6>Document Type:  </h6> <p id='doctype' class="m-0"></p>

                             <h6>Result:  </h6>

                           <div class="col-6">
                             <select class="form-control" id="statusResult">
                               <option value="">None</option>
                               <option value="1">Valid</option>
                               <option value="2">Invalid</option>
                             </select>
                           </div>



                         </div>
                     </div>
                   </div>

               <div class="modal-footer">
                 <button class='btn btn-info  mr-auto viewFile'>View File</button>
                   <button id='' class='btn btn-success verifySub '>Submit</button>
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
               </div>
           </div>
           </div>
       </div> <!-- viewVerificationModal -->
