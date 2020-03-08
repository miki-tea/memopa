
  <header class="header js-float-menu">
    <div class="title">
      <h1><a href="<?php if(empty($_SESSION['user_id'])) { echo 'index'; }else{ echo 'mypage'; }?>.php">memopa!</a></h1>
    </div>
    
    <div class="menu-trigger js-toggle-sp-menu">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <nav class="nav-menu js-toggle-sp-menu-target">
      <ul class="menu">
        <?php if(empty($_SESSION['user_id'])) { ?>
        <li class="menu-item"><a href="login.php" class="menu-link">ログイン</a></li>
        <li class="menu-item"><a href="sign_up.php" class="menu-link">無料会員登録</a></li>
        <?php }; ?>
      </ul>
    </nav>
  </header>