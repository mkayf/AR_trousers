const productsContainer = document.getElementById('all-products');
const loadMoreBtn = document.querySelector('.load-more');
const loadMoreText = document.querySelector('.load-more-text');
const spinner = document.querySelector('.spinner-border');
const moreProducts = document.getElementById('more-products');


// Filter and sort products:

let filterType;

const filterProducts = async (filter = '') => {
    filterType = filter;
    productsContainer.innerHTML = '<div class="spinner-border d-block spinner-border products-spinner" role="status"><span class="visually-hidden">Loading...</span></div>';
    loadMoreBtn.style.display = 'none';
    
    try{
        const response = await fetch('./AJAX/filterAndSort.php', {
            method : 'POST',
            body : JSON.stringify({filterType}),
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

// Sort products:

let sortType = 'all';

const sortProducts = async (sort = 'all') => {
    sortType = sort;
    productsContainer.innerHTML = '';    

    try{
        const response = await fetch('./AJAX/filterAndSort.php', {
            method : 'POST',
            body : JSON.stringify({sortType}),
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
                productsContainer.insertAdjacentHTML('beforeend', data.products);
            } else{
                console.log(data.msg);
            }

        }

    }
    catch(error){
        console.log(error)
    }
    finally{
        loadMoreBtn.style.display = 'block';
    }

}


// Load more products from the server on click of load more button in the trousers.php page:

const fetchProducts = async () => {

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
        loadMoreText.style.display = 'block';
        spinner.style.display = 'none';
    }
    
}



