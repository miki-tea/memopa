<?php


require('function.php');
debug('LOCATION::::mypage.php');
debugLogStart();

require('auth.php');
debug('セッションの中身：'.print_r($_SESSION,true));

$u_id = $_SESSION['user_id'];
if(!empty($_POST['new_memo'])){
  $formContent = $_POST['new_memo'];
}


//TODO: POST情報のバリデーション

//メモをDBにインサートする
if(!empty($formContent)){
  debug('post送信がありました。');
  debug(print_r($_POST,true));
  //debug('バリデーションOK。DBへの登録を試みます。');  
  if($_SESSION['new_memo'] !== $_POST['new_memo']){
    try{
      $_SESSION['new_memo'] = $formContent;
      $dbh = dbConnect();
      $sql = 'INSERT INTO post (`content`, `user_id`, `create_date`) 
              VALUES (:content, :user_id, :date)';
      $data = array( ':content' =>$formContent, ':user_id' =>$u_id, ':date' => date('Y-m-d H:i:s') );
      $stmt = queryPost($dbh, $sql, $data);
      
    }catch(Exception $e){
      error_log('エラーが発生しました。'.$e->getMessage());
    }
  }
} 
  debug('post送信はありません。');

//メモリストの表示処理
$dbMemoList = getMemoList($u_id);
// debug('$dbMemoListの中身:'.print_r($dbMemoList,true));

?>

<!DOCTYPE html>
<html lang="ja">
  <!-- ヘッダー 情報 -->
<head>
  <?php $subtitle = 'マイページ'; ?>
  <?php require('head.php'); ?>
</head>
<body>
  <!-- ヘッダー  -->
  <?php require('header.php'); ?>
  <!-- メイン -->
<main class="mypage">
    <!-- <div class="bg-theme"> -->
    <div class="container">
      <div class="container-memoSub">
        <form action="" method="POST" class="input">
            <label>
                <textarea name="new_memo" class="input-form" placeholder="新規投稿"></textarea>
            </label>
            <div class="container-btn">
              <input class="btn"type="submit" name="submit" value="投稿">
            </div>
        </form>
        <ul class="container-config">
          <li class="container-configItem configItem"><a href="profile.php" >プロフィール編集</a></li>
          <li class="container-configItem configItem"><a href="logout.php">ログアウト</a></li>
          <li class="container-configItem configItem"><a href="withdraw.php">退会する</a></li>
        </ul>
      </div>
      <!-- 記事一覧部分 -->

      <div class="flex">
        <div class="container-memoList">
          <h1>Memo List</h1>
          <?php foreach($dbMemoList as $key => $val): ?>
          <a href="memoDetail.php<?php echo '?post_id='.$val['post_id']; ?>">
            <div class="memoList card">
              <span><?php echo $val['content']; ?></span>
            </div>
          </a>
          <?php endforeach; ?>

          
        </div>
        <div class="paging"><< 1 2 3 >></div>
      </div>
    </div>
    <!-- 投稿機能部分 -->
  <!-- </div> -->
  
</main>

<!-- フッター -->
<!-- <?php require('footer.php'); ?> -->
</body>
</html>