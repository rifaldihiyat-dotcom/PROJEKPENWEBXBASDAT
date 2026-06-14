<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Organic Store</title>
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
        <h2 class="fw-bold mb-4 text-center">Keranjang Belanja Anda</h2>

        <div class="row g-5">
            <div class="col-lg-8 fade-in">
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 ps-4">Produk</th>
                                    <th class="py-3">Harga</th>
                                    <th class="py-3">Jumlah</th>
                                    <th class="py-3">Total</th>
                                    <th class="py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                                <tr>
                                    <td colspan="5" class="text-center py-5">Memuat keranjang...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('home') }}" class="text-decoration-none text-success fw-bold"><i class="fas fa-arrow-left me-2"></i>Lanjut Belanja</a>
                </div>
            </div>

            <div class="col-lg-4 fade-in">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3">Ringkasan Pesanan</h4>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-bold" id="checkout-subtotal" data-val="0">Rp 0</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Pengiriman</span>
                            <span class="fw-bold text-success" id="checkout-shipping">Rp 0</span>
                        </div>
                        <hr>

                        <form id="checkoutForm">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">KURIR PENGIRIMAN</label>
                                <select class="form-select" id="courierSelect" required>
                                    <option value="0" selected disabled>-- Pilih Kurir --</option>
                                    <option value="15000">GoSend Instant (Rp 15.000)</option>
                                    <option value="10000">GrabExpress SameDay (Rp 10.000)</option>
                                    <option value="20000">JNE YES (Rp 20.000)</option>
                                    <option value="0">Ambil Sendiri (Gratis)</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">METODE PEMBAYARAN</label>
                                <select class="form-select" required>
                                    <option value="tf">Transfer Bank (BCA/Mandiri)</option>
                                    <option value="qris">QRIS (GoPay/OVO/Dana)</option>
                                    <option value="cod">COD (Bayar di Tempat)</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between mb-4 align-items-center">
                                <span class="h5 mb-0 fw-bold">Total Bayar</span>
                                <span class="h4 mb-0 fw-bold text-success" id="checkout-total">Rp 0</span>
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2 fw-bold shadow-sm">
                                <i class="fas fa-lock me-2"></i>Bayar Sekarang
                            </button>
                        </form>
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
    <script src="{{ asset('js/script.js') }}?v={{ filemtime(public_path('js/script.js')) }}"></script>
    <script>
        // Cart functions - inline to avoid timing issues
        // CART_STORAGE_KEY is already defined in script.js

        function formatRupiah(amount) {
            return "Rp " + Number(amount).toLocaleString("id-ID");
        }

        function parseCartRaw(raw) {
            if (!raw) return null;
            try {
                const parsed = JSON.parse(raw);
                if (Array.isArray(parsed)) return parsed;
                if (parsed && typeof parsed === 'object') {
                    if (Array.isArray(parsed.items)) return parsed.items;
                    if (Array.isArray(parsed.cart)) return parsed.cart;
                    if (Array.isArray(parsed.products)) return parsed.products;
                    if (Array.isArray(parsed.cartItems)) return parsed.cartItems;
                    if (Array.isArray(parsed.data)) return parsed.data;
                }
            } catch (e) {
                return null;
            }
            return null;
        }

        function findCartKey() {
            const altKeys = [
                CART_STORAGE_KEY,
                'cart',
                'cart_items',
                'cartData',
                'shopping_cart',
                'cartItems',
            ];
            for (const key of altKeys) {
                const raw = localStorage.getItem(key);
                const parsed = parseCartRaw(raw);
                if (parsed) return key;
            }

            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (!key) continue;
                const raw = localStorage.getItem(key);
                const parsed = parseCartRaw(raw);
                if (parsed) return key;
            }
            return null;
        }

        function getCart() {
            const primaryRaw = localStorage.getItem(CART_STORAGE_KEY);
            const primary = parseCartRaw(primaryRaw);
            if (primary) return primary;
            const fallbackKey = findCartKey();
            if (fallbackKey) {
                const parsed = parseCartRaw(localStorage.getItem(fallbackKey));
                if (parsed) return parsed;
            }
            return [];
        }

        function saveCart(cart) {
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
        }

        function removeFromCart(productId) {
            let cart = getCart();
            cart = cart.filter(item => item.id != productId);
            saveCart(cart);
            renderCart();
            updateTotals();
        }

        function updateQuantity(productId, newQty) {
            const cart = getCart();
            const item = cart.find(item => item.id == productId);
            if (item) {
                item.qty = Math.max(1, parseInt(newQty) || 1);
                saveCart(cart);
                renderCart();
                updateTotals();
            }
        }

        function renderCart() {
            const cart = getCart();
            const cartBody = document.getElementById("cart-table-body");

            if (!cartBody) {
                return;
            }

            if (cart.length === 0) {
                cartBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-shopping-cart fa-3x mb-3" style="opacity: 0.5;"></i>
                                <p>Keranjang Anda kosong</p>
                                <a href="{{ route('home') }}" class="btn btn-success btn-sm">Mulai Belanja</a>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            let html = '';
            cart.forEach(item => {
                const subtotal = item.price * item.qty;
                html += `
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                <div>
                                    <div class="fw-bold">${item.name}</div>
                                    <small class="text-muted">${formatRupiah(item.price)}/kg</small>
                                </div>
                            </div>
                        </td>
                        <td>${formatRupiah(item.price)}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2" style="width: fit-content;">
                                <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity('${item.id}', ${item.qty - 1})">-</button>
                                <input type="number" value="${item.qty}" min="1" class="form-control text-center" style="width: 50px;" onchange="updateQuantity('${item.id}', this.value)">
                                <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity('${item.id}', ${item.qty + 1})">+</button>
                            </div>
                        </td>
                        <td>${formatRupiah(subtotal)}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart('${item.id}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            cartBody.innerHTML = html;
        }

        function updateTotals() {
            const cart = getCart();
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            const shippingSelect = document.getElementById("courierSelect");
            const shipping = parseInt(shippingSelect.value) || 0;
            const total = subtotal + shipping;

            document.getElementById("checkout-subtotal").textContent = formatRupiah(subtotal);
            document.getElementById("checkout-subtotal").dataset.val = subtotal;
            document.getElementById("checkout-shipping").textContent = formatRupiah(shipping);
            document.getElementById("checkout-total").textContent = formatRupiah(total);
        }

        // Initialize
        document.addEventListener("DOMContentLoaded", function() {
            renderCart();
            updateTotals();

            // Update totals when courier changes
            const courierSelect = document.getElementById("courierSelect");
            if (courierSelect) {
                courierSelect.addEventListener("change", updateTotals);
            }

            // Handle checkout form
            const checkoutForm = document.getElementById("checkoutForm");
            if (checkoutForm) {
                checkoutForm.addEventListener("submit", async function(e) {
                    e.preventDefault();
                    const cart = getCart();
                    if (cart.length === 0) {
                        alert("Keranjang Anda kosong");
                        return;
                    }

                    try {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const res = await fetch("{{ route('checkout.store') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                cart: cart.map(i => ({
                                    id: i.id,
                                    qty: i.qty
                                }))
                            })
                        });

                        if (!res.ok) {
                            const err = await res.json().catch(() => ({}));
                            alert('Gagal memproses pesanan: ' + (err.message || res.statusText));
                            return;
                        }

                        const json = await res.json();
                        if (json.status === 'success') {
                            localStorage.removeItem(CART_STORAGE_KEY);
                            showFloatingAlert(
                                '<strong>🎉 Pesanan Berhasil!</strong><br>Terima kasih telah berbelanja di Organic Store. Pesanan Anda sedang diproses.',
                                'success',
                                4000
                            );
                            setTimeout(() => {
                                window.location.href = "{{ route('home') }}";
                            }, 3500);
                        } else {
                            alert('Gagal: ' + (json.message || 'Terjadi kesalahan'));
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Terjadi kesalahan saat menghubungi server.');
                    }
                });
            }
        });
    </script>
</body>

</html>
