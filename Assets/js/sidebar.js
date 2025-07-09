
// Cria a variável que vai falar se o sidebar está aberto ou não
let sidebarIsOpen = false;

const linksPages = [
  document.getElementById("linkList"),
  document.getElementById("linkSale"),
  document.getElementById("linkRegister"),
  document.getElementById("linkHistoric"),
];

  document.addEventListener("DOMContentLoaded", () => {
    
    let currentUrl = window.location.pathname;

    if(currentUrl.includes("mainPage")){
      localStorage.removeItem("selectedIcon");
      return
    }

    if(currentUrl.includes("registerPage")){
      localStorage.setItem("selectedIcon", 'linkRegister');
    }

    let selectedStorageLinkId = localStorage.getItem("selectedIcon");
      
    if (selectedStorageLinkId) {
      
      const selectedStorageLinkElement = document.getElementById(selectedStorageLinkId);

      if (selectedStorageLinkElement) {
        const iconElementSelected = selectedStorageLinkElement.querySelector("#icon");
        
        switch(selectedStorageLinkId) {
          case "linkRegister":
            iconElementSelected.className = "bi bi-plus-circle-fill";
            break;
          case "linkHistoric":
            iconElementSelected.className = "bi bi-book-fill";
            break;
          case "linkUsers":
            iconElementSelected.className = "bi bi-people-fill";
            break;
          case "linkSale":
            iconElementSelected.className = "bi bi-check-circle-fill";
            break;
        }
  
        if (sidebarIsOpen) {
          selectedStorageLinkElement.classList.add("link-selected-sidebar-open");
        } else {
          selectedStorageLinkElement.classList.add("link-selected-sidebar-close");
        }
      }
    }
  });
  

function sidebarIconSelected() {
  
  // Variável que recebe o DOM de todos os ícones do sidebar
  const linksPages = [
    document.getElementById("linkSale"),
    document.getElementById("linkRegister"),
    document.getElementById("linkHistoric"),
  ];

  //Variável que vai receber o ícone selecionado
  let currentSelected = null;

  //Laço de repetição dentro da várivel de ícones
  linksPages.forEach(item => { //item corresponde a cada índice(item) do array
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
          item.classList.remove("link-selected-sidebar-open");
          item.classList.add("link-sidebar-open");
         } else {
          //Se o sidebar estiver fechada, a classe de ícone selecionado també é retirada e volta para a classe padrão
          item.classList.remove("link-selected-sidebar-close");
          item.classList.add("link")
         }
        }

        //Criando constantes que vai receber o "evento"(icone do array) atual clicado(a div pai)
        const linkIcon = event.currentTarget;

        const parentDivIcon = linkIcon.querySelector('.parentIcon')

        //Criando uma constante que recebe o <i> do "evento"(icone do array) atual clicado
        const iconElementSelected = event.currentTarget.querySelector("#icon");

        //Switch para verificar qual ícone está sendo clicado
        switch(linkIcon.id){
          //Caso seja o "register"
          case "linkRegister":
            //inserimos o desenho de ícone preenchido ao <i>
            iconElementSelected.className = "bi bi-plus-circle-fill";
            break;

          //Caso seja o "historic"
          case "linkHistoric":
            //inserimos o desenho de ícone preenchido ao <i>
            iconElementSelected.className = "bi bi-book-fill";
            break;

          //Caso seja o "users"
          case "linkUsers":
            //inserimos o desenho de ícone preenchido ao <i>
            iconElementSelected.className = "bi bi-people-fill";
           break;
          
          //Caso seja o "sale"
          case "linkSale":
            //inserimos o desenho de ícone preenchido ao <i>
            iconElementSelected.className = "bi bi-check-circle-fill";
           break;
        }


        
        //Outra validação é feita para verificar se o sidebar estiver aberta ou não
        if (sidebarIsOpen){
          //Se sim,retira a classe padrão inclui a classe para a div pai ficar selecionada
          item.classList.remove("link-sidebar-open");
          item.classList.add("link-selected-sidebar-open")
        } else {
          //Se não,retira a classe padrão inclui a classe para a div pai ficar selecionada
          item.classList.remove("link");
          item.classList.add("link-selected-sidebar-close")
        }

        //Inclui o "evento"(icone do array) atual clicado(a div pai) a variável
        currentSelected = parentDivIcon
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
  //Cria a constante que procura o item "list" dentro do array de icons
  const list = linksPages.find((item) => item.id === "linkList");
  
  //Verifica se existe
  if(list){
    //Variável que vai ficar escutando o click dos items do array
    list.addEventListener("click", () => {
     
      //Validação se o sidebar está aberto 
      if(sidebarIsOpen === true){
        
        //Se estiver a classe de sidebar fechada é incluída
        sidebar.className = "sidebar";

        //O desenho de lista é incluído no <i>
        listIconElement.className = "bi bi-list";

        //É feito um foreach no array de ícones
        linksPages.forEach((item) => { //item corresponde a cada índice(item) do array\

          //Constante que pega o <a> link de cada item do array
          const link = item.querySelector('.parentIcon-sidebar-open');
          
          if(link){
            //Se o link existir é colocado a classe padrão de quando o sidebar é fechado
            link.className = "parentIcon";
            
          }

          // //É colocado a classe padrão na div pai de quando o sidebar é aberto
          item.className = "link" 
          ; 
        })
        
        //Seta que o sidebar está fechado
        sidebarIsOpen = false
        
      } else {
        //Se a sidebar estive fechada na hora do click, a classe para a abertura do sidebar é incluída 
        sidebar.className = "sidebar-open";

        //Altera o ícone do <i> de lista para uma flecha
        listIconElement.className = "bi bi-arrow-bar-left";
        
        //É feito um foreach no array de ícones
        linksPages.forEach((item) => {
          
          //Constante que pega o <a> link de cada item do array
          const link = item.querySelector('.parentIcon');

          if(link){
            //Se o link existir é colocado a classe padrão e quando o sidebar é aberto
            link.className = "parentIcon-sidebar-open";
          }

          // //É colocado a classe padrão na div pai de quando o sidebar é aberto
          item.className = "link-sidebar-open"  
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
