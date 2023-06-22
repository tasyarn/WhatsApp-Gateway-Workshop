@extends('auth.master')
@section('title')
    Login - {{ $companyname }}
@endsection
@section('konten')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="index.html"><img src="/assets/compiled/svg/logo.svg" alt="Logo" /></a>
                </div>
                <h1 class="auth-title">Log in.</h1>
                <p class="auth-subtitle mb-5">
                    Masuk sesuai dengan akun yang Anda miliki.
                </p>
                @if (session()->has('salah'))
                    <div class="alert alert-danger alert-dismissible show fade" role="alert">
                        {{ session('salah') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="/login" method="POST" data-parsley-validate>
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="telp" name="nouser" class="form-control form-control" placeholder="No handphone"
                            data-parsley-type="number" data-parsley-minlength="9" data-parsley-minlength="14"
                            data-parsley-error-message="Masukkan format no handphone yang valid.">
                        <div class="form-control-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password" class="form-control form-control" placeholder="Password"
                            data-parsley-minlength="8"
                            data-parsley-error-message="Kata sandi harus lebih besar dari atau sama dengan 8.">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block shadow-lg">
                        Masuk
                    </button>
                </form>
                <div class="text-center mt-3 text-lg">
                    <p>
                        <a class="font-bold" href="/lupa-password">Lupa password?</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right"></div>
        </div>
    </div>
@endsection
