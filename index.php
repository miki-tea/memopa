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
  <section class="hero container-fluid js-float-menu-target">
    <div class="hero-circle">
      <h2 class="hero-title">"memopa!"で、<br>気楽にメモしよう!</h2>
    </div>
  </section>
  <!-- ここからABOUT -->
  <section id="about" class="bg-color-sub">
    <div class="container">
      <div class="container-about">
        <h2 class="container-title js-fadein"><span class="container-ornament">"memopa!"とは？</span></h2>
        <p class="container-body js-fadein">シンプルで使いやすいメモアプリです。<br>
        「さっきいいアイデアが浮かんだのに、忘れてしまった・・・」なんて、<br>悔しい思いをしたことはありませんか？<br>
        「memopa!」を始めたら、メモする場所にはもう困りません。<br>全てのアイデアは「ぱっとメモ」できるから。<br>
        登録も退会も簡単。ノンストレスなメモライフをお楽しみください。</p>
      </div>
    </div>
  </section>
  <!-- ここまでABOUT -->
  <!-- ここからよくある質問 -->
    <section id="question">
      <div class="container container-question">
        <h2 class="container-title js-fadein">
          <spann class="container-ornament">FAQ</span>
        </h2>
        <div class="container-body">
          <div class="panel-group panel-group-flex">
    
            <div class="panel panel-border js-fadein">
                <h3 class="panel-head">有料？</h3>
              <div class="panel-body">
                <img src="./images/money.jpg" alt="">
              </div>
              <div>
                <p class="panel-foot">ご利用はずっと無料です。一部課金もありませんので、ご安心ください。</p>
              </div>
            </div>
    
            <div class="panel panel-border js-fadein">
                <h3 class="panel-head">使い方は？</h3>
              <div class="panel-body">
                <img src="./images/simple.jpg" alt="">
              </div>
              <div>
                <p class="panel-foot">直感的な操作が可能で、使いにくいところはありません。もし分からないところがあっても、ヘルプ機能があるのでご安心ください。</p>
              </div>
            </div>
    
            <div class="panel panel-border js-fadein">
                <h3 class="panel-head">退会は簡単？</h3>
              <div class="panel-body">
                <img src="./images/exit.jpg" alt="">
              </div>
              <div>
                <p class="panel-foot">もし気に入らなくても、退会はマイページからワンステップで可能です。</p>
              </div>
            </div>
          </div>
      </div>
      </div>
    </section>

  <section id="sign_up" class="bg-color-sub">
    <div class="container container-sign_up">
      <h1 class="container-title js-fadein">
        <span class="container-ornament">Let's "memopa!"</span>
      </h1>
      <div class="container-body js-fadein">
        <h2 class="head">さっそく、<br>始めてみましょう！</h2>
          <button class="btn container-btn btn-join"><a href="sign_up.php">無料会員登録</a></button>
      </div>

    </div>
  </section>


</main>
<?php require('footer.php'); ?>
</body>
</html>