<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    {{ config('app.name') }} | LOGIN
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    @if (session()->has('failed'))
      <div class="col mt-2">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session('failed') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    @endif
    <div class="card-header text-center">
      <h2 class="fw-bold">{{ config('app.name') }}</h2>
    </div>
    <div class="card-body">
      <div class="text-center mb-3">
        <a href="#" class="modal-demo text-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalDemo">Lihat akun untuk login</a>
      </div>
      <form action="{{ route('login') }}" method="POST">
      @csrf

        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" id="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="showpassword">
              <label for="showpassword">
                Lihat Password
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDemo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PERHATIAN</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Ini adalah link demo, data yang tampil adalah Data Dummy. Info lebih lanjut <a href="https://wa.me/6283112907503?text=Halo">Hubungi Pemilik</a></p>

      <div class="table-responsive">
        <div class="text-center fw-bold">AKUN LOGIN</div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Role</th>
              <th scope="col">Username</th>
              <th scope="col">Password</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Administrator</td>
              <td>admin</td>
              <td>password</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Kepala Puskesmas</td>
              <td>kapus</td>
              <td>password</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Staf</td>
              <td>staf</td>
              <td>password</td>
            </tr>
          </tbody>
        </table>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OKE</button>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
{{-- SHOW PASSWORD --}}
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var passwordInput = document.getElementById("password");
    var showCheckbox = document.getElementById("showpassword");
    showCheckbox.addEventListener("change", function() {
      passwordInput.type = showCheckbox.checked ? "text" : "password";
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#modalDemo').modal('show'); // Open modal on page load
  });
</script>

</body>
</html>
