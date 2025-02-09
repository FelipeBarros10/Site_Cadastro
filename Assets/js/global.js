function openFile() {
  const inputFile = document.getElementById("inputFile");
  const btn = document.getElementById("btn");

  const iconBtn = document.getElementById("iconBtn");

  var img = btn.querySelector("img");

  inputFile.click();

  inputFile.addEventListener("change", (event) => {
    if (iconBtn) {
      iconBtn.remove(); // Remove o ícone se ele existir
      img = document.createElement("img");
    }

    const reader = new FileReader();

    reader.readAsDataURL(event.target.files[0]);

    reader.onload = function (event) {
      img.src = reader.result;
      btn.appendChild(img);
    };
  });
}

function stylingThePriceInput() {
  var inputPrice = document.getElementById("price");
  var inputCost = document.getElementById("cost");

  var inputPriceDotReplace = inputPrice.value.replace(".", ",");
  var inputCostDotReplace = inputCost.value.replace(".", ",")

  inputPrice.value = inputPriceDotReplace;

  inputCost.value = inputCostDotReplace;
  

  new Cleave(inputPrice, {
    prefix: "R$ ",
    numeral: true,
    numeralDecimalMark: ",",
    delimiter: ".",
    numeralPositiveOnly: true,
  });

  new Cleave(inputCost, {
    prefix: "R$ ",
    numeral: true,
    numeralDecimalMark: ",",
    delimiter: ".",
    numeralPositiveOnly: true,
  });
}

stylingThePriceInput();
