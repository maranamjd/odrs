<?php

  /**
   *
   */
  class Registrar extends Controller
  {

    function __construct()
    {
      parent::__construct();
      $logged = Session::get('logged');
      $utype  = Session::get('usertype');
      if ($logged == false) {
        Session::destroy();
        header('Location: '.URL.'login');
        exit;
      }else {
        switch ($utype) {
          case 1:
          header('Location: '.URL.'admin/dashboard');
            break;
          case 4:
          header('Location: '.URL.'office/dashboard');
            break;
        }
      }
      $this->uType = 2;
      $this->name = Functions::name_format(Session::get('fname'), Session::get('lname'), Session::get('mname'), true, Session::get('suffix'));
    }


    function getDashboardData(){
      if (isset($_POST['get'])) {
        echo $this->model->getDashboardData();
      }else {
        return false;
      }
    }

    function requestChanges(){
      if (isset($_POST['fetch'])) {
        $changes = array();
        switch ($_POST['fetch']) {
          case 0:
            $requests = $this->model->requestsChanges();
            foreach ($requests as $key => $request) {
              $changes[$request['controlNumber'].'_dateFinished'] = $request['dateFinished'];
              $changes[$request['controlNumber'].'_status'] = $request['status'];
              $changes[$request['controlNumber'].'_action'] = $request['action'];
            }
            break;
          case 1:
            $requests = $this->model->verifications();
            foreach ($requests as $key => $request) {
              $changes[$request['verControllerID'].'_dateFinished'] = $request['dateFinished'];
              $changes[$request['verControllerID'].'_status'] = $request['status'];
              $changes[$request['verControllerID'].'_action'] = $request['action'];
            }
            break;
        }
        echo json_encode($changes);
      }
    }

    function printDocument($documentNumber){
      echo $this->model->printDocument($documentNumber);
    }

    function validateDocument(){
      echo $this->model->validateDocument();
    }
    function markAsPrinted(){
      echo $this->model->markAsPrinted();
    }
    function claimDocument(){
      echo $this->model->claimDocument();
    }

    function recievePayment(){
      echo $this->model->recievePayment();
    }

    function saveDiplomaNumber(){
      echo $this->model->saveDiplomaNumber();
    }

    function dashboard(){
      $this->view->nav = 'dashboard';
      $this->view->account = true;
      $this->view->name = $this->name;
      $this->view->uType = $this->uType;
      $this->view->title = 'Registrar | Dashboard';
      $this->view->css = array('registrar/css/dashboard.css');
      $this->view->js = array('registrar/js/dashboard.js');
      $this->view->render('registrar/dashboard');
    }
    function addRecord(){
      $this->view->data = $this->model->getData();
      $this->view->nav = 'addRecord';
      $this->view->account = true;
      $this->view->name = $this->name;
      $this->view->uType = $this->uType;
      $this->view->title = 'Registrar | Add Record';
      $this->view->css = array(
        'registrar/css/default.css'
      );
      $this->view->js = array(
        '../public/js/city.min.js',

        '../public/js/jquery.validate.min.js',
        '../public/js/additional-methods.min.js',
        'registrar/js/addRec.js'
      );
      $this->view->render('registrar/addRecord');
    }
    function students(){
      $this->view->students = $this->model->getStudents();
      $this->view->nav = 'students';
      $this->view->account = true;
      $this->view->name = $this->name;
      $this->view->uType = $this->uType;
      $this->view->title = 'Registrar | Students';
      $this->view->css = array(
        '../public/css/jquery-ui.min.css',
        'registrar/css/students.css'
      );
      $this->view->js = array(
        '../public/js/jquery-ui.min.js',
        'registrar/js/students.js'
      );
      $this->view->render('registrar/students');
    }
    function showStudent($studnum){
      $this->view->showStudent = $this->model->showStudent($studnum);
      $this->view->account = true;
      $this->view->name = $this->name;
      $this->view->uType = $this->uType;
      $this->view->title = 'Registrar | Show Students';
      $this->view->css = array(
        '../public/css/jquery-ui.min.css',
        'registrar/css/students.css'
      );
      $this->view->js = array(
        '../public/js/jquery-ui.min.js',
        'registrar/js/students.js'
      );
      $this->view->render('registrar/showStudent');
    }
    function verification(){
      $this->view->verifications = $this->model->verifications();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav = 'verification';
      $this->view->uType = $this->uType;
      $this->view->title = 'Registrar | Graduate Verification';
      $this->view->css = array('registrar/css/default.css');
      $this->view->js = array('registrar/js/verification.js');
      $this->view->render('registrar/verification');
    }
    function addStudent(){
      echo $this->model->addStudent();
    }
    function addSubjects(){
      echo $this->model->addSubjects();
    }
    function delSubjects(){
      echo $this->model->delSubjects();
    }
    function updateSubjects(){
      echo $this->model->updateSubjects();
    }
    function selectSub(){
      echo json_encode($this->model->selectSub());
    }
    function getRequests(){
      echo $this->model->requests();
    }
    function requests(){
      $logged = Session::get('logged');
      if ($logged) {
        $this->view->nav = 'requests';
        $this->view->payment = $this->model->getPayments();
        $this->view->account = true;
        $this->view->name = $this->name;
        $this->view->uType = $this->uType;
        $this->view->title = 'Registrar | Document Requests';
        $this->view->css = array('registrar/css/default.css');
        $this->view->js = array('registrar/js/requests.js');
        $this->view->render('registrar/requests');
      }else {
        header("Location: ".URL.'registrar');
      }
    }
    function view($controlNumber){
      $logged = Session::get('logged');
      if ($logged) {
        $this->view->nav = 'requests';
        $this->view->data = $this->model->view($controlNumber);
        $this->view->account = true;
        $this->view->name = $this->name;
        $this->view->uType = $this->uType;
        $this->view->title = 'Request | '.$controlNumber;
        $this->view->css = array('registrar/css/view.css');
        $this->view->js = array('registrar/js/view.js');
        $this->view->render('registrar/view');
      }else {
        header("Location: ".URL.'registrar');
      }
    }
    function showPayment(){
      echo json_encode($this->model->showPayment());

    }

    function showForVerification(){
      echo json_encode($this->model->showForVerification());

    }
    function show($controlNumber){
      $logged = Session::get('logged');
      if ($logged) {
        $this->view->nav = 'verification';
        $this->view->data = $this->model->show($controlNumber);
        $this->view->account = true;
        $this->view->name = $this->name;
        $this->view->uType = $this->uType;
        $this->view->title = 'Verification | '.$controlNumber;
        $this->view->css = array('registrar/css/view.css');
        $this->view->js = array('registrar/js/show.js');
        $this->view->render('registrar/show');
      }else {
        header("Location: ".URL.'registrar');
      }
    }
    function acceptPayment(){
      echo $this->model->acceptPayment();
    }
    function declinePayment(){
      echo $this->model->declinePayment();
    }
    function verifyResults(){
      echo $this->model->verifyResults();
    }
    function sendResult(){
      echo $this->model->sendResult();
    }
    function sendUpdates(){
      echo $this->model->sendUpdates();
    }
  }
