<?php
namespace memopa\Controller;

class Signup extends \memopa\Controller {

  public function run() {
    if($this->isLoggedIn()){ // valid session
      header('Location:' .SITE_URL . '/mypage.php');
      exit;
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      //accept $_POST
      $this->postprocess();
    }
  }

  protected function postProcess(){
    //validation
    try {
      $this->_validate();
    } catch (\memopa\Exception\InvalidEmail $e){
      echo $e->getMessage();
      exit;
    } catch (\memopa\Exception\InvalidPassword $e){
      echo $e->getMessage();
      exit;
    } catch (\memopa\Exception\UnmatchPass $e){
      echo $e->getMessage();
      exit;
    }
    echo "success";
    exit;
    //create user
    //redirect to mypage
  }

  private function _validate() {
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
      throw new \memopa\Exception\InvalidEmail();
    }

    if(!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['pass'])){
      throw new \memopa\Exception\InvalidPassword();
    }
    if($_POST['pass'] !== $_POST['pass_re']){
      throw new \memopa\Exception\UnmatchPass();
    }
  }

}