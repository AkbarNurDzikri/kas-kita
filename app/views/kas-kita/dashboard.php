<h3 class="text-center my-3 font-third"><i class="bi bi-currency-exchange"></i><i class="bi bi-card-checklist"></i> Catatan Kas <?= $_SESSION['userInfo']['username'] ?> &nbsp;</h3>
<hr> <hr style="margin-top: -15px;">
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
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="logoutButton" type="button" role="tab" aria-controls="logout-tab-pane" aria-selected="false">Logout</button>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <!-- pengeluaran -->
  <div class="tab-pane fade show active" id="pengeluaran-tab-pane" role="tabpanel" aria-labelledby="pengeluaran-tab" tabindex="0">
    <button class="btn btn-primary btn-sm my-3" data-bs-toggle="modal" data-bs-target="#buatKas"><i class="bi bi-pencil"></i> Buat Kas</button>
    <button class="btn btn-light btn-sm triggerModalPengeluaran" data-bs-toggle="modal" data-bs-target="#filterPengeluaran"><i class="bi bi-search"></i> Show Data</button>
    <div class="card border-dark">
      <div class="card-body table-responsive">
        <table class="table table-striped table-bordered caption-top" id="tablePengeluaran">
          <caption id="totalPengeluaran"></caption>
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Kas Keluar</th>
              <th>Keterangan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody id="tbodyPengeluaran">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- pengeluaran -->

  <!-- pemasukan -->
  <div class="tab-pane fade" id="pemasukan-tab-pane" role="tabpanel" aria-labelledby="pemasukan-tab" tabindex="0">
    <button class="btn btn-primary btn-sm my-3" data-bs-toggle="modal" data-bs-target="#buatKas"><i class="bi bi-pencil"></i> Buat Kas</button>
    <button class="btn btn-light btn-sm triggerModalPemasukan" data-bs-toggle="modal" data-bs-target="#filterPemasukan"><i class="bi bi-search"></i> Show Data</button>
    <div class="card border-dark">
      <div class="card-body table-responsive">
        <table class="table table-striped table-bordered caption-top" id="tablePemasukan">
          <caption id="totalPemasukan"></caption>
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Kas Masuk</th>
              <th>Keterangan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody id="tbodyPemasukan">
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- pemasukan -->

  <!-- Laporan -->
  <div class="tab-pane fade" id="laporan-tab-pane" role="tabpanel" aria-labelledby="laporan-tab" tabindex="0">
    <button type="submit" class="btn btn-primary btn-sm my-3" data-bs-toggle="modal" data-bs-target="#modalReport"><i class="bi bi-search"></i> Generate Report</button>
    
    <div class="card border-dark">
      <div class="card-body table-responsive">
        <table class="table table-striped table-bordered caption-top tableReport">
          <caption class="textSaldo"></caption>
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Kas Masuk</th>
              <th>Kas Keluar</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody class="tbodyReport">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Form Filter Pengeluaran -->
<div class="modal fade" id="filterPengeluaran" tabindex="-1" data-bs-backdrop="static" aria-labelledby="filterPengeluaranLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="filterPengeluaranLabel"><i class="bi bi-funnel"></i> Filter Kas Keluar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formFilterPengeluaran">
          <label for="nama_kategori_filter" class="form-label">Kategori</label>
          <select name="nama_kategori_filter" id="nama_kategori_filter" class="form-select mb-3" required>
          </select>

          <label for="date_range" class="form-label">Rentang Tanggal</label>
          <div class="input-group">
            <input type="date" class="form-control" name="pengeluaran_mulai" id="pengeluaranMulai" required>
            <span class="input-group-text">s.d.</span>
            <input type="date" class="form-control" name="pengeluaran_sampai" id="pengeluaranSampai" required>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Tampilkan Data</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Form Filter Pengeluaran -->

<!-- Form Filter Pemasukan -->
<div class="modal fade" id="filterPemasukan" tabindex="-1" data-bs-backdrop="static" aria-labelledby="filterPemasukanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="filterPemasukanLabel"><i class="bi bi-funnel"></i> Filter Kas Masuk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formFilterPemasukan">
          <label for="nama_kategori_filter_pemasukan" class="form-label">Kategori</label>
          <select name="nama_kategori_filter_pemasukan" id="nama_kategori_filter_pemasukan" class="form-select mb-3" required>
          </select>

          <label for="date_range" class="form-label">Rentang Tanggal</label>
          <div class="input-group">
            <input type="date" class="form-control" name="pemasukan_mulai" id="pemasukanMulai" required>
            <span class="input-group-text">s.d.</span>
            <input type="date" class="form-control" name="pemasukan_sampai" id="pemasukanSampai" required>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Tampilkan Data</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Form Filter Pemasukan -->

