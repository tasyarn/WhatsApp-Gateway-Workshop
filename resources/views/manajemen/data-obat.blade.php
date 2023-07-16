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

                        </ol>
                    </nav>
                </div>
            </div>
        </div><div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Data Obat</h3>
                            <p class="text-subtitle text-muted">Obat-obat yang tersedia di Apotek Bina Sehat</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Obat</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Data Obat Apotek Bina Sehat
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>ID Obat</th>
                                        <th>Nama Obat</th>
                                        <th>Harga Obat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Paracetamol</td>
                                        <td>10.000</td>
                                        <td>
                                            <span class="badge bg-success">Active</span></td>
                                        <td> <div class="buttons">
                                            <a href="/manajemen/update-data-obat" class="btn btn-primary">Edit</a></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Lansoprazole</td>
                                        <td>12.500</td>
                                        <td>
                                            <span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="buttons">
                                                <a href="/manajemen/update-data-obat" class="btn btn-primary">Edit</a></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Domperidone</td>
                                        <td>6.000</td>
                                        <td>
                                            <span class="badge bg-success">Active</span></td>
                                        <td>
                                            <div class="buttons">
                                                <a href="/manajemen/update-data-obat" class="btn btn-primary">Edit</a></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection
