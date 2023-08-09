<h3 class="text-center my-3 font-third"><i class="bi bi-cash-coin text-muted"></i> KAS KELUARGA <?= strtoupper($_SESSION['userInfo']['username']) ?> <i class="bi bi-wallet2 text-muted"></i></h3>
  <div class="card border-dark">
    <div class="card-header bg-dark">
      <h5 class="text-white"><i class="bi bi-pencil-fill"></i> Edit <?= $data['kas'][0]['pengeluaran'] != NULL ? 'Pengeluaran' : 'Pemasukan' ?></h5>
    </div>
    <div class="card-body">
      <form id="formEditPengeluaran">
      <input type="hidden" name="id" value="<?= $data['kas'][0]['id'] ?>">
      <input type="hidden" name="arusKas" value="<?= $data['kas'][0]['pengeluaran'] != NULL ? 'Pengeluaran' : 'Pemasukan' ?>">

      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" class="form-control mb-3" name="tanggal" value="<?= $data['kas'][0]['tanggal'] ?>" required>

      <label for="kategori" class="form-label">Kategori</label>
      <select name="kategori" id="kategori" class="form-select mb-3" name="kategori" required>
        <option value="<?= $data['kas'][0]['kategori'] ?>"><?= $data['kas'][0]['kategori'] ?></option>
        <script>
          $.ajax({
            url: '<?= BASEURL . "/categories/getCategories" ?>',
            type: 'POST',
            data: 'jenis_kategori=' + '<?= $data['kas'][0]['pengeluaran'] != NULL ? 'Pengeluaran' : 'Pemasukan' ?>',
            success: function(res) {
              const categories = JSON.parse(res);

              // $('#kategori').empty();
              $('#kategori').append(new Option('Pilih Kategori', ''));
              
              for(category of categories) {
                $('#kategori').append(new Option(category.nama_kategori, category.nama_kategori));
              }
            }
          });
        </script>
      </select>

      <label for="keterangan" class="form-label">Keterangan</label>
      <textarea class="form-control mb-3" name="keterangan" id="keterangan" name="keterangan" required><?= $data['kas'][0]['keterangan'] ?></textarea>

      <label for="jumlah" class="form-label">Jumlah</label>
      <div class="input-group mb-3">
        <span class="input-group-text">Rp.</span>
        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $data['kas'][0]['pengeluaran'] != NULL ? $data['kas'][0]['pengeluaran'] : $data['kas'][0]['pemasukan'] ?>" required>
      </div>

      <button type="submit" class="btn btn-success btn-sm float-end ms-1"><i class="bi bi-cloud-arrow-up"></i> Update</button>
      <a href="<?= BASEURL . '/kas_kita' ?>" class="btn btn-secondary btn-sm float-end"><i class="bi bi-arrow-left"></i> Back</a>
    </form>
    </div>
  </div>
</div>

<script>
  // udpate ajax
  $('#formEditPengeluaran').on('submit', (e) => {
    e.preventDefault();
    
    if($('#kategori').val() == '') {
      Swal.fire({
        icon: 'error',
        title: 'Kategori wajib dipilih !',
        showConfirmButton: true,
      });
    } else {
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
              location.reload();
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
    }
  });
  // update ajax
</script>