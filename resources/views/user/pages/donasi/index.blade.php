@extends('user.layouts.default')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 col-12 text-center">
            <h1 class="mt-5">Donasi {{ $data->nama_yayasan }}</h1>
            <div class="card py-3">
                <h3 class="font-weight-bold">{{ $data->nomor_rekening }}</h3>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <form action="{{ route('home.uploadDonasi') }}" class="mt-5" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_donatur">Nama Donatur</label>
                    <input type="text" class="form-control" name="nama_donatur" id="nama_donatur">
                </div>
                <div class="form-group">
                    <label for="nama_bank">Nama Bank</label>
                    <input type="text" class="form-control" name="nama_bank" id="nama_bank">
                </div>
                <div class="form-group">
                    <label for="tanggal_donasi">Tanggal Donasi</label>
                    <input type="date" class="form-control" name="tanggal_donasi" id="tanggal_donasi">
                </div>
                <div class="form-group">
                    <label for="nominal_donasi">Nominal Donasi</label>
                    <input type="number" class="form-control" name="nominal_donasi" id="nominal_donasi">
                </div>
                <div class="form-group">
                    <label for="bukti_donasi">Bukti</label>
                    <input type="file" class="form-control" name="bukti_donasi" id="bukti_donasi">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
