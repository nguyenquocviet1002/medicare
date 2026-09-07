(function () {
  var STORAGE_KEY = "medicare_cart";
  var badgeEl = null;
  var toastEl = null;
  var toastTimer = null;

  function getCart() {
    try {
      var raw = localStorage.getItem(STORAGE_KEY);
      var parsed = raw ? JSON.parse(raw) : [];
      return Array.isArray(parsed) ? parsed : [];
    } catch (e) {
      return [];
    }
  }

  function saveCart(cart) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
    } catch (e) {
      /* bỏ qua khi localStorage bị chặn */
    }
  }

  function ensureBadge() {
    if (!badgeEl) {
      badgeEl = document.querySelector(".header__cart-badge");
    }
  }

  function refreshBadge() {
    ensureBadge();
    if (!badgeEl) return;
    var count = getCart().length;
    badgeEl.textContent = count > 0 ? String(count) : "";
  }

  function parsePrice(value) {
    var str = String(value || "").replace(/[^\d]/g, "");
    var num = parseInt(str, 10);
    return isNaN(num) ? 0 : num;
  }

  function formatCurrency(amount) {
    return new Intl.NumberFormat("vi-VN").format(amount || 0) + " VNĐ";
  }

  function showToast(message, isWarning) {
    if (!toastEl) {
      toastEl = document.createElement("div");
      toastEl.className = "cart-toast";
      document.body.appendChild(toastEl);
    }
    toastEl.textContent = message;
    toastEl.classList.toggle("cart-toast--warning", !!isWarning);
    toastEl.classList.add("cart-toast--visible");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () {
      toastEl.classList.remove("cart-toast--visible");
    }, 2000);
  }

  function add(item) {
    var cart = getCart();
    var exists = cart.some(function (entry) {
      return entry.id === item.id;
    });

    if (exists) {
      showToast("Sản phẩm đã có trong giỏ hàng", true);
      return cart.length;
    }

    cart.push({
      id: item.id,
      name: item.name,
      price: parsePrice(item.price)
    });
    saveCart(cart);
    refreshBadge();
    showToast("Đã thêm «" + item.name + "» vào giỏ hàng");
    return cart.length;
  }

  function remove(id) {
    var cart = getCart().filter(function (entry) {
      return entry.id !== id;
    });
    saveCart(cart);
    refreshBadge();
    return cart;
  }

  // Event delegation: mọi nút có data-cart-id
  document.addEventListener("click", function (event) {
    var btn = event.target.closest("[data-cart-id]");
    if (!btn) return;
    add({
      id: btn.getAttribute("data-cart-id"),
      name: btn.getAttribute("data-cart-name") || "",
      price: btn.getAttribute("data-cart-price") || "0"
    });
  });

  window.Cart = {
    add: add,
    remove: remove,
    getAll: getCart,
    getCount: function () {
      return getCart().length;
    },
    refreshBadge: refreshBadge,
    parsePrice: parsePrice,
    formatCurrency: formatCurrency
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", refreshBadge);
  } else {
    refreshBadge();
  }
  window.addEventListener("load", refreshBadge);
})();
