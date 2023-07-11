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
                        <div class="card-header d-flex justify-content-between">Data Obat
                            <a href="/manajemen/add-obat" class="btn btn-primary">Add Obat</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>ID Obat</th>
                                            <th>Nama Obat</th>
                                            <th>Harga Obat</th>
                                            <th>Stok Obat</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    @foreach ($obats as $item )
                                    <tbody>
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->nama_obat}}</td>
                                            <td>Rp {{number_format( $item->harga_obat)}}</td>
                                            <td>{{$item->stok_obat}}</td>
                                            <td>
                                                @if ($item->status === "aktif")
                                                <span class="badge bg-success">Aktif</span>
                                                @else
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#editobat{{$item->id}}">
                                                        Edit
                                                    </button>
                                                    <div class="modal fade text-left" id="editobat{{$item->id}}" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel33">
                                                                        Edit Obat
                                                                    </h4>
                                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    onsubmit="return confirm('Apakah data yang dimasukkan sudah benar?')"
                                                                    method="POST" action="/update-obat"
                                                                    data-parsley-validate>
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="ID_obat" value="{{ $item->id }}"/>
                                                                        <label>ID Obat : </label>
                                                                        <div class="form-group">
                                                                            <input required type="text" name="ID_obat"
                                                                                id="ID_obat" placeholder="{{$item->id }}"
                                                                                class="form-control" value="{{$item->id }}" disabled />
                                                                        </div>
                                                                        <label>Nama Obat : </label>
                                                                        <div class="form-group">
                                                                            <input required type="text" name="nama_obat"
                                                                                id="nama_obat" placeholder="{{$item->nama_obat }}"
                                                                                class="form-control" value="{{$item->nama_obat }}"/>
                                                                        </div>
                                                                        <label>Harga Obat : </label>
                                                                        <div class="form-group">
                                                                            <input required type="text" name="harga_obat"
                                                                                id="harga_obat" placeholder="{{$item->harga_obat }}"
                                                                                class="form-control" value="{{$item->harga_obat }}"/>
                                                                        </div>
                                                                        <label>Stok Obat : </label>
                                                                        <div class="form-group">
                                                                            <input required type="text" name="stok_obat"
                                                                                id="stok_obat" placeholder="{{$item->stok_obat }}"
                                                                                class="form-control" value="{{$item->stok_obat }}"/>
                                                                        </div>
                                                                        <label for="status">Status : </label>
                                                                        <div class="form-group">
                                                                            <select class="form-select" name="status" id="status">
                                                                                <option {{$item->status=='aktif'?'selected':''}} value="aktif">Aktif</option>
                                                                                <option  {{$item->status=='tidak aktif'?'selected':''}} value="tidak aktif">Tidak Aktif</option>
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
                                                                            <span class="d-none d-sm-block">Save</span>
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
