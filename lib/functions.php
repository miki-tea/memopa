<?php

function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function appendGetParam( $arr_del_key = array() ) {
  if(!empty($_GET)){
    $str = '?';
    foreach($_GET as $key => $val){
      //そのまま残すキーワードを選抜する($str以降に追加する)
      if(!in_array($key, $arr_del_key, true)){
        $str .= $key . '=' . $val . '&';
      }
    }
    $str = mb_substr($str, 0, -1, "UTF-8");
    return $str;
  }
}

function showFlashMsg($key) {
  if(!empty($_SESSION[$key])){
    $data = $_SESSION[$key];
    $_SESSION[$key] = '';
    return $data;
  }
}

function paging($totalPage, $currentPage = 1){
  $currentPage = (int)h($currentPage);
  $prev = max($currentPage - 1, 1);
  $next = min($currentPage + 1, $totalPage);

  if($currentPage != 1){
    print '<a href=?page=' . $prev . '>&laquo; 前へ</a>';
  }
  if($currentPage < $totalPage){
    print '<a href=?page=' . $next . '>次へ &raquo;</a>';
  }
}

function splitList($currentPage, $perPage, $cards){
  return array_filter($cards, function($i) use ($currentPage, $perPage){
    return $i >= ($currentPage - 1 ) * $perPage && $i < $currentPage * $perPage;
  }, ARRAY_FILTER_USE_KEY);
}
