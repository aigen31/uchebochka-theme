function impressions(){
    const $ = window.jQuery;
    const products = document.querySelectorAll('.product-card');
    if(!products) return;
    const productsArrayList = [];
    let position = 1;
    products.forEach((product)=> {
        $(product).data('position', position);
        const name = $(product).find('.product-title').text();
        const id = $(product).find('.add-to-cart').data('id');
        let price = parseFloat($(product).find('.current-price').text());
        if(!price){
            price = 0;
        }
        const category = $(product).data('category');
        productsArrayList.push({
            id: id,
            name: name,
            price: price,
            category: category,
            list: "Search",
            postion: position,
        });
        position++;
    });
    window.dataLayer.push({
        ecommerce: {
            currencyCode: "RUB",
            impressions: productsArrayList
        }
    });

}
function add_click(){

    const $ = window.jQuery;
    const products = document.querySelectorAll('.product-card');
    if(!products) return;
  
    products.forEach((product)=> {
        product.addEventListener('click', function(){
            const name = $(product).find('.product-title').text();
            const id = $(product).find('.add-to-cart').data('id');
            const position = $(product).data('position');
            let price = parseFloat($(product).find('.current-price').text());
            if(!price){
                price = 0;
            }
            const category = $(product).data('category');
            const arr = {
            products: [ {
                id: id,
                name: name,
                price: price,
                category: category,
                list: "Search",
                position: position
            }]
            };
            window.dataLayer.push({
                ecommerce: {
                    currencyCode: "RUB",
                    click: arr
                }
            });
        })
    })
}

function show_article(){
    const $ = window.jQuery;
    const id = $('.right-market').data('id');
    const category = $('.right-market').data('category');
    const name = $('h1').text();
    let price = parseFloat($('.rigth-marker').find('.price').data('price'));
    if(!price){
        price = 0;
    }
    window.dataLayer.push({
        ecommerce: {
            currencyCode: "RUB",
            detail: {
                products: [
                    {
                        id: id,
                        name: name,
                        price: price,
                        category: category,
                        list: 'Результаты поиска',
                        position: 1
                    }
                ]
            }
        }
    });
}

function ym_add_to_cart(){
    const $ = window.jQuery;
    const products = document.querySelectorAll('.product-card');
    if(!products) return;
    products.forEach( product => {
        const button_buy =  product.querySelector('.material-payment');
        if(!button_buy) return;
        button_buy.addEventListener('click', function(e){
            e.preventDefault();
            const name = $(product).find('.product-title').text();
            const id = $(product).find('.add-to-cart').data('id');
            const position = $(product).data('position');
            let price = parseFloat($(product).find('.current-price').text());
            if(!price){
                price = 0;
            }
            const category = $(product).data('category');
            window.dataLayer.push({
                ecommerce: {
                    currencyCode: "RUB",
                    add: {
                        products: [
                            {
                                id: id,
                                name: name,
                                price: price,
                                category: category,
                                quantity: 1,
                                list: 'Выдача категории',
                                position: position
                            }
                        ]
                    }
                }
            });
         
        });
    });
}

function ym_remove_from_cart(){
    const $ = window.jQuery;
    const products = document.querySelectorAll('.cart-item');
    if(!products) return;
    products.forEach((product,index) => {
        const button_remove =  product.querySelector('.cart-item-remove');
        if(!button_remove) return;
        button_remove.addEventListener('click', function(e){
            e.preventDefault();
            const name = $(product).find('.cart-item-title').text();
            const id = $(button_remove).data('product-id');
            let price = parseFloat($(product).find('.cart-item-price').data('price'));
            if(!price){
                price = 0;
            }
            const category = $(product).data('category');
            window.dataLayer.push({
                ecommerce: {
                    currencyCode: "RUB",
                    remove: {
                        products: [
                            {
                                id: id,
                                name: name,
                                price: price,
                                category: category,
                                quantity: 1,
                                position: index
                            }
                        ]
                    }
                }
            });
         
        });
    });
    
}

export function ym_make_order(){
    const $ = window.jQuery;
    const products = document.querySelectorAll('.cart-item');
    if(!products) return;
    const productsArrayList = [];
    products.forEach((product,index) => {
        const button_remove =  product.querySelector('.cart-item-remove');
        const name = $(product).find('.cart-item-title').text();
        const id = $(button_remove).data('product-id');
        let price = parseFloat($(product).find('.cart-item-price').data('price'));
        if(!price){
            price = 0;
        }
        const category = $(product).data('category');
        productsArrayList.push({
            id: id,
            name: name,
            price: price,
            category: category,
            postion: index+1,
            quantity: 1
        });
    });
    window.dataLayer.push({
        ecommerce: {
            currencyCode: "RUB",
            purchase: {
                actionField: {
                    id : genRandomId(),
                },
                products:productsArrayList,
            }
        }
    });
}

function genRandomId(prefix = 'TRX', digits = 6) {
  const max = 10 ** digits;
  const num = Math.floor(Math.random() * max); 
  const padded = String(num).padStart(digits, '0'); 
  return `${prefix}${padded}`;
}

export function ym_ecommerce_init(){
    const catalog = document.querySelector('#catalog');
    const article = document.querySelector('.page-article');
    if(catalog){
        impressions();
        add_click();
        ym_add_to_cart();
    }

    if(article){
        show_article();
    }

    ym_remove_from_cart();

}