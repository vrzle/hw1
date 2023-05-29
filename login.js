function validazione(event){
    if(form.username.value.length==0 || 
        form.password.value.length==0)
        {
            const avviso = document.createElement('p');
            avviso.textContent="Compila tutti i campi!";
            form.appendChild(avviso);
            event.preventDefault();
        }
}
const form= document.querySelector("form");

form.addEventListener('submit',validazione);