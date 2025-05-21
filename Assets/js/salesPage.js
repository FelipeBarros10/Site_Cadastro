const productElement = document.querySelectorAll('.product');
const warningEmptyCart = document.getElementById('warningTetxt');
console.log(warningEmptyCart);

let cart  = []
console.log(cart.length);




productElement.forEach(productItem => {
  productItem.addEventListener('click', () => { 
    const productInfos = {
        nome:  productItem.dataset.nome,
        preco: productItem.dataset.preco,
        id: productItem.dataset.id

      }

      const alreadyInCart = cart.find((item) => item.id === productInfos.id) //Find executa função de callback para cada elemento no carrinho, até que seja true, se não achar nada retorna false;

      if(!alreadyInCart){
        cart.push({
          ...productInfos,
          quantity: 1
        })
        
      } else {
        alreadyInCart.quantity += 1
      }
    
      updateCart(cart);
  })

})



function updateCart (cart){
  if (cart.length !== 0){
    warningEmptyCart.style.display = 'none'
  }
  
  // cart.array.forEach(cartProduct => {
    
  // });
  
}
