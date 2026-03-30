<div class="form-group row">
  <label for="name" class="col-sm-2 col-form-label required">Nama Kelas</label>
  <div class="col-sm-10">
    <input type="text" name="name" value="{{ old('name', $kelas->name) }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Ketik Nama Kelas" required>
    @error('name') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="tingkat" class="col-sm-2 col-form-label required">Tingkat</label>
  <div class="col-sm-10">
    <select name="tingkat" id="tingkat" class="form-control selectTwo @error('tingkat') is-invalid @enderror" data-width="100%" required>
      <option value="" disabled selected hidden>-- Pilih --</option>
      @foreach ([1,2,3,4,5,6] as $item)
        <option value="{{ $item }}" {{ old('tingkat', $kelas->tingkat) == $item ? 'selected' : '' }}>{{ $item }}</option>
      @endforeach
    </select>
    @error('tingkat') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
<div class="form-group row">
  <label for="guru_id" class="col-sm-2 col-form-label">Wali Kelas</label>
  <div class="col-sm-10">
    <select name="guru_id" id="guru_id" class="form-control selectTwo @error('guru_id') is-invalid @enderror" data-width="100%">
      <option value="" disabled selected hidden>-- Pilih --</option>
      @foreach ($guru as $item)
        <option value="{{ $item->id }}" {{ old('guru_id', $kelas->guru_id) == $item->id ? 'selected' : '' }}>{{ $item->user->name }}</option>
      @endforeach
    </select>
    @error('guru_id') <span class="invalid-feedback mt-1">{{ $message }}</span> @enderror
  </div>
</div>
