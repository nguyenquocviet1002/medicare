(function () {
  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (reduceMotion) return;

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var el = entry.target;
          var delay = el.getAttribute("data-aos-delay");
          if (delay) el.style.transitionDelay = delay + "ms";
          el.classList.add("aos-animate");
          observer.unobserve(el);
        }
      });
    },
    { threshold: 0.12 }
  );

  function observe() {
    document.querySelectorAll("[data-aos]:not(.aos-animate)").forEach(function (el) {
      observer.observe(el);
    });
  }

  window.scrollReveal = {
    init: observe,
    refresh: observe
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", observe);
  } else {
    observe();
  }
  window.addEventListener("load", observe);
})();
