<div class="row my-3">
  <div class="col-md">
    <h1 class="font-third text-center my-3">Details Laporan Recycle</h1>
    <h5 class="text-muted text-center font-third" style="margin-top: -15px;">User Logged in as : <?= $_SESSION['userInfo']['fullname'] ?></h5>

    <a href="<?= BASEURL . '/laporan' ?>" class="btn btn-sm btn-secondary">&larr; Kembali</a>
    <a href="<?= BASEURL . '/laporan/print/' . $data['reportId'] ?>" target="_blank" class="btn btn-sm btn-danger"><i class="bi bi-filetype-pdf"></i> Print</a>
    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-target="#dateRangeExport"><i class="bi bi-filetype-xls"></i> Export</button>
  </div>
</div>

<div class="row">
  <div class="col-md">
    <div class="card">
      <div class="card-header">
      <h5 class="font-third text-muted"><b>Header Laporan</b></h5>
        <form id="formLaporan">
          <input type="hidden" name="id" value="<?= $data['reportId'] ?>">
          <div class="row mt-1">
            <div class="col-md-3 colRow1 mb-2">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $data['report'][0]['tanggal'] ?>" required>
            </div>
            <div class="col-md-3 colRow1 mb-2">
              <label for="temp_extru1" class="form-label">Temp. Extruder 1</label>
              <input type="number" class="form-control" id="temp_extru1" name="temp_extru1" value="<?= $data['report'][0]['temp_extru1'] ?>" required>
            </div>
            <div class="col-md-3 colRow1 mb-2">
              <label for="temp_extru2" class="form-label">Temp. Extruder 2</label>
              <input type="number" class="form-control" id="temp_extru2" name="temp_extru2" value="<?= $data['report'][0]['temp_extru2'] ?>" required>
            </div>
            <div class="col-2 extruYEI" style="display: none;">
              <label for="temp_extru3" class="form-label">Temp. Extruder 3</label>
              <input type="number" class="form-control" id="temp_extru3" name="temp_extru3" value="<?= $data['report'][0]['temp_extru3'] ?>">
            </div>
            <div class="col-2 extruYEI" style="display: none;">
              <label for="temp_extru4" class="form-label">Temp. Extruder 4</label>
              <input type="number" class="form-control" id="temp_extru4" name="temp_extru4" value="<?= $data['report'][0]['temp_extru4'] ?>">
            </div>
            <div class="col-md-3 colRow1 mb-2">
              <label for="rpm_rollfeeder" id="labelRpmFeeder" class="form-label">RPM Roll Feeder</label>
              <input type="number" class="form-control" id="rpm_rollfeeder" name="rpm_rollfeeder" value="<?= $data['report'][0]['rpm_rollfeeder'] ?>" required>
            </div>
          </div>

          <div class="row mt-1">
            <div class="col-md-3 mb-2">
              <label for="shift" class="form-label">Shift</label>
              <input type="number" class="form-control" id="shift" name="shift" value="<?= $data['report'][0]['shift'] ?>" required>
            </div>
            <div class="col-md-3 mb-2">
              <label for="temp_filterzone1" class="form-label">Temp. Filter Zone 1</label>
              <input type="number" class="form-control" id="temp_filterzone1" name="temp_filterzone1" value="<?= $data['report'][0]['temp_filterzone1'] ?>" required>
            </div>
            <div class="col-md-3 mb-2">
              <label for="temp_filterzone2" class="form-label">Temp. Filter Zone 2</label>
              <input type="number" class="form-control" id="temp_filterzone2" name="temp_filterzone2" value="<?= $data['report'][0]['temp_filterzone2'] ?>" required>
            </div>
            <div class="col-md-3 mb-2">
              <label for="rpm_screw" class="form-label">RPM Screw</label>
              <input type="number" class="form-control" id="rpm_screw" name="rpm_screw" value="<?= $data['report'][0]['rpm_screw'] ?>" required>
            </div>
          </div>

          <div class="row mt-1">
            <div class="col-md-3 mb-2">
              <label for="operator1" class="form-label">Operator 1</label>
              <select name="operator1" id="operator1" class="form-select" required>
                <option value="<?= $data['report'][0]['operator1'] ?>"><?= $data['report'][0]['operator1'] ?></option>
                <option value="" disabled>Pilih Operator 1</option>
                <?php foreach($data['userList'] as $user) : ?>
                  <option value="<?= $user['fullname'] ?>"><?= $user['fullname'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-3 mb-2">
              <label for="temp_die1" class="form-label">Temp. Die 1</label>
              <input type="number" class="form-control" id="temp_die1" name="temp_die1" value="<?= $data['report'][0]['temp_die1'] ?>" required>
            </div>
            <div class="col-md-3 mb-2">
              <label for="temp_die2" class="form-label">Temp. Die 2</label>
              <input type="number" class="form-control" id="temp_die2" name="temp_die2" value="<?= $data['report'][0]['temp_die2'] ?>" required>
            </div>
            <div class="col-md-3 mb-2">
              <label for="rpm_pelletizer" class="form-label">RPM Pelletizer</label>
              <input type="number" class="form-control" id="rpm_pelletizer" name="rpm_pelletizer" value="<?= $data['report'][0]['rpm_pelletizer'] ?>" required>
            </div>
          </div>

          <div class="row mt-1 mb-2">
            <div class="col-md-3 mb-2">
              <label for="operator2" class="form-label">Operator 2</label>
              <select name="operator2" id="operator2" class="form-select">
                <option value="<?= $data['report'][0]['operator2'] ?>"><?= $data['report'][0]['operator2'] ?></option>
                <option value="" disabled>Pilih Operator 2</option>
                <option value="">-</option>
                <?php foreach($data['userList'] as $user) : ?>
                  <option value="<?= $user['fullname'] ?>"><?= $user['fullname'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-3 mb-2">
              <label for="machine" class="form-label">Mesin Recycle</label>
              <select name="machine" id="machine" class="form-select" required>
                <option value="<?= $data['report'][0]['machine'] ?>"><?= $data['report'][0]['machine'] ?></option>
                <option value="" disabled>Pilih Mesin</option>
                <option value="Plasmac">Plasmac</option>
                <option value="YEI">YEI</option>
              </select>
            </div>
            <div class="col-md-3 mb-2">
              <label for="output" class="form-label">Output</label>
              <div class="input-group">
                <input type="number" class="form-control" id="output" name="output" value="<?= $data['report'][0]['output'] ?>" step=".01" required>
                <span class="input-group-text">Kg /Jam</span>
              </div>
            </div>
            <div class="col-md-3 mb-2">
              <label for="waste_awal" class="form-label">Waste Awal</label>
              <input type="number" class="form-control" id="waste_awal" name="waste_awal" value="<?= $data['report'][0]['waste_awal'] ?>" step=".01" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md">
              <button type="submit" class="btn btn-sm btn-success btnSave float-end"><i class="bi bi-sd-card"></i> Update</button>
            </div>
          </div>
        </form>
      </div>
      <div class="card-body table-responsive">
      <div class="row mb-3">
        <div class="col-md">
          <h5 class="font-third text-muted d-inline centered"><b>Details Laporan</b></h5>
          <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-target="#buatLaporan">+ Detail Laporan</button>
        </div>
      </div>
        <table class="table table-striped caption-top" id="tableDetailLaporan">
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Time Start</th>
              <th>Time Finish</th>
              <th>Product Type</th>
              <th>Product Qty</th>
              <th>Waste Type</th>
              <th>Waste Qty</th>
              <th>Created at/by</th>
              <th>Updated at/by</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <!-- diisi oleh serverside -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Laporan -->
<div class="modal fade" id="buatLaporan" tabindex="-1" aria-labelledby="buatLaporanLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="buatLaporanLabel">Formulir Detail Laporan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formDetailLaporan">
            <input type="hidden" name="report_id" value="<?= $data['reportId'] ?>">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="time_start" class="form-label">Mulai Proses</label>
                    <input type="time" class="form-control" id="time_start" name="time_start" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="time_finish" class="form-label">Selesai Proses</label>
                    <input type="time" class="form-control" id="time_finish" name="time_finish" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="remarks">Keterangan (Jika ada)</label>
                    <textarea name="remarks" id="remarks" class="form-control" placeholder="Tulis keterangan singkat padat dan jelas"></textarea>
                  </div>
                </div>

                <div class="row" id="cardMaterialBlownMachines">
                  <div class="col-md-6 mb-3">
                    <div class="card">
                      <div class="card-header">
                        <h5>Material BM1</h5>
                      </div>
                      <div class="card-body">
                        <div class="row mb-3">
                          <div class="col-md">
                            <label for="bm1_material_specs" class="form-label">Material Spec</label>
                            <textarea class="form-control" name="bm1_material_specs" id="bm1_material_specs" placeholder="Contoh : Spelid 25 x 730"></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md">
                            <label for="bm1_material_qty" class="form-label">Material Qty</label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="bm1_material_qty" name="bm1_material_qty" step=".01">
                              <span class="input-group-text">Kg</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        <h5>Material BM2</h5>
                      </div>
                      <div class="card-body">
                        <div class="row mb-3">
                          <div class="col-md">
                            <label for="bm2_material_specs" class="form-label">Material Spec</label>
                            <textarea class="form-control" name="bm2_material_specs" id="bm2_material_specs" placeholder="Contoh : Spelid 25 x 730"></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md">
                            <label for="bm2_material_qty" class="form-label">Material Qty</label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="bm2_material_qty" name="bm2_material_qty" step=".01">
                              <span class="input-group-text">Kg</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md">
                    <div class="card">
                      <div class="card-header">
                        <h5 id="labelOtherMaterials">Others Material</h5>
                      </div>
                      <div class="card-body">
                        <div class="row mb-3">
                          <div class="col-md-6 mb-3">
                            <label for="other_material_specs" class="form-label">Material Spec</label>
                            <textarea class="form-control" name="other_material_specs" id="other_material_specs" placeholder="Contoh : Spelid 25 x 730"></textarea>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="other_material_qty" class="form-label">Qty Material</label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="other_material_qty" name="other_material_qty" step=".01">
                              <span class="input-group-text">Kg</span>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-6 mb-3">
                            <label for="other_material_type" class="form-label">Jenis Material</label>
                            <select name="other_material_type" id="other_material_type" class="form-select">
                              <option value="" disabled selected>Pilih Jenis Material</option>
                              <option value="Trim">Trim</option>
                              <option value="Roll">Roll</option>
                              <option value="Sesetan">Sesetan</option>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="other_material_category" class="form-label">Kategori Material</label>
                            <select name="other_material_category" id="other_material_category" class="form-select">
                              <option value="" disabled selected>Pilih Kategori Material</option>
                              <option value="Clear">Clear</option>
                              <option value="White">White</option>
                              <option value="Zak Resin">Zak Resin</option>
                              <option value="Reject">Reject</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md">
                    <div class="card">
                      <div class="card-header"><h5>Finish Good</h5></div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-3 mb-3">
                            <label for="product_type" class="form-label">Produk Jadi</label>
                            <select name="product_type" id="product_type" class="form-select" required>
                              <option value="" disabled selected>Pilih Jenis Produk</option>
                              <option value="Clear">Clear</option>
                              <option value="White">White</option>
                              <option value="Noblen">Noblen</option>
                              <option value="Purging">Purging</option>
                              <option value="RPE">RPE</option>
                            </select>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="product_qty" class="form-label">Qty Produk</label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="product_qty" name="product_qty" required step=".01">
                              <span class="input-group-text">Kg</span>
                            </div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="waste_type" class="form-label">Waste Proses (Jika ada)</label>
                            <select name="waste_type" id="waste_type" class="form-select">
                              <option value="" disabled selected>Pilih Jenis Waste</option>
                              <option value="Powder">Powder</option>
                              <option value="Frozen">Frozen</option>
                            </select>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="waste_qty" class="form-label">Qty Waste (Jika ada)</label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="waste_qty" name="waste_qty" step=".01">
                              <span class="input-group-text">Kg</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <div class="modal-footer mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Date Range Report -->
<div class="modal fade" id="dateRangeExport" tabindex="-1" aria-labelledby="dateRangeExportLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="dateRangeExportLabel">Get Recycle Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL . '/laporan/printX' ?>" method="POST">
          <input type="hidden" name="report_id" value="<?= $data['reportId'] ?>">
          <label for="start_date" class="form-label">Mulai tanggal</label>
          <input type="date" class="form-control mb-3" name="start" required>

          <label for="end_date" class="form-label">Sampai tanggal</label>
          <input type="date" class="form-control mb-3" name="finish" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="bi bi-cloud-arrow-down"></i> Download</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Date Range Report -->
<script>
  // ajax laporan details
  $(function() {
    $('#tableDetailLaporan').dataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
        'url': '<?= BASEURL . "/laporan/laporanDetailsAjax/" . $data['reportId'] ?>',
        'dataType': 'json',
        'type': 'POST'
      },
      'columns': [
        {
          'data': 'no',
          'class': 'text-center align-middle',
        },
        {
          'data': 'time_start',
          'class': 'text-center align-middle',
        },
        {
          'data': 'time_finish',
          'class': 'text-center align-middle',
        },
        {
          'data': 'product_type',
          'class': 'text-center align-middle',
        },
        {
          'data': 'product_qty',
          'class': 'text-end align-middle',
        },
        {
          'data': 'waste_type',
          'class': 'text-center align-middle',
        },
        {
          'data': 'waste_qty',
          'class': 'text-end align-middle',
        },
        {
          'data': 'created_at',
          'class': 'text-center align-middle',
        },
        {
          'data': 'updated_at',
          'class': 'text-center align-middle',
        },
        {
          'data': 'action',
          'class': 'text-center align-middle',
        },
      ],
      'language': {
        'searchPlaceholder': 'Cari Product Type'
      },
      'fixedHeader': true,
    });
  });
  // ajax laporan details

  // insert ajax laporan details
  $('#formDetailLaporan').on('submit', (e) => {
    e.preventDefault();

    const formData = $('#formDetailLaporan').serialize();
    
    $.ajax({
      url: '<?= BASEURL . "/laporan/createDetails" ?>',
      type: 'POST',
      data: formData,
      success: function(res) {
        if(res == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil menambahkan detail laporan',
            showConfirmButton: true,
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: ' Gagal menambahkan detail laporan !',
            text: res,
            showConfirmButton: true,
          })
        }
      }
    });
  });
  // insert ajax laporan details

  // validation
  $('#operator1').on('change', () => {
    if($('#operator1').val() == $('#operator2').val()) {
      Swal.fire({
        icon: 'error',
        title: $('#operator1').val() + ' sudah dipilih !',
        showConfirmButton: true,
      });

      $('#operator1').val('');
    }
  });

  $('#operator2').on('change', () => {
    if($('#operator2').val() == $('#operator1').val()) {
      Swal.fire({
        icon: 'error',
        title: $('#operator2').val() + ' sudah dipilih !',
        showConfirmButton: true,
      });

      $('#operator2').val('');
    }
  });
  // validation

  // update laporan
  $('#formLaporan').on('submit', (e) => {
    e.preventDefault();

    const formData = $('#formLaporan').serialize();
    
    $.ajax({
      url: '<?= BASEURL . "/laporan/update" ?>',
      type: 'POST',
      data: formData,
      success: function(res) {
        if(res == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil mengupdate laporan',
            showConfirmButton: true,
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal mengupdate laporan !',
            text: res,
            showConfirmButton: true,
          })
        }
      }
    });
  });
  // update laporan

  // delete details laporan
  function deleteDetails(id) {
    Swal.fire({
      title: 'Yakin hapus data ini?',
      html: '<span style="color: red;">Data akan dihapus secara permanen</span>',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '<?= BASEURL . "/laporan/delete_details/" ?>' + id,
          type: 'POST',
          success: function(res) {
            if(res == 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil menghapus details laporan',
                showConfirmButton: true,
              }).then(() => {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal menghapus details laporan !',
                text: res,
                showConfirmButton: true,
              })
            }
          }
        });
      }
    })
  }
  // delete details laporan

  // show or hide cards
  $('#machine').on('change', () => {
    if($('#machine').val() == 'YEI') {
      $('#cardMaterialBlownMachines').hide();
    } else {
      $('#cardMaterialBlownMachines').show();
    }
  });

  function showOrHideCardMaterialBlownMachines() {
    if($('#machine').val() == 'YEI') {
      $('#cardMaterialBlownMachines').hide();
    } else {
      $('#cardMaterialBlownMachines').show();
    }
  };

  showOrHideCardMaterialBlownMachines();
  // show or hide cards

  // show or hide extru3 & extru4
  $('#machine').on('change', () => {
    if($('#machine').val() == 'YEI') {
      $('.colRow1').attr('class', 'col-2 colRow1');
      $('#labelRpmFeeder').html('RPM Shredder');
      $('#labelOtherMaterials').html('Raw Materials');
      $('.extruYEI').show();
    } else {
      $('.colRow1').attr('class', 'col-3 colRow1');
      $('#labelRpmFeeder').html('RPM Roll Feeder');
      $('#labelOtherMaterials').html('Other Materials');
      $('#temp_extru3').val('');
      $('#temp_extru4').val('');
      $('.extruYEI').hide();
    }
  });

  function showOrHideExtru3Extru4() {
    if($('#machine').val() == 'YEI') {
      $('.colRow1').attr('class', 'col-2 colRow1');
      $('#labelRpmFeeder').html('RPM Shredder');
      $('#labelOtherMaterials').html('Raw Materials');
      $('.extruYEI').show();
    } else {
      $('.colRow1').attr('class', 'col-3 colRow1');
      $('#labelRpmFeeder').html('RPM Roll Feeder');
      $('#labelOtherMaterials').html('Other Materials');
      $('.extruYEI').hide();
    }
  };

  showOrHideExtru3Extru4();
  // show or hide extru3 & extru4
</script>