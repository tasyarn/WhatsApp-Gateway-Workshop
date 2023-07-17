@extends('layout.master')
@section('title')
    Setting Website - {{ $companyname }}
@endsection
@section('sidebar')
    @include('layout.sidebar-manajemen')
@endsection
@section('konten')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Setting Website</h3>
                    <p class="text-subtitle text-muted">
                        Perbarui data website Anda
                    </p>
                </div>
            </div>
        </div>
        @if (session()->has('pesan'))
            <div class="alert alert-success alert-dismissible show fade" role="alert">
                {{ session('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Setting Website</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="/update-setting"
                                    data-parsley-validate>
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Judul Website</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input required type="text" class="form-control" name="namaperusahaan"
                                                    value="{{ old('namaperusahaan', $companyname) }}"
                                                    data-parsley-error-message="Masukkan judul website yang valid." />
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nomor Telepon</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="tel" class="form-control" name="nopenerima"
                                                    placeholder="Nomor Telepon" value="{{ old('nopenerima', $nopenerima) }}"
                                                    data-parsley-type="number" data-parsley-minlength="9"
                                                    data-parsley-maxlength="14"
                                                    data-parsley-error-message="Masukkan format no handphone yang valid." />
                                            </div>
                                            <div class="col-md-4">
                                                <label>Token Fonnte</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" class="form-control" name="tokenfonnte"
                                                    placeholder="Token Fonnte"
                                                    value="{{ old('tokenfonnte', $tokenfonnte) }}"
                                                    data-parsley-error-message="Masukkan token fonnte yang valid." />
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Ganti
                                                    Setting Website</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/static/js/pages/parsley.js"></script>
@endsection
