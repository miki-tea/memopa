<?php
require_once(__DIR__ . '/config/config.php');
debug('HELLO:mypage.php');
debug('フラッシュメッセの中身'.$_SESSION['success']);


$app = new MyApp\Controller\Mypage();

$app->run();
$app->loadMemo();

$cards = $app->getVal()->load;
$num = count($cards);
$perPage = 12;
$totalPage = ceil($num / $perPage);
$currentPage = empty($_GET['page'])? 1 : (int)$_GET['page'];

// debug('$cards:'.var_dump($cards));
// debug('$num:'.$num);
// debug('$perPage:'.$perPage);
// debug('$totalPage:'.$totalPage);
// debug('$currentPage:'.$currentPage);

$splitList = splitList($currentPage, $perPage, $cards);
// debug('$splitList'.print_r($splitList));

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
      <!-- ナビメニュー部分 -->
    <div class="menu">
      <ul class="menu__list">
        <li class="menu__item"><a class="menu__link" href="profile.php">プロフィール編集</a></li>
        <li class="menu__item"><a class="menu__link" href="passEdit.php">パスワード編集</a></li>
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
    <p id="js-show-msg" style="display:none;" class="msg-slide">
        <?php echo showFlashMsg('success'); ?>
        <?php print_r(showFlashMsg('success')); ?>
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
    

    </p>

<!-- 記事一覧部分 -->
  <div class="memoList">
    <h1 class="memoList__title">Memo List</h1>
    <div class="cardList">
      <?php foreach($splitList as $list) : ?>
        <div class="card">
          <a href="memoDetail.php<?php echo ( !empty(appendGetParam()) )? appendGetParam() . '&memo_id=' . $list->post_id : '?memo_id=' . $list->post_id ?> ">
          <!-- もし既にあるパラメーターがあるならその'パラメーター'＋'&memo_id=~~'をつける。ないなら'?memo_id=~~'だけ -->
            <span class="card__body"><?= h($list->content); ?></span>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="memoList-paging"><?= paging($totalPage, $currentPage); ?></div>
  </div>  
</main>

<!-- フッター -->
<?php require('footer.php'); ?>
</body>
</html>