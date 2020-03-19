import jQuery from "jquery";
const $ = jQuery;

$(function() {
  //右にスライドする
  // $(".js-slideRight-target").addClass("js-slideRight");
  // $(window).scroll(function() {
  //   $(".js-slideRight-target").each(function() {
  //     let elemPos = $(this).offset().top,
  //       scroll = $(window).scrollTop(),
  //       windowHeight = $(window).height();
  //     if (scroll > elemPos - windowHeight + windowHeight / 6) {
  //       $(this).removeClass("js-slideRight");
  //     } else {
  //       $(this).addClass("js-slideRight");
  //     }
  //   });
  // });
  //左にスライドする
  // $(".js-slideLeft-target").addClass("js-slideLeft");
  // $(window).scroll(function() {
  //   $(".js-slideLeft-target").each(function() {
  //     let elemPos = $(this).offset().top,
  //       scroll = $(window).scrollTop(),
  //       windowHeight = $(window).height();
  //     if (scroll > elemPos - windowHeight + windowHeight / 6) {
  //       $(this).removeClass("js-slideLeft");
  //     } else {
  //       $(this).addClass("js-slideLeft");
  //     }
  //   });
  // });

  //上にスライドする
  $(window).scroll(function() {
    $(".js-slideTop-target").each(function() {
      let elemPos = $(this).offset().top,
        scroll = $(window).scrollTop(),
        windowHeight = $(window).height();
      if (scroll > elemPos - windowHeight + windowHeight / 6) {
        $(this).removeClass("js-slideTop");
      }
    });
  });

  //少しずつ大きくなりながらゆっくりフェードインする
  $(window).scroll(function() {
    $(".js-slideIn-target").each(function() {
      let elemPos = $(this).offset().top,
        scroll = $(window).scrollTop(),
        windowHeight = $(window).height();
      if (scroll > elemPos - windowHeight + windowHeight / 6) {
        $(this).removeClass("js-slideIn");
      }
    });
  });

  //大きくなりながら素早くフェードインする
  $(window).scroll(function() {
    $(".js-slideZoom-target").each(function() {
      let elemPos = $(this).offset().top,
        scroll = $(window).scrollTop(),
        windowHeight = $(window).height();
      if (scroll > elemPos - windowHeight + windowHeight / 6) {
        $(this).removeClass("js-slideZoom");
      }
    });
  });

  // スマホ・タブレット向けトグルメニューの制御
  $(".toggle").click(function() {
    $(this).toggleClass("active");

    if ($(this).hasClass("active")) {
      $(".menu").addClass("active"); //クラスを付与
    } else {
      $(".menu").removeClass("active"); //クラスを外す
    }
  });

  //コンテンツが短すぎてフッターが上にずれてこないように制御
  var $ftr = $(".js-footer");
  if (window.innerHeight > $ftr.offset().top + $ftr.outerHeight()) {
    $ftr.attr({
      style:
        "position:fixed; top:" +
        (window.innerHeight - $ftr.outerHeight()) +
        "px;"
    });
  }

  // フラッシュメッセージ表示
  let $jsShowMsg = $("#js-show-msg");
  let msg = $jsShowMsg.text();
  if (msg.replace(/^[\s　]+|[\s　]+$/g, "").length) {
    $jsShowMsg.slideToggle("slow");
    setTimeout(function() {
      $jsShowMsg.slideToggle("slow");
    }, 2000);
  }
});
