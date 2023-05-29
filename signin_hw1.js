function checkName(event) {
    const input = event.currentTarget;

    if (formStatus[input.name] = input.value.length > 0) {
        input.classList.remove('error');
    } else {
        input.classList.add('error');
    }
    
    checkForm();
}

function jsonCheckUsername(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.username = !json.exists) {
        document.querySelector('#username').classList.remove('error');
        document.querySelector('#username span').textContent ="";
    } else {
        document.querySelector('#username span').textContent = "Nome utente già utilizzato";
        document.querySelector('#username').classList.add('error');
    }
    checkForm();
}

function jsonCheckEmail(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.email = !json.exists) {
        document.querySelector('#email').classList.remove('error');
        document.querySelector('#email span').textContent ="";
    } else {
        document.querySelector('#email span').textContent = "Email già utilizzata";
        document.querySelector('#email').classList.add('error');
    }
    checkForm();
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername(event) {
    const input = document.querySelector('#username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.querySelector('span').textContent = "Username non valido";
        input.parentNode.classList.add('error');
        formStatus.username = false;
        checkForm();
    } else {
        document.querySelector('#username span').textContent ="";
        fetch("http://localhost/lety2/check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function checkEmail(event) {
    const emailInput = document.querySelector('#email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('#email span').textContent = "Email non valida";
        document.querySelector('#email').classList.add('error');
        formStatus.email = false;
        checkForm();
    } else {
        document.querySelector('#email span').textContent ="";
        fetch("http://localhost/lety2/check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword(event) {
    const passwordInput = document.querySelector('#password input');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('#password').classList.remove('error');
        document.querySelector('#password span').textContent ="";
    } else {
        document.querySelector('#password').classList.add('error');
        document.querySelector('#password span').textContent ="Password troppo corta!";
    }
    checkForm();
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('#conferma input');
    if (formStatus.confirmPassord = confirmPasswordInput.value === document.querySelector('#password input').value) {
        document.querySelector('#conferma').classList.remove('error');
        document.querySelector('#conferma span').textContent ="";
    } else {
        document.querySelector('#conferma').classList.add('error');
        document.querySelector('#conferma span').textContent ="Password non coincidenti";
    }
    checkForm();
}

function checkForm() {
    document.getElementById('accesso').disabled =!document.querySelector('#consenti input').checked || 
    Object.keys(formStatus).length !== 7 || 
    Object.values(formStatus).includes(false);
}

const formStatus = {'upload': true};
document.querySelector('#nome input').addEventListener('blur', checkName);
document.querySelector('#cognome input').addEventListener('blur', checkName);
document.querySelector('#username input').addEventListener('blur', checkUsername);
document.querySelector('#email input').addEventListener('blur', checkEmail);
document.querySelector('#password input').addEventListener('blur', checkPassword);
document.querySelector('#conferma input').addEventListener('blur', checkConfirmPassword);
document.querySelector('#consenti input').addEventListener('change', checkForm);

if (document.querySelector('.error') !== null) {
    checkUsername(); checkPassword(); checkConfirmPassword(); checkEmail();
    document.querySelector('#nome input').dispatchEvent(new Event('blur'));
    document.querySelector('#cognome input').dispatchEvent(new Event('blur'));
}