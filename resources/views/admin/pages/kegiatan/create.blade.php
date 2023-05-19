<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createLabel">Tambah Kegiatan Yayasan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('kegiatan.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal-body">
              <div class="form-group">
                  <label for="foto">Foto</label>
                  <input type="file" class="form-control" id="foto" name="foto" required>
              </div>
              <div class="form-group">
                  <label for="judul">Judul</label>
                  <textarea class="form-control" id="judul" name="judul" required></textarea>
              </div>
              <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
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