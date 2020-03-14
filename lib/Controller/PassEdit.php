<?php
namespace MyApp\Controller;

// $token = filter_input(INPUT_POST,'token');
class PassEdit extends \MyApp\Controller {
  
  public function run() {
    // if($this->isLoggedIn()){ // valid session
    //   header('Location:' .SITE_URL . '/memopa/mypage.php');
    //   exit;
    // }

    //POST送信があった場合→バリデーション→DBでemail照会→あったらEmail送信→入力ページへ遷移
    //POST送信がなかったた場合→何もしない
    //
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // token
      if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        echo "invalid Token!";
        exit;
      }
      $pass_old = $_POST['pass_old'];
      $pass_new = $_POST['pass_new'];
      $pass_new_re = $_POST['pass_new_re'];
      $user_id = $this->me()->user_id;
      $email = $this->me()->email;

      //TODO:validation
      if($this->hasErr()){
        debug('バリデーションエラーです');
        return;
      }else{

        debug('バリデーションOK。ユーザーテーブルに接続します。');
        try{ 
          //create user
          $userModel = new \MyApp\Model\User();
          $userModel->passEdit([
            'pass' => $pass_new,
            'user_id' => $user_id
          ]);

          
          //メールを送信
          $from = 'miki.ishii16@gmail.com';
          $to = $email;
          $subject = 'パスワード変更通知｜memopa';
          $comment = <<<EOT
パスワードが変更されました。
                      
////////////////////////////////////////
memopa
URL  
E-mail
////////////////////////////////////////
EOT;
          $this->sendMail($from, $to, $subject, $comment);
          
          header("Location:mypage.php"); //マイページへ
        
        }catch(\Exception $e) {
          debug('DB接続でエラーが発生しました。');
          $this->setErr('common',$e->getMessage());
          return;
        }
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