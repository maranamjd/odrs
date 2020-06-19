<?php

  /**
   *
   */
  class Dashboard_Model extends Model
  {

    function __construct()
    {
      parent::__construct();
      $this->credentials = array(
        '2015-2016,FIRST SEMESTER' => [
          [
            'code'        => 'ICT 111',
            'description' => 'ACCOUNTING PRINCIPLES',
            'grades'      => ['INC', 1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 112',
            'description' => 'INFORMATION TECHNOLOGY FUNDAMENTALS WITH APPLICATION',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 113',
            'description' => 'COMPUTER PROGRAMMING 1',
            'grades'      => [1.00],
            'credits'     => 3
          ],
          [
            'code'        => 'ict 114',
            'description' => 'BASIC COMPUTER HARDWARE SERVICING',
            'grades'      => [2.00],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 115',
            'description' => 'KEYBOARDING 1',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ITEN 111',
            'description' => 'STUDY AND THINKING SKILLS IN ENGLISH',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ITMT 111',
            'description' => 'COLLEGE ALGEBRA',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'PE 111',
            'description' => 'PHYSICAL EDUCATION 1',
            'grades'      => [2.25],
            'credits'     => 2
          ],
          [
            'code'        => 'CWTS 1013',
            'description' => 'CIVIC WELFARE TRAINING SERVICE 1',
            'grades'      => [2.00],
            'credits'     => 3
          ]
        ],
        '2015-2015,SECOND SEMESTER' => [
          [
            'code'        => 'ICT 121',
            'description' => 'COMPUTER PROGRAMMING 2',
            'grades'      => [1.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 123',
            'description' => 'HARDWARE/SOFTWARE INSTALLATION AND MAINTENANCE',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 124',
            'description' => 'BASIC ELECTRONICS',
            'grades'      => [2.25],
            'credits'     => 2
          ],
          [
            'code'        => 'ICT 125',
            'description' => 'PROFESSIONAL ETHICS',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'IT 121',
            'description' => 'INTEGRATED APPLICATION SOFTWARE',
            'grades'      => [2.00],
            'credits'     => 3
          ],
          [
            'code'        => 'ITEN 112',
            'description' => 'SPEECH COMMUNICATION',
            'grades'      => [1.50],
            'credits'     => 3
          ],
          [
            'code'        => 'ITMT 121',
            'description' => 'PLANE AND SPHERICAL TRIGONOMETRY',
            'grades'      => [1.50],
            'credits'     => 3
          ],
          [
            'code'        => 'PE 112',
            'description' => 'PHYSICAL EDUCATION 2',
            'grades'      => [1.25],
            'credits'     => 2
          ],
          [
            'code'        => 'CWTS 1023',
            'description' => 'CIVIC WELFARE TRAINING SERVICE 2',
            'grades'      => [1.00],
            'credits'     => 3
          ]
        ],
        '2016,SUMMER' => [
          [
            'code'        => 'ICT 132',
            'description' => 'PRACTICUM 1 (INFORMATION TECHNOLOGY ASSISTANT/COMPUTER PROGRAMMER AIDE)',
            'grades'      => [1.00],
            'credits'     => 2
          ]
        ],
        '2016-2017,FIRST SEMESTER' => [
          [
            'code'        => 'ICT 212',
            'description' => 'COMPUTER PROGRAMMING 3',
            'grades'      => [1.50],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 215',
            'description' => 'TECHNICAL DOCUMENTATION AND PRESENTATION SKILLS IN INFORMATION AND COMMUNICATIONS',
            'grades'      => [1.50],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 216',
            'description' => 'OPERATING SYSTEM',
            'grades'      => [2.00],
            'credits'     => 4
          ],
          [
            'code'        => 'ICT 217',
            'description' => 'DISCRETE STRUCTURES WITH ALGORITHM',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 218',
            'description' => 'COMPUTER SYSTEM ORGANIZATION',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ITEN 219',
            'description' => 'DATA COMMUNICATION AND NETWORKING',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ITMT 220',
            'description' => 'OBJECT-ORIENTED PROGRAMMING',
            'grades'      => [1.25],
            'credits'     => 4
          ],
          [
            'code'        => 'ITEN 113',
            'description' => 'BUSINESS COMMUNICATION AND REPORT WRITING',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'PE 113',
            'description' => 'PHYSICAL EDUCATION 3',
            'grades'      => [1.25],
            'credits'     => 2
          ]
        ],
        '2016-2017,SECOND SEMESTER' => [
          [
            'code'        => 'ICT 223',
            'description' => 'DATA FILE AND STRUCTURES',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 224',
            'description' => 'NETWORK ADMINISTRATION',
            'grades'      => [2.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 225',
            'description' => 'ADVANCED PROGRAMMING',
            'grades'      => [1.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 226',
            'description' => 'WEB DEVELOPMENT',
            'grades'      => [1.50],
            'credits'     => 4
          ],
          [
            'code'        => 'ICT 227',
            'description' => 'MULTIMEDIA 1',
            'grades'      => [1.50],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 228',
            'description' => 'DATABASE MANAGEMENT SYSTEM',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 229',
            'description' => 'WIRELESS AND MOBILE COMPUTING',
            'grades'      => [2.50],
            'credits'     => 3
          ],
          [
            'code'        => 'PE 114',
            'description' => 'PHYSICAL EDUCATION 4',
            'grades'      => [1.25],
            'credits'     => 2
          ]
        ],
        '2017,SUMMER' => [
          [
            'code'        => 'IT 231',
            'description' => 'ON-THE-JOB TRAINING 2',
            'grades'      => [1.25],
            'credits'     => 2
          ]
        ],
        '2017-2018,FIRST SEMESTER' => [
          [
            'code'        => 'ICT 311',
            'description' => 'DATABASE ADMINISTRATION',
            'grades'      => [2.00],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 312',
            'description' => 'MANAGEMENT INFORMATION SYSTEM',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 313',
            'description' => 'SOFTWARE ENGINEERING',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 314',
            'description' => 'SYSTEM ANALYSIS AND DESIGN',
            'grades'      => [1.50],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 315',
            'description' => 'IT PROJECT MANAGEMENT',
            'grades'      => [2.00],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 316',
            'description' => 'COMPUTER TECHNOPRENEURSHIP',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 317',
            'description' => 'DATA MINING AND DATA WAREHOUSING',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 318',
            'description' => 'MULTIMEDIA 2',
            'grades'      => [1.75],
            'credits'     => 3
          ],
        ],
        '2017-2018,SECOND SEMESTER' => [
          [
            'code'        => 'ICT 321',
            'description' => 'INTERNSHIP (COMPUTER PROGRAMMING SPECIALIST - 600 HOURS)',
            'grades'      => [1.50],
            'credits'     => 6
          ],
          [
            'code'        => 'ICT 325',
            'description' => 'CAPSTONE PROJECT',
            'grades'      => [1.50],
            'credits'     => 3
          ]
        ],
        '2017-2018,FIRST SEMESTERb' => [
          [
            'code'        => 'ICT 311',
            'description' => 'DATABASE ADMINISTRATION',
            'grades'      => [2.00],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 312',
            'description' => 'MANAGEMENT INFORMATION SYSTEM',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 313',
            'description' => 'SOFTWARE ENGINEERING',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 314',
            'description' => 'SYSTEM ANALYSIS AND DESIGN',
            'grades'      => [1.50],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 315',
            'description' => 'IT PROJECT MANAGEMENT',
            'grades'      => [2.00],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 316',
            'description' => 'COMPUTER TECHNOPRENEURSHIP',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 317',
            'description' => 'DATA MINING AND DATA WAREHOUSING',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 318',
            'description' => 'MULTIMEDIA 2',
            'grades'      => [1.75],
            'credits'     => 3
          ],
        ],
        '2017-2018,FIRST SEMESTERa' => [
          [
            'code'        => 'ICT 311',
            'description' => 'DATABASE ADMINISTRATION',
            'grades'      => [2.00],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 312',
            'description' => 'MANAGEMENT INFORMATION SYSTEM',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 313',
            'description' => 'SOFTWARE ENGINEERING',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 314',
            'description' => 'SYSTEM ANALYSIS AND DESIGN',
            'grades'      => [1.50],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 315',
            'description' => 'IT PROJECT MANAGEMENT',
            'grades'      => [2.00],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 316',
            'description' => 'COMPUTER TECHNOPRENEURSHIP',
            'grades'      => [1.75],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 317',
            'description' => 'DATA MINING AND DATA WAREHOUSING',
            'grades'      => [2.25],
            'credits'     => 3
          ],
          [
            'code'        => 'ICT 318',
            'description' => 'MULTIMEDIA 2',
            'grades'      => [1.75],
            'credits'     => 3
          ],
        ]
      );
      $this->studentInfo = array(
       'studentNo'               => strtoupper('2018-15762-MN-1'),
       'studentName'             => strtoupper('Marana, Michael joshua duran'),
       'permanentAddress'        => strtoupper('blk 40 lot 1 phase ii, pinagsama village, taguig city'),
       'yearAdmission'           => strtoupper('2018'),
       'entranceCredentials'     => strtoupper('pupcet'),
       'elementarySchool'        => strtoupper('PANDACAQUI RESETTLEMENT ELEMENTARY SCHOOL'),
       'elementaryYearGraduated' => strtoupper('2010'),
       'highSchool'              => strtoupper('don jesus gonzales high school'),
       'highSchoolYearGraduated' => strtoupper('2014'),
       'program'                 => strtoupper('bachelor of science in information technology'),
       'programYearGraduated'    => strtoupper('2018'),
       'numSem'                  => strtoupper('6'),
       'numSummer'               => strtoupper('2')
     );
     $this->officials = array(
       'preparedBy'  => strtoupper('sigmund heinrich g. sese'),
       'checkedBy'   => strtoupper('Bernadeth I. Canlas'),
       'director'    => strtoupper('Marissa B. Ferrer, dem, rp')
     );
     $this->gradeRemark = "";
    }

    public function diploma(){
      $pdf = new FPDF('L');
      $fn = new Functions();
      $fn->createDiploma($pdf);
    }

    public function tor(){
      $pdf = new AlphaPDF('P', 'mm', array(215.9,330.2));
      $fn = new Functions;
      $data = $this->credentials;
      $info = $this->studentInfo;
      $branchOfficials = $this->officials;
      $gradeRemark = $this->gradeRemark;
      $subjectCounter = 0;
      $page = 1;

        $pdf->AddPage();
        $pdf->AddFont('Calibri','','Calibri.php');
        $pdf->AddFont('BodoniMTBlack','B','BodoniMTBlack.php');
        $pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
        $pdf->SetMargins(10, 5, 10);

        $fn->createTORHeader($pdf, $page, "torpic.png");
        $fn->createTORInfo($pdf, $info);
        $fn->createTORCredentiaTable($pdf);
        //Credentials


        $pdf->SetXY(12, 113);
        foreach ($data as $sem => $subjects) {
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
            $grade = '';
            $remark = '';
            foreach ($subject['grades'] as $value) {
              if (gettype($value) != 'string') {
                $grade .= number_format((float)$value, '2', '.', '').'/';
                $remark = $fn->getRemark($value);
              }else {
                $grade .= $value.'/';
              }
            }
            $gradeRemark .= $remark;
            $grade = rtrim($grade, '/');
            $pdf->Cell(24,3.5,$grade,0,0,'C',false);
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
              $fn->createTORFooter($pdf, $gradeRemark, $branchOfficials, '•ðþ');
              $gradeRemark = '';
              $pdf->AddPage();
              $pdf->AddFont('Calibri','','Calibri.php');
              $pdf->AddFont('Calibri Bold','B','Calibri Bold.php');
              $pdf->SetMargins(10, 5, 10);
              $fn->createTORHeader($pdf, $page, 'torpic.png', false);
              $fn->createTORInfo($pdf, $info);
              $fn->createTORCredentiaTable($pdf);
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
        $pdf->MultiCell(155,3.5,"GRADUATED IN DIPLOMA IN INFORMATION COMMUNICATION TECHNOLOGY PROGRAM ON APRIL 24, 2018.",0,'L',false);
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
        $pdf->Cell(130,3.5,'COPY FOR: POLYTECHNIC UNIVERSITY OF THE PHILIPPINES - MANILA',0,0,'C',false);
        //Credentials
        $fn->createTORFooter($pdf, $gradeRemark, $branchOfficials, '•¥§', true);


        $pdf->Output('tor.pdf','I');
    }

  }
