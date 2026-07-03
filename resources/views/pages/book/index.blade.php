@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
            <h4 class="fw-semibold mb-8">Buku</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted " href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Buku</li>
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
                            <form action="{{ route('buku.index') }}" method="GET" class="d-flex">
                                <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Cari Judul Buku">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                <a href="{{ route('buku.index') }}" class="btn btn-primary mx-3">Refresh</a>
                            </form>

                            <div class="d-flex gap-2">
                                <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Data</a>
                            </div>
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
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Penulis</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Stok</th>
                                        <th>Cover</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $no => $item)
                                        <tr>
                                            <td> {{ $no+1 }} </td>
                                            <td> {{ $item->judul }} </td>
                                            <td> {{ $item->category_id }} </td>
                                            <td> {{ $item->penulis }} </td>
                                            <td> {{ $item->penerbit }} </td>
                                            <td> {{ $item->tahun_terbit }} </td>
                                            <td> {{ $item->stok }} </td>
                                            <td>
                                                @if ($item->cover != null)
                                                    {{ $item->cover }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-primary">Edit</a>

                                               <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#samedata-modal"> Hapus </button>
                                                <div class="modal fade" id="samedata-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex align-items-center">
                                                                <h4 class="modal-title" id="exampleModalLabel1"> Hapus Buku </h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('buku.destroy', $item->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin menghapus buku <strong>{{ $item->judul }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-danger text-danger font-medium" data-bs-dismiss="modal"> Close </button>
                                                                    <button type="submit" class="btn btn-success"> Yakin </button>
                                                                </div>
                                                            </form>  
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @empty
                                        <p class="text-danger">
                                            Data belum tersedia.
                                        </p>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-3">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection