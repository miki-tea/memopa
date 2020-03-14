<?php

namespace MyApp\Exception;

class DeadEmail extends \Exception{
  protected $message = 'このEメールは登録されていません。';
}

?>