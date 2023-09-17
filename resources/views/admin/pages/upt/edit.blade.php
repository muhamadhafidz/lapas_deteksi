<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit Data UPT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control d-none" id="id-edit" name="id" readonly>
              </div>
              <div class="form-group">
                <label for="name">Nama UPT</label>
                <input type="text" class="form-control" id="name-edit" name="name" readonly>
              </div>
              <div class="form-group">
                  <label for="kepala_upt">Kelapa UPT</label>
                  <input type="text" class="form-control" id="kepala_upt-edit" name="kepala_upt" required>
              </div>
              <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control" id="alamat-edit" name="alamat" required>
              </div>
              <div class="form-group">
                  <label for="no_telp">Nomor Telpon</label>
                  <input type="text" class="form-control" id="no_telp-edit" name="no_telp" required>
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