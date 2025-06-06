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
