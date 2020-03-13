<?php

namespace MyApp\Exception;

class UnmatchDbInfo extends \Exception{
  protected $message = '入力情報がデータベースと一致しませんでした。';
}

?>