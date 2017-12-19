(function() {
    var close = document.querySelector('.my-close');
    var modal =  document.querySelector('.modal');
    var modalcontent = document.getElementById('modalcontent');

    close.addEventListener('click', function (event) {
        modal.classList.remove("is-active");
    });
    var table = document.getElementById("gallerytableau");
    var tabs = table.getElementsByClassName("card-image");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener('click', function (event) {
            modal.classList.add("is-active");
            get_comment(this.id);
        });
    }
    function get_comment(id) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
               if (xmlhttp.status == 200) {
                   modalcontent.innerHTML = xmlhttp.responseText;
               }
               else if (xmlhttp.status == 400) {
                  alert('There was an error 400');
               }
               else {
                   alert('something else other than 200 was returned');
               }
            }
        };
        xmlhttp.open("GET","functions/getcomments.php?id=" + id);
        xmlhttp.send();
    }
})();