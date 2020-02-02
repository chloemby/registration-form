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
    let image = document.getElementById('uploadImage');
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
    $.ajax({
        url: "create",
        dataType: "json",
        method: "POST",
        data: {
            'password': password,
            'surname': surname,
            'email': email,
            'name': name,
            'files': image
        },
        success : function (data) {
            if (data.code === 200) {
                return true;
            } else {
                alert(data.message);
                return false;
            }
        },
        error: function (data) {
            alert(data.message);
            return false;
        }
    });
}