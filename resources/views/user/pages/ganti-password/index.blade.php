@extends('admin.layouts.default')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card " style="width: 500px">
                    <div class="card-header">
                        <h5 class="font-weight-bold">Ganti Password</h5>
                    </div>
                    <div class="card-body">
                        <div class="container my-4">
                            <div class="row">
                                <div class="col">
                                    <form method="POST" action="{{ route('user.ganti-password.store') }}" id="pass-form" enctype="multipart/form-data">
                                        {{-- @method('PUT') --}}
                                        @csrf
                                        <div class="form-group">
                                            <label for="password_old">Password Lama</label>
                                            <input type="password" class="form-control" id="password_old" name="password_old" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="password_new">Password Baru</label>
                                            <input type="password" class="form-control" id="password_new" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_new_konf">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" id="password_new_konf" name="password_confirmation" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary " id="submit-form">Simpan</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>


@endsection
@push('after-script')
    <script>
        function submitFoto(){
            $('#foto-form').submit();
        }
        function submitPass(){
            // var lama = $("#password_old").val();
            // var baru = $("#password_new").val();
            // var konf = $("#password_new_konf").val();
            // if (lama == "") {
                
            // }
            $('#submit-form').click();
        }
    </script>
@endpush