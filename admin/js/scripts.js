
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

    // Preview image on upload in updateProduct.php file:

    const previewImg = (fileInput, imgPreview) => {
        const input = document.getElementById(fileInput);
        const img = document.getElementById(imgPreview);

        input.addEventListener('change', () => {
            const file = input.files[0];
            if(file){
                const reader = new FileReader();
                reader.onload = (e) => {
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        })
    }

    previewImg('img-1', 'preview-1');
    previewImg('img-2', 'preview-2');
    previewImg('img-3', 'preview-3');


});


// Year for the footer:

let date = new Date();
document.querySelector('.year').textContent = date.getFullYear();
