<?php
require_once(__DIR__ . '/config/config.php');
debug('HELLO:passRemindReceive.php');
$app = new MyApp\Controller\PassRemindReceive();
$app->run();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php $subtitle = '認証キー発行'; ?>
  <?php require('head.php'); ?>
<body class="bg-theme">
<?php require('header.php'); ?>
<main>
  <div class="templete psr">
    <h1 class="templete__title">認証キー</h1>
    <p class="psr_body">
    ご入力いただいたメールアドレスに認証キーをお送りしました。メールを確認し、認証キーをご入力ください。
    </p>
    <form action="" method="POST" class="form withdraw__form">
      <label for="auth">
        <p class="form__title">
        認証キー
        <!-- <span class="err">< h($app->getErr('email')); ?></span> -->
        </p>
        <input class="form__input" type="text" name="auth" value="" >
      </label>
      <input type="submit" class="templete__btn btn__submit" value="送信する">
      <!-- <input type="hidden" name="token" value=" h($_SESSION['token']); "> -->
    </form>
  </div>
</main>
<?php require('footer.php'); ?>
</body>
</html>