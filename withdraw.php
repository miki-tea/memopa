<!DOCTYPE html>
<html lang="en">
<head>
<? $subtitle = '退会'; ?>
<?php require('head.php'); ?>
<body class="bg-theme">
  <?php require('header.php'); ?>
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
<main>
<div class="withdraw__wrapper">
  <div class="withdraw">
    <h1 class="withdraw__title">本当に退会しますか？</h1>
    <form action="" method="POST" class="form withdraw__form">
      <input type="submit" class="withdraw__btn" value="退会する">
    </form>
  </div>
</div>

</main>
<?php require('footer.php'); ?>
</body>
</html>