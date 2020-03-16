<?php

namespace MyApp\Exception;

class DeleteError extends \Exception {
  protected $message = 'メモの削除に失敗しました。時間を置いてやり直してください。';
}