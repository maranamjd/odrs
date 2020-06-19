<section class="bg-light">
  <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
    <div class="row justify-content-center align-items-center my-lg-4 mb-lg-5">
      <div class="col-5 my-3 my-lg-4">
        <div class="bg-white p-4 shadow-sm rounded-lg">
          <form id="login">
            <fieldset>
            <legend>
            <h5 class="my-2" style="color: maroon;">Authentication</h5>
            </legend>
              <div class="form-row">
                <div class="form-group col-12 my-1">
                  <label for="user" class="mb-1"><small>Employee ID</small></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="user">
                          E
                        </span>
                      </div>
                      <input class="form-control" id="username" type="text" placeholder="Enter Employee ID" required>
                    </div>
                </div>
                <div class="form-group col-12 my-1">
                  <label for="pass" class="mb-1"><small>Password</small></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="pass">
                        P
                      </span>
                    </div>
                    <input class="form-control" id="password" type="password" placeholder="Enter Password" required>
                  </div>
                </div>
                <div class="form-group col-12 col-lg-4 my-1">
                  <button type="submit" name="submit" class="btn btn-danger mt-3 w-100">Login</button>
                </div>
              </div>
              <p class="font-weight-light mt-2"><small>Forgot password? <a href="#">click here</a>.</small></p>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
