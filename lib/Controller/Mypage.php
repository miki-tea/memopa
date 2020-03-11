<?php
namespace MyApp\Controller;

class MyPage extends \MyApp\Controller {

  public function run() {
    $memo = filter_input(INPUT_POST,'memo');
    $user_id = $this->me()->user_id;
    debug('$user_idの中身::' . $this->me()->user_id);

    // loginしてるか確認
    // if($this->isLoggedIn()){
    //   header('Location:' . SITE_URL . '/memopa/mypage.php');
    //   exit;
    // }
    // メモ登録POST送信があったら登録する。
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      //空文字だったら何も処理しない。
      if(empty($memo)){
        return;
      }
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

  }
  // データベースにアクセスしてメモ情報を取ってくる。
  public function loadMemo() {
    $user_id = $this->me()->user_id;
    debug('user_idー＞'. $user_id);
    $postModel = new \MyApp\Model\Post();
    $post = $postModel->getDbMemo([
      'user_id' => $user_id
    ]);
    $this->setVal('post',$post);
  }


  // ページング用の数値を取ってくる
}