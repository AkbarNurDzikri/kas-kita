<h3 class="text-center my-3 font-third"><i class="bi bi-cash-coin"></i> KAS KELUARGA <?= strtoupper($_SESSION['userInfo']['username']) ?> &nbsp;<i class="bi bi-wallet2"></i></h3>
<ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pengeluaran-tab" data-bs-toggle="tab" data-bs-target="#pengeluaran-tab-pane" type="button" role="tab" aria-controls="pengeluaran-tab-pane" aria-selected="true">Pengeluaran</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pemasukan-tab" data-bs-toggle="tab" data-bs-target="#pemasukan-tab-pane" type="button" role="tab" aria-controls="pemasukan-tab-pane" aria-selected="false">Pemasukan</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="laporan-tab" data-bs-toggle="tab" data-bs-target="#laporan-tab-pane" type="button" role="tab" aria-controls="laporan-tab-pane" aria-selected="false">Laporan</button>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <!-- pengeluaran -->
  <div class="tab-pane fade show active" id="pengeluaran-tab-pane" role="tabpanel" aria-labelledby="pengeluaran-tab" tabindex="0">
    <button class="btn btn-primary btn-sm my-3" data-bs-toggle="modal" data-bs-target="#buatKas">Buat Catatan</button>
    <a href="<?= BASEURL . '/auth/logout' ?>" class="btn btn-secondary btn-sm float-end my-3">Logout</a>
    <div class="card border-primary">
      <div class="card-body table-responsive">
        <table class="table table-striped caption-top" id="tablePengeluaran">
          <caption>Total Kas Keluar : <?= number_format($data['kasKeluar'][0]['total_pengeluaran'], 0, ',', '.') ?></caption>
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Keterangan</th>
              <th>Rupiah</th>
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

  <!-- pemasukan -->
  <div class="tab-pane fade" id="pemasukan-tab-pane" role="tabpanel" aria-labelledby="pemasukan-tab" tabindex="0">
    <button class="btn btn-primary btn-sm my-3" data-bs-toggle="modal" data-bs-target="#buatKas">Buat Catatan</button>
    <a href="<?= BASEURL . '/auth/logout' ?>" class="btn btn-secondary btn-sm float-end my-3">Logout</a>
    <div class="card border-success">
      <div class="card-body table-responsive">
        <table class="table table-striped caption-top" id="tablePemasukan">
          <caption>Total Kas Masuk : Rp. <?= number_format($data['kasMasuk'][0]['total_pemasukan'], 0, ',', '.') ?></caption>
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Keterangan</th>
              <th>Rupiah</th>
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
  <!-- pemasukan -->

  <!-- Laporan -->
  <div class="tab-pane fade" id="laporan-tab-pane" role="tabpanel" aria-labelledby="laporan-tab" tabindex="0">
    <form id="formSiklus">
      <div class="input-group mt-3">
        <input type="date" class="form-control" name="tglMulaiLaporan" required>
        <span class="input-group-text">s.d.</span>
        <input type="date" class="form-control" name="tglSelesaiLaporan" required>
      </div>
      <a href="<?= BASEURL . '/auth/logout' ?>" class="btn btn-secondary btn-sm mt-2">Logout</a>
      <button type="submit" class="btn btn-primary btn-sm float-end mt-2">Show Data</button>
    </form>
    <br>
    <div class="card border-dark">
      <div class="card-body table-responsive">
        <table class="table table-striped caption-top tableReport">
          <caption class="textSaldo"></caption>
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Keterangan</th>
              <th>Credit</th>
              <th>Debt</th>
            </tr>
          </thead>
          <tbody class="tbodyReport">
            <!-- diisi oleh jquery -->
          </tbody>
          <tfoot class="tfootReport">
            <!-- diisi oleh jquery -->
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal Kas -->
<div class="modal fade" id="buatKas" tabindex="-1" aria-labelledby="buatKasLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h1 class="modal-title fs-5" id="buatKasLabel">Buat Catatan Kas</h1>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form id="formKas">
      <label for="arusKas" class="form-label">Jenis Kas</label>
        <select name="arusKas" id="arusKas" class="form-select mb-3" required>
          <option value="" disabled selected>Pilih Arus Kas</option>
          <option value="Kas Masuk">Kas Masuk</option>
          <option value="Kas Keluar">Kas Keluar</option>
        </select>
        
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control mb-3" name="tanggal" required>

        <label class="form-label">Kategori</label>
        <select name="kategori" id="kategori" class="form-select mb-3" required>
          <option value="" disabled selected>Pilih Kategori</option>
        </select>

        <label for="keterangan" class="form-label">Keterangan</label>
        <textarea class="form-control mb-3" name="keterangan" id="keterangan" name="keterangan" required></textarea>

        <label for="jumlah" class="form-label">Jumlah</label>
        <div class="input-group mb-3">
          <span class="input-group-text">Rp.</span>
          <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Kas -->

