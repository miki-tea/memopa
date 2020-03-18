<?php
namespace MyApp\Controller;

// $token = filter_input(INPUT_POST,'token');
class PassRemindSend extends \MyApp\Controller {
  
  public function run() {
    // if($this->isLoggedIn()){ // valid session
    //   header('Location:' .SITE_URL . '/memopa/mypage.php');
    //   exit;
    // }

    //POST送信があった場合→バリデーション→DBでemail照会→あったらEmail送信→入力ページへ遷移
    //POST送信がなかったた場合→何もしない
    //
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $email = filter_input(INPUT_POST, 'email');
      // token
      if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        echo "invalid Token!";
        exit;
      }
      // バリデーション
      debug('$email:'.$email);

      $this->InvalidRequired($email,'email');

      if(empty($this->hasErr())){
        $this->InvalidMinLen($email,'email');
      }

      if(empty($this->hasErr())){
        $this->InvalidMaxLen($email,'email');
      }

      if(empty($this->hasErr())){
        $this->InvalidEmail($email,'email');
      }

      if($this->hasErr()){
        debug('バリデーションエラーです');
        return;
      }else{

      debug('ユーザーテーブルに接続します。');
      try{ 
        //create user
        $userModel = new \MyApp\Model\User();
        $userModel->emailAlive([
          'email' => $email
        ]);
        debug('DBに登録がありました。ランダム認証キーを生成します。');
        $sessKey = $this->randomKey();

        debug('入力されたEメールに送ります。');

        $from = 'miki.ishii16@gmail.com';
        $to = $email;
        $subject = '【memopa!】認証キーをお送りします。';
        $comment = <<<EOT
いつもmemopa!をご利用くださりありがとうございます。
パスワード再設定用の認証キーをお送りします。
認証キーの有効期限は30分となりますので、お早めに以下のURLから認証キーでログイン後、パスワードの再設定を行ってください。

URL：http://localhost:8888/memopa/passRemindReceive.php
認証キー：{$sessKey}

認証キーを再発行されたい場合は下記ページより再度再発行をお願い致します。
http://localhost:8888/memopa/passRemindSend.php

☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯
memopa!
URL  http://memopa.com/
E-mail memopa_memopa@gmail.com
☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯
EOT;
          $this->sendMail($from, $to, $subject, $comment);

          debug('セッションにEメール、パスワード、有効期限を渡します。');

          $_SESSION['email'] = $email;
          $_SESSION['ses_key'] = $sessKey;
          $_SESSION['ses_limit'] = time() + 60 * 30;
          debug('$_SESSIONの中身：' . print_r($_SESSION,true));
          debug('passRemindReceive.phpに遷移します。');
          header('location: ' . SITE_URL . '/memopa/passRemindReceive.php');

        }catch(\Exception $e) {

          debug('DB接続でエラーが発生しました。');
          $this->setErr('email',$e->getMessage());
          return;

        }
      }
    }
  }
}