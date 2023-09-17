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
                                <h4 class="card-title font-weight-normal">Data UPT</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Nama UPT</th>
                                <th>Kepala UPT</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->upt->kepala_upt }}</td>
                                    <td>{{ $item->upt->alamat }}</td>
                                    <td>{{ $item->upt->no_telp }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                            data-route="{{ route('admin.data-upt.update', $item->id) }}" 
                                            data-name="{{ $item->name }}" 
                                            data-kepala="{{ $item->upt->kepala_upt }}" 
                                            data-alamat="{{ $item->upt->alamat }}" 
                                            data-telp="{{ $item->upt->no_telp }}" 
                                            data-id="{{ $item->upt->id }}" 
                                      
                                            onclick="edit(this)">Edit</button>
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

@include('admin.pages.upt.edit')
@endsection

@push('after-script')
<script>
    function edit(edit)
    {
        var route = $(edit).data('route');
        var name = $(edit).data('name');
        var kepala = $(edit).data('kepala');
        var alamat = $(edit).data('alamat');
        var telp = $(edit).data('telp');
        var id = $(edit).data('id');

        $('#form-edit').attr('action', route);
        $('#name-edit').val(name);
        $('#id-edit').val(id);
        $('#kepala_upt-edit').val(kepala);
        $('#alamat-edit').val(alamat);
        $('#no_telp-edit').val(telp);
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
        title: 'Yakin menghapus user ini?',
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