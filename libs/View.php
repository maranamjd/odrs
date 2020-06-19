<?php

  /**
   *
   */
  class View
  {

    function __construct()
    {
      // echo 'this is the view<br>';
    }

    public function render($name, $include = false, $nav = false){
      if ($include == true && $nav == true) {
        require 'views/'. $name .'.php';
      }elseif ($include == true && $nav == false) {
        require 'views/inc/header.php';
        require 'views/'. $name .'.php';
        require 'views/inc/footer.php';
      }elseif ($include == false && $nav == true) {
        require 'views/inc/nav.php';
        require 'views/'. $name .'.php';
      }else {
        require 'views/inc/header.php';
        require 'views/inc/nav.php';
        require 'views/'. $name .'.php';
        require 'views/inc/footer.php';
      }
    }
  }
