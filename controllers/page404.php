<?php

  /**
   *
   */
  class Excptn extends Controller
  {

    function __construct()
    {
      parent::__construct();
    }

    function index(){
      $this->view->page = 'Page not found!';
      $this->view->css = array('page404/css/default.css');
      $this->view->render('page404/index', 1, 0);
    }
  }
