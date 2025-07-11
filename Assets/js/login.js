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


function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}


