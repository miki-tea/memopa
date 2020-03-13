<?php
require_once(__DIR__ . '/config/config.php');
debug('HELLO:mypage.php');


$app = new MyApp\Controller\Mypage();

$app->run();
// $app->me();
// $app->getvValues()->users;
$app->loadMemo();



// require('function.php');
// debug('LOCATION::::mypage.php');
// debugLogStart();

// require('auth.php');
// debug('セッションの中身：'.print_r($_SESSION,true));

// $u_id = $_SESSION['user_id'];
// if(!empty($_POST['new_memo'])){
//   $formContent = $_POST['new_memo'];
// }


// //TODO: POST情報のバリデーション

// //メモをDBにインサートする
// if(!empty($formContent)){
//   debug('post送信がありました。');
//   debug(print_r($_POST,true));
//   //debug('バリデーションOK。DBへの登録を試みます。');  
//   if($_SESSION['new_memo'] !== $_POST['new_memo']){
//     try{
//       $_SESSION['new_memo'] = $formContent;
//       $dbh = dbConnect();
//       $sql = 'INSERT INTO post (`content`, `user_id`, `create_date`) 
//               VALUES (:content, :user_id, :date)';
//       $data = array( ':content' =>$formContent, ':user_id' =>$u_id, ':date' => date('Y-m-d H:i:s') );
//       $stmt = queryPost($dbh, $sql, $data);
      
//     }catch(Exception $e){
//       error_log('エラーが発生しました。'.$e->getMessage());
//     }
//   }
// } 
//   debug('post送信はありません。');

// //メモリストの表示処理
// $dbMemoList = getMemoList($u_id);
// // debug('$dbMemoListの中身:'.print_r($dbMemoList,true));

// ?>

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
      <!-- ナビメニュー部分 -->
    <div class="menu">
      <ul class="menu__list">
        <li class="menu__item"><a class="menu__link" href="profile.php">プロフィール編集</a></li>
        <li class="menu__item"><a class="menu__link" href="logout.php">ログアウト</a></li>
        <li class="menu__item"><a class="menu__link" href="withdraw.php">退会</a></li>
      </ul>
    </div>
  </div>
  <!-- ハンバーガーメニュー部分 --> 
  <div class="toggle">
      <span class="toggle__ornament"></span>
      <span class="toggle__ornament"></span>
      <span class="toggle__ornament"></span>
  </div>
</header>
  <!-- メイン -->
<main class="mypage">
<div class="console__wrapper">
  <div class="console">
    <div class="form-wrap">
      <form action="" method="POST" class="form">
        <textarea name="memo" class="form__inputArea" placeholder="新規投稿"></textarea>
        <input class="form__submitBtn"type="submit" name="submit" value="投稿する">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        <span class="err"><?= $app->getErr('common');?></span>
      </form>
    </div>
  </div>
</div>


<!-- 記事一覧部分 -->
  <div class="memoList">
    <h1 class="memoList__title">Memo List</h1>
    <div class="cardList">
      <?php foreach($app->getVal()->load as $load) : ?>
        <div class="card">
          <a href="memoDetail.php<?php echo ( !empty(appendGetParam()) )? appendGetParam() . '&p_id=' . $load->post_id : '?p_id=' . $load->post_id ?> ">
          <!-- もし既にあるパラメーターがあるならその'パラメーター'＋'&p_id=~~'をつける。ないなら'?p_id=~~'だけ -->
            <span class="card__body"><?= h($load->content); ?></span>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
    <div class=""></div>
    <div class=" memoList-paging"><< 1 2 3 >></div>
  </div>  
</main>

<!-- フッター -->
<?php require('footer.php'); ?>
</body>
</html>