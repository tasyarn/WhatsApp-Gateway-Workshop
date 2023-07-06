@extends('layout.master')
@section('title')
    Dashboard Manajemen - {{ $companyname }}
@endsection
@section('sidebar')
    @include('layout.sidebar-manajemen')
@endsection
@section('konten')

<div class="card-content">
    <div class="card-body">
        <form class="form" action="/manajemen/kirim-data-pasien" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8 col-12">
                    <input type="hidden" name="id_users" value="1">
                    <div class="form-group mandatory">
                        <label for="first-name-column" class="form-label">Nama Pasien</label>
                        <input type="text" id="first-name-column" class="form-control" placeholder="Nama Pasien" name="nama_member" data-parsley-required="true">
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="last-name-column" class="form-label">Alamat</label>
                        <input type="text" id="last-name-column" class="form-control" placeholder="Alamat" name="alamat_member">
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="last-name-column" class="form-label">Nomor Telepon</label>
                        <input type="text" id="last-name-column" class="form-control" placeholder="Nomor Telepon" name="no_member">
                    </div>
                </div>


                <div class="col-12">
                    <div class='form-group'>
                        <div class="form-check mandatory">
                            <input type="checkbox" id="checkbox5" class='form-check-input' checked data-parsley-required="true" data-parsley-error-message="You have to accept our terms and conditions to proceed.">
                            <label for="checkbox5" class="form-check-label form-label">I accept these terms and conditions.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                    <button type="delete" class="btn btn-success me-1 mb-1">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
    @endsection
