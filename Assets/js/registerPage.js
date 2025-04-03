const loadingContent = document.getElementById("loading");

const btn = document.getElementById("registerBtn");


btn.addEventListener("click", (event) => {
  event.preventDefault();

  loadingContent.style.display = "flex";
  setTimeout(() => {
    document.getElementById("registerForm").submit()
  }, 650);
});
