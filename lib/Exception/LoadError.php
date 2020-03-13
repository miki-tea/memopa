<?php

namespace MyApp\Exception;

class LoadError extends \Exception {
  protected $message = 'メモの読み込みに失敗しました。時間を置いてやり直してください。';
}