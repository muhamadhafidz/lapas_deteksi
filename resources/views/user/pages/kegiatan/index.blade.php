@extends('user.layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <section class="about-low-area py-5">
                <div class="container">
                    @foreach ($data as $item)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                          <div class="col-md-4">
                            <img src="storage/{{ $item->foto }}" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">{{ $item->judul }}</h5>
                              <p class="card-text">{{ $item->deskripsi }}</p>
                            </div>
                          </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
