var click =  document.querySelector('.imgclick');
var close =  document.querySelector('#close');

click.addEventListener('click', function (event) {
    var id = click.id;
    var modal = document.querySelector('.modal');
    modal.classList.add("is-active");
});

close.addEventListener('click', function (event) {
    var id = click.id;
    var modal = document.querySelector('.modal');
    if (this.classList.contains('is-active')) {
       modal.classList.remove('is-active');
    }
});