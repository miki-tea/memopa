<?php
namespace MyApp\Controller;

// $token = filter_input(INPUT_POST,'token');
class Withdraw extends \MyApp\Controller {
  
  public function run() {
    // if($this->isLoggedIn()){ // valid session
    //   header('Location:' .SITE_URL . '/memopa/mypage.php');
    //   exit;
    // }
    $user_id = $this->me()->user_id;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // token
      if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        echo "invalid Token!";
        exit;
      }
      debug('ユーザーテーブルに接続します。');
      try{ 
        //create user
        $userModel = new \MyApp\Model\User();
        $userModel->delete([
          'user_id' => $user_id
        ]);
      }catch(\Exception $e) {
        debug('DB接続でエラーが発生しました。');
        $this->setErr('common',$e->getMessage());
        return;
      }
      // redirect to mypage
      header('location: ' . SITE_URL . '/memopa/index.php');
      exit;
    }
  }
}