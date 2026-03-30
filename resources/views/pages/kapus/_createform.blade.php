<div class="form-group row">
  <label for="name" class="col-sm-2 col-form-label required">Nama Kepala Puskesmas</label>
  <div class="col-sm-10">
    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Ketik Nama Kepala Puskesmas" required>
    @error('name') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="nip" class="col-sm-2 col-form-label">ID</label>
  <div class="col-sm-10">
    <input type="number" name="nip" value="{{ old('nip') }}" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="Ketik ID">
    @error('nip') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<!-- <div class="form-group row">
  <label for="nuptk" class="col-sm-2 col-form-label">NUPTK</label>
  <div class="col-sm-10">
    <input type="number" name="nuptk" value="{{ old('nuptk') }}" class="form-control @error('nuptk') is-invalid @enderror" id="nuptk" placeholder="Ketik NUPTK">
    @error('nuptk') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div> -->
</div>
<div class="form-group row">
  <label for="jk" class="col-sm-2 col-form-label required">Jenis Kelamin</label>
  <div class="col-sm-10">
    <select name="jk" id="jk" class="form-control selectTwo @error('jk') is-invalid @enderror" data-width="100%" required>
      <option value="" disabled selected hidden>-- Pilih --</option>
      @foreach (['laki-laki','perempuan'] as $item)
        <option value="{{ $item }}" {{ old('jk') == $item ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
    </select>
    @error('jk') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="telepon" class="col-sm-2 col-form-label">Telepon/WA</label>
  <div class="col-sm-10">
    <input type="number" name="telepon" value="{{ old('telepon') }}" class="form-control @error('telepon') is-invalid @enderror" id="telepon" placeholder="Ketik Telepon/WA">
    @error('telepon') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
  <div class="col-sm-10">
    <textarea type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Ketik Alamat" >{{ old('alamat') }}</textarea>
    @error('alamat') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="username" class="col-sm-2 col-form-label required">Username</label>
  <div class="col-sm-10">
    <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Ketik Username" required>
    @error('username') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <div class="input-group">
  <label for="password" class="col-sm-2 col-form-label required">Password</label>
    <div class="col-sm-10 input-group">
      <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Ketik Password" required>
      <div class="input-group-append" onclick="togglePassword()">
        <span class="input-group-text" style="cursor: pointer;"><i class="fa fa-eye-slash" id="eye-icon"></i></span>
      </div>
      @error('password') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
    </div>
  </div>
</div>

<script>
  function togglePassword() {
    var x = document.getElementById('password');
    var y = document.getElementById('eye-icon');
    if (x.type === 'password') {
      x.type = 'text';
      y.classList.add('fa-eye');
      y.classList.remove('fa-eye-slash');
      y.classList.add('text-primary');
    } else {
      x.type = 'password';
      y.classList.add('fa-eye-slash');
      y.classList.remove('text-primary');
      y.classList.remove('fa-eye');
    }
  }
</script>
