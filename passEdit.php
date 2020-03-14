<?php
require_once(__DIR__ . '/config/config.php');

debug('HELLO:HELLO:HELLO:HELLO:passEdit.php');

$app = new MyApp\Controller\PassEdit();
$app->run();
?>
<?php
$subtitle = 'パスワード変更';
require('head.php'); 
?>
<body class="bg-theme">
    
    <!-- メニュー -->
    <?php
      require('header.php'); 
    ?>
            <!-- ナビメニュー部分 -->
    <div class="menu">
      <ul class="menu__list">
        <li class="menu__item"><a class="menu__link" href="mypage.php">マイページへ</a></li>
        <li class="menu__item"><a class="menu__link" href="prifile.php">プロフィール編集</a></li>
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

<!-- メインコンテンツ -->
<main>
  <div class="passEdit templete">
    <h1 class="templete__title">パスワード変更</h1>
    <!-- Main -->
    <form action="" method="post" class="form">
      <label for="pass_old">
        <p class="form__title">古いパスワード<span class="err"><?= h($app->getErr('pass_old')); ?></span></p>
        <input class="form__input" type="password" name="pass_old" value="">
      </label>
      <label for="pass_new">
        <p class="form__title">新しいパスワード<span class="err"><?= h($app->getErr('pass_new')); ?></span></p>
        <input class="form__input" type="password" name="pass_new" value="">
      </label>
      <label for="pass_new_re">
        <p class="form__title">新しいパスワード（再入力）<span class="err"><?= h($app->getErr('pass_new_re')); ?></span></p>
        <input class="form__input" type="password" name="pass_new_re" value="">
      </label>
      <div class="area-msg">
        <?php 
        ?>
      </div>
        <input type="submit" value="変更する" name="submit" class="templete__btn btn__submit">

      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
  </div>
</main>
<?php require('footer.php'); ?>
  </body>
</html>
