<div class="modal fade" id="modal-detail-invoice" tabindex="-1" role="dialog" aria-labelledby="modal-documentLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-documentLabel">Invoice</h5>
            </div>
            <div class="modal-body" style=" word-wrap: break-word;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table table-responsive">

                            <table class="table table-responsive">
                                <tr>
                                    <td>Nama Perusahaan</td>
                                    <td>:</td>
                                    <td><span class="company">PT. AMANAH Karya Indonesia</span></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>
                                        <p style="word-wrap: break-word"><span class="address"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nomor Kontak</td>
                                    <td>:</td>
                                    <td><span class="pic"></span></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><span class="email"></span></td>
                                </tr>
                            </table>
                        </div>
                        delivery :

                        <table class="table table-hover mt-3 mb-4" id="table-detail-invoice">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th></th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="row">
                            <div class="col-md-3 bukti-bayar">

                            </div>
                            <div class="col-md-4 offset-4">
                                <div class="form-group row">
                                    <label for="totalPajak" class="col-sm-4 col-form-label">Subtotal</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="subtotal" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="totalPajak" class="col-sm-4 col-form-label">VAT (<span
                                            class="tax"></span> %) </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="vat" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="totalBiaya" class="col-sm-4 col-form-label">Grand Total</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="total" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-document">Close</button>
            </div>
        </div>
    </div>
</div>
