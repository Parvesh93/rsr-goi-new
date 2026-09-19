// Initialize Swiper
var swiper = new Swiper('.blog-swiper', {
    slidesPerView: 1, // Show 3 slides at a time
    spaceBetween: 20, // Add space between slides
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });  


  /*Testimonial Section*/

  // Initialize Swiper
var swiper = new Swiper('.testimonials-carousel', {
    slidesPerView: 1, // Show 3 slides at a time
    spaceBetween: 20, // Space between slides
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      // Responsive settings
      640: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 15,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });

  //Reviews

  // Initialize Swiper
var swiper = new Swiper('.reviews-carousel', {
    slidesPerView: 2, // Show 3 reviews per slide
    spaceBetween: 20, // Space between slides
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 2, // Show 1 slide on small screens
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 3, // Show 2 slides on medium screens
        spaceBetween: 15,
      },
      1024: {
        slidesPerView: 4, // Show 3 slides on large screens
        spaceBetween: 20,
      },
    },
  });


  //Recruiter

  // Initialize Swiper
var swiper = new Swiper('.recruiters-carousel', {
    slidesPerView: 2, // Show 3 logos per slide
    spaceBetween: 20, // Space between slides
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 1, // Show 1 logo on small screens
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 2, // Show 2 logos on medium screens
        spaceBetween: 15,
      },
      1024: {
        slidesPerView: 4, // Show 3 logos on large screens
        spaceBetween: 20,
      },
    },
  });  
  
  