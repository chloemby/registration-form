$(document).ready(function () {
    $('#signin').click(function () {
        let password = document.getElementById('password');
        let login = document.getElementById('login');
        if (password.value.length < 8) {
            alert('Минимальная длина пароля - 8 символов');
            return false;
        }
        if (login.value.length === 0) {
            alert('Email не может быть пустым!');
            login.focus();
            return false;
        }
        if (password.value.length === 0) {
            alert('Пароль не может быть пустым!');
            password.focus();
            return false;
        }
        var data = {
            'password': password.value,
            'email': login.value
        };
        var result =  $.ajax({
            url: "user/auth",
            dataType: "json",
            method: "POST",
            async: false,
            data: data
        }).responseJSON;
        if (result.status === 200) {
            localStorage.setItem('data', JSON.stringify(result.data));
            return true;
        } else {
            alert(result.message);
            return false;
        }
    });
});