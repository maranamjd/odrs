<?php
  /**
   *
   */
  class Branch extends Controller
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
          header('Location: '.URL.'registrar/home');
            break;
          case 4:
          header('Location: '.URL.'office/dashboard');
            break;
        }
      }
      $this->uType = 3;
      $this->name = Functions::name_format(Session::get('fname'), Session::get('lname'), Session::get('mname'), true, Session::get('suffix'));
    }
    function dashboard(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'dashboard';
      $this->view->uType = $this->uType;
      $this->view->title = 'Branch | Dashboard';
      $this->view->js = array('branch/js/dashboard.js');
      $this->view->css = array('branch/css/dashboard.css');
      $this->view->render('branch/dashboard');
    }
    function document_requests(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'document_requests';
      $this->view->uType = $this->uType;
      $this->view->title = 'Branch | Document Requests';
      $this->view->js = array('branch/js/requests.js');
      $this->view->css = array('branch/css/requests.css');
      $this->view->render('branch/requests');
    }
    function graduate_verification(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'graduate_verification';
      $this->view->uType = $this->uType;
      $this->view->title = 'Branch | Graduate Verification';
      $this->view->js = array('branch/js/verification.js');
      $this->view->css = array('branch/css/verification.css');
      $this->view->render('branch/verification');
    }
    function clearance_monitoring(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'clearance_monitoring';
      $this->view->uType = $this->uType;
      $this->view->title = 'Branch | Clearance Monitoring';
      $this->view->js = array('branch/js/clearance.js');
      $this->view->css = array('branch/css/clearance.css');
      $this->view->render('branch/clearance');
    }
    function graduate_tracer(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'graduate_tracer';
      $this->view->uType = $this->uType;
      $this->view->title = 'Branch | Graduate Tracer';
      $this->view->js = array('branch/js/tracer.js');
      $this->view->css = array('branch/css/tracer.css');
      $this->view->render('branch/tracer');
    }
    function accounts(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'accounts';
      $this->view->uType = $this->uType;
      $this->view->title = 'Branch | Accounts';
      $this->view->js = array('branch/js/accounts.js');
      $this->view->css = array('branch/css/accounts.css');
      $this->view->render('branch/accounts');
    }
    function offices(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'offices';
      $this->view->uType = $this->uType;
      $this->view->title = 'Branch | Offices';
      $this->view->js = array('branch/js/offices.js');
      $this->view->css = array('branch/css/offices.css');
      $this->view->render('branch/offices');
    }
    function information(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'information';
      $this->view->uType = $this->uType;
      $this->view->title = 'Branch | Information';
      $this->view->js = array('branch/js/information.js');
      $this->view->css = array('branch/css/information.css');
      $this->view->render('branch/information');
    }
    function backup(){
      $this->view->name = $this->name;
      $this->view->account = true;
      $this->view->nav = 'backup';
      $this->view->uType = $this->uType;
      $this->view->title = 'Branch | Backup';
      $this->view->js = array('branch/js/backup.js');
      $this->view->css = array('branch/css/backup.css');
      $this->view->render('branch/backup');
    }
  }
