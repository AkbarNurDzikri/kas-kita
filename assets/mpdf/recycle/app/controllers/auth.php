<?php

class Auth extends Controller {
  // public function index() {
  //   if(isset($_SESSION['userInfo'])) {
  //     header('Location: ' . BASEURL . '/mom');
  //   } else {
  //     $this->view('auth/login');
  //   }
  // }

  public function checkCredentials() {
    $uname = strtolower($_POST['username']);
    $passw = $_POST['password'];

    $userExist = $this->model('users_model')->getDataByUsername($uname);
    if($userExist) {
      $verifyPassw = password_verify($passw, $userExist['password']);
      if($verifyPassw) {
        echo 'success';
        $_SESSION['userInfo'] = $userExist;
      } else {
        echo 'failed';
      }
    } else {
      echo 'failed';
    }
  }

  public function logout() {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL);
    } else {
      session_unset();
      session_destroy();

      header('Location: ' . BASEURL);
    }
  }
}