<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-16">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="PUP Online document requesting">
    <meta name="tags" content="PUP, Online, Documents, Requests, Document Request, ODRS">
    <link rel="icon" type="image/x-icon" href="<?php echo URL; ?>public/img/logo.png"/>
    <title><?php echo isset($this->title) ? $this->title : 'ODRS'; ?></title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/app.css"/>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/font-awesome.css"/>
    <link rel="gettext" type="application/x-po" href="<?php echo URL; ?>public/languages/en/LC_MESSAGES/en.po"/>
    <?php
      if (isset($this->css)) {
        foreach ($this->css as $css) {
          echo "<link href='".URL."views/".$css."' rel='stylesheet' />";
        }
      }
    ?>
  </head>
  <body>
    <div class="content">
      <header>
        <nav class="navbar navbar-expand-lg navbar-light py-0 border-bottom">
          <div class="container-fluid px-0 px-md-2" role="navigation">
              <?php
                if (isset($this->uType)) {
                  switch ($this->uType) {
                    case 0:
                      $navTitle = 'Online Document Request';
                      break;
                    case 1:
                      $navTitle = 'Graduate Verification';
                      break;
                    case 2:
                      $navTitle = 'Registrar';
                      break;
                    case 3:
                      $navTitle = 'Branch Administrator';
                      break;
                    case 4:
                      $navTitle = 'Clearance Monitoring';
                      break;
                    case 5:
                      $navTitle = 'Administrator';
                      break;
                    case 6:
                      $navTitle = 'Employee Login';
                      break;
                  }
                  if ($this->uType > 1) { ?>
                    <a class="navbar-brand" href="<?php echo URL ?>">
                      <img src="<?php echo URL; ?>public/img/logo.png" alt="PUP Logo" height="55" class="mr-sm-2">
                      <span class="d-inline-flex d-sm-none ml-2"><?php echo $navTitle; ?></span>
                      <span class="d-sm-inline-flex d-none text-uppercase"><?php echo $navTitle; ?></span>
                    </a>
                    <?php if (isset($this->account) == true) { ?>
                      <ul class="navbar-nav flex-row">
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo isset($this->name) ? $this->name : '' ?></a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Account</a>
                            <div class="dropdown-divider"></div>
                            <a href="<?php echo URL ?>logout" class="dropdown-item">Logout</a>
                          </div>
                        </li>
                      </ul>
                    <?php } ?>
                  <?php }else{ ?>
                    <a class="navbar-brand" href="<?php echo URL ?>">
                      <img src="<?php echo URL; ?>public/img/logo.png" alt="PUP Logo" height="55" class="mr-sm-2">
                      <span class="d-inline-flex d-sm-none ml-2"><?php echo $navTitle; ?></span>
                      <span class="d-sm-inline-flex d-none text-uppercase"><?php echo $navTitle; ?></span>
                    </a>
                    <?php if (isset($this->nav)): ?>
                      <?php if ($this->nav == 'student'): ?>
                        <ul class="navbar-nav flex-row">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo isset($this->pageInfo) ? $this->pageInfo['student']['studentNumber'] : ''; ?></a>
                            <div class="dropdown-menu">
                              <a href="#" class="dropdown-item" data-toggle='modal' data-target='#contactModal'>Contact Info</a>
                              <div class="dropdown-divider"></div>
                              <a href="<?php echo URL ?>student/logout" class="dropdown-item">Logout</a>
                            </div>
                          </li>
                        </ul>
                      <?php endif; ?>
                      <?php if ($this->nav == 'repLogged'): ?>
                        <ul class="navbar-nav flex-row">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo Functions::name_format($this->companyDetails['representative']['firstName'],$this->companyDetails['representative']['lastName'],$this->companyDetails['representative']['middleName'],true,$this->companyDetails['representative']['suffix']); ?></a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?php echo URL ?>company/info/<?php echo Session::get('repLogged') ?>">View Info</a>
                              <div class="dropdown-divider"></div>
                              <a href="<?php echo URL ?>verification/logout" class="dropdown-item">Logout</a>
                            </div>
                          </li>
                        </ul>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php } ?>
                <?php } ?>
          </div>
        </nav>
      </header>
