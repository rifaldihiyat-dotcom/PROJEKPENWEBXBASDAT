<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Store - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');

        /* ====== MERGED CSS (from provided style.css) ====== */
        :root {
            --primary-green: #198754;
            --bg-body: linear-gradient(to top, #c5f0d6 0%, #ffffff 100%);
            --bg-card: #ffffff;
            --text-main: #212529;
            --text-muted: #6c757d;
            --border-color: #dee2e6;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        body.dark-mode {
            --primary-green: #2ecc71;
            --bg-body: #121212;
            --bg-card: #1e1e1e;
            --text-main: #e0e0e0;
            --text-muted: #adb5bd;
            --border-color: #444444;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.5);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.7);
        }

        html,
        body {
            height: 100%;
        }

        body {
            background: var(--bg-body);
            background-attachment: fixed;
            color: var(--text-main);
            font-family: 'Poppins', 'Inter', sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-weight: 400;
        }

        main {
            flex: 1
        }

        a {
            text-decoration: none
        }

        .navbar {
            background-color: var(--bg-card) !important;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-main) !important
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-green) !important
        }

        .badge-cart {
            font-size: 0.65rem;
            padding: 0.35em 0.65em
        }

        .carousel-caption h1,
        .carousel-caption p,
        .carousel-caption .lead {
            color: #fff !important;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.9);
        }

        #category-filters {
            gap: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center
        }

        .category-btn {
            border-radius: 50px;
            padding: 8px 25px;
            border: 1px solid var(--primary-green);
            color: var(--primary-green);
            background: transparent;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 0.95rem
        }

        .category-btn.active,
        .category-btn:hover {
            background-color: var(--primary-green);
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1)
        }

        .product-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color) !important;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: default
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg) !important
        }

        .product-card img {
            transition: transform 0.5s ease
        }

        .product-card:hover img {
            transform: scale(1.05)
        }

        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block
        }

        .product-body {
            padding: 12px
        }

        .product-category {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .6px
        }

        .product-title {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 700;
            margin: 8px 0;
            color: var(--text-main);
        }

        .product-price {
            color: var(--primary-green);
            font-weight: 700;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
        }

        .no-results {
            padding: 40px 20px;
            text-align: center;
            color: var(--text-muted)
        }

        .footer-custom {
            background-color: var(--bg-card) !important;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color) !important
        }

        /* ====== MODERN MODAL & CARD STYLING ====== */
        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            background: var(--bg-card);
        }

        .modal-body {
            padding: 40px !important;
        }

        .btn-close {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-body);
            border: none;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .btn-close:hover,
        .btn-close:focus {
            background: var(--primary-green);
            opacity: 1;
            color: white;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.3);
        }

        #productModal .row>div:first-child {
            display: flex;
            align-items: center;
        }

        #productModal .card {
            border: none;
            background: linear-gradient(135deg, #f5f5f5 0%, #ffffff 100%);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.4s ease;
        }

        #productModal .card:hover {
            box-shadow: inset 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        #productModalCategory {
            display: inline-block;
            background: linear-gradient(135deg, #198754 0%, #0e6b43 100%);
            padding: 6px 14px !important;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 2px 8px rgba(25, 135, 84, 0.2);
        }

        #productModalTitle {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 700;
            margin: 12px 0;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        #productModalSku {
            font-size: 12px;
            letter-spacing: 0.3px;
        }

        #productModalPrice {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            background: linear-gradient(135deg, #198754 0%, #0e6b43 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            margin: 16px 0 !important;
        }

        #productModalDesc {
            font-size: 15px;
            line-height: 1.6;
            color: var(--text-muted);
        }

        #productModal label {
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.8px;
        }

        #productModal .d-flex.align-items-center {
            gap: 8px;
        }

        #productModalQty {
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            background: var(--bg-body);
        }

        #productModal .btn-outline-secondary {
            border-width: 2px;
            border-color: var(--border-color);
            color: var(--text-main);
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
            padding: 8px 12px;
        }

        #productModal .btn-outline-secondary:hover {
            background: var(--text-main);
            border-color: var(--text-main);
            color: white;
            transform: scale(1.05);
        }

        #productModal .bg-light {
            background: linear-gradient(135deg, #f0f0f0 0%, #f5f5f5 100%) !important;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 14px !important;
            font-weight: 600;
        }

        #productModal .bg-light>div:last-child {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            color: var(--primary-green);
        }

        #productModal .btn {
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            padding: 12px 20px;
            transition: all 0.3s ease;
            border: none;
        }

        #productModal .btn-outline-success {
            border: 2px solid var(--primary-green);
            color: var(--primary-green);
            background: transparent;
        }

        #productModal .btn-outline-success:hover {
            background: var(--primary-green);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(25, 135, 84, 0.3);
        }

        #productModal .btn-success {
            background: linear-gradient(135deg, #198754 0%, #0e6b43 100%);
            color: white;
        }

        #productModal .btn-success:hover {
            background: linear-gradient(135deg, #0e6b43 0%, #084c34 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.4);
            border-color: transparent;
        }

        #productModal hr {
            border: none;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--border-color), transparent);
            margin: 20px 0;
        }

        .product-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color) !important;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: default;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg) !important;
            border-color: var(--primary-green) !important;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    @php
    $fruitImages = [
    'Alpukat' => 'alpukat.webp',
    'Anggur Hijau' => 'anggur hijau.jpg',
    'Apel Merah' => 'apel merah.jpg',
    'Belimbing' => 'belimbing.jpeg',
    'Durian' => 'durian.jpg',
    'Jambu Air' => 'jambu air.jpg',
    'Jeruk Medan' => 'jeruk medan.jpg',
    'Kelengkeng' => 'kelengkeng.jpg',
    'Leci' => 'leci.jpeg',
    'Mangga Harum' => 'mangga harum.jpg',
    'Manggis' => 'manggis.webp',
    'Melon' => 'melon.jpg',
    'Nanas' => 'nanas.jpg',
    'Pepaya' => 'pepaya.jpg',
    'Pisang Ambon' => 'pisang ambon.jpg',
    'Rambutan' => 'rambutan.jpg',
    'Salak' => 'salak.jpeg',
    'Semangka' => 'semangka.jpeg',
    'Sirsak' => 'sirsak.jpg',
    'Strawberry' => 'strawberry.webp',
    ];
    @endphp
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/logo/logo Organic food .png') }}" alt="Logo" width="45" height="45" class="rounded-circle me-2 shadow-sm">
                <span class="text-success">OrganicStore</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('promo') }}">Promo</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('testimoni') }}">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cara-belanja') }}">Cara Belanja</a></li>

                    <li class="nav-item ms-2">
                        @auth
                        <a href="{{ url('/admin') }}" class="btn btn-success btn-sm rounded-pill px-3"><i class="fas fa-gauge me-1"></i> Dashboard</a>
                        @else
                        <a href="{{ url('/admin/login') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">Masuk</a>
                        @endauth
                    </li>

                    <li class="nav-item ms-2">
                        <a href="{{ url('/profile') }}" class="nav-link text-success" title="Akun Saya"><i class="fas fa-user-circle fa-lg"></i></a>
                    </li>

                    <li class="nav-item ms-2 me-2">
                        <a href="{{ route('keranjang') }}" class="position-relative text-decoration-none text-success"><i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger badge-cart" style="font-size:0.6rem;">0</span>
                        </a>
                    </li>

                    <li class="nav-item ms-2">
                        <button id="darkModeBtn" style="background:none; border:none; cursor:pointer; padding:5px;" title="Dark Mode"><i class="fas fa-moon text-secondary"></i></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO CAROUSEL (from original HTML) -->
    <header id="heroCarousel" class="carousel slide mb-5 shadow-sm" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=1600&q=80" class="d-block w-100" style="height:500px; object-fit:cover; filter:brightness(0.7);" alt="Farm">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-4 fw-bold">Fresh & Organic Market</h1>
                    <p class="lead">Pilihan organik terbaik langsung dari petani.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="https://images.unsplash.com/photo-1610832958506-aa56368176cf?w=1600&q=80" class="d-block w-100" style="height:500px; object-fit:cover; filter:brightness(0.7);" alt="Fruits">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-4 fw-bold">Buah-buahan Segar</h1>
                    <p class="lead">Dipetik pagi hari, dikirim hari ini juga.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </header>

    <main class="container mb-5">
        <div class="d-flex justify-content-center flex-wrap mb-4" id="category-filters">
            <a href="{{ route('home') }}" class="category-btn {{ !request('category') ? 'active' : '' }}">Semua</a>
            @foreach($categories as $cat)
            @php
            // Only show category if it has at least one buah
            $hasFruits = $cat->buah()->exists();
            @endphp
            @if($hasFruits)
            <a href="?category={{ $cat->id_kategori }}" class="category-btn {{ request('category') == $cat->id_kategori ? 'active' : '' }}">{{ $cat->nama_kategori }}</a>
            @endif
            @endforeach
        </div>

        <div class="row g-4" id="product-list" style="flex: 1;">
            @if($fruits->isEmpty())
            <div class="col-12">
                <div class="no-results">
                    <h5 class="mb-2">Buah dengan kategori ini belum tersedia.</h5>
                    <p class="mb-0">Silakan coba kategori lain atau kunjungi kembali nanti.</p>
                </div>
            </div>
            @else
            @foreach($fruits as $fruit)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="product-card">
                    @php
                    // Prefer showing the name from database and try to find a matching image file
                    $displayName = $fruit->nama_buah;

                    // Try several filename variants based on DB name to find the correct image
                    $nameVariants = [
                    $fruit->nama_buah,
                    strtolower($fruit->nama_buah),
                    ucwords(strtolower($fruit->nama_buah)),
                    ];

                    $extensions = ['jpg','jpeg','png','webp'];
                    $foundImage = null;

                    foreach ($extensions as $ext) {
                    foreach ($nameVariants as $base) {
                    $candidates = [
                    $base . '.' . $ext,
                    str_replace(' ', '', $base) . '.' . $ext,
                    str_replace(' ', '-', $base) . '.' . $ext,
                    str_replace(' ', '_', $base) . '.' . $ext,
                    ];
                    foreach ($candidates as $cand) {
                    if (file_exists(public_path('images/buah/' . $cand))) {
                    $foundImage = $cand;
                    break 3;
                    }
                    }
                    }
                    }

                    // fallback to mapping by name if earlier mapping exists, otherwise default
                    if (!$foundImage) {
                    $foundImage = $fruitImages[$fruit->nama_buah] ?? null;
                    }
                    if (!$foundImage) {
                    $foundImage = 'Apel.jpg';
                    }

                    $fruitImage = $foundImage;
                    
                    // Prioritize database 'gambar' column
                    $imageUrl = asset('images/buah/' . $fruitImage);
                    if (!empty($fruit->gambar)) {
                        $imageUrl = asset('storage/' . $fruit->gambar);
                    }
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $displayName }}" class="product-image">
                    <div class="product-body">
                        <div class="product-category">{{ $fruit->nama_kategori ?? 'Lokal' }}</div>
                        <div class="product-title">{{ $displayName }}</div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="product-price">Rp {{ number_format($fruit->harga_jual, 0, ',', '.') }}/kg</div>
                            <button type="button" class="btn btn-sm btn-outline-success rounded-pill btn-open-product"
                                onclick="openProductModal(this)"
                                data-id="{{ $fruit->id_buah }}"
                                data-name="{{ $fruit->nama_buah }}"
                                data-price="{{ $fruit->harga_jual }}"
                                data-image="{{ $imageUrl }}"
                                data-description="Buah {{ $fruit->nama_buah }} segar dengan rasa manis alami.">
                                Beli
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </main>

    <footer class="footer-custom text-center py-4 bg-light mt-auto border-top">
        <div class="container">
            <p class="mb-0 fw-bold text-muted">&copy; {{ date('Y') }} Kelompok 9 Organic Store</p>
        </div>
    </footer>

    <!-- Product Detail Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close position-absolute" style="top: 15px; right: 15px; z-index: 10;" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="row g-0">
                        <div class="col-md-5">
                            <div class="card p-4" style="border-radius: 0; height: 100%;">
                                <img id="productModalImage" src="" alt="Product" class="img-fluid rounded" style="height: 420px; object-fit: cover; width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-7" style="padding: 40px 35px;">
                            <span id="productModalCategory" class="badge mb-3">buah</span>
                            <h2 id="productModalTitle"></h2>
                            <div class="small text-muted mb-2" id="productModalSku">SKU: -</div>
                            <h3 id="productModalPrice"></h3>
                            <p id="productModalDesc" class="mb-4">Deskripsi singkat produk.</p>

                            <hr>
                            <div class="mt-4">
                                <label class="mb-3">JUMLAH:</label>
                                <div class="d-flex align-items-center mb-4">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQty(-1)">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input id="productModalQty" type="text" value="1" class="form-control text-center mx-2" style="width: 70px; border-radius: 10px;" readonly>
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="updateQty(1)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>

                                <div class="mb-4">
                                    <div class="bg-light p-3 rounded d-flex justify-content-between align-items-center">
                                        <div style="font-weight: 600; font-size: 14px;">Total Harga:</div>
                                        <div id="productModalTotal" style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; color: var(--primary-green);">Rp 0</div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2" style="grid-template-columns: 1fr 1fr;">
                                    <button class="btn btn-outline-success" onclick="addToCart()"><i class="fas fa-shopping-cart me-2"></i> Keranjang</button>
                                    <button class="btn btn-success" onclick="buyNow()"><i class="fas fa-bolt me-2"></i>Beli Sekarang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}?v={{ filemtime(public_path('js/script.js')) }}"></script>
</body>

</html>
