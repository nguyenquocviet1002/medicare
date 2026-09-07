/* Services Slider (Center-mode, swipe, infinite loop) - Medicare Clinic */
document.addEventListener("DOMContentLoaded", () => {
  const viewport = document.querySelector(".services-slider__viewport");
  const track = document.getElementById("services-track");
  const pagination = document.getElementById("services-pagination");

  if (!viewport || !track) return;

  const realSlides = Array.from(track.querySelectorAll(".services-slider__slide"));
  const count = realSlides.length;
  if (!count) return;

  const fragBefore = document.createDocumentFragment();
  const fragAfter = document.createDocumentFragment();

  realSlides.forEach((slide) => {
    const c1 = slide.cloneNode(true);
    const c2 = slide.cloneNode(true);
    [c1, c2].forEach((clone) => {
      clone.classList.remove("services-slider__slide--active");
      clone.setAttribute("aria-hidden", "true");
    });
    fragBefore.appendChild(c1);
    fragAfter.appendChild(c2);
  });

  track.prepend(fragBefore);
  track.append(fragAfter);

  const allSlides = Array.from(track.children);
  const getRealIndex = (combined) => combined % count;

  let currentIndex = count + 2;
  let isDragging = false;
  let startX = 0;
  let autoSlideTimer = null;

  let dots = [];
  if (pagination) {
    pagination.innerHTML = "";
    for (let i = 0; i < count; i++) {
      const dot = document.createElement("button");
      dot.className = "services-slider__dot";
      dot.setAttribute("type", "button");
      dot.setAttribute("aria-label", `Chuyển tới slide ${i + 1}`);
      dot.addEventListener("click", () => {
        updateSlider(count + i);
        resetAutoSlide();
      });
      pagination.appendChild(dot);
    }
    dots = Array.from(pagination.querySelectorAll(".services-slider__dot"));
  }

  const setActive = () => {
    const real = getRealIndex(currentIndex);
    allSlides.forEach((slide, i) => {
      const isReal = i >= count && i < 2 * count;
      slide.classList.toggle("services-slider__slide--active", isReal && i - count === real);
    });
    dots.forEach((dot, i) => {
      dot.classList.toggle("services-slider__dot--active", i === real);
    });
  };

  const updateSlider = (index, animate = true) => {
    currentIndex = Math.max(count - 1, Math.min(index, 2 * count));
    setActive();

    const targetSlide = allSlides[currentIndex];
    const viewportWidth = viewport.offsetWidth;
    const slideOffset = targetSlide.offsetLeft;
    const slideWidth = targetSlide.offsetWidth;

    const currentTranslate = -(slideOffset - (viewportWidth / 2 - slideWidth / 2));

    if (!animate) {
      track.style.transition = "none";
      track.style.transform = `translateX(${currentTranslate}px)`;
      void track.offsetWidth;
      track.style.transition = "";
    } else {
      track.style.transform = `translateX(${currentTranslate}px)`;
    }
  };

  const snapWrap = () => {
    if (currentIndex >= 2 * count) {
      updateSlider(currentIndex - count, false);
    } else if (currentIndex < count) {
      updateSlider(currentIndex + count, false);
    }
  };

  track.addEventListener("transitionend", (e) => {
    if (e.target !== track) return;
    if (e.propertyName !== "transform") return;
    snapWrap();
  });

  const startAutoSlide = () => {
    clearInterval(autoSlideTimer);
    autoSlideTimer = setInterval(() => updateSlider(currentIndex + 1), 5000);
  };

  const resetAutoSlide = () => startAutoSlide();

  setTimeout(() => updateSlider(currentIndex, false), 60);
  window.addEventListener("resize", () => updateSlider(currentIndex, false));

  allSlides.forEach((slide, i) => {
    slide.addEventListener("click", () => {
      const real = getRealIndex(i);
      if (real !== getRealIndex(currentIndex)) {
        updateSlider(count + real);
      }
      resetAutoSlide();
    });
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
      if (diff > 0) updateSlider(currentIndex + 1);
      else if (diff < 0) updateSlider(currentIndex - 1);
      resetAutoSlide();
    }
    isDragging = false;
  });

  startAutoSlide();
});
