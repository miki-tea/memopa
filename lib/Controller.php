<?php

namespace memopa;

class Controller {

  private $_errors;

  public function __construct() {
    $this->_errors = new \stdClass();
  }

  protected function setErr($key, $error){
    $this->_errors->$key = $error;
  }
  
  public function getErr($key){
    return isset($this->_errors->$key) ? $this->_errors->$key : '';
  }
 
  protected function hasErr(){
   return !empty(get_object_vars($this->_errors));
  }
  
  protected function isLoggedIn(){
    //$_SESSION['user_id'];
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
  }

  protected function validRequired($str, $key){
    if($str === ''){
      $this->setErr($key, '入力必須です。');
    }
  }
}