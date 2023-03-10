@extends('user.layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-12">
            <div class="service-area">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-12">
                            <!-- Section Tittle -->
                            <div class="section-tittle text-center mb-80">
                                <h4>Visi</h4>
                                <p>{{ $data->visi }}</p>
                                <h4>Misi</h4>
                                <p>{!! $data->misi !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <section class="about-low-area py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="about-caption mb-50">
                                <!-- Section Tittle -->
                                <div class="section-tittle mb-35">
                                    <span>Tentang Yayasan Kami</span>
                                    <h2>Profil dan Sejarah Yayasan Yatim Al-Ihsan</h2>
                                </div>
                            </div>
                            <img src="{{ asset('storage/'.$data->foto) }}" alt="" class="img-fluid mb-3">
                            <p>
                                {{ $data->sejarah }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
