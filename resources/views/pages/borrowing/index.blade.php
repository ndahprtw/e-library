@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
            <h4 class="fw-semibold mb-8">Peminjaman</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted " href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Peminjaman</li>
                </ol>
            </nav>
            </div>
            <div class="col-3">
            <div class="text-center mb-n5">  
                <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
            </div>
            </div>
        </div>
        </div>
    </div>
    <section class="datatables">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert customize-alert alert-dismissible border-success text-success fade show remove-close-icon" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="d-flex align-items-center font-medium me-3 me-md-0">
                                    <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @elseif(session('error'))
                            <div class="alert customize-alert alert-dismissible border-danger text-danger fade show remove-close-icon" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="d-flex align-items-center font-medium me-3 me-md-0">
                                    <i class="ti ti-info-circle fs-5 me-2 text-danger"></i>
                                    {{ session('error') }}
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive">

                            <table class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Peminjam</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Jatuh Tempo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $no => $item)
                                        <tr>
                                            <td> {{ $no+1 }} </td>
                                            <td> {{ $item->book->judul }} </td>
                                            <td> {{ $item->book->category->nama_kategori }} </td>
                                            <td> {{ $item->user->name }} </td>
                                            <td> {{ $item->tanggal_peminjaman }} </td>
                                            <td> {{ $item->tanggal_jatuh_tempo }} </td>
                                            <td>
                                                @if ($item->status == 'dipinjam')        
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#samedata-modal"> Terima </button>
                                                    <div class="modal fade" id="samedata-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{ route('peminjaman.update', $item->id) }}" method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="modal-header d-flex align-items-center">
                                                                        <h4 class="modal-title" id="exampleModalLabel1"> Konfirmasi Pengembalian Buku </h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="text-center">
                                                                            Apakah anda yakin ingin menandai buku <br> <strong>{{ $item->book->judul }}</strong> <br> sebagai dikembalikan?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light-danger text-danger font-medium" data-bs-dismiss="modal"> Close </button>
                                                                        <button type="submit" class="btn btn-success"> Yakin </button>
                                                                    </div>
                                                                </form>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    @if ($item->status == 'terlambat')
                                                        <span class="badge bg-danger">Terlambat</span>
                                                    @elseif ($item->status == 'dikembalikan')
                                                        <span class="badge bg-success">Dikembalikan</span>
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>
                                    @empty
                                        <p class="text-danger">
                                            Data belum tersedia.
                                        </p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection