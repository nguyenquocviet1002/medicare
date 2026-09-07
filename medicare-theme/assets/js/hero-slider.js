/* Hero Slider - Medicare Clinic */
document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".hero-slider__slide");
  const dots = document.querySelectorAll(".hero-slider__dot");
  const track = document.querySelector(".hero-slider__track");
  const prevBtn = document.querySelector(".hero-slider__nav-btn--prev");
  const nextBtn = document.querySelector(".hero-slider__nav-btn--next");

  if (!slides.length || !track) return;

  let currentSlide = 0;
  let autoSlideTimer = null;

  const showSlide = (index) => {
    slides.forEach((slide, i) => {
      slide.classList.toggle("hero-slider__slide--active", i === index);
    });
    dots.forEach((dot, i) => {
      dot.classList.toggle("hero-slider__dot--active", i === index);
    });
    track.style.transform = `translateX(-${index * 100}%)`;
    currentSlide = index;
  };

  const nextSlide = () => showSlide((currentSlide + 1) % slides.length);
  const prevSlide = () => showSlide((currentSlide - 1 + slides.length) % slides.length);

  const startAutoSlide = () => (autoSlideTimer = setInterval(nextSlide, 5000));
  const resetAutoSlide = () => {
    clearInterval(autoSlideTimer);
    startAutoSlide();
  };

  nextBtn?.addEventListener("click", () => {
    nextSlide();
    resetAutoSlide();
  });

  prevBtn?.addEventListener("click", () => {
    prevSlide();
    resetAutoSlide();
  });

  dots.forEach((dot, index) => {
    dot.addEventListener("click", () => {
      showSlide(index);
      resetAutoSlide();
    });
  });

  startAutoSlide();
});
