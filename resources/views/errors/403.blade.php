@extends('errors.errors')
@section('title', __('Forbidden'))

@section('error')
    <div id="error">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <div class="text-center">
                    <img class="img-error" src="/assets/compiled/svg/error-403.svg" alt="Not Found" />
                    <h1 class="error-title">403 Forbidden</h1>
                    <p class="fs-5 text-gray-600">
                        Anda tidak berwenang untuk melihat halaman ini.
                    </p>
                    <a href="/" class="btn btn-outline-primary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
