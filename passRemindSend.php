<?php
require_once(__DIR__ . '/config/config.php');

debug('HELLO:passRemindSend.php');

$app = new MyApp\Controller\PassRemindSend();
$app->run();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php $subtitle = 'パスワード再設定'; ?>
  <?php require('head.php'); ?>
<body class="bg-theme">
  <?php require('header.php'); ?>
        <!-- ナビメニュー部分 -->
    <div class="menu">
      <ul class="menu__list">
        <li class="menu__item"><a class="menu__link" href="sign_up.php">会員登録</a></li>
        <li class="menu__item"><a class="menu__link" href="login.php">ログイン</a></li>
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
<div class="templete psr">
  <h1 class="templete__title">パスワードをお忘れの場合</h1>
  <p class="psr_body">
  ご登録いただいているメールアドレスを入力してください。メールアドレス宛にパスワード再設定用のメールをお送りします。
  </p>
  <form action="" method="POST" class="form withdraw__form">
    <label for="email">
      <p class="form__title">
      Eメール
      <!-- <span class="err"><= h($app->getErr('email')); ?></span> -->
      </p>
      <input class="form__input" type="email" name="email" value="" >
    </label>
    <input type="submit" class="templete__btn btn__submit" value="送信する">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
  <span></span>
</div>

</main>
<?php require('footer.php'); ?>
</body>
</html>