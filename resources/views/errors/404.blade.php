@extends('errors.errors')
@section('title', __('Not Found'))

@section('error')
    <div id="error">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <div class="text-center">
                    <img class="img-error" src="/assets/compiled/svg/error-404.svg" alt="Not Found" />
                    <h1 class="error-title">404 NOT FOUND</h1>
                    <p class="fs-5 text-gray-600">
                        Halaman yang Anda cari tidak ditemukan.
                    </p>
                    <a href="/" class="btn btn-outline-primary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
