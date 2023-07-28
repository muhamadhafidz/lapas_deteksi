<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit Assessment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                <label for="element_assessment">Element Assessment</label>
                <input type="text" name="element_assessment" id="edit_element_assessment" class="form-control">
              </div>
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="edit_deskripsi" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label for="sub_category_id">Sub Category</label>
                <select name="sub_category_id" id="edit_sub_category_id" class="form-control">
                  @foreach ($subCat as $sub)
                  <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="is_absolute">Absolute</label>
                <select  name="is_absolute" id="edit_is_absolute" class="form-control">
                  <option value="0">Tidak</option>
                  <option value="1">Ya</option>
                </select>
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