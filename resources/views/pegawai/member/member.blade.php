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
        <div class="page-heading">
            <h3>Data Pasien</h3>
        </div>
        <table id="myTable" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama </th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Pegawai</th>
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
                        <td>
                            @if ($item->nama == null)
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}"
                                    class="btn btn-primary">Tambahkan Pegawai</button>
                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="/manajemen/member/tambah-pegawai-ke-pasien" method="post">
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

                </td>

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
