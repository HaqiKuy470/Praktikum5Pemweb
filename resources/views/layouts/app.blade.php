<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Berita') - Desa Jalatrang</title>
    <link rel="shortcut icon" href="https://jalatrang.id/favicon.png" type="image/png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="{{ asset('css/jalatrang.css') }}">
</head>
<body>

{{-- Top bar --}}
<div class="topbar">
    <div class="container-fluid px-lg-4 px-3 d-flex align-items-center justify-content-between gap-3">
        <div class="d-flex align-items-center gap-2 overflow-hidden" style="flex:1">
            <span class="topbar-badge text-nowrap"><i class="fas fa-bullhorn me-1"></i> INFO TERKINI</span>
            <div class="news-flash-wrapper">
                <div class="news-flash-scroll">
                    <span class="me-5 text-white-50"><i class="far fa-circle text-warning me-1" style="font-size:0.5rem"></i> Sekarang Anda dapat belanja langsung di Warung Desa yang merupakan Warung Online Masyarakat Desa Jalatrang.</span>
                    <span class="me-5 text-white-50"><i class="far fa-circle text-warning me-1" style="font-size:0.5rem"></i> Kini Hadir Perpustakaan Desa Selaras dengan wajah baru dan manjamen yang lebih baik</span>
                    <span class="me-5 text-white-50"><i class="far fa-circle text-warning me-1" style="font-size:0.5rem"></i> Warga bisa memeriksa langsung untuk memeriksa pembayaran PBB pada website</span>
                    <span class="me-5 text-white-50"><i class="far fa-circle text-warning me-1" style="font-size:0.5rem"></i> Desa Jalatrang akan membuka layanan public untuk mempermudah akses informasi dan pelayanan masyarakat</span>
                </div>
            </div>
        </div>
        <div class="d-none d-md-flex align-items-center gap-3 text-nowrap text-white-50" style="font-size:0.75rem">
            <span><i class="far fa-clock text-warning me-1"></i> {{ now()->translatedFormat('l, j F Y') }}</span>
        </div>
    </div>
</div>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-publik sticky-top" id="mainNav">
    <div class="container-fluid px-lg-4 px-3">
        <a class="navbar-brand d-flex align-items-center gap-2 brand-box text-decoration-none me-2" href="{{ route('berita.index') }}">
            <img src="https://jalatrang.id/assets/images/info_desa/logo.png" class="navbar-logo flex-shrink-0" alt="Logo Desa">
            <div class="brand-desa-text text-white overflow-hidden" style="min-width:0;">
                <div class="fw-bold teko text-truncate" style="font-size:1.35rem;line-height:1;color:#fff">PEMERINTAH DESA JALATRANG</div>
                <div class="sub text-white-50 text-truncate d-none d-sm-block" style="font-size:0.65rem;letter-spacing:0.05em">KECAMATAN CIPAKU KABUPATEN CIAMIS</div>
            </div>
        </a>
        <div class="navbar-action-group d-flex flex-row align-items-center flex-nowrap gap-2 ms-auto flex-shrink-0 order-lg-last">
            @auth
                <span class="text-white small d-none d-md-inline">
                    <i class="bi bi-person-circle"></i>
                    {{ auth()->user()->name }} ({{ auth()->user()->role }})
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-warning">Login</a>
            @endauth
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPubMain">
                <span class="navbar-toggler-icon" style="filter:invert(1)"></span>
            </button>
        </div>
        <div class="offcanvas offcanvas-start offcanvas-lg text-bg-dark border-end-0" tabindex="-1" id="offcanvasPubMain">
            <div class="offcanvas-header border-bottom border-white-10 p-3 d-lg-none">
                <div class="fw-bold teko text-white" style="font-size:1.3rem;line-height:1">DESA JALATRANG</div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body p-3 p-lg-0">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item mb-1 mb-lg-0">
                        <a class="nav-link nav-home-pill" href="#" title="Beranda">
                            <i class="fas fa-home me-2 me-lg-0"></i><span class="d-inline d-lg-none fw-bold ms-1">Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown mb-1 mb-lg-0">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> VISI</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> MISI</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> Sejarah</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> Struktural</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mb-1 mb-lg-0"><a class="nav-link" href="#">Kependudukan</a></li>
                    <li class="nav-item mb-1 mb-lg-0"><a class="nav-link active" href="{{ route('berita.index') }}">Berita</a></li>
                    <li class="nav-item mb-1 mb-lg-0"><a class="nav-link" href="#">Potensi Wisata</a></li>
                    <li class="nav-item dropdown mb-1 mb-lg-0">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">IDM &amp; SDGs</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> IDM</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> SDGs</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown mb-1 mb-lg-0">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">Ketahanan Pangan</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> Statistik</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> Galeri</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> Top 10</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown mb-1 mb-lg-0">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">Keuangan</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> APBdes</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> PBB</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> Kegiatan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown mb-1 mb-lg-0">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">Download</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> Regulasi</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-chevron-right me-2 text-warning" style="font-size:0.65rem"></i> Materi</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

