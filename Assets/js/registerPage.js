
function openFile() {
  const inputFile = document.getElementById("file");

  inputFile.click();
}

function stylingThePriceInput() {

  var inputPrice = document.getElementById("price");
  var inputCost = document.getElementById("cost");

  new Cleave(inputPrice, {
    prefix: 'R$ ',
    numeral: true,
    numeralDecimalMark: ',',
    delimiter: '.',
    numeralPositiveOnly: true,
});

new Cleave(inputCost, {
  prefix: 'R$ ',
  numeral: true,
  numeralDecimalMark: ',',
  delimiter: '.',
  numeralPositiveOnly: true,
});

}

stylingThePriceInput();