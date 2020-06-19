<?php

/**
 *
 */
class Logout_Model extends Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function logout(){
    Session::destroy();
    header('Location: '.URL.'login');
  }

}