<!-- Form Report -->
<div class="modal fade" id="modalReport" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalReportLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalReportLabel"><i class="bi bi-calendar2-day"></i> Generate Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formReport">
          <label for="date_range" class="form-label">Rentang Tanggal</label>
          <div class="input-group">
            <input type="date" class="form-control" name="tglMulaiLaporan" id="tglMulaiLaporan" required>
            <span class="input-group-text">s.d.</span>
            <input type="date" class="form-control" name="tglSelesaiLaporan" id="tglSelesaiLaporan" required>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="bi bi-hand-index-thumb"></i> Lihat Laporan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- Form Report -->

<!-- Modal Buat Kas -->
<div class="modal fade" id="buatKas" tabindex="-1" data-bs-backdrop="static" aria-labelledby="buatKasLabel" aria-hidden="true">
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
            <option value="Pemasukan">Kas Masuk</option>
            <option value="Pengeluaran">Kas Keluar</option>
          </select>
          
          <label for="tanggal" class="form-label">Tanggal</label>
          <input type="date" class="form-control mb-3" name="tanggal" required>

          <label class="form-label" for="kategori">Kategori</label>
          <select name="kategori" id="kategori" class="form-select mb-3" required>
            <option value="" disabled selected>Pilih Kategori</option>
          </select>

          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea class="form-control mb-3" name="keterangan" id="keterangan" required></textarea>

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
</div>
<!-- Modal Buat Kas -->

<!-- Modal Edit Kas -->
<div class="modal fade" id="editKas" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editKasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editKasLabel">Edit Catatan Kas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formKasEdit">
          <label for="arusKasEdit" class="form-label">Jenis Kas</label>
          <select name="arusKasEdit" id="arusKasEdit" class="form-select mb-3" required>
            <option value="" disabled selected>Pilih Arus Kas</option>
            <option value="Pemasukan">Kas Masuk</option>
            <option value="Pengeluaran">Kas Keluar</option>
          </select>
          
          <label for="tanggalEdit" class="form-label">Tanggal</label>
          <input type="date" class="form-control mb-3" name="tanggalEdit" id="tanggalEdit" required>

          <label class="form-label" for="kategoriEdit">Kategori</label>
          <select name="kategoriEdit" id="kategoriEdit" class="form-select mb-3" required>
            <option value="" disabled selected>Pilih Kategori</option>
          </select>

          <label for="keteranganEdit" class="form-label">Keterangan</label>
          <textarea class="form-control mb-3" name="keteranganEdit" id="keteranganEdit" required></textarea>

          <label for="jumlahEdit" class="form-label">Jumlah</label>
          <div class="input-group mb-3">
            <span class="input-group-text">Rp.</span>
            <input type="number" class="form-control" id="jumlahEdit" name="jumlahEdit" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Edit Kas -->

<!-- Buat Kategori -->
<div class="modal fade" id="buatKategori" tabindex="-1" data-bs-backdrop="static" aria-labelledby="buatKategoriLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-bg-dark">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h1 class="modal-title fs-5 text-white" id="buatKategoriLabel">Tambah Kategori</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark">
        <form id="formKategori">          
          <label for="nama_kategori" class="form-label text-white">Nama Kategori</label>
          <input type="text" class="form-control mb-3" name="nama_kategori" id="nama_kategori" autocomplete="off" required>
          
          <label for="jenis_kategori" class="form-label text-white">Jenis Kategori</label>
          <select name="jenis_kategori" id="jenis_kategori" class="form-select" required>
            <option value="Pemasukan">Pemasukan</option>
            <option value="Pengeluaran">Pengeluaran</option>
          </select>
        </div>
        <div class="modal-footer bg-dark">
          <button type="submit" class="btn btn-light">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Buat Kategori -->

<!-- Edit Kategori -->
<div class="modal fade" id="editKategori" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editKategoriLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-bg-dark">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h1 class="modal-title fs-5 text-white" id="editKategoriLabel">Edit Kategori</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-dark">
        <form id="formEditKategori">
          <label for="pilih_kategori" class="form-label text-white">Pilih Nama Kategori</label>
          <select name="pilih_kategori" id="pilih_kategori" class="form-select mb-3">
            <!-- Diisi jquery -->
          </select>

          <label for="nama_kategori_edit" class="form-label text-white d-none" id="label_nama_kategori_edit">Ubah Menjadi</label>
          <input type="text" class="form-control mb-3 d-none" name="nama_kategori_edit" id="nama_kategori_edit" autocomplete="off" required>
        </div>
        <div class="modal-footer bg-dark">
          <button type="submit" class="btn btn-light">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Kategori -->

