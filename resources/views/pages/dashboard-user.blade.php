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
        <div class="card w-100 bg-secondary">
        <div class="card-body">
            <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
                <i class="ti ti-books fs-6"></i>
            </div>
            <h4 class="mb-1 fw-semibold d-flex align-content-center">{{ $totalPeminjaman }}</h4>
            <p class="mb-0 text-light">Total Peminjaman</p>
        </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
        <div class="card w-100 bg-info">
        <div class="card-body">
            <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
                <i class="ti ti-book fs-6"></i>
            </div>
            <h4 class="mb-1 fw-semibold d-flex align-content-center">{{ $totalDipinjam }}</h4>
            <p class="mb-0 text-light">Sedang Dipinjam</p>
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
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Stok</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekomendasiBuku as $item)
                                <tr>
                                    <td> {{ $item->judul }} </td>
                                    <td> {{ $item->category->nama_kategori }} </td>
                                    <td> {{ $item->penulis }} </td>
                                    <td> {{ $item->penerbit }} </td>
                                    <td> {{ $item->stok }} </td>
                                    <td> <a href="{{ route('buku.show', $item->id) }}" class="btn btn-sm btn-primary"> Pinjam </a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
        <div class="col-sm-6 d-flex align-items-stretch">
            <div class="card w-100 bg-success">
            <div class="card-body">
                <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
                    <i class="ti ti-books fs-6"></i>
                </div>
                <h4 class="mb-1 fw-semibold d-flex align-content-center">{{ $totalDikembalikan }}</h4>
                <p class="mb-0 text-light">Sudah Dikembalikan</p>
            </div>
            </div>
        </div>
        <div class="col-sm-6 d-flex align-items-stretch">
            <div class="card w-100 bg-danger">
            <div class="card-body">
                <div class="p-2 bg-light-danger rounded-2 d-inline-block mb-3">
                    <i class="ti ti-book-2 fs-6"></i>
                </div>
                <h4 class="mb-1 fw-semibold d-flex align-content-center">{{ $totalPengembalianTerlambat }}</h4>
                <p class="mb-0 text-light">Terlambat</p>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection