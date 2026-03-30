<div class="modal fade" id="modal-filter">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title fw-bold ">Filter Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('user.index') }}" method="GET">
            <div class="modal-body">

              <div class="input-group mt-2 " style="width: 100%">
                <div class="input-group-prepend" data-width="20%">
                  <span class="input-group-text">Role</span>
                </div>
                <select name="role" id="role" class="form-control form-select">
                  <option disabled hidden selected>-- Pilih --</option>
                  @foreach (['admin','staf','kapus'] as $item)
                    <option value="{{ $item }}" {{ request('role') == $item ? 'selected' : '' }}>{{ $item }}</option>
                  @endforeach
                </select>
              </div>

            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-primary">Terapkan</button>
            </div>
          </form>
      </div>
  </div>
</div>
