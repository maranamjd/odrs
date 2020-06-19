<?php
  /**
   *
   */
  class Login extends Controller
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
          header('Location: '.URL.'office/');
          break;
        }
      }
    }

    function index(){
      $this->view->uType    = 6;
      $this->view->title    = 'Employee | Login';
      $this->view->js       = array('login/js/default.js');
      $this->view->css      = array('login/css/default.css');
      $this->view->render('login/index', 1,0);
    }

    function login(){
      $result = $this->model->login();
      if ($result) {
        echo Session::get('usertype');
      }else {
        echo 0;
      }
    }

  }
