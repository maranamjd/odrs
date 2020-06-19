<section class="bg-light">
  <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-4">
    <h2>Complete your transaction</h2>
    <p class="font-weight-light my-1">Use the form below to complete your transaction.</p>
  </div>
</section>

<div class="container my-4 px-sm-4 my-md-5 my-lg-4 px-lg-3 py-lg-4">
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group row">
        <div class="col-12 my-4">
          <p><span class="font-weight-bold">Request Info</span></p>
          <p>Company Name: <?php echo $this->transactionInfo['company']['companyName']; ?></p>
          <p>Representative Name: <?php echo Functions::name_format($this->transactionInfo['rep']['firstName'], $this->transactionInfo['rep']['lastName'], $this->transactionInfo['rep']['middleName'], true, $this->transactionInfo['rep']['suffix']); ?></p>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12 my-4">
          <p><span class="font-weight-bold">Requested Documents</span></p>
          <ul class="list-group">
            <?php foreach ($this->transactionInfo['docs'] as $doc): ?>
              <li class="list-group-item"><?php echo $doc ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="row">
        <div class="form-group row">
          <div class="col-md-4">
            <label for="stBranch">Copy of Receipt:<span class="text-danger">*</span></label>
          </div>
          <div class="col-md-8">
            <div class="">
              <input type="file" class="" id="receipt_file">
            </div>
            <small class="text-muted">Scanned Receipt in PDF format.</small>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 offset-md-4">
            <button type="submit" class="btn btn-danger w-100" id="cancel">Cancel</button>
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-danger w-100" id="submit">Submit</button>
          </div>
          <div class="col my-3">
            <p><span class="font-weight-bold">Note:</span> You will receive an email notification on the email you provided when you requested the verification.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
