@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
            <h4 class="fw-semibold mb-8">Kategori</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted " href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-muted " href="{{ route('kategori.index') }}">Kategori</a></li>
                <li class="breadcrumb-item" aria-current="page">Kategori {{ $category->nama_kategori }}</li>
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

                        <div class="d-flex justify-content-between align-items-center my-3">
                            <p>{{ $book->count() }} Judul Terkait</p>
                            <form action="{{ route('kategori.show', $category->id) }}" method="GET" class="d-flex">
                                <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Cari Judul Buku">
                                <a href="{{ route('kategori.show', $category->id) }}" class="btn btn-primary mx-3"><i class="ti ti-refresh"></i></a>
                            </form>
                        </div>

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
                                <tbody>
                                    @forelse ($book as $no => $item)
                                        <tr>
                                            <td> {{ $no+1 }} </td>
                                            <td>
                                                @if ($item->cover)
                                                    <img src="{{ Storage::url($item->cover) }}" class="img-fluid w-25" alt="cover buku">
                                                @else
                                                    <img src="{{ asset('assets/images/default-book.jpg') }}" alt="cover buku" class="img-fluid w-25">
                                                @endif

                                            </td>
                                            <td> {{ $item->judul }} </td>
                                            <td> {{ $item->category->nama_kategori }} </td>
                                            <td> {{ $item->penulis }} </td>
                                            <td> {{ $item->penerbit }} </td>
                                            <td> {{ $item->tahun_terbit }} </td>
                                            <td> {{ $item->stok }} </td>
                                            <td>
                                                <a href="{{ route('buku.show', $item->id) }}" class="btn btn-primary">Pinjam</a>
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