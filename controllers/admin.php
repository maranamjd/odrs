<?php
  /**
   *
   */
  class Admin extends Controller
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
          case 4:
          header('Location: '.URL.'office/dashboard');
            break;
          case 2:
          header('Location: '.URL.'registrar/dashboard');
            break;
          case 3:
          header('Location: '.URL.'branch/dashboard');
            break;
        }
      }
      $this->uType = 5;
      $this->name = Functions::name_format(Session::get('fname'), Session::get('lname'), Session::get('mname'), true, Session::get('suffix'));
    }

    function getCategory(){
      echo $this->model->getCategory();
    }

    function report($id){
      $this->model->createReport($id);
    }

    function tracer_export(){
      $this->model->tracer_export();
    }

    function getDashboardData(){
      if (isset($_POST['get'])) {
        echo $this->model->getDashboardData();
      }else {
        return false;
      }
    }
    function dashboard(){
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'dashboard';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Dashboard';
      $this->view->js       = array('admin/js/dashboard.js');
      $this->view->render('admin/dashboard');
    }
    function tracer(){
      $this->view->name     = $this->name;
      $this->view->tracer   = $this->model->tracer();
      $this->view->account  = true;
      $this->view->nav      = 'tracer';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Graduate Tracer';
      $this->view->js       = array('admin/js/tracer.js');
      $this->view->render('admin/tracer');
    }
    function getConfig(){
      echo $this->model->getConfig();
    }
    function updateConfig(){
      echo $this->model->updateConfig();
    }
    function updatePresident(){
      echo $this->model->updatePresident();
    }
    function updateRegistrar(){
      echo $this->model->updateRegistrar();
    }
    function updateCopies(){
      echo $this->model->updateCopies();
    }
    function config(){
      $this->view->name     = $this->name;
      // $this->view->config   = $this->model->getConfig();
      $this->view->account  = true;
      $this->view->nav      = 'config';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Configurations';
      $this->view->js       = array('admin/js/config.js');
      $this->view->render('admin/config');
    }

    function getOfficeData(){
      echo $this->model->offices();
    }

    function offices(){
      // $this->view->offices  = $this->model->offices();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'offices';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Offices';
      $this->view->js       = array('admin/js/offices.js');
      $this->view->render('admin/offices');
    }
    function payments(){
      $this->view->payments  = $this->model->payments();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'payments';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Payments';
      $this->view->js       = array('admin/js/payment.js');
      $this->view->render('admin/payment');
    }

    function getTrashOfficeData(){
      echo $this->model->officeTrash();
    }
    function officeTrash(){
      // $this->view->offices  = $this->model->officeTrash();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'offices';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Offices';
      $this->view->js       = array('admin/js/trash/offices.js');
      $this->view->render('admin/officeTrash');
    }
    function subjects(){
      $this->view->subjects = $this->model->subjects();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'subjects';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Subjects';
      $this->view->js       = array('admin/js/subjects.js');
      $this->view->render('admin/subjects');
    }
    function employeeTrash(){
      $this->view->employees= $this->model->employeeTrash();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'employeeTrash';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Employees';
      $this->view->js       = array('admin/js/employees.js');
      $this->view->render('admin/employeeTrash');
    }
    function employee_info(){
      $this->view->employees= $this->model->employees()['info'];
      $this->view->branches = $this->model->employees()['branches'];
      $this->view->offices  = $this->model->employees()['offices'];
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'employees';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Employees';
      $this->view->js       = array('admin/js/employees.js');
      $this->view->render('admin/employees');
    }
    function documents(){
      $this->view->docs     = $this->model->documents()['info'];
      $this->view->doctype  = $this->model->documents()['doctype'];
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'documents';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Document Information';
      $this->view->js       = array('admin/js/documents.js');
      $this->view->render('admin/documents');
    }
    function documentTrash(){
      $this->view->docs     = $this->model->documentTrash()['info'];
      $this->view->doctype  = $this->model->documentTrash()['doctype'];
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'documents';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Document Information';
      $this->view->js       = array('admin/js/documents.js');
      $this->view->render('admin/documentTrash');
    }
    function document_types(){
      $this->view->doctypes = $this->model->document_types();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'document_types';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Document Types';
      $this->view->js       = array('admin/js/document_types.js');
      $this->view->render('admin/document_types');
    }
    function documentTypeTrash(){
      $this->view->doctypes = $this->model->doctypeTrash();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'document_types';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Document Types';
      $this->view->js       = array('admin/js/document_types.js');
      $this->view->render('admin/documentTypeTrash');
    }
    function courses(){
      $this->view->courses = $this->model->courses();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'courses';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Courses';
      $this->view->js       = array('admin/js/courses.js');
      $this->view->render('admin/courses');
    }
    function courseTrash(){
      $this->view->courses = $this->model->courseTrash();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'courses';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Courses';
      $this->view->js       = array('admin/js/courses.js');
      $this->view->render('admin/courseTrash');
    }

    function survey_questions(){
      $this->view->questions= $this->model->questions();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'survey_questions';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Survey Questions';
      $this->view->js       = array('admin/js/survey.js');
      $this->view->render('admin/survey');
    }
    function surveyTrash(){
      $this->view->questions= $this->model->questionTrash();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'survey_questions';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Survey Questions';
      $this->view->js       = array('admin/js/survey.js');
      $this->view->render('admin/surveyTrash');
    }
    function choices($id){
      $this->view->choices  = $this->model->choices($id)['choices'];
      $this->view->question = $this->model->choices($id)['question'];
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'choices';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Choices';
      $this->view->js       = array('admin/js/choices.js');
      $this->view->render('admin/choices');
    }
    function choiceTrash(){
      $this->view->choices  = $this->model->choiceTrash()['choices'];
      // $this->view->question = $this->model->choiceTrash()['question'];
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'choices';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Choices';
      $this->view->js       = array('admin/js/choices.js');
      $this->view->render('admin/choiceTrash');
    }
    function getRestores(){
      echo $this->model->getRestores();
    }
    function dataBackup(){
      $this->model->dataBackup();
    }
    function dataRestore(){
      echo $this->model->dataRestore();
    }
    function checkRestoreFile(){
      echo $this->model->checkRestoreFile();
    }
    function backup(){
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'backup';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Data Backup and Restore';
      $this->view->js       = array('admin/js/backup.js');
      $this->view->render('admin/backup');
    }
    function graduate_tracer(){
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'graduate_tracer';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Graduate Tracer';
      $this->view->js       = array('admin/js/tracer.js');
      $this->view->render('admin/tracer');
    }
    function accounts(){
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'accounts';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Branch Accounts';
      $this->view->js       = array('admin/js/accounts.js');
      $this->view->render('admin/accounts');
    }
    function branch_info(){
      $this->view->branches = $this->model->branch_info();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'info';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Branch Information';
      $this->view->js       = array('admin/js/info.js');
      $this->view->render('admin/info');
    }

    function branchTrash(){
      $this->view->branches = $this->model->branchTrash();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'info';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Branch Information';
      $this->view->js       = array('admin/js/info.js');
      $this->view->render('admin/branchTrash');
    }
    function subjectTrash(){
      $this->view->name     = $this->name;
      $this->view->subjects = $this->model->subjectTrash();
      $this->view->account  = true;
      $this->view->nav      = 'subjects';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Subject Trash';
      $this->view->js       = array('admin/js/subjects.js');

      $this->view->render('admin/subjectsTrash');
    }
    function reports(){
      $this->view->reports = $this->model->getReports();
      $this->view->name     = $this->name;
      $this->view->account  = true;
      $this->view->nav      = 'reports';
      $this->view->uType    = $this->uType;
      $this->view->title    = 'Admin | Report';
      $this->view->js       = array('admin/js/report.js');
      $this->view->render('admin/reports');
    }

    function addBranch(){
      echo $this->model->addBranch();
    }
    function updateBranch(){
      echo $this->model->updateBranch();
    }
    function deleteBranch(){
      echo $this->model->deleteBranch();
    }
    function recoverBranch(){
      echo $this->model->recoverBranch();
    }


    function addOffice(){
      echo $this->model->addOffice();
    }
    function updateOffice(){
      echo $this->model->updateOffice();
    }
    function deleteOffice(){
      echo $this->model->deleteOffice();
    }
    function recoverOffice(){
      echo $this->model->recoverOffice();
    }


    function addEmployee(){
      echo $this->model->addEmployee();
    }
    function updateEmployee(){
      echo $this->model->updateEmployee();
    }
    function deleteEmployee(){
      echo $this->model->deleteEmployee();
    }
    function activateAccount(){
      echo $this->model->activateAccount();
    }

    function addSubject(){
      echo $this->model->addSubject();
    }
    function updateSubject(){
      echo $this->model->updateSubject();
    }
    function deleteSubject(){
      echo $this->model->deleteSubject();
    }
    function recoverSubject(){
      echo $this->model->recoverSubject();
    }
    function addDocument(){
      echo $this->model->addDocument();
    }
    function updateDocument(){
      echo $this->model->updateDocument();
    }
    function deleteDocument(){
      echo $this->model->deleteDocument();
    }
    function recoverDocument(){
      echo $this->model->recoverDocument();
    }
    function addDoctype(){
      echo $this->model->addDoctype();
    }
    function updateDoctype(){
      echo $this->model->updateDoctype();
    }
    function deleteDoctype(){
      echo $this->model->deleteDoctype();
    }
    function recoverDoctype(){
      echo $this->model->recoverDoctype();
    }

    function addCourse(){
      echo $this->model->addCourse();
    }
    function updateCourse(){
      echo $this->model->updateCourse();
    }
    function deleteCourse(){
      echo $this->model->deleteCourse();
    }
    function recoverCourse(){
      echo $this->model->recoverCourse();
    }

    function addQuestion(){
      echo $this->model->addQuestion();
    }
    function updateQuestion(){
      echo $this->model->updateQuestion();
    }
    function deleteQuestion(){
      echo $this->model->deleteQuestion();
    }
    function recoverQuestion(){
      echo $this->model->recoverQuestion();
    }
    function addChoice(){
      echo $this->model->addChoice();
    }
    function updateChoice(){
      echo $this->model->updateChoice();
    }
    function deleteChoice(){
      echo $this->model->deleteChoice();
    }
    function recoverChoice(){
      echo $this->model->recoverChoice();
    }
    function addPayment(){
      echo $this->model->addPayment();
    }
    function updatePayment(){
      echo $this->model->updatePayment();
    }
    function deletePayment(){
      echo $this->model->deletePayment();
    }
    function recoverPayment(){
      echo $this->model->recoverPayment();
    }
  }
