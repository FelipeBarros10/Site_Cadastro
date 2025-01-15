
function openFile() {
  const inputFile = document.getElementById("file");

  inputFile.click();
}

function stylingThePriceInput() {

  var inputPrice = document.getElementById("price");

  new Cleave(inputPrice, {
    prefix: 'R$ ',
    numeral: true,
    numeralDecimalMark: ',',
    delimiter: '.',
    numeralPositiveOnly: true,
});

}

stylingThePriceInput();