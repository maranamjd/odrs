<?php

  /**
   *
   */
  class Admin_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    private function _getMaintenanceData($table, $col, $invert = false){
      if (!$invert) {
        return [
          'active' => count($this->db->select($table, ["$col"], "$col = 0")),
          'trash'  => count($this->db->select($table, ["$col"], "$col = 1")),
          'total'  => count($this->db->select($table, ["$col"], "1"))
        ];
      }
      return [
        'active' => count($this->db->select($table, ["$col"], "$col = 1")),
        'trash'  => count($this->db->select($table, ["$col"], "$col = 0")),
        'total'  => count($this->db->select($table, ["$col"], "1"))
      ];
    }

    public function tracer_export(){
      // echo json_encode($this->tracer());
      // die;
      $tracer = new Tracer();
      $tracer->data = $this->tracer();
      $tracer->generate('Tracer Study');
    }

    public function createReport($id){
      $report = new Report();
      $transaction = explode('_', $id)[0];
      if ($transaction == 'Document-Request') {
        $type = explode('_', $id)[1];
        $date = explode('_', $id)[2];
        $category = explode('_', $id)[3];
        $category_value = explode('_', $id)[4];
        $request_type = explode('_', $id)[5];
        $data = array();

        if ($request_type == 'Graduate') {
          $graduate = 1;
        }else if ($request_type == 'Undergraduate') {
          $graduate = 0;
        }else{
          $graduate = '*';
        }
        if ($type == 'daily') {
          $condition = "dateFiled = '".date('Y-m-d', strtotime($date))."'";
        }elseif ($type == 'weekly') {
          $condition = "dateFiled BETWEEN '".date('Y-m-d', strtotime($date))."' AND '".date('Y-m-d', strtotime($date.'+6 days'))."'";
        }else {
          $condition = "dateFiled LIKE '%".date('Y-m', strtotime($date))."%'";
        }


        if ($category == 'Document') {
          $data['category_value'] = $this->db->select('document', ['description'], "documentID = $category_value")[0]['description'];
          $requests = $this->db->select('request', ['distinct(controlNumber) as controlNumber'], "document_documentID = $category_value");
          $request_controller = array();
          foreach ($requests as $key => $request) {
            $docu = array();
            $student = array();
            $request_info = $this->db->select('requests_controller', ['studentNumber', 'dateFiled', 'dateFinished', 'purpose', 'status'], "controlNumber = '".$request['controlNumber']."' AND ".$condition);
            if (count($request_info) > 0) {
              $student = $this->db->select('students', ['lname', 'fname', 'mname', 'isGraduate', 'courseID', '(select acronym from course where courseID = students.courseID) as course'], "studentNumber = '".$request_info[0]['studentNumber']."'")[0];
              if ($graduate === '*') {
                $course = $this->db->select('course', ['collegeID'], "courseID = ".$student['courseID']);
                $docu['college'] = $this->db->select('college', ['acronym as college'], "collegeID = ".$course[0]['collegeID'])[0]['college'];
                foreach ($student as $studentkey => $value) {
                  $docu[$studentkey] = $value;
                }
                foreach ($request_info[0] as $infokey => $info) {
                  $docu[$infokey] = $info;
                }
                $request_controller[] = $docu;
              }else {
                if ($student['isGraduate'] == $graduate) {
                  $course = $this->db->select('course', ['collegeID'], "courseID = ".$student['courseID']);
                  $docu['college'] = $this->db->select('college', ['acronym as college'], "collegeID = ".$course[0]['collegeID'])[0]['college'];
                  foreach ($student as $studentkey => $value) {
                    $docu[$studentkey] = $value;
                  }
                  foreach ($request_info[0] as $infokey => $info) {
                    $docu[$infokey] = $info;
                  }
                  $request_controller[] = $docu;
                }
              }
            }
          }
          $data['requests'] = $request_controller;
          $report->setData($type, $date, $category, $category_value, $request_type, $data, 20);

          // echo json_encode($request_controller);
          // die;
        }elseif ($category == 'All') {
          $request_controller = array();
          $valid = array();
          $data['category_value'] = 'All';
          $requests = $this->db->select('requests_controller', ['distinct(studentNumber) as studentNumber', 'controlNumber'], $condition);
          // foreach ($requests as $key => $request) {
          //   $student = $this->db->select('students', ['branchID'], "studentNumber = '".$request['studentNumber']."'")[0];
          //   if ($student['branchID'] == $category_value) {
          //     $valid[] = ['controlNumber' => $request['controlNumber']];
          //   }
          // }
          foreach ($requests as $key => $request) {
            $docu = array();
            $student = array();
            $request_info = $this->db->select('requests_controller', ['studentNumber', 'dateFiled', 'dateFinished', 'purpose', 'status'], "controlNumber = '".$request['controlNumber']."'");


            if (count($request_info) > 0) {
              $docs = $this->db->select('request', ['(select description from document where documentID = request.document_documentID) as description'], "controlNumber = '".$request['controlNumber']."'");
              $docu['docs'] = $docs;
              $student = $this->db->select('students', ['lname', 'fname', 'mname', 'isGraduate', 'courseID', '(select acronym from course where courseID = students.courseID) as course'], "studentNumber = '".$request_info[0]['studentNumber']."'")[0];
              if ($graduate === '*') {
                $course = $this->db->select('course', ['collegeID'], "courseID = ".$student['courseID']);
                $docu['college'] = $this->db->select('college', ['acronym as college'], "collegeID = ".$course[0]['collegeID'])[0]['college'];
                foreach ($student as $studentkey => $value) {
                  $docu[$studentkey] = $value;
                }
                foreach ($request_info[0] as $infokey => $info) {
                  $docu[$infokey] = $info;
                }
                $request_controller[] = $docu;
              }else {
                if ($student['isGraduate'] == $graduate) {
                  $course = $this->db->select('course', ['collegeID'], "courseID = ".$student['courseID']);
                  $docu['college'] = $this->db->select('college', ['acronym as college'], "collegeID = ".$course[0]['collegeID'])[0]['college'];
                  foreach ($student as $studentkey => $value) {
                    $docu[$studentkey] = $value;
                  }
                  foreach ($request_info[0] as $infokey => $info) {
                    $docu[$infokey] = $info;
                  }
                  $request_controller[] = $docu;
                }
              }
            }
          }
          $data['requests'] = $request_controller;
          $report->setData($type, $date, $category, $category_value, $request_type, $data, 10);
          // echo json_encode($request_controller);
          // die;
        }elseif ($category == 'Course') {
          $request_controller = array();
          $valid = array();
          $data['category_value'] = $this->db->select('course', ['description'], "courseID = $category_value")[0]['description'];
          $requests = $this->db->select('requests_controller', ['distinct(studentNumber) as studentNumber', 'controlNumber'], $condition);
          foreach ($requests as $key => $request) {
            $student = $this->db->select('students', ['courseID'], "studentNumber = '".$request['studentNumber']."'")[0];
            if ($student['courseID'] == $category_value) {
              $valid[] = ['controlNumber' => $request['controlNumber']];
            }
          }
          foreach ($valid as $key => $request) {
            $docu = array();
            $student = array();
            $request_info = $this->db->select('requests_controller', ['studentNumber', 'dateFiled', 'dateFinished', 'purpose', 'status'], "controlNumber = '".$request['controlNumber']."'");
            if (count($request_info) > 0) {
              $docs = $this->db->select('request', ['(select description from document where documentID = request.document_documentID) as description'], "controlNumber = '".$request['controlNumber']."'");
              $docu['docs'] = $docs;
              $student = $this->db->select('students', ['lname', 'fname', 'mname', 'isGraduate'], "studentNumber = '".$request_info[0]['studentNumber']."'")[0];
              if ($graduate === '*') {
                foreach ($student as $studentkey => $value) {
                  $docu[$studentkey] = $value;
                }
                foreach ($request_info[0] as $infokey => $info) {
                  $docu[$infokey] = $info;
                }
                $request_controller[] = $docu;
              }else {
                if ($student['isGraduate'] == $graduate) {
                  foreach ($student as $studentkey => $value) {
                    $docu[$studentkey] = $value;
                  }
                  foreach ($request_info[0] as $infokey => $info) {
                    $docu[$infokey] = $info;
                  }
                  $request_controller[] = $docu;
                }
              }
            }
          }
          $data['requests'] = $request_controller;
          $report->setData($type, $date, $category, $category_value, $request_type, $data, 10);
          // echo json_encode($request_controller);
          // die;
        }elseif ($category === 'College') {
          $request_controller = array();
          $valid = array();
          $data['category_value'] = $this->db->select('college', ['description'], "collegeID = $category_value")[0]['description'];

          $requests = $this->db->select('requests_controller', ['distinct(studentNumber) as studentNumber', 'controlNumber'], $condition);
          foreach ($requests as $key => $request) {
            $student = $this->db->select('students', ['courseID'], "studentNumber = '".$request['studentNumber']."'")[0];
            $course = $this->db->select('course', ['collegeID'], "courseID = '".$student['courseID']."'")[0];
            if ($course['collegeID'] == $category_value) {
              $valid[] = ['controlNumber' => $request['controlNumber']];
            }
          }
          foreach ($valid as $key => $request) {
            $docu = array();
            $student = array();
            $request_info = $this->db->select('requests_controller', ['studentNumber', 'dateFiled', 'dateFinished', 'purpose', 'status'], "controlNumber = '".$request['controlNumber']."'");
            if (count($request_info) > 0) {
              $docs = $this->db->select('request', ['(select description from document where documentID = request.document_documentID) as description'], "controlNumber = '".$request['controlNumber']."'");
              $docu['docs'] = $docs;
              $student = $this->db->select('students', ['lname', 'fname', 'mname', 'isGraduate', '(select acronym from course where courseID = students.courseID) as course'], "studentNumber = '".$request_info[0]['studentNumber']."'")[0];
              if ($graduate == '*') {
                foreach ($student as $studentkey => $value) {
                  $docu[$studentkey] = $value;
                }
                foreach ($request_info[0] as $infokey => $info) {
                  $docu[$infokey] = $info;
                }
                $request_controller[] = $docu;
              }else {
                if ($student['isGraduate'] == $graduate) {
                  foreach ($student as $studentkey => $value) {
                    $docu[$studentkey] = $value;
                  }
                  foreach ($request_info[0] as $infokey => $info) {
                    $docu[$infokey] = $info;
                  }
                  $request_controller[] = $docu;
                }
              }
            }
          }
          $data['requests'] = $request_controller;
          $report->setData($type, $date, $category, $category_value, $request_type, $data, 10);
          // echo json_encode($request_controller[0]);
          // die;
        }else {
          $request_controller = array();
          $valid = array();
          $data['category_value'] = $this->db->select('branches', ['branchName'], "branchID = $category_value")[0]['branchName'];
          $requests = $this->db->select('requests_controller', ['distinct(studentNumber) as studentNumber', 'controlNumber'], $condition);
          foreach ($requests as $key => $request) {
            $student = $this->db->select('students', ['branchID'], "studentNumber = '".$request['studentNumber']."'")[0];
            if ($student['branchID'] == $category_value) {
              $valid[] = ['controlNumber' => $request['controlNumber']];
            }
          }
          foreach ($valid as $key => $request) {
            $docu = array();
            $student = array();
            $request_info = $this->db->select('requests_controller', ['studentNumber', 'dateFiled', 'dateFinished', 'purpose', 'status'], "controlNumber = '".$request['controlNumber']."'");
            if (count($request_info) > 0) {
              $docs = $this->db->select('request', ['(select description from document where documentID = request.document_documentID) as description'], "controlNumber = '".$request['controlNumber']."'");
              $docu['docs'] = $docs;
              $student = $this->db->select('students', ['lname', 'fname', 'mname', 'isGraduate', 'courseID', '(select acronym from course where courseID = students.courseID) as course'], "studentNumber = '".$request_info[0]['studentNumber']."'")[0];
              if ($student['isGraduate'] == $graduate) {
                $course = $this->db->select('course', ['collegeID'], "courseID = ".$student['courseID']);
                $docu['college'] = $this->db->select('college', ['acronym as college'], "collegeID = ".$course[0]['collegeID'])[0]['college'];
                foreach ($student as $studentkey => $value) {
                  $docu[$studentkey] = $value;
                }
                foreach ($request_info[0] as $infokey => $info) {
                  $docu[$infokey] = $info;
                }
                $request_controller[] = $docu;
              }
            }
          }
          $data['requests'] = $request_controller;
          $report->setData($type, $date, $category, $category_value, $request_type, $data, 10);
          // echo json_encode($request_controller);
          // die;
        }
      }else {
        //graduate verification
        $type = explode('_', $id)[1];
        $date = explode('_', $id)[2];
        $data = array();
        if ($type == 'daily') {
          $condition = "created_on = '".date('Y-m-d', strtotime($date))."'";
        }elseif ($type == 'weekly') {
          $condition = "created_on BETWEEN '".date('Y-m-d', strtotime($date))."' AND '".date('Y-m-d', strtotime($date.'+6 days'))."'";
        }else {
          $condition = "created_on LIKE '%".date('Y-m', strtotime($date))."%'";
        }

        // $data['category_value'] = $this->db->select('course', ['description'], "courseID = $category_value")[0]['description'];
        $requests = $this->db->select('verifications_controller', ['verControllerID', 'repID', 'status', 'created_on', 'dateFinished'], $condition);
        foreach ($requests as $key => $request) {
          //rep and company
          $rep = $this->db->select('representatives', ['firstName', 'middleName', 'lastName', 'suffix', 'companyID'], "repID = '".$request['repID']."'")[0];
          $requests[$key]['representative'] = $this->fn->name_format($rep['firstName'], $rep['lastName'], $rep['middleName'], true, $rep['suffix']);
          $requests[$key]['company'] = $this->db->select('company', ['companyName'], "companyID = ".$rep['companyID'])[0]['companyName'];

          //docs
          $docs = $this->db->select('verifications', ['docType', 'verifiedAt', 'verifiedBy', 'result'], "verControllerID = ".$request['verControllerID']);
          foreach ($docs as $docskey => $doc) {
            $docs[$docskey]['docType'] = $this->db->select('document_type', ['description'], "classID = ".$doc['docType'])[0]['description'];
            if ($doc['verifiedBy'] != null) {
              $employee = $this->db->select('employee', ['fname', 'mname', 'lname', 'suffix'], "employeeID = '".$doc['verifiedBy']."'")[0];
              $docs[$docskey]['verifiedBy'] = $this->fn->name_format($employee['fname'], $employee['lname'], $employee['mname'], true, $employee['suffix']);
            }
          }
          $requests[$key]['docs'] = $docs;
        }
        // echo json_encode($requests);
        // die;
        $data['requests'] = $requests;
        $data['category_value'] = '';
        $report->setData($type, $date, '', '', '', $data, 10);
        // echo json_encode($request_controller);
        // die;
      }


      $report->generate($id, $transaction);
    }




    public function getCategory(){
      if ($_POST['table'] == 'Branch') {
        return json_encode($this->db->select('branches', ['branchID as id', 'branchName as name'], "trash = 0"));
      }elseif ($_POST['table'] == 'Document') {
        return json_encode($this->db->select('document', ['documentID as id', 'description as name'], "trash = 0"));
      }elseif ($_POST['table'] == 'College') {
        return json_encode($this->db->select('college', ['collegeID as id', 'description as name'], "trash = 0"));
      }elseif ($_POST['table'] == 'Course') {
        return json_encode($this->db->select('course', ['courseID as id', 'description as name'], "trash = 0"));
      }
    }

    public function tracer(){
      $data = array();
      $answers = array();
      $questions =  $this->db->select('survey_questions', ['*'], "trash = 0");
      $survey = $this->db->select('survey', ['questionID', 'choiceID'], '1');

      foreach ($questions as $key => $question) {
        $question_take = 0;
        foreach ($survey as $value) {
          if ($value['questionID'] == $question['questionID']) {
            $question_take++;
          }
        }
        $questions[$key]['take'] = $question_take;

        $choices = $this->db->select('survey_choices', ['*'], "trash = 0 AND questionID = ".$question['questionID']);
        foreach ($choices as $ckey => $choice) {
          $choice_take = 0;
          foreach ($survey as $value) {
            if ($value['choiceID'] == $choice['choiceID']) {
              $choice_take++;
            }
          }
          $choices[$ckey]['take'] = $choice_take;
        }
        if ($question['hasOther'] == 1) {
          $other_take = 0;
          foreach ($survey as $value) {
            if ($value['questionID'] == $question['questionID']) {
              if ($value['choiceID'] == 0) {
                $other_take++;
              }
            }
          }
          $choices[] = ['description' => 'Other', 'take' => $other_take];
        }

        usort($choices, function($a, $b){
          if($a["take"] == $b["take"]) return 0;
          return $a["take"] < $b["take"] ? 1 : -1;
        });
        $questions[$key]['choices'] = $choices;
      }
      // echo json_encode($questions);
      // die;
      return $questions;
    }

    public function updateConfig(){
      try {
        $this->db->update('config', ['value' => $_POST['val']], "description = '".$_POST['key']."'");
        return json_encode(['res' => 1, 'message' => "Update successful!"]);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }

    }
    public function updatePresident(){
      try {
        $this->db->update('config', ['value' => $_POST['value']], "description = '".$_POST['id']."'");
        return json_encode(['res' => 1, 'message' => "Update successful!"]);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }

    }
    public function updateCopies(){
      try {
        $this->db->update('config', ['value' => $_POST['value']], "description = '".$_POST['id']."'");
        return json_encode(['res' => 1, 'message' => "Update successful!"]);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }

    }
    public function updateRegistrar(){
      try {
        $this->db->update('config', ['value' => $_POST['value']], "description = '".$_POST['id']."'");
        return json_encode(['res' => 1, 'message' => "Update successful!"]);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }

    }

    public function getConfig(){
      $config = $this->db->select('config', ['*'], '1');
      $data = array();
      foreach ($config as $value) {
        $data[$value['description']] = $value['value'];
      }
      return json_encode($data);
    }

    public function getDashboardData(){
      $data = array();
      $dateToday = date('Y-m-d');

      //today
      $data['requests']['today'] = $this->fn->getRequestDashboardData($dateToday);
      $data['verifications']['today'] = $this->fn->getVerificationDashboardData($dateToday);


      //this week
      $mon = date('Y-m-d', strtotime('monday this week'));
      $tue = date('Y-m-d', strtotime('tuesday this week'));
      $wed = date('Y-m-d', strtotime('wednesday this week'));
      $thu = date('Y-m-d', strtotime('thursday this week'));
      $fri = date('Y-m-d', strtotime('friday this week'));
      $sat = date('Y-m-d', strtotime('saturday this week'));
      $sun = date('Y-m-d', strtotime('sunday this week'));
      $data['requests']['week'] = [
        'unpaid' => [
          $this->fn->getRequestDashboardData($mon)['unpaid'],
          $this->fn->getRequestDashboardData($tue)['unpaid'],
          $this->fn->getRequestDashboardData($wed)['unpaid'],
          $this->fn->getRequestDashboardData($thu)['unpaid'],
          $this->fn->getRequestDashboardData($fri)['unpaid'],
          $this->fn->getRequestDashboardData($sat)['unpaid'],
          $this->fn->getRequestDashboardData($sun)['unpaid']
        ],
        'releasing' => [
          $this->fn->getRequestDashboardData($mon)['releasing'],
          $this->fn->getRequestDashboardData($tue)['releasing'],
          $this->fn->getRequestDashboardData($wed)['releasing'],
          $this->fn->getRequestDashboardData($thu)['releasing'],
          $this->fn->getRequestDashboardData($fri)['releasing'],
          $this->fn->getRequestDashboardData($sat)['releasing'],
          $this->fn->getRequestDashboardData($sun)['releasing']
        ],
        'cancelled' => [
          $this->fn->getRequestDashboardData($mon)['cancelled'],
          $this->fn->getRequestDashboardData($tue)['cancelled'],
          $this->fn->getRequestDashboardData($wed)['cancelled'],
          $this->fn->getRequestDashboardData($thu)['cancelled'],
          $this->fn->getRequestDashboardData($fri)['cancelled'],
          $this->fn->getRequestDashboardData($sat)['cancelled'],
          $this->fn->getRequestDashboardData($sun)['cancelled']
        ],
        'processing' => [
          $this->fn->getRequestDashboardData($mon)['processing'],
          $this->fn->getRequestDashboardData($tue)['processing'],
          $this->fn->getRequestDashboardData($wed)['processing'],
          $this->fn->getRequestDashboardData($thu)['processing'],
          $this->fn->getRequestDashboardData($fri)['processing'],
          $this->fn->getRequestDashboardData($sat)['processing'],
          $this->fn->getRequestDashboardData($sun)['processing']
        ],
        'claimed' => [
          $this->fn->getRequestDashboardData($mon)['claimed'],
          $this->fn->getRequestDashboardData($tue)['claimed'],
          $this->fn->getRequestDashboardData($wed)['claimed'],
          $this->fn->getRequestDashboardData($thu)['claimed'],
          $this->fn->getRequestDashboardData($fri)['claimed'],
          $this->fn->getRequestDashboardData($sat)['claimed'],
          $this->fn->getRequestDashboardData($sun)['claimed']
        ]
      ];
      $data['dates'] = [
        date('D, M d', strtotime('monday this week')),
        date('D, M d', strtotime('tuesday this week')),
        date('D, M d', strtotime('wednesday this week')),
        date('D, M d', strtotime('thursday this week')),
        date('D, M d', strtotime('friday this week')),
        date('D, M d', strtotime('saturday this week')),
        date('D, M d', strtotime('sunday this week'))
      ];

      $data['verifications']['week'] = [
        'unpaid' => [
          $this->fn->getVerificationDashboardData($mon)['unpaid'],
          $this->fn->getVerificationDashboardData($tue)['unpaid'],
          $this->fn->getVerificationDashboardData($wed)['unpaid'],
          $this->fn->getVerificationDashboardData($thu)['unpaid'],
          $this->fn->getVerificationDashboardData($fri)['unpaid'],
          $this->fn->getVerificationDashboardData($sat)['unpaid'],
          $this->fn->getVerificationDashboardData($sun)['unpaid']
        ],
        'approval' => [
          $this->fn->getVerificationDashboardData($mon)['approval'],
          $this->fn->getVerificationDashboardData($tue)['approval'],
          $this->fn->getVerificationDashboardData($wed)['approval'],
          $this->fn->getVerificationDashboardData($thu)['approval'],
          $this->fn->getVerificationDashboardData($fri)['approval'],
          $this->fn->getVerificationDashboardData($sat)['approval'],
          $this->fn->getVerificationDashboardData($sun)['approval']
        ],
        'verification' => [
          $this->fn->getVerificationDashboardData($mon)['verification'],
          $this->fn->getVerificationDashboardData($tue)['verification'],
          $this->fn->getVerificationDashboardData($wed)['verification'],
          $this->fn->getVerificationDashboardData($thu)['verification'],
          $this->fn->getVerificationDashboardData($fri)['verification'],
          $this->fn->getVerificationDashboardData($sat)['verification'],
          $this->fn->getVerificationDashboardData($sun)['verification']
        ],
        'verified' => [
          $this->fn->getVerificationDashboardData($mon)['verified'],
          $this->fn->getVerificationDashboardData($tue)['verified'],
          $this->fn->getVerificationDashboardData($wed)['verified'],
          $this->fn->getVerificationDashboardData($thu)['verified'],
          $this->fn->getVerificationDashboardData($fri)['verified'],
          $this->fn->getVerificationDashboardData($sat)['verified'],
          $this->fn->getVerificationDashboardData($sun)['verified']
        ]
      ];
      $data['dates'] = [
        date('D, M d', strtotime('monday this week')),
        date('D, M d', strtotime('tuesday this week')),
        date('D, M d', strtotime('wednesday this week')),
        date('D, M d', strtotime('thursday this week')),
        date('D, M d', strtotime('friday this week')),
        date('D, M d', strtotime('saturday this week')),
        date('D, M d', strtotime('sunday this week'))
      ];
      $data['employee'] = $this->_getMaintenanceData('empaccount', 'isActive', true);
      $data['branch'] = $this->_getMaintenanceData('branches', 'trash');
      $data['office'] = $this->_getMaintenanceData('offices', 'trash');
      $data['course'] = $this->_getMaintenanceData('course', 'trash');
      $data['document'] = $this->_getMaintenanceData('document', 'trash');
      $data['doctype'] = $this->_getMaintenanceData('document_type', 'trash');
      $data['subject'] = $this->_getMaintenanceData('subjects', 'trash');
      $data['survey'] = $this->_getMaintenanceData('survey_questions', 'trash');

      return json_encode($data);
    }

    public function checkRestoreFile(){
      $file = $_FILES['file']['name'];
      $ext = pathinfo($file, PATHINFO_EXTENSION);
      if ($ext != 'sql') {
        return json_encode(['res' => 0, 'message' => 'Must be an sql file']);
      }else {
        $data = file($_FILES['file']['tmp_name']);
        $line = $data[count($data)-1];
        if (str_replace('--', '', $line) != $this->fn->encrypt('ODRSFILEVALIDATION')) {
          return json_encode(['res' => 0, 'message' => 'File validation do not match!']);
        }
        return json_encode(['res' => 1]);
      }

    }

    public function dataRestore(){
      if (isset($_POST['type'])) {
        if ($_POST['type'] == 1) {
          $file = "system/data/backups/".$_POST['file'];
        }else {
          $file = $_FILES['file']['tmp_name'];
        }
        try {
          set_time_limit(300);
          $this->db->query(file_get_contents($file));
          return json_encode(['res' => 1, 'message' => 'Data Restored!']);
        } catch (PDOException $e) {
          return json_encode(['res' => 0, 'message' => $e->getMessage()]);
        }
      }
    }

    public function dataBackup(){
      if (Session::get('usertype') !== null && Session::get('usertype') == 1) {
        $file ="system/data/backups/".date('y-m-d').".sql";
        $backup = $this->fn->backupDatabaseTables('*', $file);
        if ($backup) {
          header('Content-Type: application/sql');
          header('Content-Disposition: attachment; filename='.basename($file));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($file));
          readfile($file);
          exit;
        }
      }
      else {
        Session::destroy();
        header('Location: '.URL);
      }
    }

    public function getRestores(){
      if (isset($_POST['target'])) {
        $restore_list = array();
        $data = glob("system/data/backups/*.sql");
        foreach ($data as $key => $value) {
          $restore_list[$key]['name'] = explode('/', $value)[3];
          $restore_list[$key]['date'] = date('F d, Y', strtotime(explode('.', explode('/', $value)[3])[0]));
        }
      }
      usort($restore_list, function($a, $b){
        if(strtotime($a["date"]) == strtotime($b["date"])) return 0;
        return strtotime($a["date"]) < strtotime($b["date"]) ? 1 : -1;
      });
      return json_encode(['res' => 1, 'restore' => $restore_list]);
    }

    public function deleteChoice(){
      $choice_id = $_POST['choice_id'];

      try {
        $result = $this->db->update('survey_choices', ['trash' => 1], "choiceID = $choice_id");

        return json_encode(['res' => 1, 'message' => 'Choice Moved to trash!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function recoverChoice(){
      $choice_id = $_POST['choice_id'];

      try {
        $result = $this->db->update('survey_choices', ['trash' => 0], "choiceID = $choice_id");
        return json_encode(['res' => 1, 'message' => 'Choice Recovered!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function updateChoice(){
      $choice_id    = $_POST['choice_id'];
      $choice_desc  = $_POST['choice_desc'];

      try {
        $result = $this->db->update('survey_choices', ['description' => $choice_desc], "choiceID = $choice_id");
        return json_encode(['res' => 1, 'message' => 'Choice Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }

    }

    public function addChoice(){
      $choice_desc   = $_POST['choice_desc'];
      $question_id   = $_POST['question_id'];

      try {
        $result = $this->db->insert('survey_choices', ['choiceID'   => null, 'questionID'  => $question_id, 'description'  => $choice_desc]);
        return json_encode(['res' => 1, 'message' => 'Choice Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function deleteQuestion(){
      $question_id = $_POST['question_id'];

      try {
        $result = $this->db->update('survey_questions', ['trash' => 1], "questionID = $question_id");
        return json_encode(['res' => 1, 'message' => 'Question Deleted!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function recoverQuestion(){
      $question_id = $_POST['question_id'];

      try {
        $result = $this->db->update('survey_questions', ['trash' => 0], "questionID = $question_id");
        return json_encode(['res' => 1, 'message' => 'Question Recovered!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function updateQuestion(){
      $question_id    = $_POST['question_id'];
      $question_desc   = $_POST['question_desc'];
      $question_other  = $_POST['question_other'];

      try {
        $result = $this->db->update('survey_questions', ['question' => $question_desc, 'hasOther' => $question_other], "questionID = $question_id");
        return json_encode(['res' => 1, 'message' => 'Question Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function addQuestion(){
      $question_desc   = $_POST['question_desc'];
      $question_other  = $_POST['question_other'];

      try {
        $result = $this->db->insert('survey_questions', ['questionID'   => null, 'question'  => $question_desc, 'hasOther'  => $question_other]);
        return json_encode(['res' => 1, 'message' => 'Question Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    // public function deletePayment(){
    //   $question_id = $_POST['question_id'];
    //
    //   try {
    //     $result = $this->db->update('survey_questions', ['trash' => 1], "questionID = $question_id");
    //     return json_encode(['res' => 1, 'message' => 'Question Deleted!']);
    //   } catch (PDOException $e) {
    //     return json_encode(['res' => 0, 'message' => $e->getMessage()]);
    //   }
    // }
    //
    // public function recoverPayment(){
    //   $question_id = $_POST['question_id'];
    //
    //   try {
    //     $result = $this->db->update('survey_questions', ['trash' => 0], "questionID = $question_id");
    //     return json_encode(['res' => 1, 'message' => 'Question Recovered!']);
    //   } catch (PDOException $e) {
    //     return json_encode(['res' => 0, 'message' => $e->getMessage()]);
    //   }
    // }
    //
    // public function updatePayment(){
    //   $question_id    = $_POST['question_id'];
    //   $question_desc   = $_POST['question_desc'];
    //   $question_other  = $_POST['question_other'];
    //
    //   try {
    //     $result = $this->db->update('survey_questions', ['question' => $question_desc, 'hasOther' => $question_other], "questionID = $question_id");
    //     return json_encode(['res' => 1, 'message' => 'Question Updated!']);
    //   } catch (PDOException $e) {
    //     return json_encode(['res' => 0, 'message' => $e->getMessage()]);
    //   }
    // }

    public function addPayment(){
      $desc   = $_POST['desc'];
      $image = $desc.'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);

      try {
        $result = $this->db->insert('payment_type', ['payment_type_id'   => null, 'description'  => $desc, 'image'  => $image]);
        move_uploaded_file($_FILES['img']['tmp_name'], "./public/img/".$image);
        return json_encode(['res' => 1, 'message' => 'Payment Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function deleteCourse(){
      $course_id = $_POST['course_id'];

      try {
        $result = $this->db->update('course', ['trash' => 1], "courseID = $course_id");
        return json_encode(['res' => 1, 'message' => 'Course Deleted!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }
    public function recoverCourse(){
      $cid = $_POST['cid'];

      try {
        $result = $this->db->update('course', ['trash' => 0], "courseID = $cid");
        return json_encode(['res' => 1, 'message' => 'Course Recovered!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function updateCourse(){
      $course_id      = $_POST['course_id'];
      $course_desc    = $_POST['course_desc'];
      $course_college = $_POST['course_college'];

      try {
        $result = $this->db->update('course', ['description' => $course_desc, 'collegeID' => $course_college], "courseID = $course_id");
        return json_encode(['res' => 1, 'message' => 'Course Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function addCourse(){
      $course_desc    = $_POST['course_desc'];
      $course_college = $_POST['course_college'];

      try {
        $result = $this->db->insert('course', ['courseID'     => null, 'description' => $course_desc, 'collegeID' => $course_college]);
        return json_encode(['res' => 1, 'message' => 'Course Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }


    public function deleteDoctype(){
      $doctype_id = $_POST['doctype_id'];

      try {
        $result = $this->db->update('document_type', ['trash' => 1], "classID = $doctype_id");
        return json_encode(['res' => 1, 'message' => 'Document Type Deleted!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function recoverDoctype(){
      $doctype_id = $_POST['doctype_id'];

      try {
        $result = $this->db->update('document_type', ['trash' => 0], "classID = $doctype_id");
        return json_encode(['res' => 1, 'message' => 'Document Type Recovered!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function updateDoctype(){
      $doctype_desc = $_POST['doctype_desc'];
      $doctype_id   = $_POST['doctype_id'];

      try {
        $result = $this->db->update('document_type', ['description' => $doctype_desc], "classID = $doctype_id");
        return json_encode(['res' => 1, 'message' => 'Document Type Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function addDoctype(){
      $doctype_desc = $_POST['doctype_desc'];

      try {
        $result = $this->db->insert('document_type', ['classID'     => null, 'description' => $doctype_desc]);
        return json_encode(['res' => 1, 'message' => 'Document Type Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }


    public function deleteDocument(){
      $documentID   = $_POST['did'];

      try {
        $result = $this->db->update('document', ['trash' => 1], "documentID = $documentID");
        return json_encode(['res' => 1, 'message' => 'Document Deleted!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function recoverDocument(){
      $documentID   = $_POST['did'];

      try {
        $result = $this->db->update('document', ['trash' => 0], "documentID = $documentID");
        return json_encode(['res' => 1, 'message' => 'Document Recovered!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function updateDocument(){
      $document_price         = $_POST['dprice'];
      $document_processtime   = $_POST['dprocesstime'];
      $document_type          = $_POST['dtype'];
      $document_graduate      = $_POST['dgraduate'];
      $document_desc          = $_POST['ddesc'];
      $document_reqs          = $_POST['dreqs'];
      $document_id            = $_POST['did'];

      $data = array(
        'price'           => $document_price,
        'processingTime'  => $document_processtime,
        'documentTypeID'  => $document_type,
        'graduate'        => $document_graduate,
        'description'     => $document_desc,
        'requirements'    => $document_reqs
      );
      $condition = "documentID = $document_id";
      try {
        $result = $this->db->update('document', $data, $condition);
        return json_encode(['res' => 1, 'message' => 'Document Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }
    public function addDocument(){
      $last = $this->db->prepare("SELECT MAX(documentID) + 1  FROM document");
      $last->execute();
      $latests = $last->fetchColumn();

      $data = array(
        'documentID'      => $latests,
        'price'           => $_POST['docPrice'],
        'processingTime'  => $_POST['docPT'],
        'documentTypeID'  => $_POST['docType'],
        'graduate'        => $_POST['docAvail'],
        'description'     => $_POST['docDesc'],
        'requirements'    => $_POST['docReq']
      );
      try {
        $result = $this->db->insert('document', $data);
        return json_encode(['res' => 1, 'message' => 'Document Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function recoverSubject(){
      $subject_code   = $_POST['recID'];

      try {
        $result = $this->db->update('subjects', ['trash' => 0], "subjectCode = '$subject_code'");
        return json_encode(['res' => 1, 'message' => 'Subject Recovered!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function deleteSubject(){
      $subject_code   = $_POST['ecode'];

      try {
        $result = $this->db->update('subjects', ['trash' => 1], "subjectCode = '$subject_code'");
        return json_encode(['res' => 1, 'message' => 'Subject Deleted!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function updateSubject(){
      $subject_code   = $_POST['ecode'];
      $subject_title  = $_POST['etitle'];
      $subject_credit = $_POST['ecredit'];

      try {
        $result = $this->db->update('subjects', ['title' => $subject_title, 'credits' => $subject_credit], "subjectCode = '$subject_code'");
        return json_encode(['res' => 1, 'message' => 'Subject Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function addSubject(){
      $subject_code   = $_POST['subject_code'];
      $subject_title  = $_POST['subject_title'];
      $subject_credit = $_POST['subject_credit'];

      try {
        $result = $this->db->insert('subjects', ['subjectCode' => $subject_code, 'title' => $subject_title, 'credits' => $subject_credit]);
        return json_encode(['res' => 1, 'message' => 'Subject Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function activateAccount(){
      $employee_id = $_POST['eid'];
      try {
        $result = $this->db->update('empaccount', ['isActive' => 1], "employeeID = $employee_id");
        return json_encode(['res' => 1, 'message' => 'Account Activated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function deleteEmployee(){
      $id = $_POST['eid'];

      try {
        $result = $this->db->update('empaccount', ['isActive' => 0], "employeeID = '$id'");
        return json_encode(['res' => 1, 'message' => 'Employee Deleted!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function updateEmployee(){
      $employee_id       = $_POST['employee_id'];
      $employee_fname    = $_POST['employee_fname'];
      $employee_mname    = $_POST['employee_mname'] == '' ? null : $_POST['employee_mname'];
      $employee_lname    = $_POST['employee_lname'];
      $employee_email    = $_POST['employee_email'];
      $employee_branch   = $_POST['employee_branch'];
      $employee_office   = $_POST['employee_office'];
      $employee_position = $_POST['employee_position'];
      $employee_utype    = $_POST['employee_utype'];

      $data = array(
        'employeeID'    => $employee_id,
        'fname'         => $employee_fname,
        'mname'         => $employee_mname,
        'lname'         => $employee_lname,
        'branchID'      => $employee_branch,
        'officeID'      => $employee_office,
        'position'      => $employee_position
      );
      $condition = "employeeID = '$employee_id'";
      try {
        $result = $this->db->update('employee', $data, $condition);
        $data = array(
          'employeeID'    => $employee_id,
          'email'         => $employee_email,
          'userType'      => $employee_utype
        );
        $condition = "employeeID = '$employee_id'";
        $result = $this->db->update('empaccount', $data, $condition);
        return json_encode(['res' => 1, 'message' => 'Employee Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function addEmployee(){
      $employee_id       = $_POST['employee_id'];
      $employee_fname    = $_POST['employee_fname'];
      $employee_mname    = $_POST['employee_mname'] == '' ? null : $_POST['employee_mname'];
      $employee_lname    = $_POST['employee_lname'];
      $employee_email    = $_POST['employee_email'];
      $employee_branch   = $_POST['employee_branch'];
      $employee_office   = $_POST['employee_office'];
      $employee_position = $_POST['employee_position'];
      $employee_utype    = $_POST['employee_utype'];
      $data = array(
        'employeeID'    => $employee_id,
        'fname'         => $employee_fname,
        'mname'         => $employee_mname,
        'lname'         => $employee_lname,
        'branchID'      => $employee_branch,
        'officeID'      => $employee_office,
        'position'      => $employee_position
      );

      try {
        $result = $this->db->insert('employee', $data);
        $data = array(
          'employeeID'    => $employee_id,
          'email'         => $employee_email,
          'password'      => $this->fn->encrypt($employee_id.$employee_lname),
          'userType'      => $employee_utype
        );
        $result = $this->db->insert('empaccount', $data);
        return json_encode(['res' => 1, 'message' => 'Employee Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function recoverOffice(){
      $id = $_POST['oid'];

      try {
        $data = array(
          'trash' => 0
        );
        $condition = "officeID = $id";
        $result = $this->db->update('offices', $data, $condition);
        return json_encode(['res' => 1, 'message' => 'Office Recovered!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function deleteOffice(){
      $id = $_POST['oid'];

      try {
        $data = array(
          'trash' => 1
        );
        $condition = "officeID = $id";
        $result = $this->db->update('offices', $data, $condition);
        return json_encode(['res' => 1, 'message' => 'Office Deleted!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function updateOffice(){
      $office_name = $_POST['oname'];
      $id = $_POST['oid'];

      try {
        $data = array(
          'name' => $office_name,
        );
        $condition = "officeID = $id";
        $result = $this->db->update('offices', $data, $condition);
        return json_encode(['res' => 1, 'message' => 'Office Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function addOffice(){
      $office_name = $_POST['office_name'];

      try {
        $data = array(
          'officeID' => null,
          'name'     => $office_name
        );
        $result = $this->db->insert('offices', $data);
        return json_encode(['res' => 1, 'message' => 'Office Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }



    public function deleteBranch(){
      $id = $_POST['bid'];

      try {
        $data = array(
          'trash' => 1
        );
        $condition = "branchID = $id";
        $result = $this->db->update('branches', $data, $condition);
        return json_encode(['res' => 1, 'message' => 'Branch Deleted!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }
    public function recoverBranch(){
      $id = $_POST['bid'];

      try {
        $data = array(
          'trash' => 0
        );
        $condition = "branchID = $id";
        $result = $this->db->update('branches', $data, $condition);
        return json_encode(['res' => 1, 'message' => 'Branch Recovered!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function updateBranch(){
      $branch_name = $_POST['bname'];
      $branch_acronym = $_POST['bacronym'];
      $director = $_POST['bdirector'];
      $id = $_POST['bid'];

      try {
        $data = array(
          'branchName'        => $branch_name,
          'acronym'           => $branch_acronym,
          'directorFullName'  => $director
        );
        $condition = "branchID = $id";
        $result = $this->db->update('branches', $data, $condition);
        return json_encode(['res' => 1, 'message' => 'Branch Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function addBranch(){
      $branch_name = $_POST['branch_name'];
      $branch_acronym = $_POST['branch_acronym'];
      $director = $_POST['director'];

      try {
        $data = array(
          'branchID'          => null,
          'branchName'        => $branch_name,
          'acronym'           => $branch_acronym,
          'directorFullName'  => $director
        );
        $result = $this->db->insert('branches', $data);
        return json_encode(['res' => 1, 'message' => 'Branch Added!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function documents(){

      $documents = array();

      $data       = array('*');
      $condition  = 'trash = 0';
      $docs       = $this->db->select('document', $data, $condition);

      foreach ($docs as $key => $doc) {
        $data       = array('description');
        $condition  = "classID = ".$doc['documentTypeID'];
        $docType    = $this->db->select('document_type', $data, $condition)[0]['description'];
        $docs[$key]['documentType'] = $docType;
      }

      $data       = array('*');
      $condition  = '1';
      $doctype       = $this->db->select('document_type', $data, $condition);

      $documents['info'] = $docs;
      $documents['doctype'] = $doctype;

      return $documents;
    }
    public function documentTrash(){

      $documents = array();

      $data       = array('*');
      $condition  = 'trash = 1';
      $docs       = $this->db->select('document', $data, $condition);

      foreach ($docs as $key => $doc) {
        $data       = array('description');
        $condition  = "classID = ".$doc['documentTypeID'];
        $docType    = $this->db->select('document_type', $data, $condition)[0]['description'];
        $docs[$key]['documentType'] = $docType;
      }

      $data       = array('*');
      $condition  = '1';
      $doctype       = $this->db->select('document_type', $data, $condition);

      $documents['info'] = $docs;
      $documents['doctype'] = $doctype;

      return $documents;
    }

    public function document_types(){
      $data       = array('*');
      $condition  = 'trash = 0';
      $doctypes   = $this->db->select('document_type', $data, $condition);

      return $doctypes;
    }

    public function doctypeTrash(){
      $data       = array('*');
      $condition  = 'trash = 1';
      $doctypes   = $this->db->select('document_type', $data, $condition);

      return $doctypes;
    }

    public function payments(){
      $data       = array('*');
      $condition  = 'enabled = 1';
      $payments   = $this->db->select('payment_type', $data, $condition);

      return $payments;
    }

    public function paymentsTrash(){
      $data       = array('*');
      $condition  = 'enabled = 0';
      $payments   = $this->db->select('payment_type', $data, $condition);

      return $payments;
    }

    public function questions(){
      $data       = array('*');
      $condition  = 'trash = 0';
      $questions  = $this->db->select('survey_questions', $data, $condition);

      return $questions;
    }
    public function questionTrash(){
      $data       = array('*');
      $condition  = 'trash = 1';
      $questions  = $this->db->select('survey_questions', $data, $condition);

      return $questions;
    }

    public function choices($id){

      $info = array();
      $data       = array('*');
      $condition  = "trash = 0 AND questionID = $id";
      $choices  = $this->db->select('survey_choices', $data, $condition);

      $data       = array('*');
      $condition  = "questionID = $id";
      $question  = $this->db->select('survey_questions', $data, $condition)[0];

      $info['choices'] = $choices;
      $info['question'] = $question;
      return $info;
    }

    public function choiceTrash(){

      $info = array();
      $data       = array('*');
      $condition  = "trash = 1";
      $choices  = $this->db->select('survey_choices', $data, $condition);


      $info['choices'] = $choices;
      return $info;
    }

    public function courses(){
      $tables = [
        ['course' => ['*']],
        ['college' => ['acronym']]
      ];
      $keys = [
        'collegeID' => [
          'course',
          'college'
        ]
      ];
      $condition  = 'course.trash = 0';
      $courses   = $this->db->inner_join($tables, $keys, $condition);
      $colleges = $this->db->select('college', ['collegeID', 'acronym'], '1');
      return ['courses' => $courses, 'colleges' => $colleges];
    }
    public function courseTrash(){
      $data       = array('*');
      $condition  = 'trash = 1';
      $courseTrash   = $this->db->select('course', $data, $condition);

      return $courseTrash;
    }

    public function offices(){
      if (isset($_POST['fetch'])) {

        $output = array();
        $data       = array('*');
        $condition  = 'trash = 0';
      	if(isset($_POST["search"]["value"]))
      	{
      		$condition .= ' AND name LIKE "%'.$_POST["search"]["value"].'%" ';
      	}
      	if(isset($_POST["order"]))
      	{
      		$condition .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
      	}
      	else
      	{
      		$condition .= 'ORDER BY officeID ASC ';
      	}
      	if($_POST["length"] != -1)
      	{
      		$condition .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
      	}
        $offices    = $this->db->select('offices', $data, $condition);


      	$data = array();
      	foreach($offices as $office)
      	{
      		$sub_array = array();
          $sub_array[] = $office['officeID'];
          $sub_array[] = $office['name'];
      		$sub_array[] = "
          <button type='button' class='btn btn-primary' id='editOffice'>
            <span class='fa fa-edit'></span>
            <input type='hidden' id='oname' value='".$office['name']."'>
            <input type='hidden' id='oid' value='".$office['officeID']."'>
          </button>
          <button type='button' class='btn btn-danger deleteOffice'>
            <span class='fa fa-trash-o'></span>
            <input type='hidden' id='oid' value='".$office['officeID']."'>
          </button>";
      	$data[] = $sub_array;
      }
      $output = array(
      "draw"				    =>	intval($_POST["draw"]),
      "recordsTotal"		=> 	count($offices),
      "recordsFiltered"	=>	count($offices),
      "data"				=>	$data
      );
      return json_encode($output);
      }
    }


    public function officeTrash(){
      if (isset($_POST['fetch'])) {

        $output = array();
        $data       = array('*');
        $condition  = 'trash = 1';
      	if(isset($_POST["search"]["value"]))
      	{
      		$condition .= ' AND name LIKE "%'.$_POST["search"]["value"].'%" ';
      	}
      	if(isset($_POST["order"]))
      	{
      		$condition .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
      	}
      	else
      	{
      		$condition .= 'ORDER BY officeID ASC ';
      	}
      	if($_POST["length"] != -1)
      	{
      		$condition .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
      	}
        $offices    = $this->db->select('offices', $data, $condition);


      	$data = array();
      	foreach($offices as $office)
      	{
      		$sub_array = array();
          $sub_array[] = $office['officeID'];
          $sub_array[] = $office['name'];
      		$sub_array[] = "
          <button type='button' class='btn btn-success recoverOffice'>
            <span class='fa fa-repeat'></span>
            <input type='hidden' id='oid' value='".$office['officeID']."'>
          </button>";
      	$data[] = $sub_array;
      }
      $output = array(
      "draw"				    =>	intval($_POST["draw"]),
      "recordsTotal"		=> 	count($offices),
      "recordsFiltered"	=>	count($offices),
      "data"				=>	$data
      );
      return json_encode($output);
      }
    }

    public function subjects(){
      $data       = array('*');
      $condition  = 'trash = 0';
      $subjects   = $this->db->select('subjects', $data, $condition);

      return $subjects;
    }

    public function subjectTrash(){
      $data       = array('*');
      $condition  = 'trash = 1';
      $subjectTrashs   = $this->db->select('subjects', $data, $condition);

      return $subjectTrashs;
    }

    public function employees(){

      $employee = array();

      $data        = array('email', 'employeeID', 'userType');
      $condition   = 'isActive = 1';
      $empaccounts = $this->db->select('empaccount', $data, $condition);

      foreach ($empaccounts as $empaccount) {
        $id = $empaccount['employeeID'];
        $data        = array('fname', 'lname', 'mname', 'branchID', 'officeID', 'position');
        $condition   = "employeeID = '$id'";
        $empinfos    = $this->db->select('employee', $data, $condition)[0];

        $branchid    = $empinfos['branchID'];
        $data        = array('branchName');
        $condition   = "branchID = $branchid";
        $branch      = $this->db->select('branches', $data, $condition)[0];

        $officeid    = $empinfos['officeID'];
        $data        = array('name');
        $condition   = "officeID = $officeid";
        $office      = $this->db->select('offices', $data, $condition)[0];


        $employee['info'][] = [
          'id'        => $empaccount['employeeID'],
          'email'     => $empaccount['email'],
          'usertype'  => $this->fn->convert_usertypeID($empaccount['userType']),
          'fname'     => $empinfos['fname'],
          'lname'     => $empinfos['lname'],
          'mname'     => $empinfos['mname'],
          'branch'    => $branch['branchName'],
          'office'    => $office['name'],
          'branchid'  => $empinfos['branchID'],
          'officeid'  => $empinfos['officeID'],
          'utypeid'   => $empaccount['userType'],
          'position'  => $empinfos['position']
        ];
      }
      $data        = array('branchID', 'branchName');
      $condition   = "trash = 0";
      $branches    = $this->db->select('branches', $data, $condition);
      $employee['branches'] = $branches;

      $data        = array('officeID', 'name');
      $condition   = "trash = 0";
      $offices     = $this->db->select('offices', $data, $condition);
      $employee['offices'] = $offices;

      return $employee;
    }

    public function employeeTrash(){
      $employee = array();

      $data        = array('email', 'employeeID', 'userType');
      $condition   = 'isActive = 0';
      $empaccounts = $this->db->select('empaccount', $data, $condition);

      foreach ($empaccounts as $empaccount) {
        $id = $empaccount['employeeID'];
        $data        = array('fname', 'lname', 'mname', 'branchID', 'officeID', 'position');
        $condition   = "employeeID = '$id'";
        $empinfos    = $this->db->select('employee', $data, $condition)[0];

        $branchid    = $empinfos['branchID'];
        $data        = array('branchName');
        $condition   = "branchID = $branchid";
        $branch      = $this->db->select('branches', $data, $condition)[0];

        $officeid    = $empinfos['officeID'];
        $data        = array('name');
        $condition   = "officeID = $officeid";
        $office      = $this->db->select('offices', $data, $condition)[0];

        $employee[] = [
          'id'        => $empaccount['employeeID'],
          'email'     => $empaccount['email'],
          'usertype'  => $this->fn->convert_usertypeID($empaccount['userType']),
          'fname'     => $empinfos['fname'],
          'lname'     => $empinfos['lname'],
          'mname'     => $empinfos['mname'],
          'branch'    => $branch['branchName'],
          'office'    => $office['name'],
          'branchid'  => $empinfos['branchID'],
          'officeid'  => $empinfos['officeID'],
          'utypeid'   => $empaccount['userType'],
          'position'  => $empinfos['position']
        ];
      }

      return $employee;
    }

    public function branch_info(){
      $data       = array('branchID', 'branchName', 'acronym', 'directorFullName');
      $condition  = 'trash != 1';
      $branches   = $this->db->select('branches', $data, $condition);

      return $branches;
    }
    public function branchTrash(){
      $data       = array('branchID', 'branchName', 'acronym', 'directorFullName');
      $condition  = 'trash != 0';
      $branches   = $this->db->select('branches', $data, $condition);

      return $branches;
    }
    public function getReports(){
      // $data       = array('branchID', 'branchName', 'acronym', 'directorFullName');
      // $condition  = 'trash != 0';
      // $branches   = $this->db->select('branches', $data, $condition);

      return true;
    }

  }
