<div class="container mt-3 mb-2">
            <div class="d-flex align-items-center p-2 px-3 bg-white border rounded">
                <h5 class="p-2 mr-auto m-0 text-uppercase text-info">BRANCH: <?php if (isset($this->officeHead['title'])): ?>
                  <?php echo $this->officeHead['title']; ?> </h5>
                <?php endif; ?>
            </div>
        </div>

        <div class="container mb-4">
            <div class="p-4 bg-white border rounded" style="min-height:500px;">
                <div class="col-md-10 offset-1">
                  <form id="addCLR" action="" method="post">
                    <div class="form-group">
                      <label> Student Number: </label>
                      <input type="text" name="studno" id="studno" class="form-control mb-1" value="" autocomplete="off">
                      <div id="studentList" class="ml-1"></div>
                      <br><label> Name: </label>
                      <input type="text" class="form-control readonly" value="" id="stdName" autocomplete="off" required><br>
                      <input type="hidden" id="hiddenID" value="">
                      <label>Course: </label>
                      <input type="text" class="form-control readonly" value="" id="stdCourse" autocomplete="off" required><br>
                      <label>Office: </label>
                      <select class="form-control" id="sortOffices" required>
                        <option value="" selected disabled>--SELECT OFFICE--</option>
                         <?php if (isset($this->officeHead['list'])): ?>
                          <?php foreach ($this->officeHead['list'] as $offices): ?>
                            <option value="<?php echo $offices['officeID']; ?>"><?php echo $offices['name']; ?></option>
                          <?php endforeach; ?>

                      <?php endif; ?>
                    </select>
                      <br>
                      <label> Description: </label>
                      <textarea name="desc" rows="5" class="form-control"  id="desc" cols="80" required></textarea>
                      <hr>
                      <input type="submit" id="sub" class="btn btn-primary" value="Submit">
                      <button type="button" class="btn btn-secondary clr" name="button">Clear</button>
                    </div>
                    </form>
                </div>
            </div> <!-- box -->
        </div> <!-- container -->
        <!-- view modal -->

    </div>
</div>
