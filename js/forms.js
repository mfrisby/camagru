    var sign = document.querySelector('.signButton');
    var log = document.querySelector('.logButton');
    var lForm = document.querySelector('#logForm');
    var sForm = document.querySelector('#signForm');

    sign.addEventListener('click', function (event) {
        if (sForm.style.display == "none") {
            sForm.style.display = "block";
            lForm.style.display = "none";

        }
    });
    log.addEventListener('click', function (event) {
        if (lForm.style.display == "none") {
            lForm.style.display = "block";
            sForm.style.display = "none";

        }
    });