<script>
  $('#arusKas').on('change', () => {
    if($('#arusKas').find(':selected').val() == 'Pemasukan') {
      $('#nama_kategori').attr('placeholder', 'Gaji Bulanan');
      $('#jenis_kategori').val('Pemasukan');
    } else {
      $('#nama_kategori').attr('placeholder', 'Kebutuhan Bulanan');
      $('#jenis_kategori').val('Pengeluaran');
    }
    
    $.ajax({
      url: '<?= BASEURL . "/categories/getCategories" ?>',
      type: 'POST',
      data: 'jenis_kategori=' + $('#arusKas').find(':selected').val(),
      success: function(res) {
        const categories = JSON.parse(res);

        $('#kategori').empty();
        $('#kategori').append(new Option('Pilih Kategori', ''));
        
        for(category of categories) {
          $('#kategori').append(new Option(category.nama_kategori, category.nama_kategori));
        }

        $('#kategori').append(new Option('--Tambah Kategori--', '+ Kategori'));
        $('#kategori').append(new Option('--Edit Kategori--', 'Edit Kategori'));
      }
    });
  });

  // tampilkan modal create update kategori
  $('#kategori').on('change', () => {
    if($('#kategori').find(':selected').val() == '+ Kategori') {
      $('#buatKategori').modal('show');
    } else if($('#kategori').find(':selected').val() == 'Edit Kategori') {
      $('#editKategori').modal('show');
      $('#label_nama_kategori_edit').hide();
      $('#nama_kategori_edit').hide();
      $('#nama_kategori_edit').val('');

      $.ajax({
        url: '<?= BASEURL . "/categories/getCategories" ?>',
        type: 'POST',
        data: 'jenis_kategori=' + $('#arusKas').find(':selected').val(),
        success: function(res) {
          const categories = JSON.parse(res);

          $('#pilih_kategori').empty();
          $('#pilih_kategori').append(new Option('Pilih Kategori', ''));

          for(category of categories) {
            $('#pilih_kategori').append(new Option(category.nama_kategori, category.nama_kategori));
          }
        }
      });
    }
  });
  // tampilkan modal create update kategori

  // tampilkan semua data kategori untuk dipilih user sebagai data yang akan diubah
  $('#pilih_kategori').on('change', () => {
    if($('#pilih_kategori').find(':selected').val() == '') {
      $('#label_nama_kategori_edit').hide();
      $('#nama_kategori_edit').hide();
    } else {
      $('#nama_kategori_edit').val($('#pilih_kategori').find(':selected').val());
      $('#label_nama_kategori_edit').removeClass('d-none');
      $('#nama_kategori_edit').removeClass('d-none');
      $('#label_nama_kategori_edit').show();
      $('#nama_kategori_edit').show();
    }
  });
  // tampilkan semua data kategori untuk dipilih user sebagai data yang akan diubah

  // create kategori
  $('#formKategori').on('submit', (e) => {
    e.preventDefault();

    $.ajax({
      url: '<?= BASEURL . "/categories/create" ?>',
      type: 'POST',
      data: $('#formKategori').serialize(),
      success: function(res) {
        if(res == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil menambah kategori baru',
            showConfirmButton: true,
          }).then(() => {
            $('#buatKategori').modal('hide');
            $('#nama_kategori').val('');

            $('#kategori').empty();
            $('#kategori').append(new Option('Pilih Kategori', ''));

            $.ajax({
              url: '<?= BASEURL . "/categories/getCategories" ?>',
              type: 'POST',
              data: 'jenis_kategori=' + $('#arusKas').find(':selected').val(),
              success: function(res) {
                const categories = JSON.parse(res);

                $('#kategori').empty();
                $('#kategori').append(new Option('Pilih Kategori', ''));
                
                for(category of categories) {
                  $('#kategori').append(new Option(category.nama_kategori, category.nama_kategori));
                }

                $('#kategori').append(new Option('--Tambah Kategori--', '+ Kategori'));
                $('#kategori').append(new Option('--Edit Kategori--', 'Edit Kategori'));
              }
            });
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Harus unik !',
            html: 'Nama kategori <b>"' + $('#nama_kategori').val() + '"</b> sudah ada !',
            showConfirmButton: true,
          });
        }
      }
    });
  });
  // create kategori

  // update kategori
  $('#formEditKategori').on('submit', (e) => {
    e.preventDefault();

    $.ajax({
      url: '<?= BASEURL . "/categories/update" ?>',
      type: 'POST',
      data: $('#formEditKategori').serialize(),
      success: function(res) {
        if(res == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil merubah kategori',
            showConfirmButton: true,
          }).then(() => {
            $('#editKategori').modal('hide');
            $('#nama_kategori').val('');

            $('#kategori').empty();
            $('#kategori').append(new Option('Pilih Kategori', ''));

            $.ajax({
              url: '<?= BASEURL . "/categories/getCategories" ?>',
              type: 'POST',
              data: 'jenis_kategori=' + $('#arusKas').find(':selected').val(),
              success: function(res) {
                const categories = JSON.parse(res);

                $('#kategori').empty();
                $('#kategori').append(new Option('Pilih Kategori', ''));
                
                for(category of categories) {
                  $('#kategori').append(new Option(category.nama_kategori, category.nama_kategori));
                }

                $('#kategori').append(new Option('--Tambah Kategori--', '+ Kategori'));
                $('#kategori').append(new Option('--Edit Kategori--', 'Edit Kategori'));
              }
            });
          });
        } else if(res == 'is duplicate') {
          Swal.fire({
            icon: 'error',
            title: 'Harus unik !',
            html: 'Nama kategori <b>"' + $('#nama_kategori_edit').val() + '"</b> sudah ada !',
            showConfirmButton: true,
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            html: '<p><b>Kode Kesalahan :</b></p> <p>'+res+'</p>',
            showConfirmButton: true,
          });
        }
      }
    });
  });
  // update kategori

  // create kas
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
  // create kas

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
                location.reload();
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
  $('#formReport').on('submit', (e) => {
    e.preventDefault();

    const formData = $('#formReport').serialize();
    
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
          const tr1 = $('<tr></tr>');
          tr1.append('<td class="text-center align-middle">'+ no++ +'</td>');
          tr1.append('<td class="text-center align-middle">'+ new Date(value.tanggal).toLocaleDateString("id") +'</td>');
          tr1.append('<td class="text-center align-middle">'+ value.kategori +'</td>');
          tr1.append('<td class="text-end align-middle">'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value.pemasukan) +'</td>');
          tr1.append('<td class="text-end align-middle">'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value.pengeluaran) +'</td>');
          tr1.append('<td class="text-center align-middle">'+ value.keterangan +'</td>');
          
          totalKasMasuk += Number(value.pemasukan);
          totalKasKeluar += Number(value.pengeluaran);

          $('.tbodyReport').append(tr1);
        });

        $('.textSaldo').html('<b>Laporan Kas Periode ' + new Date($('#tglMulaiLaporan').val()).toLocaleDateString("id", {day: "numeric", month: "long", year: "numeric"}) +
          ' - ' + new Date($('#tglSelesaiLaporan').val()).toLocaleDateString("id", {day: "numeric", month: "long", year: "numeric"}) + '</b> <br>' +
          '<span class="text-primary">Total Kas Masuk</span> : <b class="text-primary">' + new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasMasuk) + '</b> | ' +
          '<span class="text-danger">Total Kas Keluar</span> : <b class="text-danger">' + new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasKeluar) + '</b> | ' +
          'Sisa Saldo : <b>' + new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasMasuk - totalKasKeluar) + '</b>');
      }
    });

    $('#modalReport').modal('hide');
  });
  // laporan

  $('.triggerModalPengeluaran').on('click', () => {
    $.ajax({
      url: '<?= BASEURL . "/categories/getCategories" ?>',
      type: 'POST',
      data: 'jenis_kategori=Pengeluaran',
      success: function(res) {
        const categories = JSON.parse(res);

        $('#nama_kategori_filter').empty();
        $('#nama_kategori_filter').append(new Option('Pilih Kategori', ''));
        
        for(category of categories) {
          $('#nama_kategori_filter').append(new Option(category.nama_kategori, category.nama_kategori));
        }

        $('#nama_kategori_filter').append(new Option('Semua Kategori', 'All Categories'));
      }
    });
  });

  $('.triggerModalPemasukan').on('click', () => {
    $.ajax({
      url: '<?= BASEURL . "/categories/getCategories" ?>',
      type: 'POST',
      data: 'jenis_kategori=Pemasukan',
      success: function(res) {
        const categories = JSON.parse(res);

        $('#nama_kategori_filter_pemasukan').empty();
        $('#nama_kategori_filter_pemasukan').append(new Option('Pilih Kategori', ''));
        
        for(category of categories) {
          $('#nama_kategori_filter_pemasukan').append(new Option(category.nama_kategori, category.nama_kategori));
        }

        $('#nama_kategori_filter_pemasukan').append(new Option('Semua Kategori', 'All Categories'));
      }
    });
  });

  // tampilkan data pengeluaran
  $('#formFilterPengeluaran').on('submit', (e) => {
    e.preventDefault();

    $.ajax({
      url: '<?= BASEURL . "/kas_kita/kasKeluar" ?>',
      type: 'POST',
      data: $('#formFilterPengeluaran').serialize(),
      success: function(res) {
        const responses = JSON.parse(res);

        $('#tbodyPengeluaran').empty();
        
        let no = 1;
        let totalKasKeluar = 0;
        $.each(responses, (key, value) => {
          const tr = $('<tr></tr>');
          tr.append('<td class="text-center align-middle">'+ no++ +'</td>');
          tr.append('<td class="text-center align-middle">'+ new Date(value.tanggal).toLocaleDateString("id") +'</td>');
          tr.append('<td class="text-center align-middle">'+ value.kategori +'</td>');
          tr.append('<td class="text-end align-middle">'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value.pengeluaran) +'</td>');
          tr.append('<td class="text-center align-middle">'+ value.keterangan +'</td>');
          tr.append('<td class="text-center align-middle">'+
            '<a href="<?= BASEURL . '/kas_kita/edit_kas/' ?>'+ value.id +'" class="btn btn-primary btn-sm mb-1 d-block"><i class="bi bi-pencil-square"></i></a>'+
            '<a href="#" class="btn btn-danger btn-sm d-block" onClick="deleteKas('+value.id+')"><i class="bi bi-trash"></i></a>'+
          '</td>');
          totalKasKeluar += Number(value.pengeluaran);

          $('#tbodyPengeluaran').append(tr);
        });

        $('#totalPengeluaran').html('Total Kas Keluar : <b>' +
          new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasKeluar) + '</b> <br> Periode ' +
          new Date($('#pengeluaranMulai').val()).toLocaleDateString("id", {day: "numeric", month: "long", year: "numeric"}) +
          ' - ' + new Date($('#pengeluaranSampai').val()).toLocaleDateString("id", {day: "numeric", month: "long", year: "numeric"}));
      }
    });

    $('#filterPengeluaran').modal('hide');
  });
  // tampilkan data pengeluaran

  // tampilkan data pemasukan
  $('#formFilterPemasukan').on('submit', (e) => {
    e.preventDefault();

    $.ajax({
      url: '<?= BASEURL . "/kas_kita/kasMasuk" ?>',
      type: 'POST',
      data: $('#formFilterPemasukan').serialize(),
      success: function(res) {
        const responses = JSON.parse(res);

        $('#tbodyPemasukan').empty();
        
        let no = 1;
        let totalKasMasuk = 0;
        $.each(responses, (key, value) => {
          const tr = $('<tr></tr>');
          tr.append('<td class="text-center align-middle">'+ no++ +'</td>');
          tr.append('<td class="text-center align-middle">'+ new Date(value.tanggal).toLocaleDateString("id") +'</td>');
          tr.append('<td class="text-center align-middle">'+ value.kategori +'</td>');
          tr.append('<td class="text-end align-middle">'+ new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value.pemasukan) +'</td>');
          tr.append('<td class="text-center align-middle">'+ value.keterangan +'</td>');
          tr.append('<td class="text-center align-middle">'+
            '<a href="<?= BASEURL . '/kas_kita/edit_kas/' ?>'+ value.id +'" class="btn btn-primary btn-sm mb-1 d-block"><i class="bi bi-pencil-square"></i></a>'+
            '<a href="#" class="btn btn-danger btn-sm d-block" onClick="deleteKas('+value.id+')"><i class="bi bi-trash"></i></a>'+
          '</td>');
          totalKasMasuk += Number(value.pemasukan);

          $('#tbodyPemasukan').append(tr);
        });

        $('#totalPemasukan').html('Total Kas Masuk : <b>' +
          new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(totalKasMasuk) + '</b> <br> Periode ' +
          new Date($('#pemasukanMulai').val()).toLocaleDateString("id", {day: "numeric", month: "long", year: "numeric"}) +
          ' - ' + new Date($('#pemasukanSampai').val()).toLocaleDateString("id", {day: "numeric", month: "long", year: "numeric"}));
      }
    });

    $('#filterPemasukan').modal('hide');
  });
  // tampilkan data pemasukan

  // Logout
  $('#logoutButton').on('click', () => {
    Swal.fire({
      title: 'Mau keluar?',
      text: 'Klik OK untuk keluar',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'OK',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = '<?= BASEURL . "/auth/logout" ?>';
      }
    })
  });
  // Logout
</script>