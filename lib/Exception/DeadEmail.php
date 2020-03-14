<?php

namespace MyApp\Exception;

class DeadEmail extends \Exception{
  protected $message = 'Eメールは登録されていません。';
}

?>