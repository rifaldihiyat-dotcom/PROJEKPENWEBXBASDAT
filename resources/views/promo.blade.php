<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo - Organic Store</title>
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('promo') }}">Promo</a></li>
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
        <div class="text-center mb-5 fade-in">
            <h1 class="fw-bold text-danger">HOT PROMO 🔥</h1>
            <p class="text-muted">Klaim voucher diskon hari ini!</p>
            <p class="text-muted">JANGAN SAMPAI KEHILANGAN KESEMPATAN INI!!!</p>
        </div>

        <div class="row g-4 fade-in">
            <div class="col-md-4">
                <div class="card h-100 border-danger shadow-sm product-card position-relative">
                    <div class="badge bg-danger position-absolute top-0 end-0 m-3 shadow">DISKON 50%</div>
                    <img src="{{ asset('images/buah/semangka.jpeg') }}" class="card-img-top" style="height:250px; object-fit:cover;" onerror="this.src='https://dummyimage.com/400x300/dee2e6/6c757d.jpg&text=No+Image'">
                    <div class="card-body text-center">
                        <h5 class="fw-bold">Semangka Merah Jumbo</h5>
                        <p class="text-decoration-line-through text-muted mb-1">Rp 47.000</p>
                        <h3 class="text-danger fw-bold">Rp 25.000</h3>
                        <button class="btn btn-danger w-100 mt-3 fw-bold rounded-pill shadow-sm" onclick="showFloatingAlert('<strong>Berhasil!</strong> Voucher Semangka 50% diklaim.')">
                            Klaim Promo
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-danger shadow-sm product-card position-relative">
                    <div class="badge bg-warning text-dark position-absolute top-0 end-0 m-3 shadow">BUY 1 GET 1</div>
                    <img src="{{ asset('images/buah/anggur hijau.jpg') }}" class="card-img-top" style="height:250px; object-fit:cover;" onerror="this.src='https://dummyimage.com/400x300/dee2e6/6c757d.jpg&text=No+Image'">
                    <div class="card-body text-center">
                        <h5 class="fw-bold">Anggur Import</h5>
                        <p class="text-muted mb-1">Harga Normal</p>
                        <h3 class="text-danger fw-bold">Rp 25.000</h3>
                        <button class="btn btn-danger w-100 mt-3 fw-bold rounded-pill shadow-sm" onclick="showFloatingAlert('<strong>Hore!</strong> Voucher Anggur Import aktif.')">
                            Klaim Promo
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-danger shadow-sm product-card position-relative">
                    <div class="badge bg-success position-absolute top-0 end-0 m-3 shadow">FLASH SALE</div>
                    <img src="{{ asset('images/buah/pisang ambon.jpg') }}" class="card-img-top" style="height:250px; object-fit:cover;" onerror="this.src='https://dummyimage.com/400x300/dee2e6/6c757d.jpg&text=No+Image'">
                    <div class="card-body text-center">
                        <h5 class="fw-bold">Pisang Import</h5>
                        <p class="text-decoration-line-through text-muted mb-1">Rp 75.000</p>
                        <h3 class="text-danger fw-bold">Rp 65.000</h3>
                        <button class="btn btn-danger w-100 mt-3 fw-bold rounded-pill shadow-sm" onclick="showFloatingAlert('<strong>Sukses!</strong> Voucher Pisang Import masuk akun.')">
                            Klaim Promo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer-custom text-center py-4 bg-light mt-auto border-top">
        <div class="container">
            <p class="mb-0 fw-bold text-muted">&copy; 2026 Kelompok 9 Organic Store</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
