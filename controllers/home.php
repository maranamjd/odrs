<?php
  /**
   *
   */
  class Home extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $logged = Session::get('logged');
      $utype  = Session::get('usertype');
      if ($logged) {
        switch ($utype) {
          case 1:
          header('Location: '.URL.'admin/dashboard');
          break;
          case 2:
          header('Location: '.URL.'registrar/dashboard');
          break;
          case 4:
          header('Location: '.URL.'office/dashboard');
          break;
        }
      }
    }

    function index(){
      $this->view->title = 'ODRS | Home';
      $this->view->js = array('home/js/default.js');
      $this->view->css = array('home/css/default.css');
      $this->view->render('home/index',1);
    }
  }
