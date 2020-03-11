<!DOCTYPE html>
<html lang="ja">
<head>
  <?php require('head.php'); ?>
  <?php $subtitle = 'メモ編集画面'; ?>
</head>
<body>
<?php require('header.php'); ?>
<main>
<div class="console">
  <div class="console__wrap">
    <div class="form-wrap">
      <form action="" method="POST" class="form">
        <textarea name="memo" class="form__inputArea" placeholder="新規投稿"></textarea>
        <input class="form__submitBtn"type="submit" name="submit" value="投稿する">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        <span class="err"><?= $app->getErr('common');?></span>
      </form>
    </div>
    <div class="nav__wrap">
      <ul class="nav">
        <li class="nav__list"><a class="nav__link"href="profile.php" >プロフィール編集</a></li>
        <li class="nav__list"><a class="nav__link"href="logout.php">ログアウト</a></li>
        <li class="nav__list"><a class="nav__link"href="withdraw.php">退会する</a></li>
      </ul>
    </div>
  </div>
</div>
</main>
<?php require('footer.php'); ?>
</body>
</html>