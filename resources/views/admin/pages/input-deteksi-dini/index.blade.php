
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
                                <h4 class="card-title font-weight-normal">Input Deteksi Dini</h4>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('user.input-deteksi-dini.create') }}" class="btn btn-sm btn-success">+ Tambah Deteksi Dini Baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered display nowrap"  id="crudTable" style="width: 100%">
                            <thead>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Kuartal</th>
                                <th>Total Nilai Bobot Ideal</th>
                                <th>Total TSC</th>
                                <th>Total Nilai Bobot Potensi Gangguan Keamanan</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($insData as $data)
                                    <tr class="font-weight-bold">
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="width: 30%">{{ $data->year }}</td>
                                        <td style="width: 30%">{{ $data->quartal }}</td>
                                        <td>{{ $data->sub_category_answers->sum('nilai_bobot_ideal') }}</td>
                                        <td>{{ $data->bobot_total }}</td>
                                        <td>{{ $data->sub_category_answers->sum('nilai_bobot_ideal') - $data->bobot_total }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary" 
                                                href="{{ route('user.input-deteksi-dini.detail', $data->id) }}"
                                                >Detail</a>
                                            <form action="{{ route('user.input-deteksi-dini.delete', $data->id) }}" method="post" class="ml-1 d-inline" id="form-hapus-{{ $data->id }}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" onclick="hapus({{ $data->id }})" class="btn btn-danger btn-sm">Hapus</button>
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
@endsection

@push('after-script')
<script>
    
    $(document).ready(function(){
        $('#crudTable').DataTable({
          dom: 'Blfrtip',
          buttons: [ 
            {
                extend: 'print',
                text: 'Print',
                customize: function (win) {
                    $(win.document.body).find('table thead tr th:nth-child(7), table tbody tr td:nth-child(7)').hide();
                }
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
