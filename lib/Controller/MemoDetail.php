<?php

namespace MyApp\Controller;

class MemoDetail extends \MyApp\Controller {

  public function edit() {
    // token
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo "Token is invalid.Please input informataion from correct page.";
      exit;
    }
    $post_id = $_GET['memo_id'];
    $memo = filter_input(INPUT_POST, 'memo');
    // debug('バリデーションチェックを始めます。');
    // debug('1000文字以内かチェックします。');
    $this->InvalidMaxLen($memo, 'common',1000);
    $this->InvalidRequired($memo, 'common');
    
    if($this->hasErr()){
      // debug('バリデーションエラー。エラー内容をcommonに表示します。');
      return;
    }else{
      try{
        // debug('バリデーションチェック終了。OKです。');
        // debug('Postテーブルに接続を試みます。');
        $PostDetail = new \MyApp\Model\Post();
        $res = $PostDetail->edit([
          'post_id' => $post_id,
          'content' => $memo
        ]);
      $_SESSION['success'] = 'メモ編集に成功しました。';
      debug('セッションの中身：'. $_SESSION['success']);
      header("Location:mypage.php");
      }catch( \MyApp\Exception\ResistError $e ){
        debug('DB接続にエラーが起きました。');
        $this->setErr('common', $e->getMessage());
        return;
      }
    }
  }

  public function loadOneMemo() {
    $memo_id = $_GET['memo_id'];
    try{
      debug('メモの読み込みを開始します。');
      debug('Postテーブルに接続を試みます。');
      $PostDetail = new \MyApp\Model\Post();
      $res = $PostDetail->getOneDbMemo([
        'post_id' => $memo_id
      ]);
      $this->setVal('res', $res);
    }catch ( \MyApp\Exception\LoadError $e){
      debug('DB接続にエラーが起きました。');
      $this->setErr('common', $e->getMessage());
      return;
    }
  }
  
  public function delete() {
    // token
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      echo "Token is invalid.Please input informataion from correct page.";
      exit;
    }
    try{
      // debug('DBに接続します。');
      $postModel = new \MyApp\Model\Post();
      $postModel->delete([
        'post_id' => $_GET['memo_id']
      ]);
      // debug('DB処理成功しました。');
      $_SESSION['success'] = 'メモ削除に成功しました。';
      debug('セッションの中身：'. $_SESSION['success']);
      header("Location:mypage.php");
    }catch( \MyApp\Exception\DeleteError $e){
      // debug('エラーが発生しました。');
      $this->setErr('common', $e->getMessage());
      return;
    }
  }
}
?>