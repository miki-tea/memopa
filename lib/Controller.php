<?php

namespace memopa;

class Controller {
  protected function isLoggedIn(){
    //$_SESSION['user_id'];
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
  }
}