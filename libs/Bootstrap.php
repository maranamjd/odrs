<?php
/**
 *
 */
class Bootstrap
{

  function __construct()
  {
    Session::init();
    $url = isset($_GET['url']) ? $_GET['url'] : START_PAGE;
    $url = rtrim($url, '/');
    $url = explode('/', $url);
    // print_r($url);


//class
    $file = 'controllers/'. $url[0] .'.php';
    if(file_exists($file)){
      require $file;
    }else {
      $this->error();
      return false;
    }
    $controller = new $url[0];
    $controller->loadModel($url[0]);


//methods
    if (isset($url[2])){
      if (method_exists($controller, $url[1])) {
        $controller->{$url[1]}($url[2]);
      }else {
        $this->error();
        return false;
      }
    }else {
      $url[1] = isset($url[1]) ? $url[1] : 'index';
      if (method_exists($controller, $url[1])) {
        $controller->{$url[1]}();
      }else {
        $this->error();
        return false;
      }
    }
  }

  function error(){
    require 'controllers/page404.php';
    $controller = new Excptn();
    $controller->index();
  }
}
