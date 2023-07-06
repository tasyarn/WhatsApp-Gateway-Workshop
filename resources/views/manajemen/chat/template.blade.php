@extends('layout.master')
@section('style')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />

    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css" />
@endsection
@section('sidebar')
    @include('layout.sidebar-manajemen')
@endsection
@section('konten')
@if(Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ Session::get('success') }}',
            showCancelButton: false,
            confirmButtonColor: '#5369f8',
            confirmButtonText: 'OK',
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload(); // Reload the page after success confirmation
            }
        });
    </script>
@endif
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
                    <a href="/manajemen/add-template" class="btn btn-primary">Add Template Pesan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>ID Template</th>
                                    <th>Template Chat</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            @foreach ( $templates as $item )
                            <tbody>
                                <tr>
                                    <th>{{ $item->id }}</th>
                                    <td>{{ $item->template_chat }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#edittemplate{{$item->id}}">
                                            Edit
                                        </button>
                                        <div class="modal fade text-left" id="edittemplate{{$item->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel33">
                                                            Edit Template Pesan
                                                        </h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <form
                                                        onsubmit="return confirm('Apakah data yang dimasukkan sudah benar?')"
                                                        method="POST" action="/update-template"
                                                        data-parsley-validate>
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="ID_template" value="{{ $item->id }}"/>
                                                            <label>ID Template : </label>
                                                            <div class="form-group">
                                                                <input required type="text" name="ID_template"
                                                                    id="ID_template" placeholder="{{$item->id }}"
                                                                    class="form-control" value="{{$item->id }}" disabled />
                                                            </div>
                                                            <label>Isi Template Pesan : </label>
                                                            <div class="form-group">
                                                                <input required type="text" name="template_chat"
                                                                    id="template_chat" placeholder="{{$item->template_chat }}"
                                                                    class="form-control" value="{{$item->template_chat }}"/>
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
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
    <link rel="stylesheet" href="assets/extensions/sweetalert2/sweetalert2.min.css">
    <script src="assets/extensions/sweetalert2/sweetalert2.min.js"></script>>
    <script src="assets/static/js/pages/sweetalert2.js"></script>>
@endsection


