<?php

namespace MyApp\Exception;

class DuplicateEmail extends \Exception{
  protected $message = 'Eメールが重複しています。';
}

?>