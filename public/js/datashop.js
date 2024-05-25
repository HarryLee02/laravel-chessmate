let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

openShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})
closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})

let products = [
    {
        id: 1,
        name: 'PRODUCT NAME 1',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 2,
        name: 'PRODUCT NAME 2',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 3,
        name: 'PRODUCT NAME 3',
        image: 'https://picsum.photos/100',
        price: 220000
    },
    {
        id: 4,
        name: 'PRODUCT NAME 4',
        image: 'https://picsum.photos/100',
        price: 123000
    },
    {
        id: 5,
        name: 'PRODUCT NAME 5',
        image: 'https://picsum.photos/100',
        price: 320000
    },
    {
        id: 6,
        name: 'PRODUCT NAME 6',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 7,
        name: 'PRODUCT NAME 7',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 8,
        name: 'PRODUCT NAME 8',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 9,
        name: 'PRODUCT NAME 9',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 7,
        name: 'PRODUCT NAME 7',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 8,
        name: 'PRODUCT NAME 8',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 9,
        name: 'PRODUCT NAME 9',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 7,
        name: 'PRODUCT NAME 7',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 8,
        name: 'PRODUCT NAME 8',
        image: 'https://picsum.photos/100',
        price: 120000
    },
    {
        id: 9,
        name: 'PRODUCT NAME 9',
        image: 'https://picsum.photos/100',
        price: 120000
    },
];
let listCards = {};

function initApp() {
    products.forEach((value, key) => {
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="${value.image}">
            <div class="title">${value.name}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCard(${key})">Add To Card</button>`;
        list.appendChild(newDiv);
    });
}
initApp();

function addToCard(key) {
    if (listCards[key] == null) {
        // copy product from list to list card
        listCards[key] = JSON.parse(JSON.stringify(products[key]));
        listCards[key].quantity = 1;
        listCards[key].price = value.price * value.quantity; // update the price property
    }
    reloadCard();
}

function reloadCard() {
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    Object.values(listCards).forEach((value, key) => {
        totalPrice += value.price;
        count += value.quantity;
        let newDiv = document.createElement('li');
        newDiv.innerHTML = `
            <div><img src="${value.image}"/></div>
            <div>${value.name}</div>
            <div>${value.price.toLocaleString()}</div>
            <div>
                <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                <div class="count">${value.quantity}</div>
                <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
            </div>`;
        listCard.appendChild(newDiv);
    });
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}

function changeQuantity(key, quantity) {
    if (quantity === 0) {
        delete listCards[key];
    } else {
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();
}