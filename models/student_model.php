<?php
  /**
   *
   */
  class Student_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
      $this->studentNum = Session::get('studentNumber');
    }

    public function home(){
      Session::init();
      Session::destroy();
      header('location: '.URL.'student');
    }

    public function getPayments(){
      return $this->db->select('payment_type', ['*'], "enabled = 1");
    }

    public function updateContact(){
      $mobile = "09".$_POST['mobile_number'];
      $email = $_POST['email'];
      try {
        $this->db->update('students', ['mobileNumber' => $mobile, 'email' => $email], "studentNumber = '$this->studentNum'");
        return json_encode(['res' => 1, 'message' => 'Contact Information Updated!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function getInfo(){
      $studentNum = Session::get('studentNumber');
      try {
        $info = $this->db->inner_join([['students' => ['lname', 'fname', 'mname', 'suffix', 'courseID']],['educational_background' => ['dateGraduated']]], ['studentNumber' => ['students', 'educational_background']], "students.studentNumber = '$studentNum'")[0];
        $fname = strtolower(trim($info['fname']));
        $lname = strtolower(trim($info['lname']));
        $mname = $info['mname'] == null ? null : strtolower(trim($info['mname']));
        $suffix = $info['suffix'] == null ? null : trim($info['suffix']);
        $courseID = strtolower(trim($info['courseID']));
        $yearGraduated = $info['dateGraduated'] == null ? null : explode('-', strtolower(trim($info['dateGraduated'])))[0];

        $postFname = $_POST['fname'] == 'null' ? null : $_POST['fname'];
        $postLname = $_POST['lname'] == 'null' ? null : $_POST['lname'];
        $postMname = $_POST['mname'] == 'null' ? null : $_POST['mname'];
        $postSuffix = $_POST['suffix'] == 'null' ? null : $_POST['suffix'];
        $postCourseID = $_POST['course'] == 'null' ? null : $_POST['course'];
        $postYearGraduated = $_POST['year_graduated'] == 'null' ? null : $_POST['year_graduated'];


        if ($postFname !== $fname || $postLname !== $lname || $postMname !== $mname || $postSuffix !== $suffix || $postCourseID !== $courseID || $postYearGraduated !== $yearGraduated) {
          return json_encode(['res' => false]);
        }else {
          return json_encode(['res' => true]);
        }
      } catch (PDOException $e) {
        return json_encode(['message' => $e->getMessage]);
      }

    }

    public function checkStatus(){
      $controlNumber = $_POST['control_number'];
      try {
        $controller = $this->db->select('requests_controller', ['status'], "controlNumber = $controlNumber");
        if (count($controller) > 0) {
          $documents = $this->db->query("SELECT status, (select description from document where documentID = document_documentID) as 'description' FROM request WHERE controlNumber = $controlNumber")->fetchAll();
          foreach ($documents as $key => $document) {
            $documents[$key]['status'] = $this->fn->document_status($document['status']);
          }
          return json_encode(['res' => 1, 'status' => ['request' => $this->fn->student_request_status($controller[0]['status']), 'requestnum' => $controller[0]['status'], 'documents' => $documents]]);
        }else {
          return json_encode(['res' => 0]);
        }
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }

    }

    public function blockAccount(){
      $studentNum = Session::get('studentNumber');
      $eventName = implode('_', explode('-', $studentNum))."_RESET_ATTEMPT";
      try {
        $result = $this->db->query("
        CREATE EVENT ".$eventName." ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL ".$GLOBALS['RESET_INTERVAL_NUM']." ".$GLOBALS['RESET_INTERVAL_TYPE']." DO
        UPDATE students SET attempt = ".$GLOBALS['MAX_ATTEMPT']." WHERE studentNumber = '$studentNum'
        ");
        Session::destroy();
        return json_encode(['res' => 1]);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function reduceAttempt(){
      $studentNum = Session::get('studentNumber');
      $attempt = $_POST['attempt'];
      try {
        $this->db->update('students', ['attempt' => $attempt], "studentNumber = '$studentNum'");
      } catch (PDOException $e) {
        return json_encode(['message' => $e->getMessage()]);
      }

    }

    public function submitSurvey(){
      $studentNum = Session::get('studentNumber');
      $answers = $_POST['answers'];
      foreach ($answers as $answer) {
        try {
          $data = array(
            'id' => null,
            'studentNumber' => $studentNum,
            'questionID'    => $answer['questionID'],
            'choiceID'      => $answer['choiceID'],
            'other'         => $answer['other'] == '' ? null : $answer['other']
          );
          $result = $this->db->insert('survey', $data);

        } catch (PDOException $e) {
          return json_encode(['res' => 0, 'message' => $e->getMessage()]);
        }
      }
      return json_encode(['res' => 1, 'message' => 'Answers saved!', 'studentNum' => $studentNum]);
    }

    public function getSurveyInfo(){
      $questions = $this->db->select('survey_questions', ['questionID', 'question', 'hasOther'], "trash = 0");
      foreach ($questions as $key => $question) {
        $questions[$key]['choices'] = $this->db->select('survey_choices', ['choiceID', 'description'], "trash = 0 AND questionID = ".$question['questionID']);
      }
      return $questions;
    }

    public function getStudentNum(){
      $fname = $_POST['first_name'];
      $lname = $_POST['last_name'];
      $birthdate = $_POST['birth_year'].'-'.$_POST['birth_month'].'-'.$_POST['birth_day'];
      $courseID = $_POST['course'];
      $branchID = $_POST['branch'];
      $condition = "fname = '$fname' AND lname = '$lname' AND birthDate = '$birthdate' AND courseID = $courseID AND branchID = $branchID";
      try {
        $result = $this->db->select('students', ['studentNumber'], $condition);

        if (count($result) < 1) {
          return json_encode(['res' => 0, 'message' => 'No Data Found']);
        }
        $result[0]['fname'] = $fname;
        $result[0]['birth_year'] = $_POST['birth_year'];
        $result[0]['birth_month'] = $_POST['birth_month'];
        $result[0]['birth_day'] = $_POST['birth_day'];
        return json_encode(['res' => 1, 'info' => $result[0]]);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function remember(){
      $courses  = $this->db->select('course', ['courseID', 'description'], '1');
      $branches = $this->db->select('branches', ['branchID', 'branchName'], '1');
      $data['branches'] = $branches;
      $data['courses'] = $courses;
      return $data;
    }

    public function select($id){
      $info = array();

      $data = array('isGraduate', 'studentNumber', 'attempt', 'mobileNumber', 'email');
      $condition = "studentNumber = '$id'";
      $info['student'] = $this->db->select('students', $data, $condition)[0];

      $info['courses'] = $this->db->select('course', ['courseID', 'description'], 'trash = 0');
      $pending = $this->db->select('requests_controller', ['controlNumber', 'isFastLane', 'isCleared', 'expectedDueDate', 'status'], "studentNumber = '$id' and status < 3");
      if (count($pending) > 0) {
        $info['pending'] = $pending[0];
      }
      $info['hasSurvey'] = 1;
      if ($info['student']['isGraduate'] == 1) {
        $condition = "trash = 0 AND graduate != 0";
        $info['hasSurvey'] = $this->db->select('survey', ['id'], "studentNumber = '$id'");
      }else {
        $condition = "trash = 0 AND graduate != 1";
      }
      $data = array('documentID', 'description', 'graduate', 'price', 'documentTypeID');
      $documents = $this->db->select('document', $data, $condition);

      foreach ($documents as $key => $doc) {
        $data = array('description');
        $condition = "classID = ".$doc['documentTypeID'];
        $type = $this->db->select('document_type', $data, $condition)[0]['description'];
        $info['documents'][$type][] = $doc;
      }


      $tables = [['clearances' => ['*']],['offices' => ['name']]];
      $keys = ['officeID' => ['clearances', 'offices']];
      $condition = "clearances.studentNumber = '$id' AND clearances.isCleared = 0";
      $result = $this->db->inner_join($tables, $keys, $condition);
      if (count($result) > 0) {
        $info['clearance'] = $result;
      }
      return $info;
    }

    public function download($id){

      $paymentType = explode('_', $id)[0];
      $controlNumber = explode('_', $id)[1];

      if ($this->db->select('requests_controller',['studentNumber'], "controlNumber = '$controlNumber'")[0]['studentNumber'] != Session::get('studentNumber')) {
        header('Location: '.URL.'student/select/'.Session::get('studentNumber'));
        exit;
      }

      $data = array('document_documentID', 'quantity');
      $condition = "controlNumber = '$controlNumber'";
      $result = $this->db->select('request', $data, $condition);
      $fastlane = $this->db->select('requests_controller', ['isFastLane'], "controlNumber = '$controlNumber'")[0];

      $document = array();
      $documents = array();
      foreach ($result as $value) {
        $data = array('description', 'price', 'requirements');
        $condition = "documentID = ".$value['document_documentID'];
        $result = $this->db->select('document', $data, $condition)[0];
        $document['description']  = $result['description'];
        $document['quantity']     = $value['quantity'];
        $document['price']        = $result['price'];
        $document['requirements'] = $result['requirements'];
        $documents[] = $document;
      }

      $data               = array('studentNumber', 'expectedDueDate');
      $condition          = "controlNumber = '$controlNumber'";
      $controller         = $this->db->select('requests_controller', $data, $condition)[0];
      $student_number     = $controller['studentNumber'];
      $tentativeDate      = $controller['expectedDueDate'];

      $data               = array('yearAdmitted');
      $condition          = "studentNumber = '$student_number'";
      $yearAdmitted       = $this->db->select('educational_background', $data, $condition)[0]['yearAdmitted'];

      $data               = array('courseID', 'lname', 'fname', 'mname', 'suffix');
      $condition          = "studentNumber = '$student_number'";
      $student            = $this->db->select('students', $data, $condition)[0];

      $data               = array('description');
      $condition          = "courseID = ".$student['courseID'];
      $courseDescription  = $this->db->select('course', $data, $condition)[0]['description'];

      $info['documents']          = $documents;
      $info['yearAdmitted']       = $yearAdmitted;
      $info['courseDescription']  = $courseDescription;
      $info['tentativeDate']      = $tentativeDate;
      $info['studentName']        = $this->fn->name_format($student['fname'], $student['lname'], $student['mname'], false, $student['suffix']);
      $info['fastlane']           = $fastlane['isFastLane'];
      $info['type']               = $paymentType;

      $pdf = new FPDF('P');
      $this->fn->createVoucher($pdf, $controlNumber, $info);
    }

    public function login(){
      $student_number = $_POST['student_number'];
      $student_bmonth = $_POST['student_bmonth'];
      $student_bday   = $_POST['student_bday'];
      $student_byear  = $_POST['student_byear'];
      $bdate = date_format(date_create($student_byear."-".$student_bmonth."-".$student_bday), 'Y-m-d');

      $data = array('studentNumber', 'lname', 'fname', 'mname', 'birthDate', 'attempt');
      $condition = "studentNumber = '$student_number' AND birthDate = '$bdate'";
      $result = $this->db->select('students', $data, $condition);

      if (!empty($result)) {
        if ($result[0]['attempt'] > 0) {
          Session::set(array(
            'studentNumber' => $result[0]['studentNumber']
          ));
          return json_encode(['res' => 1, 'studentNum' => $result[0]['studentNumber']]);
        }else {
          return json_encode(['res' => 0, 'message' => 'Verification attempt consumed. Attempt will reset after 24 hours']);
        }
      }else {
        return json_encode(['res' => 0, 'message' => 'No data found']);
      }
    }
    public function logout(){
      Session::destroy();
      header('Location: '.URL.'student');
    }

    public function cancelRequest(){
      $controlNumber = $_POST['control_number'];
      try {
        $this->db->update('requests_controller', ['status' => 4], "controlNumber = '$controlNumber'");
        return json_encode(['res' => 1, 'message' => 'Your Request is Cancelled!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function sendRequest(){
        // echo json_encode($_POST);
        // die;
      try {
        if (isset($_POST['mobile_number'])) {
          $this->db->update('students', ['attempt' => $GLOBALS['MAX_ATTEMPT'], 'mobileNumber' => "09".$_POST['mobile_number'], 'email' => $_POST['email']], "studentNumber = '$this->studentNum'");
        }else {
          $this->db->update('students', ['attempt' => $GLOBALS['MAX_ATTEMPT']], "studentNumber = '$this->studentNum'");
        }

        $data = array('dateGraduated');
        $condition = "studentNumber = '$this->studentNum'";
        $result = $this->db->select('educational_background', $data, $condition)[0];
        if ($result['dateGraduated'] == null) {
          $lastTermYear = date('Y');
        }else {
          $lastTermYear = $result['dateGraduated'];
        }
        $data = array("MAX(controlNumber) as 'controlNumber'");
        $dateToday = date('Y').date('m').date('d');
        $condition = "controlNumber LIKE '%$dateToday%'";
        $result = $this->db->select('requests_controller', $data, $condition)[0];
        if ($result['controlNumber'] == null) {
          $controlNumber = $dateToday."0001";
        }else {
          $controlNumber = $result['controlNumber'] + 1;
        }
        if ($_POST['fastlane']) {
          $expectedDueDate = date('Y-m-d', strtotime($dateToday. ' + 15 days'));
        }else {
          $expectedDueDate = date('Y-m-d', strtotime($dateToday. ' + 30 days'));
        }
        //controller
        $data = array(
          'controlNumber'   => $controlNumber,
          'studentNumber'   => $this->studentNum,
          'lastTermYear'    => $lastTermYear,
          'purpose'         => '',
          'dateFiled'       => date('Y-m-d'),
          'isFastLane'      => $_POST['fastlane'],
          'expectedDueDate' => $expectedDueDate
        );
        $result = $this->db->insert('requests_controller', $data);

        //requests
        foreach ($_POST['documents'] as $key => $doc) {
          $data = array(
            'requestID' => null,
            'controlNumber' => $controlNumber,
            'document_documentID' => $doc,
            'quantity'            => $_POST['quantities'][$key],
          );
          $result = $this->db->insert('request', $data);
        }
        Session::set(['controlNumber' => $controlNumber]);

        return json_encode(['res' => 1, 'message' => 'Request Sent!']);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }

    }


  }
