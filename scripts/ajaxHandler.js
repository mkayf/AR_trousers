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
  if(window.location.pathname.includes('trousers.php')){
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
  }
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
  let offset = document.getElementById("offset")
  if(offset) offset.value = 0;

  if(productsContainer){
    productsContainer.innerHTML =
      '<div class="spinner-border d-block spinner-border products-spinner" role="status"><span class="visually-hidden">Loading...</span></div>';
    loadMoreBtn.style.display = "none";
    moreProducts.style.display = "none";
  }

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


// Set selected size letter in the product details page:

let sizeBtns = document.getElementsByName("size");
let selectedSize = document.getElementsByClassName("selected-size")[0];

// Default value:
if (selectedSize && sizeBtns[0]) {

  sizeBtns[0].setAttribute("checked", true);

  selectedSize.innerHTML = `Size: <span class="fw-normal">${
    document.querySelector('input[name="size"]:checked').value
  }</span>`;

}

// Set selected color in the product details page:

let colorBtns = document.getElementsByName("color");
let selectedColor = document.getElementsByClassName("selected-color")[0];

// Default value:
if (selectedColor) {

  selectedColor.innerHTML = `Color: <span class="fw-normal">${document.querySelector('input[name="color"]:checked').value}</span>`;

}


const header = document.querySelector('header');
const msgCloseBtn = document.querySelector(".msg-close-btn");
const headerMsg = document.querySelector(".header-msg");


// Fetch sizes, color and stock quantity for each size and color:
let productID = new URLSearchParams(window.location.search).get("id") ?? 1;
let sizeBtnsContainer = document.querySelector('.size-btns-container');
let colorsDiv = document.querySelector('.colors-div');
let qtyInput = document.querySelector('#qty');
let addToCartBtn = document.querySelector('.add-to-cart-btn');

// retryCounter and maxEntries to put a cap on recursion to avoid performance issues and infinite looping:

let retryCounter = 0;
let maxEntries = 3;

const fetchStockDetails = async () => {
 
  let sizeInput = document.querySelector("input[name=size]:checked");
  let size = sizeInput ? sizeInput.value : 'S';
  let colorInput = document.querySelector('input[name="color"]:checked');
  let color = colorInput ? colorInput.value.toLowerCase() : 'black';

  if(!size || !color){
    return;
  }

  // set value of size in the selected size element:

  selectedSize.innerHTML = `Size: <span class="fw-normal ">${size}</span>`;

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

            data.sizes.forEach((size, index) => {
              sizeBtnsContainer.insertAdjacentHTML('beforeend', `
                <label class="radio">
                    <input type="radio" name="size"
                    value="${size}" ${size == data.stock.for || index == 0 ? 'checked' : ''}>
                    <span class="name">${size}</span>
                </label>
                `);  
            })

            // When no stock found for the given color and selected size, applying checked to the very first size then calling this function again to fetch stock for the first size.

            if(data.stock.qty == '0' && retryCounter < maxEntries){
              retryCounter++;
              fetchStockDetails();
              return;
            }
            else if(data.stock.qty == '0' && retryCounter >= maxEntries){
              sizeBtnsContainer.innerHTML = "<span>Selected size is out of stock. Please choose another option.</span>";
            }

            // Reset the retryCounter when stock is available.
            retryCounter = 0;

            qtyInput.value = 1;
            qtyInput.setAttribute('max', data.stock.qty);

            if(addToCartBtn.disabled){
              isQtyDisabled = false;
              qtyInput.removeAttribute('disabled');
              addToCartBtn.removeAttribute('disabled');
              addToCartBtn.style.cursor = 'pointer';
              addToCartBtn.style.backgroundColor = 'var(--primary-color)';
            }

        } else{
            sizeBtnsContainer.innerHTML = "<span>Out of stock.</span>";
            selectedSize.innerHTML = '';
            isQtyDisabled = true;
            qtyInput.setAttribute('disabled', true);
            qtyInput.value = 0;
            addToCartBtn.setAttribute('disabled', true);
            addToCartBtn.style.cursor = 'no-drop';
            addToCartBtn.style.backgroundColor = '#5d3324';
        }

    } else{ 
        console.log(data.msg);
    }

    
  } catch (error) {
    console.log(error);
  }

};

