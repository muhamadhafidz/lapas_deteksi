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
                <label for="edit_keterangan">Keterangan</label>
                <textarea class="form-control" id="edit_keterangan" name="keterangan" required></textarea>
            </div>
            <div class="form-group">
                <label for="edit_tanggal">Tanggal</label>
                <input type="date" class="form-control" id="edit_tanggal" name="tanggal" required>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                    <label for="edit_nominal">Nominal</label>
                    <input type="number" class="form-control" id="edit_nominal" name="nominal" required>
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