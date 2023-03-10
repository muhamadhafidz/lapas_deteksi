<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit Data Donatur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                  <label for="edit_nama_donatur">Nama Donatur</label>
                  <input type="text" class="form-control" id="edit_nama_donatur" name="nama_donatur" required>
              </div>
              <div class="form-group">
                  <label for="edit_nomor_telp">Nomor Telepon</label>
                  <input type="text" class="form-control" id="edit_nomor_telp" name="nomor_telp" required>
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
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" id="edit_jenis_kelamin1" value="Pria" name="jenis_kelamin" required>Pria <br>
                <input type="radio" class="form-check-input" id="edit_jenis_kelamin2" value="Wanita" name="jenis_kelamin" required>Wanita
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