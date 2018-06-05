function loadEvents() {
    var password = document.getElementById('pass1');
    var password2 = document.getElementById('pass2');
    var regButton = document.getElementById('regButton');
    password.addEventListener('change', checkPassword);
    password2.addEventListener('change', checkPassword);
    regButton.disabled = true;
}



function checkPassword() {

    var password = document.getElementById('pass1');
    var password2 = document.getElementById('pass2');
    var regButton = document.getElementById('regButton');
    if (password.value != password2.value) {
        if (!password2.classList.contains('noMatch')) {
            password2.classList.add('noMatch');
        }
        if (!password.classList.contains('noMatch')) {
            password.classList.add('noMatch');
        }
        if (!regButton.classList.contains('disabled')) {
            regButton.classList.add('disabled');
        }
    } else {
        if (password2.classList.contains('noMatch')) {
            password2.classList.remove('noMatch')
        }
        if (password.classList.contains('noMatch')) {
            password.classList.remove('noMatch')
        }
        if (regButton.classList.contains('disabled')) {
            regButton.classList.remove('disabled');
        }
        regButton.disabled = false;
    }
}
