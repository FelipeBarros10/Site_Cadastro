function showImgToUser (inputFile, iconBtn){
 
  inputFile.addEventListener("change", (event) => {
    const profileImg = document.getElementById('profileImg');
    const imgProduct = document.getElementById("currentImgProduct");
    const reader = new FileReader();
    const btn = document.getElementById("btn");
    
    if(imgProduct){
      console.log(imgProduct);
      reader.onload = function () {
        imgProduct.src = reader.result;
      };
    }

    if (iconBtn) {
      
      iconBtn.remove();
      let img = document.createElement("img");
      
     reader.onload = function () {
        base64 = reader.result;
        img.src = base64
        btn.appendChild(img);
      };
    } 
    
    if (profileImg){
      reader.onload = () => {
        profileImg.src = reader.result
      }
    }

    reader.readAsDataURL(event.target.files[0]);
  });
}


function openFile() {
  const inputFile = document.getElementById("inputFile");
  const iconBtn = document.getElementById("iconBtn");

  inputFile.click(showImgToUser(inputFile, iconBtn));
}

function stylingThePriceInput() {
  var inputPrice = document.getElementById("price");
  var inputCost = document.getElementById("cost");


  if (inputPrice) {
      inputPrice.value = inputPrice.value.replace(".", ",");
    
  }

  if (inputCost) {
      inputCost.value = inputCost.value.replace(".", ",");

  }
  
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
