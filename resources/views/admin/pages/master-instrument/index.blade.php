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
                                <h4 class="card-title font-weight-normal">Data Master Instrument</h4>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#create">+ Tambah Element Assessment</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Element Assessment</th>
                                <th>Deskripsi</th>
                                <th>Nilai Bobot Ideal</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($cat as $ct)
                                    <tr class="font-weight-bold" style="background-color: grey">
                                        <td></td>
                                        <td colspan="4" style="font-size: 11px; color: white;">{{ $loop->iteration }} {{ $ct->name }}</td>
                                    </tr>
                                        @foreach ($ct->sub_categories as $sub)
                                        <tr class="font-weight-bold" style="background-color: rgb(195, 195, 195)">
                                            <td></td>
                                            <td colspan="4" style="font-size: 11px;">{{ $sub->name }}</td>
                                        </tr>
                                            @forelse ($sub->instrument as $item)
                                            <tr>
                                                <td class="align-middle text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->element_assessment }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                @if ($loop->index <= 0)
                                                <td class="align-middle text-center" rowspan="{{ $sub->instrument->count() }}">{{ $sub->nilai_bobot_ideal }}</td>
                                                @endif
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning" 
                                                        data-route="{{ route('admin.master-instrument.update', $item->id) }}" 
                                                        data-element="{{ $item->element_assessment }}"
                                                        data-deskripsi="{{ $item->deskripsi }}"
                                                        data-sub="{{ $item->sub_category_id }}"
                                                        data-absolute="{{ $item->is_absolute }}"
        
                                                        onclick="edit(this)">Edit</button>
                                                    <form action="{{ route('admin.master-instrument.delete', $item->id) }}" method="post" class="ml-1 d-inline" id="form-hapus-{{ $item->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" onclick="hapus({{ $item->id }})" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td class="align-middle text-center" colspan="5">Tidak ada instrument data</td>
                                            </tr>
                                            @endforelse
                                        @endforeach
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

@include('admin.pages.master-instrument.create')
@include('admin.pages.master-instrument.edit')
@endsection

@push('after-script')
<script>
    function edit(edit)
    {
        var route = $(edit).data('route');
        var element = $(edit).data('element');
        var deskripsi = $(edit).data('deskripsi');
        var bobot = $(edit).data('bobot');
        var category = $(edit).data('category');
        var sub = $(edit).data('sub');
        var absolute = $(edit).data('absolute');

        $('#form-edit').attr('action', route);
        $('#edit_element_assessment').val(element);
        $('#edit_deskripsi').val(deskripsi);
        $('#edit_sub_category_id').val(sub);
        $('#edit_is_absolute').val(absolute);

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
        title: 'Yakin menghapus?',
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
