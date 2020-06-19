<?php

  /**
   *
   */
  class Verification_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
    }

    public function getBranches(){
      return $this->db->select('branches', ['branchID', 'branchName'], 'trash = 0');
    }

    public function checkEmail(){
      $email = $_POST['email'];
      try {
        $result = $this->db->select('representatives', ['repID', 'password'], "email = '$email'");
        $account = $result[0]['password'] == null ? 0 : 1;
        return json_encode(['res' => 1, 'match' => count($result), 'rep' => count($result) > 0 ? $result[0]['repID'] : null, 'account' => $account]);
      } catch (PDOException $e) {
        return json_encode(['res' => 0, 'message' => $e->getMessage()]);
      }
    }

    public function getCompanyDetails($id){

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
    public function login(){
      $email    = $_POST['email'];
      $password = $this->fn->encrypt($_POST['password']);

      $data = array('repID', 'companyID');
      $condition = "email = '$email' AND password = '$password'";
      $account = $this->db->select('representatives', $data, $condition);

      if (count($account) > 0) {
        Session::set(array(
          'repLogged' => $account[0]['repID']
        ));
        return $account[0]['repID'];
      }else {
        return false;
      }
    }
    public function logout(){
      Session::destroy();
      header('Location: '.URL.'verification');
    }


    public function submitVerification(){

      if (Session::get('repLogged') !== null) {
        //with account
        try {
          $data = array("MAX(verControllerID) as 'verControllerID'");
          $dateToday = date('Y').date('m').date('d');
          $condition = "verControllerID LIKE '%$dateToday%'";
          $result = $this->db->select('verifications_controller', $data, $condition)[0];
          if ($result['verControllerID'] == null) {
            $controlNumber = $dateToday."0001";
          }else {
            $controlNumber = $result['verControllerID'] + 1;
          }
          $data = array(
            'verControllerID' => $controlNumber,
            'proceedCode'     => substr($this->fn->encrypt(md5($controlNumber)), 0, 13),
            'repID'           => Session::get('repLogged'),
            'created_on'      => date('Y-m-d')
          );
          $result = $this->db->insert('verifications_controller', $data);
          if ($result) {
            for ($i=0; $i <= $_POST['applicantNo'] ; $i++) {

              $ext = pathinfo($_FILES['file'.$i]['name'], PATHINFO_EXTENSION);
              $filename = $controlNumber.'_'.$i.'.'.$ext;
              $uploadFilePath = 'system/verification/files/upload/'.$_POST['doctype'.$i].'/'.$filename;
              move_uploaded_file($_FILES['file'.$i]['tmp_name'], $uploadFilePath);
              $data = array(
                'verificationID'  => null,
                'verControllerID' => $controlNumber,
                'docType'         => $_POST['doctype'.$i],
                'fileName'        => $filename
              );
              $result = $this->db->insert('verifications', $data);
            }
          }
          return json_encode(['res' => true, 'verID' => $controlNumber]);
        } catch (PDOException $e) {
          return json_encode(['res' => false, 'message' => $e->getMessage()]);
        }


      }else {
        //no account
        try {
          $data = array(
            'companyID' => null,
            'companyName' => $_POST['company_name'],
            'addressNumber' => $_POST['company_addressNumber'],
            'addressSt' => $_POST['company_addressSt'],
            'addressBrgy' => $_POST['company_addressBrgy'] == '' ? null : $_POST['company_addressBrgy'],
            'addressCity' => $_POST['address_city'] == '' ? null : $_POST['address_city'],
            'addressRegion' => $_POST['address_region'],
            'addressCountry' => $_POST['address_country'],
            'postalOrZipCode' => $_POST['address_postalOrZipCode'] == '' ? null : $_POST['address_postalOrZipCode'],
            'businessNature' => $_POST['company_nature']
          );
          $result = $this->db->insert('company', $data);
          $lastInsertCompanyID = $this->db->lastInsertId();
          if ($result) {
            $data = array(
              'repID' => null,
              'companyID' => $lastInsertCompanyID,
              'firstName' => $_POST['representative_firstName'],
              'middleName' => $_POST['representative_middleName'] == '' ? null : $_POST['representative_middleName'],
              'lastName'  => $_POST['representative_lastName'],
              'suffix'  => $_POST['representative_suffix'] == '' ? null : $_POST['representative_suffix'],
              'email' => $_POST['representative_email'],
              'isActive' => 0
            );
            $result = $this->db->insert('representatives', $data);
            $lastInsertRepresentativeID = $this->db->lastInsertId();
          }

          $data = array("MAX(verControllerID) as 'verControllerID'");
          $dateToday = date('Y').date('m').date('d');
          $condition = "verControllerID LIKE '%$dateToday%'";
          $result = $this->db->select('verifications_controller', $data, $condition)[0];
          if ($result['verControllerID'] == null) {
            $controlNumber = $dateToday."0001";
          }else {
            $controlNumber = $result['verControllerID'] + 1;
          }

          $data = array(
            'verControllerID' => $controlNumber,
            'proceedCode'     => substr($this->fn->encrypt(md5($controlNumber)), 0, 13),
            'repID'           => $lastInsertRepresentativeID,
            'created_on'      => date('Y-m-d')
          );
          $result = $this->db->insert('verifications_controller', $data);
          if ($result) {
            for ($i=0; $i <= $_POST['applicantNo'] ; $i++) {

              $ext = pathinfo($_FILES['file'.$i]['name'], PATHINFO_EXTENSION);
              $filename = $controlNumber.'_'.$i.'.'.$ext;
              $uploadFilePath = 'system/verification/files/upload/'.$_POST['doctype'.$i].'/'.$filename;
              move_uploaded_file($_FILES['file'.$i]['tmp_name'], $uploadFilePath);
              $data = array(
              'verificationID'  => null,
              'verControllerID' => $controlNumber,
              'docType'         => $_POST['doctype'.$i],
              'fileName'        => $filename
              );
              $result = $this->db->insert('verifications', $data);
            }
          }
          return json_encode(['res' => true, 'verID' => $controlNumber, 'repID' => $lastInsertRepresentativeID]);
        } catch (PDOException $e) {
          return json_encode(['res' => false, $e->getMessage()]);
        }

      }
    }



    public function voucher($id){
      $pdf = new FPDF();

      $data = array('docType');
      $condition = "verControllerID = $id";
      $requests = $this->db->select('verifications', $data, $condition);

      $docs = array();
      foreach ($requests as $request) {
        $data = array('description');
        $condition = "classID = ".$request['docType'];
        $doc = $this->db->select('document_type', $data, $condition)[0];
        $docs[] = $doc['description'];
      }

      $data = array('repID', 'proceedCode');
      $condition = "verControllerID = '$id'";
      $representative = $this->db->select('verifications_controller', $data, $condition)[0];

      $data = array('companyID', 'firstName', 'middleName', 'lastName', 'suffix');
      $condition = "repID = ".$representative['repID'];
      $repInfo = $this->db->select('representatives', $data, $condition)[0];

      $data = array('companyName', 'addressCity', 'addressCountry');
      $condition = "companyID = ".$repInfo['companyID'];
      $company = $this->db->select('company', $data, $condition)[0];


      $pdf->AddPage();
      $pdf->SetLeftMargin(20);
      $pdf->SetTopMargin(20);
      $pdf->SetRightMargin(20);
      $pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
      $pdf->AddFont('Calibri Bold','I','Calibri Bold.php');
      $pdf->AddFont('Calibri','','Calibri.php');
      $pdf->SetY(20);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(80,4,"Republic of the Philippines",0,0,'L',false);
      $pdf->Cell(0,4,"Online Document Request",0,1,'R',false);
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->Cell(0,6,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES",0,1,'L',false);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(80,4,"Sta. Mesa, Manila",0,0,'L',false);
      $pdf->SetY(30);
      $pdf->SetFont('Calibri Bold','B',22);
      $pdf->SetTextColor(224,64,64);
      $pdf->Cell(0,6,"CLIENT'S COPY",0,1,'R',false);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Calibri Bold','B',16);
      $pdf->SetY(45);
      $pdf->Cell(50,6,"Reference Number: ",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->Cell(0,6,$id,0,0,'L',false);
      $pdf->SetY(50);
      $pdf->SetFont('Calibri Bold','B',16);
      $pdf->Cell(50,6,"Proceed Code: ",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->Cell(0,6,$representative['proceedCode'],0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->setY(55);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(00,6,'',0,1,'L',false);
      $pdf->Cell(00,6,"Company Name: ".$company['companyName'],0,1,'L',false);
      $pdf->Cell(00,6,"Representative Name: ".$this->fn->name_format($repInfo['firstName'], $repInfo['lastName'], $repInfo['middleName'], true, $repInfo['suffix']),0,1,'L',false);
      $pdf->SetY(80);
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->Cell(0,6,"Breakdown of fees",0,1,'L',false);
      $pdf->Cell(90,6,"Item",0,0,'L',false);
      $pdf->Cell(50,6,"Amount",0,1,'L',false);
      $pdf->SetFont('Calibri','',12);
      foreach ($docs as $doc) {
        $pdf->Cell(90,6,$doc,0,0,'L',false);
        $pdf->Cell(50,6,'200.00',0,1,'L',false);
      }
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->Cell(90,10,"Total",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',14);
      $pdf->Cell(50,10,number_format(count($docs) * 200, 2),0,1,'L',false);
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->MultiCell(0,6,"Instructions:",0,'L',false);
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell(0,6,"1. Pay at the nearest LandBank in your area.",0,1,'L',false);
      $pdf->Cell(0,6,"2. Scan or take a picture of your receipt and go to http://odrs.pup/verification.",0,1,'L',false);
      $pdf->Cell(0,6,"3. Use the Proceed Code to view your request.",0,1,'L',false);
      $pdf->Cell(0,6,"4. Check if the information is correct and upload the file and submit.",0,1,'L',false);
      $pdf->Cell(0,6,"5. You will recieve an email containing the results of your verification request.",0,1,'L',false);
      $pdf->Cell(0,8,'',"B",1,'C',false);
      $pdf->setY(210);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(80,4,"Republic of the Philippines",0,0,'L',false);
      $pdf->Cell(0,4,"Online Document Request",0,1,'R',false);
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->Cell(0,6,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES",0,1,'L',false);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(80,4,"Sta. Mesa, Manila",0,0,'L',false);
      $pdf->SetY(220);
      $pdf->SetFont('Calibri Bold','B',22);
      $pdf->SetTextColor(224,64,64);
      $pdf->Cell(0,6,"BANK'S COPY",0,1,'R',false);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetY(238);
      $pdf->SetFont('Calibri','',14);
      $pdf->Cell(150,8,"Total Amount Due: ",0,0,'R',false);
      $pdf->SetFont('Calibri Bold','B',16);
      $pdf->Cell(0,8,'PHP '.number_format(count($docs) * 200, 2),0,1,'L',false);
      $pdf->SetFont('Calibri','',14);
      $pdf->Cell(150,8,"Bank Service Fee: ",0,0,'R',false);
      $pdf->SetFont('Calibri Bold','B',16);
      $pdf->Cell(0,8,'PHP 25.00',0,1,'L',false);
      $pdf->setY(230);
      $pdf->SetFont('Calibri','',14);
      $pdf->Cell(50,8,"Name: ",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',14);
      $pdf->Cell(0,8,$this->fn->name_format($repInfo['firstName'], $repInfo['lastName'], $repInfo['middleName'], false, $repInfo['suffix']),0,1,'L',false);
      $pdf->SetFont('Calibri','',14);
      $pdf->Cell(50,8,"Reference Number: ",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',14);
      $pdf->Cell(0,8,$id,0,1,'L',false);
      $pdf->SetFont('Calibri','',14);
      $pdf->Cell(50,8,"Clearing Account No: ",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',14);
      $pdf->Cell(0,8,'0682-2220-18',0,1,'L',false);
      $pdf->SetFont('Calibri','',10);
      $pdf->setY(260);
      $pdf->MultiCell(0,6,"This is the Bank’s copy. Detach this part and present to the Bank Teller (together with the Bank’s fully­accomplished Deposit Slip) when you pay your Verification Request Fee.",0,'L',false);



      $pdf->output('I');
    }

    public function submitProceed(){
      $proceed_code =  $_POST['proceed_code'];

      $data = array('verControllerID', 'repID');
      $condition = "proceedCode = '$proceed_code'";
      $controller = $this->db->select('verifications_controller', $data, $condition);

      // return json_encode($controller);
      if (count($controller) < 1) {
        return false;
      }else {
        Session::set(array('verficationTransaction' => $controller[0]['verControllerID'].'_'.$controller[0]['repID']));
        return $controller[0]['verControllerID'].'_'.$controller[0]['repID'];
      }

    }

    public function getTransactionInfo($id){
      $controlNumber = explode('_', $id)[0];
      $repID = explode('_', $id)[1];

      $data = array('docType');
      $condition = "verControllerID = $controlNumber";
      $docs = $this->db->select('verifications', $data, $condition);

      $documents = array();
      $info = array();

      foreach ($docs as $doc) {
        $data = array('description');
        $condition = "classID = ".$doc['docType'];
        $docs = $this->db->select('document_type', $data, $condition)[0];
        $documents[] = $docs['description'];
      }
      $info['docs'] = $documents;

      $data = array('companyID', 'firstName', 'middleName', 'lastName', 'suffix');
      $condition = "repID = $repID";
      $representative = $this->db->select('representatives', $data, $condition)[0];
      $companyID = $representative['companyID'];
      $info['rep'] = $representative;

      $data = array('companyName');
      $condition = "companyID = $companyID";
      $company = $this->db->select('company', $data, $condition)[0];
      $info['company'] = $company;

      return $info;
    }

    public function cancelProceed(){
      Session::destroy();
      return true;
    }

    public function submitReceipt(){
      $controlNumber = explode('_', Session::get('verficationTransaction'))[0];
      $repID = explode('_', Session::get('verficationTransaction'))[1];
      $orNum = $controlNumber.'-'.$repID;
      $data = array("max(orNumber) as 'orNumber'");
      $condition = "orNumber LIKE '%$orNum%'";
      $orNumber = $this->db->select('payments', $data, $condition)[0];
      if ($orNumber['orNumber'] == null) {
        $orNum .= '-001';
      }else {
        $orTemp = explode('-', $orNumber['orNumber'])[2] + 1;
        $orNum .= '-00'.$orTemp;
      }

      $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
      try {
        $data = array(
          'paymentID'     => null,
          'orNumber'      => $orNum,
          'controlNumber' => $controlNumber,
          'fileName'      => $orNum.'.'.$ext,
          'type'          => 2
        );
        $result = $this->db->insert('payments', $data);
        if ($result) {
          $filename = $orNum.'.'.$ext;
          $uploadFilePath = 'system/verification/files/payments/2/'.$filename;
          move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);

          $data = array('status' => 1);
          $condition = "verControllerID = $controlNumber";
          $result = $this->db->update('verifications_controller', $data, $condition);

          return true;
        }else {
          return false;
        }
      } catch (PDOException $e) {
        return $e->getMessage();
      }

      // return json_encode($orNum);
    }

    public function createAccount(){
      $pass = uniqid();

      if ($this->fn->is_connected()) {
        try {
          $data = array('email', 'lastName', 'middleName', 'firstName');
          $condition = "repID = ".$_POST['repID'];
          $rep = $this->db->select('representatives', $data, $condition)[0];

          $mail = $this->fn->sendAccountEmail($rep, $pass);
          if ($mail['res']) {
            $data = array('password' => $this->fn->encrypt($pass));
            $condition = "repID = ".$_POST['repID'];
            $result = $this->db->update('representatives', $data, $condition);

            return json_encode(['message' => $mail['msg'], 'res' => 1]);
          }
        } catch (PDOException $e) {
          return json_encode(['message' => $e.getMessage(), 'res' => 0]);
        }
      }else {
        return json_encode(['message' => 'Please make sure you are connected to the network', 'res' => 2]);
      }
    }

  }
