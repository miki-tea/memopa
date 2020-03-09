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

  protected function InvalidRequired($str, $key){
    if($str === ''){
      $this->setErr($key, '入力必須です。');
    }
  }

  protected function InvalidEmail($str, $key){
    if(!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",$str)){
      $this->setErr($key, 'メール形式が正しくありません。');
    }
  }
  protected function InvalidMaxLen($str, $key, $max=256){
    if(mb_strlen($str) > $max){
      $this->setErr($key, '255文字以内で。');
    }
  }

  protected function InvalidMinLen($str, $key, $min=6){
    if(mb_strlen($str) < $min){
      $this->setErr($key, '6文字以上で。');
    }
  }
}
