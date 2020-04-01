<?php
require_once(__DIR__ . '/config/config.php');
$app = new MyApp\Controller\Login();
$app->auth();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
$app->login();
}
?>

<!DOCTYPE html>
<html>
<head>
  <?php 
    $subtitle = 'ログイン';
    require('head.php');
  ?>
</head>
<body class="bg-theme">
<?php require('header.php'); ?>

<div class="login templete">
    <h1 class="templete__title">ログイン<a class="templete__navi" href="sign_up.php">新規登録の方はこちら  &gt;&gt;</a></h1>
                
    <form action="" method="POST" novalidate>
        <span class="err"><?= h($app->getErr('login')); ?></span>
        <label for="email">
          <p class="form__title">
            Eメール
            <span class="err"><?= h($app->getErr('email')); ?></span>
          </p>
          <input id="js-email" class="form__input" type="email" name="email" value="<?= isset($app->getVal()->email)? h($app->getVal()->email) : '' ?>">
        </label>
        <label for="pass">
          <p class="form__title">
            パスワード
            <span class="err"><?= $app->getErr('pass');?></span>
          </p>
          <input class="form__input" type="password" name="pass" id="js-pass">

        </label>
      <div class="pass-skip__wrapper">
        <label class="label pass-skip">
          <input type="checkbox" name="pass_skip" class="pass-skip__checkbox">
          <span class="pass-skip__statement">ログイン状態を1日保持</span>
        </label>
      </div>
          <input type="submit" value="ログイン" name="submit" class="templete__btn btn__submit">
        <p><a class="templete__navi" href="passRemindSend.php">パスワードをお忘れの方はこちらへ  &gt;&gt;</a></p>
        <div class="templete__navi js-modalOpen"  id="js-easyLoginBtn">お試しログイン  &gt;&gt;</div>
        

        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">

    </form>
</div>
<div class="modal js-modal">
  <div class="modal__bg js-modalClose"></div>
  <div class="modal__content">
    <h1 class="modal__title">お試しログインについて</h1>
    <p>
      お試しログインは、このアプリを試用するためのアカウントです。どなたでもログイン・閲覧できるため、個人情報に関わるもの、公序良俗に反するもの等はメモに登録しないで下さい。
    </p>
    <button class="js-modalClose btn__accept" href="">OK</button>
  </div>
</div>
<?php require('footer.php'); ?>
</body>
</html>