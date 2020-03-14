<?php
namespace MyApp\Controller;

// $token = filter_input(INPUT_POST,'token');
class Signup extends \MyApp\Controller {
  
  public function run() {
    $email = filter_input(INPUT_POST,'email');
    $pass = filter_input(INPUT_POST,'pass');
    $pass_re = filter_input(INPUT_POST,'pass_re');

    debug('$emailのなかみ：'.$email);
    debug('$passのなかみ：'.$pass);
    debug('$pass_reのなかみ：'.$pass_re);
    // if($this->isLoggedIn()){ // valid session
    //   header('Location:' .SITE_URL . '/memopa/mypage.php');
    //   exit;
    // }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // token
      if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        echo "invalid Token!";
        exit;
      }
      //start validation
      $this->_validate();
      $this->setVal('email',$email);

      if($this->hasErr()){
        debug('バリデーションエラー');
        return;
      } else { //Success to validate
        debug('登録のため、ユーザーテーブルに接続します。');
          try{ 
            //create user
            $userModel = new \MyApp\Model\User();
            $user = $userModel->create([
              'email' => $email,
              'pass' => $pass
            ]);
            $_SESSION['me'] = $user;
          }catch(\MyApp\Exception\DuplicateEmail $e) {
            debug('DB接続でエラーが発生しました。');
            $this->setErr('common',$e->getMessage());
            return;
          }
        debug('session["me"]取得のため、ユーザーテーブルに接続します。');
          try{ 
            // login
            $userModel = new \MyApp\Model\User();
            $user = $userModel->login([
              'email' => $email,
              'password' => $pass
            ]);
            $_SESSION['me'] = $user;
            debug('$userの中身:' . var_dump($_SESSION['me']->pass));
          }catch(\MyApp\Exception\UnmatchDbInfo $e) {
            debug('DB接続でエラーが発生しました。');
            $this->setErr('login',$e->getMessage());
            return;
          }
        // redirect to mypage
        header('location: ' . SITE_URL . '/memopa/mypage.php');
        exit;
      }
    }
  }
  
  protected function _validate(){
    $email = filter_input(INPUT_POST,'email');
    $pass = filter_input(INPUT_POST,'pass');
    $pass_re = filter_input(INPUT_POST,'pass_re');

    // All: Required
    $this->InvalidRequired($email,'email');
    $this->InvalidRequired($pass,'pass');
    $this->InvalidRequired($pass_re,'pass_re');

    //Email:type
    if(empty($this->getErr('email'))){
      $this->InvalidEmail($email,'email');
    }
    // Email:Max Length
    if(empty($this->getErr('email'))){
      $this->InvalidMaxLen($email,'email');
    }
    // Email:Duplicate
    if(empty($this->getErr('email'))){
      debug('Eメール重複確認のため接続します。');
      try{ 
        $userModel = new \MyApp\Model\User();
        $user = $userModel->emailDup([
          'email' => $email
        ]);
      }catch(\MyApp\Exception\DuplicateEmail $e) {
        debug('データベース内で重複するEメールを見つけました。');
        $this->setErr('email',$e->getMessage());
        return;
      }
    }
    // Pass:Max Length
    if(empty($this->getErr('pass'))){
      $this->InvalidMaxLen($pass,'pass');
    }
    //Pass: Min Length
    if(empty($this->getErr('pass'))){
      $this->InvalidMinLen($pass,'pass');
    }
    // Pass: Half size str
    if(empty($this->getErr('pass'))){
      $this->InvalidHalf($pass, 'pass');
    }
    // Pass = Pass_re
    if(empty($this->getErr('pass'))){
        $this->diffVal($pass,$pass_re,'pass');
    }
  }
}
