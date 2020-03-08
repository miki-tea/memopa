import jQuery from 'jquery';

const $ = jQuery;

console.log('read jQuery File!');

$(function () {
  //右にスライドする
  $('.js-slideRight-target').addClass('js-slideRight');
  $(window).scroll(function () {
    $('.js-slideRight-target').each(function () {
      let elemPos = $(this).offset().top,
        scroll = $(window).scrollTop(),
        windowHeight = $(window).height();
      if (scroll > elemPos - windowHeight + windowHeight / 6) {
        $(this).removeClass('js-slideRight');
      } else {
        $(this).addClass('js-slideRight');
      }
    });
  });
  //左にスライドする
  $('.js-slideLeft-target').addClass('js-slideLeft');
  $(window).scroll(function () {
    $('.js-slideLeft-target').each(function () {
      let elemPos = $(this).offset().top,
        scroll = $(window).scrollTop(),
        windowHeight = $(window).height();
      if (scroll > elemPos - windowHeight + windowHeight / 6) {
        $(this).removeClass('js-slideLeft');
      } else {
        $(this).addClass('js-slideLeft');
      }
    });
  });

  //上にスライドする
  $('.js-slideTop-target').addClass('js-slideTop');
  $(window).scroll(function () {
    $('.js-slideTop-target').each(function () {
      let elemPos = $(this).offset().top,
        scroll = $(window).scrollTop(),
        windowHeight = $(window).height();
      if (scroll > elemPos - windowHeight + windowHeight / 6) {
        $(this).removeClass('js-slideTop');
      } else {
        $(this).addClass('js-slideTop');
      }
    });
  });

  //上にスライドする
  $('.js-slideZoom-target').addClass('js-slideZoom');
  $(window).scroll(function () {
    $('.js-slideZoom-target').each(function () {
      let elemPos = $(this).offset().top,
        scroll = $(window).scrollTop(),
        windowHeight = $(window).height();
      if (scroll > elemPos - windowHeight + windowHeight / 6) {
        $(this).removeClass('js-slideZoom');
      } else {
        $(this).addClass('js-slideZoom');
      }
    });
  });
});