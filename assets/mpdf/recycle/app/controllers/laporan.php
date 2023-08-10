<?php

class Laporan extends Controller {
  public function index() {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL . '/home');
    } else {
      $data = [
        'userList' => $this->model('users_model')->getAllUsers(),
      ];
      $this->view('laporan/header');
      $this->view('laporan/table', $data);
      $this->view('laporan/footer');
    }
  }

  // datatable ajax laporan
  public function laporanAjax() {
    $columns = [
      0 => 'tanggal',
      1 => 'shift',
      2 => 'operator1',
      3 => 'operator2',
      4 => 'machine',
      5 => 'temp_extru1',
      6 => 'temp_filterzone1',
      7 => 'temp_die1',
      8 => 'temp_extru2',
      9 => 'temp_filterzone2',
      10 => 'temp_die2',
      11 => 'rpm_rollfeeder',
      12 => 'rpm_screw',
      13 => 'rpm_pelletizer',
      14 => 'machine',
      15 => 'output',
      16 => 'waste_awal',
      17 => 'created_by',
      18 => 'updated_by',
      19 => 'created_at',
      20 => 'updated_at',
    ];

    $queryCount = $this->model('laporan_model')->getAll();
    $dataCount = $queryCount[0];
    $totalData = $dataCount['data_rows'];
    $totalFiltered = $totalData;
    
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    if(empty($_POST['search']['value'])) {
      $results = $this->model('laporan_model')->setOutput($order, $dir, $limit, $start);
    } else {
      $keyword = $_POST['search']['value'];
      $results = $this->model('laporan_model')->getResultSearch($order, $dir, $limit, $start, $keyword);

      $queryCount = $this->model('laporan_model')->getResultSearchLength($keyword);
      $dataCount = $queryCount[0];
      $totalFiltered = $dataCount['data_rows'];
    }

    $data = [];
    $no = 1;
    foreach($results as $result) {
      $nestedData['no'] = $no++ ;
      $nestedData['id'] = $result['id'];
      $nestedData['tanggal'] = date('d/M/y', strtotime($result['tanggal']));
      $nestedData['shift'] = $result['shift'];
      $nestedData['operator1'] = $result['operator1'];
      $nestedData['operator2'] = $result['operator2'];
      $nestedData['machine'] = $result['machine'];
      $nestedData['created_at'] = date('d/M/y H:i', strtotime($result['created_at'])) . '<br>[<span style="color: blue;">'. $result['creator'] .'</span>]';
      $nestedData['updated_at'] = $result['updated_at'] == "" ? "" : date('d/M/y H:i', strtotime($result['updated_at'])) . '<br>[<span style="color: blue;">'. $result['updater'] .'</span>]';
      $nestedData['action'] = $_SESSION['userInfo']['id'] == $result['created_by'] ? '<a href="'. BASEURL . "/laporan/details/" . $result["id"] .'" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil-square"></i></a> <a href="javascript:deleteReport('. $result["id"] .')" class="btn btn-sm btn-danger mb-1"><i class="bi bi-trash3"></i></a> <a href="'. BASEURL . "/laporan/print/" . $result["id"] .'" target="_blank" class="btn btn-sm btn-success mb-1"><i class="bi bi-filetype-pdf"></i></a>' : '<a href="'. BASEURL . "/laporan/details/" . $result["id"] .'" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a> <a href="'. BASEURL . "/laporan/print/" . $result["id"] .'" target="_blank" class="btn btn-sm btn-success"><i class="bi bi-filetype-pdf"></i></a>';
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
  // datatable ajax laporan

  // create laporan
  public function create() {
    try {
      $result  = $this->model('laporan_model')->createReport($_POST);
      if($result > 0) {
        $results =  [
          'lastId' => $this->model('laporan_model')->getLastId()['lastId'],
          'status' => 'success',
        ];

        echo json_encode($results);
      }
    } catch(Exception $e) {
      echo json_encode($e->getMessage());
    }
  }
  // create laporan

  // update laporan
  public function update() {
    try {
      $result  = $this->model('laporan_model')->updateLaporan($_POST);
      if($result > 0) {
        echo 'success';
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }
  // update laporan

  // delete laporan
  public function delete_report($id) {
    try {
      $result  = $this->model('laporan_model')->deleteLaporan($id);
      if($result > 0) {
        echo 'success';
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }
  // delete laporan

  // ----------------------------- details laporan -----------------------------

  // datatables ajax laporan details
  public function laporanDetailsAjax($reportId) {
    $columns = [
      0 => 'report_id',
      1 => 'time_start',
      2 => 'time_finish',
      3 => 'bm1_material_specs',
      4 => 'bm1_material_qty',
      5 => 'bm2_material_specs',
      6 => 'bm2_material_qty',
      7 => 'other_material_specs',
      8 => 'other_material_type',
      9 => 'other_material_qty',
      10 => 'product_type',
      11 => 'product_qty',
      12 => 'waste_type',
      13 => 'waste_qty',
      14 => 'remarks',
      15 => 'created_by',
      16 => 'updated_by',
      17 => 'created_at',
      18 => 'updated_at',
    ];

    $queryCount = $this->model('laporan_model')->getReportDetails($reportId);
    $dataCount = $queryCount[0];
    $totalData = $dataCount['data_rows'];
    $totalFiltered = $totalData;
    
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    if(empty($_POST['search']['value'])) {
      $results = $this->model('laporan_model')->setOutputDetails($order, $dir, $limit, $start, $reportId);
    } else {
      $keyword = $_POST['search']['value'];
      $results = $this->model('laporan_model')->getResultDetailsSearch($order, $dir, $limit, $start, $keyword, $reportId);

      $queryCount = $this->model('laporan_model')->getResultDetailsSearchLength($keyword, $reportId);
      $dataCount = $queryCount[0];
      $totalFiltered = $dataCount['data_rows'];
    }

    $data = [];
    $no = 1;
    foreach($results as $result) {
      $nestedData['no'] = $no++ ;
      $nestedData['time_start'] = date('H:i', strtotime($result['time_start']));
      $nestedData['time_finish'] = date('H:i', strtotime($result['time_finish']));
      $nestedData['product_type'] = $result['product_type'];
      $nestedData['product_qty'] = number_format($result['product_qty'], 2, ',', '.');
      $nestedData['waste_type'] = $result['waste_type'];
      $nestedData['waste_qty'] = number_format($result['waste_qty'], 2, ',', '.');
      $nestedData['created_at'] = date('d/M/y H:i', strtotime($result['created_at'])) . '<br>[<span style="color: blue;">' . $result['creator'] . '</span>]';
      $nestedData['updated_at'] = $result['updated_at'] == "" ? "" : date('d/M/y H:i', strtotime($result['updated_at'])) . '<br>[<span style="color: blue;">' . $result['updater'] . '</span>]';
      $nestedData['remarks'] = $result['remarks'];
      $nestedData['action'] = $_SESSION['userInfo']['id'] == $result['created_by'] ? '<a href="'. BASEURL . "/laporan/edit_details/" . $result["id"] .'" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil-square"></i></a> <a href="javascript:deleteDetails('. $result["id"] .')" class="btn btn-sm btn-danger mb-1"><i class="bi bi-trash3"></i></a>' : '<a href="'. BASEURL . "/laporan/edit_details/" . $result["id"] .'" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil-square"></i></a>';
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
  // datatables ajax laporan details

  // details laporan
  public function details($reportId) {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL . '/home');
    } else {
      $data = [
        'report' => $this->model('laporan_model')->getReportById($reportId),
        'reportDetails' => $this->model('laporan_model')->getReportDetails($reportId),
        'reportId' => $reportId,
        'userList' => $this->model('users_model')->getAllUsers(),
      ];

      $this->view('laporan/header');
      $this->view('laporan/details', $data);
      $this->view('laporan/footer');
    }
  }
  // details laporan

  // create details laporan
  public function createDetails() {
    try {
      $result  = $this->model('laporan_model')->createReportDetails($_POST);
      if($result > 0) {
        echo 'success';
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }
  // create details laporan

  // edit details laporan
  public function edit_details($reportDetailsId) {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL . '/home');
    } else {
      $data = [
        'reportDetails' => $this->model('laporan_model')->getReportDetailsById($reportDetailsId),
      ];

      $this->view('laporan/header');
      $this->view('laporan/edit-details', $data);
      $this->view('laporan/footer');
  }
  }
  // edit details laporan

  // update details laporan
  public function update_details() {
    try {
      $result  = $this->model('laporan_model')->updateDetailsLaporan($_POST);
      if($result > 0) {
        echo 'success';
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }
  // update details laporan

  // delete details laporan
  public function delete_details($id) {
    try {
      $result  = $this->model('laporan_model')->deleteDetailsLaporan($id);
      if($result > 0) {
        echo 'success';
      }
    } catch(Exception $e) {
      echo $e->getMessage();
    }
  }
  // delete details laporan

  public function print($reportId) {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL . '/home');
    } else {
      $data = [
        'report' => $this->model('laporan_model')->getReportById($reportId),
        'reportDetails' => $this->model('laporan_model')->getPrint($reportId),
        'reportId' => $reportId,
        'userList' => $this->model('users_model')->getAllUsers(),
      ];

      $this->view('laporan/export-pdf', $data);
    }
  }

  public function printx() {
    if(!isset($_SESSION['userInfo'])) {
      header('Location: ' . BASEURL . '/home');
    } else {
      $data = [
        'reportDetails' => $this->model('laporan_model')->getPrintX($_POST),
        'start_period' => $_POST['start'],
        'finish_period' => $_POST['finish'],
      ];

      $this->view('laporan/export-excel', $data);
    }
  }
}