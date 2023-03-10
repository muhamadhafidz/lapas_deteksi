@extends('user.layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <section class="about-low-area py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="about-caption mb-50">
                                <!-- Section Tittle -->
                                <div class="section-tittle mb-35">
                                    <span>Struktur Yayasan Kami</span>
                                    <h2>Struktur Organisasi Yayasan Yatim Al-Ihsan</h2>
                                </div>
                            </div>
                            <img src="{{ asset('storage/'.$data->struktur_organisasi) }}" alt="" class="img-fluid mb-3">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
