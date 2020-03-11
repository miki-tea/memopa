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
    $_SESSION['me'] = $res['user_id'];
    if($res === false){
      throw new \MyApp\Exception\DuplicateEmail();
    }
  }

  // ログイン
  public function login($values){
    $stmt = $this->db->prepare('SELECT user_id,pass FROM users WHERE email = :email AND delete_flg = 0');
    $stmt->execute([
      ':email' => $values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();
     debug('$user->passの中身:' . $user->pass);
    
    if(empty($user)){
      throw new \MyApp\Exception\UnmatchDbInfo();
    }
    if(!password_verify($values['password'], $user->pass)){
      throw new \MyApp\Exception\UnmatchDbInfo();
    }
    if($user === false){
      throw new \MyApp\Exception\UnmatchDbInfo();
    }
    return $user;
  }

  //Eメール重複が無いか照会
  public function emailDup($values){
    $stmt = $this->db->prepare('SELECT email FROM users WHERE email = :email AND delete_flg = 0');
    $stmt->execute([
      ':email' => $values['email']
    ]);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if(!empty(array_shift($result))){
     throw new \MyApp\Exception\DuplicateEmail();
    }
  }
}