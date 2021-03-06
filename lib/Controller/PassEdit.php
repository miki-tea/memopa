<?php
namespace MyApp\Controller;

class PassEdit extends \MyApp\Controller {
  
  public function run() {
    if(!$this->isLoggedIn()){ 
      header('Location:' . SITE_URL . '/memopa/index.php');
      exit;
    }
  
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

      debug('$pass_old:'.$pass_old);
      debug('$pass_new:'.$pass_new);
      debug('$pass_new_re:'.$pass_new_re);

      $this->InvalidRequired($pass_old,'pass_old');
      $this->InvalidRequired($pass_new,'pass_new');
      $this->InvalidRequired($pass_new_re,'pass_new_re');

      if(empty($this->hasErr())){
        $this->InvalidMinLen($pass_old,'pass_old');
        $this->InvalidMinLen($pass_new,'pass_new');
        $this->InvalidMinLen($pass_new_re,'pass_new_re');
      }

      if(empty($this->hasErr())){
        $this->InvalidMaxLen($pass_old,'pass_old');
        $this->InvalidMaxLen($pass_new,'pass_new');
        $this->InvalidMaxLen($pass_new_re,'pass_new_re');
      }

      if(empty($this->hasErr())){
        $this->InvalidHalf($pass_old,'pass_old');
        $this->InvalidHalf($pass_new,'pass_new');
        $this->InvalidHalf($pass_new_re,'pass_new_re');
      }

      if(empty($this->hasErr())){
        $this->diffVal($pass_new,$pass_new_re,'pass_new');
      }

      if($this->hasErr()){
        debug('バリデーションエラーです');
        return;
      }else{

        debug('バリデーションOK。ユーザーテーブルに接続します。');
        try{ 
          $userModel = new \MyApp\Model\User();
          $userModel->passEdit([
            'pass' => $pass_new,
            'user_id' => $user_id
          ]);
          
          //メールを送信
          $from = 'miki.ishii16@gmail.com';
          $to = $email;
          $subject = 'パスワード変更通知｜memopa';
          $comment = <<<EOM
こんにちは！memopa!です。
{$from} 様からのお手続きにより、パスワードが変更されたことをお知らせいたします。
引き続き、memopa!で楽しいメモライフをお送りください。
                      
☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯
memopa!
URL  http://memopa.com/
E-mail memopa@memopa.com
☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯☆★●◯
EOM;
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

}
