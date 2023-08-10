<?php

class Kas_kita extends Controller {
  public function index() {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL . '/home');
    } else {
      $data = [
        'kasMasuk' => $this->model('kas_kita_model')->getPemasukanAll(),
        'kasKeluar' => $this->model('kas_kita_model')->getPengeluaranAll(),
        'kategoriPengeluaran' => $this->model('kategori_model')->getCategoriesOut(),
        'kategoriPemasukan' => $this->model('kategori_model')->getCategoriesIn(),
      ];
      $this->view('kas-kita/header');
      $this->view('kas-kita/dashboard', $data);
      $this->view('kas-kita/footer');
    }
  }

  public function kasKeluar() {
    try {
      if($_POST['nama_kategori_filter'] != 'All Categories') {
        $data = $this->model('kas_kita_model')->getKasKeluarByFilter($_POST);
        echo json_encode($data);
      } else {
        $data = $this->model('kas_kita_model')->getKasKeluarAll($_POST);
        echo json_encode($data);
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public function kasMasuk() {
    try {
      if($_POST['nama_kategori_filter_pemasukan'] != 'All Categories') {
        $data = $this->model('kas_kita_model')->getKasMasukByFilter($_POST);
        echo json_encode($data);
      } else {
        $data = $this->model('kas_kita_model')->getKasMasukAll($_POST);
        echo json_encode($data);
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public function catat_kas() {
    try {
      $result  = $this->model('kas_kita_model')->createKas($_POST);
      if($result > 0) {
        echo 'success';
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public function edit_kas($id) {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL . '/home');
    } else {
      $data = [
        'kas' => $this->model('kas_kita_model')->getDataById($id),
      ];

      $this->view('kas-kita/header');
      $this->view('kas-kita/edit-kas', $data);
      $this->view('kas-kita/footer');
    }
  }

  public function update_kas() {
    try {
      $result  = $this->model('kas_kita_model')->updateKas($_POST);
      if($result > 0) {
        echo 'success';
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public function delete_kas($id) {
    try {
      $result  = $this->model('kas_kita_model')->deleteKas($id);
      if($result > 0) {
        echo 'success';
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }

  public function laporan_kas() {
    $data = [
      'kasDetail' => $this->model('kas_kita_model')->getKasAll($_POST),
    ];

    echo json_encode($data);
  }

  public function export($dates) {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL . '/home');
    } else {
      $params = explode(",", $dates);
      $args = [
        'tglMulaiLaporan' => $params[0],
        'tglSelesaiLaporan' => $params[1],
      ];

      $data = [
        'kas' => $this->model('kas_kita_model')->getKasAll($args),
        'tanggalLaporan' => $args
      ];

      $this->view('kas-kita/export-pdf', $data);
    }
  }
}