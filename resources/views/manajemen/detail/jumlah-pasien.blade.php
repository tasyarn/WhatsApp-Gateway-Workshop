@extends('layout.master')
@section('title')
    Dashboard Manajemen - {{ $companyname }}
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('sidebar')
    @include('layout.sidebar-manajemen')
@endsection
@section('konten')
    <div class="page-heading">
        <h3>{{ $title }}</h3>
    </div>
    <div class="page-content">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Keaktifan Pegawai</h6>
                                    <a class="font-extrabold mb-0" href="/manajemen/detail?page=keaktifan-pegawai">Lihat
                                        Statistik</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fa-solid fa-user-injured"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Jumlah Pasien</h6>
                                    <a class="font-extrabold mb-0" href="/manajemen/detail?page=jumlah-pasien">Lihat
                                        Statistik</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Jumlah Transaksi</h6>
                                    <a class="font-extrabold mb-0" href="/manajemen/detail?page=jumlah-transaksi">Lihat
                                        Statistik</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-4 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-8">
                                    <h6 class="text-muted font-semibold">Response Time</h6>
                                    <a class="font-extrabold mb-0" href="/manajemen/detail?page=response-time">Lihat
                                        Statistik</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Monthly</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="bar-monthly"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Annual</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="bar-annual"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('script')
    <script src="/assets/extensions/chart/Chart.min.js"></script>
    <script src="/assets/pages/chart.js"></script>
    <script>
        var ctxBar = document.getElementById("bar-monthly").getContext("2d");
        var myBar = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: 'Pasien',
                    backgroundColor: [chartColors.info, chartColors.info, chartColors.info, chartColors
                        .info, chartColors.info, chartColors.info, chartColors.info, chartColors.info,
                        chartColors.info, chartColors.info, chartColors.info, chartColors.info
                    ],
                    data: {!! json_encode($chartdatasetmonthly) !!}
                }]
            },
            options: {
                responsive: true,
                barRoundness: 1,
                title: {
                    display: true,
                    text: "Pasien in 2023"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 40 + 20,
                            padding: 10,
                        },
                        gridLines: {
                            drawBorder: false,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        var ctxBar = document.getElementById("bar-annual").getContext("2d");
        var myBar = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ["2018", "2019", "2020", "2022", "2023"],
                datasets: [{
                    label: 'Pasien',
                    backgroundColor: [chartColors.info, chartColors.info, chartColors.info, chartColors
                        .info, chartColors.info, chartColors.info
                    ],
                    data: {!! json_encode($chartdatasetannual) !!}
                }]
            },
            options: {
                responsive: true,
                barRoundness: 1,
                title: {
                    display: true,
                    text: "Pasien last 5 years"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 40 + 20,
                            padding: 10,
                        },
                        gridLines: {
                            drawBorder: false,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        }
                    }]
                }
            }
        });
    </script>
@endsection
@endsection
