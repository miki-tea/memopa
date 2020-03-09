<?php

namespace memopa\Exception;

class UnmatchPass extends \Exception{
  protected $message = 'パスワードが再入力と一致しませんでした。';
}

?>