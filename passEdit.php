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

  <body class="">
    
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
    <div id="contents" class="templete">
      <h1 class="page-title">パスワード変更</h1>
      <!-- Main -->
      <section id="main" >
        <div class="form-container">
          <form action="" method="post" class="form">
           <div class="area-msg">

           </div>
            <label class="<?php if(!empty($err_msg['pass_old'])) echo 'err'; ?>">
              古いパスワード
              <input type="password" name="pass_old" value="">
            </label>
            <div class="area-msg">
            </div>
            <label class="">
              新しいパスワード
              <input type="password" name="pass_new" value="">
            </label>
            <div class="area-msg">
            </div>
            <label class="">
              新しいパスワード（再入力）
              <input type="password" name="pass_new_re" value="">
            </label>
            <div class="area-msg">
              <?php 
              ?>
            </div>
            <div class="btn-container">
              <input type="submit" class="btn btn-mid" value="変更する">
            </div>
            <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
          </form>
        </div>
      </section>
      
    </div>

    <!-- footer -->
    <?php
    require('footer.php'); 
    ?>
