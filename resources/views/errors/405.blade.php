@extends('errors.errors')
@section('title', __('405 Method Not Allowed'))

@section('error')
    <div id="error">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <div class="text-center">
                    <img class="img-error" src="/assets/compiled/svg/error-500.svg" alt="Not Found" />
                    <h1 class="error-title">405 Method Not Allowed</h1>
                    <p class="fs-5 text-gray-600">
                        Ada yang rusak. Beri tahu kami apa yang Anda lakukan saat kesalahan ini terjadi. Kami akan memperbaikinya sesegera mungkin. Maaf atas ketidaknyamanan yang terjadi.
                    </p>
                    <a href="/" class="btn btn-outline-primary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection