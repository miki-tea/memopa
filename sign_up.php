<?php

require_once(__DIR__ . '/config/config.php');
$app = new MyApp\Controller\Signup();
$app->run();

 ?>

<!DOCTYPE html>
<html>
<head>
  <?php 
    $subtitle = '新規登録';
    require('head.php');
  ?>
</head>
<body class="bg-theme">
<?php require('header.php'); ?>

<div class="submit templete">

  <h1 class="templete__title">新規登録</h1>
        <form action="" method="POST"  novalidate>
          <span class="err"><?= h($app->getErr('common')); ?></span>
            <label for="email">
              <p class="form__title">
              Eメール
              <span class="err"><?= h($app->getErr('email')); ?></span>
              </p>
              <input class="form__input" type="email" name="email" value="<?= isset($app->getVal()->email)? h($app->getVal()->email) : '' ?>" >
            </label>

            <label for="pass">
              <p class="form__title">
                パスワード
                <span class="err"><?= h($app->getErr('pass')); ?></span>
              </p>
              <input class="form__input" type="pass" name="pass" >
      
            </label>

            <label for="pass_re">
              <p class="form__title">
                パスワード(再入力)
                <span class="err"><?= h($app->getErr('pass_re')); ?></span>
              </p>
              <input class="form__input" type="pass" name="pass_re">
      
            </label>

              <input class="templete__btn btn__submit" type="submit" value="登録する" name="submit" class="btn btn-submit">
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
        <a class="templete__navi" href="login.php">ログインの方はこちらへ &gt;&gt;</a>
      </div>
    
</div>

<?php require('footer.php'); ?>
</body>
</html>