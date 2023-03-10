<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit Data pengeluaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="form-edit">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="form-group">
                <label for="edit_name">Nama</label>
                <input type="text" class="form-control" id="edit_name" name="name" required>
            </div>
            <div class="form-group">
                <label for="edit_email">Email</label>
                <input type="email" class="form-control" id="edit_email" name="email" required>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                    <label for="edit_password">password</label>
                    <input type="password" class="form-control" id="edit_password" name="password">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                    <label for="edit_password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation">
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