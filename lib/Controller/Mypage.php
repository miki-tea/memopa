<?php
namespace memopa\Controller;

class Index extends \memopa\Controller {

  public function run() {
    if($this->isLoggedIn()){
      header('Location:' .SITE_URL . '/mypage.php');
      exit;
    }
    //get users info
  }
}