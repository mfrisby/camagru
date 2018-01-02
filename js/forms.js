    var ldiv = document.querySelector('#logdiv');
    var sdiv = document.querySelector('#signdiv');
    var fdiv = document.querySelector('#forgdiv');
    var lb = document.querySelector('#logB');
    var sb = document.querySelector('#signB');
    var fb = document.querySelector('#forgB');
 /*    var lform = document.querySelector('#logform');
    var sform = document.querySelector('#signform'); */

    sb.addEventListener('click', function (event) {
            sdiv.style.display = "block";
            ldiv.style.display = "none";
            fdiv.style.display = "none";
            lb.className = "";
            sb.classList.add("is-active");
            fb.className = "";
    });
    lb.addEventListener('click', function (event) {
            ldiv.style.display = "block";
            sdiv.style.display = "none";
            fdiv.style.display = "none";
        lb.classList.add("is-active");
        fb.className = "";
        sb.className = "";
    });    
    fb.addEventListener('click', function (event) {
            ldiv.style.display = "none";
            sdiv.style.display = "none";
            fdiv.style.display = "block";
            fb.classList.add('is-active');
            sb.className = "";
            lb.className = "";
    });
/*     lform.addEventListener('submit', function (event) {
        
    });
    sform.addEventListener('submit', function (event) {
        
    }); */