<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit Data Pemasukan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="form-edit" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" id="edit_foto" name="edit_foto">
                <small class="text-danger">kosongkan jika tidak ingin merubah foto</small>
            </div>
            <div class="form-group">
                <label for="deskripsi">Judul</label>
                <textarea class="form-control" id="edit_judul" name="edit_judul" required></textarea>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="edit_deskripsi" name="edit_deskripsi" required></textarea>
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