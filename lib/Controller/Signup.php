<?php
namespace MyApp\Controller;

// $token = filter_input(INPUT_POST,'token');
class Signup extends \MyApp\Controller {
  
  public function run() {
    $email = filter_input(INPUT_POST,'email');
    $pass = filter_input(INPUT_POST,'pass');
    $pass_re = filter_input(INPUT_POST,'pass_re');

        debug(filter_input(INPUT_POST,'email'));
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
        debug('ユーザーテーブルに接続します。');
          try{ 
            //create user
            $userModel = new \MyApp\Model\User();
            $userModel->create([
              'email' => $email,
              'pass' => $pass
            ]);
          }catch(\MyApp\Exception\DuplicateEmail $e) {
            debug('DB接続でエラーが発生しました。');
            $this->setErr('common',$e->getMessage());
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
    // if(empty($this->getErr('email'))){
    //   $this->emailDup($email,'email');
    // }
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
      $this->InvalidPass($pass, 'pass');
    }
    // Pass = Pass_re
    if(empty($this->getErr('pass'))){
        $this->diffVal($pass,$pass_re,'pass');
      }
  }

  protected function diffVal($str1, $str2, $key) {
    if($str1 !== $str2){
      $this->setErr($key,'パスワード(再)と一致しません。');
    }
  }
//   protected function emailDup($email,$key) {
//     try{ //create user
//       global $email;
//       global $pass;
//         $userModel = new \MyApp\Model\User();
//         $userModel->create([
//           'email' => $email,
//           'pass' => $pass
//         ]);
//       } catch (\MyApp\Exception\CommonErr $e) {
//         $this->setErr('common',$e->getMessage());
//         return;
//       }
//   }
}

  // protected function postProcess(){
  //   //validation
  //   try {
  //     $this->_validate();
  //   } catch (\MyApp\Exception\InvalidEmail $e){
  //     $this->setErr('email',$e->getMessage());
      
  //   } catch (\MyApp\Exception\InvalidPassword $e){
  //     $this->setErr('pass',$e->getMessage());

  //   } catch (\MyApp\Exception\UnmatchPass $e){
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
  //     throw new \MyApp\Exception\InvalidEmail('入力必須です。');
  //   }
  //   if(empty($pass)){
  //     throw new \MyApp\Exception\InvalidPassword('入力必須です。');
  //   }
  //   if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
  //     throw new \MyApp\Exception\InvalidEmail('Eメールが無効な形式です');
  //   }
  //   if(!preg_match('/\A[a-zA-Z0-9]+\z/', $pass)){
  //     throw new \MyApp\Exception\InvalidPassword();
  //   }
  //   if($pass !== $_POST['pass_re']){
  //     throw new \MyApp\Exception\UnmatchPass();
  //   }
  // }