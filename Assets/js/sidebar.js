// Cria a variável que vai falar se o sidebar está aberto ou não
let sidebarIsOpen = false;

let currentUrl = window.location.pathname;

  document.addEventListener("DOMContentLoaded", () => {
    const logo = document.getElementById("logo");


    const selectedIconId = localStorage.getItem("selectedIcon");

    if(!currentUrl.includes("register") || !currentUrl.includes("historic") || !currentUrl.includes("users") || !currentUrl.includes("historic") || !currentUrl.includes("sale")){
      localStorage.removeItem("selectedIcon");
    }
  
    if (selectedIconId) {
      const selectedIcon = document.getElementById(selectedIconId);
  
      if (selectedIcon) {
        const iconElementSelected = selectedIcon.querySelector("#icon");
  
        switch(selectedIconId) {
          case "register":
            iconElementSelected.className = "bi bi-plus-circle-fill";
            break;
          case "historic":
            iconElementSelected.className = "bi bi-book-fill";
            break;
          case "users":
            iconElementSelected.className = "bi bi-people-fill";
            break;
          case "sale":
            iconElementSelected.className = "bi bi-check-circle-fill";
            break;
        }
  
        if (sidebarIsOpen) {
          selectedIcon.classList.add("icon-selected-sidebar-open");
        } else {
          selectedIcon.classList.add("icon-selected-sidebar-close");
        }
      }
    }
  });
  


function sidebarIconSelected() {
  // Variável que recebe o DOM de todos os ícones do sidebar
  const icons = [
    document.getElementById("register"),
    document.getElementById("historic"),
    document.getElementById("users"),
    document.getElementById("sale"),
  ];

  //Variável que vai receber o ícone selecionado
  let currentSelected = null;

  //Laço de repetição dentro da várivel de ícones
  icons.forEach(item => { //item corresponde a cada índice(item) do array

    //Verifica se o item existe
    if(item){
      
      //Se sim, é incluído o evento de escuta que vai verificar se algum item será clicado
      item.addEventListener("click", (event) => {
        
        localStorage.setItem("selectedIcon", event.currentTarget.id);
   

        //Primeiro, verifica se já existe um ícone selecionado
        
        if(currentSelected){
          //Se sim, seleciona o <i> e o desenho de ícone preenchido é retirado
         const currentIconSelected = currentSelected.querySelector('#icon');
         currentIconSelected.className = currentIconSelected.className.replace("-fill", "");

         //Verifica se o sidebar está aberto ou não quando um ícone está selecionado
         if(sidebarIsOpen){
          //Se sim, retira a classe de ícone selecionado e volta para a classe padrão
          currentSelected.classList.remove("icon-selected-sidebar-open");
          currentSelected.classList.add("icon-sidebar-open");
         } else {
          //Se o sidebar estiver fechada, a classe de ícone selecionado també é retirada e volta para a classe padrão
          currentSelected.classList.remove("icon-selected-sidebar-close");
          currentSelected.classList.add("icon")
         }
        }

        //Criando constantes que vai receber o "evento"(icone do array) atual clicado(a div pai)
        const parentElementIcon = event.currentTarget;
        //Criando uma constante que recebe o <i> do "evento"(icone do array) atual clicado
        const iconElementSelected = event.currentTarget.querySelector("#icon");
        
        //Seitch para verificar qual ícone está sendo clicado
        switch(parentElementIcon.id){
          //Caso seja o "register"
          case "register":
            //inserimos o desenho de ícone preenchido ao <i>
            iconElementSelected.className = "bi bi-plus-circle-fill";
            break;

          //Caso seja o "historic"
          case "historic":
            //inserimos o desenho de ícone preenchido ao <i>
            iconElementSelected.className = "bi bi-book-fill";
            break;

          //Caso seja o "users"
          case "users":
            //inserimos o desenho de ícone preenchido ao <i>
            iconElementSelected.className = "bi bi-people-fill";
           break;
          
          //Caso seja o "sale"
          case "sale":
            //inserimos o desenho de ícone preenchido ao <i>
            iconElementSelected.className = "bi bi-check-circle-fill";
           break;
        }

        //Outra validação é feita para verificar se o sidebar estiver aberta ou não
        if (sidebarIsOpen){
          //Se sim,retira a classe padrão inclui a classe para a div pai ficar selecionada
          parentElementIcon.classList.remove("icon-sidebar-open");
          parentElementIcon.classList.add("icon-selected-sidebar-open")
        } else {
          //Se não,retira a classe padrão inclui a classe para a div pai ficar selecionada
          parentElementIcon.classList.remove("icon");
          parentElementIcon.classList.add("icon-selected-sidebar-close")
        }

        //Inclui o "evento"(icone do array) atual clicado(a div pai) a variável
        currentSelected = parentElementIcon
      })
    }
  })
}


//Função que será responsável pela abertura e fechamento do sidebar
function openAndCloseSideBar (){
  //Constante que recebe o DOM do sidebar
  const sidebar = document.getElementById("sidebar");

  //Constante que recebe o DOM do ícone da lista
  const listIconElement = document.getElementById("icon-list");

  // Variável que recebe o DOM de todos os ícones do sidebar
  const icons = [
    document.getElementById("list"),
    document.getElementById("register"),
    document.getElementById("historic"),
    document.getElementById("users"),
    document.getElementById("sale"),
  ];

  //Cria a constante que procura o item "list" dentro do array de icons
  const list = icons.find((item) => item?.id === "list");

  //Verifica se existe
  if(list){
    //Variável que vai ficar escutando o click dos items do array
    list.addEventListener("click", () => {
     
      //Validação se o sidebar está aberto 
      if(sidebarIsOpen){

        //Se estiver a classe de sidebar fechada é incluída
        sidebar.className = "sidebar";

        //O desenho de lista é incluído no <i>
        listIconElement.className = "bi bi-list";

        //É feito um foreach no array de ícones
        icons.forEach((item) => { //item corresponde a cada índice(item) do array
          //Constante que pega o <a> link de cada item do array
          const link = item.querySelector("#link");

          if(link){
            //Se o link existir é colocado a classe padrão de quando o sidebar é fechado
            link.className = "link";
          }

          //É colocado a classe padrão na div pai de quando o sidebar é aberto
          item.className = "icon"  
        })

        //Seta que o sidebar está fechado
        sidebarIsOpen = false

      } else {
        //Se a sidebar estive fechada na hora do click, a classe para a abertura do sidebar é incluída 
        sidebar.className = "sidebar-open";

        //Altera o ícone do <i> de lista para uma flecha
        listIconElement.className = "bi bi-arrow-bar-left";
        
        //É feito um foreach no array de ícones
        icons.forEach((item) => {

          //Constante que pega o <a> link de cada item do array
          const link = item.querySelector("#link");

          if(link){
            //Se o link existir é colocado a classe padrão e quando o sidebar é aberto
            link.className = "link-sidebar-open";
          }

          //É colocado a classe padrão na div pai de quando o sidebar é aberto
          item.className = "icon-sidebar-open"  
        })

        //Seta que o sidebar está aberto
        sidebarIsOpen = true
      }
    })

  }

}
//Chama as funções
sidebarIconSelected();
openAndCloseSideBar();
