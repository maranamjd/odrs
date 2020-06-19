SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS=0;


DROP TABLE `branches`;

CREATE TABLE `branches` (
  `branchID` int(11) NOT NULL AUTO_INCREMENT,
  `branchName` varchar(45) NOT NULL,
  `acronym` varchar(45) NOT NULL,
  `directorFullName` varchar(45) NOT NULL,
  `trash` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`branchID`),
  UNIQUE KEY `branchName_UNIQUE` (`branchName`),
  UNIQUE KEY `acronym_UNIQUE` (`acronym`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

INSERT INTO `branches` (`branchID`, `branchName`, `acronym`, `directorFullName`, `trash`, `created_on`, `updated_at`) VALUES 
(1,'Manila','MN','Emanuel C. De Guzman, PhD','0','2019-03-15 04:03:54',NULL),
(2,'Taguig Branch','TG','Marissa B. Ferrer, DEM','0','2019-03-15 04:03:54',NULL),
(3,'Quezon City Branch','QC','Edgardo S. Delmo, MBA','0','2019-04-13 15:00:39',NULL),
(4,'San Juan Campus','SJ','Jaime P. Gutierrez Jr','0','2019-04-13 15:00:39',NULL),
(5,'Parañaque Campus','PQ','Aaron Vito M. Baygan, ThM','0','2019-04-13 15:02:42',NULL),
(6,'Bataan Branch','BA','Leonila J. Generales, MBA','0','2019-04-13 15:02:42',NULL),
(7,'Sta. Maria Campus','SM','None\n','0','2019-04-13 15:05:18',NULL),
(8,'Pulilan Campus','PB','Ma. Elena M. Maño','0','2019-04-13 15:05:18',NULL),
(9,'Cabiao Campus','CN','blank',1,'2019-04-13 15:07:56',NULL),
(10,'Lopez Branch','LQ','Rufo N. Bueza, MPA','0','2019-04-13 15:07:56',NULL),
(11,'Mulanay Branch','MQ','Adelia R. Roadilla, DEM','0','2019-04-13 15:09:37',NULL),
(12,'Unisan Branch','UQ','Edwin G. Malabuyoc','0','2019-04-13 15:09:37',NULL),
(13,'Ragay Branch','RC','blanko','0','2019-04-13 15:11:04',NULL),
(14,'Sto. Tomas Branch','ST','Armando A. Torres, DEM','0','2019-04-13 15:11:04',NULL),
(15,'Maragondon Branch','MC','Denise Arevalo Abril, MBE','0','2019-04-13 17:43:24',NULL),
(16,'Bansud Campus','BO','Ricardo F. Ramiscal, MPA','0','2019-04-13 17:44:08',NULL),
(17,'Sablayan Campus','SO','Lorenza Elena S. Gimutao, MAT\n','0','2019-04-13 17:44:51',NULL),
(18,'Biñan Campus','BL','Pam',1,'2019-04-13 17:45:32',NULL),
(19,'San Pedro Campus','SL','blank','0','2019-04-13 17:46:39',NULL),
(20,'Sta. Rosa Campus','SR','Charito A. Montemayor','0','2019-04-13 17:47:58',NULL),
(21,'Calauan Campus','CL','Arlene R. Queri','0','2019-04-13 17:47:58',NULL),
(22,'Pampanga','PG','Michael Joshua Marana',1,'2019-07-01 06:05:15',NULL),
(24,'Bulacan Campus','BC','Franz Mercado','0','2019-07-02 03:18:19',NULL),
(25,'asdfg','asdf','asdf',1,'2019-08-20 12:56:20',NULL);



DROP TABLE `clearances`;

CREATE TABLE `clearances` (
  `clearanceID` int(10) NOT NULL AUTO_INCREMENT,
  `studentNumber` varchar(45) CHARACTER SET utf8 NOT NULL,
  `officeID` int(10) NOT NULL,
  `branchID` int(10) NOT NULL,
  `isCleared` tinyint(1) NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8 NOT NULL,
  `type` int(1) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`clearanceID`),
  KEY `fk_clearances_students1_idx` (`studentNumber`),
  KEY `fk_clearances_offices1_idx` (`officeID`),
  KEY `fk_clearances_branches1_idx` (`branchID`),
  CONSTRAINT `fk_clearances_branches1` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_clearances_offices1` FOREIGN KEY (`officeID`) REFERENCES `offices` (`officeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_clearances_students1` FOREIGN KEY (`studentNumber`) REFERENCES `students` (`studentNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `clearances` (`clearanceID`, `studentNumber`, `officeID`, `branchID`, `isCleared`, `description`, `type`, `created_on`, `updated_at`) VALUES 
(1,'2007-00195-MN-0',1,1,'0','unpaidasdfkasdjgkaslf','0','2019-09-24 05:43:56',NULL);



DROP TABLE `college`;

CREATE TABLE `college` (
  `collegeID` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(128) NOT NULL,
  `acronym` varchar(45) NOT NULL,
  PRIMARY KEY (`collegeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO `college` (`collegeID`, `description`, `acronym`) VALUES 
(1,'College of Computer and Information Science','CCIS'),
(2,'College of Education','COED'),
(3,'College of Engineering','COE'),
(4,'College of Business Administration','CBA'),
(5,'College of Arts and Letters','CAL');



DROP TABLE `company`;

CREATE TABLE `company` (
  `companyID` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(191) NOT NULL,
  `addressNumber` varchar(45) NOT NULL,
  `addressSt` varchar(45) NOT NULL,
  `addressBrgy` varchar(45) DEFAULT NULL,
  `addressCity` varchar(45) DEFAULT NULL,
  `addressRegion` varchar(45) NOT NULL,
  `addressCountry` varchar(45) NOT NULL,
  `postalOrZipCode` varchar(45) DEFAULT NULL,
  `businessNature` text,
  PRIMARY KEY (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `company` (`companyID`, `companyName`, `addressNumber`, `addressSt`, `addressBrgy`, `addressCity`, `addressRegion`, `addressCountry`, `postalOrZipCode`, `businessNature`) VALUES 
(1,'ABC Corp',213,'Santolan St.','Bonifacio','Taguig City','Ordino','Andorra',21312,'ABC Corp'),
(2,'Drake','28th floor sky tower','Gil Puyat Avenue',NULL,'Makati City','National Capital Region','Philippines',2015,'Drake'),
(3,'Convergy\'s','b14 l2','northgate','alabang','City Of Muntinlupa','National Capital Region','Philippines',NULL,'BPO');



DROP TABLE `config`;

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(64) NOT NULL,
  `value` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `config` (`id`, `description`, `value`) VALUES 
(1,'RESET_INTERVAL_NUM',24),
(2,'RESET_INTERVAL_TYPE','HOUR'),
(3,'MAX_ATTEMPT',3),
(5,'FORFEITION_TYPE','DAY'),
(6,'FORFEITION_NUM',90);



DROP TABLE `course`;

CREATE TABLE `course` (
  `courseID` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `collegeID` int(11) DEFAULT NULL,
  `trash` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`courseID`),
  UNIQUE KEY `name_UNIQUE` (`description`),
  KEY `college_ibfk` (`collegeID`),
  CONSTRAINT `college_ibfk` FOREIGN KEY (`collegeID`) REFERENCES `college` (`collegeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

INSERT INTO `course` (`courseID`, `description`, `collegeID`, `trash`) VALUES 
(1,'Bachelor of Science in Information Technology',1,'0'),
(2,'Bachelor of Science in Mechanical Engineering',1,'0'),
(3,'Bachelor in Office Administration',4,'0'),
(4,'Bachelor of Science in Accountancy ',1,'0'),
(5,'Bachelor in Banking and Finance ',1,'0'),
(6,'Bachelor of Science in Architecture',1,'0'),
(7,'Bachelor of Science in Interior Design',1,'0'),
(28,'Bachelor of Arts in English',1,'0'),
(29,'Bachelor of Arts in Filipino',1,'0'),
(30,'Bachelor of Arts in Philosophy',1,'0'),
(31,'Bachelor of Arts in Theater Arts',1,'0'),
(32,'Bachelor of Arts in Communication Research ',1,'0'),
(33,'Bachelor of Science in Business Administratio',1,'0'),
(34,'Bachelor of Science in Entrepreneurship',1,'0'),
(35,'Bachelor in Advertising and Public Relation',4,'0'),
(36,'Bachelor of Arts in Journalism',1,'0'),
(37,'Bachelor of Arts on Broadcasting',1,'0'),
(39,'Bachelor of Science in Business Administration major in Marketing Management',1,'0'),
(40,'Bachelor of Science in Computer Science',1,'0'),
(41,'Bachelor in Elementary Education',2,'0'),
(42,'Bachelor in Library and Information Science',1,'0'),
(43,'Bachelor of Business Technology and Livelihood Education major in Home Economics',1,'0'),
(44,'Bachelor of Business Technology and Livelihood Education major in Industrial Arts ',1,'0'),
(45,'Bachelor of Business Technology and Livelihood Education major in Information and Communication Tech',1,'0'),
(46,'Bachelor of Early Childhood Education',1,'0'),
(47,'Bachelor of Secondary Education major in English ',1,'0'),
(48,'Bachelor of Secondary Education major in Filipino ',1,'0'),
(49,'Bachelor of Secondary Education major in Mathematics',1,'0'),
(50,'Bachelor of Secondary Education major in Science',1,'0'),
(51,'Bachelor of Secondary Education major in Social Studies',1,'0'),
(52,'Bachelor of Technical Vocational Education major in Food Service Management',1,'0'),
(53,'Bachelor of Science in Civil Engineering',1,'0'),
(54,'Bachelor of Science in Electrical Engineering',1,'0'),
(55,'Bachelor of Science in Industrial Engineering',1,'0'),
(56,'Bachelor of Science in Computer Engineering ',1,'0'),
(57,'Bachelor of Science in Electronics and Communications Engineering',1,'0'),
(58,'Bachelor in Physical Education',2,'0'),
(59,'Bachelor in Political Science',1,'0'),
(60,'Bachelor in Public Administration and Governance',1,'0'),
(61,'Bachelor of Science in Political Economy ',1,'0'),
(62,'Bachelor in Cooperatives ',4,'0'),
(63,'Bachelor of Arts in History',1,'0'),
(64,'Bachelor of Science in Economics',1,'0'),
(65,'Bachelor of Science in Psychology',1,'0'),
(66,'Bachelor of Science in Sociology',1,'0'),
(67,'Bachelor in Applied Statistics ',1,'0'),
(68,'Bachelor of Science in Applied Mathematics  major in Actuarial Mathematics',1,'0'),
(69,'Bachelor of Science in Biology',1,'0'),
(70,'Bachelor of Science in Chemistry',1,'0'),
(71,'Bachelor of Science in Food Technology',1,'0'),
(72,'Bachelor of Science in Mathematics',1,'0'),
(73,'Bachelor of Science in Nutrition and Dietetics',1,'0'),
(74,'Bachelor of Science in Physics',1,'0'),
(75,'Bachelor of Science in Tourism Management',1,'0'),
(76,'Bachelor in Transportation Management',1,'0'),
(77,'Bachelor of Science in Hospitality Management',1,'0'),
(78,'Diploma in Computer Engineering Technology',1,'0'),
(79,'Diploma in Electronics Communications Engineering Technology\n',1,'0'),
(80,'Diploma in Electrical Engineering Technology\n',1,'0'),
(81,'Diploma in Information Communication Technology\n',1,'0'),
(82,'Diploma in Mechanical Engineering Technology',3,'0'),
(83,'Diploma in Office Management Technology\n',1,'0');



DROP TABLE `document`;

CREATE TABLE `document` (
  `documentID` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `graduate` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `processingTime` int(4) NOT NULL COMMENT 'Processing Time in days. (e.g: 15)',
  `requirements` text,
  `documentTypeID` int(4) NOT NULL,
  `trash` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`documentID`),
  UNIQUE KEY `name_UNIQUE` (`description`),
  KEY `fk_document_document_type1_idx` (`documentTypeID`) USING BTREE,
  CONSTRAINT `fk_document_document_type1` FOREIGN KEY (`documentTypeID`) REFERENCES `document_type` (`classID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `document` (`documentID`, `description`, `graduate`, `price`, `processingTime`, `requirements`, `documentTypeID`, `trash`) VALUES 
(1,'Certificate of Transfer Credential(Honorable Dismissal) ',2,150,15,'\nLETTER OF REQUEST TO TRANSFER ',1,1),
(2,'Certificate of Grades (For Cross Enrolee)','0',150,15,NULL,1,1),
(3,'Certification of English as Medium Of instruction',2,150,15,NULL,1,1),
(4,'Certification of Enrollment/Attendance/Units Earned',2,150,15,NULL,1,1),
(5,'Certification of Non Issuance of Special Order (S.O.)',2,150,15,NULL,1,1),
(6,'Certification of Subject Description\n(150 pesos per subject)',2,150,15,NULL,1,1),
(7,'Special Certification required by Agency/gov\'t Offices',2,170,30,NULL,1,1),
(8,'Retrieval of Unclaimed Request',2,100,7,NULL,4,1),
(9,'Commission on Higher Education (CHED/CAV)\n(The documents will be prepared by the Registrar in a sealed envelope, and the client will forward to CHED)',2,620,15,NULL,2,1),
(10,'Department of Foreign Affairs (DFA/CAV) Red Ribbon (For Undergrad)\n(TOR+Cert of Non SO+Cert of English Medium of Instruction)','0',620,15,NULL,2,1),
(11,'WES Form, CES Form, IQAS Form\n(Form ONLY. Please request for other credentials to be included in WES/CES)',2,170,15,NULL,2,1),
(12,'Certified True Copy of Diploma',1,200,15,'Photocopy of your Original Diploma',5,'0'),
(13,'Certified True Copy of Transcript of Records',1,350,15,'Photocopy of your Original TOR',3,'0'),
(14,'Sealed Envelope',2,20,'0',NULL,3,1),
(15,'Transcript of Records (Undergraduate) 1st Year (Copy for)','0',120,30,'Must already have Cert. of Transfer Credential or Honorable Dismissal',3,1),
(16,'Transcript of Records (Undergraduate) 2nd Year (Copy for)','0',220,30,'Must already have Cert. of Transfer Credential or Honorable Dismissal',3,1),
(17,'Transcript of Records (Undergraduate) 3rd and 4th Year (Copy for)','0',320,30,'Must already have Cert. of Transfer Credential or Honorable Dismissal',3,1),
(18,'Transcript of Records (Undergraduate) 5th Year (Copy for)','0',420,30,'Must already have Cert. of Transfer Credential or Honorable Dismissal',3,1),
(19,'Transcript of Records (Undergraduate) 1st Year (For evaluation/reference)','0',100,30,NULL,3,1),
(20,'Transcript of Records (Undergraduate) 2nd Year (For evaluation/reference)','0',200,30,NULL,3,1),
(21,'Transcript of Records (Undergraduate) 3rd and 4th Year (For evaluation/reference)','0',300,30,NULL,3,1),
(22,'Transcript of Records (Undergraduate) 5th Year (For evaluation/reference)','0',400,30,NULL,3,1),
(23,'CAV-PRC',1,470,15,'Please provide Photocopy of TOR',2,1),
(24,'Department of Foreign Affairs (DFA/CAV) Red Ribbon (For graduates)\n([TOR+Diploma+Cert of Grad+Cert of Non SO+Cert of English Medium of Instruction]',1,920,15,NULL,2,1),
(25,'Department of Foreign Affairs (DFA/CAV) Red Ribbon (Fresh grad w/o diploma)\n([TOR+Cert of Grad+Cert of Non SO+Cert of English Medium of Instruction]',1,770,15,NULL,2,1),
(26,'Diploma Correction of Name',1,200,15,NULL,5,1),
(27,'Diploma Replacement Copy',1,200,15,'Affidavit of Loss is required',5,1),
(28,'Certification of General Weighted Average (G.W.A.)',1,150,15,NULL,1,1),
(29,'Certification of Graduation',1,150,15,NULL,1,1),
(30,'Other Special Requests\n(DON\'T CHOOSE - Unless suggested by the Registrar\'s Staff)',1,150,10,NULL,1,1),
(31,'Re-print Credentials / Counter Checking\n(DON\'T CHOOSE - Unless suggested by the Registrar\'s Staff)',1,'0',10,NULL,1,1),
(32,'(1st Copy) TOR (for board exam) + Diploma + Certificate of Graduation',1,150,30,NULL,6,1),
(33,'(1st Copy) TOR + Diploma + Certificate of Graduation',1,150,30,NULL,6,1),
(34,'Transcript of Records (Graduate) for 4 Year Course (For evaluation/reference)',1,350,30,NULL,3,1),
(35,'Transcript of Records (Graduate) for 5 Year Course (For evaluation/reference)',1,450,30,NULL,3,1),
(36,'Transcript of Records (Graduate) for 4 Year Course (Copy for)',1,370,30,NULL,3,1),
(37,'Transcript of Records (Graduate) for 5 Year Course (Copy for)',1,470,30,NULL,3,1),
(38,'Transcript of Records (Graduated) for 4 Year Course (For board/licensure exam)',1,350,30,NULL,3,1),
(39,'Transcript of Records (Graduated) for 5 Year Course (For board/licensure exam)',1,450,30,NULL,3,1);



DROP TABLE `document_type`;

CREATE TABLE `document_type` (
  `classID` int(4) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `trash` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`classID`),
  UNIQUE KEY `name_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `document_type` (`classID`, `description`, `trash`) VALUES 
(1,'Cerification','0'),
(2,'CAV(CHED/DFA/WES/CES)','0'),
(3,'Transcript of Records','0'),
(4,'Unclaimed','0'),
(5,'Diploma','0'),
(6,'1st Copy','0'),
(7,'2nd copy','0');



DROP TABLE `educational_background`;

CREATE TABLE `educational_background` (
  `ebID` int(10) NOT NULL AUTO_INCREMENT,
  `studentNumber` varchar(45) NOT NULL,
  `degreeStatus` tinyint(1) NOT NULL,
  `dateGraduated` date DEFAULT NULL,
  `numofSem` int(11) NOT NULL,
  `numofSummer` int(11) DEFAULT NULL,
  `yearAdmitted` year(4) NOT NULL,
  `admittedAs` varchar(45) NOT NULL,
  `highSchoolName` varchar(255) NOT NULL,
  `hsYearGraduated` int(4) NOT NULL,
  `elementarySchoolName` varchar(255) NOT NULL,
  `esYearGraduated` int(4) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ebID`),
  KEY `fk_educational_background_students1_idx` (`studentNumber`),
  CONSTRAINT `fk_educational_background_students1` FOREIGN KEY (`studentNumber`) REFERENCES `students` (`studentNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `educational_background` (`ebID`, `studentNumber`, `degreeStatus`, `dateGraduated`, `numofSem`, `numofSummer`, `yearAdmitted`, `admittedAs`, `highSchoolName`, `hsYearGraduated`, `elementarySchoolName`, `esYearGraduated`, `created_on`, `updated_at`) VALUES 
(1,'2015-01010-TG-0',1,'2019-03-24',8,2,2015,'freshmen','ABC High School',2015,'ABC Elementary School',2011,'2019-03-15 07:56:30',NULL),
(2,'2018-15763-MN-1','0',NULL,2,NULL,2018,'transferee','XYZ High School',2016,'XYZ Elementary School',2012,'2019-03-15 07:56:30',NULL),
(3,'2007-00195-MN-0',1,'2011-04-08',8,'0',2007,'Freshmen','Tondo National High School',2006,'Tondo Elementary School',2002,'2019-03-27 15:47:02',NULL);



DROP TABLE `empaccount`;

CREATE TABLE `empaccount` (
  `EmpAccountID` int(10) NOT NULL AUTO_INCREMENT,
  `employeeID` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `userType` int(1) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`EmpAccountID`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `employeeID` (`employeeID`),
  CONSTRAINT `empaccount_ibfk` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `empaccount` (`EmpAccountID`, `employeeID`, `email`, `password`, `userType`, `created_on`, `updated_at`, `isActive`) VALUES 
(1,14045,'juandelacrux@gmail.com','lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=',4,'2019-03-25 17:30:21',NULL,1),
(2,'06010','sigmund@gmail.com','lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=',2,'2019-04-14 12:11:11',NULL,1),
(3,10011,'canlas@gmail.com','lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=',3,'2019-04-14 12:11:11',NULL,1),
(4,'04021','jaime@gmail.com','lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=',1,'2019-04-14 12:12:02',NULL,1),
(5,15014,'marana.michaelj@gmail.com','lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=',4,'2019-07-01 12:15:57',NULL,'0'),
(6,10012,'mercado@gmail.com','QQUewCnRrN7D+4LXZ7+6ti6q6bpG1JmkDWwdqC/LMFM=',3,'2019-07-02 03:26:51',NULL,'0'),
(7,34092,'santos@gmail.com','lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=',4,'2019-08-20 12:44:20',NULL,'0'),
(8,13054,'colibaomarkjoseph@gmail.com','MPvCXAgGHoY+kPfMugw8/oWHNpI9Bc37DFKwzCXsTyA=',2,'2019-09-20 03:13:05',NULL,'0'),
(9,15083,'herrerahazel@gmail.com','r2Uf/hmp72Y1STLeOnpM1pQjyw/IVwxjtgX8yjkg8Jk=',3,'2019-09-20 03:14:59',NULL,1),
(10,18213,'lance@gmail.com','KubXzfQhLnVB7Wp7xD757pRDMjB8hgPfJBzqmqdSmXQ=',4,'2019-09-20 03:18:00',NULL,'0');



DROP TABLE `employee`;

CREATE TABLE `employee` (
  `employeeID` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL COMMENT 'For Prepared by in TOR',
  `lname` varchar(45) NOT NULL COMMENT 'For Prepared by in TOR',
  `mname` varchar(45) DEFAULT NULL COMMENT 'For Prepared by in TOR',
  `suffix` varchar(6) DEFAULT NULL,
  `branchID` int(10) NOT NULL,
  `officeID` int(10) DEFAULT NULL,
  `position` varchar(45) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`employeeID`),
  UNIQUE KEY `username_UNIQUE` (`employeeID`),
  KEY `fk_employee_branches1_idx` (`branchID`),
  KEY `fk_employee_offices1_idx` (`officeID`),
  CONSTRAINT `fk_employee_branches1` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_offices1` FOREIGN KEY (`officeID`) REFERENCES `offices` (`officeID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `employee` (`employeeID`, `fname`, `lname`, `mname`, `suffix`, `branchID`, `officeID`, `position`, `created_on`, `created_at`) VALUES 
('04021','Jaime','Gonzales','Y',NULL,1,3,'Asst. University Registrar','2019-04-14 07:32:52',NULL),
('06010','Sigmund Heinrich ','Sese','G',NULL,1,3,'Asst. Registrar','2019-04-14 04:02:38',NULL),
(10011,'Bernadette ','Canlas','I',NULL,2,3,'Registrar and Head of Admission','2019-04-14 03:46:23',NULL),
(10012,'Franz','Mercado',NULL,NULL,1,6,'Tungo','2019-07-02 03:26:51',NULL),
(13054,'Mark','Colibao',NULL,NULL,2,3,'Records Analyst','2019-09-20 03:13:04',NULL),
(14045,'Juan','Cruz','Dela',NULL,1,3,'Registrar Staff','2019-03-25 17:23:38',NULL),
(15014,'Michael Joshua','Marana','Duran',NULL,1,2,'Hilata','2019-07-01 12:15:57',NULL),
(15083,'Hazel Joy','Herrera','Ramos',NULL,22,6,'Staff','2019-09-20 03:14:59',NULL),
(18213,'Lance','Gabaleno',NULL,NULL,2,2,'Hilata','2019-09-20 03:18:00',NULL),
(34092,'Patricia','Santos','Gueco',NULL,2,3,'Staff','2019-08-20 12:44:20',NULL);



DROP TABLE `enrolled`;

CREATE TABLE `enrolled` (
  `subjtakenId` int(10) NOT NULL AUTO_INCREMENT,
  `studentNumber` varchar(45) NOT NULL,
  `subjectCode` varchar(15) NOT NULL,
  `grade` varchar(15) NOT NULL,
  `sem` varchar(11) NOT NULL,
  `schoolyrFrom` year(4) NOT NULL,
  `schoolyrTo` year(4) DEFAULT NULL,
  PRIMARY KEY (`subjtakenId`),
  KEY `fk_subjectTaken_students1_idx` (`studentNumber`),
  KEY `fk_subjectTaken_subjects1_idx` (`subjectCode`),
  CONSTRAINT `fk_subjectTaken_students1` FOREIGN KEY (`studentNumber`) REFERENCES `students` (`studentNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_subjectTaken_subjects1` FOREIGN KEY (`subjectCode`) REFERENCES `subjects` (`subjectCode`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

INSERT INTO `enrolled` (`subjtakenId`, `studentNumber`, `subjectCode`, `grade`, `sem`, `schoolyrFrom`, `schoolyrTo`) VALUES 
(1,'2015-01010-TG-0','ICT 111',2.50,1,2015,2016),
(2,'2015-01010-TG-0','ICT 112',2.00,1,2015,2016),
(3,'2015-01010-TG-0','ICT 113',1.50,1,2015,2016),
(4,'2015-01010-TG-0','ICT 114',2.25,1,2015,2016),
(5,'2015-01010-TG-0','ICT 115 ',3.00,1,2015,2016),
(6,'2015-01010-TG-0','ITEN 111',2.00,1,2015,2016),
(7,'2015-01010-TG-0','ITMT 111',2.50,1,2015,2016),
(8,'2015-01010-TG-0','PE 111',2.00,1,2015,2016),
(9,'2015-01010-TG-0','CWTS 1013',1.00,1,2015,2016),
(10,'2015-01010-TG-0','ICT 121',2.00,2,2015,2016),
(11,'2015-01010-TG-0','ICT 123',2.50,2,2015,2016),
(12,'2015-01010-TG-0','ICT 124',1.25,2,2015,2016),
(13,'2015-01010-TG-0','ICT 125',2.00,2,2015,2016),
(14,'2015-01010-TG-0','IT 121',1.00,2,2015,2016),
(15,'2015-01010-TG-0','ITEN 112',2.00,2,2015,2016),
(16,'2015-01010-TG-0','ITMT 121',2.50,2,2015,2016),
(17,'2015-01010-TG-0','PE 112',2.00,2,2015,2016),
(18,'2015-01010-TG-0','CWTS 1023',1.00,2,2015,2016),
(19,'2015-01010-TG-0','ICT 132',2.00,3,2016,NULL),
(20,'2015-01010-TG-0','ICT 212',2.50,1,2016,2017),
(21,'2015-01010-TG-0','ICT 215',2.00,1,2016,2017),
(22,'2015-01010-TG-0','ICT 216',2.25,1,2016,2017),
(23,'2015-01010-TG-0','ICT 217',2.00,1,2016,2017),
(24,'2015-01010-TG-0','ICT 219',1.00,1,2016,2017),
(25,'2015-01010-TG-0','ICT 220 ',1.00,1,2016,2017),
(26,'2015-01010-TG-0','ITEN 113',2.50,1,2016,2017),
(27,'2015-01010-TG-0','PE 113',2.00,1,2016,2017),
(28,'2015-01010-TG-0','ICT 223',2.50,2,2016,2017),
(29,'2015-01010-TG-0','ICT 224 ',1.75,2,2016,2017),
(30,'2015-01010-TG-0','ICT 225 ',1.00,2,2016,2017),
(31,'2015-01010-TG-0','ICT 226',2.25,2,2016,2017),
(32,'2015-01010-TG-0','ICT 227',2.50,2,2016,2017),
(33,'2015-01010-TG-0','ICT 228',2.00,2,2016,2017),
(34,'2015-01010-TG-0','ICT 229',2.50,2,2016,2017),
(35,'2015-01010-TG-0','PE 114',2.00,2,2016,2017),
(36,'2015-01010-TG-0','IT 231',1.00,3,2017,NULL),
(37,'2015-01010-TG-0','ICT 311',2.25,1,2017,2018),
(38,'2015-01010-TG-0','ICT 312',2.50,1,2017,2018),
(39,'2015-01010-TG-0','ICT 313',2.00,1,2017,2018),
(40,'2015-01010-TG-0','ICT 314',2.25,1,2017,2018),
(41,'2015-01010-TG-0','ICT 315',2.50,1,2017,2018),
(42,'2015-01010-TG-0','ICT 316',2.00,1,2017,2018),
(43,'2015-01010-TG-0','ICT 317',2.50,1,2017,2018),
(44,'2015-01010-TG-0','ICT 318',2.00,1,2017,2018),
(45,'2018-15763-MN-1','ICT 112',1.00,2,2015,2017),
(46,'2015-01010-TG-0','ICT 321',1.00,2,2017,2018),
(47,'2015-01010-TG-0','ICT 325',2.00,2,2017,2018),
(48,'2018-15763-MN-1','ENG 111',1.00,1,2018,2018),
(49,'2007-00195-MN-0','EN 110',2.00,1,2007,2008),
(50,'2007-00195-MN-0','FO 101 ',2.5,1,2007,2008),
(51,'2007-00195-MN-0','PY 100',1.75,1,2007,2008),
(52,'2007-00195-MN-0','SO 100',1.50,1,2007,2008),
(53,'2007-00195-MN-0','MK 110',1.25,1,2007,2008),
(54,'2007-00195-MN-0','OS 120',2.75,1,2007,2008),
(55,'2007-00195-MN-0','ICT 115 ','P',1,2007,2008),
(56,'2007-00195-MN-0','OS 141',2.75,1,2007,2008),
(57,'2007-00195-MN-0','PE 111',2.00,1,2007,2008),
(58,'2007-00195-MN-0','CWTS 1013',1.50,1,2007,2008),
(59,'2007-00195-MN-0','EN 111 ',2.00,2,2007,2008),
(60,'2007-00195-MN-0','FO 102',2.00,2,2007,2008),
(61,'2007-00195-MN-0','MT 102',3.00,2,2007,2008),
(62,'2007-00195-MN-0','LT 110',2.00,2,2007,2008),
(63,'2007-00195-MN-0','PS 105',3.00,2,2007,2008),
(64,'2007-00195-MN-0','OS 143',2.00,2,2007,2008),
(65,'2007-00195-MN-0','OS 115',2.75,2,2007,2008),
(66,'2007-00195-MN-0','OS 121',2.00,2,2007,2008),
(67,'2007-00195-MN-0','PE 112',2.00,2,2007,2008),
(68,'2007-00195-MN-0','CWTS 1023',2.00,2,2007,2008),
(69,'2007-00195-MN-0','EN 214',2.00,1,2008,2009),
(70,'2007-00195-MN-0','AC 113',1.50,1,2008,2009),
(71,'2007-00195-MN-0','OS 243',2.00,1,2008,2009),
(72,'2007-00195-MN-0','LW 111',1.00,1,2008,2009),
(73,'2007-00195-MN-0','PH 110',2.00,1,2008,2009),
(74,'2007-00195-MN-0','NS 210',1.75,1,2008,2009),
(75,'2007-00195-MN-0','OS 142',2.00,1,2008,2009),
(76,'2007-00195-MN-0','PE 112',3.00,1,2008,2009),
(77,'2007-00195-MN-0','NS 230 ',2.00,2,2008,2009),
(78,'2007-00195-MN-0','HU 110 ',3.00,2,2008,2009),
(79,'2007-00195-MN-0','MN 110 ',2.00,2,2008,2009),
(80,'2007-00195-MN-0','AC 123',2.75,2,2008,2009),
(81,'2007-00195-MN-0','OS 121',2.00,2,2008,2009),
(82,'2007-00195-MN-0','PE 114',2.75,2,2008,2009),
(83,'2007-00195-MN-0','EC 100 ',2.00,2,2008,2009),
(84,'2007-00195-MN-0','ST 123',1.75,1,2009,2010),
(85,'2007-00195-MN-0','OA 381',2.00,1,2009,2010),
(86,'2007-00195-MN-0','OA 382',1.50,1,2009,2010),
(87,'2007-00195-MN-0','OA 384',1.25,1,2009,2010),
(88,'2007-00195-MN-0','OA 485',2.00,2,2009,2010),
(89,'2007-00195-MN-0','ECON 1013',2.00,2,2009,2010),
(90,'2007-00195-MN-0','OFAD 3103',NULL,2,2009,2010),
(91,'2007-00195-MN-0','STAT 1013',2.00,2,2009,2010),
(92,'2007-00195-MN-0','HS 110 ',2.00,2,2010,2011),
(93,'2007-00195-MN-0','OA 485',2.00,2,2009,NULL),
(94,'2007-00195-MN-0','CS 160',2.00,1,2010,2011),
(98,'2007-00195-MN-0','OA 452',2.00,2,2010,2011);



DROP TABLE `offices`;

CREATE TABLE `offices` (
  `officeID` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `trash` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`officeID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `offices` (`officeID`, `name`, `trash`) VALUES 
(1,'Accounting Office','0'),
(2,'Computer Lab',1),
(3,'Registrar\'s Office','0'),
(4,'Accounting',1),
(5,'Cashier\'s Office','0'),
(6,'Student Services','0'),
(7,'sample',1),
(8,'sssss',1),
(9,'dfdfdf',1);



DROP TABLE `payment_type`;

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(64) NOT NULL,
  `image` varchar(64) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `payment_type` (`payment_type_id`, `description`, `image`, `enabled`) VALUES 
(1,'PUP Cashier','cashier.png',1),
(2,'Land Bank','icon-landbank.jpg',1),
(3,'abot','19357775_10207391356782248_362435371_n.jpg.jpg','0'),
(4,'paypal','paypal.png','0'),
(5,'asdf','asdf.png','0');



DROP TABLE `payments`;

CREATE TABLE `payments` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `orNumber` varchar(45) NOT NULL,
  `controlNumber` varchar(15) NOT NULL,
  `fileName` varchar(64) NOT NULL,
  `currency` varchar(45) NOT NULL DEFAULT 'PHP',
  `datePaid` date NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `payment_type_id` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`paymentID`),
  UNIQUE KEY `orNumber_UNIQUE` (`orNumber`),
  KEY `fk_payments_requests_controller1_idx` (`controlNumber`),
  KEY `payment_type_ibfk` (`payment_type_id`),
  CONSTRAINT `payment_type_ibfk` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`payment_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `payments` (`paymentID`, `orNumber`, `controlNumber`, `fileName`, `currency`, `datePaid`, `created_on`, `updated_at`, `type`, `payment_type_id`, `status`) VALUES 
(1,'2019005728-283-12',201909050001,NULL,'PHP','2019-09-05','2019-09-06 13:00:40',NULL,1,1,1),
(2,20190005384,201909060001,NULL,'PHP','2019-09-07','2019-09-08 06:52:46',NULL,1,1,1),
(3,432352342423,201909050001,NULL,'PHP','2019-09-09','2019-09-10 10:42:37',NULL,1,1,1),
(4,234225323,201909050001,NULL,'PHP','2019-09-09','2019-09-10 10:44:44',NULL,1,1,1),
(5,'201909050001-8-001',201909050001,'201909050001-8-001.pdf','PHP','0000-00-00','2019-09-10 11:01:42',NULL,2,2,1),
(6,21086446454,201909110001,NULL,'PHP','2019-09-11','2019-09-12 00:56:43',NULL,1,1,1),
(7,'201909190003-3-001',201909190003,'201909190003-3-001.pdf','PHP','0000-00-00','2019-09-20 21:15:48',NULL,2,2,'0'),
(8,20192736123,201909110002,NULL,'PHP','2019-09-20','2019-09-20 23:59:03',NULL,1,1,1),
(9,2912732123,201909190001,NULL,'PHP','2019-09-20','2019-09-21 00:15:44',NULL,1,1,1),
(10,201954321323,201909200001,NULL,'PHP','2019-09-20','2019-09-21 02:47:54',NULL,1,1,1),
(11,2324325232,201909230001,NULL,'PHP','2019-09-23','2019-09-23 16:27:22',NULL,1,2,1);



DROP TABLE `representatives`;

CREATE TABLE `representatives` (
  `repID` int(11) NOT NULL AUTO_INCREMENT,
  `companyID` int(11) NOT NULL,
  `firstName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `middleName` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `lastName` varchar(45) CHARACTER SET utf8 NOT NULL,
  `suffix` varchar(5) DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8 NOT NULL,
  `password` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`repID`),
  UNIQUE KEY `email` (`email`),
  KEY `company_Rep` (`companyID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `representatives` (`repID`, `companyID`, `firstName`, `middleName`, `lastName`, `suffix`, `email`, `password`, `isActive`) VALUES 
(1,1,'Ador',NULL,'Domingo',NULL,'domingoador1@gmail.com','lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=','0'),
(2,2,'Michael Joshua','Duran','Marana',NULL,'marana.michaelj@gmail.com','lPWZEGBpHaPzemqv5y3yjP0nWIhj7MGwtcDhz4NTuRY=','0'),
(3,3,'hazel joy',NULL,'herrera',NULL,'herrerahazel@gmail.com',NULL,'0');



DROP TABLE `request`;

CREATE TABLE `request` (
  `requestID` int(10) NOT NULL AUTO_INCREMENT,
  `controlNumber` varchar(15) NOT NULL,
  `document_documentID` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `printedBy` varchar(45) DEFAULT NULL,
  `datePrinted` timestamp NULL DEFAULT NULL,
  `processedBy` varchar(45) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`requestID`),
  KEY `fk_request_requests_controller1_idx` (`controlNumber`),
  KEY `fk_request_document1_idx` (`document_documentID`),
  CONSTRAINT `fk_request_document1` FOREIGN KEY (`document_documentID`) REFERENCES `document` (`documentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_request_requests_controller1` FOREIGN KEY (`controlNumber`) REFERENCES `requests_controller` (`controlNumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `request` (`requestID`, `controlNumber`, `document_documentID`, `quantity`, `printedBy`, `datePrinted`, `processedBy`, `status`) VALUES 
(1,201909050001,12,1,'06010','2019-09-09 22:45:05',NULL,2),
(2,201909050001,13,1,'06010','2019-09-09 22:45:16',NULL,2),
(3,201909060001,12,1,'06010','2019-09-07 18:53:02',NULL,'0'),
(4,201909110001,12,1,'06010','2019-09-12 00:56:59',NULL,2),
(5,201909110002,13,1,'06010','2019-09-20 11:59:26',NULL,2),
(6,201909190001,12,1,'06010','2019-09-20 13:19:08',NULL,2),
(7,201909190001,13,1,'06010','2019-09-20 15:01:32',NULL,2),
(8,201909200001,13,1,'06010','2019-09-22 10:47:03',NULL,2),
(9,201909220001,12,1,NULL,NULL,NULL,'0'),
(10,201909230001,12,1,'06010','2019-09-23 06:00:49',NULL,2),
(11,201909230002,12,1,NULL,NULL,NULL,'0');



DROP TABLE `requests_controller`;

CREATE TABLE `requests_controller` (
  `controlNumber` varchar(15) NOT NULL,
  `studentNumber` varchar(45) NOT NULL,
  `lastTermYear` year(4) NOT NULL,
  `purpose` varchar(45) NOT NULL,
  `dateFiled` date DEFAULT NULL,
  `isFastLane` tinyint(1) NOT NULL DEFAULT '0',
  `isCleared` tinyint(1) NOT NULL DEFAULT '0',
  `expectedDueDate` date DEFAULT NULL,
  `dateFinished` timestamp NULL DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`controlNumber`),
  UNIQUE KEY `controlNo_UNIQUE` (`controlNumber`),
  KEY `fk_requests_controller_students1_idx` (`studentNumber`),
  CONSTRAINT `fk_requests_controller_students1` FOREIGN KEY (`studentNumber`) REFERENCES `students` (`studentNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `requests_controller` (`controlNumber`, `studentNumber`, `lastTermYear`, `purpose`, `dateFiled`, `isFastLane`, `isCleared`, `expectedDueDate`, `dateFinished`, `status`) VALUES 
(201909050001,'2007-00195-MN-0',2011,NULL,'2019-09-19',1,'0','2019-09-20','2019-09-10 04:46:03',3),
(201909060001,'2007-00195-MN-0',2011,NULL,'2019-09-19','0','0','2019-10-06','2019-09-08 00:53:58',3),
(201909110001,'2007-00195-MN-0',2011,NULL,'2019-09-19','0','0','2019-10-11','2019-09-20 17:58:31',3),
(201909110002,'2015-01010-TG-0',2019,NULL,'2019-09-19','0','0','2019-10-11','2019-09-20 18:00:02',3),
(201909190001,'2007-00195-MN-0',2011,NULL,'2019-09-19',1,'0','2019-10-04',NULL,2),
(201909200001,'2015-01010-TG-0',2019,NULL,'2019-09-20','0','0','2019-10-20','2019-09-22 04:47:39',3),
(201909220001,'2015-01010-TG-0',2019,NULL,'2019-09-22','0','0','2019-10-22',NULL,4),
(201909230001,'2015-01010-TG-0',2019,NULL,'2019-09-23','0','0','2019-10-23',NULL,4),
(201909230002,'2015-01010-TG-0',2019,NULL,'2019-09-23','0','0','2019-10-23',NULL,'0');



DROP TABLE `students`;

CREATE TABLE `students` (
  `studentNumber` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `suffix` varchar(5) DEFAULT NULL,
  `birthDate` date NOT NULL,
  `mobileNumber` varchar(45) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `permanentAddress` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `courseID` int(10) NOT NULL,
  `branchID` int(10) NOT NULL,
  `entranceCredentials` varchar(45) NOT NULL DEFAULT 'PUPCET',
  `isGraduate` tinyint(1) NOT NULL,
  `attempt` int(1) NOT NULL DEFAULT '3',
  PRIMARY KEY (`studentNumber`),
  KEY `fk_students_course1_idx` (`courseID`),
  KEY `fk_students_branches1_idx` (`branchID`),
  CONSTRAINT `fk_students_branches1` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_course1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `students` (`studentNumber`, `lname`, `fname`, `mname`, `suffix`, `birthDate`, `mobileNumber`, `phoneNumber`, `email`, `permanentAddress`, `status`, `courseID`, `branchID`, `entranceCredentials`, `isGraduate`, `attempt`) VALUES 
('2007-00195-MN-0','Pangilinan','Esmeralda Jade','Tiglao',NULL,'1990-10-07','09294757384',NULL,'marana.michaelj@gmail.com','Blk. 04, #19 Bonifacio St., Tondo, Manila','0',3,1,'PUPCET',1,2),
('2015-01010-TG-0','Cruz','Juan','Dela','Jr','1996-12-12','09296322420',NULL,'domingoador1@gmail.com','General Santos Ave, Lower Bicutan, Taguig, Metro Manila','0',1,2,'PUPCET',1,3),
('2018-15763-MN-1','Mercado','Franz','Febrer',NULL,'1997-12-29',NULL,NULL,NULL,'Brgy. Buenavista, Alabat, Quezon',1,1,1,'PUPCET','0','0');



DROP TABLE `subjects`;

CREATE TABLE `subjects` (
  `subjectCode` varchar(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `credits` int(1) NOT NULL,
  `trash` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`subjectCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `subjects` (`subjectCode`, `title`, `credits`, `trash`) VALUES 
('AC 113','BASIC FINANCIAL ACCOUNTING P-1',3,'0'),
('AC 123','BASIC FINANCIAL ACCOUNTING P-2',3,'0'),
('CS 160','INTRO TO INFORMATION TECHNOLOGY',3,'0'),
('CWTS 1013','CIVIL WELARE TRAINING',2,'0'),
('CWTS 1023','CIVIC WELFARE TRAINING SERVICE 2',2,'0'),
('EC 100 ','BASIC ECONOMICS & TAXATION',3,'0'),
('ECON 1013','BASIC ECO. TAXATION & AGGRARIAN REFORM ',3,'0'),
('EN 110','STUDY & THINKING SKILLS IN ENGLISH',3,'0'),
('EN 111 ','WRITING IN THE DICIPLINE',3,'0'),
('EN 214','BUSINESS COMMUNICATION AND WRITING',3,'0'),
('ENG 111',' American Literature, creative writing',3,'0'),
('FO 101 ','kOMUNIKASYON SA AKADEMIKONG FILIPINO',3,'0'),
('FO 102','PAGBABASA AT PAGSUSULAT SA IBAT IBANG DESIPLINA',3,'0'),
('HS 110 ','BUHAY GAWAIN AT MGA SINULAT NI RIZAL',3,'0'),
('HU 110 ','INTRO TO HUMANITIES',3,'0'),
('ICT 111','ACCOUNTING PRINCIPLES',3,'0'),
('ICT 112','INFORMATION TECHNOLOGY FUNDAMENTALS',3,'0'),
('ICT 113','COMPUTER PROGRAMMING 1',3,'0'),
('ICT 114','BASIC COMPUTER HARDWARE SERVICING','0','0'),
('ICT 115 ','KEYBOARDNG 1',3,'0'),
('ICT 121','COMPUTER PROGRAMMING 2',3,'0'),
('ICT 123','HARDWARE/SOFTWARE INSTALLATION MAINTENACE',3,'0'),
('ICT 124','BASIC ELECTRONICS',3,'0'),
('ICT 125','PROFESSIONAL ETHICS',3,'0'),
('ICT 132','PRACTICUM 1 (INFORMATION TECHNOLOGY ASSISTANT)',2,'0'),
('ICT 212','COMPUTER PROGRAMMING 3',3,'0'),
('ICT 213','ON THE JOB TRAINING 2',2,'0'),
('ICT 215','TECHNICAL DOCUMENTATION AND PRESENTATION SKILL IN INFORMATION TECHNOLOGY',3,'0'),
('ICT 216','OPERATING SYSTEM',4,'0'),
('ICT 217','DISCRETE STRUCTURES WITH ALGORITHM',3,'0'),
('ICT 218','COMPUTER SYSTEM ORGANIZATION',3,'0'),
('ICT 219','DATA COMMUNICATION AND NETWORKING',3,'0'),
('ICT 220 ','OBJECT-ORIENTED PROGRAMMING',4,'0'),
('ICT 223','DATA FILE AND STRUCTURES',3,'0'),
('ICT 224 ','NETWORK ADMINISTRATION',3,'0'),
('ICT 225 ','ADVANCED PROGRAMMNG',3,'0'),
('ICT 226','WEB DEVELOPMENT',4,'0'),
('ICT 227','MULTIMEDIA 1',3,'0'),
('ICT 228','DATABASE MANAGEMENT SYSTEM ',3,'0'),
('ICT 229','WIRELESS AND MOBILE COMPUTING',3,'0'),
('ICT 311','DATABASE ADMINISTRATION',3,'0'),
('ICT 312','MANAGEMENT INFORMATION SYSTEM',3,'0'),
('ICT 313','SOFTWARE ENGINEERING',3,'0'),
('ICT 314','SYSTEM ANALYSIS AND DESIGN',3,'0'),
('ICT 315','IT PROJECT MANAGEMENT',3,'0'),
('ICT 316','COMPUTER TECHNOPRENEURSHIP',3,'0'),
('ICT 317','DATA MINING AND DATA WAREHOUSING ',3,'0'),
('ICT 318','MULTIMEDIA 2',3,'0'),
('ICT 321','INTERNSHIP (COMPUTER PROGRAMMING SPECIALIST) ',6,'0'),
('ICT 325','CAPSTONE PROJECT',3,'0'),
('IT 121','INTEGRATED APPLICATION SOFTWARE',3,'0'),
('IT 231','ON THE JOB TRAINING',2,'0'),
('ITEN 111','STUDY AND THINKING SKILLS',3,'0'),
('ITEN 112','SPEECH COMMUNICATION',3,'0'),
('ITEN 113','BUSINESS COMMUNICATION AND REPORT WRITING ',3,'0'),
('ITMT 111','COLLEGE ALGEBRA',3,'0'),
('ITMT 121','PLANE AND SPHERICAL TRIGONOMETRY',3,'0'),
('LT 110','PHILIPPINE LITERATURE',3,'0'),
('LW 111','OBLIGATION & CONTRACTS',3,'0'),
('MATH 123','GEOMETRY',3,'0'),
('MK 110','MARKETING PRINCIPLES & APPLICATION',3,'0'),
('MN 110 ','PRINCIPLES OF BUSINESS ORGANIZATION',3,'0'),
('MN 412','ORGANIZATIONAL BEHAVIOR',3,'0'),
('MT 102','MATHEMATICS FOR BUSINESS',3,'0'),
('NS 210','BIOLOGY SCIENCE',3,'0'),
('NS 230 ','ECOLOGY',3,'0'),
('OA 381','LEGAL OFFICE PROCEDURES',3,'0'),
('OA 382','LEGAL TERMINOLOGY P-1',3,'0'),
('OA 384','BASIC LEGAL TRANSCRIPTION',3,'0'),
('OA 410','INTRO TO RESEARCH',3,'0'),
('OA 451','INTERNET AND WEBPAGE DEVELOPMENT',3,'0'),
('OA 452','OFFICE ADMINISTRATION APPROACH ',3,'0'),
('OA 485','LEGAL TRANSCRIPTION INTERNSHIP',3,'0'),
('OA 486','LEGAL TRANSCRIPTION INTERNSHIP P-2',3,'0'),
('OFAD 3103','TRANS. & SPEED BUILDING P-2 WITH LAB',3,'0'),
('OS 115','DOCS. PROD WITH LAB ',3,'0'),
('OS 120','BASIC SHORTHAND ',3,'0'),
('OS 121','INTERMEDIATE SHORTHAND',3,'0'),
('OS 141','OFFICE PROCEDURE $ ETHICS',3,'0'),
('OS 142','PERSONAL AND PROFESSIONAL DEVELOPMENT',3,'0'),
('OS 143','INTRODUCTION TO WORD PRESS',3,'0'),
('OS 243','ADVANCE WORD PROCESS WITH LAB',3,'0'),
('PE 111','PHYSICAL EDUCATION 1',3,'0'),
('PE 112','PHYSICAL EDUACTION 2',2,'0'),
('PE 113','PHYSICAL EDUCATION 3',2,'0'),
('PE 114','PHYSICAL EDUCATION 4',3,'0'),
('PH 110','INTRO TO PHILOSOPY',3,'0'),
('PHY 123','COLLEGE PHYSICS',3,'0'),
('PS 105','POLITICS AND GOVERNANCE WITH CONSTITUTION',3,'0'),
('PY 100','GENERAL PHYSCOLOGY',3,'0'),
('SO 100','SOSYOLOHIYA KULTURA AT PAGPAPAMILYA',3,'0'),
('ST 123','GENERAL STATISTICS',3,'0'),
('STAT 1013','GENERAL STATISTICS',3,'0');



DROP TABLE `survey`;

CREATE TABLE `survey` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `studentNumber` varchar(45) NOT NULL,
  `questionID` int(10) NOT NULL,
  `choiceID` int(10) DEFAULT NULL,
  `other` text,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_surveys_students1_idx` (`studentNumber`),
  KEY `fk_surveys_survey_questions1_idx` (`questionID`),
  KEY `choice_ibfk` (`choiceID`),
  CONSTRAINT `fk_surveys_students1` FOREIGN KEY (`studentNumber`) REFERENCES `students` (`studentNumber`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_surveys_survey_questions1` FOREIGN KEY (`questionID`) REFERENCES `survey_questions` (`questionID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

INSERT INTO `survey` (`id`, `studentNumber`, `questionID`, `choiceID`, `other`, `created_on`, `updated_at`) VALUES 
(11,'2007-00195-MN-0',7,13,NULL,NULL,NULL),
(12,'2007-00195-MN-0',8,16,NULL,NULL,NULL),
(13,'2007-00195-MN-0',9,19,NULL,NULL,NULL),
(14,'2007-00195-MN-0',10,21,NULL,NULL,NULL),
(15,'2007-00195-MN-0',11,28,NULL,NULL,NULL),
(26,'2015-01010-TG-0',7,'0','tambay',NULL,NULL),
(27,'2015-01010-TG-0',8,16,NULL,NULL,NULL),
(28,'2015-01010-TG-0',9,19,NULL,NULL,NULL),
(29,'2015-01010-TG-0',10,22,NULL,NULL,NULL),
(30,'2015-01010-TG-0',11,'0',7000,NULL,NULL);



DROP TABLE `survey_choices`;

CREATE TABLE `survey_choices` (
  `choiceID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `description` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `trash` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`choiceID`),
  KEY `questions_ibfk` (`questionID`),
  CONSTRAINT `questions_ibfk` FOREIGN KEY (`questionID`) REFERENCES `survey_questions` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

INSERT INTO `survey_choices` (`choiceID`, `questionID`, `description`, `trash`) VALUES 
(13,7,'Full time','0'),
(14,7,'Part time','0'),
(15,7,'Casual','0'),
(16,8,'Board Exam','0'),
(17,8,'Employment','0'),
(18,8,'School Transferal','0'),
(19,9,'Yes','0'),
(20,9,'No','0'),
(21,10,'Yes','0'),
(22,10,'No','0'),
(23,11,'10k - 15k','0'),
(24,11,'16k - 20k','0'),
(25,11,'21k - 25k','0'),
(26,11,'26k - 30k','0'),
(27,11,'31k - 35k','0'),
(28,11,'40k - above','0');



DROP TABLE `survey_questions`;

CREATE TABLE `survey_questions` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(191) NOT NULL,
  `hasOther` int(1) NOT NULL DEFAULT '0',
  `trash` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `survey_questions` (`questionID`, `question`, `hasOther`, `trash`) VALUES 
(7,'Current Status of Employment',1,'0'),
(8,'For what purpose does your requested document serve?',1,'0'),
(9,'If you will use the document for your new job. Does the job you are applying for fits on your skills?','0','0'),
(10,'If you are currently employed, is your Job/Work related to your Course/Program?','0','0'),
(11,'If you are currently employed, how much is your current monthly income?',1,'0');



DROP TABLE `verifications`;

CREATE TABLE `verifications` (
  `verificationID` int(11) NOT NULL AUTO_INCREMENT,
  `verControllerID` varchar(45) NOT NULL,
  `docType` int(2) NOT NULL,
  `studentID` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `fileName` varchar(64) DEFAULT NULL,
  `verifiedAt` datetime DEFAULT NULL,
  `verifiedBy` varchar(45) DEFAULT NULL,
  `result` varchar(45) DEFAULT '0',
  PRIMARY KEY (`verificationID`),
  UNIQUE KEY `pdf_file_path_UNIQUE` (`fileName`),
  KEY `fk_verification_employee1_idx` (`verifiedBy`),
  KEY `verificationController_ID` (`verControllerID`),
  KEY `docType_ibfk` (`docType`),
  CONSTRAINT `docType_ibfk` FOREIGN KEY (`docType`) REFERENCES `document_type` (`classID`),
  CONSTRAINT `employeeID_ibfk` FOREIGN KEY (`verifiedBy`) REFERENCES `employee` (`employeeID`),
  CONSTRAINT `verificationID_ibfk` FOREIGN KEY (`verControllerID`) REFERENCES `verifications_controller` (`verControllerID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `verifications` (`verificationID`, `verControllerID`, `docType`, `studentID`, `fileName`, `verifiedAt`, `verifiedBy`, `result`) VALUES 
(1,201909190001,3,NULL,'201909190001_0.pdf',NULL,NULL,'0'),
(2,201909190002,3,NULL,'201909190002_0.pdf',NULL,NULL,'0'),
(3,201909190003,5,NULL,'201909190003_0.pdf',NULL,NULL,'0'),
(4,201909200001,3,NULL,'201909200001_0.pdf',NULL,NULL,'0'),
(5,201909230001,5,NULL,'201909230001_0.pdf',NULL,NULL,'0');



DROP TABLE `verifications_controller`;

CREATE TABLE `verifications_controller` (
  `verControllerID` varchar(45) CHARACTER SET utf8 NOT NULL,
  `proceedCode` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `repID` int(11) NOT NULL,
  `created_on` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `registrarNote` text,
  `dateFinished` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`verControllerID`),
  KEY `Rep_request` (`repID`),
  CONSTRAINT `repID_ibfk` FOREIGN KEY (`repID`) REFERENCES `representatives` (`repID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `verifications_controller` (`verControllerID`, `proceedCode`, `repID`, `created_on`, `status`, `registrarNote`, `dateFinished`, `updated_at`, `deleted_at`) VALUES 
(201909190001,'gdxGbnPb7OdAc',1,'2019-09-19','0','sorry','2019-09-23 06:53:16',NULL,NULL),
(201909190002,'CG39Wv9VYHaiq',2,'2019-09-19','0',NULL,'2019-09-19 17:30:43',NULL,NULL),
(201909190003,'VDViUVsQLuIe2',3,'2019-09-18',1,NULL,'2019-09-19 17:35:51',NULL,NULL),
(201909200001,'AVy6FTxa3h8dh',2,'2019-09-20','0',NULL,'2019-09-20 13:11:42',NULL,NULL),
(201909230001,'OvyMcd08C9WHX',2,'2019-09-23','0','Naubusan po ng tinta yung printer','2019-09-23 10:48:13',NULL,NULL);



SET FOREIGN_KEY_CHECKS=1;
COMMIT;
--3AH4P7O6AwH5UwxpSgVfTc+8IwY2THiQCU2WE5bz1no=