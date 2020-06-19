<section class="bg-light">
  <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
    <div class="row justify-content-center align-items-center my-lg-4">
      <div class="col-lg-6 px-4 py-2">
        <h2>Request for verification of your applicant!</h2>
        <details>
          <summary class="text-primary">How to request</summary>
          <p class="my-1">Text</p>
          <p class="my-1">Text</p>
          <p class="my-1">Text</p>
          <p class="my-1">Text</p>
        </details>
      </div>
      <div class="col-lg-5 my-3 my-lg-4">
        <div class="bg-white p-4 shadow-sm rounded-lg">
          <form id="login">
            <fieldset>
              <legend>
                <h5 class="my-2" style="color: maroon;">Company Representative</h5>
              </legend>
              <div class="form-row">
                <div class="form-group col-12 my-1">
                  <label for="email" class="mb-1"><small>Email</small></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="email">
                        E
                      </span>
                    </div>
                    <input class="form-control" id="representative_email" type="text" placeholder="Enter Email Address" title="sample@sample.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" required>
                  </div>
                </div>
                <div class="form-group col-12 my-1">
                  <label for="password" class="mb-1"><small>Password</small></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="password">
                        P
                      </span>
                    </div>
                    <input class="form-control" id="representative_password" type="password" placeholder="Enter Password" required>
                  </div>
                </div>
                <div class="form-group col-12 col-lg-4 my-1">
                <button type="submit" class="btn btn-danger mt-3 w-100">Login</button>
              </div>
              </div>
            <!-- <p class="font-weight-light text-danger mt-2">Invalid student information.</p> -->
            <p class="font-weight-light my-1">
               If you do not have an account, <a href="verification/request/account=false">click here</a>.<br>
               To submit your payment, <a href="#" data-toggle='modal' data-target='#proceedModal'>click here</a>.
            </p>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="proceedModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: maroon;" id="">Enter Proceed Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="proceed">
              <div class="modal-body">
                <div class="col">
                  <label for="proceed_code">Proceed Code:<span class="text-danger">*</span></label>
                  <input type="text" name="proceed_code" class="form-control" id="proceed_code" placeholder="Enter Proceed Code" autocomplete="off" required autofocus>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Confirm</button>
              </div>
            </form>
        </div>
    </div>
</div> <!-- disable -->
