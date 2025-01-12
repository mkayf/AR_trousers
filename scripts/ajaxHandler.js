const productsContainer = document.getElementById("all-products");
const loadMoreBtn = document.querySelector(".load-more");
const loadMoreText = document.querySelector(".load-more-text");
const spinner = document.querySelector(".spinner-border");
const moreProducts = document.getElementById("more-products");

// Filter and sort products:

let filterType;
let sortType;

// Check for the product category parameter in the URL and set the filterType accordingly for loadMoreProducts function:

if (window.location.search.includes("product-category=Polyester_cotton")) {
  filterType = "Polyester_cotton";
}

// Checking if user is coming back from product details page, if true then changing filter and sort variables accordingly:

window.onload = () => {
  if (sessionStorage.getItem("cameFromProductDetails")) {
    let storedFilter = sessionStorage.getItem("filter");
    let storedSort = sessionStorage.getItem("sort");

    if (storedFilter || storedSort) {
      if (storedFilter !== "reset-filters" && storedSort !== "reset-sort") {
        filterAndSortProducts(storedFilter, storedSort);
      } else {
        sessionStorage.removeItem("filter");
        sessionStorage.removeItem("sort");
      }
    }
  }
  // clear the flag to prevent from applying conditions while navigating to other pages:
  sessionStorage.removeItem("cameFromProductDetails");
};

const filterAndSortProducts = async (filter, sort) => {
  // preserving filter and sort state in the session storage to apply these conditions when user come back from product details page:

  if (filter) {
    filterType = filter;
    sessionStorage.setItem("filter", filter);
  }

  if (sort) {
    sortType = sort;
    sessionStorage.setItem("sort", sort);
  }

  // Resetting the value of offset after filter and sort to start fetching products from new base value:
  document.getElementById("offset").value = 0;

  productsContainer.innerHTML =
    '<div class="spinner-border d-block spinner-border products-spinner" role="status"><span class="visually-hidden">Loading...</span></div>';
  loadMoreBtn.style.display = "none";
  moreProducts.style.display = "none";

  try {
    const response = await fetch("../AJAX/filterAndSort.php", {
      method: "POST",
      body: JSON.stringify({ filterType, sortType }),
      headers: {
        "Content-Type": "application/json",
      },
    });

    if (!response.ok) {
      console.log("Response not okay.");
      return;
    } else {
      const data = await response.json();

      if (data.status !== "failed") {
        if (data.status !== "empty") {
          productsContainer.innerHTML = data.products;
          loadMoreBtn.style.display = "block";
        } else {
          productsContainer.innerHTML = data.msg;
        }
      } else {
        productsContainer.innerHTML = data.msg;
        throw new Error(data.msg);
      }
    }
  } catch (error) {
    console.log(error);
  }
};

// Load more products from the server on click of load more button in the trousers.php page:

const loadMoreProducts = async () => {
  loadMoreBtn.setAttribute("disabled", true);
  loadMoreText.style.display = "none";
  spinner.style.display = "block";

  let offset = parseInt(document.getElementById("offset").value);

  limit = 24;
  offset = offset + limit;
  document.getElementById("offset").value = offset;

  try {
    const response = await fetch("../AJAX/LoadMoreProducts.php", {
      method: "POST",
      body: JSON.stringify({ offset, filterType, sortType }),
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      console.log("Response not okay.");
      return;
    } else {
      const data = await response.json();

      if (data.status !== "failed") {
        if (data.status !== "empty") {
          productsContainer.insertAdjacentHTML("beforeend", data.products);
        } else {
          loadMoreBtn.style.display = "none";
          moreProducts.innerText = data.msg;
          moreProducts.style.display = "block";
        }
      } else {
        console.log(data.msg);
      }
    }
  } catch (error) {
    console.log(error);
  } finally {
    loadMoreBtn.removeAttribute("disabled");
    loadMoreText.style.display = "block";
    spinner.style.display = "none";
  }
};

// Fetch sizes, color and stock quantity for each size and color:

let sizeBtnsContainer = document.querySelector('.size-btns-container');
let qtyInput = document.querySelector('#qty');


const fetchStockDetails = async (event) => {
 
  let size = document.querySelector("input[name=size]:checked").value;
  let color = document
    .querySelector('input[name="color"]:checked')
    .value.toLowerCase();
  let productID = new URLSearchParams(window.location.search).get("id") ?? 1;

  // set value of size in the selected size element:
  selectedSize.innerHTML = `Size: <span class="fw-normal">${size}</span>`;

 // set value of color in the selected color element:

  selectedColor.innerHTML = `Color: <span class="fw-normal">${color}</span>`;

  try {
    const response = await fetch("../AJAX/fetchStockDetails.php", {
      method: "POST",
      body: JSON.stringify({ size, color, productID }),
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      console.log("Response not okay");
      return;
    }
    const data = await response.json();

    if(data.status !== 'failed'){
    
        if(data.sizes.length > 0){

            sizeBtnsContainer.innerHTML = '';

            data.sizes.forEach(size => {
              sizeBtnsContainer.insertAdjacentHTML('beforeend', `
                <label class="radio">
                    <input type="radio" name="size"
                    ${size == data.for ? 'checked' : ''}
                    value="${size}">
                    <span class="name">${size}</span>
                </label>
                `);  
            })

            qtyInput.setAttribute('max', data.stock.qty);

        } else{
            sizeBtnsContainer.innerHTML = "<span>Out of stock.</span>";
        }

    } else{
        console.log(data.msg);
    }

  } catch (error) {
    console.log(error);
  }

};

sizeBtns.forEach((btn) => {
  btn.addEventListener("click", fetchStockDetails);
});

colorBtns.forEach((btn) => {
  btn.addEventListener("click", fetchStockDetails);
});
