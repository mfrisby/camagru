(function() {
    var password = document.querySelector('#password');
    var username = document.querySelector('#username');
    var email = document.querySelector('#email');
    var notif = document.querySelector('#notif');
    var pForm = document.querySelector('#passwordForm');
    var uForm = document.querySelector('#usernameForm');
    var eForm = document.querySelector('#emailForm');
    var nForm = document.querySelector('#notifForm');
    password.addEventListener('click', function (event) {
            pForm.style.display = "block";
            uForm.style.display = "none";
            eForm.style.display = "none";
            nForm.style.display = "none";
    });
    username.addEventListener('click', function (event) {
            uForm.style.display = "block";
            pForm.style.display = "none";
            eForm.style.display = "none";
            nForm.style.display = "none";
    });
    email.addEventListener('click', function (event) {
            eForm.style.display = "block";
            uForm.style.display = "none";
            pForm.style.display = "none";
            nForm.style.display = "none";
    });
    notif.addEventListener('click', function (event) {
        eForm.style.display = "none";
        uForm.style.display = "none";
        pForm.style.display = "none";
        nForm.style.display = "block";
    });
    pForm.addEventListener('submit', function (event) {
        passwordSubmit();
    });
    uForm.addEventListener('submit', function (event) {
        usernameSubmit();
    });
    eForm.addEventListener('submit', function (event) {
        emailSubmit();
    });
    nForm.addEventListener('submit', function (event) {
        notifSubmit();
    });
})();

function passwordSubmit() {
    var form = document.forms.passwordForm;
    var formData = new FormData(form);
    var password = formData.get('password');
    var value = formData.get('valueP');
    ajaxRequest(formData);
}
function usernameSubmit() {
    var form = document.forms.usernameForm;
    var formData = new FormData(form);
    var password = formData.get('password');
    var value = formData.get('valueU');
    ajaxRequest(formData);
}
function emailSubmit() {
    var form = document.forms.emailForm;
    var formData = new FormData(form);
    var password = formData.get('password');
    var value = formData.get('valueE');
    ajaxRequest(formData);
}
function notifSubmit() {
    var form = document.forms.emailForm;
    var formData = new FormData(form);
    var password = formData.get('password');
    var value = formData.get('valueN');
    ajaxRequest(formData);
}

function ajaxRequest(formData) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    xmlhttp.open("POST","profil.php",true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(formData);
}