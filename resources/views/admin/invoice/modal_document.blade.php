<div class="modal fade" id="modal-document" tabindex="-1" role="dialog" aria-labelledby="modal-documentLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-documentLabel">Dokumen Pendukung</h5>
        </div>
        <div class="modal-body">
        <form id="form-document" enctype="multipart/form-data">
                @csrf
          <table class="table table-responsive" id="table-document">
            <thead>
                <tr>
                    <th>Jenis Dokumen</th>
                    <th>File</th>
                    <th></th>
                </tr>
            </thead>
          </table>

        </form>
        <small class="text-danger float-start">*Dokumen Maksimal 1 MB </small>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-document">Close</button>

        </div>
      </div>
    </div>
</div>
