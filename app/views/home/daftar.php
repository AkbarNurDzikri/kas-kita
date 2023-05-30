<div class="row my-3">
  <div class="col-12 col-md-6" id="colForm">
    <div class="card border-primary">
      <div class="card-header bg-white">
        <a href="<?= BASEURL . '/home/login' ?>" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Login</a>
      </div>
      <div class="card-body">
        <h1 class="card-title text-center text-primary font-primary" style="font-size: 35px; margin-bottom: -10px;">Kas Kita</h1>
        <p class="text-center text-primary text-muted" style="font-size: 30px;">Buat Akun</p>
        <form id="myForm">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control mb-3" id="username" name="username" autocomplete="off" required>

          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control mb-3" id="email" name="email" autocomplete="off" required>

          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control mb-3" id="password" name="password" required>

          <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control mb-3" id="confirmPassword" name="confirmPassword" required>

          <button type="submit" class="btn btn-primary btn-sm float-end btnSave"><i class="bi bi-sd-card"></i> Daftar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#myForm').on('submit', (e) => {
    e.preventDefault();

    if($('#password').val().length < 6) {
      Swal.fire({
        icon: 'error',
        title: 'Minimal password 6 karakter !',
        showConfirmButton: true,
      });
    } else if($('#confirmPassword').val() !== $('#password').val()) {
      Swal.fire({
        icon: 'error',
        title: 'Konfirmasi password tidak sesuai !',
        showConfirmButton: true,
      });
    } else {
      $.ajax({
        url: '<?= BASEURL . "/users/create" ?>',
        type: 'POST',
        data: $('#myForm').serialize(),
        success: function(res) {
          if(res == 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil membuat user',
              showConfirmButton: true,
            }).then(() => {
              window.location = '<?= BASEURL . "/users" ?>'
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Gagal membuat user !',
              text: res,
              showConfirmButton: true,
            })
          }
        }
      });
    }
  });
</script>