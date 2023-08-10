<div class="row my-3">
  <div class="col-md">
    <h1 class="font-third text-center my-3">Edit Details Laporan Recycle</h1>
    <h5 class="text-muted text-center font-third" style="margin-top: -15px;">User Logged in as : <?= $_SESSION['userInfo']['fullname'] ?></h5>

  <a href="<?= BASEURL . '/laporan/details/' . $data['reportDetails']['report_id'] ?>" class="btn btn-sm btn-secondary">&larr; Kembali</a>
  </div>
</div>

<div class="row">
  <div class="col-md">
    <form id="formDetailLaporan">
      <input type="hidden" name="id" value="<?= $data['reportDetails']['id'] ?>">
      <!-- <input type="hidden" name="report_id" value="<?= $data['reportDetails']['report_id'] ?>"> -->
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="time_start" class="form-label">Mulai Proses</label>
              <input type="time" class="form-control" id="time_start" name="time_start" value="<?= $data['reportDetails']['time_start'] ?>" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="time_finish" class="form-label">Selesai Proses</label>
              <input type="time" class="form-control" id="time_finish" name="time_finish" value="<?= $data['reportDetails']['time_finish'] ?>" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="remarks">Keterangan (Jika ada)</label>
              <textarea name="remarks" id="remarks" class="form-control" placeholder="Tulis keterangan singkat padat dan jelas"><?= $data['reportDetails']['remarks'] ?></textarea>
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
                      <textarea class="form-control" name="bm1_material_specs" id="bm1_material_specs" placeholder="Contoh : Spelid 25 x 730"><?= $data['reportDetails']['bm1_material_specs'] ?></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md">
                      <label for="bm1_material_qty" class="form-label">Material Qty</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="bm1_material_qty" name="bm1_material_qty" value="<?= $data['reportDetails']['bm1_material_qty'] ?>" step=".01">
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
                      <textarea class="form-control" name="bm2_material_specs" id="bm2_material_specs" placeholder="Contoh : Spelid 25 x 730"><?= $data['reportDetails']['bm2_material_specs'] ?></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md">
                      <label for="bm2_material_qty" class="form-label">Material Qty</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="bm2_material_qty" name="bm2_material_qty" value="<?= $data['reportDetails']['bm2_material_qty'] ?>" step=".01">
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
                  <h5>Others Material</h5>
                </div>
                <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                      <label for="other_material_specs" class="form-label">Material Spec</label>
                      <textarea class="form-control" name="other_material_specs" id="other_material_specs" placeholder="Contoh : Spelid 25 x 730"><?= $data['reportDetails']['other_material_specs'] ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="other_material_qty" class="form-label">Qty Material</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="other_material_qty" name="other_material_qty" value="<?= $data['reportDetails']['other_material_qty'] ?>" step=".01">
                        <span class="input-group-text">Kg</span>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md mb-3">
                      <label for="other_material_type" class="form-label">Jenis Material</label>
                      <select name="other_material_type" id="other_material_type" class="form-select">
                        <option value="<?= $data['reportDetails']['other_material_type'] ?>"><?= $data['reportDetails']['other_material_type'] ?></option>
                        <option value="" disabled>Pilih Jenis Material</option>
                        <option value="Trim">Trim</option>
                        <option value="Roll">Roll</option>
                        <option value="Sesetan">Sesetan</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="other_material_category" class="form-label">Kategori Material</label>
                        <select name="other_material_category" id="other_material_category" class="form-select">
                          <option value="<?= $data['reportDetails']['other_material_category'] ?>"><?= $data['reportDetails']['other_material_category'] ?></option>
                          <option value="" disabled>Pilih Kategori Material</option>
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
                        <option value="<?= $data['reportDetails']['product_type'] ?>"><?= $data['reportDetails']['product_type'] ?></option>
                        <option value="" disabled>Pilih Jenis Produk</option>
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
                        <input type="number" class="form-control" id="product_qty" name="product_qty" value="<?= $data['reportDetails']['product_qty'] ?>" required step=".01">
                        <span class="input-group-text">Kg</span>
                      </div>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="waste_type" class="form-label">Waste Proses (Jika ada)</label>
                      <select name="waste_type" id="waste_type" class="form-select">
                        <option value="<?= $data['reportDetails']['waste_type'] ?>"><?= $data['reportDetails']['waste_type'] ?></option>
                        <option value="" disabled>Pilih Jenis Waste</option>
                        <option value="Powder">Powder</option>
                        <option value="Frozen">Frozen</option>
                      </select>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="waste_qty" class="form-label">Qty Waste (Jika ada)</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="waste_qty" name="waste_qty" value="<?= $data['reportDetails']['waste_qty'] ?>" step=".01">
                        <span class="input-group-text">Kg</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md">
              <button type="submit" class="btn btn-primary float-end"><i class="bi bi-sd-card"></i> Update</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  // update ajax laporan details
  $('#formDetailLaporan').on('submit', (e) => {
    e.preventDefault();

    const formData = $('#formDetailLaporan').serialize();
    
    $.ajax({
      url: '<?= BASEURL . "/laporan/update_details" ?>',
      type: 'POST',
      data: formData,
      success: function(res) {
        if(res == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil mengupdate detail laporan',
            showConfirmButton: true,
          }).then(() => {
            location.href = '<?= BASEURL . "/laporan/details/" .$data['reportDetails']['report_id'] ?>';
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: ' Gagal mengupdate detail laporan !',
            text: res,
            showConfirmButton: true,
          })
        }
      }
    });
  });
  // update ajax laporan details

  // show or hide cards
  const mesin = '<?= $data['reportDetails']['machine'] ?>';
  function cardMaterialBlownMachines() {
    if(mesin == 'YEI') {
      $('#cardMaterialBlownMachines').hide();
    } else {
      $('#cardMaterialBlownMachines').show();
    }
  };

  cardMaterialBlownMachines();
  // show or hide cards
</script>