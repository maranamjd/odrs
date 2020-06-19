<?php switch ($this->uType) {
    case 0: ?>
    <!-- student -->
<?php break;
    case 1: ?>
      <!-- company -->
<?php break;
    case 2: ?>
      <!-- registrar -->
      <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item <?php echo ($this->nav == 'dashboard') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo URL ?>registrar/dashboard">Dashboard</a>
              </li>
              <li class="nav-item <?php echo ($this->nav == 'requests') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo URL ?>registrar/requests">
                  Document Requests
                  <!-- <span class="badge badge-danger badge-pill">5</span>
                  <span class="badge badge-warning badge-pill">3</span> -->
                </a>
              </li>
              <li class="nav-item <?php echo ($this->nav == 'verification') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo URL ?>registrar/verification">
                  Graduate Verification
                  <!-- <span class="badge badge-danger badge-pill">5</span>
                  <span class="badge badge-warning badge-pill">2</span> -->
                </a>
              </li>
              <li class="nav-item <?php echo ($this->nav == 'students') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo URL ?>registrar/students">
                  Students

                </a>
              </li>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
            </form> -->
          </div>
        </div>
      </nav>
<?php break;
    case 3: ?>
    <!-- branches -->
    <nav class="navbar navbar-expand-md navbar-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo ($this->nav == 'home') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?php echo URL ?>registrar/home">Home</a>
            </li>
            <li class="nav-item <?php echo ($this->nav == 'requests') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?php echo URL ?>registrar/requests">
                Requests
                <!-- <span class="badge badge-danger badge-pill">5</span>
                <span class="badge badge-warning badge-pill">3</span> -->
              </a>
            </li>
          </ul>
          <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
          </form> -->
        </div>
      </div>
    </nav>
<?php break;
    case 4: ?>
    <!-- offices -->
<nav class="navbar navbar-expand-md navbar-light">
 <div class="container-fluid">
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">

       <li class="nav-item <?php echo ($this->nav == 'home') ? 'active' : ''; ?>">
         <a class="nav-link" href="<?php echo URL; ?>office/">Home</a>
       </li>
       <li class="nav-item <?php echo ($this->nav == 'add') ? 'active' : ''; ?>">
         <a class="nav-link" href="<?php echo URL; ?>office/addRecord">Add Record</a>
       </li>
       <!-- <li class="nav-item <?php echo ($this->nav == 'dashboard') ? 'active' : ''; ?>">
         <a class="nav-link" href="<?php echo URL; ?>office/dashboard">Dashboard</a>
       </li>
       <li class="nav-item <?php echo ($this->nav == 'library') ? 'active' : ''; ?>">
         <a class="nav-link" href="<?php echo URL; ?>office/library">Library</a>
       </li> -->
       <!-- <li class="nav-item <?php echo ($this->nav == 'laboratory') ? 'active' : ''; ?>">
         <a class="nav-link" href="<?php echo URL; ?>office/laboratory">
           College Laboratory
           <span class="badge badge-success badge-pill">5</span>
           <span class="badge badge-warning badge-pill">3</span>
         </a>
       </li>
       <li class="nav-item <?php echo ($this->nav == 'pe') ? 'active' : ''; ?>">
         <a class="nav-link" href="<?php echo URL; ?>office/pe">
           C.H.K (P.E.)
           <span class="badge badge-warning badge-pill">5</span>
         </a>
       </li>
       <li class="nav-item <?php echo ($this->nav == 'accounting') ? 'active' : ''; ?>">
         <a class="nav-link" href="<?php echo URL; ?>office/accounting">
           Accounting
           <span class="badge badge-warning badge-pill">1</span>
           <span class="badge badge-success badge-pill">3</span>
         </a>
       </li>
       <li class="nav-item <?php echo ($this->nav == 'audit') ? 'active' : ''; ?>">
         <a class="nav-link" href="<?php echo URL; ?>office/audit">
           Internal Audit
           <span class="badge badge-success badge-pill">1</span>
         </a>
       </li>
       <li class="nav-item <?php echo ($this->nav == 'legal') ? 'active' : ''; ?>">
         <a class="nav-link" href="<?php echo URL; ?>office/legal">
           Legal
           <span class="badge badge-warning badge-pill">1</span>
         </a>
       </li> -->
     </ul>
     <!-- <form class="form-inline my-2 my-lg-0">
       <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
       <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
     </form> -->
   </div>
 </div>
</nav>
<?php break;
    case 5: ?>
      <!-- Administrator -->
      <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item <?php echo ($this->nav == 'dashboard') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo URL; ?>admin/dashboard">Dashboard</a>
              </li>
              <li class="nav-item <?php echo ($this->nav == 'reports') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo URL; ?>admin/reports">Reports</a>
              </li>
              <li class="nav-item <?php echo ($this->nav == 'tracer') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?php echo URL; ?>admin/tracer">Graduate Tracer</a>
              </li>
              <li class="nav-item">
                <ul class="navbar-nav flex-row">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Institution</a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo URL; ?>admin/employee_info">Employee Information</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo URL; ?>admin/branch_info">Branch Information</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo URL; ?>admin/offices">Offices</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo URL; ?>admin/courses">Courses</a>
                  </div>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <ul class="navbar-nav flex-row">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Document Request</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/payments">Payments</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo URL; ?>admin/documents">Documents</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo URL; ?>admin/document_types">Document Types</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo URL; ?>admin/subjects">Subjects</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo URL; ?>admin/survey_questions">Survey Questions</a>
                  </div>
                  </li>
                </ul>
              </li>
              <!-- <li class="nav-item">
                <ul class="navbar-nav flex-row">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Graduate Verification</a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo URL; ?>admin/companies">Companies</a>
                  </div>
                  </li>
                </ul>
              </li> -->
              <li class="nav-item">
                <ul class="navbar-nav flex-row">
                  <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Trash Bin</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/employeeTrash">Employees</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/branchTrash">Branches</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/officeTrash">Offices</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/courseTrash">Courses</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/documentTrash">Documents</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/documentTypeTrash">Document Types</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/subjectTrash">Subjects</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/surveyTrash">Survey Questions</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo URL; ?>admin/choiceTrash">Survey Choices</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <ul class="navbar-nav flex-row">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Configurations</a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="<?php echo URL; ?>admin/config">System Configurations</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?php echo URL; ?>admin/backup">Data Backup and Restore</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
            </form> -->
          </div>
        </div>
      </nav>
<?php break;
  }
?>
