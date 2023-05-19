@extends('user.layouts.default')

@section('content')
<div class="container">
    <div class="row">
    </div>
    <div class="row">
        <div class="col-12">
            <section class="about-low-area py-5">
                <div class="container">
                    <h4 class="mb-5">Daftar Kegiatan Yayasan</h4>
                    <div class="row">
                        @foreach ($kegiatan as $item)
                        <div class="col-6">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row no-gutters">
                                  <div class="col-md-4">
                                    <img src="storage/{{ $item->foto }}" alt="..." height="150px">
                                  </div>
                                  <div class="col-md-8">
                                    <div class="card-body">
                                      <h5 class="card-title">{{ $item->judul }}</h5>
                                      <p class="card-text">{{ $item->deskripsi }}</p>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
