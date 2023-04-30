@extends('layouts.admin')
@section('page-title')
    {{__('Invoice')}}
@endsection
@push('script-page')

@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href=""></a></li>
@endsection
@section('action-btn')
    <div class="float-end">

    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive p-4">
                        <table class="table" id="table-detail-invoice">
                            <thead>
                                <tr>
                                    <th>Nomor Dokumen</th>
                                    <th>Customer</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Deskripsi</th>
                                    <th>Biaya Pengiriman</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="table-primary">
                                    <td colspan="5"><b>Total</b></td>
                                    <td><input type="text" readonly class="form-control" value="IDR {{number_format($total)}}"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Nomor Invoice External" id="input-invoice-external">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-outline-primary support-document">Dokumen Pendukung</button>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label for="jatpo_input" class="col-sm-3 col-form-label">Jatuh Tempo</label>
                            <div class="col-sm-9">
                              <input type="date" class="form-control" id="jatpo_input"  value="{{$invoice->jatpo}}">
                            </div>
                          </div>
                          <fieldset class="form-group">
                            <div class="row">
                              <legend class="col-form-label col-sm-3 pt-0">Pajak</legend>
                              <div class="col-sm-9">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="ppn" id="ppn0" onclick="tax(this.value)" value="0" {{$invoice->tax ==0 ? 'checked' : ''}}>
                                  <label class="form-check-label" for="ppn0">
                                    PPN 0%
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="ppn" id="ppn1" onclick="tax(this.value)" value="1" {{$invoice->tax == 1 ? 'checked' : ''}}>
                                  <label class="form-check-label" for="ppn1">
                                    PPN 1%
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="ppn" id="ppn15" onclick="tax(this.value)" value="1.1" {{$invoice->tax == 1.1 ? 'checked' : ''}}>
                                  <label class="form-check-label" for="ppn15">
                                    PPN 1,1%
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="ppn" id="ppn10" onclick="tax(this.value)" value="10" {{$invoice->tax == 10 ? 'checked' : ''}}>
                                  <label class="form-check-label" for="ppn10">
                                    PPN 10%
                                  </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ppn" id="ppn11" onclick="tax(this.value)" value="11" {{$invoice->tax == 11 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="ppn11">
                                      PPN 11%
                                    </label>
                                  </div>

                              </div>
                            </div>
                          </fieldset>

                          <div class="form-group row">
                            <label for="totalPajak" class="col-sm-3 col-form-label">Total Pajak</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="totalPajak" placeholder="IDR 0" value="IDR {{number_format($invoice->value_added_tax_customer)}}" readonly>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="totalBiaya" class="col-sm-3 col-form-label">Total Biaya</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="totalBiaya" placeholder="IDR {{number_format($invoice->total_customer_price)}}" readonly>
                            </div>
                          </div>

                          <fieldset class="form-group">
                            <div class="row">
                              <legend class="col-form-label col-sm-3 pt-0">PPH</legend>
                              <div class="col-sm-9">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="pph" id="pph0" onclick="pph(this.value)" value="0" {{ $invoice->pph_perc == 0 ? 'checked' : '' }}>
                                  <label class="form-check-label" for="pph0" >
                                    PPH 0%
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="pph" id="pph2" onclick="pph(this.value)" value="2" {{ $invoice->pph_perc == 2 ? 'checked' : '' }}>
                                  <label class="form-check-label" for="pph2">
                                    PPH 2%
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="pph" id="pph4" onclick="pph(this.value)" value="4" {{ $invoice->pph_perc == 4 ? 'checked' : '' }}>
                                  <label class="form-check-label" for="pph4">
                                    PPH 4%
                                  </label>
                                </div>
                              </div>
                            </div>
                          </fieldset>

                          <div class="form-group row">
                            <label for="totalpph" class="col-sm-3 col-form-label">Total Biaya Setelah PPH</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="totalpph" placeholder="IDR {{number_format($invoice->total_customer_price-$invoice->pph)}}" readonly>
                            </div>
                          </div>
                    </div>

                </div>
                </div>
                <div class="card-footer">
                    <button class="float-end btn btn-primary proses-invoice">Proses</button>
                    <a href="{{route('invoice.index')}}" class="float-end btn btn-outline-warning m-r-5">Kembali</a>
                    <a onclick="deleteConfirm({{$id}})" class="float-end btn btn-outline-danger m-r-5">Hapus Data</a>
                </div>
            </div>
        </div>
    </div>
    <form id="form-invoice" action="{{route('invoice.store')}}" method="POST">
        @csrf
        <input type="hidden" name="tax" id="tax" value="0">
        <input type="hidden" name="value_added_tax" id="value-added-tax">
        <input type="hidden" name="pph" id="value-pph" value="{{ $invoice->pph_perc }}">
        <input type="hidden" name="pph_perc" id="value-pph-perc">
        <input type="hidden" name="id" value="{{$id}}">
        <input type="hidden" name="invoice_external" id="invoice-external">
        <input type="hidden" name="jatpo" id="jatpo">
    </form>
