<?php
require_once(__DIR__ . '/config/config.php');
debug('HELLO:passRemindSend.php');
$app = new MyApp\Controller\PassRemindSend();
$app->run();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php $subtitle = '認証キー入力'; ?>
  <?php require('head.php'); ?>
<body class="bg-theme">
<?php require('header.php'); ?>

<main>
  <div class="templete psr">
    <h1 class="templete__title">パスワードをお忘れの場合</h1>
    <p class="psr_body">
    ご登録いただいているメールアドレスを入力してください。メールアドレス宛にパスワード再設定用のメールをお送りします。
    </p>
    <form action="" method="POST" class="form withdraw__form">
      <label for="email">
        <p class="form__title">
        Eメール
        <span class="err"><?= h($app->getErr('email')); ?></span>
        </p>
        <input class="form__input" type="email" name="email" value="" >
      </label>
      <input type="submit" class="templete__btn btn__submit" value="送信する">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
  </div>
</main>
<?php require('footer.php'); ?>
</body>
</html>