const productElement = document.querySelectorAll(".product");
const warningEmptyCart = document.getElementById("warningTetxt");
const cartElement = document.querySelector(".products-cart");

let cart = [];

productElement.forEach((productItem) => 
  {
  productItem.addEventListener("click", () => 
    {
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


function updateCart(productId)
{
  if(cart.length !== 0){
    warningEmptyCart.style.display = 'none'
  }
  
  const productInCart  = cart.find((item) => item.id === productId) //Retorna todo o objeto do produto {nome,preço, qtd}
  const productInCartHtmlElement = document.getElementById(`cart-${productInCart.id}`)
  
  if(!productInCartHtmlElement){
    cartElement.innerHTML += `
      <div class='cart-item' id='cart-${productInCart.id}'>
        <span class='productQtd'>${productInCart.quantidade}</span>
        <span class='productNome'>${productInCart.nome}</span>
      </div>
      `   
  } else { 
    //Ta pegando o primeiro elemento com classe productID e não o elemento referente ao ID(produto clicado)
    const spanQtd = productInCartHtmlElement.querySelector('.productQtd')
    spanQtd.textContent = productInCart.quantidade
   
  }
}
