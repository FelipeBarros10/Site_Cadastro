const searchInput = document.getElementById("busca");

if (searchInput) {
  searchInput.addEventListener("keydown", (event) => {
    if (event.key === "Enter") {
      event.preventDefault();
      loadingContent();
    }
  });
}

function loadingContent() {
  const loadingContent = document.getElementById("loading");
  loadingContent.style.display = "flex";

  setTimeout(() => {
    document.getElementById("form").submit();
  }, 650);
}
