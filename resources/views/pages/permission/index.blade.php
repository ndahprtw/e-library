@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
            <h4 class="fw-semibold mb-8">Akses</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted " href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Akses</li>
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
                            <form action="{{ route('akses.index') }}" method="GET" class="d-flex">
                                <input class="form-control" type="text" name="search" value="{{ request('search') }}" placeholder="Cari Akses">
                                <a href="{{ route('akses.index') }}" class="btn btn-primary mx-3"><i class="ti ti-refresh"></i></a>
                            </form>

                            {{-- tambah data --}}
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-modal"> Tambah Data </button>
                            <div class="modal fade" id="tambah-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex align-items-center">
                                            <h4 class="modal-title" id="exampleModalLabel1"> Tambah Akses </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('akses.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                @include('pages.permission._form')
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-danger text-danger font-medium" data-bs-dismiss="modal"> Close </button>
                                                <button type="submit" class="btn btn-success"> Yakin </button>
                                            </div>
                                        </form>  
                                    </div>
                                </div>
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
                        @endif

                        <div class="table-responsive">

                            <table class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $no => $item)
                                        <tr>
                                            <td> {{ $no+1 }} </td>
                                            <td> {{ $item->name }} </td>
                                            <td class="d-flex gap-2">
                                                {{-- edit --}}
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-modal{{ $item->id }}"> Edit </button>
                                                <div class="modal fade" id="edit-modal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex align-items-center">
                                                                <h4 class="modal-title" id="exampleModalLabel1"> Edit Akses </h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('akses.update', $item->id) }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div class="modal-body">
                                                                    @include('pages.permission._form', ['permission' => $item])
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-danger text-danger font-medium" data-bs-dismiss="modal"> Close </button>
                                                                    <button type="submit" class="btn btn-success"> Yakin </button>
                                                                </div>
                                                            </form>  
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- hapus --}}
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal{{ $item->id }}"> Hapus </button>
                                                <div class="modal fade" id="delete-modal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex align-items-center">
                                                                <h4 class="modal-title" id="exampleModalLabel1"> Hapus Akses </h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('akses.destroy', $item->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin menghapus akses untuk <strong>{{ $item->name }}</strong>?
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

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection