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