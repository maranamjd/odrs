<div class="container-fluid mt-3 mb-2">
  <div class="p-2 bg-white border rounded">
    <div class="row">
      <div class="col-md-10">
        <h5 class="p-2 mx-1 m-0 text-uppercase text-info">Graduate Tracer</h5>
      </div>
      <div class="col-md-2">
        <button type="button" name="button" class="btn btn-danger btn-md pull-right" id="generate">Generate</button>
      </div>
    </div>
  </div>
</div>
<!-- <?php echo json_encode($this->tracer) ?> -->
<div class="container-fluid">
  <div class="row">
    <?php if (isset($this->tracer)): ?>
      <?php foreach ($this->tracer as $key => $question): ?>
        <div class="my-3 col-md-6 p-1">
          <div class="p-2 bg-white border rounded">
            <h4 class="text-info ml-4"><?php echo $question['question'] ?></h4>
            <div class="container">
              <div class="row">
                <h6 class="p-2 mx-1 m-0 text-secondary">Number of Graduates: <?php echo $question['take'] ?></h6>
                <?php foreach ($question['choices'] as $key => $choice): ?>
                  <div class="col-md-9 offset-md-1 p-2 mb-2">
                    <h5><?php echo $choice['description'] ?></h5>
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" style="width: <?php echo (($choice['take'] / $question['take']) * 100) ?>%;" aria-valuenow="<?php echo (($choice['take'] / $question['take']) * 100) ?>" aria-valuemin="0" aria-valuemax="100"><?php echo number_format((($choice['take'] / $question['take']) * 100),2) ?>%</div>
                    </div>
                  </div>
                  <div class="col-md-1 p-2 mb-2">
                    <h5 class="mt-4"><?php echo $choice['take'] ?></h5>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div> <!-- cards -->
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
