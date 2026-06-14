document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const toggleBtn = document.getElementById("darkModeBtn");
    const themeKey = "organic_theme_mode";

    function setToggleIcon(mode) {
        const icon = toggleBtn.querySelector("i");
        if (!icon) {
            return;
        }
        if (mode === "dark") {
            icon.className = "fas fa-sun text-warning";
        } else {
            icon.className = "fas fa-moon text-secondary";
        }
    }

    function applyTheme(mode) {
        if (mode === "dark") {
            body.classList.add("dark-mode");
        } else {
            body.classList.remove("dark-mode");
        }
        if (toggleBtn) {
            setToggleIcon(mode);
        }
    }

    const saved = localStorage.getItem(themeKey);
    const defaultTheme =
        saved ||
        (window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light");
    applyTheme(defaultTheme);

    if (!toggleBtn) {
        return;
    }

    toggleBtn.addEventListener("click", function () {
        const nextTheme = body.classList.contains("dark-mode")
            ? "light"
            : "dark";
        applyTheme(nextTheme);
        localStorage.setItem(themeKey, nextTheme);
    });

    // Initialize cart badge
    initCartBadge();
});

// Product modal and cart helpers
let currentPrice = 0;
let currentQty = 1;
let currentProductId = "";
let currentProductName = "";
let currentProductImage = "";
let productModalInstance = null;

const CART_STORAGE_KEY = "organic_store_cart";
const CART_ALTERNATIVE_KEYS = [
    'organic_store_cart',
    'cart',
    'cart_items',
    'cartData',
    'shopping_cart',
    'cartItems',
];

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
    for (const key of CART_ALTERNATIVE_KEYS) {
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

// Initialize cart badge on page load
function initCartBadge() {
    const badge = document.querySelector(".badge-cart");
    if (badge) {
        const cart = getCart();
        const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
        badge.textContent = totalQty;
    }
}

// Get cart from localStorage
function getCart() {
    const primary = parseCartRaw(localStorage.getItem(CART_STORAGE_KEY));
    if (primary) return primary;

    const fallbackKey = findCartKey();
    if (fallbackKey) {
        const parsed = parseCartRaw(localStorage.getItem(fallbackKey));
        if (parsed) return parsed;
    }

    return [];
}

// Save cart to localStorage
function saveCart(cart) {
    localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
}

// Add item to cart
function addItemToCart(id, name, price, image, qty) {
    const cart = getCart();
    const existingItem = cart.find((item) => item.id === id);

    if (existingItem) {
        existingItem.qty += qty;
    } else {
        cart.push({ id, name, price, image, qty });
    }

    saveCart(cart);
    updateCartBadge();
}

// Update cart badge
function updateCartBadge() {
    const badge = document.querySelector(".badge-cart");
    if (badge) {
        const cart = getCart();
        const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
        badge.textContent = totalQty;
    }
}

function formatRupiah(amount) {
    return "Rp " + Number(amount).toLocaleString("id-ID");
}

function showFloatingAlert(message, type = "success", timeout = 3500) {
    let container = document.getElementById("alert-container");
    if (!container) {
        container = document.createElement("div");
        container.id = "alert-container";
        container.className = "position-fixed top-0 end-0 p-3";
        container.style.zIndex = 10000;
        document.body.appendChild(container);
    }

    const toastEl = document.createElement("div");
    toastEl.className = `toast align-items-center text-bg-${type} border-0 mb-2`;
    toastEl.role = "alert";
    toastEl.ariaLive = "assertive";
    toastEl.ariaAtomic = "true";
    toastEl.style.minWidth = "240px";

    toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

    container.appendChild(toastEl);

    const toast = new bootstrap.Toast(toastEl, { delay: timeout });
    toast.show();

    // Remove element after hidden
    toastEl.addEventListener("hidden.bs.toast", function () {
        toastEl.remove();
    });

    // close button
    const btnClose = toastEl.querySelector(".btn-close");
    if (btnClose) btnClose.addEventListener("click", () => toast.hide());

    return toast;
}

function openProductModal(el) {
    const btn = el;
    currentProductId = btn.dataset.id || "";
    const name = btn.dataset.name || "";
    const price = parseFloat(btn.dataset.price || 0) || 0;
    const image = btn.dataset.image || "";
    const desc = btn.dataset.description || "";

    currentPrice = price;
    currentQty = 1;
    currentProductName = name;
    currentProductImage = image;

    const modalEl = document.getElementById("productModal");
    if (!modalEl) return;

    document.getElementById("productModalTitle").textContent = name;
    document.getElementById("productModalSku").textContent =
        "SKU: SKU-" + String(currentProductId).padStart(3, "0");
    document.getElementById("productModalPrice").textContent =
        formatRupiah(price);
    document.getElementById("productModalDesc").textContent = desc;
    document.getElementById("productModalImage").src = image;
    document.getElementById("productModalQty").value = currentQty;
    document.getElementById("productModalTotal").textContent = formatRupiah(
        price * currentQty,
    );

    productModalInstance = new bootstrap.Modal(modalEl);
    productModalInstance.show();
}

function updateQty(delta) {
    currentQty = Math.max(1, currentQty + delta);
    document.getElementById("productModalQty").value = currentQty;
    document.getElementById("productModalTotal").textContent = formatRupiah(
        currentPrice * currentQty,
    );
}

function addToCart() {
    // Save to localStorage
    addItemToCart(
        currentProductId,
        currentProductName,
        currentPrice,
        currentProductImage,
        currentQty,
    );

    if (typeof showFloatingAlert === "function") {
        showFloatingAlert(
            "<strong>Berhasil!</strong> Produk ditambahkan ke keranjang.",
        );
    } else {
        alert("Produk ditambahkan ke keranjang.");
    }
    if (productModalInstance) productModalInstance.hide();
}

function buyNow() {
    // Save to localStorage before redirecting
    addItemToCart(
        currentProductId,
        currentProductName,
        currentPrice,
        currentProductImage,
        currentQty,
    );

    if (productModalInstance) productModalInstance.hide();
    showFloatingAlert(
        "<strong>Berhasil!</strong> Memproses pembelian...",
        "success",
        900,
    );
    setTimeout(() => {
        window.location.href = "/keranjang";
    }, 850);
}
