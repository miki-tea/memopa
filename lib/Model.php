<?php

namespace MyApp;

class Model {

  protected $db;

  public function __construct(){

    try {
      $host = getenv('host_name'); //MySQLがインストールされてるコンピュータ
      $dbname = getenv('db_name'); //使用するDB
      $charset = "utf8"; //文字コード
      $user = getenv('user_name'); //MySQLにログインするユーザー名
      $password = getenv('pass'); //ユーザーのパスワード
      // $host = 'localhost'; //MySQLがインストールされてるコンピュータ
      // $dbname = 'memopa'; //使用するDB
      // $charset = "utf8"; //文字コード
      // $user = 'dbuser'; //MySQLにログインするユーザー名
      // $password = 'memopa'; //ユーザーのパスワード
  
      $options = [
          \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION, //SQLでエラーが表示された場合、画面にエラーが出力される
          \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, //DBから取得したデータを連想配列の形式で取得する
          \PDO::ATTR_EMULATE_PREPARES   => false, //SQLインジェクション対策
      ];
      //DBへの接続設定
      $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        //DBへ接続
      $this->db = new \PDO($dsn, $user, $password, $options);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }
  
}