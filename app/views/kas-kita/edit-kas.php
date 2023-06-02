<h3 class="text-center my-3 font-third"><i class="bi bi-cash-coin text-muted"></i> KAS KELUARGA <?= strtoupper($_SESSION['userInfo']['username']) ?> <i class="bi bi-wallet2 text-muted"></i></h3>
  <div class="card border-primary">
    <div class="card-header bg-primary">
      <h5 class="text-white">Edit <?= $data['kas'][0]['pengeluaran'] != NULL ? 'Pengeluaran' : 'Pemasukan' ?></h5>
    </div>
    <div class="card-body">
      <form id="formEditPengeluaran">
      <input type="hidden" name="id" value="<?= $data['kas'][0]['id'] ?>">
      <input type="hidden" name="arusKas" value="<?= $data['kas'][0]['pengeluaran'] != NULL ? 'Kas Keluar' : 'Kas Masuk' ?>">

      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" class="form-control mb-3" name="tanggal" value="<?= $data['kas'][0]['tanggal'] ?>" required>

      <label for="kategori" class="form-label">Kategori</label>
      <select name="kategori" id="kategori" class="form-select mb-3" name="kategori" required>
        <option value="<?= $data['kas'][0]['kategori'] ?>"><?= $data['kas'][0]['kategori'] ?></option>
        <?php if($data['kas'][0]['pengeluaran'] != NULL ) : ?>
          <option value="" disabled>Pilih Kategori</option>
          <option value="Hutang">Hutang</option>
          <option value="Sandang">Sandang</option>
          <option value="Pangan">Pangan</option>
          <option value="Papan">Papan</option>
          <option value="Pendidikan">Pendidikan</option>
          <option value="Transportasi">Transportasi</option>
          <option value="Komunikasi">Komunikasi</option>
          <option value="Jajan">Jajan</option>
          <option value="Kebutuhan Bulanan">Kebutuhan Bulanan</option>
          <option value="Lainnya">Lainnya</option>
        <?php else : ?>
          <option value="Gaji">Gaji</option>
          <option value="Lainnya">Lainnya</option>
        <?php endif; ?>
      </select>

      <label for="keterangan" class="form-label">Keterangan</label>
      <textarea class="form-control mb-3" name="keterangan" id="keterangan" name="keterangan" required><?= $data['kas'][0]['keterangan'] ?></textarea>

      <label for="jumlah" class="form-label">Jumlah</label>
      <div class="input-group mb-3">
        <span class="input-group-text">Rp.</span>
        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $data['kas'][0]['pengeluaran'] != NULL ? $data['kas'][0]['pengeluaran'] : $data['kas'][0]['pemasukan'] ?>" required>
      </div>

      <a href="<?= BASEURL . '/kas_kita' ?>" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
      <button type="submit" class="btn btn-primary btn-sm float-end">Update</button>
    </form>
    </div>
  </div>
</div>

<script>
  // udpate ajax
  $('#formEditPengeluaran').on('submit', (e) => {
    e.preventDefault();

    const formData = $('#formEditPengeluaran').serialize();
    
    $.ajax({
      url: '<?= BASEURL . "/kas_kita/update_kas" ?>',
      type: 'POST',
      data: formData,
      success: function(res) {
        if(res == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil merubah catatan kas',
            showConfirmButton: true,
          }).then(() => {
            window.location = '<?= BASEURL . "/kas_kita" ?>'
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal merubah catatan kas !',
            text: res,
            showConfirmButton: true,
          })
        }
      }
    });
  });
  // update ajax
</script>