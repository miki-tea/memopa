<?php
require_once(__DIR__ . '/config/config.php');
$app = new MyApp\Controller\Withdraw();
$app->auth();
$app->run();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <? $subtitle = '退会'; ?>
  <?php require('head.php'); ?>
<body class="bg-theme">
  <?php require('header.php'); ?>
<main>
<div class="withdraw">
  <h1 class="withdraw__title">本当に退会しますか？</h1>
  <form action="" method="POST" class="form withdraw__form">
    <input type="submit" class="withdraw__btn" value="退会する">
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
  <span><?= isset($app->getVal()->common) ? h($app->getVal()->common) : ''; ?></span>
</div>

</main>
<?php require('footer.php'); ?>
</body>
</html>