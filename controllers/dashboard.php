<?php
  /**
   *
   */
  class Dashboard extends Controller
  {

    function __construct()
    {
      parent::__construct();
    }

    function index(){
      $this->view->page = 'dashboard';
      $this->view->js = array('dashboard/js/default.js');
      $this->view->css = array('dashboard/css/default.css');
      $this->view->render('dashboard/index');
    }

    function tor(){
      $this->model->tor();
    }
    function diploma(){
      $this->model->diploma();
    }

  }
