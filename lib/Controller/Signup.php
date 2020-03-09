<?php
namespace memopa\Controller;

class Signup extends \memopa\Controller {

  public function run() {
    if($this->isLoggedIn()){ // valid session
      header('Location:' .SITE_URL . '/mypage.php');
      exit;
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      //accept $_POST

      // All: Required
      $this->InvalidRequired($_POST['email'],'email');
      $this->InvalidRequired($_POST['pass'],'pass');
      $this->InvalidRequired($_POST['pass_re'],'pass_re');

      // Email:type
      if(empty($this->getErr('email'))){
        $this->InvalidEmail($_POST['email'],'email');
      }
      // Email:Max Length
      if(empty($this->getErr('email'))){
        $this->InvalidMaxLen($_POST['email'],'email');
      }
      // Pass:Max/Min Length
      if(empty($this->getErr('pass'))){
        $this->InvalidMaxLen($_POST['pass'],'pass');
      }
      if(empty($this->getErr('pass'))){
        $this->InvalidMinLen($_POST['pass'],'pass');
      }
      // Pass: Half size str

      // Pass = Pass_re
      if(empty($this->getErr('pass'))){
        $this->diffVal($_POST['pass'],$_POST['pass_re'],'pass');
      }
    }
  }
  private function diffVal($str1, $str2, $key) {
    if($str1 !== $str2){
      $this->setErr($key,'パスワード(再)と一致しません。');
    }
  }

  // protected function postProcess(){
  //   //validation
  //   try {
  //     $this->_validate();
  //   } catch (\memopa\Exception\InvalidEmail $e){
  //     $this->setErr('email',$e->getMessage());
      
  //   } catch (\memopa\Exception\InvalidPassword $e){
  //     $this->setErr('pass',$e->getMessage());

  //   } catch (\memopa\Exception\UnmatchPass $e){
  //     $this->setErr('pass_re',$e->getMessage());
  //   }


  //   if($this->hasErr()){ // Fail to validate
  //     return;
  //   }else{ //Success to validate

  //     //create user
  //     //redirect to mypage

  //   }
  // }

  // private function _validate() {
  //   if(empty($_POST['email'])){
  //     throw new \memopa\Exception\InvalidEmail('入力必須です。');
  //   }
  //   if(empty($_POST['pass'])){
  //     throw new \memopa\Exception\InvalidPassword('入力必須です。');
  //   }
  //   if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
  //     throw new \memopa\Exception\InvalidEmail('Eメールが無効な形式です');
  //   }
  //   if(!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['pass'])){
  //     throw new \memopa\Exception\InvalidPassword();
  //   }
  //   if($_POST['pass'] !== $_POST['pass_re']){
  //     throw new \memopa\Exception\UnmatchPass();
  //   }
  // }

}