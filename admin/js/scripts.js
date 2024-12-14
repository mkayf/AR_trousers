
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // Insert product slug:

    const productName = document.getElementById('product-name');
    const productSlug = document.getElementById('product-slug');

    if(productName && productSlug){
        productName.addEventListener('input', (event) => {
            if(productName == '') return false;
            productSlug.value = event.target.value.split(" ").join('-');
        })
    }

    // Product discount calculation:

    const productPrice = document.getElementById('product-price');
    const productDiscountPercent = document.getElementById('product-discount-percent');
    const productDiscountedPrice = document.getElementById('product-discounted-price');

    if(productPrice && productDiscountPercent && productDiscountedPrice){
        productDiscountPercent.addEventListener('input', (event) => {
            productDiscountedPrice.value = productPrice.value - (productPrice.value * event.target.value / 100);   
        })
    }


});
