(function() {
    var password = document.querySelector('#password');
    var username = document.querySelector('#username');
    var email = document.querySelector('#email');
    var pForm = document.querySelector('#passwordForm');
    var uForm = document.querySelector('#usernameForm');
    var eForm = document.querySelector('#emailForm');
    password.addEventListener('click', function (event) {
        if (pForm.style.display == "none") {
            pForm.style.display = "block";
            uForm.style.display = "none";
            eForm.style.display = "none";
        }
    });
    username.addEventListener('click', function (event) {
        if (uForm.style.display == "none") {            
            uForm.style.display = "block";
            pForm.style.display = "none";
            eForm.style.display = "none";
        }
    });
    email.addEventListener('click', function (event) {
        if (eForm.style.display == "none") {
            eForm.style.display = "block";
            uForm.style.display = "none";
            pForm.style.display = "none";
        }
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
})();

function passwordSubmit() {
    var form = document.forms.passwordForm;
    var formData = new FormData(form);
    var password = formData.get('password');
    var value = formData.get('value');
    alert(password + " " + value);
}
function usernameSubmit() {
    var form = document.forms.usernameForm;
    var formData = new FormData(form);
    var password = formData.get('password');
    var value = formData.get('value');
    alert(password + " " + value);
    
}
function emailSubmit() {
    var form = document.forms.emailForm;
    var formData = new FormData(form);
    var password = formData.get('password');
    var value = formData.get('value');
    alert(password + " " + value);
}