<script>
  // datatable serverside pengeluaran
  $(function() {
    $('#tablePengeluaran').dataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
        'url': '<?= BASEURL . "/kas_kita/pengeluaranAjax" ?>',
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
          'data': 'kategori',
          'class': 'text-center align-middle',
        },
        {
          'data': 'keterangan',
          'class': 'text-center align-middle',
        },
        {
          'data': 'pengeluaran',
          'class': 'text-end align-middle',
        },
        {
          'data': 'action',
          'class': 'text-center align-middle',
        },
      ],
      'language': {
        'searchPlaceholder': 'Cari Keterangan'
      },
      'fixedHeader': true,
    });
  });
  // datatable serverside pengeluaran

  // datatable serverside pemasukan
  $(function() {
    $('#tablePemasukan').dataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
        'url': '<?= BASEURL . "/kas_kita/pemasukanAjax" ?>',
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
          'data': 'kategori',
          'class': 'text-center align-middle',
        },
        {
          'data': 'keterangan',
          'class': 'text-center align-middle',
        },
        {
          'data': 'pemasukan',
          'class': 'text-end align-middle',
        },
        {
          'data': 'action',
          'class': 'text-center align-middle',
        },
      ],
      'language': {
        'searchPlaceholder': 'Cari Keterangan'
      },
      'fixedHeader': true,
    });
  });
  // datatable serverside pemasukan

  $('#arusKas').on('change', () => {
    const selectedKas = $('#arusKas').find(':selected').val();
    if(selectedKas == 'Kas Masuk') {
      $('#kategori').append(new Option('Gaji', 'Gaji'));
      $('#kategori option[value="Lainnya"]').remove();
      $('#kategori option[value="Hutang"]').remove();
      $('#kategori option[value="Sandang"]').remove();
      $('#kategori option[value="Pangan"]').remove();
      $('#kategori option[value="Papan"]').remove();
      $('#kategori option[value="Pendidikan"]').remove();
      $('#kategori option[value="Transportasi"]').remove();
      $('#kategori option[value="Komunikasi"]').remove();
      $('#kategori option[value="Jajan"]').remove();
      $('#kategori option[value="Kebutuhan Bulanan"]').remove();
      $('#kategori').append(new Option('Lainnya', 'Lainnya'));
    } else {
      $('#kategori option[value="Gaji"]').remove();
      $('#kategori').append(new Option('Hutang', 'Hutang'));
      $('#kategori').append(new Option('Sandang', 'Sandang'));
      $('#kategori').append(new Option('Pangan', 'Pangan'));
      $('#kategori').append(new Option('Papan', 'Papan'));
      $('#kategori').append(new Option('Pendidikan', 'Pendidikan'));
      $('#kategori').append(new Option('Transportasi', 'Transportasi'));
      $('#kategori').append(new Option('Komunikasi', 'Komunikasi'));
      $('#kategori').append(new Option('Jajan', 'Jajan'));
      $('#kategori').append(new Option('Kebutuhan Bulanan', 'Kebutuhan Bulanan'));
      $('#kategori option[value="Lainnya"]').remove();
      $('#kategori').append(new Option('Lainnya', 'Lainnya'));
    }
  })

  // insert ajax
  $('#formKas').on('submit', (e) => {
    e.preventDefault();

    const formData = $('#formKas').serialize();
    
    $.ajax({
      url: '<?= BASEURL . "/kas_kita/catat_kas" ?>',
      type: 'POST',
      data: formData,
      success: function(res) {
        if(res == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil mencatat kas baru',
            showConfirmButton: true,
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal mencatat kas baru !',
            text: res,
            showConfirmButton: true,
          })
        }
      }
    });
  });
  // insert ajax

  // delete
  function deleteKas(id) {
    Swal.fire({
      title: 'Beneran hapus nih?',
      text: 'Datanya dihapus permanen lho..',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya',
      cancelButtonText: 'Gak jadi',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '<?= BASEURL . "/kas_kita/delete_kas/" ?>' + id,
          type: 'POST',
          success: function(res) {
            if(res == 'success') {
              Swal.fire({
                icon: 'success',
                title: 'Berhasil menghapus catatan kas',
                showConfirmButton: true,
              }).then(() => {
                window.location = '<?= BASEURL . "/kas_kita" ?>'
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Gagal menghapus catatan kas !',
                text: res,
                showConfirmButton: true,
              })
            }
          }
        });
      }
    })
  }
  // delete

  // laporan
  $('#formSiklus').on('submit', (e) => {
    e.preventDefault();

    const formData = $('#formSiklus').serialize();
    
    $.ajax({
      url: '<?= BASEURL . "/kas_kita/laporan_kas" ?>',
      type: 'POST',
      data: formData,
      success: function(res) {
        const responses = JSON.parse(res).kasDetail;
        $('.tbodyReport').empty();
        $('.tfootReport').empty();
        let no = 1;
        let totalKasMasuk = 0;
        let totalKasKeluar = 0;
        $.each(responses, (key, value) => {
          const tr = $('<tr></tr>');
          const td1 = tr.append('<td class="text-center align-middle">'+ no++ +'</td>');
          const td2 = tr.append('<td class="text-center align-middle">'+ new Date(value.tanggal).toLocaleDateString("id") +'</td>');
          const td3 = tr.append('<td class="text-center align-middle">'+ value.kategori +'</td>');
          const td4 = tr.append('<td class="text-center align-middle">'+ value.keterangan +'</td>');
          const td5 = tr.append('<td class="text-end align-middle">'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value.pemasukan) +'</td>');
          const td6 = tr.append('<td class="text-end align-middle">'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value.pengeluaran) +'</td>');
          
          totalKasMasuk += Number(value.pemasukan);
          totalKasKeluar += Number(value.pengeluaran);

          tr.append(td1);
          tr.append(td2);
          tr.append(td3);
          tr.append(td4);
          tr.append(td5);
          tr.append(td6);
          $('.tbodyReport').append(tr);
        });

        const tr = $('<tr></tr>');
        const td1 = tr.append('<td colspan="4"><b>Total</b></td>')
        const td2 = tr.append('<td class="text-end"><b>'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasMasuk) +'</b></td>')
        const td3 = tr.append('<td class="text-end"><b>'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasKeluar) +'</b></td>')
        $('.tfootReport').append(tr);
        $('.textSaldo').html('Saldo : ' + new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasMasuk - totalKasKeluar));
      }
    });
  });
  // laporan
</script>