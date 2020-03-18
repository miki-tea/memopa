<?php
namespace MyApp\Controller;

// $token = filter_input(INPUT_POST,'token');
class PassRemindReceive extends \MyApp\Controller {
  
  public function run() {
    // if($this->isLoggedIn()){ // valid session
    //   header('Location:' .SITE_URL . '/memopa/mypage.php');
    //   exit;
    // }

    //POST送信があった場合→バリデーション→DBでemail照会→あったらEmail送信→入力ページへ遷移
    //POST送信がなかったた場合→何もしない
    //
    // セッション確認
    debug('PassRemindReceive->run()を開始');

    if(empty($_SESSION['ses_key'])){
      header("Location:passRemindSend.php");
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $auth_key = $_POST['auth'];
      $email = $_SESSION['email'];
      // token
      // if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      //   echo "invalid Token!";
      //   exit;
      // }
      // バリデーション
      debug('$auth_key:'.$auth_key);

      // 未入力
      $this->InvalidRequired($auth_key,'auth_key'); 
      // 固定長
      $this->_InvalidLength($auth_key);
      // 半角
      $this->InvalidHalf($auth_key,'auth_key');

      // バリデーションエラー
      if($this->hasErr()){
        debug('バリデーションエラーです');
        return;
      }else{
        // セッション認証
        if( $_SESSION['ses_limit'] < time() ){
          $this->setErr('認証キーの有効期限切れです。','auth');
          return;
        }
        if( $_SESSION['ses_key'] !== $auth_key ){
          $this->setErr('認証キーが違います。', 'auth');
          return;
        }
        if(empty($this->hasErr())){
          debug('認証OK');
        }
        // バリデーションOK
        debug('ユーザーテーブルに接続します。');
        $pass = $this->randomKey();
        try{ 
          $userModel = new \MyApp\Model\User();
          $userModel->generatePass([
            'pass' => $pass,
            'email' => $email
          ]);
          debug('DBに登録がありました。ランダムパスワードを生成します。');

          debug('入力されたEメールに送ります。');

          $from = 'miki.ishii16@gmail.com';
          $to = $email;
          $subject = '【memopa!】仮パスワードを再発行しました。';
          $comment = <<<EOM
いつもmemopa!をご利用くださりありがとうございます。
認証キーの確認ができたので、再発行用の仮パスワードをお送りします。
これは仮パスワードなのでログイン後、パスワードの再設定を行ってください。

ログインURL：https://memopa.herokuapp.com/login.php
仮パスワード：{$pass}

☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯
memopa!
URL  https://memopa.herokuapp.com
E-mail miki.ishii16@gmail.com
☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯
EOM;
          $this->sendMail($from, $to, $subject, $comment);

          
          session_unset();
          header('location:login.php');

        }catch(\Exception $e) {

          debug('エラーが発生しました。');
          $this->setErr('email',$e->getMessage());
          return;

        }
      }
    }
    debug('PassRemindReceive->run()を終了');
  }

  private function _InvalidLength($str) {
    if( mb_strlen($str) !== 8 ){
      $this->setErr('auth','文字数が違います。');
    }
  }
}