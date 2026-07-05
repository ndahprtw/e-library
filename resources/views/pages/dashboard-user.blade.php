@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100 bg-light-info overflow-hidden shadow-none">
        <div class="card-body position-relative">
            <div class="row">
            <div class="col-sm-7">
                <div class="d-flex align-items-center mb-7">
                <div class="rounded-circle overflow-hidden me-6">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="40" height="40">
                </div>
                <h5 class="fw-semibold mb-0 fs-5">Selamat Datang Kembali {{ auth()->user()->name }}!</h5>
                </div>
                <div class="d-flex align-items-center">
                <div class="border-end pe-4 border-muted border-opacity-10">
                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">2 Juli 2026</h3>
                    <p class="mb-0 text-dark">Cuaca</p>
                </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="welcome-bg-img mb-n7 text-end">
                <img src="{{ asset('assets/images/backgrounds/welcome-bg.svg') }}" alt="" class="img-fluid">
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
        <div class="card w-100">
        <div class="card-body">
            <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
            <img src="{{ asset('assets/images/svgs/icon-cart.svg') }}" alt="" class="img-fluid" width="24" height="24">
            </div>
            <h4 class="mb-1 fw-semibold d-flex align-content-center">$16.5k<i class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
            <p class="mb-0">Total Peminjaman</p>
        </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
        <div class="card w-100">
        <div class="card-body">
            <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
            <img src="{{ asset('assets/images/svgs/icon-cart.svg') }}" alt="" class="img-fluid" width="24" height="24">
            </div>
            <h4 class="mb-1 fw-semibold d-flex align-content-center">$16.5k<i class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
            <p class="mb-0">Sedang Dipinjam</p>
        </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title fw-semibold">Rekomendasi Untuk Anda</h5>
            <p class="card-subtitle mb-4">Buku Terpopuler</p>
                <div class="table-responsive">

                    <table class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Cover</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Stok</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
        <div class="col-sm-6 d-flex align-items-stretch">
            <div class="card w-100">
            <div class="card-body">
                <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
                <img src="{{ asset('assets/images/svgs/icon-cart.svg') }}" alt="" class="img-fluid" width="24" height="24">
                </div>
                <div id="sales-two" class="mb-3"></div>
                <h4 class="mb-1 fw-semibold d-flex align-content-center">$16.5k<i class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                <p class="mb-0">Sudah Dikembalikan</p>
            </div>
            </div>
        </div>
        <div class="col-sm-6 d-flex align-items-stretch">
            <div class="card w-100">
            <div class="card-body">
                <div class="p-2 bg-light-info rounded-2 d-inline-block mb-3">
                <img src="{{ asset('assets/images/svgs/icon-bar.svg') }}" alt="" class="img-fluid" width="24" height="24">
                </div>
                <div id="growth" class="mb-3"></div>
                <h4 class="mb-1 fw-semibold d-flex align-content-center">24%<i class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                <p class="mb-0">Terlambat</p>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection