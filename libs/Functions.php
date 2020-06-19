<?php

  /**
   *
   */
  class Functions
  {

    function __construct()
    {
      // echo 'this is the view<br>';
      $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
      $this->gradeRemark = "";
    }

    function count($data){
      return is_array($data) ? count($data) : 0;
    }

    function getRequestDashboardData($date){
      $req_unpaid = 0;$req_releasing = 0; $req_cancelled = 0; $req_processing = 0; $req_claimed = 0;
      $requests = $this->db->select('requests_controller', ['status'], "dateFiled = '$date'");
      foreach ($requests as $key => $request) {
        switch ($request['status']) {
          case 0:
          $req_unpaid += 1;
          break;
          case 1:
          $req_processing += 1;
          break;
          case 2:
          $req_releasing += 1;
          break;
          case 3:
          $req_claimed += 1;
          break;
          default:
          $req_cancelled += 1;
          break;
        }
      }
      return [
        'unpaid' => $req_unpaid,
        'releasing' => $req_releasing,
        'cancelled' => $req_cancelled,
        'processing' => $req_processing,
        'claimed' => $req_claimed
      ];
    }
    function getVerificationDashboardData($date){
      $ver_unpaid = 0;$ver_approval = 0; $ver_verification = 0; $ver_verified = 0;
      $verifications = $this->db->select('verifications_controller', ['status'], "created_on = '$date'");
      foreach ($verifications as $key => $verification) {
        switch ($verification['status']) {
          case 0:
            $ver_unpaid += 1;
            break;
          case 1:
            $ver_approval += 1;
            break;
          case 2:
            $ver_verification += 1;
            break;
          case 3:
            $ver_verified += 1;
            break;
        }
      }
      return [
        'unpaid' => $ver_unpaid,
        'approval' => $ver_approval,
        'verification' => $ver_verification,
        'verified' => $ver_verified
      ];
    }

    function backupDatabaseTables($tables = '*', $filePath = '/') {
    	try {
    		// Get all of the tables
    		if ($tables == '*') {
    			$tables = array();
    			$query = $this->db->query('SHOW TABLES');
          foreach ($query->fetchAll() as $key => $value) {
            $tables[] = $value['Tables_in_odrs'];
          }
    		} else {
    			$tables = is_array($tables) ? $tables : explode(',', $tables);
    		}
    		if (empty($tables)) {
    			return false;
    		}

    		$out = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";'."\n";
        $out .= 'SET AUTOCOMMIT = 0;'."\n";
        $out .= 'START TRANSACTION;'."\n";
        $out .= 'SET time_zone = "+00:00";'."\n";
        $out .= 'SET FOREIGN_KEY_CHECKS=0;'."\n\n\n";


    		// Loop through the tables
    		foreach ($tables as $table) {
    			$query = $this->db->select($table, ['*'], '1');
          $table_cols = $this->db->query("show columns from $table")->fetchAll();
    			$numColumns = count($table_cols);
          $columns = '';
          foreach ($table_cols as $key => $value) {
            $col = $value['Field'];
            $columns .= "`$col`, ";
          }
          $columns = "(".rtrim($columns, ', ').")";

    			// Add DROP TABLE statement
    			$out .= 'DROP TABLE `' . $table . '`;' . "\n\n";

    			// Add CREATE TABLE statement
    			$query2 = $this->db->query('SHOW CREATE TABLE ' . $table);
    			$row2 = $query2->fetchAll();
    			$out .= $row2[0]['Create Table'] . ';' . "\n\n";
          if (count($query) > 0) {
            // Add INSERT INTO statements
            $out .= "INSERT INTO `$table` $columns VALUES \n";
            $i = 0;
            foreach ($query as $key => $row) {
              $j = 0;
              $out .= '(';
              foreach ($row as $key => $cell) {
                $cell = addslashes($cell);
                $cell = preg_replace("/\n/us", "\\n", $cell);
                if ($cell == '') {
                  $out .= 'NULL';
                } else {
                  if (is_numeric($cell)) {
                    if ($cell[0] == 0) {
                      $out .= "'" . $cell . "'";
                    }else {
                      $out .= $cell;
                    }
                  }else {
                    $out .= "'" . $cell . "'";
                  }
                }
                if ($j < ($numColumns - 1)) {
                  $out .= ',';
                }
                $j++;
              }
              $out .= ')';
              if ($i < (count($query) - 1)) {
                $out .= ',' . "\n";
              }else {
                $out .= ';' . "\n";
              }
              $i++;
            }

            $out .= "\n\n\n";
          }
		    }
        $out .= 'SET FOREIGN_KEY_CHECKS=1;'."\n";
        $out .= 'COMMIT;'."\n".'--'.$this->encrypt('ODRSFILEVALIDATION');
  		// Save file
		  file_put_contents($filePath, $out);
  	  } catch (\Exception $e) {
  		echo "<br><pre>Exception => " . $e->getMessage() . "</pre>\n";
  		return false;
  	}
  	return true;
  }


    public function address_format($number, $street, $brgy = null, $city = null, $region, $country, $zipcode = null){
      $address = ucwords(strtolower($number)).' '.ucwords(strtolower($street)).', '.ucwords(strtolower($brgy)).', '.ucwords(strtolower($city)).', '.ucwords(strtolower($region)).', '.ucwords(strtolower($country)).' '.ucwords(strtolower($zipcode));
      if ($brgy === null) {
        $address = ucwords(strtolower($number)).' '.ucwords(strtolower($street)).', '.ucwords(strtolower($city)).', '.ucwords(strtolower($region)).', '.ucwords(strtolower($country)).' '.ucwords(strtolower($zipcode));
        if ($city === null) {
          $address = ucwords(strtolower($number)).' '.ucwords(strtolower($street)).', '.ucwords(strtolower($region)).', '.ucwords(strtolower($country)).' '.ucwords(strtolower($zipcode));
          if ($zipcode === null) {
            $address = ucwords(strtolower($number)).' '.ucwords(strtolower($street)).', '.ucwords(strtolower($region)).', '.ucwords(strtolower($country));
          }
        }
      }
      return $address;
    }

    public function name_format($firstname, $lastname, $middlename = null, $middleinitial = false, $extensionname = null){
      $name = ucwords(strtolower($firstname)).' '.ucwords(strtolower($middlename)).' '.ucwords(strtolower($lastname)).' '.$extensionname;
      if ($middleinitial) {
        $name = ucwords(strtolower($firstname)).' '.strtoupper($middlename[0]).'. '.ucwords(strtolower($lastname)).' '.$extensionname;
        if ($middlename === null) {
          $name = ucwords(strtolower($firstname)).' '.ucwords(strtolower($lastname)).' '.$extensionname;
          if ($extensionname === null) {
            $name = ucwords(strtolower($firstname)).' '.ucwords(strtolower($lastname));
          }
        }
      }
      return $name;
    }
    public function createPermanentAddress($region, $city, $brgy, $houseNum){
      $wBrgy = "Brgy. ".ucwords(strtolower($brgy));
      $address = ucwords(strtolower($houseNum)).', '.$wBrgy.', '.ucwords(strtolower($city)).', '.ucwords(strtolower($region));

      return $address;
    }
    public function isGraduate($num){
      if ($num == 1) {
        $tats = "Graduate";

      }else {
        $tats = "UnderGrad";
      }
      return $tats;
    }
    public function convSem($sem){
      if ($sem == 1) {
        $sem = "First";

      }else if($sem == 2) {
        $sem = "Second";
      }else {
        $sem = "Summer";
      }
      return $sem;
    }
    public function convSchoolYr($year1, $year2){
      $sy = $year1.'-'. $year2;
      return $sy;
    }

    public function is_connected(){
      $connected = @fsockopen('www.google.com', 80);
      if ($connected) {
        fclose($connected);
        return true;
      }
      return false;
    }

    public function sendAccountEmail($rep, $pass){
      $name = $rep['firstName'].' '.$rep['middleName'].' '.$rep['lastName'];
      $message_body = "
    	Hello Mr./Ms. ".$rep['lastName'].",<br><br>

    	Thank you for using PUP's Online Graduate Verification.<br>

    	You can now login using your email and your new password.<br>

      New Password: ".$pass.".<br><br>

    	We are looking forward for more transactions with you!<br><br>

      God bless and have a great day!!";

    	//Load composer's autoloader
      require 'PHPMailer/PHPMailerAutoload.php';

    	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    	try {
    		//Server settings
    		// $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    		$mail->isSMTP();                                      // Set mailer to use SMTP
    		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    		$mail->SMTPAuth = true;                               // Enable SMTP authentication
    		$mail->Username = 'odrspupnoreply@gmail.com';                 // SMTP username
    		$mail->Password = 'mailer@odrspupmanila';                           // SMTP password
    		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    		$mail->Port = 587;                                    // TCP port to connect to

    		//Recipients
    		$mail->setFrom('odrspupnoreply@gmail.com', 'ODRS Mailer');
    		$mail->addAddress($rep['email'], $name);     // Add a recipient

    		//Attachments
    		// $mail->addAttachment('../assets/img/drakeicon.png');         // Add attachments
    		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    		//Content
    		$mail->isHTML(true);                                  // Set email format to HTML
    		$mail->Subject = 'PUP Online Graduate Verification - Requested Account';
    		$mail->Body    = $message_body;
    		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    		$mail->send();
    		return ['msg' => 'Email has been sent', 'res' => true];
    	} catch (Exception $e) {
    		return ['msg' => 'Email could not be sent. Please make sure you are connected to a network. Mailer Error: '. $mail->ErrorInfo, 'res' => false];
    	}
    }

    public function result($id){
      if ($id == 2) {
        return "Invalid";
      }
      return "Valid";
    }

    public function sendDeclineEmail($data){
      $name = $data['repName'];
      $files = "";
      $message_body = "
    	Hello Mr./Ms. ".explode(',', $data['repName'])[0].",<br><br>

    	Thank you for using PUP's Online Graduate Verification.<br>

    	We are sorry to tell you that your Payment Receipt for<br>

      Varification Control ID: ".$data['controlID']."<br><br>

      Was declined due to: <br><br>

      ".$data['reason']."<br><br><br>

      Please Send a valid payment receipt in order for us to process your request.<br><br>

      God bless and have a great day!!<br><br><br>";

    	//Load composer's autoloader
      require 'PHPMailer/PHPMailerAutoload.php';

    	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    	try {
    		//Server settings
    		// $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    		$mail->isSMTP();                                      // Set mailer to use SMTP
    		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    		$mail->SMTPAuth = true;                               // Enable SMTP authentication
    		$mail->Username = 'odrspupnoreply@gmail.com';                 // SMTP username
    		$mail->Password = 'mailer@odrspupmanila';                           // SMTP password
    		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    		$mail->Port = 587;                                    // TCP port to connect to

    		//Recipients
    		$mail->setFrom('odrspupnoreply@gmail.com', 'ODRS Mailer');
    		$mail->addAddress($data['repEmail'], $name);     // Add a recipient

    		//Attachments
        $mail->addAttachment('system/verification/files/payments/2/'.$data['filename'], 'Receipt');         // Add attachments
    		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    		//Content
    		$mail->isHTML(true);                                  // Set email format to HTML
    		$mail->Subject = 'PUP Online Graduate Verification - Payment Receipt Declined';
    		$mail->Body    = $message_body;
    		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    		$mail->send();
    		return ['msg' => 'Email has been sent', 'res' => true];
    	} catch (Exception $e) {
    		return ['msg' => 'Email could not be sent. Please make sure you are connected to a network. Mailer Error: '. $mail->ErrorInfo, 'res' => false];
    	}
    }

    public function sendUpdatesEmail($data){
      $name = $data['name'];
      $type = '';
      $message_body = "
    	Hello Mr./Ms. ".$data['name'].",<br><br>

    	Thank you for using PUP's Online Graduate Verification.<br>

    	You had a transaction last ".$data['filed']."<br>

      Varification Control ID: ".$data['controlNumber']."<br><br>";

      switch ($data['type']) {
        case 1:
        $message_body .= "Your request is ready to be claimed.<br>Please bring your claiming voucher along with the requirements if there is.<br><br>";
        $message_body .= "We are looking forward for more transactions with you!<br><br>";
          break;
        case 2:
        $message_body .= "We are sorry to tell you that we are having some trouble processing your request and there might be a delay on release date.<br> Please see Registrar notes for details.<br><br>";
          break;
        case 3:
        $message_body .= "We are sorry to inform you that your request exceeded the maximum claiming days(90) and your request will be forfeited.<br> Please see Registrar notes for details.<br><br>";
          break;
      }


      $message_body .=  "God bless and have a great day!!<br><br><br>

      Registrar's Note:<br>".$data['notes'];

    	//Load composer's autoloader
      require 'PHPMailer/PHPMailerAutoload.php';

    	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    	try {
    		//Server settings
    		// $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    		$mail->isSMTP();                                      // Set mailer to use SMTP
    		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    		$mail->SMTPAuth = true;                               // Enable SMTP authentication
    		$mail->Username = 'odrspupnoreply@gmail.com';                 // SMTP username
    		$mail->Password = 'mailer@odrspupmanila';                           // SMTP password
    		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    		$mail->Port = 587;                                    // TCP port to connect to

    		//Recipients
    		$mail->setFrom('odrspupnoreply@gmail.com', 'ODRS Mailer');
    		$mail->addAddress($data['email'], "Mr./Ms. ".$data['name']);     // Add a recipient

    		//Attachments
    		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    		//Content
    		$mail->isHTML(true);                                  // Set email format to HTML
    		$mail->Subject = 'PUP Online Graduate Verification - Request Update';
    		$mail->Body    = $message_body;
    		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    		$mail->send();
    		return ['msg' => 'Email has been sent', 'res' => true];
    	} catch (Exception $e) {
    		return ['msg' => 'Email could not be sent. Please make sure you are connected to a network. Mailer Error: '. $mail->ErrorInfo, 'res' => false];
    	}
    }

    public function sendVerResultEmail($data){
      $name = $data['repName'];
      $files = "";
      $message_body = "
    	Hello Mr./Ms. ".explode(',', $data['repName'])[0].",<br><br>

    	Thank you for using PUP's Online Graduate Verification.<br>

    	Here are the result of your Verification Request:<br>

      Varification Control ID: ".$data['controlID']."<br><br>";

      foreach ($data['results'] as $key => $result) {
        $files .= "File ".++$key.": ".$this->result($result['result'])."<br><br>";
      }
      $message_body .= $files;

    	$message_body .= "We are looking forward for more transactions with you!<br><br>

      God bless and have a great day!!<br><br><br>

      Registrar's Note:<br>".$data['notes'];

    	//Load composer's autoloader
      require 'PHPMailer/PHPMailerAutoload.php';

    	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    	try {
    		//Server settings
    		// $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    		$mail->isSMTP();                                      // Set mailer to use SMTP
    		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    		$mail->SMTPAuth = true;                               // Enable SMTP authentication
    		$mail->Username = 'odrspupnoreply@gmail.com';                 // SMTP username
    		$mail->Password = 'mailer@odrspupmanila';                           // SMTP password
    		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    		$mail->Port = 587;                                    // TCP port to connect to

    		//Recipients
    		$mail->setFrom('odrspupnoreply@gmail.com', 'ODRS Mailer');
    		$mail->addAddress($data['repEmail'], $name);     // Add a recipient

    		//Attachments
        foreach ($data['results'] as $key => $result) {
          $mail->addAttachment('system/verification/files/upload/'.$result['docType'].'/'.$result['fileName'], 'File '.++$key);         // Add attachments
        }
    		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    		//Content
    		$mail->isHTML(true);                                  // Set email format to HTML
    		$mail->Subject = 'PUP Online Graduate Verification - Verification Result';
    		$mail->Body    = $message_body;
    		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    		$mail->send();
    		return ['msg' => 'Email has been sent', 'res' => true];
    	} catch (Exception $e) {
    		return ['msg' => 'Email could not be sent. Please make sure you are connected to a network. Mailer Error: '. $mail->ErrorInfo, 'res' => false];
    	}
    }


    public function convert_usertypeID($id){
      switch ($id) {
        case 1:
          return "Admin";
          break;
        case 2:
          return "Registrar Personnel";
          break;
        case 3:
          return "Branch Personnel";
          break;
        case 4:
          return "Office Personnel";
          break;
      }
    }

    public function encrypt($txt){
      $encryption_key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
      $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
      $encrypted = openssl_encrypt($txt, 'aes-256-cbc', $encryption_key, 0,
      $iv);
      return base64_encode($encrypted . '::' . $iv);
    }
    public function decrypt($hash){
      $encryption_key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
      list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($hash),
      2),2,null);
      return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0,
      $iv);
    }

    public function date_to_filipino($date){
      $returnDate = array();
      $date   = explode("-", $date);
      $month  = $date[1];
      switch ($month) {
        case 1:
          $returnDate['month'][0] = "Enero";
          $returnDate['month'][1] = "January";
          break;
        case 2:
          $returnDate['month'][0] = "Pebrero";
          $returnDate['month'][1] = "February";
          break;
        case 3:
          $returnDate['month'][0] = "Marso";
          $returnDate['month'][1] = "March";
          break;
        case 4:
          $returnDate['month'][0] = "Abril";
          $returnDate['month'][1] = "April";
          break;
        case 5:
          $returnDate['month'][0] = "Mayo";
          $returnDate['month'][1] = "May";
          break;
        case 6:
          $returnDate['month'][0] = "Hunyo";
          $returnDate['month'][1] = "June";
          break;
        case 7:
          $returnDate['month'][0] = "Hulyo";
          $returnDate['month'][1] = "July";
          break;
        case 8:
          $returnDate['month'][0] = "Agosto";
          $returnDate['month'][1] = "August";
          break;
        case 9:
          $returnDate['month'][0] = "Setyembre";
          $returnDate['month'][1] = "September";
          break;
        case 10:
          $returnDate['month'][0] = "Oktubre";
          $returnDate['month'][1] = "October";
          break;
        case 11:
          $returnDate['month'][0] = "Nobyembre";
          $returnDate['month'][1] = "November";
          break;
        case 12:
          $returnDate['month'][0] = "Desyembre";
          $returnDate['month'][1] = "December";
          break;
      }
      $day    = $date[2];
      $year   = $date[0][2].$date[0][3];
      switch ($day) {
        case 1:
          $returnDate['day'][0] = "isa";
          $returnDate['day'][1] = "1st";
          break;
        case 2:
          $returnDate['day'][0] = "dalawa";
          $returnDate['day'][1] = "2nd";
          break;
        case 3:
          $returnDate['day'][0] = "tatlo";
          $returnDate['day'][1] = "3rd";
          break;
        case 4:
          $returnDate['day'][0] = "apat";
          $returnDate['day'][1] = "4th";
          break;
        case 5:
          $returnDate['day'][0] = "lima";
          $returnDate['day'][1] = "5th";
          break;
        case 6:
          $returnDate['day'][0] = "anim";
          $returnDate['day'][1] = "6th";
          break;
        case 7:
          $returnDate['day'][0] = "pito";
          $returnDate['day'][1] = "7th";
          break;
        case 8:
          $returnDate['day'][0] = "walo";
          $returnDate['day'][1] = "8th";
          break;
        case 9:
          $returnDate['day'][0] = "siyam";
          $returnDate['day'][1] = "9th";
          break;
        case 10:
          $returnDate['day'][0] = "sampu";
          $returnDate['day'][1] = "10th";
          break;
        case 11:
          $returnDate['day'][0] = "labing isa";
          $returnDate['day'][1] = "11th";
          break;
        case 12:
          $returnDate['day'][0] = "labing dalawa";
          $returnDate['day'][1] = "12th";
          break;
        case 13:
          $returnDate['day'][0] = "labing tatlo";
          $returnDate['day'][1] = "13th";
          break;
        case 14:
          $returnDate['day'][0] = "labing apat";
          $returnDate['day'][1] = "14th";
          break;
        case 15:
          $returnDate['day'][0] = "labing lima";
          $returnDate['day'][1] = "15th";
          break;
        case 16:
          $returnDate['day'][0] = "labing anim";
          $returnDate['day'][1] = "16th";
          break;
        case 17:
          $returnDate['day'][0] = "labing pito";
          $returnDate['day'][1] = "17th";
          break;
        case 18:
          $returnDate['day'][0] = "labing walo";
          $returnDate['day'][1] = "18th";
          break;
        case 19:
          $returnDate['day'][0] = "labing siyam";
          $returnDate['day'][1] = "19th";
          break;
        case 20:
          $returnDate['day'][0] = "dalawampu";
          $returnDate['day'][1] = "20th";
          break;
        case 21:
          $returnDate['day'][0] = "dalawampu't isa";
          $returnDate['day'][1] = "21st";
          break;
        case 22:
          $returnDate['day'][0] = "dalawampu't dalawa";
          $returnDate['day'][1] = "22nd";
          break;
        case 23:
          $returnDate['day'][0] = "dalawampu't tatlo";
          $returnDate['day'][1] = "23rd";
          break;
        case 24:
          $returnDate['day'][0] = "dalawampu't apat";
          $returnDate['day'][1] = "24th";
          break;
        case 25:
          $returnDate['day'][0] = "dalawampu't lima";
          $returnDate['day'][1] = "25th";
          break;
        case 26:
          $returnDate['day'][0] = "dalawampu't anim";
          $returnDate['day'][1] = "26th";
          break;
        case 27:
          $returnDate['day'][0] = "dalawampu't pito";
          $returnDate['day'][1] = "27th";
          break;
        case 28:
          $returnDate['day'][0] = "dalawampu't walo";
          $returnDate['day'][1] = "28th";
          break;
        case 29:
          $returnDate['day'][0] = "dalawampu't siyam";
          $returnDate['day'][1] = "29th";
          break;
        case 30:
          $returnDate['day'][0] = "tatlumpu";
          $returnDate['day'][1] = "30th";
          break;
        case 31:
          $returnDate['day'][0] = "tatlumpu't isa";
          $returnDate['day'][1] = "31st";
          break;
      }
      switch ($year) {
        case 1:
          $returnDate['year'][0] = "isa";
          $returnDate['year'][1] = "1st";
          break;
        case 2:
          $returnDate['year'][0] = "dalawa";
          $returnDate['year'][1] = "2nd";
          break;
        case 3:
          $returnDate['year'][0] = "tatlo";
          $returnDate['year'][1] = "3rd";
          break;
        case 4:
          $returnDate['year'][0] = "apat";
          $returnDate['year'][1] = "4th";
          break;
        case 5:
          $returnDate['year'][0] = "lima";
          $returnDate['year'][1] = "5th";
          break;
        case 6:
          $returnDate['year'][0] = "anim";
          $returnDate['year'][1] = "6th";
          break;
        case 7:
          $returnDate['year'][0] = "pito";
          $returnDate['year'][1] = "7th";
          break;
        case 8:
          $returnDate['year'][0] = "walo";
          $returnDate['year'][1] = "8th";
          break;
        case 9:
          $returnDate['year'][0] = "siyam";
          $returnDate['year'][1] = "9th";
          break;
        case 10:
          $returnDate['year'][0] = "sampu";
          $returnDate['year'][1] = "10th";
          break;
        case 11:
          $returnDate['year'][0] = "labing isa";
          $returnDate['year'][1] = "11th";
          break;
        case 12:
          $returnDate['year'][0] = "labing dalawa";
          $returnDate['year'][1] = "12th";
          break;
        case 13:
          $returnDate['year'][0] = "labing tatlo";
          $returnDate['year'][1] = "13th";
          break;
        case 14:
          $returnDate['year'][0] = "labing apat";
          $returnDate['year'][1] = "14th";
          break;
        case 15:
          $returnDate['year'][0] = "labing lima";
          $returnDate['year'][1] = "15th";
          break;
        case 16:
          $returnDate['year'][0] = "labing anim";
          $returnDate['year'][1] = "16th";
          break;
        case 17:
          $returnDate['year'][0] = "labing pito";
          $returnDate['year'][1] = "17th";
          break;
        case 18:
          $returnDate['year'][0] = "labing walo";
          $returnDate['year'][1] = "18th";
          break;
        case 19:
          $returnDate['year'][0] = "labing siyam";
          $returnDate['year'][1] = "19th";
          break;
        case 20:
          $returnDate['year'][0] = "dalawampu";
          $returnDate['year'][1] = "20th";
          break;
        case 21:
          $returnDate['year'][0] = "dalawampu't isa";
          $returnDate['year'][1] = "21st";
          break;
        case 22:
          $returnDate['year'][0] = "dalawampu't dalawa";
          $returnDate['year'][1] = "22nd";
          break;
        case 23:
          $returnDate['year'][0] = "dalawampu't tatlo";
          $returnDate['year'][1] = "23rd";
          break;
        case 24:
          $returnDate['year'][0] = "dalawampu't apat";
          $returnDate['year'][1] = "24th";
          break;
        case 25:
          $returnDate['year'][0] = "dalawampu't lima";
          $returnDate['year'][1] = "25th";
          break;
        case 26:
          $returnDate['year'][0] = "dalawampu't anim";
          $returnDate['year'][1] = "26th";
          break;
        case 27:
          $returnDate['year'][0] = "dalawampu't pito";
          $returnDate['year'][1] = "27th";
          break;
        case 28:
          $returnDate['year'][0] = "dalawampu't walo";
          $returnDate['year'][1] = "28th";
          break;
        case 29:
          $returnDate['year'][0] = "dalawampu't siyam";
          $returnDate['year'][1] = "29th";
          break;
        case 30:
          $returnDate['year'][0] = "tatlumpu";
          $returnDate['year'][1] = "30th";
          break;
        case 31:
          $returnDate['year'][0] = "tatlumpu't isa";
          $returnDate['year'][1] = "31st";
          break;
      }
      return $returnDate;
    }
    public function convert_docID($id){
          switch ($id) {
            case 3:
              return "Transcript of Records";
              break;
            case 5:
              return "Diploma";
              break;

          }
        }
        public function convert_result($id){
          switch ($id) {
            case 0:
                return "<span class='btn btn-secondary btn-sm w-100'>Undefined</span>";
              break;
            case 1:
            return "<span class='btn btn-success btn-sm w-100'>Valid</span>";
              break;
            case 2:
            return "<span class='btn btn-danger btn-sm w-100'>Invalid</span>";
            break;

          }
        }
        public function verify_status($n){
      if ($n == 1) {
          return "<span class='btn btn-outline-warning btn-sm w-100'>For Approval</span>";
      } else if ($n == 0) {
          return "<span class='btn btn-outline-secondary btn-sm w-100'>Waiting for Payment</span>";
      } else if ($n == 2) {
          return "<span class='btn btn-outline-info btn-sm w-100'>For Verification</span>";
      } else if ($n == 3) {
          return "<span class='btn btn-outline-success btn-sm w-100'>Verified</span>";
      }
    }
    public function clearanceStats($id){
      switch ($id) {
        case 0:
            return "<span class='btn btn-danger btn-sm w-100'>Unsettled</span>";
          break;
        case 1:
        return "<span class='btn btn-success btn-sm w-100'>Cleared</span>";
          break;
        case 2:
        return "<span class='btn btn-danger btn-sm w-100'>Un</span>";
        break;

      }
    }
    public function document_status($n){
      if ($n == 0) {
        return "<span class='btn btn-outline-warning btn-sm w-100'>For Printing</span>";
      } else if ($n == 1) {
          return "<span class='btn btn-outline-success btn-sm w-100'>For Validating</span>";
      }else if ($n == 2) {
          return "<span class='btn btn-outline-primary btn-sm w-100'>Validated</span>";
      }
    }

    public function request_status($n) {
        if ($n == 0) {
          return "<span class='btn btn-outline-danger btn-sm w-100'>Waiting for Payment</span>";
        } else if ($n == 1) {
          return "<span class='btn btn-outline-warning btn-sm w-100'>Processing</span>";
        } else if ($n == 2) {
          return "<span class='btn btn-outline-primary btn-sm w-100'>For Releasing</span>";
        } else if ($n == 3) {
          return "<span class='btn btn-outline-success btn-sm w-100'>Claimed</span>";
        } else if ($n == 4) {
            return "<span class='btn btn-outline-secondary btn-sm w-100'>Cancelled</span>";
        } else if ($n == 5) {
            return "<span class='btn btn-outline-secondary btn-sm w-100'>Forfeited</span>";
        }
    }
    public function student_request_status($n) {
        if ($n == 0) {
          return "<span class='btn btn-outline-danger btn-sm w-100'>Waiting for your Payment</span>";
        } else if ($n == 1) {
          return "<span class='btn btn-outline-warning btn-sm w-100'>Your Request is being processed</span>";
        } else if ($n == 2) {
          return "<span class='btn btn-outline-primary btn-sm w-100'>Your Request is ready to be claimed</span>";
        } else if ($n == 3) {
          return "<span class='btn btn-outline-success btn-sm w-100'>Claimed</span>";
        } else if ($n == 4) {
            return "<span class='btn btn-outline-secondary btn-sm w-100'>Cancelled</span>";
        } else if ($n == 5) {
            return "<span class='btn btn-outline-secondary btn-sm w-100'>Forfeited</span>";
        }
    }
    public function request_is_fastlane($bool) {
        return $bool == 1 ? '<i class="fa fa-bolt btn w-100 btn-warning"></i>' : '';
    }

    function getDocumentId($doc){
      switch ($doc) {
        case 'tor':
          return 13;
          break;
        case 'dip':
          return 12;
          break;
      }
    }

    public function createVoucher($pdf, $controlNumber, $info){
      $totalFee = 0;
      foreach ($info['documents'] as $value) {
        $totalFee += ($value['price']);
      }
      if ($info['fastlane'] == 1) {
        $totalFee *= 2;
      }
      $pdf->AddPage();
      $pdf->SetLeftMargin(20);
      $pdf->SetTopMargin(20);
      $pdf->SetRightMargin(20);
      $pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
      $pdf->AddFont('Calibri Bold','I','Calibri Bold.php');
      $pdf->AddFont('Calibri','','Calibri.php');
      $pdf->SetY(10);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(80,4,"Republic of the Philippines",0,0,'L',false);
      $pdf->Cell(0,4,"Online Document Request",0,1,'R',false);
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->Cell(0,6,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES",0,1,'L',false);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(80,4,"Sta. Mesa, Manila",0,0,'L',false);
      $pdf->SetY(20);
      $pdf->SetFont('Calibri Bold','B',22);
      $pdf->SetTextColor(224,64,64);
      if ($info['type'] == 1) {
        $pdf->Cell(0,6,"CASHIER'S COPY",0,1,'R',false);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Calibri Bold','B',16);
        $pdf->SetY(35);
        $pdf->Cell(50,6,"Reference Number: ",0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',18);
        $pdf->Cell(0,6,$controlNumber,0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',16);
        $pdf->SetY(43);
        $pdf->Cell(50,6,"Name: ",0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',18);
        $pdf->Cell(0,6,$info['studentName'],0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',18);
        $pdf->SetY(50);
        $pdf->Cell(50,6,"Fast Lane: ",0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',18);
        $pdf->Cell(0,6,($info['fastlane'] == 1) ? 'Yes (request fee is doubled)' : 'No',0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',18);
        $pdf->SetY(60);
        $pdf->Cell(50,6,"Request Fee: ",0,0,'L',false);
        $pdf->Cell(50,6,number_format($totalFee, 2),0,1,'L',false);
        $pdf->SetFont('Calibri','',10);
        $pdf->SetY(75);
        $pdf->Cell(15,6,"This is the",0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',10);
        $pdf->Cell(23,6,"Cashier's copy. ",0,0,'L',false);
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell(0,6,"Present it to the PUP Main Campus Cashier when you pay the Request Fee.",0,1,'L',false);
        $pdf->SetY(85);
        $pdf->SetFont('Calibri Bold','B',12);
        $pdf->Cell(0,6,"PUP Cashier",0,1,'L',false);
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell(19,6,"1. Pay at the",0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',10);
        $pdf->Cell(23,6,"Cashier's Office",0,0,'L',false);
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell(0,6,"(Main Building, Ground Floor South Wing)",0,1,'L',false);
        $pdf->Cell(18,6,"2. Go to the",0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',10);
        $pdf->Cell(35,6,"Student Records Office",0,0,'L',false);
        $pdf->SetFont('Calibri','',10);
        $pdf->Cell(0,6,"for the Processing of Request/s (Main Building, Ground Floor South Wing)",0,1,'L',false);
        $pdf->setY(120);
      }elseif ($info['type'] == 2) {
        $pdf->Cell(0,6,"BANK'S COPY",0,1,'R',false);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetY(45);
        $pdf->SetFont('Calibri','',14);
        $pdf->Cell(150,8,"Total Amount Due: ",0,0,'R',false);
        $pdf->SetFont('Calibri Bold','B',16);
        $pdf->Cell(0,8,'PHP '.number_format($totalFee, 2),0,1,'L',false);
        $pdf->SetFont('Calibri','',14);
        $pdf->Cell(150,8,"Bank Service Fee: ",0,0,'R',false);
        $pdf->SetFont('Calibri Bold','B',16);
        $pdf->Cell(0,8,'PHP 25.00',0,1,'L',false);
        $pdf->setY(37);
        $pdf->SetFont('Calibri','',14);
        $pdf->Cell(50,8,"Name: ",0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',14);
        $pdf->Cell(0,8,$info['studentName'],0,1,'L',false);
        $pdf->SetFont('Calibri','',14);
        $pdf->Cell(50,8,"Reference Number: ",0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',14);
        $pdf->Cell(0,8,$controlNumber,0,1,'L',false);
        $pdf->SetFont('Calibri','',14);
        $pdf->Cell(50,8,"Clearing Account No: ",0,0,'L',false);
        $pdf->SetFont('Calibri Bold','B',14);
        $pdf->Cell(0,8,'0682-2220-18',0,1,'L',false);
        $pdf->SetFont('Calibri','',10);
        $pdf->setY(67);
        $pdf->MultiCell(0,6,"This is the Bank’s copy. Detach this part and present to the Bank Teller (together with the Bank’s fully­accomplished Deposit Slip) when you pay your Verification Request Fee.",0,'L',false);
      }
      $pdf->Cell(0,8,'',"B",1,'C',false);

      $pdf->SetY(150);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(80,4,"Republic of the Philippines",0,0,'L',false);
      $pdf->Cell(0,4,"Online Document Request",0,1,'R',false);
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->Cell(0,6,"POLYTECHNIC UNIVERSITY OF THE PHILIPPINES",0,1,'L',false);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(80,4,"Sta. Mesa, Manila",0,0,'L',false);
      $pdf->SetY(160);
      $pdf->SetFont('Calibri Bold','B',22);
      $pdf->SetTextColor(224,64,64);
      $pdf->Cell(0,6,"REGISTRAR'S COPY",0,1,'R',false);
      $pdf->SetTextColor(0,0,0);
      $pdf->SetFont('Calibri Bold','B',16);
      $pdf->SetY(170);
      $pdf->Cell(50,6,"Reference Number: ",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->Cell(0,6,$controlNumber,0,0,'L',false);
      $pdf->SetY(178);
      $pdf->Cell(50,6,"Name: ",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->Cell(0,6,$info['studentName'],0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->SetY(185);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->Cell(50,6,"Fast Lane: ",0,0,'L',false);
      $pdf->Cell(0,6,($info['fastlane'] == 1) ? 'Yes (request fee is doubled)' : 'No',0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->SetY(200);
      $pdf->Cell(50,6,"Request Fee: ",0,0,'L',false);
      $pdf->Cell(50,6,number_format($totalFee, 2),0,1,'L',false);
      $pdf->SetY(210);
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->Cell(0,6,"GENERAL CLEARANCE: _______________",0,1,'L',false);
      $pdf->SetY(220);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(0,6,"If payment was made on the Cashier's Office, Submit this copy to the Registrar's Office after payment.",0,1,'L',false);
      $pdf->Cell(0,6,"If payment was made on bank, Submit this copy to the Registrar's Office along with the receipt.",0,1,'L',false);



      $pdf->AddPage();
      $pdf->SetLeftMargin(20);
      $pdf->SetTopMargin(20);
      $pdf->SetRightMargin(20);
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
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->Cell(0,6,"Tentative Date of Release: ".$info['tentativeDate'],0,1,'R',false);
      $pdf->SetFont('Calibri Bold','B',16);
      $pdf->SetY(45);
      $pdf->Cell(50,6,"Reference Number: ",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->Cell(0,6,$controlNumber,0,0,'L',false);
      $pdf->SetY(53);
      $pdf->Cell(50,6,"Name: ",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->Cell(0,6,$info['studentName'],0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->SetY(60);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->Cell(50,6,"Fast Lane: ",0,0,'L',false);
      $pdf->Cell(0,6,($info['fastlane'] == 1) ? 'Yes (request fee is doubled)' : 'No',0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',18);
      $pdf->SetY(68);
      $pdf->SetFont('Calibri','',12);
      $pdf->Cell(00,6,$info['courseDescription'],0,1,'L',false);
      $pdf->Cell(00,6,"Admitted: ".$info['yearAdmitted'],0,1,'L',false);
      $pdf->SetY(90);
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->Cell(50,6,"Request Fee: ",0,0,'L',false);
      $pdf->Cell(50,6,number_format(($info['fastlane'] == 1) ? $totalFee/2 : $totalFee, 2),0,1,'L',false);
      $pdf->SetY(100);
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->Cell(0,6,"Breakdown of fees",0,1,'L',false);
      $pdf->Cell(90,6,"Item",0,0,'L',false);
      $pdf->Cell(50,6,"Qty",0,0,'L',false);
      $pdf->Cell(50,6,"Amount",0,1,'L',false);
      $pdf->SetFont('Calibri','',12);
      foreach ($info['documents'] as $value) {
        $pdf->Cell(90,6,$value['description'],0,0,'L',false);
        $pdf->Cell(50,6,$value['quantity'],0,0,'L',false);
        $pdf->Cell(50,6,$value['price'],0,1,'L',false);
      }
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->Cell(140,10,"Total",0,0,'L',false);
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->Cell(50,10,number_format($totalFee, 2),0,1,'L',false);
      $pdf->SetFont('Calibri Bold','B',12);
      $pdf->Cell(140,10,"Requirements",0,0,'L',false);
      $pdf->setY(145);
      foreach ($info['documents'] as $value) {
        $pdf->SetFont('Calibri Bold','B',10);
        $pdf->Cell(90,6,$value['description'],0,1,'L',false);
        $pdf->SetFont('Calibri','',10);
        $pdf->setX(40);
        $pdf->MultiCell(0,6,$value['requirements'],0,'L',false);
      }
      $pdf->Cell(0,8,'',"B",1,'C',false);
      $pdf->setY(190);
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->MultiCell(0,6,"BRING DOCUMENTARY STAMP (1 Doc Stamp per document) & TWO (2) RECENT VALID ID WITH PHOTO WHEN CLAIMING",0,'L',false);
      $pdf->SetFont('Calibri','',10);
      $pdf->Cell(0,6,"Note: Release of document may be delayed due to some technical problem.",0,1,'L',false);
      $pdf->Cell(0,6,"Check your Online Document Request Account from time to time for the status of your request.",0,1,'L',false);
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->Cell(0,8,"",0,1,'L',false);
      $pdf->MultiCell(0,6,"All requested credentials will be released to the following assigned representatives other than the student/client:",0,'L',false);
      $pdf->SetFont('Calibri','',10);
      $pdf->MultiCell(0,6,"*PARENTS/SIBLINGS/SPOUSE/CHILDREN - with formal authorization letter duly signed by the student with two (2) valid ID's with picture of both the student/client and the representative and photocopy of the representative's PSA (NSO) Birth Certificate and PSA (NSO) marriage contract for the spouse.",0,'L',false);
      $pdf->MultiCell(0,6,"*REPRESENTATIVE OTHER THAN THE IMMEDIATE FAMILY - with Special Power of Attorney from the student concerned, duly notarized in the country/place of residence and two (2) valid ID's with picture of both.",0,'L',false);
      $pdf->MultiCell(0,6,"All document requests NOT claimed within 90 days from the due date shall be forfieted.",0,'L',false);



      $pdf->output('I');
    }

    public function createDiploma($data){


      $pdf = new FPDF('L');
      $fn = new Functions();

      $pdf->AddPage();
      $pdf->SetLeftMargin(35);
      $pdf->SetTopMargin(0);
      $pdf->SetRightMargin(35);
      $pdf->AddFont('Cooper Black Regular','B','Cooper Black Regular.php');
      $pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
      $pdf->AddFont('Typo_Script_HPLHS','B','Typo_Script_HPLHS.php');
      $pdf->AddFont('Engravers Old English Normal','B','Engravers Old English Normal.php');
      $pdf->AddFont('Engravers Old English Normal','I','Engravers Old English Normal.php');
      $pdf->SetFont('Cooper Black Regular','B',12);
      $pdf->SetY(5);
      $pdf->Cell(0,4,"REPUBLIKA NG PILIPINAS",0,1,'C',false);
      $pdf->SetFont('Times','B',10);
      $pdf->Cell(0,4,"Republic of the Philippines",0,1,'C',false);
      $pdf->Image(URL."public/img/pdfimgs/diploma_header.png",35, 10, 225);
      $pdf->SetY(35);
      $pdf->Cell(0,4,$data['branch'],0,1,'C',false);
      $pdf->SetY(42);
      $pdf->SetFont('Engravers Old English Normal','B',24);
      $pdf->Cell(0,4,"Sa Lahat ng Makatutunghay sa Kasulatang Ito:",0,1,'C',false);
      $pdf->SetFont('Times','',10);
      $pdf->Cell(0,8,"To     All     Persons     Who     May     Read     This     Document:  ",0,1,'C',false);
      $pdf->SetFont('Cooper Black Regular','B',18);
      $pdf->Cell(0,4,"MAPITAGANG BATI.",0,1,'C',false);
      $pdf->SetFont('Times','',12);
      $pdf->Cell(0,8,"G  R  E  E  T  I  N  G  S.",0,1,'C',false);
      $pdf->setY(63);
      $pdf->SetFont('Engravers Old English Normal','B',18);
      $pdf->Cell(33,10,"Ipinababatid",0,0,'L',false);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->Cell(0,7,"na ang Lupon ng mga Regente, sa pamamagitan ng kapangyarihang kaloob",0,1,'L',false);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(0,6,"  Be          it         known           that     the           Board                of                       Regents,                                by                                                       authority                                  granted",0,1,'L',false);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->SetY(73);
      $pdf->Cell(0,7,"ng Republika ng Pilipinas, at sa tagubilin ng Sanggunian ng Unibersidad, ay naggawad kay",0,1,'L',false);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(0,6,"  by     the     Republic  of    the         Philippines,          and  upon          recommendation                         of   the             University     Council,                has           conferred         upon",0,1,'L',false);
      $pdf->SetY(88);
      $pdf->SetFont('Engravers Old English Normal','B',32);
      $pdf->Cell(0,4,$data['name'],0,1,'C',false);
      $pdf->SetXY(65,93);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->Cell(0,6,"na nakatupad      sa lahat   ng kinakailangan    ukol  sa     titulong",0,1,'L',false);
      $pdf->SetX(65);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(0,6,"  who       has        fulfilled                            all                   the         requirements                                for         the               degree  of",0,1,'L',false);
      $pdf->SetXY(35, 105);
      $pdf->SetFont('Times','B',22);
      $pdf->Cell(0,4,$data['course'],0,1,'C',false);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->SetY(110);
      $pdf->Cell(0,7,"kalakip ang lahat ng karapatan, karangalan, at mga pribilehiyo gayon din ang mga tungkulin",0,1,'L',false);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(0,6,"  with                     all                  the                            rights,                             honors                            and                  privileges                     as                well        as            the          obligations",0,1,'L',false);$pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->SetY(120);
      $pdf->Cell(0,7,"at  pananagutang  nauukol  dito.",0,1,'L',false);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(0,6,"  and         responsibilities                        pertaining        to   it.",0,1,'L',false);
      $pdf->setXY(103, 130);
      $pdf->SetFont('Engravers Old English Normal','B',18);
      $pdf->Cell(45,10,"Bilang katunayan, ",0,0,'L',false);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->Cell(0,7," ang   tatak   ng   Unibersidad   at  ang   lagda",0,1,'L',false);
      $pdf->setX(103);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(0,6," In                      Testimony,                      the                    seal           of   the             University                and        the           signature",0,1,'L',false);
      $pdf->setXY(103, 140);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->Cell(0,7,"ng  Pangulo   ng   Unibersidad   ay   taglay   nito.",0,1,'L',false);
      $pdf->setX(103);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(0,6," of   the        President       of  the                    University            are                hereto              affixed.",0,1,'L',false);
      $pdf->setXY(103, 153);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->Cell(110,7,"Inilagda sa Maynila, Pilipinas ngayong ika ",0,0,'L',false);
      $pdf->SetFont('Times','BUI',12);
      $pdf->Cell(45,10,"     ".$data['day'][0]."    ",0,0,'L',false);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->Cell(0,7,"ng",0,1,'L',false);
      $pdf->setX(103);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(0,6," Given                        at              Manila,                    Philippines                                     this                            ".$data['day'][1]." day                         of",0,1,'L',false);
      $pdf->setXY(103, 163);
      $pdf->SetFont('Times','BUI',12);
      $pdf->Cell(60,10,"                       ".$data['month'][0]."                     ",0,0,'L',false);
      $pdf->SetFont('Typo_Script_HPLHS','B',30);
      $pdf->Cell(68,7,"ng taong Dalawang Libo at ",0,0,'L',false);
      $pdf->SetFont('Times','BUI',12);
      $pdf->Cell(0,10,"        ".$data['year'][0]."        .",0,1,'L',false);
      $pdf->setXY(103, 169);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(125,8,"                                    ".$data['month'][1]."                                         of       the    year            Two                Thousand   and",0,0,'L',false);
      $pdf->SetFont('Times','BUI',8);
      $pdf->Cell(0,8,"                       ".$data['year'][1]."                    ",0,1,'L',false);
      $pdf->SetFont('Times','B',10);
      $pdf->SetAutoPageBreak(true,1);
      $pdf->SetXY(110, 192);
      $pdf->Cell(0,6,$GLOBALS['UNIV_REGISTRAR'],0,1,'L',false);
      $pdf->SetXY(122, 195);
      $pdf->SetFont('Times','I',10);
      $pdf->Cell(0,6,"University Registrar",0,1,'L',false);
      $pdf->SetFont('Times','B',10);
      $pdf->SetXY(210, 192);
      $pdf->Cell(0,6,$GLOBALS['UNIV_PRESIDENT'],0,1,'L',false);
      $pdf->SetXY(230, 195);
      $pdf->SetFont('Times','I',10);
      $pdf->Cell(0,6,"President",0,1,'L',false);
      $pdf->SetXY(45, 198);
      $pdf->SetFont('Calibri Bold','B',10);
      $pdf->Cell(0,6,"Diploma No.".$data['diplomaNumber'],0,1,'L',false);

      $pdf->Output('diploma.pdf','I');
    }

    public function sem($sem){
      switch ($sem) {
        case 1:
          return "FIRST SEMESTER";
          break;
        case 2:
          return "SECOND SEMESTER";
          break;
        case 3:
          return "SUMMER SEMESTER";
          break;
      }
    }

    public function createTOR($data){
      $pdf = new AlphaPDF('P', 'mm', array(215.9,330.2));
      $fn = new Functions;
      // $data = $this->credentials;
      // $info = $this->studentInfo;
      $branchOfficials['director'] = $data['info']['branchdir'];
      $branchOfficials['preparedBy'] = $data['info']['preparedBy'];
      $gradeRemark = $this->gradeRemark;
      $subjectCounter = 0;
      $page = 1;

        $pdf->AddPage();
        $pdf->AddFont('Calibri','','Calibri.php');
        $pdf->AddFont('BodoniMTBlack','B','BodoniMTBlack.php');
        $pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
        $pdf->SetMargins(10, 5, 10);

        $this->createTORHeader($pdf, $page, "torpic.png", true, $data['info']['branch']);
        $this->createTORInfo($pdf, $data['info']);
        $this->createTORCredentiaTable($pdf);
        $pdf->SetXY(12, 113);
        foreach ($data['subjects'] as $sem => $subjects) {
          //sem
          $pdf->SetFont('Times','IBU',10);
          $pdf->Cell(3,5,"",0,0,'C',false);
          $pdf->Cell(32,5,"",0,0,'C',false);
          $pdf->Cell(24,5,$sem,0,1,'L',false);
          foreach ($subjects as $subject) {
            //subs
            $pdf->SetFont('Times','',9);
            $pdf->Cell(3,3.5,"",0,0,'C',false);
            $pdf->Cell(20,3.5,$subject['code'],0,0,'L',false);
            $pdf->Cell(5,3.5,"",0,0,'C',false);
            if (strlen($subject['description']) > 60) {
              $x = $pdf->GetX();
              $y = $pdf->GetY();
              $pdf->MultiCell(115,3.5,$subject['description'],0,'L',false);
              $pdf->SetXY($x+115,$y+3.5);
            }else {
              $pdf->Cell(115,3.5,$subject['description'],0,0,'L',false);
            }
            $pdf->Cell(5,3.5,"",0,0,'C',false);
            $remark = $this->getRemark($subject['grades']);
            $gradeRemark .= $remark;
            $pdf->Cell(24,3.5,$subject['grades'],0,0,'C',false);
            $pdf->Cell(24,3.5,$subject['credits'],0,1,'C',false);
            $subjectCounter++;
            if ($subjectCounter == 30) {
              $page++;
              $pdf->Cell(7,3,'',0,0,'C',false);
              $nxt = '';
              for ($i=1; $i < 30 ; $i++) {
                $nxt .= 'x-';
              }
              $nxt = rtrim($nxt, '-');
              $pdf->Cell(176,3,$nxt.' MORE ON NEXT PAGE '.$nxt,0,1,'C',false);
              //Credentials
              $this->createTORFooter($pdf, $gradeRemark, $branchOfficials, '•ðþ');
              $gradeRemark = '';
              $pdf->AddPage();
              $pdf->AddFont('Calibri','','Calibri.php');
              $pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
              $pdf->SetMargins(10, 5, 10);
              $this->createTORHeader($pdf, $page, 'torpic.png', false, $data['info']['branch']);
              $this->createTORInfo($pdf, $data['info']);
              $this->createTORCredentiaTable($pdf);
              $pdf->SetFont('Times','IBU',10);
              $pdf->Cell(3,5,"",0,0,'C',false);
              $pdf->Cell(32,5,"",0,0,'C',false);
              $pdf->Cell(24,5,$sem,0,1,'L',false);
              $subjectCounter = 0;
            }
          }

        }
        $pdf->Cell(7,3,'',0,0,'C',false);
        $pdf->Cell(3,3.5,"",0,0,'C',false);
        $pdf->Cell(20,3.5,'',0,0,'L',false);
        $pdf->SetFont('Times','B',9.5);
        $pdf->MultiCell(155,3.5,"GRADUATED IN ".strtoupper($data['info']['course'])." PROGRAM ON ".strtoupper($data['info']['dateGraduated']),0,'L',false);
        $pdf->Cell(7,3,'',0,0,'C',false);
        $pdf->Cell(3,3.5,"",0,0,'C',false);
        $pdf->Cell(20,3.5,'',0,0,'L',false);
        $pdf->MultiCell(155,3.5,'AS A STATE UNIVERSITY THE POLYTECHNIC UNIVERSITY OF THE PHILIPPINES DOES NOT ISSUE "SPECIAL ORDER" TO ITS GRADUATE.',0,'L',false);

        $pdf->SetFont('Times','',9);
        $pdf->Cell(7,3,'',0,0,'C',false);
        $nxt = '';
        for ($i=1; $i < 30 ; $i++) {
          $nxt .= 'x-';
        }
        $nxt = rtrim($nxt, '-');
        $pdf->Cell(176,3,$nxt.' NOTHING FOLLOWS '.$nxt,0,1,'C',false);
        $pdf->Cell(7,3,'',0,0,'C',false);
        $pdf->Cell(3,3.5,"",0,0,'C',false);
        $pdf->Cell(20,3.5,'',0,0,'L',false);
        // $pdf->Cell(130,3.5,'COPY FOR: POLYTECHNIC UNIVERSITY OF THE PHILIPPINES - MANILA',0,0,'C',false);
        //Credentials
        $this->createTORFooter($pdf, $gradeRemark, $branchOfficials, '•¥§', true);

        $pdf->Output('tor.pdf','I');
    }


    public function createTORHeader($pdf, $page, $torpic, $img = true, $branch){
      //header
      $pdf->SetFont('Calibri','',6);
      $pdf->Cell(0,2,'PUP FROM NO. I-A',0,1,'L',false);
      $pdf->Cell(0,2,'April 2012',0,1,'L',false);
      $pdf->Image(URL."public/img/pdfimgs/puplogo.png", 23, 15, 23);
      $pdf->SetFont('Times','',11);
      $pdf->Cell(0,8,'',0,1,'C',false);
      $pdf->Cell(0,4,'Republic of the Philippines',0,1,'C',false);
      $pdf->SetFont('BodoniMTBlack','B',11);
      $pdf->Cell(0,4,'POLYTECHNIC UNIVERSITY OF THE PHILIPPINES',0,1,'C',false);
      $pdf->SetFont('Helvetica','',10);
      $pdf->Cell(0,4,'OFFICE OF THE UNIVERSITY REGISTRAR',0,1,'C',false);
      $pdf->SetFont('Times','',11);
      $pdf->Cell(0,4,$branch,0,1,'C',false);
      $pdf->SetFont('Calibri','',11);
      $pdf->Cell(0,2,'',0,1,'C',false);
      $pdf->Cell(50,4,'STATE U',0,0,'C',false);
      $pdf->Cell(7,4,'',0,0,'C',false);
      $pdf->SetFont('Times','B',12);
      $pdf->Cell(20,6,'OFFICIAL TRANSCRIPT OF RECORDS',0,1,'L',false);
      $pdf->SetFont('Times','',10);
      $pdf->Cell(150,4,'',0,1,'R',false);
      $pdf->Cell(160,4,'Page '.$page,0,1,'R',false);
      $pdf->Cell(175,4,'Date: '.date('F d, Y'),0,1,'R',false);
      if ($img) {
        // $pdf->Image(URL."public/img/pdfimgs/".$torpic, 165, 5, 45);
      }
      // header
    }
    public function createTORInfo($pdf, $info){
      //info
      $pdf->SetMargins(10, 10, 10);
      $pdf->SetFont('Times','',8);
      $pdf->Cell(24,4,'Student No.',0,0,'L',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->Cell(24,4,strtoupper($info['studentNumber']),0,1,'L',false);

      $pdf->Cell(24,4,'Student Name',0,0,'L',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(24,4,strtoupper($info['name']),0,1,'L',false);

      $pdf->SetFont('Times','',8);
      $pdf->Cell(24,4,'Permanent Address',0,0,'L',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->Cell(24,4,strtoupper($info['address']),0,1,'L',false);

      $pdf->Cell(24,4,'Year of Admission',0,0,'L',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->Cell(75,4,$info['yearAdmitted'],0,0,'L',false);
      $pdf->Cell(25,4,'Entrance Credentials:',0,0,'L',false);
      $pdf->Cell(24,4,$info['entranceCredentials'],0,1,'C',false);

      $pdf->Cell(24,4,'Elementary School',0,0,'L',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->Cell(24,4,strtoupper($info['eschool']),0,1,'L',false);

      $pdf->Cell(24,4,'Year Graduated',0,0,'R',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->Cell(24,4,$info['egraduated'],0,1,'L',false);

      $pdf->Cell(24,4,'High School',0,0,'L',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->Cell(24,4,strtoupper($info['hschool']),0,1,'L',false);

      $pdf->Cell(24,4,'Year Graduated',0,0,'R',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->Cell(24,4,$info['hgraduated'],0,1,'L',false);

      $pdf->Cell(24,4,'Program',0,0,'L',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->SetFont('Times','B',8);
      $pdf->Cell(24,4,strtoupper($info['course']),0,1,'L',false);

      $pdf->SetFont('Times','',8);
      $pdf->Cell(24,4,'Date Graduated',0,0,'R',false);
      $pdf->Cell(11,4,':',0,0,'C',false);
      $pdf->Cell(75,4,strtoupper($info['dateGraduated']),0,0,'L',false);
      $pdf->Cell(14,4,'Attended:',0,0,'L',false);
      $pdf->Cell(15,4,$info['numsem'].' Semester(s)',0,0,'C',false);
      $pdf->Cell(35,4,'Summer:',0,0,'R',false);
      $pdf->Cell(5,4,$info['numsum'],0,1,'C',false);
      $pdf->Cell(5,2,"",0,1,'C',false);

      //info
    }
    public function createTORCredentiaTable($pdf){
      $pdf->SetAlpha(0.3);
      $pdf->Image(URL."public/img/pdfimgs/puplogo.png", 60, 135, 90);
      $pdf->SetAlpha(1);
      $pdf->Rect(10, 100, 195, 191, 'D');
      $pdf->Cell(0,1,"",0,1,'C',false);
      $pdf->Cell(1,2,"",0,0,'C',false);
      $pdf->SetFont('Times','B',14);
      $pdf->Cell(145,6,"                                 S U B J E C T S",'TLB',0,'C',false);
      $pdf->Cell(24,6,"",'TLB',0,'C',false);
      $pdf->Cell(24,6,"",1,1,'C',false);


      $pdf->Cell(1,6,"",0,0,'C',false);
      $pdf->SetFont('Times','',12);
      $pdf->Cell(20,6,"CODE",'LB',0,'C',false);
      $pdf->Cell(125,6,"                  DESCRIPTIVE TITLE",'LB',0,'C',false);
      $pdf->Cell(24,6,"GRADES",'LB',0,'C',false);
      $pdf->Cell(24,6,"CREDITS",'LRB',1,'C',false);
      $pdf->Rect(11, 114, 193, 140, 'D');
    }
    public function createTORFooter($pdf, $gradeRemark, $branchOfficials, $sym, $cleared = false){
      //grading system
      $pdf->SetXY(9, 253);
      $pdf->Rect(11, 255, 193, 19, 'D');
      $pdf->Cell(2,2,'',0,1,'C',false);
      $pdf->Cell(2,2,'',0,0,'C',false);
      $pdf->SetFont('Times','',9);
      $pdf->Cell(30,4,'GRADING SYSTEM',0,0,'L',false);
      $pdf->Cell(14,4,':',0,0,'L',false);
      $pdf->SetFont('Times','',9);
      $pdf->MultiCell(125,4,'1.00 = 97-100% ; 1.25 = 94-96% ; 1.50 = 91-93% ; 1.75 = 88-90% ; 2.00 = 85-87% ; 2.25 = 82-84% ; 2.50 = 79-81% ; 2.75 = 76-78% ; 3.00 = 75% ; 5.00 = Failed ; P = Passed ; NC = No Credits ; INC = Incomplete ; W = Withdrawn ; UW = Unauthorized Withdrawal.',0,'L',false);

      $pdf->Cell(2,2,'',0,0,'C',false);
      $pdf->SetFont('Times','',9);
      $pdf->Cell(30,4,'CREDITS',0,0,'L',false);
      $pdf->Cell(14,4,':',0,0,'L',false);
      $pdf->SetFont('Times','I',9);
      $pdf->MultiCell(135,3,'One college unit is at least seventeen (17) full hours of instruction in academic or professional subject within a semester.',0,'L',false);
      //grading system

      //remarks
      $pdf->Rect(11, 275, 193, 15, 'D');
      $pdf->Cell(2,2,'',0,1,'C',false);
      $pdf->Cell(2,2,'',0,0,'C',false);
      $pdf->SetFont('Times','',9);
      $pdf->Cell(20,4,'REMARKS: ',0,0,'L',false);
      if ($cleared) {
        $pdf->MultiCell(130,4,'CLEARED OF ALL THE PROPERTY AND MONEY ACCOUNTABILITIES. COMPLETED NSTP CWTS IN COMPLIANCE WITH RA 9163.',0,'L',false);
        $pdf->Cell(2,2,'',0,0,'C',false);
        $pdf->Cell(20,4,'',0,0,'L',false);
      }
      $pdf->SetFont('Times','IB',10);
      $pdf->Cell(130,4,$gradeRemark.' - '.$sym,0,1,'L',false);
      //remarks

      //footer

      // $pdf->Cell(2,11,'',0,1,'C',false);
      $pdf->SetXY(11, 291);
      $pdf->Cell(2,2,'',0,0,'C',false);
      $pdf->SetFont('Times','',8);
      $pdf->Cell(60,2,'',0,0,'C',false);
      $pdf->Cell(110,2,'By the authority of the University Registrar:',0,1,'R',false);
      $pdf->Cell(60,2,'(Not valid without the University seal)',0,0,'L',false);

      $pdf->SetAutoPageBreak(true,1);
      $pdf->SetXY(60, 302);
      $pdf->Cell(60,4,$branchOfficials['preparedBy'],0,1,'L',false);
      $pdf->SetXY(40, 304);
      $pdf->Cell(60,3,'Prepared By:',0,1,'L',false);

      $pdf->SetXY(135, 307);
      $pdf->Cell(60,2,$branchOfficials['director'],0,1,'L',false);
      $pdf->SetXY(120, 309);
      $pdf->Cell(42,4,'Predident',0,1,'R',false);

      //footer
    }

    public function getRemark($grade){
      $remark = '';
      if ($grade == 1.00) {
        $remark = 'Z';
      }else if($grade == 1.25) {
        $remark = 'B';
      }else if($grade == 1.50) {
        $remark = 'P';
      }else if($grade == 1.75) {
        $remark = 'G';
      }else if($grade == 2.00) {
        $remark = 'T';
      }else if($grade == 2.25) {
        $remark = 'D';
      }else if($grade == 2.50) {
        $remark = 'H';
      }else if($grade == 2.75) {
        $remark = 'V';
      }else if($grade == 3.00) {
        $remark = 'R';
      }
        return $remark;
    }
  }