@include('transaction.invoice.modal_document')
@endsection

@section('script')
<script>
    table = $('#table-detail-invoice').DataTable({
            "processing" : true,
            "serverside" : true,
            "paging" :false,
            "searching":false,
            "showing":false,
            "bSort" : true,
            "ordering": false,
            "info":     false,
            "scrollY": "500px",
            "scrollCollapse": true,
            "dom" : 'Brt',
            "ajax" : {
                "url" : "{{route('invoice.dataTableDetailInvoice',$id)}}",
                "type" : "GET"
            }
    })

    $('#input-invoice-external').on('keyup',function(){
        $('#invoice-external').val(this.value)
    })

    function tax(tax){
        var totalFee = {{$total}}
        var valueAddedtax = Math.round(tax * totalFee/100)
        var totalCustomerFee = totalFee + valueAddedtax;
        $('#tax').val(tax);
        $('#value-added-tax').val(valueAddedtax);
        $('#totalPajak').val('IDR '+ new Intl.NumberFormat().format(valueAddedtax));
        $('#totalBiaya').val('IDR '+ new Intl.NumberFormat().format(totalCustomerFee));

        var val = $("input[name='pph']:checked").val();
        pph(val);

    }

    function pph(pph){
        var tax = $("input[name='ppn']:checked").val();
        var totalFee = {{$total}}
        var valueAddedtax = Math.round(tax * totalFee/100)
        var totalCustomerFee = totalFee + valueAddedtax;
        var totalpph = Math.round(pph * totalCustomerFee/100)
        var totalSetelahPph = totalCustomerFee - totalpph;
        $('#value-pph').val(totalpph);
        $('#value-pph-perc').val(pph);
        $('#totalpph').val('IDR '+ new Intl.NumberFormat().format(totalSetelahPph))

    }

    $('.support-document').on('click',function(){
        $('#modal-document').modal('show');
    })
    $('.close-document').on('click',function(){
        $('#modal-document').modal('hide');
    })
    $('#jatpo_input').on('change',function(){
        var jatpo = $('#jatpo_input').val();
        $('#jatpo').val(jatpo)
    })

    tableDocument = $('#table-document').DataTable({

            "ordering": false,
            "dom" : 'Brt',
            "ajax" : {
                "url" : "{{route('invoice.dataTableSupportDocument',$id)}}",
                "type" : "GET"
            }
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function changeImage(value,id){

        var fileExt = value.split('.').pop().toLowerCase();
        if (fileExt != 'pdf') {
            alert('file harus berbentuk pdf!');
            $('#'+id).val('')

        }else{

            url = "{{route('invoice.uploadDocument',':id')}}";
            url = url.replace(':id',id)
            var myFormData = new FormData();
            myFormData.append('picture', $('#'+id).prop('files')[0]);

            $.ajax({
                url:url,
                method : "POST",
                processData: false, // important
                contentType: false,
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                data : myFormData,
                success:function (data){
                    tableDocument.ajax.reload();
                },
                error:function(data){

                    $('#'+id).val('')
                    var json = data.responseJSON
                    alert(json.message)
                }

            })

        }
    };

    function deleteDocument(id){

        $.ajax({
            type:'POST',
            url:'{{route('invoice.deleteDocument')}}',
            dataType:'JSON',
            data:{id:id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            success:function(data){
                tableDocument.ajax.reload()
            }
        });
    }

    $('.proses-invoice').on('click',function(){
        $('#form-invoice').submit();
    })

    function openInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }

    function deleteConfirm(id){
        Swal.fire({
            title: 'Anda Ingin Menghapusnya?',
            showDenyButton: true,
            confirmButtonText: 'Ya Hapus',
            denyButtonText: 'Jangan Hapus',
        }).then((result) => {
            if (result.isConfirmed) {
                var urlDelete = "{{route('invoice.cancelled',':id')}}"
                urlDelete = urlDelete.replace(':id',id)
                window.location.replace(urlDelete);
            }
        })

    }


</script>
@endsection
