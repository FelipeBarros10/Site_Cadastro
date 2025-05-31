function stylingThePriceInput() {
  const inputPrice = document.getElementById("inputPrice");
  const inputCost = document.getElementById("inputCost");


  if (inputPrice) {
    inputPrice.value = inputPrice.value.replace(".", ",");
    new Cleave(inputPrice, {
      prefix: "R$ ",
      numeral: true,
      numeralDecimalMark: ",",
      delimiter: ".",
      numeralPositiveOnly: true,
    });
  }

  if (inputCost) {
    inputCost.value = inputCost.value.replace(".", ",");
    new Cleave(inputCost, {
      prefix: "R$ ",
      numeral: true,
      numeralDecimalMark: ",",
      delimiter: ".",
      numeralPositiveOnly: true,
    });
  }

  
}

stylingThePriceInput();
