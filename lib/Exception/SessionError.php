<?php

namespace MyApp\Exception;

class SessionError extends \Exception{
  protected $message = '認証キーの有効期限が切れています。メールアドレスの入力から再度やり直してください。';
}

?>