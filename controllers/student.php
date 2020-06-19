<?php
  /**
   *
   */
  class Student extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $this->uType = 0;
    }

    function updateContact(){
      echo $this->model->updateContact();
    }

    function cancelRequest(){
      echo $this->model->cancelRequest();
    }

    function checkStatus(){
      echo $this->model->checkStatus();
    }

    function reduceAttempt(){
      echo $this->model->reduceAttempt();
    }
    function blockAccount(){
      echo $this->model->blockAccount();
    }

    function getStudentNum(){
      echo $this->model->getStudentNum();
    }

    function remember(){
      $this->view->uType = $this->uType;
      $this->view->pageData = $this->model->remember();
      $this->view->title = 'Student | Remember ID';
      $this->view->js = array('student/js/remember.js');
      $this->view->css = array('student/css/remember.css');
      $this->view->render('student/remember',1);
    }

    function index(){
      if (Session::get('studentNumber') !== null) {
        header('Location: '.URL.'student/select/'.Session::get('studentNumber'));
        exit;
      }
      $this->view->uType = $this->uType;
      $this->view->title = 'Student | Login';
      $this->view->js = array('student/js/default.js');
      $this->view->css = array('student/css/default.css');
      $this->view->render('student/index',1);
    }

    function download($controlNumber){
      if (Session::get('studentNumber') !== null) {
        $this->model->download($controlNumber);
      }else {
        Session::destroy();
        header('Location: '.URL.'student');
      }
    }

    function getInfo(){
      echo $this->model->getInfo();
    }

    function home(){
      $this->model->home();
    }

    function login(){
      echo $this->model->login();
    }
    function logout(){
      $this->model->logout();
    }

    function sendRequest(){
      echo $this->model->sendRequest();
    }

    function select($id){
      $studentNum = Session::get('studentNumber');
      if (Session::get('studentNumber') !== null) {
        if ($id == $studentNum) {
          $info = $this->model->select($id);
          if ($info['hasSurvey'] < 1) {
            header('Location: '.URL.'student/surveys');
          }
          $this->view->pageInfo = $info;
          $this->view->uType = $this->uType;
          $this->view->nav   = 'student';
          $this->view->title = 'Student | Select Document';
          $this->view->js = array('student/js/documents.js');
          $this->view->css = array('student/css/documents.css');
          $this->view->render('student/documents',1);
        }else {
          header('Location: '.URL.'student/select/'.Session::get('studentNumber'));
        }
      }else {
        Session::destroy();
        header('Location: '.URL.'student');
      }
    }
    function verify(){
      $this->view->uType = $this->uType;
      $this->view->title = 'Student | Verify Request';
      $this->view->js = array('student/js/default.js');
      $this->view->css = array('student/css/default.css');
      $this->view->render('student/verify',1);
    }
    function survey(){
      if (Session::get('studentNumber') !== null) {
        $this->view->surveyInfo = $this->model->getSurveyInfo();
        $this->view->uType = $this->uType;
        $this->view->title = 'Student | Survey';
        $this->view->js = array('student/js/survey.js');
        // $this->view->css = array('student/css/survey.css');
        $this->view->render('student/survey',1);
      }else {
        Session::destroy();
        header('Location: '.URL.'student');
      }
    }
    function voucher(){
      if (Session::get('studentNumber') !== null) {
        $this->view->uType = $this->uType;
        $this->view->payment = $this->model->getPayments();
        $this->view->studentNum = Session::get('studentNumber');
        $this->view->controlNumber = Session::get('controlNumber');
        $this->view->title = 'Student | Request Voucher';
        $this->view->js = array('student/js/default.js');
        $this->view->css = array('student/css/default.css');
        $this->view->render('student/voucher',1);
      }else {
        Session::destroy();
        header('Location: '.URL.'student');
      }
    }

    function submitSurvey(){
      echo $this->model->submitSurvey();
    }

  }
