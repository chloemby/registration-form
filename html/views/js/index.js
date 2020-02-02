$(document).ready(function () {
    $('#signin').click(function () {

        $.ajax({
            url: "auth",
            dataType: "json",
            method: "POST",
            data: {
                'password': password,
                'email': login,
            },
            success: function (data) {
                console.log(data);
                if (data.code === 200) {
                } else {
                    alert(data.message);
                }
            },
            error: function (data) {
                alert(data.message);
                return fase;
            },
            beforeSend: function () {
                login = document.getElementById('login');
                password = document.getElementById('password');
                if (login.value.length === 0 || password.value.length === 0) {
                    alert('Invalid login/password');
                }
            }
        });
        return false;
    })
});