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
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Obat</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/manajemen">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a href="/manajemen/obat">Data Obat</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tambah Data obat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                </div>
                <div class="card-body">
                    <form action="storeObat" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-12">
                          <div class="form-group">
                            <label for="nama_obat">Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat" rows="3" name="nama_obat" required>
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                              <label for="harga_obat">Harga Obat</label>
                              <input type="text" class="form-control" id="harga_obat" rows="3" name="harga_obat" required>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                              <label for="stok_obat">Stok Obat</label>
                              <input type="text" class="form-control" id="stok_obat" rows="3" name="stok_obat" required>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                          <button type="submit" class="btn btn-primary me-1 mb-1">
                            Submit
                          </button>
                          <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                            Reset
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection


