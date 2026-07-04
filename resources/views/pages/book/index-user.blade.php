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

    <div class="card position-relative overflow-hidden">
      <div class="shop-part d-flex w-100">
        <div class="shop-filters flex-shrink-0 border-end d-none d-lg-block">
          <ul class="list-group pt-2 border-bottom rounded-0">
            <h6 class="my-3 mx-4 fw-semibold">Filter by Category</h6>
            <li class="list-group-item border-0 p-0 mx-4 mb-2">
              <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                href="{{ route('buku.index') }}"><i class="ti ti-circles fs-5"></i>All
              </a>
            </li>
              @foreach ($kategori as $item)
                <li class="list-group-item border-0 p-0 mx-4 mb-2">
                  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="">
                    <i class="ti ti-tag fs-5"></i>{{ $item->nama_kategori }}
                  </a>
                </li>
              @endforeach
          </ul>
          <ul class="list-group pt-2 border-bottom rounded-0">
            <h6 class="my-3 mx-4 fw-semibold">Sort By</h6>
            <li class="list-group-item border-0 p-0 mx-4 mb-2">
              <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                href="javascript:void(0)"><i class="ti ti-ad-2 fs-5"></i>Terpopuler
              </a>
            </li>
            <li class="list-group-item border-0 p-0 mx-4 mb-2">
              <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                href="javascript:void(0)"><i class="ti ti-sort-ascending-2 fs-5"></i>Terbaru
              </a>
            </li>
            <li class="list-group-item border-0 p-0 mx-4 mb-2">
              <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                href="javascript:void(0)"><i class="ti ti-sort-descending-2 fs-5"></i></i>Terlama
              </a>
            </li>
          </ul>
          <div class="p-4">
            <a href="{{ route('buku.index') }}" class="btn btn-primary w-100">Reset Filters</a>
          </div>
        </div>
        <div class="card-body p-4 pb-0">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <a class="btn btn-primary d-lg-none d-flex" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
              <i class="ti ti-menu-2 fs-6"></i>
            </a>
            <h5 class="fs-5 fw-semibold mb-0 d-none d-lg-block">Katalog Buku</h5>
            <form class="position-relative">
              <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Product">
              <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
          </div>  
          <div class="row">

            @foreach ($data as $item)
              <div class="col-sm-6 col-xl-4">
                <div class="card hover-img overflow-hidden rounded-2">
                  <div class="position-relative">
                    @if ($item->cover)
                      <img src="{{ Storage::url($item->cover) }}" class="card-img-top rounded-0" alt="">
                    @else
                      <img src="{{ asset('assets/images/default-book.jpg') }}" class="card-img-top rounded-0" alt="...">
                    @endif
                    <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-book fs-4"></i></a>                      </div>
                  <div class="card-body pt-3 p-4">
                    <h6 class="fw-semibold fs-4">{{ $item->judul }}</h6>
                    <div class="d-flex align-items-center justify-content-between">
                      <h6 class="fw-semibold fs-4 mb-0">{{ $item->stok }} <span class="ms-2 fw-normal text-muted fs-3"> tersedia</h6>
                      <ul class="list-unstyled d-flex align-items-center mb-0">
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                        <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

          </div>              
        </div>

        {{-- filter buku --}}
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
          <div class="offcanvas-body shop-filters w-100 p-0">
            <ul class="list-group pt-2 border-bottom rounded-0">
              <h6 class="my-3 mx-4 fw-semibold">Filter by Category</h6>
              <li class="list-group-item border-0 p-0 mx-4 mb-2">
                <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="{{ route('buku.index') }}">
                  <i class="ti ti-circles fs-5"></i>All
                </a>
              </li>
              @foreach ($kategori as $item)
                <li class="list-group-item border-0 p-0 mx-4 mb-2">
                  <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1" href="">
                    <i class="ti ti-tag fs-5"></i>{{ $item->nama_kategori }}
                  </a>
                </li>
              @endforeach
            </ul>
            <ul class="list-group pt-2 border-bottom rounded-0">
              <h6 class="my-3 mx-4 fw-semibold">Sort By</h6>
              <li class="list-group-item border-0 p-0 mx-4 mb-2">
                <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                  href="javascript:void(0)"><i class="ti ti-ad-2 fs-5"></i>Terpopuler
                </a>
              </li>
              <li class="list-group-item border-0 p-0 mx-4 mb-2">
                <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                  href="javascript:void(0)"><i class="ti ti-sort-ascending-2 fs-5"></i>Terbaru
                </a>
              </li>
              <li class="list-group-item border-0 p-0 mx-4 mb-2">
                <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-6 rounded-1"
                  href="javascript:void(0)"><i class="ti ti-sort-descending-2 fs-5"></i></i>Terlama
                </a>
              </li>
            </ul>

            <div class="p-4">
              <a href="{{ route('buku.index') }}" class="btn btn-primary w-100">Reset Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection