<?php

namespace MyApp\Model;

class User extends \MyApp\Model {
  public function create($values){
    $stmt = $this->db->prepare('INSERT INTO users (email,pass,login_time,create_date) VALUES (:email, :pass, :login_time, :create_date)');
    $res = $stmt->execute([
      ':email' => $values['email'],
      ':pass' => password_hash($values['pass'], PASSWORD_DEFAULT),
      ':login_time' => date('Y-m-d H:i:s'),
      ':create_date' => date('Y-m-d H:i:s')
    ]);
    if($res === false){
      throw new \MyApp\Exception\DuplicateEmail();
    }
  }
}