<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createLabel">Tambah pengguna Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('pengguna.store') }}">
            @csrf
            @method('POST')
            <div class="modal-body">
              <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                      <label for="password">password</label>
                      <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                      <label for="password_confirmation">Konfirmasi Password</label>
                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>