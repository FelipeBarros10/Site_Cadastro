var btnsignUp = document.querySelector("#signup");

var btnsignIn = document.querySelector("#signin");

var body = document.querySelector("body");

btnsignUp.addEventListener("click", () => {
  body.className= "sign-up-js";
})


btnsignIn.addEventListener("click", () => {
  body.className= "sign-in-js";
})



function isErrorMessagesActive (){
  var errorMessages = document.getElementById('error-messages');

  if(errorMessages){
    const style = window.getComputedStyle(errorMessages)
    var isActive = style.display;
    return isActive;
  }

}

if(isErrorMessagesActive()){
  body.className= "sign-up-js-errors";
};

function profileImgView (event){
  const reader = new FileReader();
  reader.onload = function (){
    document.getElementById("profileImg").src = reader.result;
  }

  reader.readAsDataURL(event.target.files[0]);
}


function openFile() {
  const inputFile = document.getElementById("inputFile");

  inputFile.click();
}


