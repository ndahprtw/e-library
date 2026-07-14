<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--  Title -->
  <title>Home - E Library</title>
  <!--  Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.ico') }}">
  <!--  Aos -->
  <link rel="stylesheet" href="{{ asset('assets/libs/aos/dist/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/user.min.css') }}">
  <style>
        .navbar-custom{
            transition: all .35s ease;
            background: transparent;
        } .navbar-custom .nav-link{
            color:#0d6efd;
            font-weight:600;
        } .navbar-custom .navbar-brand{
            color:#0d6efd;
        } .navbar-scrolled{
            background:#fff !important;
            box-shadow:0 8px 30px rgba(0,0,0,.08);
            padding:.8rem 0;
        } .navbar-scrolled .nav-link{
            color:#212529 !important;
        } .navbar-scrolled .navbar-brand{
            color:#fff !important;
        } body{
            padding-top:80px;
        }
    </style>
  @vite(['resources/js/app.js'])
</head>

<body>
  <div class="page-wrapper p-0 overflow-hidden">
    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top navbar-custom py-3">
            <div class="container d-flex justify-content-center align-items-center">
            <a class="fw-bold me-0 py-0" href="/">
                E - Library
            </a>
            </div>
      </nav>
    </header>
    <div class="body-wrapper overflow-hidden">

        <section class="bg-primary pt-5 pb-8">
            <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-xl-5 pt-3 mb-5 mb-lg-0">
                    <h2 class="fs-12 text-white text-center text-lg-start fw-bolder mb-8">
                        Temukan Buku Favoritmu <br>
                    </h2>
                    <p class="fs-5 text-white opacity-75"> 
                        E-Library menyediakan berbagai koleksi buku yang dapat dipinjam secara online dengan mudah,cepat, dan praktis.
                    </p>
                    <div class="d-sm-flex align-items-center justify-content-center justify-content-lg-start gap-3">
                        
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn bg-white text-primary fw-semibold d-block mb-3 mb-sm-0 btn-hover-shadow">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn bg-white text-primary fw-semibold d-block mb-3 mb-sm-0 btn-hover-shadow">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn border-white text-white fw-semibold btn-hover-white d-block">Register</a>
                            @endif
                        @endauth
                    @endif
                    </div>
                </div>
                <div class="col-lg-7 col-xl-5">
                    <div class="text-center text-lg-end">
                        <img src="{{ asset('assets/images/backgrounds/welcome-bg2.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h2 class="fw-bold text-primary"> {{ $data->count() }}+ </h2>
                        <p>Total Buku</p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="fw-bold text-primary"> {{ $data->where('stok','>',0)->count() }} </h2>
                        <p>Buku Tersedia</p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="fw-bold text-primary"> 24/7 </h2>
                        <p>Akses Online</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="production pb-5" id="production-template">
            <div class="container">
            <div class="domo-contect position-relative">
                <div class="demos-view mt-5">

                    <div class="row justify-content-center">

                        <div class="text-center mb-3">
                            <p class="text-muted"> Berbagai koleksi buku yang tersedia untuk dipinjam kapan saja. </p>
                        </div>

                         <form action="{{ route('home') }}" method="GET" class="mb-5">
                            <div class="row g-3 align-items-center">
                                <div class="col-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                                        <input type="text" name="search" class="form-control" placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <select name="kategori" class="form-select">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}" {{ request('kategori') == $item->id ? 'selected' : '' }}> {{ $item->nama }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-sm btn-primary"> Cari </button>
                                </div>
                            </div>
                        </form>


                        @foreach ($data as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-8">
                            <div class="card hover-img overflow-hidden rounded-2">
                            <div class="position-relative">
                                @if ($item->cover)
                                <img src="{{ Storage::url($item->cover) }}" class="card-img-top rounded-0" alt="">
                                @else
                                <img src="{{ asset('assets/images/default-book.jpg') }}" class="card-img-top rounded-0" alt="...">
                                @endif
                                @if ($item->stok > 0)
                                <a href="{{ route('buku.show', $item->id) }}" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pinjam Buku"><i class="ti ti-book fs-4"></i></a>
                                @else
                                <a href="{{ route('buku.show', $item->id) }}" class="bg-warning rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Stok Habis"><i class="ti ti-book fs-4"></i></a>
                                @endif
                            </div>
                            <div class="card-body pt-3 p-4">
                                <h6 class="fw-semibold fs-4">{{ Str::limit($item->judul,25) }}</h6>
                                <div class="d-flex align-items-center justify-content-between">
                                <h6 class="fw-semibold fs-4 mb-0">{{ $item->stok }} <span class="ms-2 fw-normal text-muted fs-3"> tersedia</h6>
                                </div>
                            </div>
                            </div>
                        </div>
                        @endforeach

                    </div>  
                </div>
            </div>
            </div>
        </section>
    </div>
    <footer class="bg-dark text-center py-4">
        <div class="container">
            <h5 class="text-white"> 📚 E-Library </h5>
            <p class="text-white-50 mb-0"> © {{ date('Y') }} E-Library. Dikembangkan menggunakan Laravel. </p>
        </div>
    </footer>
  </div>
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/libs/aos/dist/aos.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script>
    window.addEventListener("scroll", function(){
        let navbar=document.querySelector(".navbar-custom");
        if(window.scrollY>60){
            navbar.classList.add("navbar-scrolled");
        }else{
            navbar.classList.remove("navbar-scrolled");
        }
    });

    </script>
</body>

</html>