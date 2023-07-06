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
                    <h3>Template Pesan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/manajemen">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Template Pesan
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">Template Pesan
                    <a href="/addTemplate" class="btn btn-primary">Add Template Pesan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>ID Template</th>
                                    {{-- <th>ID Admin</th> --}}
                                    <th>Template Chat</th>
                                    {{-- <th>Tujuan Template</th> --}}
                                    {{-- <th>Tanggal dibuat</th> --}}
                                </tr>
                            </thead>
                            @foreach ( $templates as $item )
                            <tbody>
                                <tr>
                                    <th>{{ $item->id }}</th>
                                    {{-- <td>{{ $item->User->id }}</td> --}}
                                    <td>{{ $item->template_chat }}</td>
                                    {{-- <td>{{ $item->tujuan_template }}</td> --}}
                                    {{-- <td>{{ $item->created_at }}</td> --}}
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
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection


