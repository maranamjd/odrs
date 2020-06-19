<section class="bg-light">
    <div class="container px-4 py-3 px-sm-2 px-md-3 py-lg-5">
        <div class="row justify-content-center align-items-center my-lg-4">

            <div class="col-lg-8 my-3 my-lg-4">
                <div class="bg-white p-4 p-lg-5 shadow-sm rounded-lg">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <!-- <h4 class="my-2" style="color: maroon;">Your request is almost complete.</h4> -->
                            <h4 class="my-2" style="color: maroon;">Your request is completed! 	&#10004;</h4>
                            <h6 class="text-muted my-2">ID: <?php echo $this->studentNum ?></h6>
                        </div>
                        <div class="col-12">
                          <p><span class="font-weight-bold">Payment Options</span><span class="font-weight-bold pull-right">Voucher</span></p>
                        </div>
                        <div class="col-12">
                          <ul class="list-group">
                            <?php if (isset($this->payment)): ?>
                              <?php foreach ($this->payment as $payment): ?>
                                <li class="list-group-item"><img src="<?php echo URL ?>public/img/<?php echo $payment['image'] ?>" alt="" width="55" height="24"> <?php echo $payment['description'] ?><a href="download/<?php echo $payment['payment_type_id'] ?>_<?php echo $this->controlNumber ?>" target="_blank" class="pull-right">Download</a></li>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <a href="<?php echo URL ?>student/select/<?php echo Session::get('studentNumber') ?>" class="btn btn-danger mt-4 w-100">Return Home</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
