<div class="row my-3">
  <div class="col-12 col-md-6 mx-auto">
    <div class="card border-primary">
      <div class="card-body">
        <h1 class="card-title text-center text-primary font-primary" style="font-size: 35px; margin-bottom: -10px;">Kas Kita</h1>
        <p class="text-center text-primary lead" style="font-size: 30px;">Login</p>

        <form class="row g-3 needs-validation" id="myForm">
          <div class="col-12">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" required>
          </div>
          <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
          </div>
          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="showPassword">
              <label class="form-check-label" for="showPassword">Show Password</label>
            </div>
          </div>
          <div class="col-12 text-center">
            <button class="btn btn-primary w-100" type="submit" id="btnLogin">Login</button>
            <p>Belum punya akun? <a href="<?= BASEURL. '/home/daftar' ?>" class="text-decoration-none">Daftar disini</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#showPassword').on('click', () => {
    if($('#password').attr('type') == 'password') {
      $('#password').attr('type', 'text');
    } else {
      $('#password').attr('type', 'password');
    }
  });

  $('#myForm').on('submit', (e) => {
    e.preventDefault();

    $.ajax({
      url: '<?= BASEURL . "/auth/checkCredentials" ?>',
      type: 'POST',
      data: $('#myForm').serialize(),
      success: function(res) {
        if(res == 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil login ..',
            showConfirmButton: true,
          }).then(() => {
            window.location = '<?= BASEURL . "/kas_kita" ?>'
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Username atau password salah !',
            showConfirmButton: true,
          })
        }
      }
    });
  });
</script>