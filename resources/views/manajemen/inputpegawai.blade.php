@extends('layout.master')
@section('style')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />

    <link rel="stylesheet" href="/assets/compiled/css/table-datatable-jquery.css" />
@endsection
@section('sidebar')
    @include('layout.sidebar-manajemen')
@endsection
@section('konten')

            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Input Pegawai</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Validation</li>
                        <li class="breadcrumb-item active" aria-current="page">Parsley</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Input Pegawai</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" data-parsley-validate>
                                <div class="row">
                                    <!-- <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">id</label>
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Nama Awal" name="fname-column" data-parsley-required="true">
                                        </div>
                                    </div> -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Nama</label>
                                            <input type="text" id="last-name-column" class="form-control" placeholder="Nama" name="name-column">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="no-telp-column" class="form-label">No Telp</label>
                                            <input type="char" id="no-telp-column" class="form-control" placeholder="no telp" name="no-telp-column">
                                        </div>
                                    <!-- </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="status-floating" class="form-label">Status</label>
                                            <input type="boolean" id="status-floating" class="form-control" name="status-floating" placeholder="status">
                                        </div> -->
                                    <!-- </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="company-column" class="form-label">Jabatan</label>
                                            <input type="text" id="company-column" class="form-control" name="company-column" placeholder="Jabatan">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="email-id-column" class="form-label">No Telp</label>
                                            <input type="notelp" id="notelp-id-column" class="form-control" name="notelp-id-column" placeholder="No Telp" data-parsley-required="true">
                                        </div> -->
                                    <!-- </div>
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
                                    <div class="col-12">
                                      <div class='form-group mandatory'>
                                        <fieldset>
                                          <label class="form-label">
                                            Favourite Colour
                                          </label>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" data-parsley-required="true">
                                            <label class="form-check-label form-label" for="flexRadioDefault1">
                                              Red
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                            <label class="form-check-label form-label" for="flexRadioDefault2">
                                              Blue
                                            </label>
                                          </div>
                                        </fieldset>
                                      </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
 
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/static/js/pages/datatables.js"></script>
@endsection