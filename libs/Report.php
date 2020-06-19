<?php
  /**
   *
   */
  class Report
  {

    function __construct()
    {
      // echo json_encode($data);
      // die;
      date_default_timezone_set('Asia/Manila');
      $this->page = 1;
      $this->pdf = new FPDF('L');
      $this->employee = Functions::name_format(Session::get('fname'), Session::get('lname'), Session::get('mname'), true, Session::get('suffix'));
      $this->date_today = date('F d, Y h:i a');
    }

    public function setData($type, $date, $category, $category_value, $request_type, $data, $rowperpage){
      $this->rowperpage = $rowperpage;
      $this->type = strtoupper($type);
      $this->type_date = ($type == 'monthly') ? 'MONTH' : 'DATE';
      if ($type == 'daily') {
        $this->date = date('F d, Y', strtotime($date));
      }elseif ($type == 'weekly') {
        $this->date = date('F d ', strtotime($date)).date('- d, Y', strtotime($date.'+6 days'));
      }else {
        $this->date = date('F Y', strtotime($date));
      }
      $this->category = strtoupper($category);
      $this->category_value = $data['category_value'];
      $this->request_type = $request_type;
      $this->requests = $data['requests'];
      $this->totalPage = ceil(count($data['requests']) / $this->rowperpage) == 0 ? 1 : ceil(count($data['requests']) / $this->rowperpage);
    }

    private function _initpdf(){
      $this->pdf->AddFont('Calibri','','Calibri.php');
      $this->pdf->AddFont('BodoniMTBlack','B','BodoniMTBlack.php');
      $this->pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
      $this->pdf->SetMargins(5, 0, 0);
    }

    private function _headerInfo(){
      if ($this->transaction == 'Document-Request') {
        $this->pdf->setY(32);
        $this->pdf->SetFont('Calibri','',12);
        $this->pdf->Cell(0,4,$this->type.' DOCUMENT REQUESTS',0,1,'C',false);
        $this->pdf->setXY(20,40);
        $this->pdf->SetFont('Calibri Bold','B',12);
        $this->pdf->Cell(25,2,$this->type_date.': ',0,0,'L',false);
        $this->pdf->SetFont('Calibri','',12);
        $this->pdf->Cell(20,2,$this->date,0,1,'L',false);
        $this->pdf->SetFont('Calibri Bold','B',12);
        $this->pdf->setXY(20,45);
        $this->pdf->Cell(25,2,$this->category.': ',0,0,'L',false);
        $this->pdf->SetFont('Calibri','',12);
        $this->pdf->Cell(20,2,$this->category_value,0,1,'L',false);
        $this->pdf->SetFont('Calibri Bold','B',12);
        $this->pdf->setXY(217,45);
        $this->pdf->Cell(20,2,'STATUS: ',0,0,'L',false);
        $this->pdf->SetFont('Calibri','',12);
        $this->pdf->Cell(20,2,$this->request_type,0,1,'L',false);
        $this->pdf->SetFont('Calibri Bold','B',12);
      }else {
        $this->pdf->setY(32);
        $this->pdf->SetFont('Calibri','',12);
        $this->pdf->Cell(0,4,$this->type.' GRADUATE VERIFICATION',0,1,'C',false);
        $this->pdf->setXY(20,40);
        $this->pdf->SetFont('Calibri Bold','B',12);
        $this->pdf->Cell(25,2,$this->type_date.': ',0,0,'L',false);
        $this->pdf->SetFont('Calibri','',12);
        $this->pdf->Cell(20,2,$this->date,0,1,'L',false);
        $this->pdf->SetFont('Calibri Bold','B',12);
      }
    }

    private function _createHeader(){
      $this->pdf->AddPage();
      $this->pdf->Image(URL."public/img/pdfimgs/puplogo.png", 140, 2, 15);
      $this->pdf->setY(17);
      $this->pdf->SetFont('Calibri Bold','B',12);
      $this->pdf->Cell(0,4,'POLYTECHNIC UNIVERSITY OF THE PHILIPPINES',0,1,'C',false);
      $this->pdf->SetFont('Calibri','',11);
      $this->pdf->SetTextColor(92,92,92);
      $this->pdf->Cell(0,4,'A. Mabini Campus, Anonas Street, Sta. Mesa, Manila, Philippines 1016',0,1,'C',false);
      $this->pdf->Cell(0,4,'(632) 335-1787 or 335-1777 local 293',0,1,'C',false);
      $this->pdf->SetTextColor(0,0,0);
      $this->pdf->setXY(275,6);
      $this->pdf->Cell(10,2,'Page '.$this->page.'/'.$this->totalPage,0,1,'C',false);
      $this->_headerInfo();
    }
    private function _createFooter($request_num){
      $this->pdf->SetAutoPageBreak(true,1);
      $this->pdf->setY(197);
      $this->pdf->SetFont('Calibri','',12);
      $this->pdf->Cell(84,4,'Generated By: '.$this->employee,0,0,'L',false);
      $this->pdf->Cell(84,4,'Date & Time: '.$this->date_today,0,0,'C',false);
      $this->pdf->Cell(84,4,'Number of Requests: '.$request_num,0,1,'R',false);
    }

    private function _bodyHeaders($category){
      $this->pdf->setY(54);
      $this->pdf->SetFont('Calibri Bold','B',11);
      if ($this->transaction == 'Document-Request') {
        if ($category == 'document') {
          $this->pdf->Cell(10,5,'REQ.','TL',0,'C',false);
          $this->pdf->Cell(30,5,'STUDENT','TL',0,'C',false);
          $this->pdf->Cell(21,5,'LAST','TL',0,'C',false);
          $this->pdf->Cell(40,5,'FIRST','TL',0,'C',false);
          $this->pdf->Cell(21,5,'MIDDLE','TL',0,'C',false);
          $this->pdf->Cell(17,5,'','TL',0,'C',false);
          $this->pdf->Cell(53,5,'','TL',0,'C',false);
          $this->pdf->Cell(42,5,'DATE',1,0,'C',false);
          $this->pdf->Cell(20,5,'','TL',0,'C',false);
          $this->pdf->Cell(30,5,'','TLR',1,'C',false);
          $this->pdf->Cell(10,5,'NUM','BL',0,'C',false);
          $this->pdf->Cell(30,5,'NUMBER','BL',0,'C',false);
          $this->pdf->Cell(21,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(40,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(21,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(17,5,'COLLEGE','BL',0,'C',false);
          $this->pdf->Cell(53,5,'COURSE','BL',0,'C',false);
          $this->pdf->Cell(21,5,'REQUESTED',1,0,'C',false);
          $this->pdf->Cell(21,5,'RELEASED',1,0,'C',false);
          $this->pdf->Cell(20,5,'PURPOSE','BL',0,'C',false);
          $this->pdf->Cell(30,5,'REMARKS','BLR',1,'C',false);
        }else if ($category == 'course') {
          $this->pdf->Cell(12,5,'REQ.','TL',0,'C',false);
          $this->pdf->Cell(32,5,'STUDENT','TL',0,'C',false);
          $this->pdf->Cell(23,5,'LAST','TL',0,'C',false);
          $this->pdf->Cell(42,5,'FIRST','TL',0,'C',false);
          $this->pdf->Cell(23,5,'MIDDLE','TL',0,'C',false);
          $this->pdf->Cell(92,5,'','TL',0,'C',false);
          $this->pdf->Cell(30,5,'','TL',0,'C',false);
          $this->pdf->Cell(30,5,'','TLR',1,'C',false);
          $this->pdf->Cell(12,5,'NUM','BL',0,'C',false);
          $this->pdf->Cell(32,5,'NUMBER','BL',0,'C',false);
          $this->pdf->Cell(23,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(42,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(23,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(92,5,'REQUESTED DOCUMENTS','BL',0,'C',false);
          $this->pdf->Cell(30,5,'PURPOSE','BL',0,'C',false);
          $this->pdf->Cell(30,5,'REMARKS','BLR',1,'C',false);
        }else if ($category == 'college') {
          $this->pdf->Cell(12,5,'REQ.','TL',0,'C',false);
          $this->pdf->Cell(32,5,'STUDENT','TL',0,'C',false);
          $this->pdf->Cell(23,5,'LAST','TL',0,'C',false);
          $this->pdf->Cell(42,5,'FIRST','TL',0,'C',false);
          $this->pdf->Cell(23,5,'MIDDLE','TL',0,'C',false);
          $this->pdf->Cell(47,5,'','TL',0,'C',false);
          $this->pdf->Cell(75,5,'','TL',0,'C',false);
          $this->pdf->Cell(30,5,'','TLR',1,'C',false);
          $this->pdf->Cell(12,5,'NUM','BL',0,'C',false);
          $this->pdf->Cell(32,5,'NUMBER','BL',0,'C',false);
          $this->pdf->Cell(23,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(42,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(23,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(47,5,'COURSE','BL',0,'C',false);
          $this->pdf->Cell(75,5,'REQUESTED DOCUMENTS','BL',0,'C',false);
          $this->pdf->Cell(30,5,'REMARKS','BLR',1,'C',false);
        }else {
          $this->pdf->Cell(10,5,'REQ.','TL',0,'C',false);
          $this->pdf->Cell(30,5,'STUDENT','TL',0,'C',false);
          $this->pdf->Cell(21,5,'LAST','TL',0,'C',false);
          $this->pdf->Cell(40,5,'FIRST','TL',0,'C',false);
          $this->pdf->Cell(21,5,'MIDDLE','TL',0,'C',false);
          $this->pdf->Cell(17,5,'','TL',0,'C',false);
          $this->pdf->Cell(48,5,'','TL',0,'C',false);
          $this->pdf->Cell(67,5,'','TL',0,'C',false);
          $this->pdf->Cell(30,5,'','TLR',1,'C',false);
          $this->pdf->Cell(10,5,'NUM','BL',0,'C',false);
          $this->pdf->Cell(30,5,'NUMBER','BL',0,'C',false);
          $this->pdf->Cell(21,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(40,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(21,5,'NAME','BL',0,'C',false);
          $this->pdf->Cell(17,5,'COLLEGE','BL',0,'C',false);
          $this->pdf->Cell(48,5,'COURSE','BL',0,'C',false);
          $this->pdf->Cell(67,5,'REQUESTED DOCUMENTS','BL',0,'C',false);
          $this->pdf->Cell(30,5,'REMARK','BLR',1,'C',false);
        }
      }else {
        //graduate verification
        $this->pdf->Cell(10,5,'REQ.','TL',0,'C',false);
        $this->pdf->Cell(40,5,'COMPANY','TL',0,'C',false);
        $this->pdf->Cell(50,5,'REPRESENTATIVE','TL',0,'C',false);
        $this->pdf->Cell(60,5,'DOCUMENTS','TL',0,'C',false);
        $this->pdf->Cell(45,5,'PROCESSED','TL',0,'C',false);
        $this->pdf->Cell(42,5,'DATE',1,0,'C',false);
        $this->pdf->Cell(38,5,'','TLR',1,'C',false);

        $this->pdf->Cell(10,5,'NUM','BL',0,'C',false);
        $this->pdf->Cell(40,5,'NAME','BL',0,'C',false);
        $this->pdf->Cell(50,5,'NAME','BL',0,'C',false);
        $this->pdf->Cell(45,5,'TYPE','TBL',0,'C',false);
        $this->pdf->Cell(15,5,'RESULT','TBL',0,'C',false);
        $this->pdf->Cell(45,5,'BY','BL',0,'C',false);
        $this->pdf->Cell(21,5,'REQUESTED',1,0,'C',false);
        $this->pdf->Cell(21,5,'FINISHED',1,0,'C',false);
        $this->pdf->Cell(38,5,'REMARKS','BLR',1,'C',false);
      }
    }

    private function _reqStatus($n){
      if ($n == 0) {
        return "Waiting for Payment";
      } else if ($n == 1) {
        return "Processing";
      } else if ($n == 2) {
        return "For Releasing";
      } else if ($n == 3) {
        return "Claimed";
      } else if ($n == 4) {
          return "Cancelled";
      } else if ($n == 5) {
          return "Forfeited";
      }
    }
    private function _verStatus($n){
      if ($n == 1) {
        return "Payment Approval";
      } else if ($n == 0) {
        return "Waiting for Payment";
      } else if ($n == 2) {
        return "For Verification";
      } else if ($n == 3) {
        return "Verified";
      }
    }
    private function _docVerStatus($n){
      if ($n == 0) {
        return "";
      } else if ($n == 1) {
        return "VALID";
      } else if ($n == 2) {
        return "INVALID";
      }
    }

    private function _bodyData($i, $category, $request){
      $this->pdf->SetFont('Calibri','',10);
      if ($this->transaction == 'Document-Request') {
        if ($category == 'document') {
          // echo json_encode($request);
          // die;
          $this->pdf->Cell(10,5,$i,'BL',0,'C',false);
          $this->pdf->Cell(30,5,$request['studentNumber'],'BL',0,'C',false);
          $this->pdf->Cell(21,5,$request['lname'],'BL',0,'C',false);
          $this->pdf->Cell(40,5,$request['fname'],'BL',0,'C',false);
          $this->pdf->Cell(21,5,$request['mname'],'BL',0,'C',false);
          $this->pdf->Cell(17,5,$request['college'],'BL',0,'C',false);
          $this->pdf->Cell(53,5,$request['course'],'BL',0,'C',false);
          $this->pdf->Cell(21,5,$request['dateFiled'],1,0,'C',false);
          $this->pdf->Cell(21,5,explode(' ', $request['dateFinished'])[0],1,0,'C',false);
          $this->pdf->Cell(20,5,$request['purpose'],'BL',0,'C',false);
          $this->pdf->Cell(30,5,$this->_reqStatus($request['status']),'BLR',1,'C',false);
        }elseif ($category == 'course') {
          for ($x=0; $x < count($request['docs']); $x++) {
            if ($x == count($request['docs'])-1) {
              $this->pdf->Cell(12,5,$i,'BL',0,'C',false);
              $this->pdf->Cell(32,5,$request['studentNumber'],'BL',0,'C',false);
              $this->pdf->Cell(23,5,$request['lname'],'BL',0,'C',false);
              $this->pdf->Cell(42,5,$request['fname'],'BL',0,'C',false);
              $this->pdf->Cell(23,5,$request['mname'],'BL',0,'C',false);
              $this->pdf->Cell(92,5,$request['docs'][$x]['description'],'BL',0,'L',false);
              $this->pdf->Cell(30,5,$request['purpose'],'BL',0,'C',false);
              $this->pdf->Cell(30,5,$this->_reqStatus($request['status']),'BLR',1,'C',false);
            }else {
              $this->pdf->Cell(12,5,'','L',0,'C',false);
              $this->pdf->Cell(32,5,'','L',0,'C',false);
              $this->pdf->Cell(23,5,'','L',0,'C',false);
              $this->pdf->Cell(42,5,'','L',0,'C',false);
              $this->pdf->Cell(23,5,'','L',0,'C',false);
              $this->pdf->Cell(92,5,$request['docs'][$x]['description'],'L',0,'L',false);
              $this->pdf->Cell(30,5,'','L',0,'C',false);
              $this->pdf->Cell(30,5,'','LR',1,'C',false);
            }
          }
        }elseif ($category == 'college') {
          for ($x=0; $x < count($request['docs']); $x++) {
            if ($x == count($request['docs'])-1) {
              $this->pdf->Cell(12,5,$i,'BL',0,'C',false);
              $this->pdf->Cell(32,5,$request['studentNumber'],'BL',0,'C',false);
              $this->pdf->Cell(23,5,$request['lname'],'BL',0,'C',false);
              $this->pdf->Cell(42,5,$request['fname'],'BL',0,'C',false);
              $this->pdf->Cell(23,5,$request['mname'],'BL',0,'C',false);
              $this->pdf->Cell(47,5,$request['course'],'BL',0,'C',false);
              $this->pdf->Cell(75,5,$request['docs'][$x]['description'],'BL',0,'L',false);
              $this->pdf->Cell(30,5,$this->_reqStatus($request['status']),'BLR',1,'C',false);
            }else {
              $this->pdf->Cell(12,5,'','L',0,'C',false);
              $this->pdf->Cell(32,5,'','L',0,'C',false);
              $this->pdf->Cell(23,5,'','L',0,'C',false);
              $this->pdf->Cell(42,5,'','L',0,'C',false);
              $this->pdf->Cell(23,5,'','L',0,'C',false);
              $this->pdf->Cell(47,5,'','L',0,'C',false);
              $this->pdf->Cell(75,5,$request['docs'][$x]['description'],'L',0,'L',false);
              $this->pdf->Cell(30,5,'','LR',1,'C',false);
            }
          }
        }else {
          for ($x=0; $x < count($request['docs']); $x++) {
            if ($x == count($request['docs'])-1) {
              $this->pdf->Cell(10,5,$i,'BL',0,'C',false);
              $this->pdf->Cell(30,5,$request['studentNumber'],'BL',0,'C',false);
              $this->pdf->Cell(21,5,$request['lname'],'BL',0,'C',false);
              $this->pdf->Cell(40,5,$request['fname'],'BL',0,'C',false);
              $this->pdf->Cell(21,5,$request['mname'],'BL',0,'C',false);
              $this->pdf->Cell(17,5,$request['college'],'BL',0,'C',false);
              $this->pdf->Cell(48,5,$request['course'],'BL',0,'C',false);
              $this->pdf->Cell(67,5,$request['docs'][$x]['description'],'BL',0,'L',false);
              $this->pdf->Cell(30,5,$this->_reqStatus($request['status']),'BLR',1,'C',false);
            }else {
              $this->pdf->Cell(10,5,'','L',0,'C',false);
              $this->pdf->Cell(30,5,'','L',0,'C',false);
              $this->pdf->Cell(21,5,'','L',0,'C',false);
              $this->pdf->Cell(40,5,'','L',0,'C',false);
              $this->pdf->Cell(21,5,'','L',0,'C',false);
              $this->pdf->Cell(17,5,'','L',0,'C',false);
              $this->pdf->Cell(48,5,'','L',0,'C',false);
              $this->pdf->Cell(67,5,$request['docs'][$x]['description'],'L',0,'L',false);
              $this->pdf->Cell(30,5,'','LR',1,'C',false);
            }
          }
        }
      }else {
          //graduate verification
          for ($x=0; $x < count($request['docs']); $x++) {
            if ($x == count($request['docs'])-1) {
              $this->pdf->Cell(10,5,$i,'BL',0,'C',false);
              $this->pdf->Cell(40,5,$request['company'],'BL',0,'C',false);
              $this->pdf->Cell(50,5,$request['representative'],'BL',0,'C',false);
              $this->pdf->Cell(45,5,$request['docs'][$x]['docType'],'BL',0,'C',false);
              $this->pdf->Cell(15,5,$this->_docVerStatus($request['docs'][$x]['result']),'BL',0,'C',false);
              $this->pdf->Cell(45,5,$request['docs'][$x]['verifiedBy'],'BL',0,'C',false);
              $this->pdf->Cell(21,5,$request['created_on'],'BL',0,'C',false);
              $this->pdf->Cell(21,5,explode(' ', $request['dateFinished'])[0],'BL',0,'C',false);
              $this->pdf->Cell(38,5,$this->_verStatus($request['status']),'BLR',1,'C',false);
            }else {
              $this->pdf->Cell(10,5,'','L',0,'C',false);
              $this->pdf->Cell(40,5,'','L',0,'C',false);
              $this->pdf->Cell(50,5,'','L',0,'C',false);
              $this->pdf->Cell(45,5,$request['docs'][$x]['docType'],'L',0,'C',false);
              $this->pdf->Cell(15,5,$this->_docVerStatus($request['docs'][$x]['result']),'L',0,'C',false);
              $this->pdf->Cell(45,5,$request['docs'][$x]['verifiedBy'],'L',0,'C',false);
              $this->pdf->Cell(21,5,'','L',0,'C',false);
              $this->pdf->Cell(21,5,'','L',0,'C',false);
              $this->pdf->Cell(38,5,'','LR',1,'C',false);
            }
          }
      }
    }

    private function _createBody($requests){
      if ($this->transaction == 'Document-Request') {
        $this->_bodyHeaders(strtolower($this->category));
        $row = 0;
        if (count($requests) > 0) {
          $this->pdf->setY(64);
          for ($i=0; $i < count($requests) ; $i++) {
            $row++;
            $this->_bodyData($row, strtolower($this->category), $requests[$i]);
            if ($row == $this->rowperpage && $i != count($requests)-1) {
              $this->_createFooter($row);
              $this->page++;
              $this->_createHeader();
              $this->_bodyHeaders(strtolower($this->category));
              $row = 0;
            }
          }
        }else {
          $this->pdf->SetFont('Calibri','',14);
          $this->pdf->setY(120);
          $this->pdf->Cell(0,5,'NO RECORDS TO SHOW',0,0,'C',false);
        }
        $this->_createFooter($row);
      }else {
        //graduate verification
        $this->_bodyHeaders(strtolower($this->category));
        $row = 0;
        if (count($requests) > 0) {
          $this->pdf->setY(64);
          for ($i=0; $i < count($requests) ; $i++) {
            $row++;
            $this->_bodyData($row, strtolower($this->category), $requests[$i]);
            if ($row == $this->rowperpage && $i != count($requests)-1) {
              $this->_createFooter($row);
              $this->page++;
              $this->_createHeader();
              $this->_bodyHeaders(strtolower($this->category));
              $row = 0;
            }
          }
        }else {
          $this->pdf->SetFont('Calibri','',14);
          $this->pdf->setY(120);
          $this->pdf->Cell(0,5,'NO RECORDS TO SHOW',0,0,'C',false);
        }
        $this->_createFooter($row);
      }
    }

    public function generate($id, $transaction){
      $this->transaction = $transaction;
      $this->_initpdf();
      $this->_createHeader();
      $this->_createBody($this->requests);
      $this->pdf->output('I', $id);
    }

  }
