$(document).ready(function () {
    $('#signin').click(function () {
        let password = document.getElementById('password');
        let login = document.getElementById('login');
        let translation = JSON.parse(localStorage.getItem('translation'));
        if (password.value.length < 8) {
            let error_message = translation['error_401'];
            alert(error_message);
            password.focus();
            return false;
        }
        if (login.value.length === 0) {
            let error_message = translation['error_408'];
            alert(error_message);
            login.focus();
            return false;
        }
        let data = {
            'password': password.value,
            'email': login.value
        };
        let result =  $.ajax({
            url: "user/auth",
            dataType: "json",
            method: "POST",
            async: false,
            data: data
        }).responseJSON;
        if (result === undefined) {
            window.location.href = 'error';
            return false;
        }
        if (result.status === 200) {
            localStorage.setItem('data', JSON.stringify(result.data));
            return false;
        } else {
            if (result.status === 500) {
                window.location.href = 'error';
                return false;
            } else {
                let error_message = translation['error_' + result.status.toString()];
            }
            alert(error_message);
            return false;
        }
    });
});