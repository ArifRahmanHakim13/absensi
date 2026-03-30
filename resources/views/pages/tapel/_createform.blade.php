<div class="form-group row">
  <label for="tahun" class="col-sm-2 col-form-label required">Tahun</label>
  <div class="col-sm-10">
    <input type="text"
           name="tahun"
           value="{{ old('tahun') }}"
           class="form-control @error('tahun') is-invalid @enderror"
           id="tahun"
           placeholder="Ketik Tahun"
           required>
    @error('tahun')
      <span class="invalid-feedback mt-1">{{ $message }}</span>
    @enderror
  </div>
</div>

{{-- =============================== --}}
{{-- PERIODE DISEMBUNYIKAN (DI-KOMEN) --}}
{{-- =============================== --}}
{{--
<div class="form-group row">
  <label for="periode" class="col-sm-2 col-form-label required">Periode</label>
  <div class="col-sm-10">
    <select name="periode" id="periode"
            class="form-control selectTwo @error('periode') is-invalid @enderror"
            data-minimum-results-for-search="Infinity"
            data-width="100%" required>
      <option value="" disabled selected hidden>-- Pilih --</option>
      @foreach (['1','2'] as $item)
        <option value="{{ $item }}">{{ $item == '1' ? 'Periode I' : 'Periode II' }}</option>
      @endforeach
    </select>
    @error('periode')
      <span class="invalid-feedback mt-1">{{ $message }}</span>
    @enderror
  </div>
</div>
--}}

{{-- 🔑 PENGGANTI PERIODE (WAJIB ADA) --}}
<input type="hidden" name="periode" value="1">

<div class="form-group row">
  <label for="mulai" class="col-sm-2 col-form-label required">Tanggal Mulai</label>
  <div class="col-sm-10">
    <input type="date"
           name="mulai"
           value="{{ old('mulai') }}"
           class="form-control @error('mulai') is-invalid @enderror"
           id="mulai"
           required>
    @error('mulai')
      <span class="invalid-feedback mt-1">{{ $message }}</span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label for="selesai" class="col-sm-2 col-form-label required">Tanggal Selesai</label>
  <div class="col-sm-10">
    <input type="date"
           name="selesai"
           value="{{ old('selesai') }}"
           class="form-control @error('selesai') is-invalid @enderror"
           id="selesai"
           required>
    @error('selesai')
      <span class="invalid-feedback mt-1">{{ $message }}</span>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label for="is_aktif" class="col-sm-2 col-form-label required">Status</label>
  <div class="col-sm-10">
    <select name="is_aktif"
            id="is_aktif"
            class="form-control selectTwo @error('is_aktif') is-invalid @enderror"
            data-width="100%"
            data-minimum-results-for-search="Infinity"
            required>
      <option value="" disabled selected hidden>-- Pilih --</option>
      <option value="1">AKTIF</option>
      <option value="0">NON-AKTIF</option>
    </select>
    @error('is_aktif')
      <span class="invalid-feedback mt-1">{{ $message }}</span>
    @enderror
  </div>
</div>
