<?php
  /**
   *
   */
  class Registrar_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function getPayments(){
      return $this->db->select('payment_type', ['*'], "enabled = 1");
    }

    public function requestsChanges(){
      $requests =  $this->db->select('requests_controller', ['controlNumber', 'dateFinished', 'status'], '1');
      foreach ($requests as $key => $value) {
        if ($value['dateFinished'] != null) {
          $requests[$key]['dateFinished']     = date('M d, Y', strtotime(explode(" ", $value['dateFinished'])[0]));
        } else {
          $requests[$key]['dateFinished']     = " ";
        }
        $requests[$key]['status']        = $this->fn->request_status($value['status']);
        switch ($value['status']) {
          case 0:
          $requests[$key]['action']   = "<button rel='".$value['controlNumber']."' class='btn btn-danger payment'>Payment</button>";
          break;
          case 1:
          $requests[$key]['action']   = "<button rel='".$value['controlNumber']."' class='btn btn-secondary updates'>Updates</button>";
          break;
          case 2:
          $requests[$key]['action']   = "<button rel='".$value['controlNumber']."' class='btn btn-info claim'>Claim</button> <button rel='".$value['controlNumber']."' class='btn btn-secondary updates'>Updates</button>";
          break;
          case 3:
          $requests[$key]['action']   = " ";
          break;
        case 4:
        $request[]   = " ";
        break;
        case 5:
        $request[]   = "<button rel='".$value['controlNumber']."' class='btn btn-secondary updates'>Updates</button>";
        break;
        }
      }
      return $requests;
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

      return json_encode($data);
    }

    public function printDocument($documentNumber){
      $documentID    = explode("_", $documentNumber)[0];
      $studentNumber = explode("_", $documentNumber)[1];
      $requestID     = explode("_", $documentNumber)[2];
      date_default_timezone_set('Asia/Manila');

      switch ($documentID) {
        case 12:
          $data = array('fname', 'lname', 'mname', 'suffix', 'courseID', 'branchID', 'diplomaNumber');
          $condition = "studentNumber = '$studentNumber'";
          $studentInfo = $this->db->select('students', $data, $condition)[0];

          $courseID = $studentInfo['courseID'];
          $data = array('description');
          $condition = "courseID = $courseID";
          $course = $this->db->select('course', $data, $condition)[0]['description'];

          $branchID = $studentInfo['branchID'];
          $data = array('branchName');
          $condition = "branchID = $branchID";
          $branch = $this->db->select('branches', $data, $condition)[0]['branchName'];

          $data = array('dateGraduated');
          $condition = "studentNumber = '$studentNumber'";
          $dateGraduated = $this->db->select('educational_background', $data, $condition)[0]['dateGraduated'];
          $month  = $this->fn->date_to_filipino($dateGraduated)['month'];
          $day    = $this->fn->date_to_filipino($dateGraduated)['day'];
          $year   = $this->fn->date_to_filipino($dateGraduated)['year'];

          $diplomaData['name']    = $this->fn->name_format($studentInfo['fname'], $studentInfo['lname'], $studentInfo['mname'], false, $studentInfo['suffix']);
          $diplomaData['branch']  = $branch;
          $diplomaData['course']  = $course;
          $diplomaData['day']     = $day;
          $diplomaData['month']   = $month;
          $diplomaData['year']    = $year;
          $diplomaData['reqID']   = $requestID;
          $diplomaData['diplomaNumber']   = $studentInfo['diplomaNumber'];


          $this->fn->createDiploma($diplomaData);
          break;
        case 13:
          $torInfo = array();

          $data = array('controlNumber');
          $condition = "studentNumber = '$studentNumber'";
          $controlNumber = $this->db->select('requests_controller', $data, $condition)[0]['controlNumber'];

          $data = array('lname', 'fname', 'mname', 'suffix', 'permanentAddress', 'entranceCredentials', 'courseID', 'branchID');
          $condition = "studentNumber = '$studentNumber'";
          $studentInfo = $this->db->select('students', $data, $condition)[0];

          $branchID = $studentInfo['branchID'];
          $data = array('branchName', 'directorFullName');
          $condition = "branchID = $branchID";
          $branchinfo = $this->db->select('branches', $data, $condition)[0];
          $branch = $branchinfo['branchName'];
          $branchDir = $branchinfo['directorFullName'];

          $data = array('yearAdmitted', 'elementarySchoolName', 'esYearGraduated', 'highSchoolName', 'hsYearGraduated', 'dateGraduated', 'numofSem', 'numofSummer');
          $condition = "studentNumber = '$studentNumber'";
          $educBackground = $this->db->select('educational_background', $data, $condition)[0];

          $courseID = $studentInfo['courseID'];
          $data = array('description');
          $condition = "courseID = $courseID";
          $course = $this->db->select('course', $data, $condition)[0]['description'];


          $torInfo['info']['studentNumber'] = $studentNumber;
          $torInfo['info']['name']          = $this->fn->name_format($studentInfo['fname'], $studentInfo['lname'], $studentInfo['mname'], false, $studentInfo['suffix']);
          $torInfo['info']['address']       = $studentInfo['permanentAddress'];
          $torInfo['info']['yearAdmitted']  = $educBackground['yearAdmitted'];
          $torInfo['info']['entranceCredentials']  = $studentInfo['entranceCredentials'];
          $torInfo['info']['eschool']       = $educBackground['elementarySchoolName'];
          $torInfo['info']['egraduated']    = $educBackground['esYearGraduated'];
          $torInfo['info']['hschool']       = $educBackground['highSchoolName'];
          $torInfo['info']['hgraduated']    = $educBackground['hsYearGraduated'];
          $torInfo['info']['course']        = $course;
          $torInfo['info']['dateGraduated'] = date_format(date_create($educBackground['dateGraduated']), 'F d, Y');
          $torInfo['info']['numsem']        = $educBackground['numofSem'];
          $torInfo['info']['numsum']        = $educBackground['numofSummer'];
          $torInfo['info']['branch']        = $branch;
          $torInfo['info']['branchdir']     = $branchDir;
          $torInfo['info']['preparedBy']    = Session::get('fname').' '.Session::get('mname')[0].'. '.Session::get('lname');
          $torInfo['info']['reqID']         = $requestID;

          $data = array('subjectCode', 'grade', 'sem', 'schoolYear');
          $condition = "studentNumber = '$studentNumber'";
          $subjects = $this->db->select('enrolled', $data, $condition);


          $subjecInfo = array();
          foreach ($subjects as $value) {
            $subjecCode = $value['subjectCode'];
            $data = array('title', 'credits');
            $condition = "subjectCode = '$subjecCode'";
            $subDesc = $this->db->select('subjects', $data, $condition)[0];

            // $subjecInfo[]['sem'] = $value['schoolyrFrom'].'-'.$value['schoolyrTo'].', '.$this->fn->sem($value['sem']);
            $subjecInfo[$value['schoolYear'].', '.$this->fn->sem($value['sem'])][] = [
              'code'         => $subjecCode,
              'description' => $subDesc['title'],
              'grades'      => $value['grade'],
              'credits'     => $subDesc['credits']
            ];
          }

          $torInfo['subjects'] = $subjecInfo;
          $this->fn->createTOR($torInfo);
          break;
      }

      try {

            $data = array(
            'printedBy' => Session::get('empID'),
            'status'    => 1,
            'datePrinted' => date("Y-m-d h:i:s")
            );
        $condition = "requestID = $requestID";
        $result = $this->db->update('request', $data, $condition);

        return true;
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }


    public function recievePayment(){
      try {
        $controlNumber = $_POST['control'];
        $datepay = $_POST['datepay'];
        $reciept = $_POST['reciept'];
        $type = $_POST['type'];

        $data = array(
          'orNumber' => $reciept,
          'controlNumber' => $controlNumber,
          'datePaid' => $datepay,
          'type' => 1,
          'payment_type_id' => $type,
          'status' => 1
        );

        $result = $this->db->insert('payments', $data);


        $data = array(
          'status' => 1
        );
        $condition = "controlNumber = '$controlNumber'";
        $result = $this->db->update('requests_controller', $data, $condition);

        return true;
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }
    public function markAsPrinted(){
      $requestID = $_POST['reqID'];
      try {
            $data = array(
            'printedBy' => Session::get('empID'),
            'status'    => 1,
            'datePrinted' => date("Y-m-d h:i:s")
            );
        $condition = "requestID = $requestID";
        $result = $this->db->update('request', $data, $condition);

        return true;
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }

    }
    public function validateDocument(){

      try {
        $requestID = $_POST['requestID'];
        $controlNumber = $_POST['controlNumber'];
        $data = array(
          'status' => 2
        );
        $condition = "requestID = '$requestID'";
        $result = $this->db->update('request', $data, $condition);
        if($result){
         $data = array('status');
         $condition = "controlNumber = '$controlNumber'";
         $check = $this->db->select('request', $data, $condition);
         $checker = 0;
         foreach ($check as $val) {
            if ($val['status'] != 2) {
             $checker = $checker + 1;
            }
         }

         if ($checker == 0) {
           $data = array(
             'status' => 2
           );
           $condition = "controlNumber = '$controlNumber'";
           $result2 = $this->db->update('requests_controller', $data, $condition);

           $eventName = implode('_', explode('-', $controlNumber))."_FORFEIT_REQUEST";
           $result = $this->db->query("
           CREATE EVENT ".$eventName." ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL ".$GLOBALS['FORFEITION_NUM']." ".$GLOBALS['FORFEITION_TYPE']." DO
           UPDATE requests_controller SET status = 5 WHERE controlNumber = '$controlNumber'
           ");
          }
          return true;
        }


      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }

    }

    public function claimDocument(){
      try {
        $controlNumber = $_POST['controlNumber'];
        $data = array(
          'status' => 3,
          'dateFinished' => date("Y-m-d h:i:s")
        );
        $condition = "controlNumber = '$controlNumber'";
        $result = $this->db->update('requests_controller', $data, $condition);
        $studentNum = Session::get('studentNumber');


        return json_encode(['res' => 1, 'message' => "Request Updated!"]);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function view($controlNumber){
      $data = array('document_documentID', 'quantity', 'status', 'requestID', 'datePrinted');
      $condition = "controlNumber = '$controlNumber'";
      $documents = $this->db->select('request', $data, $condition);

      $data = array('studentNumber', 'dateFiled', 'status', 'isFastLane', 'purpose', 'expectedDueDate', 'dateFinished');
      $condition = "controlNumber = '$controlNumber'";
      $request = $this->db->select('requests_controller', $data, $condition)[0];
      $studentNumber = $request['studentNumber'];
      $purpose = $request['purpose'];
      $stats = $request['status'];
      $fast = $request['isFastLane'];
      $exDate = $request['expectedDueDate'];
      $dateFinished = $request['dateFinished'];
      $dateFiled = date('F d, Y', strtotime(explode(" ", $request['dateFiled'])[0]));

      $data = array('fname', 'lname', 'mname', 'suffix', 'courseID','diplomaNumber');
      $condition = "studentNumber = '$studentNumber'";
      $student = $this->db->select('students', $data, $condition)[0];

      $studentName = $this->fn->name_format($student['fname'], $student['lname'], $student['mname'], true, $student['suffix']);

      $courseID = $student['courseID'];
      $data = array('description');
      $condition = "courseID = '$courseID'";
      $courseDescription = $this->db->select('course', $data, $condition)[0]['description'];

      $document = array();
      $info = array();
      foreach ($documents as $value) {
        $documentID = $value['document_documentID'];
        $requestID  = $value['requestID'];
        $data = array('description','isGen');
        $condition = "documentID = $documentID";
        $documentDescription = $this->db->select('document', $data, $condition)[0];
        $isGen = $documentDescription['isGen'];

        $pstatus =  $value['status'];
        $document['description'] = $documentDescription['description'];
        $document['quantity']    = $value['quantity'];
        $document['status']      = $this->fn->document_status($pstatus);
        if ($value['datePrinted'] != null) {
          $document['datePrinted'] = date('M d, Y', strtotime(explode(" ", $value['datePrinted'])[0]));
        }else {
          $document['datePrinted'] = " ";
        }

        if ($stats > 0 && $pstatus == 0 ) {
          $document['action']      = "<button class='btn btn-primary printDocument' rel='".$isGen."'><input type='hidden' id='docID' value='".$documentID."'><input type='hidden' id='reqID' value='".$requestID."'><input type='hidden' id='studentNumber' value='".$studentNumber."'>Print</button>";
        }elseif ($stats > 0 && $pstatus > 0 ) {
          $document['action']      = "<button class='btn btn-primary printDocument' rel='".$isGen."'><input type='hidden' id='docID' value='".$documentID."'><input type='hidden' id='reqID' value='".$requestID."'><input type='hidden' id='studentNumber' value='".$studentNumber."'>Print</button> <button id='".$controlNumber."' rel='".$requestID."' class='btn btn-danger validate'>Validate</button>";
        }else {
          $document['action']      = " ";
        }
        $info['documents'][]     = $document;
      }
      $info['details']['controlNumber'] = $controlNumber;
      $info['details']['name']          = $studentName;
      $info['details']['course']        = $courseDescription;
      $info['details']['dateFiled']     = $dateFiled;
      $info['details']['status']        = $this->fn->request_status($stats);
      $info['details']['fastlane']      = $this->fn->request_is_fastlane($fast);
      $info['details']['purpose']      = $purpose;
      $info['details']['diplomaNumber']      = $student['diplomaNumber'];

      if ($exDate != null) {
        $info['details']['exRelease'] = date('F d, Y', strtotime(explode(" ", $exDate)[0]));
      }else {
        $info['details']['exRelease'] = " ";
      }
      if ($dateFinished != null) {
        $info['details']['dateFinished'] = date('F d, Y', strtotime(explode(" ", $dateFinished)[0]));
      }else {
        $info['details']['dateFinished'] = " ";
      }
      return $info;
    }

  public function requests(){
    if (isset($_POST['fetch'])) {
      $output = array();
      $condition  = '1';
      if (isset($_POST['status'])) {
        $condition = 'requests_controller.status = '.$_POST['status'];
      }
      if(isset($_POST["search"]["value"]))
      {
        $condition .= ' AND students.mname LIKE "%'.$_POST["search"]["value"].'%" OR students.fname LIKE "%'.$_POST["search"]["value"].'%" OR students.lname LIKE "%'.$_POST["search"]["value"].'%"';
        $condition .= ' OR students.suffix LIKE "%'.$_POST["search"]["value"].'%" OR requests_controller.controlNumber LIKE "%'.$_POST["search"]["value"].'%" ';
      }
      if(isset($_POST["order"]))
      {
        $condition .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
      }
      else
      {
        $condition .= 'ORDER BY requests_controller.expectedDueDate ASC, requests_controller.isFastLane ASC, requests_controller.status ASC ';
      }
      if($_POST["length"] != -1)
      {
        $condition .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
      }
      $tables = [
        ['requests_controller' => ['controlNumber', 'dateFiled', 'expectedDueDate', 'dateFinished', 'isFastLane', 'status']],
        ['students' => ['fname', 'lname', 'mname', 'suffix', 'courseID', 'email']]
      ];
      $keys = [
        'studentNumber' => ['requests_controller', 'students']
      ];
      $requests    = $this->db->inner_join($tables, $keys, $condition);


      $data = array();
      foreach($requests as $value)
      {
        $request = array();

        $request[] = $value['controlNumber'];
        $request[] = $this->fn->request_is_fastlane($value['isFastLane']);
        $request[] = $this->fn->name_format($value['fname'], $value['lname'], $value['mname'], true, $value['suffix']);
        $request[] = date('M d, Y', strtotime(explode(" ", $value['dateFiled'])[0]));
        $request[] = date('M d, Y', strtotime(explode(" ", $value['expectedDueDate'])[0]));
        if ($value['dateFinished'] != null) {
          $request[]     = "<span id='".$value['controlNumber']."_dateFinished'>".date('M d, Y', strtotime(explode(" ", $value['dateFinished'])[0]))."</span>";
        } else {
          $request[]     = "<span id='".$value['controlNumber']."_dateFinished'> </span>";
        }
        $request[]        = "<span id='".$value['controlNumber']."_status'>".$this->fn->request_status($value['status'])."</span>";
        // $request['linkRel']        = URL."registrar/view/".$value['controlNumber'];
        switch ($value['status']) {
          case 0:
            $request[]   = "<span id='".$value['controlNumber']."_action'><button rel='".$value['controlNumber']."' class='btn btn-danger payment'>Payment</button></span>";
            break;
          case 1:
              $request[]   = "<span id='".$value['controlNumber']."_action'><button rel='".$value['controlNumber']."' class='btn btn-secondary updates'>Updates</button></span>";
              break;
          case 2:
            $request[]   = "<span id='".$value['controlNumber']."_action'><button rel='".$value['controlNumber']."' class='btn btn-info claim'>Claim</button> <button rel='".$value['controlNumber']."' class='btn btn-secondary updates'>Updates</button></span>";
            break;
          case 3:
            $request[]   = "<span id='".$value['controlNumber']."_action'> </span>";
            break;
          case 4:
          $request[]   = "<span id='".$value['controlNumber']."_action'> </span>";
          break;
          case 5:
          $request[]   = "<span id='".$value['controlNumber']."_action'><button rel='".$value['controlNumber']."' class='btn btn-secondary updates'>Updates</button></span>";
          break;
        }
        $data[]                   = $request;
      }
      $output = array(
      "draw"				    =>	intval($_POST["draw"]),
      "recordsTotal"		=> 	count($requests),
      "recordsFiltered"	=>	count($requests),
      "data"				=>	$data
      );
      return json_encode($output);
    }
    }

    public function acceptPayment(){
      $control = $_POST['control'];
      date_default_timezone_set('Asia/Manila');


      $data = array(
        'status' => 1
      );
      $condition = "controlNumber = '$control'";
      $result = $this->db->update('payments', $data, $condition);

      $data2 = array(
        'status' => 2,
        'updated_at' => date("Y-m-d h:i:s")
      );
      $condition = "verControllerID = '$control'";
      $result2 = $this->db->update('verifications_controller', $data2, $condition);

      if ($result == true && $result2 == true ) {
        return true;
      }else {
        return false;
      }

    }

    public function declinePayment(){
      $control = $_POST['controlID'];
      $repName = $_POST['repName'];
      $repEmail = $_POST['repEmail'];
      $reason = $_POST['reason'];
      date_default_timezone_set('Asia/Manila');

      $data = array('fileName');
      $file = $this->db->select('payments', $data, "controlNumber = '$control'")[0];

      $info = array(
        'controlID' => $control,
        'repName' => $repName,
        'repEmail' => $repEmail,
        'reason' => $reason,
        'filename' => $file['fileName']
      );

      if ($this->fn->is_connected()) {
        try {
          $mail = $this->fn->sendDeclineEmail($info);
          if ($mail['res']) {

            $data = array(
              'status' => 0
            );
            $condition = "controlNumber = '$control'";
            $result = $this->db->update('payments', $data, $condition);

            $data2 = array(
              'status' => 0,
              'updated_at' => date("Y-m-d h:i:s")
            );
            $condition = "verControllerID = '$control'";
            $result2 = $this->db->update('verifications_controller', $data2, $condition);

            return json_encode(['message' => $mail['msg'], 'res' => 1]);
          }
        } catch (PDOException $e) {
          return json_encode(['message' => $e.getMessage(), 'res' => 0]);
        }
      }else {
        return json_encode(['message' => 'Please make sure you are connected to the network', 'res' => 2]);
      }

    }

    public function verifications(){

      $vDisplay = array();
      $verification = array();

      $verif = $this->db->prepare("SELECT a.*,b.firstName,b.middleName,b.lastName,b.suffix,c.companyName FROM verifications_controller as a INNER JOIN representatives as b ON a.repID = b.repID INNER JOIN company as c ON b.companyID = c.companyID WHERE deleted_at IS NULL ");
      $verif->execute();
      $verifications = $verif->fetchAll();

      foreach ($verifications as $value) {

        $vDisplay['verControllerID'] = $value['verControllerID'];
        $vDisplay['companyName']    = $value['companyName'];
        $vDisplay['representative'] = $this->fn->name_format($value['firstName'], $value['lastName'], $value['middleName'], true, $value['suffix']);
        $vDisplay['created_on']     = date('M d, Y', strtotime(explode(" ", $value['created_on'])[0]));
        $vDisplay['dateFinished']   = $value['dateFinished'] != null ? date('M d, Y', strtotime(explode(" ", $value['dateFinished'])[0])) : ' ';
        $vDisplay['status']         = $this->fn->verify_status($value['status']);
        $vDisplay['linkRel']        = URL."registrar/show/".$value['verControllerID'];
        switch ($value['status']) {
          case 0:
            $vDisplay['action']   = " ";
            break;
          case 1:
            $vDisplay['action']   = "<button rel='".$value['verControllerID']."' class='btn btn-danger approveBtn'>Approval</button>";
            break;
          case 2:
            $vDisplay['action']   = " ";
            break;
          case 3:
            $vDisplay['action']   = "<button rel='".$value['verControllerID']."' class='btn btn-warning verifyBtn'><span class='fa fa-envelope'></span> Send</button>";
            break;
        }
        $verification[]                   = $vDisplay;
      }
    return $verification;
  }

public function showPayment(){
   $control = $_POST['control'];

   $payment = array();
   $payments = array();

   $verif = $this->db->prepare("SELECT * FROM payments WHERE controlNumber = '$control' AND created_on = (select max(created_on) from payments where controlNumber = '$control')");
   $verif->execute();
   $payment = $verif->fetch();

   $payments['fileName'] = $payment['fileName'];
   $payments['type'] = $payment['type'];
   $payments['created'] = date_format(date_create(explode(" ", $payment['created_on'])[0]), 'F d, Y').' '.date('h:i a', strtotime(explode(" ", $payment['created_on'])[1]));
   $payments['reciept'] = $payment['orNumber'];
   $payments['currency'] = $payment['currency'];

   $rep = $this->db->prepare("SELECT a.email, a.firstName, a.middleName, a.lastName, a.repID, b.repID FROM representatives a inner join verifications_controller b on a.repID = b.repID WHERE verControllerID = '$control'");
   $rep->execute();
   $reps = $rep->fetch();
   $payments['repname'] = $reps['lastName'].', '.$reps['firstName'].' '.$reps['middleName'];
   $payments['repemail'] = $reps['email'];

   return $payments;
 }

 public function showForVerification(){
    $control = $_POST['control'];
    $info = array();
    $data = array('repID');
    $condition = "verControllerID = '$control'";
    $company = $this->db->select('verifications_controller', $data, $condition)[0];

    $rep = $company['repID'];

    $data = array('firstName','middleName','lastName', 'suffix','email');
    $condition = "repID = '$rep'";
    $representative = $this->db->select('representatives', $data, $condition)[0];


    $info['details']['repName'] = $this->fn->name_format($representative['firstName'], $representative['lastName'], $representative['middleName'], true, $representative['suffix']);
    $info['details']['email'] = $representative['email'];
    $info['details']['control'] = $control;

    $ver = array();
    $data = array('*');
    $condition = "verControllerID = '$control'";
    $verRequest = $this->db->select('verifications', $data, $condition);

    foreach ($verRequest as $value) {
      $ver['fileName'] = $value['fileName'];
      $ver['verificationID'] = $value['verificationID'];
      $ver['result'] = $this->fn->convert_result($value['result']);

      $info['info'][] = $ver;
    }




    return $info;
  }

  public function show($controlNumber){
    $data = array('verControllerID','repID','created_on','status');
    $condition = "verControllerID = '$controlNumber'";
    $verifications = $this->db->select('verifications_controller', $data, $condition)[0];
    $status = $verifications['status'];
    $representativeID = $verifications['repID'];
    $dateFiled = date_format(date_create(explode(" ", $verifications['created_on'])[0]), 'F d, Y');


    $data = array('companyID','firstName','middleName', 'lastName', 'suffix', 'email');
    $condition = "repID = '$representativeID'";
    $request = $this->db->select('representatives', $data, $condition)[0];
    $repName = $this->fn->name_format($request['firstName'], $request['lastName'], $request['middleName'], true, $request['suffix']);
    $compID = $request['companyID'];
    $email = $request['email'];

    $data = array('*');
    $condition = "companyID = '$compID'";
    $company = $this->db->select('company', $data, $condition)[0];

    $companyName = $company['companyName'];
    $companyAddress1 = $this->fn->address_format($company['addressNumber'], $company['addressSt'], $company['addressBrgy'], $company['addressCity'], $company['addressRegion'], $company['addressCountry'], $company['postalOrZipCode']);


    $verify = array();
    $verifyList = array();
    $info = array();



    $data = $this->db->prepare("SELECT a.*,b.status FROM verifications as a INNER JOIN verifications_controller as b on a.verControllerID = b.verControllerID WHERE b.verControllerID = '$controlNumber'");
    $data->execute();
    $verify = $data->fetchAll();

    foreach ($verify as $key => $value) {
     $verifyList['docType'] = $this->fn->convert_docID($value['docType']);
     $verifyList['fileName'] =$value['fileName'];
     $verifyList['result'] =  $this->fn->convert_result($value['result']);

     switch ($value['status']) {
       case 0:
        $verifyList['action'] = "<button rel='".$value['docType']."' id='".$value['fileName']."' class='btn btn-primary viewFile'>View</button>";
         break;
       case 1:
        $verifyList['action'] = "<button rel='".$value['docType']."' id='".$value['fileName']."' class='btn btn-primary viewFile'>View</button>";
         break;
       case 2:
        $verifyList['action'] = "<button data-result='".$value['result']."' data-docTypeID='".$value['docType']."' data-docType='".$verifyList['docType']."' data-name='".$verifyList['fileName']."' id='".$value['verificationID']."' class='btn btn-danger verifyBtn'>Verify</button>";
         break;
       case 3:
       $verifyList['action'] = "<button data-result='".$value['result']."' data-docTypeID='".$value['docType']."' data-docType='".$verifyList['docType']."' data-name='".$verifyList['fileName']."' id='".$value['verificationID']."' class='btn btn-danger verifyBtn'>Verify</button>";
         break;
     }

     $info['verifications'][]     = $verifyList;


 }


 $info['details']['verControllerID'] = $controlNumber;
 $info['details']['representative']  = $repName;
 $info['details']['company']         = $companyName;
 $info['details']['address1']        = $companyAddress1;
 $info['details']['dateFiled']       = $dateFiled;
 $info['details']['email']           = $email;
 $info['details']['status']          = $this->fn->verify_status($status);

return $info;

}
public function verifyResults(){
  $verControl = $_POST['vercontrol'];
  $control = $_POST['control'];
  $res = $_POST['result'];
  date_default_timezone_set('Asia/Manila');

 if(isset($_POST['result'])){

     $data = array(
       'result' => $res,
       'verifiedBy' => Session::get('empID'),
       'verifiedAt' => date("Y-m-d h:i:s")
     );
     $condition = "verificationID = '$verControl'";
     $result = $this->db->update('verifications', $data, $condition);

     if($result){

      $data = array('result');
      $condition = "verControllerID = '$control'";
      $check = $this->db->select('verifications', $data, $condition);
      $checker = 0;
      foreach ($check as $val) {
         if ($val['result'] != 1 && $val['result'] != 2) {
          $checker = $checker + 1;
         }
      }


      if ($checker == 0) {
        $data = array(
          'status' => 3,
          'updated_at' => date("Y-m-d h:i:s")
        );
        $condition = "verControllerID = '$control'";
        $result2 = $this->db->update('verifications_controller', $data, $condition);
        if ($result2) {
          return 2;
          }
       }else {
         return  1;
       }


        }else{
      return 0;
        }
    }
  }


  public function sendResult(){
    $control = $_POST['control'];
    $notes = $_POST['notes'];
    $repName = $_POST['repName'];
    $repEmail = $_POST['repEmail'];

    $data = array('docType', 'fileName', 'result');
    $condition = "verControllerID = '$control'";
    $verResult = $this->db->select('verifications', $data, $condition);

    $info = array(
      'results' => $verResult,
      'repName' => $repName,
      'repEmail' => $repEmail,
      'controlID' => $control,
      'notes' => $notes
    );

    if ($this->fn->is_connected()) {
      try {
        $mail = $this->fn->sendVerResultEmail($info);
        if ($mail['res']) {
          $data = array(
            'registrarNote' => $notes,
            'dateFinished' => date("Y-m-d h:i:s")
          );
          $condition = "verControllerID = '$control'";
          $result = $this->db->update('verifications_controller', $data, $condition);

          return json_encode(['message' => $mail['msg'], 'res' => 1]);
        }
      } catch (PDOException $e) {
        return json_encode(['message' => $e.getMessage(), 'res' => 0]);
      }
    }else {
      return json_encode(['message' => 'Please make sure you are connected to the network', 'res' => 2]);
    }
  }


  public function sendUpdates(){
    $control = $_POST['control'];
    $notes = $_POST['notes'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $controller = $this->db->select('requests_controller', ['studentNumber', 'dateFiled'], "controlNumber = '$control'")[0];
    $student = $this->db->select('students', ['email', 'lname'], "studentNumber = '".$controller['studentNumber']."'")[0];


    $info = array(
      'controlNumber' => $control,
      'notes' => $notes,
      'name' => $student['lname'],
      'type' => $type,
      'email' => $student['email'],
      'filed' => date('F d, Y', strtotime($controller['dateFiled']))
    );

    if ($this->fn->is_connected()) {
      try {
        $mail = $this->fn->sendUpdatesEmail($info);
        if ($mail['res']) {
          $data = array(
            'registrarNote' => $notes,
            'dateFinished' => date("Y-m-d h:i:s")
          );
          $condition = "verControllerID = '$control'";
          $result = $this->db->update('verifications_controller', $data, $condition);

          return json_encode(['message' => $mail['msg'], 'res' => 1]);
        }
      } catch (PDOException $e) {
        return json_encode(['message' => $e.getMessage(), 'res' => 0]);
      }
    }else {
      return json_encode(['message' => 'Please make sure you are connected to the network', 'res' => 2]);
    }
  }

  public function getData(){
     $results = array();

     $data = array('courseID','description');
     $condition = "trash = 0";
     $course = $this->db->select('course', $data, $condition);
     $results['courses'][] = $course;

     $data = array('branchID','branchName');
     $condition = "trash = 0";
     $branches = $this->db->select('branches', $data, $condition);
     $results['branches'][] = $branches;

     return $results;
   }
   public function addSubjects(){
     try {
       if (isset($_POST['studno'])) {

         $studentNum = $_POST['studno'];
         $sems = $_POST['sems'];
         $schoolYr = $_POST['yearpicker'];
         $sub = $_POST['subject'];
         $grade = $_POST['grade'];

         $data = array('*');
         $condition = "studentNumber = '$studentNum' AND subjectCode = '$sub' AND trash = 0";
         $subHit = $this->db->select('enrolled', $data, $condition);

         if (count($subHit) < 1) {
           $data = array(
             'studentNumber' => $studentNum,
             'subjectCode' => $sub,
             'grade' => $grade,
             'sem' => $sems,
             'schoolYear' => $schoolYr
           );

           $result = $this->db->insert('enrolled', $data);

           return true;
         }else {
           return json_encode(['res' => 0, 'message' => 'Subject Already Exist!']);
         }


       }

     } catch (PDOException $e) {
       return json_encode(['res' => 0, 'message' => $e->getMessage()]);
     }
   }

   public function selectSub(){

       if (isset($_POST['id'])) {

         $selID = $_POST['id'];

         $data = $this->db->prepare("SELECT a.*, b.title FROM enrolled as a INNER JOIN subjects as b on a.subjectCode = b.subjectCode where subjtakenId = '$selID'");
         $data->execute();
         $showSub = $data->fetch();
         return $showSub;

       }
   }
   public function delSubjects(){
     try {
       if (isset($_POST['id'])) {

         $id = $_POST['id'];

         $data = array(
           'trash' => 1
         );
         $condition = "subjtakenId = '$id'";
         $delresult = $this->db->update('enrolled', $data, $condition);

         return true;
       }

     } catch (PDOException $e) {
       return json_encode(['res' => 0, 'message' => $e->getMessage()]);
     }
   }
   public function updateSubjects(){
     try {
       if (isset($_POST['recID'])) {

         $id = $_POST['recID'];
         $sub = $_POST['subCode'];
         $sy = $_POST['edtschoolYear'];
         $sem = $_POST['edtsems'];
         $grd = $_POST['edtgrade'];


         $data = array(
           'subjtakenId' => $id,
           'subjectCode' => $sub,
           'grade' => $grd,
           'sem' => $sem,
           'schoolYear' => $sy
         );
         $condition = "subjtakenId = '$id'";
         $delresult = $this->db->update('enrolled', $data, $condition);

         return true;
       }

     } catch (PDOException $e) {
       return json_encode(['res' => 0, 'message' => $e->getMessage()]);
     }
   }

   public function saveDiplomaNumber(){
     try {
       if (isset($_POST['dip'])) {

         $dipNumber = $_POST['dip'];
         $stud = $_POST['student'];

         $data = array('diplomaNumber' => $dipNumber);
         $condition = "studentNumber = '$stud'";
         $delresult = $this->db->update('students', $data, $condition);

         return true;
       }

     } catch (PDOException $e) {
       return json_encode(['res' => 0, 'message' => $e->getMessage()]);
     }
   }
   public function addStudent(){
     try {
       if (isset($_POST['studno'])) {

         if (isset($_POST['isGrad'])) {
           $status = 1;
           $gradDate = $_POST['dateGrad'];
         }else {
           $status = 0;
           $gradDate = NULL;

         }
         if (isset($_POST['suffix'])) {
           $suffix = $_POST['suffix'];
         }else {
           $suffix = NULL;
         }

         if ( empty($_POST['mname'])) {
           $mname = NULL;
         }else {
           $mname = ucwords(strtolower($_POST['mname']));
         }

         if ( empty($_POST['mnum'])) {
           $mobileNum = NULL;
         }else {
           $mobileNum = $_POST['mnum'];
         }
         if ( empty($_POST['tnum'])) {
           $telNum = NULL;
         }else {
           $telNum = $_POST['tnum'];
         }

         if ($_POST['ecredential'] == 'PUPCET') {
           $admittedAs = "Freshmen";
         }else {
           $admittedAs = "Transferee";

         }

         $studentNum = $_POST['studno'];
         $yrAdmit = substr($_POST['studno'],0,4);


         $lname = ucwords(strtolower($_POST['lname']));
         $fname = ucwords(strtolower($_POST['fname']));
         $bday = $_POST['bday'];
         $credential = $_POST['ecredential'];
         $course = $_POST['course'];
         $branch = $_POST['branch'];
         $email = $_POST['email'];
         $address = $this->fn->createPermanentAddress($_POST['region'],$_POST['city'],ucwords(strtolower($_POST['barr'])),ucwords(strtolower($_POST['houseNum'])));

         $data = array(
           'studentNumber' => $studentNum,
           'lname' => $lname,
           'fname' => $fname,
           'mname' => $mname,
           'suffix' => $suffix,
           'birthDate' => $bday,
           'mobileNumber' => $mobileNum,
           'phoneNumber' => $telNum,
           'email' => $email,
           'permanentAddress' => $address,
           'status' => $status,
           'courseID' => $course,
           'branchID' => $branch,
           'entranceCredentials' => $credential,
           'isGraduate' => $status,
         );

         $result = $this->db->insert('students', $data);

         if ($result) {
           $numofSem = $_POST['sems'];
           $numofSummer = $_POST['summer'];
           $yearAdmitted = $yrAdmit;
           $highSchoolName = $_POST['HSname'];
           $hsYearGraduated = $_POST['HSGrad'];
            $elementarySchoolName = $_POST['elemname'];
            $esYearGraduated = $_POST['elemGrad'];

           $data = array(
             'studentNumber' => $studentNum,
             'degreeStatus' => $status,
             'dateGraduated' => $gradDate,
             'numofSem' => $numofSem,
             'numofSummer' => $numofSummer,
             'yearAdmitted' => $yearAdmitted,
             'admittedAs' => $admittedAs,
             'highSchoolName' => $highSchoolName,
             'hsYearGraduated' => $hsYearGraduated,
             'elementarySchoolName' => $elementarySchoolName,
             'esYearGraduated' => $esYearGraduated,
           );

           $result2 = $this->db->insert('educational_background', $data);
           return true;
         }

       }

     } catch (PDOException $e) {
       return json_encode(['res' => 0, 'message' => $e->getMessage()]);
     }
   }
   public function getStudents(){

     $studentDetails = array();
     $studentList = array();

     $data = $this->db->prepare("SELECT a.studentNumber, a.lname, a.mname, a.fname, a.suffix, a.isGraduate, a.branchID, b.description FROM students as a INNER JOIN course as b on a.courseID = b.courseID");
     $data->execute();
     $students = $data->fetchAll();

     foreach ($students as $value) {

       $studentDetails['studentNumber'] = $value['studentNumber'];
       $studentDetails['fullName'] = $this->fn->name_format($value['fname'], $value['lname'], $value['mname'], true, $value['suffix']);
       $studentDetails['course']     = $value['description'];
       $studentDetails['status']         = $this->fn->isGraduate($value['isGraduate']);
       $studentDetails['linkRel']        = URL."registrar/showStudent/".$value['studentNumber'];

      $bID = $value['branchID'];
       $data = array('branchName');
       $condition = "branchID = '$bID'";
       $request = $this->db->select('branches', $data, $condition)[0];
       $studentDetails['branch']   = $request['branchName'];

       $studentList[]                   = $studentDetails;
     }
   return $studentList;
 }

 public function showStudent($studnum){
   $subj = array();
   $infoResult = array();
   $studentInfo = array();

   $data = array('subjectCode', 'title');
   $condition = "trash = 0";
   $subs = $this->db->select('subjects', $data, $condition);

   $data = array('*');
   $condition = "studentNumber = '$studnum'";
   $students = $this->db->select('students', $data, $condition)[0];


     $studentInfo['studentNumber'] = $studnum;
     $studentInfo['fullName'] = $this->fn->name_format($students['fname'], $students['lname'], $students['mname'], true, $students['suffix']);;
     $studentInfo['status']   = $this->fn->isGraduate($students['isGraduate']);
     $studentInfo['bday']     = date('M d, Y', strtotime(explode(" ", $students['birthDate'])[0]));
     $studentInfo['address']  = $students['permanentAddress'];
     $studentInfo['email']  = $students['email'];
     $studentInfo['credential']  = $students['entranceCredentials'];


     $data = array('yearAdmitted','dateGraduated');
     $condition = "studentNumber = '$studnum'";
     $request2 = $this->db->select('educational_background', $data, $condition)[0];
     $studentInfo['yearAdmitted']  = $request2['yearAdmitted'];

     if ($students['isGraduate'] == 1) {
       $studentInfo['dateGraduated']  = date('Y', strtotime($request2['dateGraduated']));
     }else {
       $studentInfo['dateGraduated']  = 'N/A';

     }

     $studentInfo['isGrad']  = $students['isGraduate'];


     $bID = $students['branchID'];
     $data = array('branchName');
     $condition = "branchID = '$bID'";
     $request = $this->db->select('branches', $data, $condition)[0];
     $studentInfo['branch']   = $request['branchName'];

     $cID = $students['courseID'];
     $data = array('description');
     $condition = "courseID = '$cID'";
     $request = $this->db->select('course', $data, $condition)[0];
     $studentInfo['course']   = $request['description'];


   $data = $this->db->prepare("SELECT a.*, b.title FROM enrolled as a INNER JOIN subjects as b on a.subjectCode = b.subjectCode Where studentNumber = '$studnum' AND a.trash = 0");
   $data->execute();
   $result = $data->fetchAll();

   foreach ($result as $value) {

     $subj['subjectCode'] = $value['subjectCode'];
     $subj['sem'] = $this->fn->convSem($value['sem']);
     $subj['grade']     = $value['grade'];
     $subj['title']     = $value['title'];
     $subj['year']      = $value['schoolYear'];
     $subj['action']        = "<button class='btn btn-warning btn-sm uptbtn' id='".$value['subjtakenId']."'><i class='fa fa-edit fa-lg'></i></button> <button class='btn btn-danger btn-sm delbtn' id='".$value['subjtakenId']."'><i class='fa fa-trash-o fa-lg'></i></button>";
     $infoResult['subjects'][]  = $subj;
   }
   $infoResult['info'][]  = $studentInfo;
   $infoResult['subjectList'][] = $subs;

   return $infoResult;
 }

}
