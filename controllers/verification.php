<?php
  /**
   *
   */
  class Verification extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->uType = 1;
    }
    function index(){
      if (Session::get('repLogged') !== null) {
        header('Location: '.URL.'verification/request/'.Session::get('repLogged'));
        exit;
      }
      $this->view->uType = $this->uType;
      $this->view->title = 'Verification | Home';
      $this->view->js = array('verification/js/default.js');
      $this->view->css = array('verification/css/default.css');
      $this->view->render('verification/index');
    }
    function request($id){
      if (Session::get('repLogged') !== null) {
        if ($id == Session::get('repLogged')) {
          $this->view->branches = $this->model->getBranches();
          $this->view->companyDetails = $this->model->getCompanyDetails($id);
          $this->view->uType = $this->uType;
          $this->view->nav   = 'repLogged';
          $this->view->title = 'Verification | Request';
          $this->view->js = array(
            '../public/js/city.js',
            'verification/js/request.js',
            'verification/js/geodatasource-cr.min.js',
            'verification/js/Gettext.js'
          );
          $this->view->css = array(
            'verification/css/request.css',
            'verification/css/geodatasource-countryflag.css'
          );
          $this->view->render('verification/request');
        }else {
          header('Location: '.URL.'verification/request/'.Session::get('repLogged'));
        }
      }else {
        if ($id == 'account=false') {
          $this->view->branches = $this->model->getBranches();
          $this->view->uType = $this->uType;
          $this->view->title = 'Verification | Request';
          $this->view->js = array(
            '../public/js/city.js',
            'verification/js/request.js',
            'verification/js/geodatasource-cr.min.js',
            'verification/js/Gettext.js'
          );
          $this->view->css = array(
            'verification/css/request.css',
            'verification/css/geodatasource-countryflag.css'
          );
          $this->view->render('verification/request');
        }else {
          Session::destroy();
          header('Location: '.URL.'verification');
        }
      }
    }
    function checkEmail(){
      echo $this->model->checkEmail();
    }
    function login(){
      echo $this->model->login();
    }
    function logout(){
      $this->model->logout();
    }

    function cancelProceed(){
      echo $this->model->cancelProceed();
    }
    function transaction($id){
      if (Session::get('verficationTransaction') !== null) {
        if (Session::get('verficationTransaction') === $id) {
          $this->view->uType = $this->uType;
          $this->view->transactionInfo = $this->model->getTransactionInfo($id);
          $this->view->title = 'Company | Transaction';
          $this->view->js = array('verification/js/transaction.js');
          $this->view->css = array('verification/css/transaction.css');
          $this->view->render('verification/transaction');
        }else {
          header('Location: '.URL.'verification/transaction/'.Session::get('verficationTransaction'));
        }
      }else {
        Session::destroy();
        header('Location: '.URL.'verification');
      }
    }
    function voucher($id){
      $this->model->voucher($id);
      // $this->view->uType = $this->uType;
      // $this->view->title = 'Company | Voucher';
      // $this->view->js = array('company/js/voucher.js');
      // $this->view->css = array('company/css/voucher.css');
      // $this->view->render('company/voucher');
    }

    function submitVerification(){
      echo $this->model->submitVerification();
    }

    function submitProceed(){
      echo $this->model->submitProceed();
    }

    function submitReceipt(){
      echo $this->model->submitReceipt();
    }

    function createAccount(){
      echo $this->model->createAccount();
    }
  }
