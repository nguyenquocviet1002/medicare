/* Tabs (Buổi Lẻ / Liệu Trình / CFU / Combo / Sản Phẩm pages) - Medicare Clinic */
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("[data-tabs]").forEach((tabsContainer) => {
    const tabButtons = tabsContainer.querySelectorAll("[data-tab-target]");
    const panes = tabsContainer.querySelectorAll("[data-tab-pane]");

    if (!tabButtons.length) return;

    const activate = (id) => {
      tabButtons.forEach((btn) => {
        const active = btn.getAttribute("data-tab-target") === id;
        btn.classList.toggle("is-active", active);
        btn.setAttribute("aria-selected", active ? "true" : "false");
      });
      panes.forEach((pane) => {
        const active = pane.getAttribute("data-tab-pane") === id;
        pane.classList.toggle("is-active", active);
        if (active) pane.hidden = false;
        else pane.hidden = true;
      });
    };

    tabButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        activate(btn.getAttribute("data-tab-target"));
      });
    });

    // Activate first tab by default
    const first = tabButtons[0]?.getAttribute("data-tab-target");
    if (first) activate(first);
  });
});

/* Hash-based tab switching for anchor links (e.g. #meso, #bap, #laser) */
document.addEventListener("DOMContentLoaded", () => {
  const onHashChange = () => {
    const hash = window.location.hash.replace("#", "");
    if (!hash) return;
    const pane = document.querySelector(`[data-tab-pane="${hash}"]`);
    const btn = document.querySelector(`[data-tab-target="${hash}"]`);
    if (pane && btn) btn.click();
  };
  window.addEventListener("hashchange", onHashChange);
  onHashChange();
});
