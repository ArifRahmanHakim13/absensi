<form class="form-horizontal" action="{{ route('profil.update', $saya->id ) }}" method="post">
  @csrf
  @method('PUT')

      <div class="form-group row">
        <label for="name" class="col-sm-3 col-form-label required">Nama</label>
        <div class="col-sm-9">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Maukkan Nama" value="{{ old('name', $saya->user->name) }}" required>
            @error('name') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
        </div>
      </div>

      @if ($saya->user->role != 'admin')
        <div class="form-group row">
            <label for="nip" class="col-sm-3 col-form-label">NIP</label>
            <div class="col-sm-9">
              <input type="number" name="nip" class="form-control" id="nip" placeholder="Masukkan NIP" value="{{ old('nip', $saya->nip) }}">
              @error('nip') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
            </div>
        </div>
        <!-- <div class="form-group row">
            <label for="nuptk" class="col-sm-3 col-form-label">NUPTK</label>
            <div class="col-sm-9">
              <input type="number" name="nuptk" class="form-control" id="nuptk" placeholder="Masukkan NUPTK" value="{{ old('nuptk', $saya->nuptk) }}">
              @error('nuptk') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
            </div>
        </div> -->
      @endif

      <div class="form-group row">
        <label for="telepon" class="col-sm-3 col-form-label required">Jenis Kelamin </label>
        <div class="col-sm-9">
          <select name="jk" id="jk" class="form-control selectTwo @error('jk') is-invalid @enderror" data-width="100%"  data-minimum-results-for-search="Infinity" required>
            <option disabled selected hidden>-- Pilih --</option>
            <option value="laki-laki" {{ old('jk', $saya->user->jk) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="perempuan" {{ old('jk', $saya->user->jk) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
          </select>
          @error('jk') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
        </div>
    </div>

    <div class="form-group row">
      <label for="telepon" class="col-sm-3 col-form-label">Telepon/WA</label>
      <div class="col-sm-9">
          <input type="number" name="telepon" class="form-control @error('telepon') is-invalid @enderror" id="telepon" placeholder="Maukkan Telepon/WA" value="{{ old('telepon', $saya->user->telepon) }}">
          @error('telepon') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
      </div>
    </div>

      <div class="form-group row">
        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
        <div class="col-sm-9">
          <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat">{{ old('alamat', $saya->user->alamat) }}</textarea>
          @error('alamat') <span class="invalid-feedback mt-1"> {{ $message }} </span> @enderror
        </div>
      </div>

      <div class="form-group row">
          <div class="offset-sm-3 col-sm-9">
              <div class="checkbox">
                  <label>
                      <input type="checkbox" required>
                      Saya yakin akan mengubah data tersebut
                  </label>
              </div>
          </div>
          <div class="offset-sm-3 col-sm-8 mt-2 d-xs-none">
            <button type="submit" class="btn btn-primary btn-md">Simpan</button>
          </div>
          <div class="col text-center d-sm-none">
            <button type="submit" class="btn btn-primary form-control">Simpan</button>
          </div>
      </div>

  </form>
