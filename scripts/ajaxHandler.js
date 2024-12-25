const productsContainer = document.getElementById('all-products');
const loadMoreBtn = document.querySelector('.load-more');
const loadMoreText = document.querySelector('.load-more-text');
const spinner = document.querySelector('.spinner-border');
const moreProducts = document.getElementById('more-products');

// Filter and sort products:

let filterType;
let sortType;

// Check for the product category parameter in the URL and set the filterType accordingly for loadMoreProducts function:

if(window.location.search.includes('product-category=Polyester_cotton')){
    filterType = 'Polyester_cotton';
}

if(window.location.search.includes('product-category=Pure_cotton')){
    filterType = 'Pure_cotton';
}

const filterAndSortProducts = async (filter,sort) => {
    if(filter){
        filterType = filter;
    }
    if(sort){
        sortType = sort;
    }
    productsContainer.innerHTML = '<div class="spinner-border d-block spinner-border products-spinner" role="status"><span class="visually-hidden">Loading...</span></div>';
    loadMoreBtn.style.display = 'none';
    moreProducts.style.display = 'none';
    
    try{
        const response = await fetch('./AJAX/filterAndSort.php', {
            method : 'POST',
            body : JSON.stringify({filterType, sortType}),
            headers : {
                'Content-Type' : 'application/json'
            }            
        });

        if(!response.ok){
            console.log('Response not okay.');
            return;
        } else{
            const data = await response.json();

            if(data.status !== 'failed'){
                if(data.status !== 'empty'){
                    productsContainer.innerHTML = data.products;
                    loadMoreBtn.style.display = 'block';
                } else{
                    productsContainer.innerHTML = data.msg;
                }
            } else{
                productsContainer.innerHTML = data.msg;
                throw new Error(data.msg);
            }

        }

    }
    catch(error){
        console.log(error)
    }

}



// Load more products from the server on click of load more button in the trousers.php page:

const loadMoreProducts = async () => {

    loadMoreBtn.setAttribute('disabled', true);
    loadMoreText.style.display = 'none';
    spinner.style.display = 'block';

    let offset = parseInt(document.getElementById('offset').value);

    limit = 24;
    offset = offset + limit;
    document.getElementById('offset').value = offset;

    try{
        const response = await fetch('./AJAX/LoadMoreProducts.php', {
            method : 'POST',
            body : JSON.stringify({offset, filterType, sortType}),
            headers : {
                'Content-Type' : 'application/json',
            }
        });
        if(!response.ok){
            console.log('Response not okay.');
            return;
        } else{
            const data = await response.json();

            if(data.status !== 'failed'){
                
                if(data.status !== 'empty'){
                    productsContainer.insertAdjacentHTML('beforeend', data.products);
                } else{
                    loadMoreBtn.style.display = 'none';
                    moreProducts.innerText = data.msg;
                    moreProducts.style.display = 'block';
                }


            } else{
                console.log(data.msg);
            }
            
        }
    }
    catch(error){
        console.log(error);
    }
    finally{
        loadMoreBtn.removeAttribute('disabled');        
        loadMoreText.style.display = 'block';
        spinner.style.display = 'none';
    }
    
    
}



