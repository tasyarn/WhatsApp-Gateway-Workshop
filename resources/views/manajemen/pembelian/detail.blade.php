@extends('layout.master')
@section('title')
    Detail Pembelian #{{ $transaction[0]->id }} - {{ $companyname }}
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
                    <h3>Detail Transaksi</h3>
                </div>
            </div>
        </div>
        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">Detail Transaksi #{{ $transaction[0]->id }}

                </div>

                <div class="card-body">
                    <!-- Basic Tables start -->
                    <section class="section">
                        <div class="row" id="basic-table">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <!-- Table with no outer spacing -->
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-sm">

                                            <tbody>
                                                <tr>
                                                    <th>Tanggal Transaksi</th>
                                                    <td>:</td>
                                                    <td>{{ $transaction[0]->created_at }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Pegawai</th>
                                                    <td>:</td>
                                                    <td>{{ $transaction[0]->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Member</th>
                                                    <td>:</td>
                                                    <td>{{ $transaction[0]->nama_member }}</td>
                                                </tr>
                                                <tr>
                                                    <th>No Telepon</th>
                                                    <td>:</td>
                                                    <td>{{ $transaction[0]->no_member }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>:</td>
                                                    <td>{{ $transaction[0]->alamat_member }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Obat Habis</th>
                                                    <td>:</td>
                                                    <td>{{ $transaction[0]->waktu_habis }}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">Nama Obat</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                                @foreach ($detailtransactions as $detailTransaction)
                                                    <tr>
                                                        <td colspan="2">{{ $detailTransaction->nama_obat }}</td>
                                                        <td>Rp{{ number_format($detailTransaction->sub_total, 2, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="2">Total</th>
                                                    <td>Rp{{ number_format($transaction[0]->total_harga, 2, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <a href="/manajemen/rekap-pembelian/" class="btn btn-primary me-1 mb-1">Kembali</a>
                        </div>
                </div>
        </section>
        <!-- Basic Tables end -->
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
