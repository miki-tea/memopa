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
  
  public function edit($values){
    $stmt = $this->db->prepare('UPDATE post SET content = :content WHERE post_id = :post_id');
    $res = $stmt->execute([
      ':content' => $values['content'],
      ':post_id' => $values['post_id'],
    ]);
    header('location:mypage.php');

    if($res === false){
      throw new \MyApp\Exception\ResistError();
    }
  }

  public function getDbMemo($values) {
    //TODO:命名リファクタリング
    $stmt = $this->db->prepare('SELECT content,post_id FROM post WHERE user_id = :user_id AND delete_flg = 0 ORDER BY post_id DESC');
    $stmt->execute([
      ':user_id' => $values['user_id']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    // debug('$userの中身' . print_r($user, true));
    $res = $stmt->fetchAll();
    return $res;
  }

  public function getOneDbMemo($values) {
    //TODO:命名リファクタリング
    $stmt = $this->db->prepare('SELECT content,create_date,update_date FROM post WHERE post_id = :post_id AND delete_flg = 0 ');
    $stmt->execute([
      ':post_id' => $values['post_id']
    ]);
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    debug('$res[content]の中身：' . $res['content']);
    debug('$res[create_date]の中身：' . $res['create_date']);
    
    return $res;
  }

  public function delete($values){
    $stmt = $this->db->prepare('UPDATE post SET delete_flg = 1 WHERE post_id = :post_id');
    $res = $stmt->execute([
      ':post_id' => $values['post_id']
    ]);
    if($res === false){
      throw new \MyApp\Exception\DeleteError();
      debug('DB接続失敗しました。');
    }
  }
  
}