<?php

namespace MyApp;

class Controller {

  private $_errors;
  private $_values;


  public function __construct() {
    $this->_errors = new \stdClass();
    $this->_values = new \stdClass();
    if(!isset($_SESSION['token'])){
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
  }
  // Set/Get error
  protected function setErr($key, $error){
    $this->_errors->$key = $error;
  }
  public function getErr($key){
    return isset($this->_errors->$key) ? $this->_errors->$key : '';
  }
  // Set/Get Value
  protected function setVal($key, $val){
    $this->_values->$key = $val;
  }
  public function getVal(){
    return $this->_values;
  }
 
  protected function hasErr(){
   return !empty(get_object_vars($this->_errors));
  }
  
  protected function isLoggedIn(){
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }

  // validation
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

  protected function InvalidHalf($str, $key){
    if(!preg_match("/^[0-9a-zA-Z]*$/",$str)){
      $this->setErr($key, '半角英数字６文字以上で。');
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
