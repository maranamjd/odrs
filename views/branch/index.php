<section class="bg-light">
  <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
    <div class="row justify-content-center align-items-center my-lg-4 mb-lg-5">
      <div class="col-5 my-3 my-lg-4">
        <div class="bg-white p-4 shadow-sm rounded-lg">
          <form>
            <fieldset>
            <legend>
            <h5 class="my-2" style="color: maroon;">Authentication</h5>
            </legend>
              <div class="form-row">
                <div class="form-group col-12 my-1">
                  <label for="user" class="mb-1"><small>Branch</small></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="user">
                        B
                      </span>
                    </div>
                    <select name="stBranch" class="form-control selectpicker" title="Select a Branch" data-live-search="true" id="stBranch">
                      <optgroup label="Metro Manila">
                        <option>Sta. Mesa</option>
                        <option>Taguig</option>
                      </optgroup>
                      <optgroup label="Central Luzon">
                        <option>Bataan</option>
                      </optgroup>
                      <optgroup label="South Luzon">
                        <option>Lopez, Quezon</option>
                        <option>Mulanay, Quezon</option>
                        <option>Unisan, Quezon</option>
                        <option>Ragay, Camarines Sur</option>
                        <option>Sto. Tomas, Batangas</option>
                        <option>Maragondon, Cavite</option>
                      </optgroup>
                    </select>
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
                    <input class="form-control" type="password" placeholder="Enter Password" required="required">
                  </div>
                </div>
                <div class="form-group col-12 col-lg-4 my-1">
                  <a href="branch/dashboard" class="btn btn-danger mt-3 w-100">Login</a>
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
