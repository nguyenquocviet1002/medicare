<?php
get_header();
?>

<main id="primary" class="site-main cart-page-template">
    <section class="cart-page" id="cart-page" aria-label="Giỏ hàng dịch vụ">
        <div class="container">

            <div class="cart-page__header">
                <h2 class="cart-page__title"><?php echo esc_html( 'GIỎ HÀNG CỦA BẠN' ); ?></h2>
            </div>

            <div class="cart-page__wrapper">

                <div class="cart-page__list" id="cart-items-list"></div>

                <div class="cart-page__summary">
                    <span class="cart-page__total-label"><?php echo esc_html( 'Tổng tiền thanh toán:' ); ?></span>
                    <span class="cart-page__total-price" id="cart-total-price"><?php echo esc_html( '0 VNĐ' ); ?></span>
                </div>

            </div>

        </div>
    </section>

    <noscript>
        <div class="container">
            <div class="cart-page__empty"><?php echo esc_html( 'Vui lòng bật JavaScript để xem giỏ hàng của bạn.' ); ?></div>
        </div>
    </noscript>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var listContainer = document.getElementById("cart-items-list");
            var totalPriceElement = document.getElementById("cart-total-price");

            if (!listContainer || !totalPriceElement) return;

            var cartItems = window.Cart ? window.Cart.getAll() : [];

            var updateCartView = function () {
                if (cartItems.length === 0) {
                    listContainer.innerHTML = '<div class="cart-page__empty">Giỏ hàng của bạn đang trống.</div>';
                    totalPriceElement.textContent = "0 VNĐ";
                    return;
                }

                var $ = window.Cart;
                listContainer.innerHTML = cartItems
                    .map(function (item) {
                        var priceText = $ ? $.formatCurrency(item.price) : item.price;
                        var encodedId = encodeURIComponent(item.id);
                        var safeName = (item.name || "").replace(/"/g, "&quot;");
                        return '<div class="cart-page__item" data-id="' + encodedId + '">' +
                            '<div class="cart-page__item-info">' +
                            '<button class="cart-page__item-remove" type="button" aria-label="Xóa ' + safeName + '" onclick="removeCartItem(\'' + encodedId + '\')">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
                            '<line x1="18" y1="6" x2="6" y2="18"></line>' +
                            '<line x1="6" y1="6" x2="18" y2="18"></line>' +
                            '</svg>' +
                            '</button>' +
                            '<span class="cart-page__item-name">' + item.name + '</span>' +
                            '</div>' +
                            '<span class="cart-page__item-price">' + priceText + '</span>' +
                            '</div>';
                    })
                    .join("");

                var totalAmount = cartItems.reduce(function (sum, item) {
                    return sum + item.price;
                }, 0);
                totalPriceElement.textContent = $ ? $.formatCurrency(totalAmount) : totalAmount;
            };

            updateCartView();

            window.removeCartItem = function (id) {
                if (window.Cart) window.Cart.remove(decodeURIComponent(id));
                cartItems = window.Cart ? window.Cart.getAll() : [];
                cartItems = cartItems.filter(function (item) {
                    return encodeURIComponent(item.id) !== id;
                });
                updateCartView();
            };
        });
    </script>
</main>

<?php
get_footer();
