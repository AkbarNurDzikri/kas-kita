<?php

class Categories extends Controller {
  public function getCategories() {
    try {
      $categories  = $this->model('kategori_model')->getCategories($_POST['jenis_kategori']);
      if($categories > 0) {
        echo json_encode($categories);
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public function create() {
    try {
      $duplicateFound = $this->model('kategori_model')->getExistCategory($_POST);
      if($duplicateFound) {
        echo 'is duplicate';
      } else {
        $result  = $this->model('kategori_model')->createCategory($_POST);
        if($result > 0) {
          echo 'success';
        }
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public function update() {
    try {
      $duplicateFound = $this->model('kategori_model')->getExistCategory($_POST['nama_kategori_edit']);
      if($duplicateFound) {
        echo 'is duplicate';
      } else {
        $result  = $this->model('kategori_model')->updateCategory($_POST);
        if($result > 0) {
          echo 'success';
        }
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }
}