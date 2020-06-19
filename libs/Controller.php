<?php

  /**
   *
   */
  class Controller
  {

    function __construct()
    {
      // echo 'main controller<br>';
      $this->view = new View();
      $this->fn = new Functions();
    }

    public function loadModel($name){
      $path = 'models/'.$name.'_model.php';
      if (file_exists($path)) {
        require 'models/'.$name.'_model.php';
        $modelName = $name . '_Model';
        $this->model = new $modelName;
      }
    }
  }