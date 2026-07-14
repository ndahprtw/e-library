@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="owl-carousel counter-carousel owl-theme">
        <div class="item">
            <div class="card border-0 zoom-in bg-light-primary shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <div class="bg-primary-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:70px; height:70px;">
                        <i class="ti ti-user-shield fs-8 text-primary"></i>
                    </div>

                    <p class="fw-semibold fs-3 text-primary mb-1">Petugas</p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $totalPetugas }}</h5>
                </div>
            </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-secondary shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <div class="bg-secondary-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:70px; height:70px;">
                        <i class="ti ti-user fs-8 text-secondary"></i>
                    </div>

                    <p class="fw-semibold fs-3 text-secondary mb-1">Pengguna</p>
                    <h5 class="fw-semibold text-secondary mb-0">{{ $totalPengguna }}</h5>
                </div>
            </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-warning shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <div class="bg-warning-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:70px; height:70px;">
                        <i class="ti ti-tag fs-8 text-warning"></i>
                    </div>

                    <p class="fw-semibold fs-3 text-warning mb-1">Kategori</p>
                    <h5 class="fw-semibold text-warning mb-0">{{ $totalKategori }}</h5>
                </div>
            </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-info shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <div class="bg-info-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:70px; height:70px;">
                        <i class="ti ti-books fs-8 text-info"></i>
                    </div>

                    <p class="fw-semibold fs-3 text-info mb-1">Buku</p>
                    <h5 class="fw-semibold text-info mb-0">{{ $totalBuku }}</h5>
                </div>
            </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-success shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <div class="bg-success-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:70px; height:70px;">
                        <i class="ti ti-book-download fs-8 text-success"></i>
                    </div>

                    <p class="fw-semibold fs-3 text-success mb-1">Peminjaman</p>
                    <h5 class="fw-semibold text-success mb-0">{{ $totalPeminjaman }}</h5>
                </div>
            </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-danger shadow-none">
            <div class="card-body">
                <div class="text-center">
                    <div class="bg-danger-subtle rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:70px; height:70px;">
                        <i class="ti ti-clock-exclamation fs-8 text-danger"></i>
                    </div>

                    <p class="fw-semibold fs-3 text-danger mb-1">Terlambat</p>
                    <h5 class="fw-semibold text-danger mb-0">0</h5>
                </div>
            </div>
            </div>
        </div>


    </div>

    <!--  Row 2 -->
    <div class="row">
    <!-- Peminjaman Hari Ini -->
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Peminjaman Hari Ini</h5>
                </div>
                </div>
                <div class="table-responsive">
                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                    <tr class="text-muted fw-semibold">
                        <th scope="col">Peminjam</th>
                        <th scope="col">Buku</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody class="border-top">                    
                        @forelse($peminjamanHariIni as $item)
                            <tr>

                                <td>{{ $item->user->name }}</td>

                                <td>{{ $item->book->judul }}</td>

                                <td>{{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}</td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Belum ada peminjaman hari ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        <!-- Buku Terlaris -->
        <div class="col-lg-4 d-flex align-items-strech">
            <div class="card bg-primary border-0 w-100">
            <div class="card-body pb-0">
                <h5 class="fw-semibold mb-1 text-white card-title"> Buku Terpopuler </h5>
                <p class="fs-3 mb-3 text-white">Overview 2023</p>
                <div class="text-center mt-3">
                <img src="{{ asset('assets/images/backgrounds/feedback-message.png') }}" class="img-fluid" alt="" />
                </div>
            </div>
            <div class="card mx-2 mb-2 mt-n2">
                <div class="card-body">

                    @php
                        $maxBorrow = max($bukuTerpopuler->max('borrows_count'), 1);
                    @endphp

                    @foreach ($bukuTerpopuler as $item)
                        @php
                            $percentage = ($item->borrows_count / $maxBorrow) * 100;
                        @endphp

                        <div class="mb-7 pb-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">{{ $item->judul }}</h6>
                                    <p class="fs-3 mb-0"> Dipinjam {{ $item->borrows_count }} kali </p>
                                </div>
                            </div>
                            <div class="progress bg-light-primary" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            </div>
        </div>
    </div>
    <!--  Row 3 -->
    <div class="row">
    <!-- Ringkasan Peminjaman -->
    <div class="col-lg-8">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="bg-light-primary rounded-circle d-inline-flex p-3 mb-3">
                            <i class="ti ti-book-download text-primary fs-7"></i>
                        </div>
                        <h6 class="fw-semibold">Total Peminjaman</h6>
                        <h2 class="fw-bold text-primary mb-1">
                            {{ $totalPeminjaman }}
                        </h2>
                        <small class="text-muted">
                            Seluruh transaksi
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="bg-light-success rounded-circle d-inline-flex p-3 mb-3">
                            <i class="ti ti-books text-success fs-7"></i>
                        </div>
                        <h6 class="fw-semibold">Sedang Dipinjam</h6>
                        <h2 class="fw-bold text-success mb-1">
                            {{ $totalDipinjam }}
                        </h2>
                        <small class="text-muted">
                            Belum dikembalikan
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="bg-light-danger rounded-circle d-inline-flex p-3 mb-3">
                            <i class="ti ti-clock-exclamation text-danger fs-7"></i>
                        </div>
                        <h6 class="fw-semibold">Terlambat</h6>
                        <h2 class="fw-bold text-danger mb-1">
                            {{ $totalTerlambat }}
                        </h2>
                        <small class="text-muted">
                            Lewat batas waktu
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-4">
        <div>     
            <div class="card bg-success w-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="fw-bold text-white">Rekap Data E-Library (.xlsx)</p>
                    <a href="/buku/export/excel" class="btn btn-primary"><i class="ti ti-file-spreadsheet"></i></a>
                </div>
            </div>
            <div class="card text-white h-100">
                <div class="card-body bg-danger">
                    <p class="fw-bold text-white">Rekap Peminjaman (.pdf)</p>
                    <form action="{{ route('peminjaman.export.pdf') }}" method="GET" target="_blank">
                        <div class="row">
                            <div class="col-6">
                                <select name="bulan" class="form-select">
                                    @foreach(range(1,12) as $bulan)
                                        <option value="{{ $bulan }}" {{ now()->month == $bulan ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6">
                                <select name="tahun" class="form-select">
                                    @for($tahun = now()->year; $tahun >= 2020; $tahun--)
                                        <option value="{{ $tahun }}">
                                            {{ $tahun }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-light text-danger w-100 mt-4">
                            <i class="ti ti-download me-1"></i>
                            Download PDF
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>


@push('scripts')
<script>
const options = {
    chart: {
        type: 'donut',
        height: 350
    },
    series: @json($jumlahBuku),
    labels: @json($kategori)
};

const chart = new ApexCharts(
    document.querySelector("#kategoriChart"),
    options
);

chart.render();
</script>
@endpush
@endsection