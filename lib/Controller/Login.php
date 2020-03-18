<?php
namespace MyApp\Controller;


class Login extends \MyApp\Controller {

  public function login() {
    $email = filter_input(INPUT_POST,'email');
    $pass = filter_input(INPUT_POST,'pass');
    $pass_skip = filter_input(INPUT_POST,'pass_skip');
    // token
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo "Token is invalid.Please input informataion from correct page.";
      exit;
    }
    debug('バリデーション開始');
    $this->validateEmail($email);
    $this->validatePass($pass);
    //バリデーションエラーでリダイレクトされた時に入力したEメールが表示できるようにする
    $this->setVal('email',$email);

    if($this->hasErr()){
      debug('バリデーションエラー');
      return;
    } else { 
      // debug('バリデーション成功。ユーザーテーブルに接続します。');
      try{ 
        // login
        $userModel = new \MyApp\Model\User();
        $user = $userModel->login([
          'email' => $email,
          'password' => $pass
        ]);
        $_SESSION['me'] = $user;
        // ログイン付加情報を与える
        session_regenerate_id(true);
        $sesLimit = 60*60;
        $_SESSION['login_date'] = time();
        if($pass_skip){
          // debug('次回ログインスキップを希望。');
          $_SESSION['login_limit'] = $sesLimit * 24 * 30;
        }else{
          $_SESSION['login_limit'] = $sesLimit;
        }
        // mypageへ遷移。
        header('location:mypage.php');

      }catch(\MyApp\Exception\UnmatchDbInfo $e) {
        debug('DB接続でエラーが発生しました。');
        $this->setErr('login',$e->getMessage());
        return;
      }

    }
  }
  
}