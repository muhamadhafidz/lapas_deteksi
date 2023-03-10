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
                                <h4 class="card-title font-weight-normal">Data Profil Yayasan</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped display nowrap"  id="crudTable" style="width: 100%">
                            <tbody>
                                <tr>
                                    <th>Logo</th>
                                    <td><img src="{{ $data->logo_pic ? asset('storage/'.$data->logo_pic): '' }}" alt="" height="100px">
                                        <br>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                        data-route="{{ route('profil-yayasan.uploadFoto', [$data->id, 'logo']) }}" 
                                        data-tipe="Logo"
                                        onclick="uploadFoto(this)"
                                    >Ubah</button>
                                    </td>  
                                </tr>
                                <tr>
                                    <th>Nama Yayasan</th>
                                    <td>{{ $data->nama_yayasan }}</td>  
                                </tr>
                                <tr>
                                    <th>Sejarah</th>
                                    <td>{{ $data->sejarah }}</td>  
                                </tr>
                                <tr>
                                    <th>visi</th>
                                    <td>{{ $data->visi }}</td>  
                                </tr>
                                <tr>
                                    <th>misi</th>
                                    <td>{{ $data->misi }}</td>  
                                </tr>
                                <tr>
                                    <th>Nomor Rekening</th>
                                    <td>{{ $data->nomor_rekening }}</td>  
                                </tr>
                                <tr>
                                    <th>Struktur Organisasi</th>
                                    <td><img src="{{ $data->struktur_organisasi ? asset('storage/'.$data->struktur_organisasi) : '' }}" alt="" height="100px">
                                    
                                        <br>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                        data-route="{{ route('profil-yayasan.uploadFoto', [$data->id, 'org']) }}" 
                                        data-tipe="Struktur Organisasi"
                                        onclick="uploadFoto(this)">Ubah</button>

                                    </td>  
                                </tr>
                                <tr>
                                    <th>Foto</th>
                                    <td><img src="{{ $data->foto ? asset('storage/'.$data->foto) : '' }}" alt="" height="100px">
                                        <br>
                                        <button type="button" class="btn btn-sm btn-warning" 
                                        data-route="{{ route('profil-yayasan.uploadFoto', [$data->id, 'foto']) }}" 
                                        data-tipe="Foto yayasan"
                                        onclick="uploadFoto(this)">Ubah</button>
                                    </td>  
                                </tr>
                               
                                        
                                
                                
                            </tbody>

                        </table>
                        <button type="button" class="btn btn-sm btn-warning" 
                        data-route="{{ route('profil-yayasan.update', $data->id) }}" 
                        data-namayayasan="{{ $data->nama_yayasan }}"
                        data-sejarah="{{ $data->sejarah }}"
                        data-visi="{{ $data->visi }}"
                        data-misi="{{ $data->misi }}"
                        data-norek="{{ $data->nomor_rekening }}"
                        onclick="editDonatur(this)"
                    >Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


@include('admin.pages.profil-yayasan.foto')
@include('admin.pages.profil-yayasan.edit')
@endsection

@push('after-script')
<script>
    function editDonatur(edit)
    {
        var nama_yayasan = $(edit).data('namayayasan');
        var sejarah = $(edit).data('sejarah');
        var visi = $(edit).data('visi');
        var misi = $(edit).data('misi');
        var norek = $(edit).data('norek');
        var route = $(edit).data('route');

        $('#edit_nama_yayasan').val(nama_yayasan);
        $('#edit_sejarah').val(sejarah);
        $('#edit_visi').val(visi);
        $('#edit_misi').val(misi);
        $('#edit_norek').val(norek);
        
        CKEDITOR.replace( 'edit_misi' );

        $('#form-edit').attr('action', route);
        $('#edit').modal('show');
    }

    function uploadFoto(edit)
    {
        var tipe = $(edit).data('tipe');
        var route = $(edit).data('route');

        $('#tipe-upload').html(tipe);
        
       

        $('#form-foto').attr('action', route);
        $('#foto').modal('show');
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
@push('before-script')
<script src="//cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

    <script>
        
        
        
        
        
    </script>
@endpush