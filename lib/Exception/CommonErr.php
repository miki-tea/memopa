<?php

namespace MyApp\Exception;

class CommonErr extends \Exception{
  protected $message = 'システムエラーが発生しました。時間を置いてもう一度やり直してください。';
}

?>