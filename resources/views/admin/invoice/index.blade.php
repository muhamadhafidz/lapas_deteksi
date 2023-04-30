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
            <div class="row">
                <div class="col-lg-2 col-6">
                    <a href="#" onclick="filter(0)">
                        <div class="card">
                            <div class="card-body">
                                <h4>{{$all}}</h4>
                                <h4 class="text-muted">ALL</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2 col-6">
                    <a href="#" onclick="filter(1)">
                        <div class="card">
                            <div class="card-body">
                                <h4>{{$draft}}</h4>
                                <h4 class="text-muted">DRAFT</h4>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2 col-6">
                    <a href="#" onclick="filter(2)">
                    <div class="card">
                        <div class="card-body">
                            <h4>{{$sent}}</h4>
                            <h4 class="text-muted">SENT</h4>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-2 col-6">
                    <a href="#" onclick="filter(3)">
                    <div class="card">
                        <div class="card-body">
                            <h4>{{$paid}}</h4>
                            <h4 class="text-muted">PAID</h4>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('invoice.create')}}" class="btn btn-primary">
                        <i class="ti ti-plus"></i>Buat Invoice
                    </a>
                </div>
                <div class="card-body">
                        <table class="table table-hover" id="table-list-invoice">
                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Submitted Date</th>
                                    <th>Total Invoice</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="invoice" onchange="filter()" class="form-control form-control-sm" placeholder="No Inv | Customer"></td>
                                    <td><input type="date" name="date" onchange="filter()" class="form-control form-control-sm"></td>
                                    <td><input type="text" name="total" onchange="filter()" class="form-control form-control-sm"></td>
                                    <td>
                                        <select onchange="filter()" name="status_invoice" id="status_invoice" class="form-control form-control-sm">
                                            <option value="" selected>All</option>
                                            <option value="1" >DRAFT</option>
                                            <option value="2" >SENT</option>
                                            <option value="3" >WAITING_APPROVAL_PAYMENT</option>
                                            <option value="4" >PAYMENT_REJECTED</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>
@include('transaction.invoice.modal_detail')
@include('transaction.invoice.modal_payment')
@endsection

@section('script')
<script>
    var table;
    tableDetail = $('#table-detail-invoice').DataTable();
    tableData();

    function filter(type) {
        table.destroy()
        data = {
            "type":type
        }
        tableData(data)
    }

    function filter(){
        table.destroy()
        data = {
            "invoice":$('input[name=invoice]').val(),
            "date":$('input[name=date]').val(),
            "total":$('input[name=total]').val(),
            "status":$('#status_invoice').val(),
        }
        tableData(data)
    }

    function tableData(data=null){
        table = $('#table-list-invoice').DataTable({
        "processing" : true,
        "serverside" : true,
        "ordering":false,
        "searching":false,
        "bSort" : true,
        "dom" : 'Bfrtip',
        "ajax" : {
                "url" : "{{route('invoice.datatableInvoice')}}",
                "data" : data,
                "type" : "GET"
            }
        })
    }


    function detailInvoice(id){
        $('#modal-detail-invoice').modal('show')
        tableDetail.destroy();
        getOrigin(id)
    }

    function payment(id){
        $('#invoice_id').val(id)
        $('#modal-payment').modal('show')
    }

    $('.close-payment').on('click',function(){
        $('#modal-payment').modal('hide')
    })

    $('.close-document').on('click',function(){
        $('#modal-detail-invoice').modal('hide')
    })

    function getOrigin(id){
        url = "{{route('invoice.getDetailInvoice',':id')}}"
        url = url.replace(':id',id)
        $.ajax({
            url: url,
            type: "GET",
            success:function(data){
                $('.bukti-bayar-button').remove()

                $('.company').html(data.nama_customer);
                $('.address').html(data.alamat_lengkap);
                $('.pic').html(data.telp);
                $('#subtotal').val('IDR '+ new Intl.NumberFormat().format(data.basic_customer_price));
                $('.tax').html(data.tax);
                $('#vat').val('IDR '+ new Intl.NumberFormat().format(data.value_added_tax_customer));
                $('#total').val('IDR '+ new Intl.NumberFormat().format(data.total_customer_price));
                if(data.bukti_file != null){
                    element = '<a href="{{asset("storage/:link")}}" target="_blank" type="button" class="btn btn-primary bukti-bayar-button">Bukti Bayar</a>'

                    element = element.replace(":link",data.bukti_file)

                    $('.bukti-bayar').append(element
                    )
                }else{
                    $('.bukti-bayar-button').remove()
                }

                urlDetail = "{{route('invoice.dataTableModalDetailInvoice',':id')}}"
                urlDetail = urlDetail.replace(':id',id)
                tableDetail = $('#table-detail-invoice').DataTable({
                    "processing" : true,
                    "serverside" : true,
                    "searching":false,
                    "paging":false,
                    "info":false,
                    "bSort" : true,
                    "dom" : 'Bfrtip',
                    "ajax" : {
                            "url" : urlDetail,
                            "type" : "GET"
                        }
                    })

            }
        })
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