@yield('content')

{{-- Footer --}}
<footer class="footer-dark pt-5 pb-2 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="https://jalatrang.id/assets/images/info_desa/logo.png" style="width:50px;height:50px;object-fit:contain" alt="Logo">
                    <div>
                        <div class="fw-bold text-white">PEMERINTAH DESA</div>
                        <div class="fw-bold text-warning" style="font-size:1.1rem">JALATRANG</div>
                    </div>
                </div>
                <p style="font-size:0.83rem;line-height:1.7">
                    Jalan Raya Cipaku Nomor 181<br>
                    Desa Jalatrang, Kecamatan Cipaku<br>
                    Kabupaten Ciamis<br>
                </p>
                <a href="https://www.google.com/maps/place/Jalatrang" target="_blank" class="btn btn-sm btn-outline-warning mt-1">
                    <i class="fas fa-map-marker-alt me-1"></i> Lihat Peta
                </a>
            </div>
            <div class="col-lg-2 col-6">
                <h5 class="mb-3">Menu</h5>
                <ul class="list-unstyled">
                    <li class="mb-1"><a href="#"><i class="bi bi-chevron-right me-1"></i>Beranda</a></li>
                    <li class="mb-1"><a href="{{ route('berita.index') }}"><i class="bi bi-chevron-right me-1"></i>Berita</a></li>
                    <li class="mb-1"><a href="#"><i class="bi bi-chevron-right me-1"></i>Struktural</a></li>
                    <li class="mb-1"><a href="#"><i class="bi bi-chevron-right me-1"></i>APBDes</a></li>
                    <li class="mb-1"><a href="#"><i class="bi bi-chevron-right me-1"></i>Prestasi</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-6">
                <h5 class="mb-3">Link Terkait</h5>
                <ul class="list-unstyled">
                    <li class="mb-1"><a href="https://kemendesa.go.id" target="_blank"><i class="bi bi-box-arrow-up-right me-1"></i>Kemendesa</a></li>
                    <li class="mb-1"><a href="https://ciamis.go.id" target="_blank"><i class="bi bi-box-arrow-up-right me-1"></i>Kab. Ciamis</a></li>
                    <li class="mb-1"><a href="https://jabar.go.id" target="_blank"><i class="bi bi-box-arrow-up-right me-1"></i>Pemprov Jabar</a></li>
                    <li class="mb-1"><a href="{{ route('login') }}"><i class="bi bi-shield-lock me-1"></i>Panel Admin</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5 class="mb-3">Media Sosial</h5>
                <a href="https://x.com" target="_blank" class="d-flex align-items-center gap-2 mb-2">
                    <img src="https://jalatrang.id/assets/images/medsos/67ac8de22ae3b_1739361762.png" style="width:22px;height:22px;object-fit:contain" alt="twitter/x"> twitter/x
                </a>
                <a href="https://facebook.com" target="_blank" class="d-flex align-items-center gap-2 mb-2">
                    <img src="https://jalatrang.id/assets/images/medsos/67ac8dd784ead_1739361751.png" style="width:22px;height:22px;object-fit:contain" alt="facebook"> facebook
                </a>
                <a href="https://www.youtube.com/@jalatrangTV" target="_blank" class="d-flex align-items-center gap-2 mb-2">
                    <img src="https://jalatrang.id/assets/images/medsos/67ac8dee5976c_1739361774.png" style="width:22px;height:22px;object-fit:contain" alt="youtube"> youtube
                </a>
                <a href="https://instagram.com/pemerintahdesajalatrang" target="_blank" class="d-flex align-items-center gap-2 mb-2">
                    <img src="https://jalatrang.id/assets/images/medsos/67ac8e05b46f1_1739361797.png" style="width:22px;height:22px;object-fit:contain" alt="instagram"> instagram
                </a>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center mt-4 py-3">
        &copy; 2026 Pemerintah Desa Jalatrang — Semua hak dilindungi.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({ duration: 700, once: true });
</script>
</body>
</html>
