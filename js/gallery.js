(function() {
    var close = document.querySelector('.my-close');
    var modal =  document.querySelector('.modal');
    var toto = document.getElementById('toto');
    var input = "";
    var comment = "";

    close.addEventListener('click', function (event) {
        modal.classList.remove("is-active");
    });
    var table = document.getElementById("gallerytableau").rows;
    for(var i = 0; i < table.length; i++) {
        table[i].onclick = function(object) {
            modal.classList.add("is-active");
/* 
            input = this.getElementsByClassName('addcomment');
            comment = this.getElementsByClassName('newcomment');
            input.addEventListener("submit", function(ev) {
                alert(comment.innerHTML);
                ev.preventDefault();                
            }, false); */
            get_comment(this.getElementsByTagName("th")[0]);
       };
    }
    function get_comment(lol, content) {
        toto.innerHTML = "ouasi gros je suis la";
         var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
                   if (xmlhttp.status == 200) {
                       toto.innerHTML = xmlhttp.responseText;
                   }
                   else if (xmlhttp.status == 400) {
                      alert('There was an error 400');
                   }
                   else {
                       alert('something else other than 200 was returned');
                   }
                }
            };
            xmlhttp.open("GET","getcomments.php?id=" + lol.id);
            xmlhttp.send();
    }
})();