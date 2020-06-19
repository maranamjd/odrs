
<?php

  /**
   *
   */
  class Login_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function login(){
      $username = $_POST['username'];
      $password = $_POST['password'];

      $data = array('email', 'userType', 'password');
      $condition = "employeeID = '$username'";
      $account = $this->db->select('empaccount', $data, $condition);
      if (!empty($account)) {
        if ($this->fn->decrypt($account[0]['password']) == $password) {
          $data = array('fname', 'mname', 'lname', 'suffix', 'branchID', 'officeID', 'position');
          $condition = "employeeID = '$username'";
          $result = $this->db->select('employee', $data, $condition)[0];
          Session::set(array(
            'empID'     => $username,
            'fname'     => $result['fname'],
            'mname'     => $result['mname'],
            'lname'     => $result['lname'],
            'suffix'    => $result['suffix'],
            'branchID'  => $result['branchID'],
            'officeID'  => $result['officeID'],
            'position'  => $result['position'],
            'usertype'  => $account[0]['userType'],
            'logged'    => true
          ));
          return true;
        }
      }
      return false;
    }


  }
