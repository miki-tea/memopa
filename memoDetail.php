<?php
  require_once(__DIR__ . '/config/config.php');
  $app = new MyApp\Controller\MemoDetail();
  $app->loadOneMemo();

  if(!empty($_POST['edit'])){
    $app->edit();
  }

  if(!empty($_POST['delete'])){
    debug('$_POST["delete"]の送信がありました。');
    $app->delete();
  }
  // $app->loadOnePost();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <?php $subtitle = 'メモ編集画面'; ?>
  <?php require('head.php'); ?>
</head>
<body>
<?php require('header.php'); ?>
      <!-- ナビメニュー部分 -->
    <div class="menu">
      <ul class="menu__list">
        <li class="menu__item"><a class="menu__link" href="mypage.php">マイページへ</a></li>
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
<main>
<div class="console__wrapper">
  <div class="console">
    <form action="" method="POST" class="form">
      <textarea name="memo" class="form__inputArea" placeholder="編集内容"></textarea>
      <input class="form__submitBtn"type="submit" name="edit" value="編集する">
      <!-- <input type="hidden" name="token" value="< h($_SESSION['token']); ?>"> -->
      <span class="err"><?= h($app->getErr('common')); ?></span>
    </form>
  </div>
</div>
<div class="editMemo editMemo__wrapper">
  <div class="editMemo__container">
    <div class="editMemo__body">
      <?= h($app->getVal()->res['content']); ?>
    </div>
    <div class="info editMemo__info">
      <ul class="info__list">
        <li class="info__item">
          <form action="" method="POST" class="">
            <input type="submit" name="delete" value="削除する">
          </form>
        </li>
        <li class="info__item">更新日：<?= h($app->getVal()->res['update_date']); ?></li>
        <li class="info__item">作成日：<?= h($app->getVal()->res['create_date']); ?></li>
      </ul>
    </div>
  </div>
</main>
<?php require('footer.php'); ?>
</body>
</html>