<div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="modal-documentLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-documentLabel">Bukti Bayar</h5>
        </div>
        <div class="modal-body" style=" word-wrap: break-word;">
            <form action="{{route('invoice.uploadBuktiBayar')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="invoice_id" id="invoice_id">
              <div class="form-group">
                <label for="nama_rekening">Nama Rekening</label>
                <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" placeholder="contoh : Saefudin">
              </div>

              <div class="form-group">
                <label for="bank">Nama Bank</label>
                <select name="bank" id="bank" class="form-control select2" required>
                    <option value="" selected>-Pilih Bank-</option>
                    @foreach ($bank as $list)
                        <option value="{{$list->kode_bank}}">{{$list->nama_bank}}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="norek">No Rekening</label>
                <input type="number" class="form-control" name="norek" id="norek" placeholder="721829391221">
              </div>

              <div class="form-group">
                <label for="tgl_bayar">Tanggal Bayar</label>
                <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar">
              </div>

              <div class="form-group">
                <label for="nominal">Nominal</label>
                <input type="number" class="form-control" id="nominal" name="nominal">
              </div>

              <div class="form-group">
                <label for="bank_tujuan">Rekening Tujuan</label>
                <select name="bank_tujuan" id="bank_tujuan" class="form-control select2" required>
                    <option value="" selected>-Pilih Bank-</option>
                    <option value="panin">PANIN BANK</option>
                    <option value="mas">BANK Multi Arta Sentosa (Bank MAS)</option>
                </select>
              </div>

              <div class="form-group">
                <label for="bukti">Upload Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti">
              </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-payment">Close</button>
            <button type="submit" class="btn btn-danger">Proses</button>

        </form>
        </div>
      </div>
    </div>
</div>
