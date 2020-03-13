<?php
//DBにアクセスしてメモidが合致するメモのcontentを取得して表示
namespace MyApp\Controller;

class MemoDetail extends \MyApp\Controller {

  public function edit() {
    // まずPOST送信があるかチェック
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $post_id = $_GET['p_id'];
      $memo = filter_input(INPUT_POST, 'memo');
      debug('POST送信がありました。中身：' . $memo);
      debug('$post_id中身：' . $post_id);
      debug('バリデーションチェックを始めます。');
      debug('1000文字以内かチェックします。');
      $this->InvalidMaxLen($memo, 'common',1000);
      $this->InvalidRequired($memo, 'common');
      
      if($this->hasErr()){
        debug('バリデーションエラー。エラー内容をcommonに表示します。');
        return;
      }else{
        try{
          debug('バリデーションチェック終了。OKです。');
          debug('Postテーブルに接続を試みます。');
          $PostDetail = new \MyApp\Model\Post();
          //TODO: \MyApp\Model\Post()の作成
          $res = $PostDetail->edit([
            'post_id' => $post_id,
            'content' => $memo
          ]);
        }catch( \MyApp\Exception\ResistError $e ){
          debug('DB接続にエラーが起きました。');
            $this->setErr('common', $e->getMessage());
            return;
        }
      }
    }else{
      debug('POSTには何も入っていませんでした。');
      return;
    }
  }
  public function loadOneMemo() {
    $p_id = $_GET['p_id'];
    try{
      debug('メモの読み込みを開始します。');
      debug('Postテーブルに接続を試みます。');
      $PostDetail = new \MyApp\Model\Post();
      $res = $PostDetail->getOneDbMemo([
        'post_id' => $p_id
      ]);
      $this->setVal('res', $res);
    }catch ( \MyApp\Exception\LoadError $e){
      debug('DB接続にエラーが起きました。');
      $this->setErr('common', $e->getMessage());
      return;
    }
  }
}
?>