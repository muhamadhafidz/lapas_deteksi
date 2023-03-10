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
                                <h4 class="card-title font-weight-normal">Data Anak Asuh</h4>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#create">+ Tambah Anak Asuh</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Nama Anak Asuh</th>
                                <th>Alamat</th>
                                <th>Tempat-Tanggal Lahir</th>
                                <th>Tanggal Masuk</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_anak }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->ttl }}</td>
                                    <td>{{ $item->tanggal_masuk }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                            data-route="{{ route('master-anak-asuh.update', $item->id) }}" 
                                            data-anak="{{ $item->nama_anak }}" 
                                            data-alamat="{{ $item->alamat }}" 
                                            data-tglmasuk="{{ $item->tanggal_masuk }}" 
                                            data-ttl="{{ $item->ttl }}" 
                                            onclick="editDonatur(this)"
                                        >Ubah</button>
                                        <form action="{{ route('master-anak-asuh.destroy', $item->id) }}" method="post" class="ml-1 d-inline" id="form-hapus-{{ $item->id }}">
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

@include('admin.pages.anak-asuh.create')
@include('admin.pages.anak-asuh.edit')
@endsection

@push('after-script')
<script>
    function editDonatur(edit)
    {
        var anak = $(edit).data('anak');
        var alamat = $(edit).data('alamat');
        var tglmasuk = $(edit).data('tglmasuk');
        var ttl = $(edit).data('ttl');
        var route = $(edit).data('route');

        $('#edit_nama_anak').val(anak);
        $('#edit_alamat').val(alamat);
        $('#edit_tanggal_masuk').val(tglmasuk);

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