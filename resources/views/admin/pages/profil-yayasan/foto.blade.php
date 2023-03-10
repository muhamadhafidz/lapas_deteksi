<!-- Modal -->
<div class="modal fade" id="foto" tabindex="-1" aria-labelledby="fotoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fotoLabel">Upload Foto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="form-foto" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                  <label for="input-tipe">Upload <span id="tipe-upload"></span></label>
                  <input type="file" class="form-control" id="input-tipe" name="foto" required>
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