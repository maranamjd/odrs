    <footer class="bg-light" >
      <div class="container text-muted font-weight-light p-4">
        <div class="row">
          <div class="col-md">
          <p class="m-0">&copy; 2019 Polytechnic University of the Philippines</p>
            <div>
              <a href="#" class="mr-3">Terms of Use</a>
              <a href="#" class="mr-3">Privacy Statement</a>
              <a href="#" class="mr-3">About us</a>
            </div>
          </div>
          <div class="col-md-4 m-auto">
            <p class="my-3 my-md-0 text-md-right">
              Contact Us at: 
              <a href="contact.link">335-1781</a>
            </p>
          </div>
        </div>
      </div>
    </footer>
    </div>
    <script src="<?php echo URL; ?>public/js/jquery3.3.1.js"></script>
    <script src="<?php echo URL; ?>public/js/sweetalert.min.js"></script>
    <script src="<?php echo URL; ?>public/js/app.js"></script>
    <?php
      if (isset($this->js)) {
        foreach ($this->js as $js) {
          echo "<script src='".URL."views/".$js."'></script>";
        }
      }
     ?>
  </body>
</html>
