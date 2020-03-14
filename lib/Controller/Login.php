<?php
namespace MyApp\Controller;

// $token = filter_input(INPUT_POST,'token');
class Login extends \MyApp\Controller {
  
  public function run() {
    $email = filter_input(INPUT_POST,'email');
    $pass = filter_input(INPUT_POST,'pass');
    $pass_skip = filter_input(INPUT_POST,'pass_skip');

    debug(filter_input(INPUT_POST,'email'));
    debug('$emailのなかみ：'.$email);
    debug('$passの中身：'.$pass);
    debug('$pass_skipのなかみ：'.$pass_skip);

    if($this->isLoggedIn()){ // valid session
      debug('セッションログあります');
      header('Location:' .SITE_URL . '/memopa/mypage.php');
      exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      debug('POS送信あり');

        // token
      if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        echo "invalid Token!";
        exit;
      }
      //start validation
      debug('バリデーションはじめます。');
      $this->_validate();
      $this->setVal('email',$email);

      if($this->hasErr()){
        debug('バリデーションエラーです');
        return;
      } else { //Success to validate
        debug('バリデーション成功。ユーザーテーブルに接続します。');
          try{ 
            // login
            $userModel = new \MyApp\Model\User();
            $user = $userModel->login([
              'email' => $email,
              'password' => $pass
            ]);
            $_SESSION['me'] = $user;

          }catch(\MyApp\Exception\UnmatchDbInfo $e) {
            debug('DB接続でエラーが発生しました。');
            $this->setErr('login',$e->getMessage());
            return;
          }

        // Login
            session_regenerate_id(true);
            $sesLimit = 60*60;
            $_SESSION['login_date'] = time();
            if($pass_skip){
              debug('次回ログインスキップを希望。');
              $_SESSION['login_limit'] = $sesLimit * 24 * 30;
            }else{
              $_SESSION['login_limit'] = $sesLimit;
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

    // All: Required
    $this->InvalidRequired($email,'email');
    $this->InvalidRequired($pass,'pass');


    //Email:type
    if(empty($this->getErr('email'))){
      $this->InvalidEmail($email,'email');
    }
    // Email:Max Length
    if(empty($this->getErr('email'))){
      $this->InvalidMaxLen($email,'email');
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
  }
}