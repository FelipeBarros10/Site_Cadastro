const productElement = document.getElementById('product');
let cart  = []

productElement.addEventListener('click', () => {
  const productInfos = {
      nome:  productElement.dataset.nome,
      preco: productElement.dataset.preco,
      id: productElement.dataset.id

    }

    const alreadyInCart = cart.find((item) => item.id === productInfos.id)

    if(!alreadyInCart){
      cart.push({
        ...productInfos,
        quantity: 1
      })
      
    } else {
      alreadyInCart.quantity += 1
    }
  
    updateCart();
})
