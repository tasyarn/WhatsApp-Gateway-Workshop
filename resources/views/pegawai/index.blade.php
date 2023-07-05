@extends('layout.master')
@section('title')
    Dashboard Pegawai - {{ $companyname }}
@endsection
@section('sidebar')
    @include('layout.sidebar-pegawai')
@endsection
@section('konten')
<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-20 col-xxl-20">
                                    <h6 class="text-muted font-semibold">Keaktifan Pegawai</h6>
                                    <h6 class="font-extrabold mb-0">45%</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-20 col-xxl-20">
                                    <h6 class="text-muted font-semibold">Jumlah Member</h6>
                                    <h6 class="font-extrabold mb-0">30</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jumlah Member</h4>
                        </div>
                        <div class="card-body">
                            <h6>Setiap 3 Bulan</h6>
                            <div id="chart-member-bulan"></div>
                        </div>
                        <div class="card-body">
                            <h6>Setiap Tahun</h6>
                            <div id="chart-member-tahun"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Keaktifan Pegawai</h4>
                        </div>
                        <div class="card-body">
                            <h6>Setiap 3 Bulan</h6>
                            <div id="chart-aktif-bulan"></div>
                        </div>
                        <div class="card-body">
                            <h6>Setiap Tahun</h6>
                            <div id="chart-aktif-tahun"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="/assets/static/js/pages/dashboard.js"></script>
    @endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
    <script src="/assets/static/js/pages/dashboard.js"></script>
@endsection
