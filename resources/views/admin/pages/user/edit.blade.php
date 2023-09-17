<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLabel">Edit Data User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="" id="form-edit">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="form-group">
                <label for="name">Nama UPT</label>
                <input type="text" class="form-control" id="name-edit" name="name" required>
              </div>
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email-edit" name="email" required>
              </div>
              <div class="form-group">
                <label for="roles">Roles</label>
                <select class="form-control" name="roles" id="roles">
                  <option id="userRoles" value="user">User</option>
                  <option id="adminRoles" value="admin">Admin</option>
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