<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit Data Yayasan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                  <label for="edit_nama_yayasan">Nama Yayasan</label>
                  <input type="text" class="form-control" id="edit_nama_yayasan" name="nama_yayasan" required>
              </div>
              <div class="form-group">
                  <label for="edit_sejarah">Sejarah</label>
                  <input type="text" class="form-control" id="edit_sejarah" name="sejarah" required>
              </div>
              <div class="form-group">
                  <label for="edit_visi">visi</label>
                  <textarea class="form-control" id="edit_visi" name="visi" required></textarea>
              </div>
              <div class="form-group">
                  <label for="edit_misi">misi</label>
                  <textarea class="form-control" id="edit_misi" name="misi" required></textarea>
              </div>

              <div class="form-group">
                <label for="edit_norek">Nomor Rekening</label>
                <input type="text" class="form-control" id="edit_norek" name="nomor_rekening" required>
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