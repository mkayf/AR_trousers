// Swiper js scripting

const filename = window.location.pathname.split('/').pop();

if(filename == 'index.php' || filename == ''){

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
        breakpoints : {
          992 : {
            slidesPerView : 4,
            spaceBetween : 24
          },
          768 : {
            slidesPerView : 3
          },
          420 : {
            slidesPerView : 3,
            spaceBetween : 16
          },
          380 : {
            slidesPerView : 2,
          },
          0 : {
            slidesPerView : 2
          }
        },
        freeMode: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });

}


// Close header message button:

const msgCloseBtn = document.querySelector(".msg-close-btn");
const headerMsg = document.querySelector(".header-msg");

if(msgCloseBtn){
  msgCloseBtn.addEventListener('click', () => {
    headerMsg.setAttribute('style', 'display: none !important');
    console.log('close');
  })
}

