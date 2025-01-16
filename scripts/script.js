// Swiper js scripting

const filename = window.location.pathname.split("/").pop();

if (filename == "index.php" || filename == "") {
  const progressCircle = document.querySelector(".autoplay-progress svg");
  const progressContent = document.querySelector(".autoplay-progress span");
  var swiper = new Swiper(".mySwiper", {
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    centeredSlides: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    on: {
      autoplayTimeLeft(s, time, progress) {
        progressCircle.style.setProperty("--progress", 1 - progress);
        progressContent.textContent = `${Math.ceil(time / 1000)}s`;
      },
    },
  });

  // Poly cotton product swiper:

  var polySwiper = new Swiper(".polyswiper", {
    slidesPerView: 4,
    spaceBetween: 24,
    breakpoints: {
      992: {
        slidesPerView: 4,
        spaceBetween: 24,
      },
      768: {
        slidesPerView: 3,
      },
      420: {
        slidesPerView: 3,
        spaceBetween: 16,
      },
      380: {
        slidesPerView: 2,
      },
      0: {
        slidesPerView: 2,
      },
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

if (msgCloseBtn) {
  msgCloseBtn.addEventListener("click", () => {
    headerMsg.setAttribute("style", "display: none !important");
    console.log("close");
  });
}

// Setting a flag to preserve filtering and sorting conditions:

if (window.location.pathname.includes("product.php")) {
  sessionStorage.setItem("cameFromProductDetails", true);
}



// Change images of product displaying in product details page and apply border on clicking:

let productImgs = document.getElementsByClassName("product-img");
let mainImg = document.getElementById("main-img");

if (productImgs) {
  Array.from(productImgs).forEach((img) => {
    img.addEventListener("click", (event) => {
      mainImg.src = event.currentTarget.querySelector("img").src;

      let currentlyActiveImg = document.querySelector(".product-img.active");

      if (currentlyActiveImg) {
        currentlyActiveImg.classList.remove("active");
      }

      event.currentTarget.classList.add("active");
    });
  });
}

// Change quantity:

var input = document.querySelector("#qty");
var btnminus = document.querySelector(".qtyminus");
var btnplus = document.querySelector(".qtyplus");

if (
  input !== undefined &&
  btnminus !== undefined &&
  btnplus !== undefined &&
  input !== null &&
  btnminus !== null &&
  btnplus !== null
) {
  var min = Number(input.getAttribute("min"));
  var max = Number(input.getAttribute("max"));
  var step = Number(input.getAttribute("step"));

  function qtyminus(e) {
    var current = Number(input.value);
    var newval = current - step;
    if (newval < min) {
      newval = min;
    } else if (newval > max) {
      newval = max;
    }
    input.value = Number(newval);
    e.preventDefault();
  }

  function qtyplus(e) {
    var current = Number(input.value);
    var newval = current + step;
    if (newval > max) newval = max;
    input.value = Number(newval);
    e.preventDefault();
  }

  btnminus.addEventListener("click", qtyminus);
  btnplus.addEventListener("click", qtyplus);
}
