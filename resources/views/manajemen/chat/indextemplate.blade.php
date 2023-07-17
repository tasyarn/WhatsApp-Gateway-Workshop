@extends('layout.master')
@section('title')
    Template Chat - {{ $companyname }}
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
                    <h3>Template Chat</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/manajemen">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Template Chat
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
                <div class="card-header d-flex justify-content-between">Template Chat
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="bi bi-chat-dots-fill"></i> Tambah Template Chat
                    </button>
                </div>
                <section id="collapseOne" class=" accordion-collapse collapse section" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Tambah Template Chat</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form form-horizontal" method="POST"
                                                action="/manajemen/chat-template/store">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Template Chat</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <textarea required type="text" name="template_chat" placeholder="Template Chat" class="form-control"></textarea>
                                                            <div><code>Note:</code></div>
                                                            <div>\n untuk baris baru, contoh penggunaan: Halo,\n Selamat
                                                                Pagi</div>
                                                            <div>* * untuk bold, contoh penggunaan: *tebal*</div>
                                                            <div>_ _ untuk italic, contoh penggunaan: _miring_</div>
                                                            <div>~ ~ untuk coret, contoh penggunaan: ~tebal~</div>
                                                        </div>
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary me-1 mb-1">Tambah
                                                                Template Chat</button>
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
                                    <th>Template Chat</th>
                                    <th>Ubah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($templatechat as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->template_chat }}</td>
                                        <td>
                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#ubah{{ $item->id }}">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#hapus{{ $item->id }}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                            <div class="modal fade text-left" id="ubah{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">
                                                                Ubah Template Chat
                                                            </h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="/manajemen/chat-template/ubah">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id"
                                                                    value="{{ $item->id }}" />
                                                                <label>Template Chat: </label>
                                                                <div class="form-group">
                                                                    <textarea required type="text" name="templatechat" placeholder="Template Chat" class="form-control">{{ $item->template_chat }}</textarea>
                                                                    <div><code>Note:</code></div>
                                                                    <div>\n untuk baris baru, contoh penggunaan: Halo,\n
                                                                        Selamat Pagi</div>
                                                                    <div>* * untuk bold, contoh penggunaan: *tebal*</div>
                                                                    <div>_ _ untuk italic, contoh penggunaan: _miring_</div>
                                                                    <div>~ ~ untuk coret, contoh penggunaan: ~tebal~</div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Tutup</span>
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
                                            <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                Apakah Anda yakin?
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                Anda tidak akan dapat memulihkan data ini!
                                                            </p>
                                                        </div>
                                                        <form class="form form-vertical" method="POST"
                                                            action="/manajemen/chat-template/hapus">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $item->id }}" />
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Batal</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ml-1"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Hapus</span>
                                                                </button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
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
