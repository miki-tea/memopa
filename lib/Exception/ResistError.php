<?php

namespace MyApp\Exception;

class ResistError extends \Exception {
  protected $message = 'メモの登録に失敗しました。時間を置いてやり直してください。';
}