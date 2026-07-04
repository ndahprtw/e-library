@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
            <h4 class="fw-semibold mb-8">Hak Akses Role {{ $role->name }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted " href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-muted " href="{{ route('role.index') }}">Role</a></li>
                <li class="breadcrumb-item" aria-current="page">Hak Akses Role {{ $role->name }}</li>
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

                    <form action="{{ route('role-permissions.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Hak Akses</label>
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission{{ $permission->id }}"
                                                    {{ in_array( $permission->name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="permission{{ $permission->id }}">
                                                    {{ ucwords(str_replace('_', ' ', $permission->name)) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('permissions')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('role.index') }}" class="btn btn-secondary"> Kembali </a>
                            <button type="submit" class="btn btn-primary"> Simpan Hak Akses </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection