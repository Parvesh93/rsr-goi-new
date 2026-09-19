// Select all slides and navigation dots
const slides = document.querySelectorAll(".slide");
const navDots = document.querySelectorAll(".navigation span");
const leftArrow = document.querySelector(".left-arrow");
const rightArrow = document.querySelector(".right-arrow");

let currentIndex = 0;
const intervalTime = 5000;

// Function to update slides
const updateSlide = (index) => {
  document.querySelector(".slide.active").classList.remove("active");
  slides[index].classList.add("active");

  document.querySelector(".navigation span.active").classList.remove("active");
  navDots[index].classList.add("active");
};

// Autoplay functionality
const autoplay = () => {
  currentIndex = (currentIndex + 1) % slides.length;
  updateSlide(currentIndex);
};

let autoplayInterval = setInterval(autoplay, intervalTime);

// Pause autoplay on hover
const heroSlider = document.querySelector(".hero-slider");
heroSlider.addEventListener("mouseenter", () =>
  clearInterval(autoplayInterval)
);
heroSlider.addEventListener(
  "mouseleave",
  () => (autoplayInterval = setInterval(autoplay, intervalTime))
);

// Manual navigation with dots
navDots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    currentIndex = index;
    updateSlide(index);
  });
});

// Left Arrow Navigation
leftArrow.addEventListener("click", () => {
  currentIndex = (currentIndex - 1 + slides.length) % slides.length;
  updateSlide(currentIndex);
  animateSlideContent(currentIndex);
});

// Right Arrow Navigation
rightArrow.addEventListener("click", () => {
  currentIndex = (currentIndex + 1) % slides.length;
  updateSlide(currentIndex);
  animateSlideContent(currentIndex);
});

// Fix submenu overflowing out of the window
document.querySelectorAll(".dropdown-submenu").forEach((submenu) => {
  submenu.addEventListener("mouseenter", function () {
    const submenuMenu = submenu.querySelector(".dropdown-menu");
    const rect = submenuMenu.getBoundingClientRect();

    // If submenu overflows the window, reposition it
    if (rect.right > window.innerWidth) {
      submenuMenu.style.left = "auto";
      submenuMenu.style.right = "100%";
    }
  });
});

// JavaScript for Modal Image Change
const galleryImgs = document.querySelectorAll(".gallery-img");
const modalImg = document.getElementById("modalImage");

galleryImgs.forEach((img) => {
  img.addEventListener("click", (e) => {
    modalImg.src = e.target.src;
    modalImg.alt = e.target.alt;
  });
});

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove("active");
    if (i === index) {
      slide.classList.add("active");
      const slideContent = slide.querySelector(".slide-content");
      const slideTitle = slideContent.querySelector("h1");
      const slideText = slideContent.querySelector("p");

      slideTitle.style.opacity = 0;
      slideText.style.opacity = 0;

      setTimeout(() => {
        slideTitle.style.opacity = 1;
        slideText.style.opacity = 1;
      }, 50);
    }
  });
}

function animateSlideContent(index) {
  const slide = slides[index];
  const slideContent = slide.querySelector(".slide-content");
  const slideTitle = slideContent.querySelector("h1");
  const slideText = slideContent.querySelector("p");

  slideTitle.style.opacity = 0;
  slideText.style.opacity = 0;

  setTimeout(() => {
    slideTitle.style.opacity = 1;
    slideText.style.opacity = 1;
  }, 50);
}

// WHATSAPP BUTTON
function openWhatsApp(event) {
  const phoneNumber = "+918292868654";
  const whatsappUrl = `https://wa.me/${phoneNumber}`;
  window.open(whatsappUrl, "_blank");

  // Ripple Effect
  const button = event.currentTarget;
  const ripple = button.querySelector(".ripple");
  const rect = button.getBoundingClientRect();

  ripple.style.left = `${event.clientX - rect.left}px`;
  ripple.style.top = `${event.clientY - rect.top}px`;

  ripple.style.transform = "scale(1)";
  ripple.style.opacity = "0.5";

  setTimeout(() => {
    ripple.style.transform = "scale(0)";
    ripple.style.opacity = "0";
  }, 500);
}

// Handle all mobile selectors
document.addEventListener("DOMContentLoaded", function () {
  const mobileSelectors = [
    ".about-tabs-mobile",
    ".contact-tabs-mobile",
    ".academic-tabs-mobile",
    ".admission-tabs-mobile",
    ".campus-tabs-mobile",
    ".course-tabs-mobile",
    ".gallery-tabs-mobile",
    ".labs-tabs-mobile",
    ".placements-tabs-mobile",
  ];

  mobileSelectors.forEach((selector) => {
    const mobileSelector = document.querySelector(selector);
    if (mobileSelector) {
      mobileSelector.addEventListener("change", function (e) {
        const selectedTab = e.target.value;
        const prefix = selector.split("-")[0].replace(".", "");

        // Hide all content
        document
          .querySelectorAll(`.${prefix}-tab-content`)
          .forEach((content) => {
            content.classList.remove("active");
          });

        // Show selected content
        document.querySelector(`#${selectedTab}`).classList.add("active");
      });
    }
  });
});
