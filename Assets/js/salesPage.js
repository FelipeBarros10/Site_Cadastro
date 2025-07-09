const productElement = document.querySelectorAll(".product");
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

    const alreadyInCart = cart.find((item) => item.id === productInfos.id);

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


function updateCart(productId)
{
  if(cart.length !== 0){
    document.querySelector("#warningText").style.setProperty('display', 'none', 'important')

    const productInCart = cart.find((item) => item.id === productId); 
    const productDiv = document.getElementById(`cart-${productId}`);
    const productOriginalInfo = document.querySelector(`[data-id="${productInCart.id}"]`)
    const qtdInStock = productOriginalInfo.querySelector('#originalQuantity');

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
            <i onclick="deleteProductCart(${productInCart.id})" id="deleteProductCart" class="bi bi-x-lg"></i>
          </div>
        </div>
        `;
    } else {
      const qtdProductInCart = productDiv.querySelector('#productQtd')
      const priceOfProductInCart = productDiv.querySelector('#productPrice')
      
      qtdProductInCart.textContent = productInCart.quantidade
      priceOfProductInCart.textContent = (parseFloat(priceOfProductInCart.textContent) + parseFloat(productInCart.preco)).toFixed(2).replace('.', ',');
    }
       
    if(parseInt(qtdInStock.textContent) <= 6){
        qtdInStock.style.color = 'red'
    }

    if(parseInt(qtdInStock.textContent) === 1){
        productOriginalInfo.style.display = 'none'
    }

    qtdInStock.textContent = parseInt(qtdInStock.textContent) - 1
    sumItems.textContent = parseInt(sumItems.textContent) + 1
    subtotal.textContent = (parseFloat(subtotal.textContent) + parseFloat(productInCart.preco)).toFixed(2).replace('.', ',')
    total.textContent = parseFloat(subtotal.textContent).toFixed(2).replace('.', ',')

  }
}

function deleteProductCart(productCartId)
{
    const carItem = document.querySelector(`#cart-${productCartId}`)
    const productOriginalInfo = document.querySelector(`[data-id="${productCartId}"]`)
    const qtdProductInCart = carItem.querySelector('#productQtd')
    const priceOfProductInCart = carItem.querySelector('#productPrice')

    let findedProductInCart = cart.find((item) => parseInt(item.id) === productCartId)

    if(findedProductInCart.quantidade > 1){
      findedProductInCart.quantidade -= 1;
      qtdProductInCart.textContent = findedProductInCart.quantidade
    } else {
      carItem.remove();
      cart = cart.filter((item) => parseInt(item.id) !== productCartId);
      
      verifyIfCartIsEmpty();
    }

    handleQuantityInStock(productOriginalInfo);
    subtractingTotalsAndItemsInCart(priceOfProductInCart, productOriginalInfo);

}

function verifyIfCartIsEmpty()
{
  if(cartElement.children.length === 1){  
    document.querySelector("#warningText").style.setProperty('display', 'flex', 'important');
  }
}

function handleQuantityInStock(productOriginalInfo)
{
    const qtdInStock = productOriginalInfo.querySelector('#originalQuantity');

    if(parseInt(qtdInStock.textContent) === 5){
        qtdInStock.style.color = 'white'
    }
    
    if(parseInt(qtdInStock.textContent) === 0){
        productOriginalInfo.style.display = 'block'
    }

  qtdInStock.textContent = parseInt(qtdInStock.textContent) + 1
    
}

function subtractingTotalsAndItemsInCart(priceOfProductInCart, productOriginalInfo)
{
  if(priceOfProductInCart){
     priceOfProductInCart.textContent = (parseFloat(priceOfProductInCart.textContent) - parseFloat(productOriginalInfo.dataset.preco)).toFixed(2).replace('.', ',');
    subtotal.textContent = (parseFloat(subtotal.textContent) - parseFloat(productOriginalInfo.dataset.preco)).toFixed(2).replace('.', ',')
    sumItems.textContent = parseInt(sumItems.textContent) - 1
    total.textContent = parseFloat(subtotal.textContent).toFixed(2).replace('.', ',')
  }
}

async function sendSaledProductsToController()
{
  if(cart.length === 0){
    alertify.error('Carrinho vazio, insira ao menos um produto!')
    return
  }

  loadingContentWithoutForm();
  
  return await fetch("/controller/handleSalesPage.php", {
      method: "POST",
      body: JSON.stringify(cart)
    })
    .then(response => response.json())
    .then((data) => {
      setTimeout(() => {
         hideLoadingContentWithoutForm()
      }, 800);

      setTimeout(() => {
         location.reload()
      }, 900);

    })
  
}