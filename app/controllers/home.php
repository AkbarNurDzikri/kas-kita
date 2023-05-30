<?php

class home extends Controller{
  public function index() {
    $this->view('home/header');
    $this->view('home/landing-page');
    $this->view('home/footer');
  }

  public function login() {
    $this->view('home/header');
    $this->view('home/login');
    $this->view('home/footer');
  }

  public function daftar() {
    $this->view('home/header');
    $this->view('home/daftar');
    $this->view('home/footer');
  }
}