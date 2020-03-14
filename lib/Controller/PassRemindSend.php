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
      debug('ユーザーテーブルに接続します。');
      try{ 
        //create user
        $userModel = new \MyApp\Model\User();
        $userModel->emailAlive([
          'email' => $email
        ]);
        debug('DBに登録がありました。ランダムパスワードを生成します。');
        $tempKey = $this->_randomKey();

        debug('入力されたEメールに送ります。');

        $from = 'miki.ishii16@gmail.com';
        $to = $email;
        $title = '【memopa!】認証キーをお送りします。';
        $content = <<<EOT
いつもmemopa!をご利用くださりありがとうございます。
パスワード再設定用の認証キーをお送りします。
認証キーの有効期限は30分となりますので、お早めに以下のURLから認証キーでログイン後、パスワードの再設定を行ってください。

URL：http://localhost:8888/memopa/passRemindRecieve.php
認証キー：{$tempKey}

認証キーを再発行されたい場合は下記ページより再度再発行をお願い致します。
http://localhost:8888/memopa/passRemindSend.php

☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯
memopa!
URL  http://memopa.com/
E-mail memopa_memopa@gmail.com
☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯
EOT;
        $this->_sendEMail($from, $to, $title, $content);

        debug('セッションにEメール、パスワード、有効期限を渡します。');

        $_SESSION['email'] = $email;
        $_SESSION['pass'] = $tempKey;
        $_SESSION['ses_limit'] = time() + 60 * 30;
        debug('$_SESSIONの中身：' . print_r($_SESSION,true));

        debug('passRemindReceive.phpに遷移します。');
        header('location: ' . SITE_URL . '/memopa/passRemindReceive.php');

      }catch(\Exception $e) {
        debug('DB接続でエラーが発生しました。');
        $this->setErr('common',$e->getMessage());
        return;
      }
    }
  }

  private function _randomKey() {
    return substr(bin2hex(random_bytes(8)), 0, 8);
  }

  private function _sendEmail($from, $to, $title, $content){
    if(!empty($to) && !empty($subject) && !empty($subject) && !empty($content)){
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $result = mb_send_mail($to, $subject, $comment, "From: " . $from);

        if($result){
          debug('メール送信完了');
        }else{
          debug('メール送信失敗');
        }
    }
  }

}

function sendMail($from, $to, $title, $content){
    if(!empty($from) &&!empty($to) && !empty($title) && !empty($content)){
        //文字化けしないように設定（お決まりパターン）
        mb_language("Japanese"); //現在使っている言語を設定する
        mb_internal_encoding("UTF-8"); //内部の日本語をどうエンコーディング（機械が分かる言葉へ変換）するかを設定
        //メールを送信（送信結果はtrueかfalseで返ってくる）
        $result = mb_send_mail($to, $subject, $content, "From: ".$from);
        //送信結果を判定
        if ($result) {
          debug('メールを送信しました。');
        } else {
          debug('【エラー発生】メールの送信に失敗しました。');
        }
    }
}