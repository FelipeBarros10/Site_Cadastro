const form = document.getElementById('formSelect')
const select = document.getElementById('selectCategorie')

function filterCategorie(){
  if(select.value != 'filtros'){
    form.submit()
  }
}

