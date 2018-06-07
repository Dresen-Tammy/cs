function loadEvents() {
    var password = document.getElementById('pass1');
    var password2 = document.getElementById('pass2');
    password.addEventListener('change', checkPassword);
    password2.addEventListener('keyup', checkPassword);

}



function checkPassword() {

    var password = document.getElementById('pass1');
    var password2 = document.getElementById('pass2');

    if (password.value != password2.value) {
        if (!password2.classList.contains('noMatch')) {
            password2.classList.add('noMatch');
        }
        if (!password.classList.contains('noMatch')) {
            password.classList.add('noMatch');
        }

    } else {
        if (password2.classList.contains('noMatch')) {
            password2.classList.remove('noMatch')
        }
        if (password.classList.contains('noMatch')) {
            password.classList.remove('noMatch')
        }


    }
}
