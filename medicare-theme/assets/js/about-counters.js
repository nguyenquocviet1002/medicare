/* About Counters - Medicare Clinic */
document.addEventListener("DOMContentLoaded", () => {
  const statsEl = document.querySelector(".about__stats");
  const numbers = document.querySelectorAll(".about__stat-number");

  if (!statsEl || !numbers.length) return;

  const formatNumber = (value) => value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

  const parseTarget = (el) => {
    const match = el.textContent.trim().match(/^([\d.,]+)(.*)$/);
    if (!match) return null;
    const target = parseInt(match[1].replace(/[.,]/g, ""), 10);
    return { target, suffix: match[2] };
  };

  const animate = () => {
    const duration = 1500;
    const startTime = performance.now();
    const data = Array.from(numbers)
      .map((el) => ({ el, ...parseTarget(el) }))
      .filter((d) => d.target != null);

    const tick = (now) => {
      const progress = Math.min((now - startTime) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      data.forEach(({ el, target, suffix }) => {
        el.textContent = formatNumber(Math.round(target * eased)) + suffix;
      });
      if (progress < 1) requestAnimationFrame(tick);
    };

    requestAnimationFrame(tick);
  };

  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    numbers.forEach((el) => {
      const { target, suffix } = parseTarget(el) || {};
      if (target != null) el.textContent = formatNumber(target) + suffix;
    });
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        animate();
        observer.disconnect();
      });
    },
    { threshold: 0.3 }
  );

  observer.observe(statsEl);
});
