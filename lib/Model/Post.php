<?php

namespace MyApp\Model;

class Post extends \MyApp\Model {

  public function create($values){
    $stmt = $this->db->prepare('INSERT INTO post (content,user_id,create_date) VALUES (:content, :user_id, :create_date)');
    $res = $stmt->execute([
      ':content' => $values['content'],
      ':user_id' => $values['user_id'],
      ':create_date' => date('Y-m-d H:i:s')
    ]);
    if($res === false){
      throw new \MyApp\Exception\ResistError();
    }
  }
}