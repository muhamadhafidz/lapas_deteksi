<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit Data Anak</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                  <label for="edit_nama_anak">Nama Anak</label>
                  <input type="text" class="form-control" id="edit_nama_anak" name="nama_anak" required>
              </div>
              <div class="form-group">
                  <label for="edit_alamat">Alamat</label>
                  <textarea class="form-control" id="edit_alamat" name="alamat" required></textarea>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                      <label for="edit_tempat_lahir">Tempat Lahir</label>
                      <input type="text" class="form-control" id="edit_tempat_lahir" name="tempat_lahir" required>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                      <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                      <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" required>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk</label>
                <input type="date" class="form-control" id="edit_tanggal_masuk" name="tanggal_masuk" required>
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