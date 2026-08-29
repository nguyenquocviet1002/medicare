document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.getElementById("menu-toggle");
  const mainNav = document.getElementById("main-nav");
  const backdrop = document.getElementById("header-backdrop");
  const menuLinks = document.querySelectorAll(".header__menu-link");

  const toggleMenu = () => {
    const isOpen = menuToggle.classList.toggle("header__toggle--active");
    mainNav.classList.toggle("header__nav--open", isOpen);
    backdrop.classList.toggle("header__backdrop--visible", isOpen);
    
    // Cập nhật Accessibility & khóa cuộn trang
    menuToggle.setAttribute("aria-expanded", isOpen);
    document.body.style.overflow = isOpen ? "hidden" : "";
  };

  const closeMenu = () => {
    menuToggle.classList.remove("header__toggle--active");
    mainNav.classList.remove("header__nav--open");
    backdrop.classList.remove("header__backdrop--visible");
    menuToggle.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";
  };

  menuToggle?.addEventListener("click", toggleMenu);
  backdrop?.addEventListener("click", closeMenu);

  // Tự động đóng menu khi bấm link
  menuLinks.forEach((link) => link.addEventListener("click", closeMenu));

  // Đóng khi nhấn phím Escape
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && mainNav.classList.contains("header__nav--open")) {
      closeMenu();
    }
  });
});