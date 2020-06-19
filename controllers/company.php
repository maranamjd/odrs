<?php
  /**
   *
   */
  class Company extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->uType = 1;
    }

    function info($id){
      if (Session::get('repLogged') !== null) {
        if ($id == Session::get('repLogged')) {
          $this->view->companyDetails = $this->model->getInfo($id);
          $this->view->uType = $this->uType;
          $this->view->nav   = 'repLogged';
          $this->view->title = 'Company | Info';
          $this->view->js = array(
            '../public/js/city.js',
            'company/js/default.js',
            'verification/js/geodatasource-cr.min.js',
            'verification/js/Gettext.js'
          );
          $this->view->css = array(
            'company/css/default.css',
            'verification/css/geodatasource-countryflag.css'
          );
          $this->view->render('company/index');
        }else {
          header('Location: '.URL.'company/info/'.Session::get('repLogged'));
        }
      }else {
        Session::destroy();
        header('Location: '.URL.'verification');
      }
    }

    function updateCompany(){
      echo $this->model->updateCompany();
    }
    function updateRepresentative(){
      echo $this->model->updateRepresentative();
    }
    function updatePassword(){
      echo $this->model->updatePassword();
    }
  }
