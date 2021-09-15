const toggle_btn = document.querySelectorAll(".toggle");
const slide = document.querySelectorAll(".slide");
const main = document.querySelector("main");
const fig1 = document.querySelector(".fig-1");
const fig2 = document.querySelector(".fig-2");
const fig3 = document.querySelector(".fig-3");
const fig4 = document.querySelector(".fig-4");
toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
    fig2.classList.toggle("show");
    fig1.classList.toggle("show");
    fig3.classList.toggle("show");
    fig4.classList.toggle("show");
    // fig1.classList.toggle("show");
  });
});

slide.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("slide-mode");
  });
});