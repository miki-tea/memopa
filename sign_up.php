<?php

require_once(__DIR__ . '/config/config.php');
$app = new memopa\Controller\Signup();
$app->run();

// require('functions.php');
// debug('＊This is "login.php"*');
// debugLogStart();

// require('auth.php');

// if(!empty($_POST)){
//       debug('ACCEPT::::POST');
//       $email = $_POST['email'];
//       $pass = $_POST['pass'];
//       validRequired($email, 'email');
//       validRequired($pass, 'pass');

//       if(empty($err)){ //どちらも空ではなかった場合
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
// ?>

<!DOCTYPE html>
<html>
<head>
  <?php 
    $subtitle = '新規登録';
    require('head.php');
  ?>
  <!-- <link type="text/css" rel="stylesheet" href="./css/auth.css"> -->
</head>
<body>
<div class="bg-theme">
<?php require('header.php'); ?>

<div class="editPage">

  <h1 class="container-title title">新規登録</h1>
      <div class="form">

        <form action="" method="POST" class="container-form" novalidate>
          <div class="err"><?php if(!empty($err['common'])) echo $err['common']; ?></div>
      
          <div class="container-formItem">
            <label for="email">
              <p class="container-formItem-name">
              Eメール
              <span class="err"><?= h($app->getErr('email')); ?></span>
              </p>
              <input type="email" name="email" class="<?php if(!empty ($err['email'])) echo 'err' ?>" 
              value="<?php if(!empty($err['email'])) echo $err['email']; ?>" >
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

        </form>
        <p><a href="login.php">ログインの方はこちらへ</a></p>
        <?php var_dump($app->getErr('email')); ?>
      </div>
    
</div>
    </div>
    <?php require('footer.php'); ?>
</body>
</html>