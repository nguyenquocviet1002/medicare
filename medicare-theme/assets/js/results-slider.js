/* Results Slider - Medicare Clinic */
document.addEventListener("DOMContentLoaded", () => {
  const track = document.querySelector(".results-slider__track");
  const slides = document.querySelectorAll(".results-slider__slide");
  const dots = document.querySelectorAll(".results-slider__dot");
  const prevBtn = document.querySelector(".results-slider__nav-btn--prev");
  const nextBtn = document.querySelector(".results-slider__nav-btn--next");

  if (!track || !slides.length) return;

  let currentSlide = 0;
  let startX = 0;
  let isDragging = false;

  const updateSlide = (index) => {
    currentSlide = (index + slides.length) % slides.length;
    track.style.transform = `translateX(-${currentSlide * 100}%)`;
    dots.forEach((dot, i) => {
      dot.classList.toggle("results-slider__dot--active", i === currentSlide);
    });
  };

  nextBtn?.addEventListener("click", () => updateSlide(currentSlide + 1));
  prevBtn?.addEventListener("click", () => updateSlide(currentSlide - 1));

  dots.forEach((dot, index) => {
    dot.addEventListener("click", () => updateSlide(index));
  });

  track.addEventListener(
    "touchstart",
    (e) => {
      startX = e.touches[0].clientX;
      isDragging = true;
    },
    { passive: true }
  );

  track.addEventListener("touchend", (e) => {
    if (!isDragging) return;
    const endX = e.changedTouches[0].clientX;
    const diff = startX - endX;
    if (Math.abs(diff) > 40) {
      if (diff > 0) updateSlide(currentSlide + 1);
      else updateSlide(currentSlide - 1);
    }
    isDragging = false;
  });
});
