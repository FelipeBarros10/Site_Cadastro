let isOpen = false; // Centraliza o estado do sidebar

function sidebarIconSelected() {
  const icons = [
    document.getElementById("sign-up"),
    document.getElementById("history"),
    document.getElementById("users"),
    document.getElementById("statistics"),
  ];

  let currentSelected = null;

  icons.forEach((item) => {
    if (item) {
      item.addEventListener("click", (event) => {
        if (currentSelected) {
          // Reseta o estado do ícone anterior
          const prevIcon = currentSelected.querySelector("#icon");
          prevIcon.className = prevIcon.className.replace("-fill", "");

          if (isOpen) {
            currentSelected.classList.remove("icon-selected-sidebar-open");
            currentSelected.classList.add("icon-sidebar-open");
          } else {
            currentSelected.classList.remove("icon-selected-sidebar-close");
            currentSelected.classList.add("icon");
          }
        }

        // Define o ícone selecionado
        const selectedIcon = event.currentTarget.querySelector("#icon");
        const parentElementIcon = event.currentTarget;

        switch (event.currentTarget.id) {
          case "sign-up":
            selectedIcon.className = "bi bi-plus-circle-fill";
            break;
          case "history":
            selectedIcon.className = "bi bi-book-fill";
            break;
          case "users":
            selectedIcon.className = "bi bi-people-fill";
            break;
          case "statistics":
            selectedIcon.className = "bi bi-bar-chart-fill";
            break;
        }

        if (isOpen) {
          parentElementIcon.className = "icon-selected-sidebar-open";
        } else {
          parentElementIcon.className = "icon-selected-sidebar-close";
        }

        currentSelected = event.currentTarget; // Atualiza o selecionado
      });
    }
  });
}

function openAndCloseSideBar() {
  const sidebar = document.getElementById("sidebar");
  const listIconElement = document.querySelector("#icon-list");
  const icons = [
    document.getElementById("list"),
    document.getElementById("sign-up"),
    document.getElementById("history"),
    document.getElementById("users"),
    document.getElementById("statistics"),
  ];

  const list = icons.find((item) => item?.id === "list");

  if (list) {
    list.addEventListener("click", () => {
      if (isOpen) {
        sidebar.className = "sidebar";
        listIconElement.className = "bi bi-list";

        icons.forEach((item) => {
          const link = item.querySelector("#link");
          if (link) link.className = "link";
          item.className = "icon";
        });

        isOpen = false;
      } else {
        sidebar.className = "sidebar-open";
        listIconElement.className = "bi bi-arrow-bar-left";

        icons.forEach((item) => {
          const link = item.querySelector("#link");
          if (link) link.className = "link-sidebar-open";
          item.className = "icon-sidebar-open";
        });

        isOpen = true;
      }
    });
  }
}

sidebarIconSelected();
openAndCloseSideBar();
