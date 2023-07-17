@extends('layout.master')
@section('title')
    Data Member - {{ $companyname }}
@endsection
@section('style')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/compiled/css/select2.css" />
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
                <div class="card-header d-flex justify-content-between">Data Member
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="bi bi-person-fill-add"></i> Tambah Member
                    </button>
                </div>
                <section id="collapseOne" class=" accordion-collapse collapse section" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Tambah Member</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form form-horizontal" method="POST" action="/pegawai/member/store"
                                                data-parsley-validate>
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <input type="hidden" value="{{ Auth::user()->id }}"
                                                            name="id_users">
                                                        <div class="col-md-4">
                                                            <label>Nama Member</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="nama_member"
                                                                placeholder="Nama Member" required
                                                                data-parsley-error-message="Masukkan nama member yang valid.">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>No Telepon</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="tel" class="form-control" name="no_member"
                                                                placeholder="No Member" required data-parsley-type="number"
                                                                data-parsley-minlength="9" data-parsley-maxlength="14"
                                                                data-parsley-error-message="Masukkan format no telepon yang valid.">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Alamat</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <textarea type="text" class="form-control" name="alamat_member" placeholder="Alamat Member" required
                                                                data-parsley-error-message="Masukkan alamat yang valid."></textarea>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Obat</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select class="select2 form-select" name="medicines[]"
                                                                multiple="multiple" required data-placeholder="Obat"
                                                                data-parsley-error-message="Pilih obat member.">
                                                                @foreach ($medicine as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->nama_obat }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary me-1 mb-1">Tambah
                                                                Member</button>
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
                                    <th>Nama Member</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
                                    <th>Ubah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_member }}</td>
                                        <td>{{ $item->no_member }}</td>
                                        <td>{{ $item->alamat_member }}</td>
                                        <td>
                                            <a href="/pegawai/member/ubah/{{ $item->id }}" class="btn">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                maximumSelectionLength: 3,
            });
        });
    </script>
@endsection
