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
                                <h4 class="card-title font-weight-normal">Kegiatan Yayasan</h4>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#create">+ Tambah Kegiatan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="storage/{{ $item->foto }}" alt="" height="150px"></td>
                                    <td><b>{{ $item->judul }}</b></td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                            data-route="{{ route('kegiatan.update', $item->id) }}" 
                                            data-judul="{{ $item->judul }}" 
                                            data-deskripsi="{{ $item->deskripsi }}" 
                                            onclick="editKegiatan(this)"
                                        >Ubah</button>
                                        <form action="{{ route('kegiatan.destroy', $item->id) }}" method="post" class="ml-1 d-inline" id="form-hapus-{{ $item->id }}">
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

@include('admin.pages.kegiatan.create')
@include('admin.pages.kegiatan.edit')
@endsection

@push('after-script')
<script>
    function editKegiatan(edit)
    {
        var route = $(edit).data('route');
        var judul = $(edit).data('judul');
        var deskripsi = $(edit).data('deskripsi');

        $('#edit_judul').val(judul);
        $('#edit_deskripsi').val(deskripsi);

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
        title: 'Yakin menghapus kegiatan ini?',
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