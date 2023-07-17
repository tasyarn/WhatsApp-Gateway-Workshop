@extends('layout.master')
@section('title')
    Data Obat - {{ $companyname }}
@endsection
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
                    <h3>Data Obat</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/manajemen">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Obat
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if (session()->has('pesan'))
            <div class="alert alert-success alert-dismissible show fade" role="alert">
                {{ session('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">Data Obat
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="bi bi-capsule"></i> Tambah Obat
                    </button>
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahpegawai">
                        <i class="bi bi-person-fill-add"></i> Tambah Obat
                    </button> --}}
                </div>
                <section id="collapseOne" class=" accordion-collapse collapse section" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Tambah Data Obat</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form form-horizontal" method="POST" action="/manajemen/obat/store"
                                                data-parsley-validate>
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Nama Obat</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" id="nama_obat" class="form-control"
                                                                name="nama_obat" placeholder="Nama Obat" required
                                                                data-parsley-error-message="Masukkan nama obat yang valid.">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Harga</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="number" id="harga_obat" class="form-control"
                                                                name="harga_obat" placeholder="Harga Obat" required
                                                                data-parsley-error-message="Masukkan harga obat yang valid.">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Stok</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="number" id="stok_obat" class="form-control"
                                                                name="stok_obat" placeholder="Stok Obat" required
                                                                data-parsley-error-message="Masukkan stok obat yang valid.">
                                                        </div>
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary me-1 mb-1">Tambah
                                                                Obat</button>
                                                            <button type="reset"
                                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Ubah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicines as $medicine)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $medicine->nama_obat }}</td>
                                        <td>Rp{{ number_format($medicine->harga_obat, 2, ',', '.') }}</td>
                                        <td>{{ $medicine->stok_obat }}</td>
                                        <td>
                                            @if ($medicine->status_obat == 1)
                                                Aktif
                                            @else
                                                Tidak Aktif
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#ubah{{ $medicine->id }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <div class="modal fade text-left" id="ubah{{ $medicine->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">
                                                                Ubah Obat
                                                            </h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="/manajemen/obat/ubah" data-parsley-validate>
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id"
                                                                    value="{{ $medicine->id }}" />
                                                                <label>Nama Obat: </label>
                                                                <div class="form-group">
                                                                    <input required type="text"
                                                                        value="{{ $medicine->nama_obat }}" name="nama"
                                                                        placeholder="Nama Obat" class="form-control"
                                                                        data-parsley-error-message="Masukkan nama obat yang valid." />
                                                                </div>
                                                                <label>Harga: </label>
                                                                <div class="form-group">
                                                                    <input required type="number"
                                                                        value="{{ $medicine->harga_obat }}"
                                                                        name="harga" placeholder="Harga"
                                                                        class="form-control"
                                                                        data-parsley-error-message="Masukkan harga obat yang valid." />
                                                                </div>
                                                                <label>Stok: </label>
                                                                <div class="form-group">
                                                                    <input required type="number"
                                                                        value="{{ $medicine->stok_obat }}" name="stok"
                                                                        placeholder="Stok" class="form-control"
                                                                        data-parsley-error-message="Masukkan stok obat yang valid." />
                                                                </div>
                                                                <label>Status: </label>
                                                                <div class="form-group">
                                                                    <select class="form-select" name="status">
                                                                        <option value="0"
                                                                            @if ($medicine->status_obat == 0) selected @endif>
                                                                            Tidak Aktif</option>
                                                                        <option value="1"
                                                                            @if ($medicine->status_obat == 1) selected @endif>
                                                                            Aktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Tutup</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ml-1"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Ubah</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/static/js/pages/parsley.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection
