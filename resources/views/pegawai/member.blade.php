@extends('layout.master')
@section('style')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />

    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css" />
@endsection
@section('sidebar')
    @include('layout.sidebar-pegawai')
@endsection
@section('konten')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Member</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/pegawai">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Member
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">Data Member
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahmember">
                        <i class="bi bi-person-fill-add"></i> Tambah Member
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                   
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>ID Member</th>
                                    <th>Nama</th>
                                    <th>No. Telepon</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ( $members as $item )
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->nama_member}}</td>
                                    <td>{{$item->no_member}}</td>
                                    <td>{{$item->alamat_member}}</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
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
    <!--login form Modal -->
    <div class="modal fade text-left" id="tambahpegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Pegawai
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form method="POST" action="/admin/pegawai/tambah-pegawai" data-parsley-validate>
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="role" value="0" />
                        <label>Nama: </label>
                        <div class="form-group">
                            <input required type="text" name="name" placeholder="Nama" class="form-control" />
                        </div>
                        <label>Email: </label>
                        <div class="form-group">
                            <input required type="email" name="email" placeholder="Email" class="form-control"
                                data-parsley-type="email"
                                data-parsley-error-message="Masukkan format email yang valid." />
                        </div>
                        <label>Nomor Telepon: </label>
                        <div class="form-group">
                            <input required type="tel" name="phone_number" placeholder="Nomor Telepon"
                                class="form-control" data-parsley-type="number"
                                data-parsley-error-message="Masukkan format nomor telepon yang valid." />
                        </div>
                        <label>Password: </label>
                        <div class="form-group">
                            <input required type="password" name="password" placeholder="Password" class="form-control"
                                id="password" data-parsley-minlength="8"
                                data-parsley-error-message="Kata sandi harus lebih besar dari atau sama dengan 8." />
                        </div>
                        <label>Konfirmasi Password: </label>
                        <div class="form-group">
                            <input required type="password" name="password_confirm" placeholder="Konfirmasi Password"
                                class="form-control" data-parsley-equalto="#password"
                                data-parsley-error-message="Kata sandi tidak cocok." />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tambah</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection
