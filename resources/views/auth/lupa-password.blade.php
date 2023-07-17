@extends('auth.master')
@section('title')
    Lupa Password - {{ $companyname }}
@endsection
@section('konten')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                {{-- <div class="auth-logo">
                    <a href="/"><img style="width: 300px; height: 100%" src="/assets/images/logo/wecare.png"
                            alt="Logo"></a>
                </div> --}}
                <div class="auth-logo">
                    <a href="index.html">
                        <h3>{{ $companyname }}</h3>
                    </a>
                </div>
                <h1 class="auth-title">Lupa Password</h1>
                <p class="auth-subtitle mb-3">Masukkan no telepon Anda dan kami akan mengirimkan password baru</p>
                @if ($errors->has('no'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ $errors->first('no') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('sukses'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('sukses') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="/kirim-password-baru" data-parsley-validate>
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input required type="telp" name="no" class="form-control form-control" placeholder="No telepon"
                            data-parsley-type="number" data-parsley-minlength="9" data-parsley-maxlength="14"
                            data-parsley-error-message="Masukkan format no telepon yang valid.">
                        <div class="form-control-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block shadow-lg mt-3">Kirim</button>
                </form>
                <div class="text-center mt-3">
                    <p class='text-gray-600'>Ingat akun Anda? <a href="/login" class="font-bold">Masuk</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
                <img src="/assets/compiled/png/apotek.png" style="background-size: cover; height: 100%" alt="apotek">
            </div>
        </div>
    </div>
@endsection
