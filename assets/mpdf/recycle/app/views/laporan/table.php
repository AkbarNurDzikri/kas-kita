<h1 class="text-center my-3 font-third">Laporan Harian Recycle</h1>
<h5 class="text-muted text-center font-third" style="margin-top: -15px;">User Logged in as : <?= $_SESSION['userInfo']['fullname'] ?></h5>
<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="laporan-tab" data-bs-toggle="tab" data-bs-target="#laporan-tab-pane" type="button" role="tab" aria-controls="laporan-tab-pane" aria-selected="true">Laporan</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="preview-tab" data-bs-toggle="tab" data-bs-target="#preview-tab-pane" type="button" role="tab" aria-controls="preview-tab-pane" aria-selected="false">Preview</button>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <!-- pengeluaran -->
  <div class="tab-pane fade show active" id="laporan-tab-pane" role="tabpanel" aria-labelledby="laporan-tab" tabindex="0">
    <a href="<?= BASEURL . '/laporan/new' ?>" class="btn btn-primary btn-sm my-3" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-target="#buatLaporan">+ Buat Laporan</a>
    <a href="<?= BASEURL . '/auth/logout' ?>" class="btn btn-secondary btn-sm float-end my-3">Logout</a>
    <div class="card border-primary">
      <div class="card-body table-responsive">
        <table class="table table-striped caption-top" id="tableLaporan">
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Tanggal</th>
              <th>Shift</th>
              <th>Operator 1</th>
              <th>Operator 2</th>
              <th>Machine</th>
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
  <!-- pengeluaran -->

  <!-- Laporan -->
  <div class="tab-pane fade" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
    <h3 id="blinking" class="text-center mt-5">Modul sedang dalam pengembangan</h3>
    <script>
      const el = document.getElementById('blinking');
      const blinking = () => {
        if(el.style.color == 'red') {
          el.style.color = 'blue';
        } else {
          el.style.color = 'red';
        }
      };

      setInterval(blinking, 300)
    </script>
  </div>

  <!-- Modal Laporan -->
  <div class="modal fade" id="buatLaporan" tabindex="-1" aria-labelledby="buatLaporanLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="buatLaporanLabel">Formulir Laporan Recycle</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formLaporan">
          <div class="card">
            <div class="card-body">
              <div class="row mt-1">
                <div class="col-3 colRow1">
                  <label for="tanggal" class="form-label">Tanggal</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <div class="col-3 colRow1">
                  <label for="temp_extru1" class="form-label">Temp. Extruder 1</label>
                  <input type="number" class="form-control" id="temp_extru1" name="temp_extru1" required>
                </div>
                <div class="col-3 colRow1">
                  <label for="temp_extru2" class="form-label">Temp. Extruder 2</label>
                  <input type="number" class="form-control" id="temp_extru2" name="temp_extru2" required>
                </div>
                <div class="col-2 extruYEI" style="display: none;">
                  <label for="temp_extru3" class="form-label">Temp. Extruder 3</label>
                  <input type="number" class="form-control" id="temp_extru3" name="temp_extru3">
                </div>
                <div class="col-2 extruYEI" style="display: none;">
                  <label for="temp_extru4" class="form-label">Temp. Extruder 4</label>
                  <input type="number" class="form-control" id="temp_extru4" name="temp_extru4">
                </div>
                <div class="col-3 colRow1">
                  <label for="rpm_rollfeeder" id="labelRpmFeeder" class="form-label">RPM Roll Feeder</label>
                  <input type="number" class="form-control" id="rpm_rollfeeder" name="rpm_rollfeeder" required>
                </div>
              </div>

              <div class="row mt-1">
                <div class="col-3">
                  <label for="shift" class="form-label">Shift</label>
                  <input type="number" class="form-control" id="shift" name="shift" required>
                </div>
                <div class="col-3">
                  <label for="temp_filterzone1" class="form-label">Temp. Filter Zone 1</label>
                  <input type="number" class="form-control" id="temp_filterzone1" name="temp_filterzone1" required>
                </div>
                <div class="col-3">
                  <label for="temp_filterzone2" class="form-label">Temp. Filter Zone 2</label>
                  <input type="number" class="form-control" id="temp_filterzone2" name="temp_filterzone2" required>
                </div>
                <div class="col-3">
                  <label for="rpm_screw" class="form-label">RPM Screw</label>
                  <input type="number" class="form-control" id="rpm_screw" name="rpm_screw" required>
                </div>
              </div>

              <div class="row mt-1">
                <div class="col-3">
                  <label for="operator1" class="form-label">Operator 1</label>
                  <select name="operator1" id="operator1" class="form-select" required>
                    <option value="" disabled selected>Pilih Operator 1</option>
                    <?php foreach($data['userList'] as $user) : ?>
                      <option value="<?= $user['fullname'] ?>"><?= $user['fullname'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-3">
                  <label for="temp_die1" class="form-label">Temp. Die 1</label>
                  <input type="number" class="form-control" id="temp_die1" name="temp_die1" required>
                </div>
                <div class="col-3">
                  <label for="temp_die2" class="form-label">Temp. Die 2</label>
                  <input type="number" class="form-control" id="temp_die2" name="temp_die2" required>
                </div>
                <div class="col-3">
                  <label for="rpm_pelletizer" class="form-label">RPM Pelletizer</label>
                  <input type="number" class="form-control" id="rpm_pelletizer" name="rpm_pelletizer" required>
                </div>
              </div>

              <div class="row mt-1 mb-2">
                <div class="col-3">
                  <label for="operator2" class="form-label">Operator 2</label>
                  <select name="operator2" id="operator2" class="form-select">
                    <option value="" disabled selected>Pilih Operator 2</option>
                    <?php foreach($data['userList'] as $user) : ?>
                      <option value="<?= $user['fullname'] ?>"><?= $user['fullname'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-3">
                  <label for="machine" class="form-label">Mesin Recycle</label>
                  <select name="machine" id="machine" class="form-select" required>
                    <option value="" disabled selected>Pilih Mesin</option>
                    <option value="Plasmac">Plasmac</option>
                    <option value="YEI">YEI</option>
                  </select>
                </div>
                <div class="col-3">
                  <label for="output" class="form-label">Output</label>
                  <div class="input-group">
                    <input type="number" class="form-control" id="output" name="output" step=".01" required>
                    <span class="input-group-text">Kg /Jam</span>
                  </div>
                </div>
                <div class="col-3">
                  <label for="waste_awal" class="form-label">Waste Awal</label>
                  <input type="number" class="form-control" id="waste_awal" name="waste_awal" step=".01" required>
                </div>
              </div>
            </div>
          </div>
        <div class="modal-footer mt-3">
          <button type="submit" class="btn btn-primary btnSave">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Modal Laporan -->
</div>

<script>
  // datatable serverside laporan
  $(function() {
    $('#tableLaporan').dataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
        'url': '<?= BASEURL . "/laporan/laporanAjax" ?>',
        'dataType': 'json',
        'type': 'POST'
      },
      'columns': [
        {
          'data': 'no',
          'class': 'text-center align-middle',
        },
        {
          'data': 'tanggal',
          'class': 'text-center align-middle',
        },
        {
          'data': 'shift',
          'class': 'text-center align-middle',
        },
        {
          'data': 'operator1',
          'class': 'text-center align-middle',
        },
        {
          'data': 'operator2',
          'class': 'text-center align-middle',
        },
        {
          'data': 'machine',
          'class': 'text-center align-middle',
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
        'searchPlaceholder': 'Cari Operator 1'
      },
      'fixedHeader': true,
    });
  });
  // datatable serverside laporan

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

  // insert ajax
  $('#formLaporan').on('submit', (e) => {
    e.preventDefault();

    const formData = $('#formLaporan').serialize();
    
    $.ajax({
      url: '<?= BASEURL . "/laporan/create" ?>',
      type: 'POST',
      data: formData,
      success: function(res) {
        const response = JSON.parse(res);
        if(response.status == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Laporan berhasil di buat',
            text: 'Anda akan dialihkan ke halaman lain untuk mencatat detail Laporan',
            showConfirmButton: true,
          }).then(() => {
            location.href = '<?= BASEURL . '/laporan/details/' ?>' + response.lastId;
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal membuat laporan !',
            html: '<div class="card card-body mt-2"><p class="text-center">Kode Kesalahan :</p><p class="text-center">' + response + '</p></div>',
            showConfirmButton: true,
          })
        }
      }
    });
  });
  // insert ajax

  // delete details laporan
  function deleteReport(id) {
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
          url: '<?= BASEURL . "/laporan/delete_report/" ?>' + id,
          type: 'POST',
          success: function(res) {
            if(res == 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil menghapus laporan',
                showConfirmButton: true,
              }).then(() => {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal menghapus laporan !',
                html: '<b class="text-danger">Hapus semua details terlebih dahulu !</b> <div class="card card-body mt-2"><p class="text-muted small"> Kode Kesalahan :<br>' + res + '</p></div>',
                showConfirmButton: true,
              })
            }
          }
        });
      }
    })
  }
  // delete details laporan

  // laporan
  // $('#formSiklus').on('submit', (e) => {
  //   e.preventDefault();

  //   const formData = $('#formSiklus').serialize();
    
  //   $.ajax({
  //     url: '<?= BASEURL . "/kas_kita/laporan_kas" ?>',
  //     type: 'POST',
  //     data: formData,
  //     success: function(res) {
  //       const responses = JSON.parse(res).kasDetail;
  //       $('.tbodyReport').empty();
  //       $('.tfootReport').empty();
  //       let no = 1;
  //       let totalKasMasuk = 0;
  //       let totalKasKeluar = 0;
  //       $.each(responses, (key, value) => {
  //         const tr = $('<tr></tr>');
  //         const td1 = tr.append('<td class="text-center align-middle">'+ no++ +'</td>');
  //         const td2 = tr.append('<td class="text-center align-middle">'+ new Date(value.tanggal).toLocaleDateString("id") +'</td>');
  //         const td3 = tr.append('<td class="text-center align-middle">'+ value.kategori +'</td>');
  //         const td4 = tr.append('<td class="text-center align-middle">'+ value.keterangan +'</td>');
  //         const td5 = tr.append('<td class="text-end align-middle">'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value.pemasukan) +'</td>');
  //         const td6 = tr.append('<td class="text-end align-middle">'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value.pengeluaran) +'</td>');
          
  //         totalKasMasuk += Number(value.pemasukan);
  //         totalKasKeluar += Number(value.pengeluaran);

  //         tr.append(td1);
  //         tr.append(td2);
  //         tr.append(td3);
  //         tr.append(td4);
  //         tr.append(td5);
  //         tr.append(td6);
  //         $('.tbodyReport').append(tr);
  //       });

  //       const tr = $('<tr></tr>');
  //       const td1 = tr.append('<td colspan="4"><b>Total</b></td>')
  //       const td2 = tr.append('<td class="text-end"><b>'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasMasuk) +'</b></td>')
  //       const td3 = tr.append('<td class="text-end"><b>'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasKeluar) +'</b></td>')
  //       $('.tfootReport').append(tr);
  //       $('.textSaldo').html('Saldo : ' + new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasMasuk - totalKasKeluar));
  //     }
  //   });
  // });
  // laporan

  // hideOrShowExtru3&4MachineYEI
  $('#machine').on('change', () => {
    if($('#machine').val() == 'YEI') {
      $('.colRow1').attr('class', 'col-2 colRow1');
      $('#labelRpmFeeder').html('RPM Shredder');
      $('.extruYEI').show();
    } else {
      $('.colRow1').attr('class', 'col-3 colRow1');
      $('#labelRpmFeeder').html('RPM Roll Feeder');
      $('#temp_extru3').val('');
      $('#temp_extru4').val('');
      $('.extruYEI').hide();
    }
  });
  // hideOrShowExtru3&4MachineYEI
</script>