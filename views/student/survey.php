<!-- <?php echo json_encode($this->surveyInfo); ?> -->
<div class="container">
  <br>
  <form method="post" action="#" id="survey_form">
    <div class="row">
      <div class="col offset-md-1">
        <h4>Please answer the following questions</h4>
        <h6 class="text-muted font-weight-light mb-5">Complete the survey to proceed to your request</h6>
      </div>
      <?php if (isset($this->surveyInfo)): ?>
        <?php foreach ($this->surveyInfo as $key => $question): ?>
          <div class="form-group col-md-8 offset-md-2 mb-4">
            <label class="col-form-label"><h6><strong><?php echo ++$key ?>.</strong> <?php echo $question['question'] ?></h6></label>
            <select class="form-control choices" pattern="a-zA-Z0-9{1}" required rel="<?php echo $question['questionID'] ?>">
              <option value="" selected disabled>Select from choices</option>
              <?php foreach ($question['choices'] as $choice): ?>
                <option value="<?php echo $choice['choiceID'] ?>"><?php echo $choice['description'] ?></option>
              <?php endforeach; ?>
              <?php if ($question['hasOther'] == 1): ?>
                <option value="other">Other</option>
              <?php endif; ?>
            </select>
            <div style="display: none">
              <small>If other: (Please specify)</small>
              <input type="text" name="other" class="form-control" id="other_<?php echo $question['questionID'] ?>" required disabled>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <h3>No Questions available..</h3>
      <?php endif; ?>
      <!-- <div class="form-group col-lg-8 col-md-8">
        <label for="message-text" class="col-form-label">Please leave us a message to improve our survey: (optional)</label>
        <textarea class="form-control" id="message-text"></textarea>
      </div> -->
      <div class="form-group col-md-2 offset-md-10">
        <input type="submit" name="submit" value="Submit Answers" class="btn btn-danger">
      </div>
    </div>
  </form>
</div>
