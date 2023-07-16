@extends('layout.master')
@section('title')
    Ubah Data {{ $member->nama_member }} - {{ $companyname }}
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/compiled/css/select2.css" />
@endsection
@section('sidebar')
    @include('layout.sidebar-manajemen')
@endsection
@section('konten')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Member</h3>
                    <p class="text-subtitle text-muted">
                        Perbarui data member
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
        @if (session()->has('salah'))
            <div class="alert alert-danger alert-dismissible show fade" role="alert">
                {{ session('salah') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Diri Member</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="/manajemen/member/ubah"
                                    data-parsley-validate>
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{ $member->id }}">
                                            <input type="hidden" name="iduser" value="{{ Auth::user()->id }}">
                                            <div class="col-md-4">
                                                <label>Pegawai</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <select class="select2 form-select" name="iduser">
                                                    @foreach ($pegawai as $items)
                                                        <option value="{{ $items->id }}"
                                                            @if ($member->id_users === $items->id) selected @endif>
                                                            {{ $items->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nama Member</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input required type="text" class="form-control" name="namamember"
                                                    value="{{ old('namamember', $member->nama_member) }}" />
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nomor Telepon</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input required type="tel" class="form-control" name="nomember"
                                                    placeholder="Nomor Telepon"
                                                    value="{{ old('nomember', $member->no_member) }}"
                                                    data-parsley-type="number" data-parsley-minlength="9"
                                                    data-parsley-maxlength="14"
                                                    data-parsley-error-message="Masukkan format no handphone yang valid." />
                                            </div>
                                            <div class="col-md-4">
                                                <label>Alamat Member</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <textarea required type="text" name="alamatmember" placeholder="Alamat Member" class="form-control">{{ $member->alamat_member }}</textarea>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Ubah</button>
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
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Obat Member</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="/manajemen/member/ubah-obat"
                                    data-parsley-validate>
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <input type="hidden" name="idmember"
                                                value="{{ old('idmember', $member->id) }}" />
                                            <div class="col-md-4">
                                                <label>Obat Member</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <select class="select2 form-select" name="medicines[]" multiple="multiple"
                                                    required data-placeholder="Obat"
                                                    data-parsley-error-message="Pilih obat member.">
                                                    @foreach ($medicine as $item)
                                                        <option value="{{ $item->id }}"
                                                            @foreach ($detailmedicine as $detail)
                                                            @if ($item->id == $detail->id_medicines) selected @endif @endforeach>
                                                            {{ $item->nama_obat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Ubah</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                maximumSelectionLength: 3,
            });
        });
    </script>
@endsection
