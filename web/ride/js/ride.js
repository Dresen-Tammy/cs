
function hideForm() {
    let dateForm = document.getElementById('dateForm');
    if (!dateForm.classList.contains('hide')) {
        dateForm.classList.add('hide');
    }
}
function unhide() {
    let dateForm = document.getElementById('dateForm');
    if (dateForm.classList.contains('hide')) {
        dateForm.classList.remove('hide');
    }
}
function hideForm2() {
    let dateForm = document.getElementById('trailList');
    if (!dateForm.classList.contains('hide')) {
        dateForm.classList.add('hide');
    }
}
function unhide2() {
    let dateForm = document.getElementById('trailList');
    if (dateForm.classList.contains('hide')) {
        dateForm.classList.remove('hide');
    }
}

