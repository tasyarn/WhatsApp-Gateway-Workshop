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

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">Data Pegawai
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahpegawai">
                        <i class="bi bi-person-fill-add"></i> Tambah Pegawai
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            @foreach ($pegawai as $data)
                                ;
                                <tbody>
                                    <tr>
                                        <td>{{ $data->nama_pegawai }}</td>
                                        <td>{{ $data->no_pegawai }}</td>
                                        <td>{{ $data->alamat_pegawai }}</td>
                                        <td>{{$data->status}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editpegawai{{$data->id}}">
                                                Edit
                                            </button>
                                            <div class="modal fade text-left" id="editpegawai{{$data->id}}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">
                                                                Edit Pegawai
                                                            </h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form
                                                            onsubmit="return confirm('Apakah data yang dimasukkan sudah benar?')"
                                                            method="POST" action="/manajemen/pegawai/{{$data->id}}"
                                                            data-parsley-validate>
                                                            @csrf
                                                            @method('put')
                                                            <div class="modal-body">
                                                                <input type="hidden" name="role" value="0" />
                                                                <label>Nama: </label>
                                                                <div class="form-group">
                                                                    <input required type="text" name="nama_pegawai"
                                                                        id="nama_pegawai" placeholder="Nama"
                                                                        class="form-control" value="{{$data->nama_pegawai }}" />
                                                                </div>
                                                                <label>Nomor Pegawai: </label>
                                                                <div class="form-group">
                                                                    <input required type="number" name="no_pegawai"
                                                                        id="no_pegawai" placeholder="Nomor Pegawai"
                                                                        class="form-control" data-parsley-type="number"
                                                                        value="{{$data->no_pegawai }}"
                                                                        data-parsley-error-message="Masukkan format nomor telepon yang valid." />
                                                                </div>
                                                                <label>Alamat: </label>
                                                                <div class="form-group">
                                                                    <input required type="text" name="alamat_pegawai"
                                                                        placeholder="Alamat" class="form-control"
                                                                        id="alamat_pegawai" 
                                                                        value="{{$data->alamat_pegawai }}"/>
                                                                </div>

                                                                <label for="status">Status: </label>
                                                                <div class="form-group">
                                                                    <select class="form-select" name="status" id="status">
                                                                        <option {{$data->status=='aktif'?'selected':''}} value="aktif">Aktif</option>
                                                                        <option  {{$data->status=='tidak aktif'?'selected':''}} value="tidak aktif">Tidak Aktif</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
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
                                </tbody>
                            @endforeach
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
                <form onsubmit="return confirm('Apakah data yang dimasukkan sudah benar?')" method="POST"
                    action="/manajemen/inputpegawai" data-parsley-validate>
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="role" value="0" />
                        <label>Nama: </label>
                        <div class="form-group">
                            <input required type="text" name="nama_pegawai" id="nama_pegawai" placeholder="Nama"
                                class="form-control" />
                        </div>
                        <label>Nomor Pegawai: </label>
                        <div class="form-group">
                            <input required type="number" name="no_pegawai" id="no_pegawai" placeholder="Nomor Pegawai"
                                class="form-control" data-parsley-type="number"
                                data-parsley-error-message="Masukkan format nomor telepon yang valid." />
                        </div>
                        <label>Alamat: </label>
                        <div class="form-group">
                            <input required type="text" name="alamat_pegawai" placeholder="Alamat"
                                class="form-control" id="alamat_pegawai" />
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
