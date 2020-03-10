<?php
namespace MyApp\Controller;

class MyPage extends \MyApp\Controller {

  public function run() {
    if($this->isLoggedIn()){
      header('Location:' . SITE_URL . '/memopa/mypage.php');
      exit;
    }
    
    // メモ登録POSTがあったら登録する。
    $memo = filter_input(INPUT_POST,'memo');
    $user_id = $_SESSION['user_id'];
    debug('$memoの中身:' . $memo);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      //トークン
      if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        echo "invalid Token!";
        exit;
      }
      // バリデーション(1000文字以内かどうか)
      $this->InvalidMaxLen($memo, 'common', 1000);
      // DB接続
      if($this->hasErr()){
        debug('バリデーションエラーです。');
        return;
      }else{
        debug('バリデーション成功。ユーザーテーブルに接続します。');
        try{
          $userModel = new \MyApp\Model\Post();
          $userModel->create([
            'content' => $memo,
            'user_id' => $user_id
          ]);
        } catch( \MyApp\Exception\ResistError $e ){
          $this->setErr('common',$e->getMessage());
          return;
        }
        header('location: ' . SITE_URL . '/memopa/mypage.php');
        exit;
      }
    }
    // データベースにアクセスしてメモ情報を取ってくる。
  }
}