<?php
  /**
   *
   */

    require_once '../odrs/libs/Controller.php';
  class Office extends Controller
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
          case 2:
          header('Location: '.URL.'registrar/dashboard');
            break;
          case 3:
          header('Location: '.URL.'branch/dashboard');
            break;
        }
      }
      $this->uType = 4;
      $this->name = Functions::name_format(Session::get('fname'), Session::get('lname'), Session::get('mname'), true, Session::get('suffix'));
    }
    function index(){
      $this->view->officeHead = $this->model->officeHeader();
      $this->view->officeRec = $this->model->officeRec();
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'home';
      $this->view->uType = $this->uType;
      $this->view->title = 'Offices';
      $this->view->js = array('office/js/default.js');
      $this->view->css = array('office/css/default.css');
      $this->view->render('office/index');
    }
    function addRecord(){
      $this->view->officeHead = $this->model->officeHeader();
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'add';
      $this->view->uType = $this->uType;
      $this->view->title = 'Offices';
      $this->view->js = array('office/js/default.js');
      $this->view->css = array('office/css/default.css');
      $this->view->render('office/addRecord');
    }
    function getStudentList(){
      echo $this->model->getStudentList();
    }
    function getSelectedStudent(){
      print json_encode($this->model->fetchStudent());
    }
    function addClearanceRecord(){
      echo $this->model->addClearanceRecord();
    }
    function showClrRecord(){
      print json_encode($this->model->showClrRecord());
    }
    function clearRecord(){
      echo $this->model->clearRecord();
    }
    function uptRecord(){
      echo $this->model->uptRecord();
    }
    function dashboard(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'dashboard';
      $this->view->uType = $this->uType;
      $this->view->title = 'Offices | Dashboard';
      $this->view->js = array('office/js/dashboard.js');
      $this->view->css = array('office/css/dashboard.css');
      $this->view->render('office/dashboard');
    }
    function library(){
      $this->view->verif = $this->model->verifications();
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'library';
      $this->view->uType = $this->uType;
      $this->view->title = 'Offices | Library';
      $this->view->js = array('office/js/library.js');
      $this->view->css = array('office/css/library.css');
      $this->view->render('office/library');
    }
    function laboratory(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'laboratory';
      $this->view->uType = $this->uType;
      $this->view->title = 'Offices | Laboratory';
      $this->view->js = array('office/js/laboratory.js');
      $this->view->css = array('office/css/laboratory.css');
      $this->view->render('office/laboratory');
    }
    function pe(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'pe';
      $this->view->uType = $this->uType;
      $this->view->title = 'Offices | Physical Education';
      $this->view->js = array('office/js/pe.js');
      $this->view->css = array('office/css/pe.css');
      $this->view->render('office/pe');
    }
    function accounting(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'accounting';
      $this->view->uType = $this->uType;
      $this->view->title = 'Offices | Accounting';
      $this->view->js = array('office/js/accounting.js');
      $this->view->css = array('office/css/accounting.css');
      $this->view->render('office/accounting');
    }
    function audit(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'audit';
      $this->view->uType = $this->uType;
      $this->view->title = 'Offices | Internal Audit';
      $this->view->js = array('office/js/audit.js');
      $this->view->css = array('office/css/audit.css');
      $this->view->render('office/audit');
    }
    function legal(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'legal';
      $this->view->uType = $this->uType;
      $this->view->title = 'Offices | Legal';
      $this->view->js = array('office/js/legal.js');
      $this->view->css = array('office/css/legal.css');
      $this->view->render('office/legal');
    }
  }
