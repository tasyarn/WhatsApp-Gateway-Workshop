@extends('layout.master')
@section('title')
    Data Pegawai - {{ $companyname }}
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
                    <h3>Data Pegawai</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/manajemen">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Pegawai
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
        @if (session()->has('salah'))
            <div class="alert alert-danger alert-dismissible show fade" role="alert">
                {{ session('salah') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">Data Pegawai
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="bi bi-person-fill-add"></i> Tambah Pegawai
                    </button>
                </div>
                <section id="collapseOne" class=" accordion-collapse collapse section" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Tambah Pegawai</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form form-horizontal" method="POST" action="/manajemen/pegawai/store"
                                                data-parsley-validate>
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Nama Pegawai</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control"
                                                                name="nama" placeholder="Nama Pegawai" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>No Pegawai</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="tel" class="form-control"
                                                                name="no" placeholder="No Pegawai" required data-parsley-type="number"
                                                                data-parsley-minlength="9"
                                                                data-parsley-maxlength="14"
                                                                data-parsley-error-message="Masukkan format no telepon yang valid.">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Password</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="password" class="form-control"
                                                                name="password" placeholder="Password Pegawai" required data-parsley-minlength="8"
                                                                data-parsley-error-message="Kata sandi harus lebih besar dari atau sama dengan 8.">
                                                        </div>
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary me-1 mb-1">Tambah
                                                                Pegawai</button>
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
                                    <th>Nama Pegawai</th>
                                    <th>No Telepon</th>
                                    <th>Status</th>
                                    <th>Ubah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->no }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                Aktif
                                            @else
                                                Tidak Aktif
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#ubah{{ $item->id }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <div class="modal fade text-left" id="ubah{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">
                                                                Ubah Pegawai
                                                            </h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="/manajemen/pegawai/ubah"
                                                            data-parsley-validate>
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="{{ $item->id }}" />
                                                                <label>Nama Pegawai: </label>
                                                                <div class="form-group">
                                                                    <input required type="text" name="nama"
                                                                        placeholder="Nama" class="form-control" value="{{ $item->nama }}" />
                                                                </div>
                                                                <label>No Telepon: </label>
                                                                <div class="form-group">
                                                                    <input required type="tel" name="no"
                                                                        placeholder="Nomor Telepon" value="{{ $item->no }}" class="form-control"
                                                                        data-parsley-type="number"
                                                                        data-parsley-minlength="9"
                                                                        data-parsley-maxlength="14"
                                                                        data-parsley-error-message="Masukkan format no telepon yang valid." />
                                                                </div>
                                                                <label>Status: </label>
                                                                <div class="form-group">
                                                                    <select class="form-select" name="status">
                                                                        <option value="0" @if ($item->status == 0) selected @endif>Tidak Aktif</option>
                                                                        <option value="1" @if ($item->status == 1) selected @endif>Aktif</option>
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
