<div class="form-group row">
  <label for="tanggal" class="col-sm-2 col-form-label required">Tanggal</label>
  <div class="col-sm-10">
    <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" placeholder="Ketik Tanggal" required>
    @error('tanggal') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="keterangan" class="col-sm-2 col-form-label required">Keterangan</label>
  <div class="col-sm-10">
    <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" placeholder="Ketik Keterangan" required>
    @error('keterangan') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
