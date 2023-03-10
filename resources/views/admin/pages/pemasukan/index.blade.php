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
                                <h4 class="card-title font-weight-normal">Data Pemasukan</h4>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#create">+ Tambah Pemasukan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                                    <td>Rp. {{ $item->nominal }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                            data-route="{{ route('pemasukan.update', $item->id) }}" 
                                            data-keterangan="{{ $item->keterangan }}" 
                                            data-tanggal="{{ $item->tanggal }}" 
                                            data-nominal="{{ $item->nominal }}" 
                                            onclick="editPemasukan(this)"
                                        >Ubah</button>
                                        <form action="{{ route('pemasukan.destroy', $item->id) }}" method="post" class="ml-1 d-inline" id="form-hapus-{{ $item->id }}">
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

@include('admin.pages.pemasukan.create')
@include('admin.pages.pemasukan.edit')
@endsection

@push('after-script')
<script>
    function editPemasukan(edit)
    {
        var route = $(edit).data('route');
        var keterangan = $(edit).data('keterangan');
        var tanggal = $(edit).data('tanggal');
        var nominal = $(edit).data('nominal');

        $('#edit_keterangan').val(keterangan);
        $('#edit_tanggal').val(tanggal);
        $('#edit_nominal').val(nominal);

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
        title: 'Yakin menghapus pemasukan ini?',
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