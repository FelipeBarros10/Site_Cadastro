const searchInput = document.getElementById("busca");
const loadingElement = document.getElementById("loading");
const form = document.getElementById("form");

if (searchInput) {
  searchInput.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      event.preventDefault();
      loadingContent();
    }
  });
}

function loadingContent() {
  loadingElement.style.display = "flex";

  setTimeout(() => {
    if(form){
      form.submit();
    }
  }, 500);
}


function loadingContentWithoutForm() {
  loadingElement.style.display = "flex";
}

function hideLoadingContentWithoutForm(){
  loadingElement.style.display = "none";
}