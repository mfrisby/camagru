(function() {
    var close = document.querySelector('.modal-close');
    var modal =  document.querySelector('.modal');

    close.addEventListener('click', function (event) {
        modal.classList.remove("is-active");
    });
    var table = document.getElementById("gallerytableau").rows;
    for(var i = 0; i < table.length; i++) {
        table[i].onclick = function() {
        modal.classList.add("is-active");
       };
    }
})();