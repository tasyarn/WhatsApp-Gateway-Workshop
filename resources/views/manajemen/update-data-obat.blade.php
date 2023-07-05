@extends('layout.master')
@section('style')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />

    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css" />
@endsection
@section('sidebar')
    @include('layout.sidebar-manajemen')
@endsection
@section('konten')
    <div class="page-heading">
        <div class="page-title">
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">

                        </header>
                        <div class="page-heading">
                            <div class="page-title">
                                <div class="row">
                                    <div class="col-12 col-md-6 order-md-1 order-last">
                                    </div>
                                    <div class="col-12 col-md-6 order-md-2 order-first">
                                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Edit Data Obat</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        <section id="multiple-column-form">
                            <div class="row match-height">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Edit Data Obat</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="form">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="first-name-column">ID</label>
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="ID" name="fname-column">
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-8 col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="city-column">Nama Obat</label>
                                                                <input type="text" id="city-column" class="form-control" placeholder="Nama Obat"
                                                                    name="city-column">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-8 col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label for="company-column">Harga Obat</label>
                                                                <input type="text" id="company-column" class="form-control"
                                                                    name="company-column" placeholder="Harga Obat">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-6 col-12">
                                                            <fieldset class="form-group">
                                                                <label for="company-column">Status</label>
                                                                <select class="form-select" id="basicSelect">
                                                                    <option>Active</option>
                                                                    <option>Inactive</option>
                                                                </select>
                                                            </fieldset>
                                                        </div>


                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>




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
                    </div>
                @endsection
                @section('script')
                    <script src="/assets/extensions/jquery/jquery.min.js"></script>
                    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
                    <script src="/assets/static/js/pages/datatables.js"></script>
                @endsection
