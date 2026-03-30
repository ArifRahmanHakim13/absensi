<div class="form-group row">
  <label for="abc" class="col-sm-4 col-form-label required">Nama</label>
  <div class="col-sm-8">
    <input type="text" value="{{ old('name', $sekolah->name) }}" class="form-control edit-data-field" name="name" id="edit-data-name" placeholder="Masukkan Nama Sekolah " required>
    <span class="invalid-feedback mt-1" id="error-data-name"></span>
  </div>
</div>
<div class="form-group row">
  <label for="telepon" class="col-sm-4 col-form-label required">Telepon</label>
  <div class="col-sm-8">
    <input type="text" value="{{ old('telepon', $sekolah->telepon) }}" class="form-control edit-data-field" name="telepon" id="edit-data-telepon" placeholder="Masukkan Telepon" required>
    <span class="invalid-feedback mt-1" id="error-data-telepon"></span>
  </div>
</div>
<div class="form-group row">
  <label for="alamat" class="col-sm-4 col-form-label required">Alamat</label>
  <div class="col-sm-8">
    <textarea type="text" class="form-control edit-data-field" name="alamat" placeholder="Masukkan Alamat" id="edit-data-alamat" required>{{ old('alamat', $sekolah->alamat) }}</textarea>
    <span class="invalid-feedback mt-1" id="error-data-alamat"></span>
  </div>
</div>
<div class="form-group row">
  <label for="email" class="col-sm-4 col-form-label required">Email</label>
  <div class="col-sm-8">
    <input type="text" value="{{ old('email', $sekolah->email) }}" class="form-control edit-data-field" name="email" placeholder="Masukkan Email" id="edit-data-email" required>
    <span class="invalid-feedback mt-1" id="error-data-email"></span>
  </div>
</div>
