<?php
require_once(__DIR__ . '/config/config.php');
$app = new MyApp\Controller\Login();
$app->run();
?>

<!DOCTYPE html>
<html>
<head>
  <?php 
    $subtitle = 'ログイン';
    require('head.php');
  ?>
  <!-- <link type="text/css" rel="stylesheet" href="./css/auth.css"> -->
</head>
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

<div class="login templete">
  <h1 class="templete__title">ログイン</h1>
        <form action="" method="POST" novalidate>
            <span class="err"><?= h($app->getErr('login')); ?></span>
            <label for="email">
              <p class="form__title">
                Eメール
                <span class="err"><?= h($app->getErr('email')); ?></span>
              </p>
              <input class="form__input" type="email" name="email" value="<?= isset($app->getVal()->email)? h($app->getVal()->email) : '' ?>">
            </label>
            <label for="pass">
              <p class="form__title">
                パスワード
                <span class="err"><?= $app->getErr('pass');?></span>
              </p>
              <input class="form__input" type="pass" name="pass">
      
            </label>
          <div class="pass-skip__wrapper">
            <label class="label pass-skip">
              <input type="checkbox" name="pass_skip" class="pass-skip__checkbox">
              <span class="pass-skip__statement">ログイン状態を1日保持</span>
            </label>
          </div>
            <!-- <div class="container-btn"> -->
              <input type="submit" value="ログイン" name="submit" class="templete__btn btn__submit">
            <!-- <F/div> -->
            <p><a class="templete__navi" href="sign_up.php">新規登録の方はこちらへ  &gt;&gt;</a></p>
            <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">

        </form>
      </div>
    
</div>

<?php require('footer.php'); ?>
</body>
</html>