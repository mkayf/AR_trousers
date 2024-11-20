// Swiper js scripting

const progressCircle = document.querySelector(".autoplay-progress svg");
    const progressContent = document.querySelector(".autoplay-progress span");
    var swiper = new Swiper(".mySwiper", {
        effect : 'fade',
        fadeEffect: {
            crossFade: true
          },
      centeredSlides: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
      on: {
        autoplayTimeLeft(s, time, progress) {
          progressCircle.style.setProperty("--progress", 1 - progress);
          progressContent.textContent = `${Math.ceil(time / 1000)}s`;
        }
      }
    });


    // Poly cotton product swiper:

    var polySwiper = new Swiper(".polyswiper", {
      slidesPerView: 4,
      spaceBetween: 24, 
      freeMode: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });