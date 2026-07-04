@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
            <h4 class="fw-semibold mb-8">Role</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted " href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Role</li>
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
                            {{ $data->count() }} Role

                            {{-- tambah data --}}
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-modal"> Tambah Data </button>
                            <div class="modal fade" id="tambah-modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex align-items-center">
                                            <h4 class="modal-title" id="exampleModalLabel1"> Tambah Role </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('role.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                @include('pages.role._form')
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

                        <div class="row">
                            @forelse ($data as $item)
                                <div class="col-md-4 mb-4">
                                    <div class="card border h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title mb-0">{{ ucfirst($item->name) }}</h5>

                                                <div class="d-flex gap-2">

                                                    <a href="{{ route('role.show', $item->id) }}" class="btn btn-sm btn-info"> <i class="ti ti-shield-plus"></i> </a>

                                                    {{-- edit --}}
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editRole{{ $item->id }}"> <i class="ti ti-edit"></i> </button>
                                                    <div class="modal fade" id="editRole{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel1">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex align-items-center">
                                                                    <h4 class="modal-title" id="exampleModalLabel1"> Edit Role </h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('role.update', $item->id) }}" method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="modal-body">
                                                                        @include('pages.role._form', ['role' => $item])
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light-danger text-danger font-medium" data-bs-dismiss="modal"> Close </button>
                                                                        <button type="submit" class="btn btn-success"> Yakin </button>
                                                                    </div>
                                                                </form>  
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRole{{ $item->id }}">
                                                        <i class="ti ti-trash"></i> 
                                                    </button>
                                                </div>
                                            </div>

                                            <h6 class="text-muted mb-2">Hak Akses</h6>

                                            @forelse ($item->permissions as $permission)
                                                <span class="badge bg-primary-subtle text-primary me-1 mb-2">
                                                    {{ $permission->name }}
                                                </span>
                                            @empty
                                                <span class="text-muted">Belum ada hak akses.</span>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="deleteRole{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <form action="{{ route('role.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus Role</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus role
                                                    <strong>{{ $item->name }}</strong>?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning mb-0">
                                        Data belum tersedia.
                                    </div>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection