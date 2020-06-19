<?php
  /**
   *
   */
  class Company_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function getInfo($id){
      $data = array('description');
      $condition = '1';
      $courses = $this->db->select('course', $data, $condition);
      $data = array('branchName');
      $condition = '1';
      $branches = $this->db->select('branches', $data, $condition);

      $data = array('companyID', 'firstName', 'middleName', 'lastName', 'suffix', 'email');
      $condition = "repID = $id";
      $representative = $this->db->select('representatives', $data, $condition)[0];

      $companyID = $representative['companyID'];

      $data = array('*');
      $condition = "companyID = $companyID";
      $company = $this->db->select('company', $data, $condition)[0];

      $info['representative'] = $representative;
      $info['company']        = $company;
      $info['courses']        = $courses;
      $info['branches']        = $branches;
      return $info;
    }

    public function updateCompany(){
      $compID = $_POST['company_id'];
      try {

        $data = array(
          'companyName' => $_POST['company_name'],
          'addressNumber' => $_POST['company_addressNumber'],
          'addressSt' => $_POST['company_addressSt'],
          'addressBrgy' => $_POST['company_addressBrgy'],
          'addressCity' => $_POST['address_city'],
          'addressRegion' => $_POST['address_region'],
          'addressCountry' => $_POST['address_country'],
          'postalOrZipCode' => $_POST['address_postalOrZipCode'],
          'businessNature' => $_POST['company_nature']
        );
        $this->db->update('company', $data, "companyID = $compID");

        return json_encode(['message' => 'Update Successful!', 'res' => 1]);
      } catch (PDOException $e) {
        return json_encode(['message' => $e.getMessage(), 'res' => 0]);
      }
    }

    public function updateRepresentative(){
      $repID = Session::get('repLogged');
      try {

        $data = array(
          'firstName' => $_POST['representative_firstName'],
          'middleName' => $_POST['representative_middleName'],
          'lastName'  => $_POST['representative_lastName'],
          'suffix'  => $_POST['representative_suffix'] == '' ? null : $_POST['representative_suffix'],
          'email' => $_POST['representative_email']
        );
        $this->db->update('representatives', $data, "repID = $repID");

        return json_encode(['message' => 'Update Successful!', 'res' => 1]);
      } catch (PDOException $e) {
        return json_encode(['message' => $e.getMessage(), 'res' => 0]);
      }
    }

    public function updatePassword(){
      $repID = Session::get('repLogged');
      try {

        $this->db->update('representatives', ['password' => $this->fn->encrypt($_POST['password'])], "repID = $repID");

        return json_encode(['message' => 'Update Successful!', 'res' => 1]);
      } catch (PDOException $e) {
        return json_encode(['message' => $e.getMessage(), 'res' => 0]);
      }
    }

}
