/* Compare sliders (auto-cycling before/after images) - Medicare Clinic */
document.addEventListener("DOMContentLoaded", () => {
  const tracks = document.querySelectorAll(".results-slider__compare-track");
  tracks.forEach((track) => {
    const imgs = track.querySelectorAll(".results-slider__compare-img");
    if (imgs.length < 2) return;
    let index = 0;
    setInterval(() => {
      imgs[index].classList.remove("results-slider__compare-img--active");
      index = (index + 1) % imgs.length;
      imgs[index].classList.add("results-slider__compare-img--active");
    }, 2000);
  });
});
