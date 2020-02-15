function uploadLabel() {
    let label = document.getElementById('uploadLabel');
    let imagePath = document.getElementById('uploadImage').value;
    let tokens = imagePath.split('\\');
    label.innerText = tokens[tokens.length - 1];
}

function formValidation()
{
    let password = document.getElementById('password');
    let confirmPassword = document.getElementById('confirmPassword');
    let surname = document.getElementById('surname');
    let name = document.getElementById('name');
    let email = document.getElementById('email');
    let image = document.getElementById('uploadImage').files[0];
    let translation = JSON.parse(localStorage.getItem('translation'));
    let formData = new FormData();
    formData.append('password', password.value);
    formData.append('surname', surname.value);
    formData.append('name', name.value);
    formData.append('email', email.value);
    formData.append('image', image);
    if (password.value !== confirmPassword.value) {
        let error_message = translation['error_409'];
        alert(error_message);
        confirmPassword.focus();
        return false;
    }
    if (password.value.length < 8) {
        let error_message = translation['error_401'];
        alert(error_message);
        password.focus();
        return false;
    }
    if (email.value.length === 0) {
        let error_message = translation['error_408'];
        alert(error_message);
        email.focus();
        return false;
    }
    if (name.value.length === 0 || surname.value.length === 0) {
        let error_message = translation['error_410'];
        alert(error_message);
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
    if (!response) {
        window.location.href = 'error';
        return false;
    }
    if (response.status === 200) {
        let data = {
            'name': response.data.name,
            'surname': response.data.surname,
            'email': response.data.email,
            'image': response.data.image
        };
        localStorage.setItem('data', JSON.stringify(data));
        return true;
    } if (response.status === 200) {
        localStorage.setItem('data', JSON.stringify(response.data));
        return true;
    } else {
        if (response.status === 500) {
            window.location.href = 'error';
            return false;
        } else {
            let error_message = translation['error_' + response.status.toString()];
            alert(error_message);
        }
        return false;
    }
}