<?php
$subtitle = "TOP";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <?php 
    $subtitle = 'トップページ';
    require('head.php');
  ?>
</head>
<body>
<!-- ヘッダー  -->
<?php require('header.php'); ?>
<!-- ここからメインコンテンツ -->
<main>
  <!-- ここからヒーローセクション -->
  <section class="hero container-fluid">
    <div class="hero__circle">
      <h2 class="hero__title">"memopa!"で、<br>気楽にメモしよう!</h2>
    </div>
  </section>
  <!-- ここからABOUT -->
  <section class="bg-color-sub">
    <div class="container">
        <h2 class="container__title">
          <span class="container__ornament">"memopa!"とは？</span>
        </h2>
        <p class="container__body js-slideTop-target js-slideTop">シンプルで使いやすいメモアプリです。<br>
        「さっきいいアイデアが浮かんだのに、忘れてしまった・・・」なんて、<br>悔しい思いをしたことはありませんか？<br>
        「memopa!」を始めたら、メモする場所にはもう困りません。<br>全てのアイデアは「ぱっとメモ」できるから。<br>
        登録も退会も簡単。ノンストレスなメモライフをお楽しみください。</p>
      <button class="btn btn-join container__btn"><a href="sign_up.php">無料会員登録</a></button>
    </div>
  </section>
  <!-- ここまでABOUT -->
  <!-- ここからよくある質問 -->
  <section>
    <div class="container">
      <h2 class="container__title">
        <spann class="container__ornament">FAQ</span>
      </h2>
      <div class="container__body">
        <div class="panel__group panel__group-flex ">
          <div class="panel js-slideTop-target js-slideTop">
              <h3 class="panel__head">有料？</h3>
            <div class="panel__body">
              <img src="./dist/melissa-walker-horn-Pp8bKaL5JFI-unsplash.jpg" alt="">
            </div>
            <div>
              <p class="panel__foot">ご利用はずっと無料です。一部課金もありませんので、ご安心ください。</p>
            </div>
          </div>
          <div class="panel js-slideTop-target js-slideTop">
              <h3 class="panel__head">使い方は？</h3>
            <div class="panel__body">
              <img src="./dist/tim-gouw-KigTvXqetXA-unsplash.jpg" alt="">
            </div>
            <div>
              <p class="panel__foot">シンプルな見た目で、直感的に操作することができます。</p>
            </div>
          </div>
          <div class="panel js-slideTop-target js-slideTop">
              <h3 class="panel__head">退会は簡単？</h3>
            <div class="panel__body">
              <img src="./dist/jan-tinneberg-gJJhG4gM7NA-unsplash.jpg" alt="">
            </div>
            <div>
              <p class="panel__foot">もし気に入らなくても、退会はマイページからワンステップで可能です。</p>
            </div>
          </div>
        </div>
    </div>
    </div>
  </section>
  <section class="bg-color-sub">
    <div class="container">
      <h1 class="container__title js-slideZoom-target js-slideZoom">
        <span class="container__ornament">Let's "memopa!"</span>
      </h1>
        <h2 class="js-slideIn-target js-slideIn container__body">さっそく、<br>始めてみましょう！</h2>
        <button class="btn container__btn btn-join"><a href="sign_up.php">無料会員登録</a></button>
    </div>
  </section>
</main>
<?php require('footer.php'); ?>
</body>
</html>