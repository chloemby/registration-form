$(document).ready(function () {
    let name = document.getElementById('name');
    let surname = document.getElementById('surname');
    let email = document.getElementById('email');
    let image = document.getElementById('image');
    if (localStorage.length === 0) {
        window.location.href = 'views/error.html'
    } else {
        let data = JSON.parse(localStorage['data']);
        name.innerText = data['name'];
        surname.innerText = data['surname'];
        email.innerText = data['email'];
        if (data['image']) {
            image.src = data['image'];
        }
    }
});