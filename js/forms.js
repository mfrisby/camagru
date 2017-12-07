    var sign = document.querySelector('.signButton');
    var log = document.querySelector('.logButton');
    var ldiv = document.querySelector('#logdiv');
    var sdiv = document.querySelector('#signdiv');
 /*    var lform = document.querySelector('#logform');
    var sform = document.querySelector('#signform'); */

    sign.addEventListener('click', function (event) {
        if (sdiv.style.display == "none") {
            sdiv.style.display = "block";
            ldiv.style.display = "none";

        }
    });
    log.addEventListener('click', function (event) {
        if (ldiv.style.display == "none") {
            ldiv.style.display = "block";
            sdiv.style.display = "none";

        }
    });
/*     lform.addEventListener('submit', function (event) {
        
    });
    sform.addEventListener('submit', function (event) {
        
    }); */