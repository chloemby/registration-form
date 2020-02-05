function uploadLabel() {
    let label = document.getElementById('uploadLabel');
    let imagePath = document.getElementById('uploadImage').value;
    let tokens = imagePath.split('\\');
    let filename = tokens[tokens.length - 1];
    label.innerText = filename;
}

function formValidation()
{
    let password = document.getElementById('password');
    let confirmPassword = document.getElementById('confirmPassword');
    let surname = document.getElementById('surname');
    let name = document.getElementById('name');
    let email = document.getElementById('email');
    let image = document.getElementById('uploadImage').files[0];
    formData = new FormData();
    formData.append('password', password.value);
    formData.append('surname', surname.value);
    formData.append('name', name.value);
    formData.append('email', email.value);
    formData.append('image', image);
    if (password.value !== confirmPassword.value) {
        alert('Пароли не совпадают!');
        confirmPassword.focus();
        return false;
    }
    if (password.value.length < 8) {
        alert('Длина пароля должна быть больше 8 символов!');
        password.focus();
        return false;
    }
    if (email.value.length === 0) {
        alert('Email не может быть пустым!');
        email.focus();
        return false;
    }
    if (name.value.length === 0 || surname.value.length === 0) {
        alert('Имя и фамилия должны быть заполнены!');
        name.focus();
        return false;
    }
    var response = $.ajax({
        url: "create",
        dataType: "json",
        method: "POST",
        processData: false,
        contentType: false,
        async: false,
        data: formData
    }).responseJSON;
    if (response.status === 200) {
        let data = {
            'name': response.data.name,
            'surname': response.data.surname,
            'email': response.data.email,
            'image': response.data.image
        };
        localStorage.setItem('data', JSON.stringify(data));
        return true;
    } else {
        alert(response.message);
        return false;
    }
}