@extends('user.layouts.default')

@section('content')
<!-- slider Area Start-->
<div class="slider-area">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10">
                        <div class="hero__caption">
                            <h1 data-animation="fadeInUp" data-delay=".6s">{{ $data->nama_yayasan }}</h1>
                            <!-- <P data-animation="fadeInUp" data-delay=".8s" >Onsectetur adipiscing elit, sed do eiusmod tempor incididunt ut bore et dolore magnt, sed do eiusmod.</P> -->
                            <!-- Hero-btn -->
                            <div class="hero__btn">
                                <a href="{{ route('home.donasi') }}" class="btn hero-btn mb-10"  data-animation="fadeInLeft" data-delay=".8s">Donasi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- slider Area End-->
<!--? Services Area Start -->
<div class="service-area section-padding30">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-10 col-sm-10">
                <!-- Section Tittle -->
                <div class="section-tittle text-center mb-80">
                    <h2>Visi</h2>
                    <p>{{ $data->visi }}</p>
                    <h2>Misi</h2>
                    <span>{!! $data->misi !!}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services Area End -->
<!--? About Law Start-->
<section class="about-low-area section-padding2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10">
                <div class="about-caption mb-50">
                    <!-- Section Tittle -->
                    <div class="section-tittle mb-35">
                        <span>Tentang Yayasan Kami</span>
                        <h2>Profil dan Sejarah Yayasan Yatim Al-Ihsan</h2>
                    </div>
                </div>
                <a href="about.html" class="btn">Selengkapnya -></a>
            </div>
            <div class="col-lg-6 col-md-12">
                <!-- about-img -->
                <div class="about-img ">
                    <div class="about-font-img d-none d-lg-block">
                        <img src="{{ ('assets/img/gallery/about2.jpg') }}" alt="" height="200px">
                    </div>
                    <div class="about-back-img ">
                        <img src="{{ ('assets/img/gallery/about1.jpg') }}" alt="" height="200px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Law End-->
<!--? Blog Area Start -->
{{-- <section class="home-blog-area section-padding30">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-9 col-sm-10">
                <div class="section-tittle text-center mb-90">
                    <span>Kegiatan</span>
                    <h2>Kegiatan Yayasan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="home-blog-single mb-30">
                    <div class="blog-img-cap">
                        <div class="blog-img">
                            <img src="{{ ('assets/img/gallery/home-blog1.png') }}" alt="">
                            <!-- Blog date -->
                            <div class="blog-date text-center">
                                <span>24</span>
                                <p>Now</p>
                            </div>
                        </div>
                        <div class="blog-cap">
                            <p>Creative derector</p>
                            <h3><a href="blog_details.html">Footprints in Time is perfect House in Kurashiki</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="home-blog-single mb-30">
                    <div class="blog-img-cap">
                        <div class="blog-img">
                            <img src="{{ ('assets/img/gallery/home-blog2.png') }}" alt="">
                            <!-- Blog date -->
                            <div class="blog-date text-center">
                                <span>24</span>
                                <p>Now</p>
                            </div>
                        </div>
                        <div class="blog-cap">
                            <p>Creative derector</p>
                            <h3><a href="blog_details.html">Footprints in Time is perfect House in Kurashiki</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Blog Area End -->

<div class="bg-dark text-white text-center" style="padding-top:20px; padding-bottom:20px ;width:100%">
    Copyright Yayasan Yatim Al-Ihsan | <u><a href="{{ route('login') }}">Login Admin</a></u>
</div>
@endsection
