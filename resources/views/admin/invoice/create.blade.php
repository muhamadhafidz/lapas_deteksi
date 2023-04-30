@extends('layouts.admin')
@section('page-title')
    {{__('Buat Invoice')}}
@endsection
@push('script-page')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
@endpush
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('invoice.index')}}">List Invoice</a></li>
    <li class="breadcrumb-item">Buat Invoice</li>
@endsection
@section('action-btn')
    <div class="float-end">

    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row test">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-proses" disabled>
                                Proses Invoice
                            </button>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select select-customer">
                                <option disabled selected>-Pilih Customer-</option>
                                @foreach ($customer as $list)
                                    <option value="{{$list->id}}">{{$list->nama_customer}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="search-field">

                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <form method="post" id="form-invoice" action="{{route('invoice.prosesInvoice')}}">
                        @csrf
                        <input type="hidden" name="customer_id" id="customer_id">
                    <div class="table-responsive p-4 content-invoice">
                        <div class="alert alert-primary text-center informasi" role="alert">
                            Pilih Customer Dahulu
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    var table;

    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    table = $('#table-create-invoice').DataTable();
    $('.select-customer').on('change',function(){
        table.destroy()
        $('.informasi').remove()
        $('#table-create-invoice').remove()
        $('.content-invoice').append(
            '<div class="row">' +
                '<div class="form-group col-md-4">' +
                    '<div class="input-group">' +
                        '<span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>' +
                        '<input type="text" class="form-control" placeholder="Search No. Shipment/PO" id="search" name="search">' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<table class="table" id="table-create-invoice">'+
            '<thead>'+
                '<tr>'+
                    '<th><input class="form-check-input checkAll" id="checkAll" onclick="checkBoxShipment()" type="checkbox"></th>'+
                    '<th>Nomor Dokumen</th>'+
                    '<th>Status</th>'+
                    '<th>Pengirim</th>'+
                    '<th>Rute</th>'+
                    '<th>Deskripsi</th>'+
                '</tr>'+
            '</thead>'+
        '</table>'
        )

        $('#customer_id').val(this.value)

        setTable();

        $('#search').on('input', function () {
            table.destroy();
            setTable();
        });
    })

    function setTable(){
        table = $('#table-create-invoice').DataTable({
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
                "url" : "{{route('invoice.dataTableListShipment')}}",
                "data" : {
                    customer_id : $('#customer_id').val(),
                    search : $('#search').val()
                },
                "type" : "GET"
            }
        });
    }

    function checkBoxShipment(){
        if ($('input.checkAll').prop('checked')) {
            $('input.check_shipment').prop('checked',true)
        }else{
            $('input.check_shipment').prop('checked',false)
        }
        checkLenght();
    }

    function checkLenght(){
        var numberOfChecked = $('input.check_shipment:checkbox:checked').length;
        if(numberOfChecked>0){
            $('.btn-proses').attr('disabled',false)
        }else{
            $('.btn-proses').attr('disabled',true)
        }
    }

    $('.btn-proses').on('click',function(){
        $('#form-invoice').submit();
    })
</script>
@endsection
