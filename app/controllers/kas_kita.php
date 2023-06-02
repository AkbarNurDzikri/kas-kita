<?php

class Kas_kita extends Controller {
  public function index() {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL . '/home');
    } else {
      $data = [
        'kasMasuk' => $this->model('kas_kita_model')->getPemasukanAll(),
        'kasKeluar' => $this->model('kas_kita_model')->getPengeluaranAll(),
      ];
      $this->view('kas-kita/header');
      $this->view('kas-kita/dashboard', $data);
      $this->view('kas-kita/footer');
    }
  }

  public function pengeluaranAjax() {
    $columns = [
      0 => 'tanggal',
      1 => 'kategori',
      2 => 'keterangan',
      3 => 'pemasukan',
      4 => 'pengeluaran',
    ];

    $queryCount = $this->model('kas_kita_model')->getPengeluaranAjax();
    $dataCount = $queryCount[0];
    $totalData = $dataCount['data_rows'];
    $totalFiltered = $totalData;
    
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    if(empty($_POST['search']['value'])) {
      $results = $this->model('kas_kita_model')->setPengeluaranOutput($order, $dir, $limit, $start);
    } else {
      $keyword = $_POST['search']['value'];
      $results = $this->model('kas_kita_model')->getPengeluaranSearch($order, $dir, $limit, $start, $keyword);

      $queryCount = $this->model('kas_kita_model')->getPengeluaranSearchLength($keyword);
      $dataCount = $queryCount[0];
      $totalFiltered = $dataCount['data_rows'];
    }

    $data = [];
    $no = 1;
    foreach($results as $result) {
      $nestedData['no'] = $no++ ;
      $nestedData['id'] = $result['id'];
      $nestedData['tanggal'] = date('d-M-y', strtotime($result['tanggal']));
      $nestedData['kategori'] = $result['kategori'];
      $nestedData['keterangan'] = $result['keterangan'];
      $nestedData['pengeluaran'] = number_format($result['pengeluaran'], 0, ',', '.');
      $nestedData['action'] = '<a href="'. BASEURL . "/kas_kita/edit_kas/" . $result["id"] .'" class="btn btn-sm btn-success mb-1"><i class="bi bi-pencil-square"></i></a> <a href="javascript:deleteKas('. $result["id"] .')" class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></a>';
      $data[] = $nestedData;
    }

    $json_data = [
      'draw' => intval($_POST['draw']),
      'recordsTotal' => intval($totalData),
      'recordsFiltered' => intval($totalFiltered),
      'data' => $data,
    ];

    echo json_encode($json_data);
  }

  public function pemasukanAjax() {
    $columns = [
      0 => 'tanggal',
      1 => 'kategori',
      2 => 'keterangan',
      3 => 'pemasukan',
      4 => 'pengeluaran',
    ];

    $queryCount = $this->model('kas_kita_model')->getPemasukanAjax();
    $dataCount = $queryCount[0];
    $totalData = $dataCount['data_rows'];
    $totalFiltered = $totalData;
    
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    if(empty($_POST['search']['value'])) {
      $results = $this->model('kas_kita_model')->setPemasukanOutput($order, $dir, $limit, $start);
    } else {
      $keyword = $_POST['search']['value'];
      $results = $this->model('kas_kita_model')->getPemasukanSearch($order, $dir, $limit, $start, $keyword);

      $queryCount = $this->model('kas_kita_model')->getPemasukanSearchLength($keyword);
      $dataCount = $queryCount[0];
      $totalFiltered = $dataCount['data_rows'];
    }

    $data = [];
    $no = 1;
    foreach($results as $result) {
      $nestedData['no'] = $no++ ;
      $nestedData['id'] = $result['id'];
      $nestedData['tanggal'] = date('d-M-y', strtotime($result['tanggal']));
      $nestedData['kategori'] = $result['kategori'];
      $nestedData['keterangan'] = $result['keterangan'];
      $nestedData['pemasukan'] = number_format($result['pemasukan'], 0, ',', '.');
      $nestedData['action'] = '<a href="'. BASEURL . "/kas_kita/edit_kas/" . $result["id"] .'" class="btn btn-sm btn-success mb-1"><i class="bi bi-pencil-square"></i></a> <a href="javascript:deleteKas('. $result["id"] .')" class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></a>';
      $data[] = $nestedData;
    }

    $json_data = [
      'draw' => intval($_POST['draw']),
      'recordsTotal' => intval($totalData),
      'recordsFiltered' => intval($totalFiltered),
      'data' => $data,
    ];

    echo json_encode($json_data);
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
}