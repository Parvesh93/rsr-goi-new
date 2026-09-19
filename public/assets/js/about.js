document.addEventListener("DOMContentLoaded", function () {
  // Set initial active content based on URL hash
  const hash = window.location.hash || "#about-institution";
  const initialContent =
    document.querySelector(hash) ||
    document.querySelector(".about-tab-content");
  if (initialContent) {
    initialContent.classList.add("active");
    // Set initial tab active state
    const initialTab = document.querySelector(`a[href="${hash}"]`);
    if (initialTab) {
      initialTab.parentElement.classList.add("active");
    }
  }

  

  // Handle desktop tab clicks
  const tabLinks = document.querySelectorAll(".about-tab-link");
  tabLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      // Remove active class from all tabs and content
      document.querySelectorAll(".about-tab-item").forEach((tab) => {
        tab.classList.remove("active");
      });
      // document.querySelectorAll(".about-tab-content").forEach((content) => {
      //   content.classList.remove("active");
      // });


      
      // Add active class to clicked tab
      this.parentElement.classList.add("active");

      // Show corresponding content
      const contentId = this.getAttribute("href").substring(1);
      document.getElementById(contentId).classList.add("active");
      // Update URL without page reload
      history.pushState(null, null, `#${contentId}`);
    });
  });

  // Handle mobile selector change
  const mobileSelector = document.querySelector(".about-tabs-mobile");

  if (mobileSelector) {
    mobileSelector.addEventListener("change", function () {
      // Show corresponding content
      // document.querySelectorAll(".about-tab-content").forEach((content) => {
      //   content.classList.remove("active");
      // });
      document.getElementById(this.value).classList.add("active");
      // Update URL without page reload
      history.pushState(null, null, `#${this.value}`);
    });
  }

  // Handle browser back/forward buttons
  window.addEventListener("popstate", function () {
    const hash = window.location.hash || "#about-institution";
    const content = document.querySelector(hash);
    if (content) {
      // Remove all active classes
      document.querySelectorAll(".about-tab-item").forEach((tab) => {
        tab.classList.remove("active");
      });
      document.querySelectorAll(".about-tab-content").forEach((content) => {
        content.classList.remove("active");
      });

      // Activate current content and tab
      content.classList.add("active");
      const currentTab = document.querySelector(`a[href="${hash}"]`);
      if (currentTab) {
        currentTab.parentElement.classList.add("active");
      }

      // Update mobile selector if needed
      if (mobileSelector) {
        mobileSelector.value = hash.substring(1);
      }
    }
  });
});
