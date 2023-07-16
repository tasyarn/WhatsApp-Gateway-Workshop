@extends('layout.master')
@section('title')
    Tambah Transaksi - {{ $companyname }}
@endsection
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
                    <h3>Tambah Transaksi</h3>
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
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Tambah Transaksi</h4>
                        </div>

                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" method="POST" action="/pegawai/pembelian/store">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">No telepon</label>
                                                    <input type="number" id="first-name-vertical" class="form-control"
                                                        name="no_member" value={{ $member[0]['no_member'] }} readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Nama Member</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        name="nama_member" value={{ $member[0]['nama_member'] }} readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Alamat</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        name="alamat_member" value={{ $member[0]['alamat_member'] }}
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Obat</label>

                                                    <section class="section">
                                                        <div class="row" id="basic-table">
                                                            <div class="col-12 col-md-12">
                                                                <div class="card">
                                                                    <div class="card-content">
                                                                        <!-- Table with no outer spacing -->
                                                                        <div class="table-responsive">
                                                                            <table class="table mb-0 table-sm">
                                                                                <tbody>
                                                                                    @foreach ($detailmedicines as $medicine)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="checkbox"
                                                                                                    id="checkbox{{ $medicine->id }}"
                                                                                                    class='form-check-input'
                                                                                                    name="medicines[]"
                                                                                                    value="{{ $medicine->id_medicines }}">
                                                                                            </td>
                                                                                            <td> <label
                                                                                                    for="checkbox{{ $medicine->id }}">
                                                                                                    {{ $medicine->nama_obat }}
                                                                                                </label></td>
                                                                                            <td>Rp{{ number_format($medicine->harga_obat, 2, ',', '.') }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Waktu Habis Obat (Hari)</label>
                                                    <input required type="number" min="1" class="form-control"
                                                        name="waktu_habis" placeholder="Waktu Habis Obat">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Tambah
                                                    Transaksi</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                <a href="/pegawai/pembelian/"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection
