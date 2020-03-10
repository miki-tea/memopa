<?php

namespace MyApp\Exception;

class DuplicateEmail extends \Exception {
  protected $message = 'そのEmailは既に登録されています。';
}