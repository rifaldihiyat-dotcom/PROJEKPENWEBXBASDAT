<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Organic Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: 'Poppins', 'Inter', sans-serif;
            font-weight: 400;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/logo/logo Organic food .png') }}" alt="Logo" width="45" height="45" class="rounded-circle me-2 shadow-sm" onerror="this.src='https://dummyimage.com/45x45/198754/fff&text=OS'">
                <span class="text-success">OrganicStore</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('promo') }}">Promo</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('testimoni') }}">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cara-belanja') }}">Cara Belanja</a></li>

                    <li class="nav-item ms-2">
                        <a href="{{ url('/admin/login') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">Masuk</a>
                    </li>

                    <li class="nav-item ms-2">
                        <a href="{{ url('/profile') }}" class="nav-link text-success" title="Akun Saya">
                            <i class="fas fa-user-circle fa-lg"></i>
                        </a>
                    </li>

                    <li class="nav-item ms-2 me-2">
                        <a href="{{ route('keranjang') }}" class="position-relative text-decoration-none text-success">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger badge-cart" style="font-size: 0.6rem;">0</span>
                        </a>
                    </li>

                    <li class="nav-item ms-2">
                        <button id="darkModeBtn" style="background:none; border:none; cursor:pointer; padding: 5px;" title="Dark Mode">
                            <i class="fas fa-moon text-secondary"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="alert-container" class="position-fixed top-0 end-0 p-3" style="z-index: 10000;"></div>

    <main class="container py-5 flex-grow-1">
        <div class="row align-items-center mb-5">
            <div class="col-md-6 mb-4 mb-md-0 fade-in">
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=800&q=80"
                    class="img-fluid rounded-4 shadow product-card"
                    alt="Tentang Kami">
            </div>

            <div class="col-md-6 fade-in">
                <span class="text-success fw-bold text-uppercase ls-2">Tentang Kami</span>
                <h2 class="display-5 fw-bold mb-3 mt-2">Kelompok 9 Organic</h2>
                <p class="lead text-muted">Kami berdedikasi menyediakan pangan sehat organik langsung dari petani lokal ke meja makan Anda.</p>

                <p>Website ini menyediakan sayur-sayuran segar, buah-buahan manis, serta makanan & minuman ringan yang menyehatkan tanpa bahan pengawet berbahaya.</p>

                <p>Didirikan sebagai projek UAS Pemrograman Web, toko ini berkembang menjadi simulasi e-commerce modern yang mengedepankan teknologi dan kesehatan. Kami percaya bahwa makanan sehat adalah hak semua orang.</p>

                <div class="row mt-4 g-3">
                    <div class="col-4 text-center">
                        <div class="p-3 border rounded bg-light h-100 category-btn">
                            <h3 class="fw-bold text-success mb-0">100%</h3>
                            <small class="fw-bold text-muted">Organik</small>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="p-3 border rounded bg-light h-100 category-btn">
                            <h3 class="fw-bold text-success mb-0">50+</h3>
                            <small class="fw-bold text-muted">Petani</small>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="p-3 border rounded bg-light h-100 category-btn">
                            <h3 class="fw-bold text-success mb-0">24h</h3>
                            <small class="fw-bold text-muted">Support</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer-custom text-center py-4 bg-light mt-auto border-top">
        <div class="container">
            <p class="mb-0 fw-bold text-muted">&copy; 2026 Kelompok 9 Organic Store</p>
            <small class="text-muted">Dibuat dengan <i class="fas fa-heart text-danger"></i> untuk Mata Kuliah Pemrograman Web</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
