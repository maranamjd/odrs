<?php
  /**
   *
   */
  class Office_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }



    public function officeRec(){
      $office = array();
      $branID = Session::get('branchID');

        $data = array('*');
        $condition = "branchID = '$branID'";
        $branchRecord = $this->db->select('clearances', $data, $condition);

        $arr = array();
        foreach ($branchRecord as $value) {
          $studID = $value['studentNumber'];
          $clrID = $value['clearanceID'];

          $data = array('lname','fname','mname','suffix','courseID');
          $condition = "studentNumber = '$studID'";
          $offStud = $this->db->select('students', $data, $condition)[0];

          $name = $this->fn->name_format($offStud['fname'], $offStud['lname'], $offStud['mname'], true, $offStud['suffix']);
          $offcourseID = $offStud['courseID'];

          $data = array('description');
          $condition = "courseID = '$offcourseID'";
          $courseDesc = $this->db->select('course', $data, $condition)[0]['description'];

          $off = $value['officeID'];
          $data = array('officeID','name');
          $condition = "officeID = '$off'";
          $offRec = $this->db->select('offices', $data, $condition)[0];

          $arr['studno'] = $studID;
          $arr['name'] = $name;
          $arr['course'] = $courseDesc;
          $arr['office'] = $offRec['name'];
          $arr['stats'] = $this->fn->clearanceStats($value['isCleared']);
          $arr['acts'] = '  <button class="btn btn-info btn-sm showBtn" id="'.$clrID.'"><i class="fa fa-eye fa-lg"></i></button>  <button class="btn btn-danger btn-sm modifyBtn" id="'.$clrID.'"><i class="fa fa-edit fa-lg"></i></button>';


          $office['data'][] = $arr;
        }

      return $office;


  }
  public function getStudentList(){
    if (isset($_POST['tgr'])) {
      $branchID = Session::get('branchID');
      $studRecords = array();
      $search = $_POST['query'];

      $output = '';
      $data = array('studentNumber');
      $condition = "studentNumber LIKE '%$search%' AND branchID = '$branchID'";
      $studRecords = $this->db->select('students', $data, $condition);

      $output = '<ul class="list-unstyled">';
      $i = count($studRecords);
      if ($i > 0) {
        foreach ($studRecords as $value) {
          $output .= '<li>'.$value['studentNumber'].'</li>';
        }
      }else {
        $output .= '<p class="notFound">Student Not Found!</p>';
      }
        $output .= '</ul>';
        return $output;
    }

  }

  public function fetchStudent(){
    if (isset($_POST['tgr'])) {

      $studRecords = array();
      $studID = $_POST['id'];

      $data = array('studentNumber','lname','fname','mname', 'suffix', 'courseID');
      $condition = "studentNumber = '$studID'";
      $result = $this->db->select('students', $data, $condition)[0];

      $cID = $result['courseID'];

      $data = array('description');
      $condition = "courseID = '$cID'";
      $result2 = $this->db->select('course', $data, $condition)[0]['description'];

      $studRecords['studentID'] = $result['studentNumber'];
      $studRecords['name'] = $this->fn->name_format($result['fname'], $result['lname'], $result['mname'], false, $result['suffix']);
      $studRecords['course'] = $result2;
      return $studRecords;
    }

  }
  public function officeHeader(){
    $branID = Session::get('branchID');

      $officeHead = array();

      $data = array('branchName');
      $condition = "branchID = '$branID'";
      $branchName = $this->db->select('branches', $data, $condition)[0]['branchName'];

      $data = array('*');
      $condition = "trash = 0";
      $officeList = $this->db->select('offices', $data, $condition);


      $officeHead['title'] = $branchName;
      $officeHead['list'] =  $officeList;
      return $officeHead;
  }
  public function addClearanceRecord(){
    try {
      $studID = $_POST['id'];
      $officeID = $_POST['offID'];
      $description = $_POST['desc'];

      $data = array(
        'studentNumber' => $studID,
        'officeID' => $officeID,
        'branchID' => Session::get('branchID'),
        'description' => $description,
        'created_on' => date("Y-m-d h:i:s")
      );

      $result = $this->db->insert('clearances', $data);

      return true;
    } catch (PDOException $e) {
      return json_encode(['res' => 0, 'message' => $e->getMessage()]);
    }
  }
  public function showClrRecord(){
    try {
      $clrRec = array();
      $clrID = $_POST['id'];

      $data = array('*');
      $condition = "clearanceID = '$clrID'";
      $result = $this->db->select('clearances', $data, $condition)[0];
      $offID = $result['officeID'];
      $desc = $result['description'];
      $isCleared = $result['isCleared'];

      $studID = $result['studentNumber'];
      $dateAdd = $result['created_on'];

      $data = array('studentNumber','lname','fname','mname', 'suffix', 'courseID');
      $condition = "studentNumber = '$studID'";
      $result2 = $this->db->select('students', $data, $condition)[0];

      $data = array('name');
      $condition = "officeID = '$offID'";
      $result1 = $this->db->select('offices', $data, $condition)[0]['name'];

      $clrRec['officeName'] = $result1;
      $clrRec['name'] = $this->fn->name_format($result2['fname'], $result2['lname'], $result2['mname'], true, $result2['suffix']);
      $clrRec['dateAdded'] = date('M d, Y', strtotime(explode(" ", $dateAdd)[0]));
      $clrRec['rawID'] = $offID;

      $clrRec['studID'] = $studID;
      $clrRec['desc'] = $desc;
      $clrRec['clr'] = $isCleared;

      return $clrRec;
    } catch (PDOException $e) {
      return json_encode(['res' => 0, 'message' => $e->getMessage()]);
    }
  }

  public function clearRecord(){
    try {
      $clrID = $_POST['id'];

      $data = array(
      'isCleared'    => 1,
      'updated_at' => date("Y-m-d h:i:s")
      );
      $condition = "clearanceID = '$clrID'";
      $result = $this->db->update('clearances', $data, $condition);

      return true;
    } catch (PDOException $e) {
      return json_encode(['res' => 0, 'message' => $e->getMessage()]);
    }
  }
  public function uptRecord(){
    try {
      if (isset($_POST['id'])) {
        $offID = $_POST['offc'];
        $desc = $_POST['desc'];
        $clrID = $_POST['id'];

        $data = array(
        'officeID'    => $offID,
        'description' => $desc,
        'updated_at' => date("Y-m-d h:i:s")
        );
        $condition = "clearanceID = '$clrID'";
        $result = $this->db->update('clearances', $data, $condition);

        return true;
      }

    } catch (PDOException $e) {
      return json_encode(['res' => 0, 'message' => $e->getMessage()]);
    }
  }

}
