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
                                <h4 class="card-title font-weight-normal">Data Master User</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart" ></div>
                        <div id="chart2" ></div>
                        <div class="my-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .table {
        table-layout: fixed;
    }
    #chart {
        max-width: 950px;
        margin: 35px auto;
    }

</style>
<!-- Button trigger modal -->
@endsection

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

    var merah = '{{ $merah }}';
    merah = parseInt(merah);
    var orange = '{{ $orange }}';
    orange = parseInt(orange);
    var kuning = '{{ $kuning }}';
    kuning = parseInt(kuning);
    var hijau = '{{ $hijau }}';
    hijau = parseInt(hijau);

    var total = merah + orange + kuning + hijau;


    var options = {
        chart: {
            type: 'pie'
        },
        colors:['#57f542', '#fcd305', '#f59642', '#f54e42'],
        series: [((hijau/total) * 100), ((kuning/total) * 100), ((orange/total) * 100), ((merah/total) * 100)],
        labels: ['Ko operatif', 'Secara verbal resersif', 'Secara fisik tidak kooperatif', 'Menyerang - Potensi menimbulkan kerusakan fisik atau kematian - Melarikan diri']
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
    
    var dataMerah = '{{ $merahArry }}';
    dataMerah = dataMerah.trimEnd();
    dataMerah = dataMerah.split(' ');

    var dataOrange = '{{ $orangeArry }}';
    dataOrange = dataOrange.trimEnd();
    dataOrange = dataOrange.split(' ');

    var dataKuning = '{{ $kuningArry }}';
    dataKuning = dataKuning.trimEnd();
    dataKuning = dataKuning.split(' ');

    var dataHijau = '{{ $hijauArry }}';
    dataHijau = dataHijau.trimEnd();
    dataHijau = dataHijau.split(' ');

    var upt = '{{ $upt }}';
    upt = upt.trimEnd();
    upt = upt.split(' ');


    var options2 = {
        colors:['#57f542', '#fcd305', '#f59642', '#f54e42'],
        series: [
            {
                name: 'Ko operatif',
                data: dataHijau
            },
            {
                name: 'Secara verbal resersif',
                data: dataKuning
            },
            {
                name: 'Secara fisik tidak kooperatif',
                data: dataOrange
            },
            {
                name: 'Menyerang - Potensi menimbulkan kerusakan fisik atau kematian - Melarikan diri',
                data: dataMerah
            }
        ],
        chart: {
            type: 'bar',
            height: 350
        },
        xaxis: {
            categories: upt,
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
    };

    var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);

    chart2.render();
    
</script>
@endpush