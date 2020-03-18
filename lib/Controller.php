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
      $this->setErr($key, '必須:半角英数字６文字以上');
    }
  }
  protected function InvalidMaxLen($str, $key, $max=255){
    if(mb_strlen($str) >= $max){
      $this->setErr($key, '文字数制限超過:' . $max . '文字');
    }
  }

  protected function InvalidMinLen($str, $key, $min=6){
    if(mb_strlen($str) < $min){
      $this->setErr($key, '必須:6文字以上');
    }
  }
  // End of validation functions

  protected function isLoggedIn(){
  return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }

  public function me() {
  return $this->isLoggedIn()? $_SESSION['me'] : null;
  }

  public function sendMail($from, $to, $subject, $comment){
    if(!empty($to) && !empty($subject) && !empty($comment)){
        mb_language("Japanese"); 
        mb_internal_encoding("UTF-8"); 
        $result = mb_send_mail($to, $subject, $comment, "From: ".$from);
        if ($result) {
          // debug('メール送信完了。');
        } else {
          // debug('メール送信失敗。');
        }
    }
  }
  public function randomKey() {
    return substr(bin2hex(random_bytes(8)), 0, 8);
  }

  public function diffVal($str1, $str2, $key) {
    if($str1 !== $str2){
      $this->setErr($key,'パスワード(再)と一致しません。');
    }
  }
  
}
