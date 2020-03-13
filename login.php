<?php
require_once(__DIR__ . '/config/config.php');
$app = new MyApp\Controller\Login();
$app->run();
// $app = new memopa\Controller\Signup();

// $app->run();

// require('function.php');
// debug('＊Here is "login.php"*');
// debugLogStart();

// require('auth.php');

// if(!empty($_POST)){
//   debug('ACCEPT::::POST');
    
//       $email = $_POST['email'];
//       $pass = $_POST['pass'];

//       validRequired($email, 'email');
//       validRequired($pass, 'pass');

//       if(empty($err)){

//         validEmail($email, 'email');
//         validMaxLen($email, 'email');

//         validMaxLen($pass, 'pass');
//         validMinLen($pass, 'pass');
//         validHalf($pass, 'pass');

//         if(empty($err)){
//           debug('OK:VALIDATE');
//             try {
//               $dbh = dbConnect();
//               $sql = 'SELECT pass,user_id FROM users WHERE email = :email AND delete_flg = 0';
//               $data = array(':email' => $email );
//               $stmt = queryPost($dbh, $sql, $data);
//               $result = $stmt->fetch(PDO::FETCH_ASSOC);

//               debug('CONTENT：'.print_r($result,true));

//               if(!empty($result) && password_verify($pass, $result['pass'])){
//                 debug('CORRECT::::PASS');

//                 //ログインセッション期限の管理
                
//                 $_SESSION['login_date'] = time();

//                 if($_POST['pass_skip']){
//                   //ログインセッション期限を1日に延長
//                   $_SESSION['login_limit'] = 60 * 60 * 24;
//                 } else {
//                   $_SESSION['login_limit'] = 60 * 60;
//                 }
//                 $_SESSION['user_id'] = $result['user_id'];
//                 header('Location:mypage.php');
//               }else{
//                 debug('INCORRECT::::PASS');
//                 $err['common'] = MSG08;
//               }
//             } catch(Exception $e) {
//               $err['common'] = CMNERR;
//               error_log('エラー発生：'.$e->getMessage());
//             }
//           }
//         }
//       }
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

  <h1 class="container-title title">ログイン</h1>
      <div class="form">

        <form action="" method="POST" class="container-form" novalidate>
          <div class="err"><?php if(!empty($err['common'])) echo $err['common']; ?></div>
      
          <div class="container-formItem">
            <span class="err"><?= h($app->getErr('login')); ?></span>
            <label for="email">
              <p class="container-formItem-name">
                Eメール
                <span class="err"><?= h($app->getErr('email')); ?></span>
              </p>
              <input type="email" name="email" value="<?= isset($app->getVal()->email)? h($app->getVal()->email) : '' ?>">
            </label>
          </div>
          <div class="container-formItem">
            <label for="pass">
              <p class="container-formItem-name">
                パスワード
                <span class="err"><?= $app->getErr('pass');?></span>
              </p>
              <input type="pass" name="pass">
      
            </label>
          </div>
          <div class="container-formItem">
            <input type="checkbox" name="pass_skip" class="pass_skip" id="pass_skip">
            <label for="pass_skip" class="label">ログイン状態を1日保持</label>
          </div>
            <div class="container-btn">
              <input type="submit" value="ログイン" name="submit" class="btn btn-submit">
            </div>
            <p><a href="sign_up.php">新規登録の方はこちらへ</a></p>
            <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">

        </form>
      </div>
    
</div>
    </div>
    <?php require('footer.php'); ?>
</body>
</html>