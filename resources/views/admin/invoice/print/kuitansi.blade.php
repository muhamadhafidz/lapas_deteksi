<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kuitansi Donasi</title>
    <style>
        body{
            color: black;
            font-family: Arial, Helvetica, sans-serif;
        }
        .template{
            position: absolute;
            right: -43px;
            bottom: -40px;
        }
        .container {
            position: relative;
            text-align: center;
        }
        .inv-num {
            position: absolute;
            top: -35px;
            left: 175px;
        }

        .company {
            position: absolute;
            top: -7px;
            left: 300px;
        }

        .terbilang {
            position: absolute;
            top: 28px;
            left: 270px;
            text-align: left;
        }

        .terbilang {
            position: absolute;
            top: 28px;
            left: 270px;
            text-align: left;
        }

        .pembayaran {
            position: absolute;
            top: 57px;
            left: 300px;
            text-align: left;
        }

        .total {
            position: absolute;
            top: 185px;
            left: 225px;
            text-align: left;
        }


        .ttd {
            position: absolute;
            top: 227px;
            left: 500px;
            text-align: left;
        }

        .tanggal {
            position: absolute;
            top: 122px;
            left: 500px;
            text-align: left;
        }

        .inv-ext{
            font-size: 13px;
            position: absolute;
            top: -35px;
            left: 570px;
        }


    </style>
</head>
<body>
    <div class="container">
        <img class="template" src="{{public_path('img/kuitansi.png')}}" alt="">
        {{-- <div class="inv-ext"> <b>{{$donasi->id}}</b></div> --}}
        <div class="inv-num"><h4>{{$donasi->id}}</h4></div>
        <div class="company"><h4>{{$donasi->nama_donatur}}</h4></div>
        <div class="terbilang"><h5><b> {{ucwords($terbilang)}} Rupiah</b></h5></div>
        <div class="pembayaran"><h5>Donasi Yayasan Yatim Al-Ihsan</h5></div>
        <div class="total"><h4>{{number_format($donasi->nominal_donasi)}}</h4></div>
        <div class="tanggal"><h5> {{date_format(date_create($donasi->created_at),'d F Y')}}</h5></div>
        {{-- <div class="ttd"><h5>{{$setting->direktur}}</h5></div> --}}

    </div>
</body>
</html>
