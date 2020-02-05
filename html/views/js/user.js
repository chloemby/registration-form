$(document).ready(function () {
    var name = document.getElementById('name');
    var surname = document.getElementById('surname');
    var email = document.getElementById('email');
    var image = document.getElementById('image');
    var data = JSON.parse(localStorage['data']);
    name.innerText = data['name'];
    surname.innerText = data['surname'];
    email.innerText = data['email'];
    image.src = data['image'];
});