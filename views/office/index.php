<div class="container-fluid mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
              <div class="col-md-4">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">BRANCH: <?php echo $this->officeHead['title']; ?></h5>

              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <select class="form-control pull-right" id="sortOffices">
                  <option value=" ">Show All</option>
                  <?php if (isset($this->officeHead['list'])): ?>
                    <?php foreach ($this->officeHead['list'] as $offices): ?>
                      <option   value="<?php echo $offices['name']; ?>"><?php echo $offices['name']; ?></option>
                    <?php endforeach; ?>

                <?php endif; ?>
                </select>
              </div>

            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="p-4 bg-white border rounded" style="min-height:500px;">

                <div class="table-responsive">
                    <table id="clearanceTbl" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                              <th width="15%">Student ID</th>
                              <th width="20%">Name</th>
                              <th width="20%">Course</th>
                              <th width="20%">Office</th>
                              <th width="15%">Status</th>
                              <th width="10%">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($this->officeRec['data'])): ?>
                        <?php foreach ($this->officeRec['data'] as $val): ?>
                          <tr>
                            <td><?php echo $val['studno'] ?></td>
                            <td><?php echo $val['name'] ?></td>
                            <td><?php echo $val['course'] ?></td>
                            <td><?php echo $val['office'] ?></td>
                            <td><?php echo $val['stats'] ?></td>
                            <td><?php echo $val['acts'] ?></td>


                          </tr>

                        <?php endforeach; ?>

                      <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div> <!-- box -->
        </div> <!-- container -->




<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
       <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="showTitle"></h5>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
           <div class="modal-body">
             <div class="row">
               <div class="col-md-9">
                 <h5 id="name"></h5>
                 <p><b>Office:</b>  <span id="officeName" > </span></p>
                 <p><b>Description:</b></p>

               </div>
               <div class="col-md-3">
                 <h5 id ="dateAdded"></h5>
               </div>
                 <textarea id="desc" rows="5" class="form-control mx-5" cols="80" readonly></textarea>

             </div>

           </div>

       <div class="modal-footer">

           <button class='btn btn-success subBtn' style="display:none;">Clear</button>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
       </div>
   </div>
</div> <!-- viewVerificationModal -->
</div>
<div class="modal fade" id="editsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
       <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="edtTitle"></h5>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
           <div class="modal-body">
             <div class="row">
               <div class="col-md-10 offset-1">
                 <h5 id="edtname"></h5>
                 <hr>
                 <label for="edtDateAdded">Date Recorded:</label>
                 <h5 id="edtDateAdded"></h5>
                 <br>
                  <label for="edtOffice">Office:</label>
                  <select class="form-control" id="edtOffice" name="edtOffice">
                    <?php if (isset($this->officeHead['list'])): ?>
                      <?php foreach ($this->officeHead['list'] as $offices): ?>
                        <option value="<?php echo $offices['officeID']; ?>"><?php echo $offices['name']; ?></option>
                      <?php endforeach; ?>

                  <?php endif; ?>
                  </select>
                  <br>
                  <label for="edtDesc">Description:</label>
                  <textarea id="edtDesc" rows="5" class="form-control" cols="80" required></textarea>


               </div>

             </div>

           </div>

       <div class="modal-footer">

           <button class='btn btn-warning uptBtn'>Update</button>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
       </div>
   </div>
</div> <!-- viewVerificationModal -->
</div>
