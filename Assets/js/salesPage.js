const productElement = document.querySelectorAll(".product");
const warningEmptyCart = document.querySelector("#warningTetxt");
const cartElement = document.querySelector(".products-cart");
const priceProduct = document.querySelectorAll('.price');
const sumItems = document.querySelector('#sumItems');
const subtotal = document.querySelector('#subtotal');
const total = document.querySelector('#total')

let cart = [];


priceProduct.forEach((price) => {
  price.textContent = price.textContent.replace('.', ',')
})


productElement.forEach((productItem) => {

  productItem.addEventListener("click", () => {
    const productInfos = {
      nome: productItem.dataset.nome,
      preco: productItem.dataset.preco,
      id: productItem.dataset.id,
    };

    const alreadyInCart = cart.find((item) => item.id === productInfos.id); //Find executa função de callback para cada elemento no carrinho, até que seja true, se não achar nada retorna false;

    if (!alreadyInCart) {
      cart.push({
        ...productInfos,
        quantidade: 1,
      });

    } else {
      alreadyInCart.quantidade += 1;
    }

    updateCart(productInfos.id);
  });
});

function updateCart(productId) {
  if (cart.length !== 0) {
    warningEmptyCart.style.display = "none";
  }

  const productInCart = cart.find((item) => item.id === productId); 
  const productDiv = document.getElementById(`cart-${productId}`);

  if (!productDiv) {
    cartElement.innerHTML += `
      <div class='cart-item' id='cart-${productInCart.id}'>
        <div class='quantity-and-name'>
          <div>
            <span id='productQtd'>${productInCart.quantidade}</span> 
          </div>

          <div>
            <span id='productName' class='productName'>${productInCart.nome}</span> 
          </div>
        </div>

        <div class='price-div'>
          <span class='productPrice'>R$ <span id='productPrice' > ${productInCart.preco.replace('.', ',')}</span></span>
          <i class="bi bi-x-lg"></i>
        </div>
      </div>
      `;
  } else {
    const qtdSpan = productDiv.querySelector('#productQtd')
    const priceSpan = productDiv.querySelector('#productPrice')
    
    qtdSpan.textContent = productInCart.quantidade
    priceSpan.textContent = (parseFloat(priceSpan.textContent) + parseFloat(productInCart.preco)).toFixed(2).replace('.', ',');
  }

  sumItems.textContent = parseInt(sumItems.textContent) + 1
  subtotal.textContent = (parseFloat(subtotal.textContent) + parseFloat(productInCart.preco)).toFixed(2).replace('.', ',')
  total.textContent = parseFloat(subtotal.textContent).toFixed(2).replace('.', ',')
  



  
 
}
