@extends('admin.layouts.default')

@section('content')
{{-- {{  }} --}}
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <div class="row mb-3">
                            <div class="col">
                                <h4 class="card-title font-weight-normal">Data Donasi</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Nama Donatur</th>
                                <th>Nama Bank</th>
                                <th>Tanggal Donasi</th>
                                <th>Nominal Donasi</th>
                                <th>Bukti</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_donatur }}</td>
                                    <td>{{ $item->nama_bank }}</td>
                                    <td>{{ date('d M Y', strtotime($item->tanggal_donasi)) }}</td>
                                    <td>Rp. {{ $item->nominal_donasi }}</td>
                                    <td><img src="{{ 'storage/'.$item->bukti_donasi }}" alt="" style="height: 100px"></td>
                                </tr>
                                @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->

@include('admin.pages.donatur.create')
@include('admin.pages.donatur.edit')
@endsection

@push('after-script')
<script>
    function editDonatur(edit)
    {
        var donatur = $(edit).data('donatur');
        var nomorTelp = $(edit).data('nomortelp');
        var alamat = $(edit).data('alamat');
        var jeKel = $(edit).data('jekel');
        var ttl = $(edit).data('ttl');
        var route = $(edit).data('route');

        $('#edit_nama_donatur').val(donatur);
        $('#edit_nomor_telp').val(nomorTelp);
        $('#edit_alamat').val(alamat);

        if (jeKel == "Pria") {
            $('#edit_jenis_kelamin1').attr('checked', true);
        }else {
            $('#edit_jenis_kelamin2').attr('checked', true);
        }

        ttl = ttl.split(', ');

        $('#edit_tempat_lahir').val(ttl[0]);
        $('#edit_tanggal_lahir').val(ttl[1]);

        $('#form-edit').attr('action', route);
        $('#edit').modal('show');
    }

    $(document).ready(function(){
        $('#crudTable').DataTable({
          dom: 'Blfrtip',
          buttons: [
                'excel',  'print',
{
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
            ],
          "scrollX": true
        });
    });
    function hapus(id){
        Swal.fire({
        title: 'Yakin menghapus donatur ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!'
        }).then((result) => {
        if (result.isConfirmed) {
            $('#form-hapus-'+id).submit();
        }
        });
    }
    
</script>
@endpush