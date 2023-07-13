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
                    <h3>Tambahkan Pegawai Ke Member</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/manajemen">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tambahkan Pegawai Ke Member
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <form action="" method="post">
            @csrf
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">Tambahkan Pegawai Ke Member</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Pegawai</label>
                            <select class="form-select" name="id_users" aria-label="Default select example">
                                @foreach ($pegawai as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Member</label>
                            <select class="form-select" name="id" aria-label="Default select example">
                                @foreach ($member as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_member }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>

        <!-- Basic Tables end -->
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection
