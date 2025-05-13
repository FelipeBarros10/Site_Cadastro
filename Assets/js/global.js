function showImgToUser (inputFile, iconBtn){
  const profileImg = document.getElementById('profileImg')

  inputFile.addEventListener("change", (event) => {
    const reader = new FileReader();

    if (iconBtn) {
      iconBtn.remove();
      img = document.createElement("img");

      reader.onload = function () {
        img.src = reader.result;
        btn.appendChild(img);
      };
    
    } 
    
    if (profileImg){
      reader.onload = () => {
        profileImg.src = reader.result
      }
    }

    else {
      const img = document.getElementById("currentImgProduct");

      reader.onload = function () {
        img.src = reader.result;
      };
    }
    
    reader.readAsDataURL(event.target.files[0]);
  });
}


function openFile() {
  const inputFile = document.getElementById("inputFile");
  const btn = document.getElementById("btn");

  const iconBtn = document.getElementById("iconBtn");

  if (iconBtn) {
    var img = btn.querySelector("img");
  }

  inputFile.click(showImgToUser(inputFile, iconBtn));
}

function stylingThePriceInput() {
  var inputPrice = document.getElementById("price");
  var inputCost = document.getElementById("cost");

  var inputPriceDotReplace = inputPrice.value.replace(".", ",");
  var inputCostDotReplace = inputCost.value.replace(".", ",");

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

function loadingContent() {
  const loadingContent = document.getElementById("loading");

  loadingContent.style.display = "flex";
  setTimeout(() => {
    document.getElementById("form").submit();
  }, 650);
}
