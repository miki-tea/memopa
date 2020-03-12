<?php
//DBにアクセスしてメモidが合致するメモのcontentを取得して表示
namespace MyApp\Controller;

class MemoDetail extends \MyApp\Controller {

  public function run() {
    // まずPOST送信があるかチェック
      $post_id = $this->me()->post_id;
      debug('$post_id中身：' . $post_id);
      //TODO: 中身は空。GETパラメーターから渡されたp_idでコンテンツを取得する必要がある。
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $post_id = $this->me()->post_id;
      $memo = filter_input(INPUT_POST, 'memo');
      debug('POST送信がありました。中身：' . $memo);
      debug('$post_id中身：' . $post_id);
      debug('バリデーションチェックを始めます。');
      debug('1000文字以内かチェックします。');
      $this->InvalidMaxLen($memo, 'common',1000);
      
      if($this->hasErr()){

        debug('バリデーションエラー。エラー内容をcommonに表示します。');
        return;

      }else{

        try{
          
          debug('バリデーションチェック終了。OKです。');
          debug('Postテーブルに接続を試みます。');
          $PostDetail = new \MyApp\Model\Post();
          //TODO: \MyApp\Model\Post()の作成
          $PostDetail->edit([
            'post_id' => $post_id
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
  // public function loadOnePost() {

  //   try{
  //     $postModel = new \MyApp\Model\Post();
  //     $postModel->load([
  //       'post_id' => $post_id
  //     ]);
  //   }catch{

  //   }
  
  // }
  //表示するメモの詳細を表示します。（投稿内容、更新日、作成日）
}
?>