// Call this function to fetch stock details when these buttons change.

if(sizeBtnsContainer && colorsDiv){
  sizeBtnsContainer.addEventListener('change', fetchStockDetails);
  colorsDiv.addEventListener('change', fetchStockDetails);
}


// Add to cart functionality:

const addProductToCart = async () => {
  addToCartBtn.innerHTML = `
    <div class="spinner-border spinner-border-sm" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  `;
  addToCartBtn.setAttribute('disabled', true);
  addToCartBtn.style.backgroundColor = '#5d3324';
  let productName = document.querySelector('.product-name').innerHTML;
  let size = selectedSize.querySelector('span').textContent;
  let color = selectedColor.querySelector('span').textContent.toLowerCase();
  let qty = qtyInput.value;

  try{
      let response = await fetch('../AJAX/addToCart.php', {
        method : 'POST',
        body : JSON.stringify({productID, size, color, qty}),
        headers : {
          'Content-type' : 'application/json'
        },
      });
      
      if (!response.ok) {
        console.log("Response not okay");
        return;
      }

      let data = await response.json();
    
      if(data.status !== 'failed'){

        getCartCount();

        window.scrollTo({
          top : 0,
          behavior : 'smooth'
        })
        if(!header.querySelector('.header-msg')){
          header.insertAdjacentHTML('beforeend', `
            <div class="header-msg d-flex align-items-center justify-content-between">
              <span>'${productName}' is in your cart now!</span>
              <span class="msg-close-btn"><i class="bi bi-x-lg"></i></span>
          </div>
            `);
        }
      }
      else{
        console.log(data.msg);
      }
  }
  catch(error){
    console.log(error);
  }
  finally{
    addToCartBtn.innerHTML = 'Add To Cart';
    addToCartBtn.removeAttribute('disabled');
    addToCartBtn.style.backgroundColor = 'var(--primary-color)';
  }

}

if(addToCartBtn){
  addToCartBtn.addEventListener('click', addProductToCart);
}


// Get cart count dynamically and giving URL parameter to use this function in other pages too:

async function getCartCount($url = '../ajax/cartCount.php?cart_count=true'){
  let countBadge = document.querySelector('.count-badge');
  try{
    let response = await fetch($url)
    if (!response.ok) {
      console.log("Response not okay");
      return;
    }
    let data = await response.json();

    if(data.status == 'success'){
      data.cart_count !== null ? countBadge.textContent = data.cart_count : countBadge.textContent = 0;
    }

  }
  catch(e){
    console.log(e.message);
  }
  
}

// Close header message button:

if (header) {
  header.addEventListener("click", (event) => {
    if (event.target.closest(".msg-close-btn")) {
        event.target.closest('.header-msg').remove();
    }
  });
}


// Delete cart item:

const deleteCartItemBtn = document.querySelectorAll('.delete-cart-item');

deleteCartItemBtn.forEach(deleteBtn => {
  deleteBtn.addEventListener('click', async (event) => {
    let cartID = event.currentTarget.getAttribute('data-cart-id');
    let tableRow = document.querySelectorAll('.table-row');
    let tableBody = document.querySelector('.cart-table-body');
    
    tableBody.style.opacity = "0.5";


      try{
        let response = await fetch('./ajax/deleteCartItem.php', {
          method : 'POST',
          body : JSON.stringify({cartID}),
          headers : {
            'Content-type' : 'application/json'
          }
        });
  
        if(!response.ok){
          console.log('Response not okay.'); 
          return;
        }
  
        let data = await response.json();
  
        if(data.status == 'success'){
  
          tableBody.style.opacity = "1";
  
          tableRow.forEach(row => {
            if(row.getAttribute('data-row-cart-id') == cartID){
              // Remove the cart item from the UI
              row.remove();
            }  
          })

          // Get the updated cart count:
          getCartCount('./ajax/cartCount.php?cart_count=true');
          

  
        } else{
          console.log(data.msg);        
        }
  
      }
      catch(e){
        console.log(e);
      }
      finally{
        tableBody.style.opacity = "1";
      }
    
    
  })
})



