document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menu-toggle");
  const mainNav = document.getElementById("main-nav");
  const backdrop = document.getElementById("header-backdrop");
  const submenuToggles = document.querySelectorAll(".header__submenu-toggle");
  const submenus = document.querySelectorAll(".header__submenu");
  const closeableLinks = document.querySelectorAll(".header__menu-link, .header__submenu a");

  const toggleMenu = () => {
    const isOpen = menuToggle.classList.toggle("header__toggle--active");
    mainNav.classList.toggle("header__nav--open", isOpen);
    backdrop.classList.toggle("header__backdrop--visible", isOpen);
    
    // Cập nhật Accessibility & khóa cuộn trang
    menuToggle.setAttribute("aria-expanded", isOpen);
    document.body.style.overflow = isOpen ? "hidden" : "";
  };

  const toggleSubmenu = (btn) => {
    const isOpen = btn.classList.toggle("header__submenu-toggle--active");
    const submenu = btn.parentElement.querySelector(".header__submenu");
    submenu.classList.toggle("header__submenu--open", isOpen);
    btn.setAttribute("aria-expanded", isOpen);
  };

  const closeMenu = () => {
    menuToggle.classList.remove("header__toggle--active");
    mainNav.classList.remove("header__nav--open");
    backdrop.classList.remove("header__backdrop--visible");
    menuToggle.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";

    // Đóng luôn các submenu con trên Mobile
    submenuToggles.forEach((btn) => {
      btn.classList.remove("header__submenu-toggle--active");
      btn.setAttribute("aria-expanded", "false");
    });
    submenus.forEach((sub) => sub.classList.remove("header__submenu--open"));
  };

  menuToggle?.addEventListener("click", toggleMenu);
  backdrop?.addEventListener("click", closeMenu);

  // Xổ/thu submenu trên Mobile
  submenuToggles.forEach((btn) => btn.addEventListener("click", () => toggleSubmenu(btn)));

  // Tự động đóng menu khi bấm link
  closeableLinks.forEach((link) => link.addEventListener("click", closeMenu));

  // Đóng khi nhấn phím Escape
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && mainNav.classList.contains("header__nav--open")) {
      closeMenu();
    }
  });
});