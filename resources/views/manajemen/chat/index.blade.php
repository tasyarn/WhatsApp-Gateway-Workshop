@extends('layout.master')
@section('title')
    Chat - {{ $companyname }}
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
                    <h3>Chat</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/manajemen">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Chat
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
                <div class="card-header">Chat
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Nama Member</th>
                                    <th>No telepon</th>
                                    <th>Chat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chat as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nama_member }}</td>
                                        <td>{{ $item->no_member }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="/manajemen/chat/{{ $item->no_member }}">History
                                                Chat</a>
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
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection
