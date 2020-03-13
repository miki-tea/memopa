<!-- 
  <header class="header">
    <div class="drawer__wrap">
      <div class="header__title">
        <a href="< if(isset($_SESSION['me'])) { echo 'index'; }else{ echo 'mypage'; }>.php" class="header__link">memopa!</a>
      </div>
      
      <div class="sp-menu">
        <span class="sp-menu__ornament"></span>
        <span class="sp-menu__ornament"></span>
        <span class="sp-menu__ornament"></span>
      </div>
    </div>
    <nav class="menu">
      <ul class="menu__list">
        <(empty($_SESSION['user_id'])) { >
        <li class="menu__item"><a href="login.php" class="menu__link">ログイン</a></li>
        <li class="menu__item"><a href="sign_up.php" class="menu__link">無料会員登録</a></li>
        < }; >
      </ul>
    </nav> -->
<header class="header">
  <div class="header__wrap">
    <div class="header__logo logo">
      <a href="index.php" class="logo__link">memopa!</a>
    </div>
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