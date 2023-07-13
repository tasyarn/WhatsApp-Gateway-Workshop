@extends('layout.master')
@section('title')
    Dashboard Manajemen - {{ $companyname }}
@endsection
@section('sidebar')
    @include('layout.sidebar-manajemen')
@endsection
@section('konten')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />


    <div class="container">
        <div class="page-heading d-flex justify-content-between">
            <h3>Data Pasien</h3>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#tess">
                Tambah
            </button>

        </div>
    </div>

        <!--Modal Tambah -->
                                <div class="modal fade text-left" id="tess" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel33" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Tambah Data Pasien </h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="updateObat" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_users" value="{{ Auth::user()->id }}">
                                                    <label>Nama: </label>
                                                    <div class="form-group">
                                                        <input type="text" placeholder="nama"
                                                            class="form-control" name="nama_member">
                                                    </div>
                                                    <label>Alamat: </label>
                                                    <div class="form-group">
                                                        <input type="password" placeholder="alamat"
                                                            class="form-control" name="alamat_member">
                                                    </div>
                                                    <label>No Telepon: </label>
                                                    <div class="form-group">
                                                        <input type="password" placeholder="notelepon"
                                                            class="form-control" name="no_member">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-success ml-1"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Simpan</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


        <table id="myTable" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama </th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($member as $item)
                    <tr>
                        <td style="padding: 30px 0px">{{ $no++ }}</td>
                        <td>{{ $item->nama_member }}</td>
                        <td>{{ $item->alamat_member }}</td>
                        <td>{{ $item->no_member }}</td>
                        {{-- <td>
                            @if ($item->nama == null)
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}"
                                    class="btn btn-primary">Tambahkan Pegawai</button>
                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('pasien.store') }}" method="post">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan pegawai</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <select name="id_users" class="form-control">
                                                        @foreach ($pegawai as $peg)
                                                            <option value="{{ $peg->id }}">{{ $peg->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                        {{ $item->nama }}
                @endif

                </td> --}}
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tess1">
                        Update
                    </button>
                </td>
                <!--Modal Update -->
                    <div class="modal fade text-left" id="tess1" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Update Data Pasien </h4>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="/update-member" method="post">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="ID_member" value="{{ $item->id }}"/>
                                    <label>ID Member : </label>
                                    <div class="form-group">
                                        <input required type="text" name="ID_member"
                                            id="ID_member" placeholder="{{$item->id }}"
                                            class="form-control" value="{{$item->id }}" disabled />
                                    </div>
                                    <label>Nama Member : </label>
                                    <div class="form-group">
                                        <input required type="text" name="nama_member"
                                            id="nama_member" placeholder="{{$item->nama_member }}"
                                            class="form-control" value="{{$item->nama_member }}"/>
                                    </div>
                                    <label>Alamat Member : </label>
                                    <div class="form-group">
                                        <input required type="text" name="no_member"
                                            id="no_member" placeholder="{{$item->no_member }}"
                                            class="form-control" value="{{$item->no_member }}"/>
                                    </div>
                                    <label>No. Telepon </label>
                                    <div class="form-group">
                                        <input required type="text" name="alamat_member"
                                            id="alamat_member" placeholder="{{$item->alamat_member }}"
                                            class="form-control" value="{{$item->alamat_member }}"/>
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


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable()
        });
    </script>
@endsection
