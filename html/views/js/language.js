$(window).on('load', function () {
    let lang = localStorage.getItem('language');
    if (lang) {
        if (lang !== 'eng') {
            changeLanguage(lang);
        }
    } else {
        localStorage.setItem('language', 'eng');
    }
});

$('#rus').click(function () {
    if (localStorage.getItem('language') !== 'rus') {
        changeLanguage('rus');
        localStorage.setItem('language', 'rus');
    }
});

$('#eng').click(function () {
    if (localStorage.getItem('language') !== 'eng') {
        changeLanguage('eng');
        localStorage.setItem('language', 'eng');
    }
});

function changeLanguage(lang) {
    let elements = document.getElementsByClassName('lang');
    if (localStorage.getItem('translation') && localStorage.getItem('translation')['language'] === lang) {
        translate(elements, localStorage.getItem('translation'));
    } else {
        $.ajax({
            url: lang + '.json',
            dataType: 'json',
            success: function (response) {
                localStorage.setItem('translation', JSON.stringify(response));
                translate(elements, response);
            }
        });
    }
}

function translate(elements, response) {
    for (let i = 0; i < elements.length; i++) {
        if (elements[i].tagName.toLocaleLowerCase() === 'input') {
            if (elements[i].type !== 'submit') {
                elements[i].placeholder = response[elements[i].placeholder];
            } else {
                elements[i].value = response[elements[i].value];
            }
        } else {
            elements[i].textContent = response[elements[i].textContent];
        }
    }
}