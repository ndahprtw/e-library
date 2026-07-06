@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
            <h4 class="fw-semibold mb-8">Peminjaman Buku</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted " href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-muted " href="/buku">Buku</a></li>
                <li class="breadcrumb-item" aria-current="page">Peminjaman Buku</li>
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

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover buku {{ $book->judul }}" class="img-fluid">
                        @else
                            <img src="{{ asset('assets/images/default-book.jpg') }}" alt="No Image" class="img-fluid">
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ $book->stok > 0 ? route('peminjaman.store') : route('pengingat.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="book_id" value="{{ $book->id }}">

                            <p><strong>Judul :</strong> {{ $book->judul }}</p>
                            <p><strong>Penulis :</strong> {{ $book->penulis }}</p>
                            <p><strong>Penerbit :</strong> {{ $book->penerbit }}</p>
                            <p><strong>Tahun Terbit :</strong> {{ $book->tahun_terbit }}</p>
                            <p><strong>Stok :</strong> {{ $book->stok }}</p>

                            
                            @if ($book->stok > 0)
                                <p class="text-danger">
                                    <b>Note :</b> <br> Durasi Peminjaman Buku adalah 7 Hari, Jika Melebihi Batas Waktu Akan Dikenakan Denda Rp. 1000/Hari
                                </p>
                                
                                <p><strong>Tanggal Peminjaman :</strong> {{ now()->format('d-m-Y') }}</p>
                                <p><strong>Tanggal Pengembalian :</strong> {{ now()->addDays(7)->format('d-m-Y') }}</p>
                            @endif

                            <div class="d-flex justify-content-center align-items-center">
                                @if ($book->stok > 0)
                                    <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                                @else
                                    <button type="submit" class="btn btn-secondary">Ingatkan Saya</button>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection