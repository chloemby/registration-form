function formValidation()
{
    login = document.getElementById('login');
    password = document.getElementById('password');

    if (login.value.length === 0 || password.value.length === 0) {
        return false;
    }
    return true;
}

function redirect()
{

}