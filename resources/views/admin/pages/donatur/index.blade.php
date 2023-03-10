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
                                <h4 class="card-title font-weight-normal">Data Donatur</h4>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#create">+ Tambah Donatur</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Nama Donatur</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat-Tanggal Lahir</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_donatur }}</td>
                                    <td>{{ $item->nomor_telp }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->ttl }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                            data-route="{{ route('master-donatur.update', $item->id) }}" 
                                            data-donatur="{{ $item->nama_donatur }}" 
                                            data-nomortelp="{{ $item->nomor_telp }}" 
                                            data-alamat="{{ $item->alamat }}" 
                                            data-jekel="{{ $item->jenis_kelamin }}" 
                                            data-ttl="{{ $item->ttl }}" 
                                            onclick="editDonatur(this)"
                                        >Ubah</button>
                                        <form action="{{ route('master-donatur.destroy', $item->id) }}" method="post" class="ml-1 d-inline" id="form-hapus-{{ $item->id }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="hapus({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
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