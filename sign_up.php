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
<body>
<div class="bg-theme">
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

<div class="editPage">

  <h1 class="container-title title">新規登録</h1>
      <div class="form">

        <form action="" method="POST" class="container-form" novalidate>
          <div class="err"><?= h($app->getErr('common')); ?></div>
      
          <div class="container-formItem">
            <label for="email">
              <p class="container-formItem-name">
              Eメール
              <span class="err"><?= h($app->getErr('email')); ?></span>
              </p>
              <input type="email" name="email" value="<?= isset($app->getVal()->email)? h($app->getVal()->email) : '' ?>" >
            </label>
      
          </div>
          <div class="container-formItem">
            <label for="pass">
              <p class="container-formItem-name">
                パスワード
                <span class="err"><?= h($app->getErr('pass')); ?></span>
              </p>
              <input type="pass" name="pass" >
      
            </label>
          </div>

          <div class="container-formItem">
            <label for="pass_re">
              <p class="container-formItem-name">
                パスワード(再入力)
                <span class="err"><?= h($app->getErr('pass_re')); ?></span>
              </p>
              <input type="pass" name="pass_re">
      
            </label>
          </div>

            <div class="container-btn">
              <input type="submit" value="登録する" name="submit" class="btn btn-submit">

            </div>
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
        <a class="sign-up__link"href="login.php">ログインの方はこちらへ &gt;&gt;</a>
      </div>
    
</div>
    </div>
    <?php require('footer.php'); ?>
</body>
</html>