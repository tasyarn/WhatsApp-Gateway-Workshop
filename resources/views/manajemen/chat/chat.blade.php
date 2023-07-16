@extends('layout.master')
@section('title')
    History Chat #{{ $member->no_member }} - {{ $companyname }}
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
                    <h3>History Chat</h3>
                </div>
            </div>
        </div>
        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">History Chat  #{{ $member->no_member }}

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Pengirim</th>
                                    <th>No Penerima</th>
                                    <th>Isi Pesan</th>
                                    <th>Waktu Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chat as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_pengirim }} (@if($item->no_pengirim == $nopenerima){{ $member->nama_member }}@else{{ $user->nama }}@endif)</td>
                                        <td>{{ $item->no_penerima }} (@if($item->no_penerima == $nopenerima){{ $member->nama_member }}@else{{ $user->nama }}@endif)</td>
                                        <td>{{ $item->isi_pesan }}</td>
                                        <td>{{ $item->created_at }}</td>
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
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection
