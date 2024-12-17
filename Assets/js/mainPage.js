function sidebarIconSelected() {
  var icons = [
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
          currentSelected.querySelector("#icon").className = currentSelected
            .querySelector("#icon")
            .className.replace("-fill", "");
          currentSelected.classList.remove("icon-selected");
          currentSelected.classList.add("icon");
        }

        switch (event.currentTarget.id) {
          case "sign-up":
            var elementIcon = event.currentTarget.querySelector("#icon");
            var parentElementIcon = event.currentTarget;

            elementIcon.className = "bi bi-plus-circle-fill";
            parentElementIcon.className = "icon-selected";
            break;

          case "history":
            var elementIcon = event.currentTarget.querySelector("#icon");
            var parentElementIcon = event.currentTarget;

            elementIcon.className = "bi bi-hourglass-split";
            parentElementIcon.className = "icon-selected";
            break;

          case "users":
            var elementIcon = event.currentTarget.querySelector("#icon");
            var parentElementIcon = event.currentTarget;

            elementIcon.className = "bi bi-people-fill";
            parentElementIcon.className = "icon-selected";
            break;

          case "statistics":
            var elementIcon = event.currentTarget.querySelector("#icon");
            var parentElementIcon = event.currentTarget;

            elementIcon.className = "bi bi-bar-chart-fill";
            parentElementIcon.className = "icon-selected";
            break;
        }
        currentSelected = event.currentTarget;
      });
    }
  });
}

sidebarIconSelected();



function openAndCloseSideBar () {
  var list = document.getElementById('list');
  var sidebar = document.getElementById('sidebar');
  var link = document.getElementById('link');
  var listIconElement = list.querySelector('#icon-list')

  var icons = [
    document.getElementById("sign-up"),
    document.getElementById("history"),
    document.getElementById("users"),
    document.getElementById("statistics"),
  ];
  
  var isOpen = false;

  list.addEventListener("click", () =>{
    

    if(isOpen){
      sidebar.className = "sidebar"

      listIconElement.className = "bi bi-list";

      link.className = "link"

      icons.forEach((item) => {
        item.className = "icon"
      
      })

      isOpen = false
    } else if(!isOpen){
      sidebar.className = "sidebar-open"

      link.className = "link-sidebar-open"

      listIconElement.className = "bi bi-arrow-bar-left";

      icons.forEach((item) => {
        item.className = "icon-sidebar-open"
      })

      isOpen = true
    }
    
    

    
  })
}


openAndCloseSideBar();